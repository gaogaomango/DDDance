<?php
class WatchHistoriesController extends AppController {
    public $helpers = array('Html', 'Form');

    public $components = array('Session','Search.Prg');
    public $presetVars = true;

    public $uses = array('WatchHistory','User','Movie');

    public function index() {
    	$watchhistories = $this->WatchHistory->find('all');

        // Categoryモデルを使ってデータを取得
        $users = $this->User->find('all');

        $movies = $this->Movie->find('all');

    	$this->set(compact('watchhistories', 'users', 'movies'));

        //$this->set('posts', $this->Post->find('all'));
    
        $this->Movie->recursive = 0;
        $this->Prg->commonProcess();
        $req = $this->passedArgs;

        $this->paginate = array(
            'conditions' => $this->Movie->parseCriteria($this->passedArgs),
        );
        $this->set('movies', $this->paginate());

        $movie_names = $this->Movie->find('list');
        $this->set(compact('movie_names'));
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

        $watchhistory = $this->WatchHistory->findById($id);
        if (!$watchhistory) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('watchhistory', $watchhistory);
    }

   public function add() {
   //     $this->layout = 'changePractice';
        // $Genres = $this->Genre->find('list',array('fields'=>array('id','genre_title')));
        // $this->set('Genres', $Genres);

        if ($this->request->is('post')) {
            $this->Watchhistory->create();
            debug($this->request->data);
            if ($this->WatchHistory->save($this->request->data)) {
                $this->Session->setFlash(__('The Wathch_History has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add the Watch_History.'));
        }
    }

// public function edit($id = null) {
//         // $Genres = $this->Genre->find('list',array('fields'=>array('id','genre_title')));
//         // $this->set('Genres', $Genres);
        
//     if (!$id) {
//         throw new NotFoundException(__('Invalid watch_history'));
//     }

//     $watchhistory = $this->WatchHistory->findById($id);
//     if (!$watchhistory) {
//        throw new NotFoundException(__('Invalid watch_history'));
//     }

//     if ($this->request->is(array('watch_history', 'put'))) {
//         $this->WatchHistory->id = $id;
//         if ($this->WatchHistory->save($this->request->data)) {
//             $this->Session->setFlash(__('The Watch_History has been updated.'));
//             return $this->redirect(array('action' => 'index'));
//         }
//         $this->Session->setFlash(__('Unable to update the Watch_History.'));
//     }

//     if (!$this->request->data) {
//         $this->request->data = $watchhistory;
//     }
// }

public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }

    if ($this->WatchHistory->delete($id)) {
        $this->Session->setFlash(__('The user with id: %s has been deleted.', h($id)));
        return $this->redirect(array('action' => 'index'));
    }
}

}
?>