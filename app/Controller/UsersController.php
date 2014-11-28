<?php
class UsersController extends AppController {
    public $helpers = array('Html', 'Form');

    public $components = array('Session');

    public $uses = array('User','Group');

    function beforeFilter() {
    parent::beforeFilter();
    // $this->Auth->allow();
    }

    public function index() {
    	$users = $this->User->find('all');

        // Categoryモデルを使ってデータを取得
        $groups = $this->Group->find('all');

    	$this->set(compact('users', 'groups'));

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

        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('user', $user);
    }

   public function add() {
   //     $this->layout = 'changePractice';
        $Groups = $this->Group->find('list');
        $this->set('Groups', $Groups);

        if ($this->request->is('post')) {
            $this->User->create();
            debug($this->request->data);
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The User has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add the User.'));
        }
    }

public function edit($id = null) {
        $Groups = $this->Group->find('list');
        $this->set('Groups', $Groups);
    if (!$id) {
        throw new NotFoundException(__('Invalid user'));
    }

    $user = $this->User->findById($id);
    if (!$user) {
        throw new NotFoundException(__('Invalid user'));
    }

    if ($this->request->is(array('user', 'put'))) {
        $this->User->id = $id;
        if ($this->User->save($this->request->data)) {
            $this->Session->setFlash(__('The User has been updated.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update the User.'));
    }

    if (!$this->request->data) {
        $this->request->data = $user;
    }
}

public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }

    if ($this->User->delete($id)) {
        $this->Session->setFlash(__('The user with id: %s has been deleted.', h($id)));
        return $this->redirect(array('action' => 'index'));
    }
}

public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('Your username or password was incorrect.');
            }
        }
    }

public function logout() {
        $this->Auth->logout();
    if ($this->Auth->logout()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('You can not logout!!!!!!!');
            }
    }

}
?>