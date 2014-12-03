<?php
class MoviesController extends AppController {
    public $helpers = array('Html', 'Form', 'Paginator');
    public $components = array('Session', 'Search.Prg');
    public $presetVars = true;
    public $paginate = array(
            'limit' =>7,
            'order'=>array(
                'Movie.play_count' => 'desc'
            )
        );

// 検索機能の&とorを手動で切り替える方法 
    // array(
    //     'keyword' => array('type' => 'value', 'empty' => true, 'encode' => true),
    //     'andor' => array('type' => 'value', 'empty' => true, 'encode' => true),
    //     'from' => array('type' => 'value', 'empty' => true, 'encode' => true),
    //     'to' => array('type' => 'value', 'empty' => true, 'encode' => true),
    // );

    public $uses = array('Movie','User','Genre', 'WatchHistory', 'Comment');

    public function beforeFilter() {

        parent ::beforeFilter();

        $this->Auth->allow();
    }

    public function index() {
    	$movies = $this->Movie->find('all');

        // Categoryモデルを使ってデータを取得
        $users = $this->User->find('all');

        $genres = $this->Genre->find('all');

        $watchhistories = $this->WatchHistory->find('all');

        $comments = $this->Comment->find('all');

    	$this->set(compact('movies', 'users', 'genres', 'watchhistories', 'comments'));
    
    // ユーザーネームの確認用変数 
        $checkuser = $this->Auth->user('username');
        $this->set('checkuser', $checkuser);

        //$this->set('posts', $this->Post->find('all'));
    
        $this->Movie->recursive = 0;
        $this->Prg->commonProcess();
        // $req = $this->passedArgs;

        // if (!empty($this->request->data['Movie']['keyword'])) {
        //     $andor = !empty($this->request->data['Movie']['andor']) ? $this->request->data['Movie']['andor'] : null;
        //     $word = $this->Movie->multipleKeywords($this->request->data['Movie']['keyword'], $andor);
        //     $req = array_merge($req, array("word" => $word));
        // }

        // $this->paginate = array(
           $paginate = array(
            'conditions' => $this->Movie->parseCriteria($this->passedArgs),
            
        );
         $this->set('movies', $this->paginate('Movie'));

        $movie_names = $this->Movie->find('list');
        $this->set(compact('movie_names'));

    }
// うまくいかなーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーい！！！！！！！
    public function genre_index($genre_id = null){
        // $movies = $this->Movie->find('all', array('conditions' => array('genre_id' =>$genre_id)));

        // Categoryモデルを使ってデータを取得
        $users = $this->User->find('all');

        $selectedGenre = $this->Genre->find('all', array('conditions' => array('id' => $genre_id)));

        $genres = $this->Genre->find('all');

        $watchhistories = $this->WatchHistory->find('all');

        $comments = $this->Comment->find('all');

        $this->set(compact('movies', 'users', 'genres', 'watchhistories', 'comments', 'selectedGenre'));
    
    // ユーザーネームの確認用変数 
        $checkuser = $this->Auth->user('username');
        $this->set('checkuser', $checkuser);

        //$this->set('posts', $this->Post->find('all'));
    
        $this->Movie->recursive = 0;
        $this->Prg->commonProcess();

        // $req = $this->passedArgs;

        // if (!empty($this->request->data['Movie']['keyword'])) {
        //     $andor = !empty($this->request->data['Movie']['andor']) ? $this->request->data['Movie']['andor'] : null;
        //     $word = $this->Movie->multipleKeywords($this->request->data['Movie']['keyword'], $andor);
        //     $req = array_merge($req, array("word" => $word));
        // }

        // $this->paginate = array(

        $paginate = array(
            'conditions' => array('genre_id' => $genre_id)
        );
        debug(array_merge($this->Movie->parseCriteria($this->passedArgs), array('genre_id' => $genre_id)));
        $this->set('movies', $this->paginate('Movie'));

        $movie_names = $this->Movie->find('list');
        $this->set(compact('movie_names'));

    }

