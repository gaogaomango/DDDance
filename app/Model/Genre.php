<?php 
class Genre extends AppModel {
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
    public $hasMany = array('Movie', 'Favarite', 'Post');
}
?>