<!-- File: /app/View/Group/add.ctp -->

<h1>Add Group</h1>
<?php
echo '管理者かユーザーかのグループを決める登録フォーム';
echo $this->Form->create('Group');
//echo $this->Form->input('ID');
echo $this->Form->input('name');
//echo $this->Form->input('description', array('rows' => '3'));
// echo $this->Form->input('Save Point', array('type' => 'submit'));
// echo $this->Form->end();
echo $this->Form->end('Save Group');
?>