    public function view($movie_id = null) {
        
        $comments = $this->Comment->find('all', array('condition' =>array('movie_id' => 'id')));

        $this->set(compact('movies', 'comments'));

        $this->request->data['Favarite']['user_id'] = $this->Auth->user('id');
       // $this->set('checkuser', $checkuser);

        $checkuser = $this->Auth->user('username');
        $this->set('checkuser', $checkuser);

//ユーザーがログインしていたら履歴に追加 
        if($checkuser !== null){
        $WatchHistory['WatchHistory'] = array(
            'movie_id' => $movie_id,
            'user_id' => $this->Auth->user('id'),
            'created' => null
            );

        $this->WatchHistory->save($WatchHistory);
        }

// ムービーを見た回数を追加する機能
        $fields = array(
            'Play_count' => 'play_count+1' 
            );
        $conditions = array(
            'Movie.id' => $movie_id
            );
         $this->Movie->updateAll($fields, $conditions);
//          // $this->Movie->save($play_count);
         // $this->request->data['Movie']['play_count'] = 'play_count' + 1;
//         // ーーーーーーーー＞＞＞＞＞＞＞＞＞ここまで

        if (!$movie_id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $movie = $this->Movie->findById($movie_id);
        if (!$movie) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('movie', $movie);
    }

   public function add() {
   //     $this->layout = 'changePractice';
        $Genres = $this->Genre->find('list',array('fields'=>array('id','genre_title')));
        $this->set('Genres', $Genres);

        if ($this->request->is('post')) {
            $this->Movie->create();
            debug($this->request->data);
            // debug($_FILES);
            $this->request->data['Movie']['movie_tag'] = $this->_embTag($this->request->data['Movie']['movie_tag']);

            if ($this->Movie->save($this->request->data)) {
                $this->Session->setFlash(__('The Movie has been saved.'));
                // return $this->redirect(array('action' => 'index'));
            }

        // idでファイル名を作成
        
        $last_id = $this->Movie->getLastInsertID();

        $new_file_name = 'P'.str_pad($last_id, 5, '0', STR_PAD_LEFT);

        if (is_uploaded_file($this->request->data['Movie']['upfile']['tmp_name'])) {
        //　左のファイルを右の場所に.以降の名前で保存する。 
            if(move_uploaded_file($this->request->data['Movie']['upfile']['tmp_name'],'/var/www/html/DDDance/app/webroot/files/'.$new_file_name)){
                // chmod('files/' . $this->request->data['Movie']['thumbnail']['name'], 0644);
            echo 'アップロードしました。';
            } else {
            echo 'ファイルをアップロードできません。';
             }
// indexに戻る処理
             $this->redirect($this->Auth->redirect());
            } else {
            echo 'ファイルが選択されていません。';
            }

            $this->Session->setFlash(__('Unable to add the Movie.'));
        }
    }

    public function edit($id = null) {
            $Genres = $this->Genre->find('list',array('fields'=>array('id','genre_title')));
            $this->set('Genres', $Genres);

        if (!$id) {
            throw new NotFoundException(__('Invalid movie'));
        }

        $movie = $this->Movie->findById($id);
        if (!$movie) {
            throw new NotFoundException(__('Invalid movie'));
        }

        if ($this->request->is(array('movie', 'put'))) {
            $this->Movie->id = $id;
            if ($this->Movie->save($this->request->data)) {
                $this->Session->setFlash(__('The Movie has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update the Movie.'));
        }

        if (!$this->request->data) {
            $this->request->data = $movie;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Movie->delete($id)) {
            $this->Session->setFlash(__('The user with id: %s has been deleted.', h($id)));
            return $this->redirect(array('action' => 'index'));
        }
    }

    function _embTag($src){
    $emb1 = strstr($src, "v=");
    $ampersand = strpos($emb1, "&") ;
    
        if($ampersand){
            $emb2 = mb_substr($emb1, 0, $ampersand);
        }else{
            $emb2 = $emb1;
        }
    $emb = mb_substr($emb2, 2);
    //return $emb;
    return $this->request->data['Movie']['movie_tag'] = ' <iframe width="640" height="480" src="http://www.youtube.com/embed/'.$emb.'" frameborder="0" allowfullscreen></iframe> ';

}

    public function search() {
        // 常に前回検索した値がフォームに残るように、dataに値を設定します
        $this->request->data['Post'] = $this->request->query;

        // Search pluginが提供するparseCriteriaメソッドを使います
        $cond = $this->Post->parseCriteria($this->request->data['Post']);

        $this->set('posts', $this->paginate('Post', $cond));
    }

}
?>