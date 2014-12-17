<!-- File: /app/View/Users/index.ctp -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>DDDance</title>
     <!-- HTML5 -->
<!-- <link rel="stylesheet" href="css/style.css" media="screen and (max-width:6400px)">
<link rel="stylesheet" href="css/medium.css" media="screen and (min-width:640px) and (max-width:1536px)">
<link rel="stylesheet" href="css/wide.css" media="screen and (min-width:1024px)"> -->

<?php $this->Html->scriptStart(array('inline'=>false)); ?>

$(document).ready(function(){
  
  var $searchTrigger = $('[data-ic-class="search-trigger"]'),
      $searchInput = $('[data-ic-class="search-input"]'),
      $searchClear = $('[data-ic-class="search-clear"]');

     $('#genre_choice').hide();
     $('#search_end').hide();
     
  
  $searchTrigger.click(function(){
    
    var $this = $('[data-ic-class="search-trigger"]');
    $this.addClass('active');
    $searchInput.focus();
    
    $('#genre_choice').toggle('slow');
    $('#search_end').toggle('slow');
     
  });
  
  $searchInput.blur(function(){
    
    if($searchInput.val().length > 0){
      
      return false;
      
    } else {
      
      $searchTrigger.removeClass('active');
      $('#genre_choice').hide();
      $('#search_end').hide();
     
    }
    
  });
  
  $searchClear.click(function(){
    $searchInput.val('');
  });
  
  $searchInput.focus(function(){
    $searchTrigger.addClass('active');
  });
  
});
<?php $this->Html->scriptEnd(); ?>

</head>

<!-- movie index -->
<div>
<body>
<header>    
    <div id="header-fixed">
        <div id = "header-bk">
            <div id = "header"> 
            <h1 class = "title">DDDance</h1>
            <p><?php echo 'ユーザー情報', $userSession['username']; ?></p>
                <div class = "header-fixed_login-search">
                <div class="login-btn">
                <!-- <a href="javascript:return false;" class="btn-push login"> -->
                     <?php
                     if($userSession['username'] == null){
                     echo $this->Html->link(
                     'ユーザーログイン', array('controller' => 'users', 'action' => 'login'),
                     array('class' => array('btn-push','login')));


                     echo $this->Html->link('ユーザー登録', 
                     array('controller' => 'users', 'action' => 'add'),
                     array('class' => array('btn-push','login')));

                    }else{
                     echo $this->Html->link('ユーザーログアウト', 
                     array('controller' => 'users', 'action' => 'logout'),
                     array('class' => array('btn-push','login')));
                    }
                      ?>
                <!-- </a> -->
                <!-- <a href="javascript:return false;" class="btn-push login">ログアウト</a>
                <a href="javascript:return false;" class="btn-push login">ユーザー登録</a> -->
                </div>

                    <div class="search_bar">
                        <?php echo $this->Form->create('Movie', array('action'=>'index')); ?>
<!-- <fieldset>
    <legend>検索</legend>
</fieldset> -->

 <!-- 検索機能の全体検索かジャンル検索かを手動で切り替える方法 -->
<!--                     <div class="control-group">
                        <?php echo $this->Form->label('keyword', '', array('class' => 'control-label')); ?> -->
                            <!-- <div class="controls"> -->
                                <div class="wrapper">
                                  <div class="icon-search-container" data-ic-class="search-trigger">
                                    <span class="fa fa-search"></span>
                                     <!-- <input type="text" class="search-input" data-ic-class="search-input" placeholder="Search"/>  -->
                                     <?php echo $this->Form->text('keyword', array('class' => 'search-input', 'data-ic-class' =>'search-input', 'placeholder' => '検索内容')); ?>
                                
                                    <span class="fa fa-times-circle" data-ic-class="search-clear"></span>
                                  </div>
                                </div>
                                <div id='genre_choice'>
                               <?php 
                                 // echo $this->Form->text('keyword', array('class' => 'span12', 'placeholder' => '検索内容'));       
                                $options = array(
                                    -1 => '全体検索',
                                    1 => 'HIPHOP',
                                    2 => 'HOUSE',
                                    3 => 'LOCK',
                                    4 => 'POP',
                                    5 => 'SOUL',
                                    6 => 'BREAK'
                                    )
                                    ;
                                    $attributes = array('default' => -1, 'class' => 'radio inline');
                                     
                                    echo $this->Form->radio('search_type', $options, $attributes);
                                ?>
                                </div>
                            </div>
                    <!-- </div> -->
    <div id='search_end'>
        <?php echo $this->Form->end(); ?>
    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>  
