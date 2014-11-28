<?php 
class Movie extends AppModel {

    public $order = array('Movie.id DESC');
    public $actsAs = array('Search.Searchable');
    public $filterArgs = array(
        // 'movie_name' => array('type' => 'value'),
        'keyword' => array('type' => 'like', 
            'field' => array('Movie.movie_name', 'Genre.genre_title', 'Movie.discription'),
        'connectorAnd' => '+', 'connectorOr' => ' '),
    );

// 検索機能の&とorを手動で切り替える方法
//     public function multipleKeywords($keyword, $andor = null) {
//         $connector = ($andor === 'or') ? ',' : '+';
//         $keyword = preg_replace('/\s+/', $connector, trim(mb_convert_kana($keyword, 's', 'UTF-8')));
   
//         return $keyword;
// }


    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

      public $belongsTo = array('Genre','User');
      public $hasMany = array('Comment', 'Watch_history', 'Good', 'Favarite');
    // public $hasMany = 'Favarite';
    // public $hasMany = 'Good';
}
?>