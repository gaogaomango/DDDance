<!-- File: /app/View/Movies/edit.ctp -->

<h1>Edit Movie</h1>
<?php
echo $this->Html->link("トップページへ", array('action' => 'index'));
echo $this->Form->create('Movie',array('enctype' => 'multipart/form-data'));
echo $this->Form->input('movie_name');
// ここにムービータグを付ける
echo 'ページのURLを貼ってね';
echo $this->Form->input('movie_tag');
echo $this->Form->input('upfile', array('type' => 'file'));
echo $this->Form->input('discription');
echo $this->Form->input('genre_id',array('options'=> $Genres));
//echo $this->Form->input('description', array('rows' => '3'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Movie');
?>
