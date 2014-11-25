<?php
class MoviesController extends AppController {
    public $helpers = array('Html', 'Form');

    public $components = array('Session');

    public $uses = array('Movie','User','Genre', 'WatchHistory');

    public function index() {
    	$movies = $this->Movie->find('all');

        // Categoryモデルを使ってデータを取得
        $users = $this->User->find('all');

        $genres = $this->Genre->find('all');

    	$this->set(compact('movies', 'users', 'genres'));
    
    // ユーザーネームの確認用変数 
        $checkuser = $this->Auth->user('username');
        $this->set('checkuser', $checkuser);

        //$this->set('posts', $this->Post->find('all'));
    }

    public function view($movie_id = null) {
        $this->request->data['Favarite']['user_id'] = $this->Auth->user('id');
       // $this->set('checkuser', $checkuser);
       
        $WatchHistory['WatchHistory'] = array(
            'movie_id' => $movie_id,
            'user_id' => $this->Auth->user('id'),
            'created' => null
            );

        $this->WatchHistory->save($WatchHistory);


// 要変更箇所！！！！！！！！！！！！！！！！！！！！！！
        // 更新する内容を設定
        // $Play_counts = $this->Movie->find('all', array('fields' => array('id', 'play_count')));
        // $Play_counts = $Play_counts + 1;
        // $this->set('Play_counts', $Play_counts);
 
        // 更新する項目（フィールド指定）
        // $fields = array('play_count');

        // 更新する内容を設定
//         $data = array('Movie' => array('id' => $movie_id, 'play_count' => ++1));
 
// // 更新する項目（フィールド指定）
// $fields = array('play_count');
 
// // 更新
// $this->Movie->save($data, false, $fields);
 
        // 更新
        // if(isset($this->Movie->data['Movie']['play_count'])) {
        //     $num = (int)$this->Movie->data['Movie']['play_count'];
        //     $num++;
        // }
        $this->Movie->update('all', array('fields' => array('id', 'play_count')));
         // $this->Movie->save($play_count);
        $this->request->data['Movie']['play_count'] = 'play_count' + 1;
        // ーーーーーーーー＞＞＞＞＞＞＞＞＞ここまで

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

    public function embTag($src){
    $emb1 = strstr($src, "v=");
    $ampersand = strpos($emb1, "&") ;
    
        if($ampersand){
            $emb2 = mb_substr($emb1, 0, $ampersand);
        }else{
            $emb2 = $emb1;
        }
    $emb = mb_substr($emb2, 2);
    return $emb;
    $this->request->data['Movie']['movie_tag'] = ' <iframe width="640" height="480" src="http://www.youtube.com/embed/'.$embCode.'" frameborder="0" allowfullscreen></iframe> ';

}

}
?>