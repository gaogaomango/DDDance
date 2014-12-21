<!-- File: /app/View/Comment/add.ctp -->

<h1>Add Comment</h1>
<?php
echo $this->Form->create('Comment');
echo $this->Form->input('user_id', array('controller' => 'comments', 'type' => 'hidden', 'value' => $userSession['id']));
echo $this->Form->input('movie_id',array('controller' => 'comments', 'type' => 'hidden', 'value' => $movie_id));
echo $this->Form->input('genre_id',array('controller' => 'comments', 'type' => 'hidden', 'value' => $genre_id));
echo $this->Form->input('comment', array('rows' => '3'));
echo $this->Form->end('Save Comment');
?>