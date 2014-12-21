<!-- File: /app/View/Category/add.ctp -->

<h1>Add Category</h1>
<?php
echo $this->Form->create('Category');
echo $this->Form->input('name');
echo $this->Form->input('description', array('rows' => '3'));

// echo $this->Form->input('Save Point', array('type' => 'submit'));

// echo $this->Form->end();
echo $this->Form->end('Save Category');
?>