<!-- File: /app/View/Comment/add.ctp -->

<h1>Add Comment</h1>
<?php
echo $this->Form->create('Comment');
echo $this->Form->input('user_id', array('controller' => 'comments', 'type' => 'hidden', 'value' => $check_id));
debug($check_id);
echo $this->Form->input('movie_id',array('controller' => 'comments', 'type' => 'hidden', 'value' => $movie_id));
echo $this->Form->input('comment', array('rows' => '3'));
// echo $this->Form->input('password');
// echo $this->Form->input('group_id',array('options'=> $Groups));
//echo $this->Form->input('description', array('rows' => '3'));
// echo $this->Form->input('Save Point', array('type' => 'submit'));
// echo $this->Form->end();
echo $this->Form->end('Save Comment');
?>