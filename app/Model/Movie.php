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
            'movie_name' =>
            
             array('rule' => 'notEmpty',

            'message' => '動画の名前を入力してください'
            ),
// 数字以外の時にエラーを吐くコード
            // 'numeric' =>

            // array('rule' => 'numeric',

            // 'message' => '動画の入力が不正です',

            // 'allowEmpty' => true,

            // )
            
// バリデーションがーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー！
        // 'movie_tag'　=> 

        //      array('rule' => 'notEmpty',

        //     'message' => '動画のurlを入力してください'
        //     ),
        // 'upfile'　=> array('rule' => 'notEmpty',

        //     'message' => 'サムネイルを選択してください'
        //     ),
        // 'discription'　=> array('rule' => 'notEmpty',

        //     'message' => '動画の説明を入力してください'
        //     )
    );

      public $belongsTo = array('Genre','User');
      public $hasMany = array('Comment', 'Watch_history', 'Good', 'Favarite');
    // public $hasMany = 'Favarite';
    // public $hasMany = 'Good';
}
?>