</header>
<NAV>

<div class="fixposition2 no-kaigyou">
    <a href="javascript:return false;" class="btn-push">ホーム</a>
    <a href="javascript:return false;" class="btn-push navy">HIPHOP</a>
    <a href="javascript:return false;" class="btn-push green">HOUSE</a>
    <a href="javascript:return false;" class="btn-push red">POP</a>
    <a href="javascript:return false;" class="btn-push blue">LOCK</a>
    <a href="javascript:return false;" class="btn-push orange">BREAKING</a>
    <a href="javascript:return false;" class="btn-push navy">お気に入り</a>
    <a href="javascript:return false;" class="btn-push green">履歴</a>
    <a href="javascript:return false;" class="btn-push red">ジャンル掲示板</a>
    <a href="javascript:return false;" class="btn-push blue">動画投稿</a>
<!-- こいつを上の動画投稿にくっつける！！！！！！！！ -->
                        <!-- if($userSession['username'] !== null){
                            echo $this->Html->link('Add Movie', array('action' => 'add'));
                       }else{
                            echo 'Add Movie';
                        } -->

</div>

</NAV>

     <?php
         echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
         echo $this->Paginator->numbers(array('separator' => ''));
         echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
    ?>

<section id="section-fixed">
<table>
    <tr>
        <th><?php echo $this->Paginator->sort('id','ID')?></th>
        <th><?php echo $this->Paginator->sort('user_id','USER_ID')?></th>
        <th><?php echo $this->Paginator->sort('genre_id','GENRE_ID')?></th>
        <th><?php echo $this->Paginator->sort('movie_name','MOVIE_NAME')?></th>
        <th>THUMBNAIL</th>
        <!-- <th><?php echo $this->Paginator->sort('movie_tag','MOVIE_TAG')?></th> -->
        <th><?php echo $this->Paginator->sort('discription','DISCRIPTION')?></th>
        <th><?php echo $this->Paginator->sort('play_count','PLAY_COUNT')?></th>
        <th>Action</th>
        <th>Action</th>
        <th><?php echo $this->Paginator->sort('created','CREATED')?></th>
        <th><?php echo $this->Paginator->sort('modified','MODIDIED')?></th>
        <th>Good!!</th>
        <th><?php echo $this->Paginator->sort('good','GOOD_NUMBER!!')?></th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($movies as $movie): ?>

    <tr>
        <td><?php echo $movie['Movie']['id']; ?></td>
        <td><?php echo $movie['User']['id']; ?></td>
        <td><?php echo $movie['Genre']['genre_title'];?></td>
        <td><?php echo $this->Html->link($movie['Movie']['movie_name'], array('action' => 'view', $movie['Movie']['id'], $movie['Movie']['genre_id'])); ?>
        </td>
        <td><?php echo $this->Html->link('<img src="http://192.168.33.10/DDDance/files/P'.str_pad($movie['Movie']['id'], 5, "0", STR_PAD_LEFT).'">', array('action' => 'view', $movie['Movie']['id'], $movie['Movie']['genre_id']), array('escape' => false)); ?>
        </td>
        <td><?php echo $movie['Movie']['discription'];?></td>
        <td><?php echo $movie['Movie']['play_count'];?></td>
