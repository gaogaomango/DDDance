<?php
class CategoriesController extends AppController {
    public $helpers = array('Html', 'Form');

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
}

?>