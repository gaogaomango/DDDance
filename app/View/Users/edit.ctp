<!-- File: /app/View/Categories/edit.ctp -->

<h1>Edit User</h1>
<?php
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->input('group_id',array('options'=> $Groups));
//echo $this->Form->input('description', array('rows' => '3'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save User');
?>