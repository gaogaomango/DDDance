<?php
class GenresController extends AppController {
    public $helpers = array('Html', 'Form');

    public $components = array('Session');

    public $uses = array('Genre');

    public function index() {
    	$genres = $this->Genre->find('all');

    	$this->set(compact('genres'));

    }

    // public function view($id = null) {
    //     if (!$id) {
    //         throw new NotFoundException(__('Invalid post'));
    //     }

    //     $user = $this->User->findById($id);
    //     if (!$user) {
    //         throw new NotFoundException(__('Invalid post'));
    //     }
    //     $this->set('user', $user);
    // }

   // public function add() {
   // //     $this->layout = 'changePractice';
   //      $Groups = $this->Group->find('list');
   //      $this->set('Groups', $Groups);

   //      if ($this->request->is('post')) {
   //          $this->User->create();
   //          debug($this->request->data);
   //          if ($this->User->save($this->request->data)) {
   //              $this->Session->setFlash(__('The User has been saved.'));
   //              return $this->redirect(array('action' => 'index'));
   //          }
   //          $this->Session->setFlash(__('Unable to add the User.'));
   //      }
   //  }

// public function edit($id = null) {
//         $Groups = $this->Group->find('list');
//         $this->set('Groups', $Groups);
//     if (!$id) {
//         throw new NotFoundException(__('Invalid user'));
//     }

//     $user = $this->User->findById($id);
//     if (!$user) {
//         throw new NotFoundException(__('Invalid user'));
//     }

//     if ($this->request->is(array('user', 'put'))) {
//         $this->User->id = $id;
//         if ($this->User->save($this->request->data)) {
//             $this->Session->setFlash(__('The User has been updated.'));
//             return $this->redirect(array('action' => 'index'));
//         }
//         $this->Session->setFlash(__('Unable to update the User.'));
//     }

//     if (!$this->request->data) {
//         $this->request->data = $user;
//     }
// }

// public function delete($id) {
//     if ($this->request->is('get')) {
//         throw new MethodNotAllowedException();
//     }

//     if ($this->User->delete($id)) {
//         $this->Session->setFlash(__('The user with id: %s has been deleted.', h($id)));
//         return $this->redirect(array('action' => 'index'));
//     }
// }

}
?>