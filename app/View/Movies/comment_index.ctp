<!-- File: /app/View/Comments/index.ctp -->
<?php //debug($posts); ?>
<h1>Movie Comments</h1>
<p><?php echo $this->Html->link("Add Comments", array('action' => 'add')); ?></p>
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