<!-- File: /app/View/Favarites/index.ctp -->
<?php //debug($posts); ?>
<h1>Favarite</h1>
 
    <td>
        <?php 
        echo $this->Html->link('ユーザーログアウト' ,array('controller' => 'users', 'action' => 'logout'));
        ?>
    <p><?php echo 'ユーザー情報', $userSession['username']; ?></p>
    </td>

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
        <th>User_ID</th>
        <th>Genre_ID</th>
        <th>Movie_Name</th>
        <th>Movie_tag</th>
        <th>Play_count</th>
        <th>Created</th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($favarites as $favarite): 
       // debug($post);

    ?>
    <tr>
        <td><?php echo $favarite['User']['id']; ?></td>
        <td><?php echo $favarite['Genre']['genre_title'];?></td>
        <td><?php echo $this->Html->link($favarite['Movie']['movie_name'], array('controller' => 'movies', 'action' => 'view', $favarite['Movie']['id'])); ?>
        </td>
        <td><?php echo $this->Html->link('<img src="http://192.168.33.10/DDDance/files/P'.str_pad($favarite['Movie']['id'], 5, "0", STR_PAD_LEFT).'">', array('action' => 'view', $favarite['Movie']['id']), array('escape' => false)); ?>
        </td>
<!-- 　      <td><?php echo $this->Html->link($favarite['Movie']['movie_tag'], array('controller' => 'movies', 'action' => 'view', $favarite['Movie']['id'])); ?> -->
        <td><?php echo $favarite['Movie']['play_count'];?></td>
        <td><?php echo $favarite['Favarite']['created']; ?></td>
    　   <td>
            <?php echo $this->Form->postlink('Delete', array('action' => 'delete', $favarite['Favarite']['id'])); ?>
        </td>
    </tr>
<?php endforeach; ?>
<?php // unset($watch_history); ?>
</table>