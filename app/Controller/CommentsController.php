<?php
class CommentsController extends AppController {
    public $helpers = array('Html', 'Form');

    public $components = array('Session');

    public $uses = array('Comment','User','Movie');

    function beforeFilter() {
    
    parent::beforeFilter();
    
    $this->Auth->allow();

    }

    public function index() {
    	$comments = $this->Comment->find('all');

        $users = $this->User->find('all');

        // Categoryモデルを使ってデータを取得
        $movies = $this->Movie->find('all');

    	$this->set(compact('comments', 'users', 'movies'));

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

   public function add($movie_id) {
   //     $this->layout = 'changePractice';
        $comments = $this->Comment->find('list');
        $movies = $this->Movie->find('all');
        $users = $this->User->find('all');

        $this->set(compact('movies', 'movie_id', 'users'));
        $this->set('comments', $comments);

        $check_id = $this->Auth->user('id');
        $this->set('check_id', $check_id);

        if ($this->request->is('post')) {
            $this->Comment->create();
            debug($this->request->data);
            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash(__('The Comment has been saved.'));
                return $this->redirect(array('controller' => 'movies', 'action' => 'view'));
            }
            !!!!!!!!!!!!!!!!!!!!!!!!!元のムービのページに戻りターーーーーーーーい
            $this->Session->setFlash(__('Unable to add the Comment.'));
        }
    }

public function edit($id, $movie_id) {
        $comments = $this->Comment->find('list');
        $movies = $this->Movie->find('all');
        $users = $this->User->find('all');

        $this->set(compact('movies', 'movie_id'));
        
        $this->set('comments', $comments);
    if (!$id) {
        throw new NotFoundException(__('Invalid comment'));
    }

    $comment = $this->Comment->findById($id);
    if (!$user) {
        throw new NotFoundException(__('Invalid comment'));
    }

    if ($this->request->is(array('comment', 'put'))) {
        $this->Comment->id = $id;
        if ($this->Comment->save($this->request->data)) {
            $this->Session->setFlash(__('The Comment has been updated.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update the Comment.'));
    }

    if (!$this->request->data) {
        $this->request->data = $comment;
    }
}

public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }

    if ($this->Comment->delete($id)) {
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
    }

}
?>