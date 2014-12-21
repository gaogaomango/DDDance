<?php
class WatcHistoriesController extends AppController {
    public $helpers = array('Html', 'Form');

    public $components = array('Session');

    public $uses = array('Watch_history','User','Genre');

    public function index() {
    	$watch_histories = $this->Wathch_history->find('all');

        // Categoryモデルを使ってデータを取得
        $users = $this->User->find('all');

        $genres = $this->Genre->find('all');

    	$this->set(compact('watch_histories', 'users', 'genres'));

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

        $wathch_history = $this->Wathch_history->findById($id);
        if (!$wathch_history) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('wathch_history', $wathch_history);
    }

   public function add() {
   //     $this->layout = 'changePractice';
        $Genres = $this->Genre->find('list',array('fields'=>array('id','genre_title')));
        $this->set('Genres', $Genres);

        if ($this->request->is('post')) {
            $this->Wathch_history->create();
            debug($this->request->data);
            if ($this->Wathch_history->save($this->request->data)) {
                $this->Session->setFlash(__('The Wathch_history has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add the Wathch_history.'));
        }
    }

public function edit($id = null) {
        $Genres = $this->Genre->find('list',array('fields'=>array('id','genre_title')));
        $this->set('Genres', $Genres);
        
    if (!$id) {
        throw new NotFoundException(__('Invalid watch_history'));
    }

    $watch_history = $this->Watch_history->findById$id);
    if (!$watch_history) {
       throw new NotFoundException(__('Invalid Watch_history'));
    }
    if ($this->request->is(array('watch_history', 'put')) {
        $this->Watch_history->id = $id;
        if ($this->Watch_history->save($this->request->data)) {
            $this->Session->setFlash(__('The Watch_history has been updated.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update the Watch_history.'));
    }

    if (!$this->request->data) {
        $this->request->data = $watch_history;
    }
}

public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }

    if ($this->Watch_history->delete($id)) {
        $this->Session->setFlash(__('The user with id: %s has been deleted.', h($id)));
        return $this->redirect(array('action' => 'index'));
    }
}

}
?>