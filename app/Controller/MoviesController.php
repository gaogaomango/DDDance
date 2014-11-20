<?php
class MoviesController extends AppController {
    public $helpers = array('Html', 'Form');

    public $components = array('Session');

    public $uses = array('Movie','User','Genre');

    public function index() {
    	$movies = $this->Movie->find('all');

        // Categoryモデルを使ってデータを取得
        $users = $this->User->find('all');

        $genres = $this->Genre->find('all');

    	$this->set(compact('movies', 'users', 'genres'));

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

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $movie = $this->Movie->findById($id);
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
            
            if (is_uploaded_file($this->request->data['Movie']['thumbnail']['tmp_name'])) {

            if (move_uploaded_file($this->request->data['Movie']['thumbnail']['tmp_name'], 'files/' . $this->request->data['Movie']['thumbnail']['name'])) {
                 chmod('files/' . $this->request->data['Movie']['thumbnail']['name'], 0644);
                 echo $this->request->data['Movie']['thumbnail']['name'] . 'をアップロードしました。';
                } else {
                echo 'ファイルをアップロードできません。';
                }
                } else {
                echo 'ファイルが選択されていません。';
                }

            if ($this->Movie->save($this->request->data)) {

                $this->Session->setFlash(__('The Movie has been saved.'));
                return $this->redirect(array('action' => 'index'));
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