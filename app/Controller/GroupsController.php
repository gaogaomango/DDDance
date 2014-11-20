<?php
class GroupsController extends AppController {
    public $helpers = array('Html', 'Form');

    public $components = array('Session');

//    public $uses = array('Post','Category');

    function beforeFilter() {
    parent::beforeFilter();
    // $this->Auth->allow();
    }

    public function index() {
    	$groups = $this->Group->find('all');

//        $categories = $this->User->find('all');

    	$this->set(compact('groups'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid group'));
        }       

        $group = $this->Group->findById($id);
        if (!$group) {
            throw new NotFoundException(__('Invalid group'));
        }
        $this->set('group', $group);
    }

   public function add() {
   //     $this->layout = 'changePractice';

        if ($this->request->is('post')) {
            $this->Group->create();
            debug($this->request->data);
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your post.'));
        }
    }

public function edit($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Invalid post'));
    }

    $group = $this->Group->findById($id);
    if (!$group) {
        throw new NotFoundException(__('Invalid post'));
    }

    if ($this->request->is(array('group', 'put'))) {
        $this->Group->id = $id;
        if ($this->Group->save($this->request->data)) {
            $this->Session->setFlash(__('Your post has been updated.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update your post.'));
    }

    if (!$this->request->data) {
        $this->request->data = $group;
    }
}

public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }

    if ($this->Group->delete($id)) {
        $this->Session->setFlash(__('The post with id: %s has been deleted.', h($id)));
        return $this->redirect(array('action' => 'index'));
    }
}

}
?>