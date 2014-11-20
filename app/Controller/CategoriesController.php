<?php
class CategoriesController extends AppController {
    public $helpers = array('Html', 'Form');

    public $components = array('Session');

    public function beforeFilter(){
        parent::beforeFilter();

        $this->layout = 'changePractice';
        
    }

    public function index() {
        $categories = $this->Category->find('all');

    	  $this->set(compact('categories'));

      //  $this->set('categories', $this->Category->find('all'));
    }

   // public function view($id = null) {
   //      if (!$id) {
   //          throw new NotFoundException(__('Invalid categories'));
   //      }

   //      $post = $this->Post->findById($id);
   //      if (!$post) {
   //          throw new NotFoundException(__('Invalid categories2'));
   //      }
   //      $this->set('categories', $category);
   //  }

public function add() {
   //     $this->layout = 'changePractice';

        if ($this->request->is('post')) {
            $this->Category->create();
            debug($this->request->data);
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Your category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your category.'));
        }
    }

public function edit($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Invalid post'));
    }

    $category = $this->Category->findById($id);
    if (!$category) {
        throw new NotFoundException(__('Invalid post'));
    }

    if ($this->request->is(array('category', 'put'))) {
        $this->Category->id = $id;
        if ($this->Category->save($this->request->data)) {
            $this->Session->setFlash(__('Your post has been updated.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update your post.'));
    }

    if (!$this->request->data) {
        $this->request->data = $category;
    }
}

}

?>