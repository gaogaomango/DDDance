<!-- File: /app/View/Users/index.ctp -->
<?php //debug($posts); ?>
<h1>Blog Users</h1>
<p><?php echo $this->Html->link("Add User", array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>GroupName</th>
        <th>Id</th>
        <th>Name</th>
        <th>Action</th>
        <th>Action</th>
        <th>Created</th>
        <th>Modified</th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($users as $user): 
       // debug($post);

    ?>
    <tr>
        <td><?php echo $user['Group']['name']; ?></td>
        <td><?php echo $user['User']['id']; ?></td>
        <td><?php echo $user['User']['username'];?></td>
        <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id'])); ?>
        </td>
        <td>
        <?php echo $this->Form->postlink('Delete', array('action' => 'delete', $user['User']['id'])); ?>
        </td>
        <td><?php echo $user['User']['created']; ?></td>
        <td><?php echo $user['User']['modified']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>