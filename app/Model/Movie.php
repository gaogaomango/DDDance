<?php 
class Movie extends AppModel {
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

      public $belongsTo = array('Genre','User');
      public $hasMany = array('Comment','Watch_history');
    // public $hasMany = 'Favarite';
    // public $hasMany = 'Good';
}
?>