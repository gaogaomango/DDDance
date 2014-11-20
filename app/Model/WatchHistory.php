<?php 
class WatchHistory extends AppModel {
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

    public $belongsTo = array('Movie','User');
    // public $hasMany = 'Comment';
    // public $hasMany = 'Favarite';
    // public $hasMany = 'Good';
    // public $hasMany = 'Watch_history';
}
?>