<!--         <td><?php if(isset($movie['Watch_history'])){
            echo '再生回数 : ';
            echo count($movie['Watch_history']);
            echo '回';
            }else{
                echo '0だよーん';
            }
             ?>
        </td> -->
        <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $movie['Movie']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postlink('Delete', array('action' => 'delete', $movie['Movie']['id']),
                array('confirm' => 'Are you sure????????')); ?>
        </td>
        <td><?php echo $movie['Movie']['created']; ?></td>
        <td><?php echo $movie['Movie']['modified']; ?></td>
        <td><?php 
            if($userSession['username'] !== null){
                echo $this->Form->postlink('Add Favarite', array('controller' => 'favarites', 'action' => 'add', $movie['Movie']['id'], $movie['Genre']['id']));
            }else{
                echo 'add favarite';
        }
        ?>
        </td>
        <td><?php echo $this->Html->link('look favarite lists' , array('controller' => 'favarites', 'action' => 'index')); ?>
        </td>
        <td><?php 
            if($userSession['username'] !== null){
                echo $this->Form->postlink('Good!!', array('controller' => 'goods', 'action' => 'add', $movie['Movie']['id']));
            }else{
                echo 'Good!!';
        }
        ?>
        </td>
        <td><?php if(isset($movie['Good'])){
            echo count($movie['Good']);
            }else{
                echo '0';
            }
             ?>
        </td>
    </tr>
<?php endforeach; ?>
<?php unset($movie); ?>
</table>
</section>
</div>

<!-- genre index -->
<div>
<h1>Genre</h1>
<table>
    <tr>
        <th>genre_title</th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($genres as $genre): ?>
<!--     <tr>
        <td>
            <?php echo $this->Html->link($genre['Genre']['genre_title'], array('controller' => 'movies', 'action' => 'genre_index', $genre['Genre']['id'])); 
        ?>
        </td>
    </tr> -->

        <tr>
     <td>
        <?php 
            if (isset ($selectedGenre)){
                if ($selectedGenre[0]['Genre']['id'] == $genre['Genre']['id']){
                echo $genre['Genre']['genre_title'];
            }else{
                echo $this->Html->link($genre['Genre']['genre_title'], array('controller' => 'movies','action' => 'genre_index', $genre['Genre']['id']));
                 }
            }else{
                echo $this->Html->link($genre['Genre']['genre_title'], array('controller' => 'movies','action' => 'genre_index', $genre['Genre']['id']));
            }
        ?>
    </td>
    </tr>
    <?php endforeach; ?>
    <?php //unset($genre); ?>
</table>
</div>

<!-- watch_history index -->
<?php 
if($userSession['username'] !== null){
    ?>
<div>
<h1>WatchHistory</h1>
<!--     <div>
        <?php echo $this->Form->create('Movie', array('action'=>'index')); ?>
        <fieldset>
            <legend>検索</legend>
        </fieldset>
         <?php echo $this->Form->input('keyword', array('label' => '検索バー', 'class' => 'span12', 'placeholder' => '検索内容')); ?>
        <?php echo $this->Form->end('検索'); ?>
    </div> -->

<table>
    <tr>
        <th>Id</th>
        <th>User_ID</th>
        <th>Genre_ID</th>
        <th>Movie_Name</th>
        <th>Movie_tag</th>
        <th>Play_count</th>
        <th>Created</th>
    </tr>

    <p><?php echo 'ユーザー情報', $userSession['username']; ?></p>


    <?php

    foreach ($watchhistories as $watchhistory):  
           // debug($post);
    ?>
    <tr>
        <?php ?>
        <td><?php echo $watchhistory['Movie']['id']; ?></td>
        <td><?php echo $watchhistory['User']['id']; ?></td>
        <td><?php echo $watchhistory['Movie']['genre_id'];?></td>
        <td><?php echo $this->Html->link($watchhistory['Movie']['movie_name'], array('controller' => 'movies', 'action' => 'view', $watchhistory['Movie']['id'], $watchhistory['Movie']['genre_id'])); ?> 
        </td>
        <td><?php echo $this->Html->link('<img src="http://192.168.33.10/DDDance/files/P'.str_pad($watchhistory['Movie']['id'], 5, "0", STR_PAD_LEFT).'">', array('controller' => 'movies', 'action' => 'view', $watchhistory['Movie']['id'], $watchhistory['Movie']['genre_id']), array('escape' => false)); ?>
        </td>
        <td><?php echo $watchhistory['Movie']['play_count'];?></td>
        <td><?php echo $watchhistory['WatchHistory']['created']; ?></td>
    </tr>
<?php endforeach; ?>
<?php // unset($watch_history); ?>
</table>
</div>
<?php
}
else{
    echo '<h1>WatchHistory</h1>';
    echo 'ログインすれば履歴を見る事が出来ます';
}
?>

</body>