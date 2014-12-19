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

    public $uses = array('Movie', 'User', 'Genre', 'WatchHistory', 'Comment');

    public function beforeFilter() {

        parent ::beforeFilter();

        $this->layout = 'dddanceMovie';

        $this->Auth->allow();
    }

    public function index() {

    	$movies = $this->Movie->find('all');

        // Categoryモデルを使ってデータを取得
        $users = $this->User->find('all');

        $genres = $this->Genre->find('all');

// recursiveはアソシエーションの感想設定　-1は自分、0は一つ先まで
        // $this->WatchHistory->recursive = -1;
        // $this->WatchHistory->virtualFields[] = 0;

        // コントローラーの中ではグローバル変数使えないので新たに定義
        $userSession = $this->Auth->user();

    // max(id)がうまく書けないので直接SQL文を書く
        if($userSession !== null){
        $watchhistories_id = $this->WatchHistory->query('select max(id), movie_id 
             from watch_histories where user_id ='.$this->Auth->user('id').' group by movie_id order by max(id) DESC limit 7'
             );

        // debug(array($watchhistories_id));
        // debug(array($watch_id));
 // 直接SQL文を書かないやり方
             $watchidid = array();
                foreach ($watchhistories_id as $watchid):
                // $watch_id = $watch_id['max(id)'];
            $watchidid[] = $watchid[0]['max(id)'];
                endforeach;
                // debug($watchidid);
                // debug($watchid[0]['max(id)']);

        $watchhistories = $this->WatchHistory->find('all',
            array('conditions' => array('WatchHistory.user_id' => $this->Auth->user('id'),
                'WatchHistory.id' => $watchidid
                ),
            'group' => array('WatchHistory.movie_id'),    
            // 'order' => array('WatchHistory.id' => 'DESC'),
            // 'limit' => 7
            

        // $watchhistories = $this->WatchHistory->query('select max(id), movie_id 
        //     from watch_histories where user_id ='.$this->Auth->user('id').' group by movie_id order by max(id) DESC limit 7');

            )
            );

        }
        $comments = $this->Comment->find('all');

    	$this->set(compact('movies', 'users', 'genres', 'watchhistories', 'comments'));
    
        $this->Movie->recursive = 0;
        $this->Prg->commonProcess();
        // $req = $this->passedArgs;

        // if (!empty($this->request->data['Movie']['keyword'])) {
        //     $andor = !empty($this->request->data['Movie']['andor']) ? $this->request->data['Movie']['andor'] : null;
        //     $word = $this->Movie->multipleKeywords($this->request->data['Movie']['keyword'], $andor);
        //     $req = array_merge($req, array("word" => $word));
        // }

        // 以前まではpaginateに上書きしてたからうまく行かなかった！
        // debug($this->request->data);
        if(isset($this->request->data['Movie']['search_type'])){
        if($this->request->data['Movie']['search_type'] > 0){
        $this->paginate['conditions'] = $this->Movie->parseCriteria($this->passedArgs);
        }
        else
        {
        $this->paginate['conditions'] = $this->Movie->parseCriteria($this->passedArgs);
        unset($this->paginate['conditions']['Genre.id']);
        }
        }else{
            $this->paginate['conditions'] = $this->Movie->parseCriteria($this->passedArgs);      
        } 
    
        $this->set('movies', $this->paginate('Movie'));

        $movie_names = $this->Movie->find('list');
        $this->set(compact('movie_names'));
        

    }

    public function genre_index($genre_id = null){

        // $movies = $this->Movie->find('all', array('conditions' => array('genre_id' =>$genre_id)));

        // Categoryモデルを使ってデータを取得
        $users = $this->User->find('all');

        $selectedGenre = $this->Genre->find('all', array('conditions' => array('id' => $genre_id)));

        $genres = $this->Genre->find('all');

        $userSession = $this->Auth->user();
    // max(id)がうまく書けないので直接SQL文を書く
        if($userSession !== null){
        $watchhistories_id = $this->WatchHistory->query('select max(id), movie_id 
            from watch_histories where (user_id ='.$this->Auth->user('id').') and (genre_id='.$genre_id.') 
            group by movie_id order by max(id) DESC limit 7'
                         );

        // debug(array($watchhistories_id));
        // debug(array($watch_id));
 // 直接SQL文を書かないやり方
             $watchidid = array();
                foreach ($watchhistories_id as $watchid):
                // $watch_id = $watch_id['max(id)'];
                $watchidid[] = $watchid[0]['max(id)'];
                endforeach;
                // debug($watchidid);
                // debug($watchid[0]['max(id)']);

        $watchhistories = $this->WatchHistory->find('all',
            array('conditions' => array('WatchHistory.user_id' => $this->Auth->user('id'),
                'WatchHistory.id' => $watchidid
                ),
            'group' => array('WatchHistory.movie_id'),    
            // 'order' => array('WatchHistory.id' => 'DESC'),
            // 'limit' => 7
            

        // $watchhistories = $this->WatchHistory->query('select max(id), movie_id 
        //     from watch_histories where user_id ='.$this->Auth->user('id').' group by movie_id order by max(id) DESC limit 7');

            )
            );

        // $watchhistories = $this->WatchHistory->find('all',
        //     array('conditions' => array('WatchHistory.user_id' => $this->Auth->user('id'), 'WatchHistory.genre_id' => $genre_id),
        //     'order' => array('WatchHistory.created' => 'DESC'),
        //     'limit' => 7
        //     )
        //     );
        }

        $comments = $this->Comment->find('all');

        $this->set(compact('movies', 'users', 'genres', 'watchhistories', 'comments', 'selectedGenre'));
    
        $this->Movie->recursive = 0;
        $this->Prg->commonProcess();

        // $req = $this->passedArgs;

        // if (!empty($this->request->data['Movie']['keyword'])) {
        //     $andor = !empty($this->request->data['Movie']['andor']) ? $this->request->data['Movie']['andor'] : null;
        //     $word = $this->Movie->multipleKeywords($this->request->data['Movie']['keyword'], $andor);
        //     $req = array_merge($req, array("word" => $word));
        // }

        $this->paginate = array(
           'conditions' => array_merge($this->Movie->parseCriteria($this->passedArgs), array('genre_id' => $genre_id)),
            'limit' => 7,
            'order'=>array(
                'Movie.created' => 'desc'
            )
        );
        // debug(array_merge($this->Movie->parseCriteria($this->passedArgs), array('genre_id' => $genre_id)));
        $this->set('movies', $this->paginate('Movie'));

        $movie_names = $this->Movie->find('list');
        $this->set(compact('movie_names'));

    }

    public function view($movie_id, $genre_id) {

        $userSession = $this->Auth->user();
    // max(id)がうまく書けないので直接SQL文を書く
        if($userSession !== null){
        $watchhistories_id = $this->WatchHistory->query('select max(id), movie_id 
            from watch_histories where (user_id ='.$this->Auth->user('id').') and (genre_id='.$genre_id.') 
            group by movie_id order by max(id) DESC limit 7'
                         );

        // debug(array($watchhistories_id));
        // debug(array($watch_id));
 // 直接SQL文を書かないやり方
             $watchidid = array();
                foreach ($watchhistories_id as $watchid):
                // $watch_id = $watch_id['max(id)'];
                $watchidid[] = $watchid[0]['max(id)'];
                endforeach;
                // debug($watchidid);
                // debug($watchid[0]['max(id)']);

        $watchhistories = $this->WatchHistory->find('all',
            array('conditions' => array('WatchHistory.user_id' => $this->Auth->user('id'),
                'WatchHistory.id' => $watchidid
                ),
            'group' => array('WatchHistory.movie_id'),    
            // 'order' => array('WatchHistory.id' => 'DESC'),
            // 'limit' => 7
            

        // $watchhistories = $this->WatchHistory->query('select max(id), movie_id 
        //     from watch_histories where user_id ='.$this->Auth->user('id').' group by movie_id order by max(id) DESC limit 7');

            )
            );

        // $watchhistories = $this->WatchHistory->find('all',
        //     array('conditions' => array('WatchHistory.user_id' => $this->Auth->user('id'), 'WatchHistory.genre_id' => $genre_id),
        //     'order' => array('WatchHistory.created' => 'DESC'),
        //     'limit' => 7
        //     )
        //     );
        }
        
        $comments = $this->Comment->find('all',
            array('conditions' => array('Comment.movie_id' => $movie_id), 
            'order' => array('Comment.created' => 'DESC'),
            // 'limit' => 7
            )
            );

        $selectedGenre = $this->Genre->find('all', array('conditions' => array('id' => $genre_id)));

        $genres = $this->Genre->find('all');


        $this->set(compact('movies', 'selectedGenre', 'genres', 'comments', 'watchhistories', 'movie_id', 'genre_id'));

        $this->request->data['Favarite']['user_id'] = $this->Auth->user('id');
       // $this->set('checkuser', $checkuser);

        // $checkuser = $this->Auth->user('username');
        // $this->set('checkuser', $checkuser);

//ユーザーがログインしていたら履歴に追加 
        if($userSession !== null){
        $WatchHistory['WatchHistory'] = array(
            'movie_id' => $movie_id,
            'user_id' => $this->Auth->user('id'),
            'created' => null,
            'genre_id' => $genre_id
            );

    // debug(array(
    //         'movie_id' => $movie_id,
    //         'user_id' => $this->Auth->user('id'),
    //         'created' => null,
    //         'genre_id' => $genre_id
    //         ));


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
        $genres = $this->Genre->find('list',array('fields'=>array('id','genre_title')));
        $this->set('genres', $genres);
        debug($this->request->is('post'));
        if ($this->request->is('post')) {
            $this->Movie->create();
            debug($this->request->data);

            $this->Movie->set($this->request->data);
            // debug($_FILES);
            // 先にバリデーションをかます。なぜなら変更した後にバリデーションした全部アウト
            if($this->Movie->validates() == true){
            $this->request->data['Movie']['movie_tag'] = $this->_embTag($this->request->data['Movie']['movie_tag']);
            $this->Movie->save($this->request->data, false);
            if ($this->Movie->save($this->request->data)) {
                $this->Session->setFlash(__('The Movie has been saved.'));
                // return $this->redirect(array('action' => 'index'));
            }

        // idでファイル名を作成
        
        $last_id = $this->Movie->getLastInsertID();
        debug($last_id);
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

            }
            
            $this->Session->setFlash(__('Unable to add the Movie.'));
        }
    }

    public function edit($id = null) {
            $genres = $this->Genre->find('list',array('fields'=>array('id','genre_title')));
            $this->set('genres', $genres);

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
    return $this->request->data['Movie']['movie_tag'] = ' <iframe width="640" height="480" src="http://www.youtube.com/embed/'.$emb.'?autoplay=1" frameborder="0" allowfullscreen></iframe> ';

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