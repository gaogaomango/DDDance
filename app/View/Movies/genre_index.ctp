<!-- File: /app/View/Users/index.ctp -->
<!-- movie index -->
<div>
<h1>Movie</h1>
    <td>        
        <?php 
        echo $this->Html->link("トップページへ", array('action' => 'index'));
        if($userSession['username'] == null){
        echo $this->Html->link('ユーザーログイン' ,array('controller' => 'users', 'action' => 'login'));
        echo $this->Html->link('ユーザー登録', array('controller' => 'users', 'action' => 'add'));
        }else{
        echo 'ユーザーログイン';
        echo 'ユーザー登録';
        echo $this->Html->link('ユーザーログアウト' ,array('controller' => 'users', 'action' => 'logout'));
        }?>
    <p><?php echo 'ユーザー情報', $userSession['username']; ?></p>
    </td>

    <div>
        <?php echo $this->Form->create('Movie', array('action'=>'index')); ?>
        <fieldset>
            <legend>検索</legend>
        </fieldset>
         <?php echo $this->Form->input('keyword', array('label' => '検索バー', 'class' => 'span12', 'placeholder' => '検索内容')); ?>


<!-- 検索機能の&とorを手動で切り替える方法 -->
<!--         <div class="control-group">
        <?php echo $this->Form->label('keyword', 'キーワード', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $this->Form->text('keyword', array('class' => 'span12', 'placeholder' => '検索内容')); ?>
                <?php
                    $options = array('and' => 'AND', 'or' => 'OR');
                    $attributes = array('default' => 'and', 'class' => 'radio inline');
                    echo $this->Form->radio('andor', $options, $attributes);
                ?>
            </div>
        </div> -->

        <?php echo $this->Form->end('検索'); ?>
    </div>

     <?php
         echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
         echo $this->Paginator->numbers(array('separator' => ''));
         echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
    ?>


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

    <?php foreach ($movies as $movie):   ?>

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
            <?php echo $this->Form->postlink('Delete', array('action' => 'delete', $movie['Movie']['id'])); ?>
        </td>
        <td><?php echo $movie['Movie']['created']; ?></td>
        <td><?php echo $movie['Movie']['modified']; ?></td>
        <td><?php 
            if($userSession !== null){
                echo $this->Form->postlink('Add Favarite', array('controller' => 'favarites', 'action' => 'add', $movie['Movie']['id'], $movie['Genre']['id']));
                echo $this->Html->link('look favarite lists' , array('controller' => 'favarites', 'action' => 'index'));
            }else{
                echo 'add favarite';
                echo 'look favarite lists';
        }
        ?>
        </td>
        <td><?php 
            if($userSession !== null){
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
</div>

<!-- genre index -->
<div>
<h1>Genre</h1>
<table>
    <tr>
        <th>genre_title</th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($genres as $genre):   ?>
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
    <?php unset($genre); ?>
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

    foreach ($watchhistories as $watchhistory):     ?>
    <tr>
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