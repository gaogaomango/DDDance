<!-- File: /app/View/Movies/view.ctp -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
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
<div>
<body>
<header>    
    <div id="header-fixed">
        <div id = "header-bk">
            <div id = "header"> 
            <h1 class = "title">DDDance</h1>
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
                                  <p id = "user-info"><?php echo 'ユーザー情報', $userSession['username']; ?></p>
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
  <ul class="genre-list">


<!-- 今後の展望としてselectedGenreを使って、今いる場所のボタンは押せなくなったほうがいいかも！ -->
    <li><?php echo $this->Html->link("ホーム", array('controller' => 'movies', 'action' => 'index'), array('class' => array('btn-push'))); ?></li>
    <li><?php echo $this->Html->link('HIPHOP', array('controller' => 'movies', 'action' => 'genre_index', $genres[0]['Genre']['id'] => 1), array('class' => array('btn-push','navy'))); ?></li>
    <li><?php echo $this->Html->link('HOUSE', array('controller' => 'movies', 'action' => 'genre_index', $genres[0]['Genre']['id'] => 2), array('class' => array('btn-push','green'))); ?></li>
    <li><?php echo $this->Html->link('LOCK', array('controller' => 'movies', 'action' => 'genre_index', $genres[0]['Genre']['id'] => 3), array('class' => array('btn-push','orange'))); ?></li>
    <li><?php echo $this->Html->link('POP', array('controller' => 'movies', 'action' => 'genre_index', $genres[0]['Genre']['id'] => 4), array('class' => array('btn-push','navy'))); ?></li>
    <li><?php echo $this->Html->link('SOUL', array('controller' => 'movies', 'action' => 'genre_index', $genres[0]['Genre']['id'] => 5), array('class' => array('btn-push','green'))); ?></li>
    <li><?php echo $this->Html->link('BREAK', array('controller' => 'movies', 'action' => 'genre_index', $genres[0]['Genre']['id'] => 6), array('class' => array('btn-push','red'))); ?></li>
    <li><?php if($userSession['username'] !== null){
        echo $this->Html->link('お気に入り', array('controller' => 'favarites', 'action' => 'index'), array('class' => array('btn-push','blue')));
            }else{
        echo $this->Html->link('お気に入り', 'javascript:return false;', array('class' => array('btn-push','blue')), "ログイン後にお気に入り機能使えますよ");        
            }
         ?></li>
    
    <!-- アプリ版の履歴の見方を検討する必要あり！！！！！！！！！！！！リスト形式でダラーっと出てくる系？？？？ -->
    <li><?php if($userSession['username'] !== null){
        echo $this->Html->link('履歴', array('controller' => 'WatchHistories', 'action' => 'index', $userSession['username']), array('class' => array('btn-push','orange')));
            }else{
        echo $this->Html->link('履歴', 'javascript:return false;', array('class' => array('btn-push','orange')), "ログイン後に履歴も使えますよ！");        
            }
         ?></li>

    <li><?php echo $this->Html->link('ジャンル掲示板', 'javascript:return false;', array('class' => array('btn-push','navy')), "まだないです"); ?></li>

    <li><?php if($userSession['username'] !== null){
        echo $this->Html->link('動画投稿', array('action' => 'add'),array('class' => array('btn-push','blue')));
            }else{
        echo $this->Html->link('動画投稿', 'javascript:return false;', array('class' => array('btn-push','blue')), "ログイン後に動画投稿できます");
                         }?></li>
    </ul>
</div>

</NAV>

<h1><?php echo h($movie['Movie']['movie_name']); ?></h1>

<p><small>Created: <?php echo $movie['Movie']['created']; ?></small></p>

