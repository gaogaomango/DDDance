<!-- File: /app/View/Users/index.ctp -->
<?php //debug($posts); ?>
<h1>WatchHistory</h1>

    <div>
        <?php echo $this->Form->create('Movie', array('action'=>'index')); ?>
        <fieldset>
            <legend>検索</legend>
        </fieldset>
         <?php echo $this->Form->input('keyword', array('label' => '検索バー', 'class' => 'span12', 'placeholder' => '検索内容')); ?>
        <?php echo $this->Form->end('検索'); ?>
    </div>


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

    <?php foreach ($watchhistories as $watchhistory): 
       // debug($post);

    ?>
    <tr>
        <td><?php echo $watchhistory['Movie']['id']; ?></td>
        <td><?php echo $watchhistory['User']['id']; ?></td>
        <td><?php echo $watchhistory['Movie']['genre_id'];?></td>
        <td><?php echo $this->Html->link($watchhistory['Movie']['movie_name'], array('controller' => 'movies', 'action' => 'view', $watchhistory['Movie']['id'])); ?> 
        </td>
        <td><img src="http://192.168.33.10/DDDance/files/P<?php echo str_pad($watchhistory['Movie']['id'], 5, "0", STR_PAD_LEFT);?>"></td>
        <!-- <td><?php echo $watchhistory['Movie']['movie_tag'];?></td> -->
        <td><?php echo $watchhistory['Movie']['play_count'];?></td>
        <td><?php echo $watchhistory['WatchHistory']['created']; ?></td>
    </tr>
<?php endforeach; ?>
<?php // unset($watch_history); ?>
</table>