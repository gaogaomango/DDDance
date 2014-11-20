<!-- File: /app/View/Groups/edit.ctp -->

<h1>Edit Group</h1>
<?php
echo '管理者かユーザーかのグループを決める登録フォームの編集';
echo $this->Form->create('Group');
//echo $this->Form->input('ID');
echo $this->Form->input('name');
//echo $this->Form->input('description', array('rows' => '3'));
//echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Group');
?>