<div>

    <tr>
        <!-- <td><?php echo $movie['Movie']['id']; ?></td> -->
        <!-- <td><?php echo $movie['User']['id']; ?></td> -->
        <td><?php echo $movie['Genre']['genre_title'];?></td>
        <td><?php echo $movie['Movie']['movie_name'];?></td>
        <td><?php echo $movie['Movie']['discription'];?></td>
        <td><?php echo $movie['Movie']['movie_tag'];?></td>
        <td><?php echo $movie['Movie']['play_count'];?></td>
        <td>
            <?php 
            if($userSession['username'] == 'administrator'){
            echo $this->Html->link('Edit', array('action' => 'edit', $movie['Movie']['id']));
            }
             ?>
        </td>
        <td>
        <?php 
        if($userSession['username'] == 'administrator'){
        echo $this->Form->postlink('Delete', array('action' => 'delete', $movie['Movie']['id']));
            }
            ?>
        </td>
        <td><?php echo $movie['Movie']['created']; ?></td>
        <td><?php echo $movie['Movie']['modified']; ?></td>
        <td><?php 
            if($userSession['username'] !== null){
                echo $this->Form->postlink('Add Favarite', array('controller' => 'favarites', 'action' => 'add', $movie['Movie']['id']));
            }else{
                echo 'add favarite';
        }
        ?>
        </td>
        <td><?php 
            if($userSession['username'] !== null){
                echo $this->Form->postlink('Good!!', array('controller' => 'goods', 'action' => 'add', $movie['Movie']['id']));
            }else{
                echo 'Good!!';
        }
        ?>
        <td><?php if(isset($movie['Good'])){
            echo count($movie['Good']);
            }else{
                echo '0';
            }
             ?>
        </td>
    </tr>
    <?php unset($movie); ?>

<!-- watch_history -->
     <div class="movie2">
        <?php if($userSession['username'] !== null){
            foreach ($watchhistories as $watchhistory): ?>
    
        <dt class="movie2_title"><?php echo $this->Html->link($watchhistory['Movie']['movie_name'], array('controller' => 'movies', 'action' => 'view', $watchhistory['Movie']['id'], $watchhistory['Movie']['genre_id'])); ?> 
        </dt>
        <dd class="movie2_sumbnail"><?php echo $this->Html->link('<img src="http://192.168.33.10/DDDance/files/P'.str_pad($watchhistory['Movie']['id'], 5, "0", STR_PAD_LEFT).'">', array('controller' => 'movies', 'action' => 'view', $watchhistory['Movie']['id'], $watchhistory['Movie']['genre_id']), array('escape' => false)); ?>
        </dd>
        <dd class="movie2_sums"><?php echo $watchhistory['Genre']['genre_title'];?>
            <?php echo $watchhistory['Movie']['play_count'];?>
            <?php echo $watchhistory['WatchHistory']['created']; ?></dd>
    
<?php endforeach;
}
else{
    echo '<h1>WatchHistory</h1>';
    echo 'ログインすれば履歴を見る事が出来ます';
}
?>
    </div>

</div>

<!-- comment index -->
<div>
<h1>Movie Comments</h1>
<p><?php 
    if($userSession['username'] == null){
        echo 'Add Comments（ユーザー登録後使えます）';
    }else{
    echo $this->Html->link("Add Comments", array('controller' => 'comments', 'action' => 'add', $movie_id, $genre_id));
    } 
    ?></p>
<table>
    <tr>
        <th>user_name</th>
        <th>movie_name</th>
        <th>comment</th>
        <th>Action</th>
        <th>Action</th>
        <th>Created</th>
        <th>Modified</th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($comments as $comment): 
       // debug($post);

    ?>
    <tr>

        <td><?php echo $comment['User']['username']; ?></td>
        <td><?php echo $comment['Movie']['movie_name']; ?></td>
        <td><?php echo $comment['Comment']['comment'];?></td>
<!--         <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $comment['Comment']['id'])); ?>
        </td> -->
        <td>
        <?php echo $this->Form->postlink('Delete', array('action' => 'delete', $comment['Comment']['id'])); ?>
        </td>
        <td><?php echo $comment['Comment']['created']; ?></td>
        <td><?php echo $comment['Comment']['modified']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($comment); ?>
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


    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

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
