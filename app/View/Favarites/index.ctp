<!-- File: /app/View/Users/index.ctp -->
<?php //debug($posts); ?>
<h1>Favarite</h1>
<table>
    <tr>
        <th>User_ID</th>
        <th>Genre_ID</th>
        <th>Movie_Name</th>
        <th>Movie_tag</th>
        <th>Play_count</th>
        <th>Created</th>
    </tr>

    <p><?php echo 'ユーザー情報', $userSession['username']; ?></p>


    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($favarites as $favarite): 
       // debug($post);

    ?>
    <tr>
        <td><?php echo $favarite['User']['id']; ?></td>
        <td><?php echo $favarite['Movie']['genre_id'];?></td>
        <td><?php echo $favarite['Movie']['movie_name'];?></td>
<!--          <td><?php echo $this->Html->link($favarite['Movie']['movie_tag'], array('action' => 'view', $watch_history['Movie']['movie_tag'])); ?>
 -->
         <td><?php echo $favarite['Movie']['movie_tag'];?></td>
        <td><?php echo $favarite['Movie']['play_count'];?></td>
        <td><?php echo $favarite['Favarite']['created']; ?></td>
    </tr>
<?php endforeach; ?>
<?php // unset($watch_history); ?>
</table>