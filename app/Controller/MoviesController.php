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

    // public function category_index($category_id = null) {
    //     $posts = $this->Post->find('all',array('conditions' => array('category_id' => $category_id)));

    //     //選択されたカテゴリーのデータを取得しておく
    //     $selectedCategory = $this->Category->find('all',array('conditions'=> array('id' => $category_id)));

    //     // Categoryモデルを使ってデータを取得
    //     $categories = $this->Category->find('all');

    //     $this->set(compact('posts', 'categories', 'selectedCategory'));

    // }

    public function view($movie_id = null) {
        $this->request->data['Favarite']['user_id'] = $this->Auth->user('id');
       // $this->set('checkuser', $checkuser);
       
        $WatchHistory['WatchHistory'] = array(
            'movie_id' => $movie_id,
            'user_id' => $this->Auth->user('id'),
            'created' => null
            );

        $this->WatchHistory->save($WatchHistory);

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

}
?>