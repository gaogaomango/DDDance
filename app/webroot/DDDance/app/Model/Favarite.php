<?php 
class Favarite extends AppModel {
    public $order = array('Movie.id DESC');
    public $actsAs = array('Search.Searchable');
    public $filterArgs = array(
        // 'movie_name' => array('type' => 'value'),
        'keyword' => array('type' => 'like', 
            'field' => array('Movie.movie_name', 'Genre.genre_title', 'Movie.discription'),
        'connectorAnd' => '+', 'connectorOr' => ' '),
    );
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

    public $belongsTo = array('Movie', 'User', 'Genre');
    // public $hasMany = 'Comment';
    // public $hasMany = 'Favarite';
    // public $hasMany = 'Good';
    // public $hasMany = 'Watch_history';
}
?>