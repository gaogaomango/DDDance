<?php
class GoodsController extends AppController {
    public $helpers = array('Html', 'Form');

    public $components = array('Session');

    public $uses = array('Good','User','Genre', 'Movie');

    public function index() {
    	$goods = $this->Good->find('all');

        // Categoryモデルを使ってデータを取得
        $users = $this->User->find('all');

        $genres = $this->Genre->find('all');

    	$this->set(compact('goods', 'users', 'genres'));

        //$this->set('posts', $this->Post->find('all'));
    }
   public function add($movie_id) {
   //     $this->layout = 'changePractice';
         // $Movies = $this->Movie->find('list',array('fields'=>array('id','movie_name')));
         // $this->set('Movies', $Movies);

         // $Users = $this->User->find('list',array('fields'=>array('id','username')));
         // $this->set('Users', $Users);

        if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
        }

        $goods = $this->Good->find('all');
        $movies = $this->Movie->find('all',array('conditions' => array('Movie.id' => $movie_id)));
        $this->set(compact('goods', 'movies'));

        if ($this->request->is('post')){
            foreach ($goods as $good):
                if($movie_id == $good['Good']['movie_id'] && $good['Good']['user_id'] == $this->Auth->user('id')){
                    $fields = array('Good.good_number' => 'Good.good_number+1' );
                    $conditions = array('movie_id' => $movie_id);
                    $this->Good->updateAll($fields, $conditions);
                    // $this->Movie->find('all',array('conditions' => array('Movie.id' => $movie_id))) = 'good_number';
                    // $fields = array('Movie.good_number' => 'Good.good_number' );
                    // $conditions = array('movie_id' => $movie_id);
                    // $this->Movie->updateAll($fields, $conditions);
                        return $this->redirect(array('controller'=>'movies', 'action' => 'index'));
                    }
            endforeach;

            
            $this->Good->create('Good');
            // debug($this->request->data);
            //$this->Good->input('user_ID');
            //$this->Good->input('movie_ID');

            $this->request->data['Good']['movie_id'] = $movie_id;
            $this->request->data['Good']['user_id'] = $this->Auth->user('id');

            $this->request->data['Good']['good_number'] = 1;


    // カウントを増やして登録するコード
        if ($this->Good->save($this->request->data)) {
            $this->Session->setFlash(__('The Good has been saved.'));
                return $this->redirect(array('controller'=>'movies', 'action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add the Good.'));
        }
    }



// public function delete($id) {
//     if ($this->request->is('get')) {
//         throw new MethodNotAllowedException();
//     }

//     if ($this->Good->delete($id)) {
//         $this->Session->setFlash(__('The user with id: %s has been deleted.', h($id)));
//         return $this->redirect(array('action' => 'index'));
//     }
// }

}
?>