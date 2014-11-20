<!-- File: /app/View/Users/index.ctp -->
<?php //debug($posts); ?>
<h1>WatchHistory</h1>
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

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($watchhistories as $watchhistory): 
       // debug($post);

    ?>
    <tr>
        <td><?php echo $watchhistory['Movie']['id']; ?></td>
        <td><?php echo $watchhistory['User']['id']; ?></td>
        <td><?php echo $watchhistory['Movie']['genre_id'];?></td>
        <td><?php echo $watchhistory['Movie']['movie_name'];?></td>
         <td><?php echo $this->Html->link($watchhistory['Movie']['movie_tag'], array('action' => 'view', $watch_history['Movie']['movie_tag'])); ?>
        <td><?php echo $watchhistory['Movie']['movie_tag'];?></td>
        <td><?php echo $watchhistory['Movie']['play_count'];?></td>
        <td><?php echo $watchhistory['watch_history']['created']; ?></td>
    </tr>
<?php endforeach; ?>
<?php // unset($watch_history); ?>
</table>