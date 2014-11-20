<!-- File: /app/View/User/add.ctp -->

<h1>Add User</h1>
<?php
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->input('group_id',array('options'=> $Groups));
//echo $this->Form->input('description', array('rows' => '3'));
// echo $this->Form->input('Save Point', array('type' => 'submit'));
// echo $this->Form->end();
echo $this->Form->end('Save User');
?>