<?php
class FavaritesController extends AppController {
    public $helpers = array('Html', 'Form');

    public $components = array('Session');

    public $uses = array('Favarite','User','Movie');

    public function index() {
    	$favarites = $this->Favarite->find('all');

        // Categoryモデルを使ってデータを取得
        $users = $this->User->find('all');

        $movies = $this->Movie->find('all');

    	$this->set(compact('favarites', 'users', 'movies'));

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

        $favarite = $this->Favarite->findById($id);
        if (!$favarite) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('favarite', $favarite);
    }

   public function add($movie_id) {
   //     $this->layout = 'changePractice';
        // $Genres = $this->Genre->find('list',array('fields'=>array('id','genre_title')));
        // $this->set('Genres', $Genres);

        if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
        }

        if ($this->request->is('post')) {
            $this->Favarite->create('Favarite');
            // debug($this->request->data);

            $this->request->data['Favarite']['movie_id'] = $movie_id;
            $this->request->data['Favarite']['user_id'] = $this->Auth->user('id');


        if ($this->Favarite->save($this->request->data)) {
            $this->Session->setFlash(__('The Favarite has been saved.'));
              return $this->redirect(array('controller' =>'movies', 'action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add the Favarite.'));
        }
    }

public function edit($id = null) {
        // $Genres = $this->Genre->find('list',array('fields'=>array('id','genre_title')));
        // $this->set('Genres', $Genres);
        
    if (!$id) {
        throw new NotFoundException(__('Invalid favarite'));
    }

    $favarite = $this->Favarite->findById($id);
    if (!$favarite) {
       throw new NotFoundException(__('Invalid favarite'));
    }

    if ($this->request->is(array('favarite', 'put'))) {
        $this->Favarite->id = $id;
        if ($this->Favarite->save($this->request->data)) {
            $this->Session->setFlash(__('The Favarite has been updated.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update the Favarite.'));
    }

    if (!$this->request->data) {
        $this->request->data = $favarite;
    }
}

public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }

    if ($this->Favarite->delete($id)) {
        $this->Session->setFlash(__('The user with id: %s has been deleted.', h($id)));
        return $this->redirect(array('action' => 'index'));
    }
}

}
?>