<!-- File: /app/View/Groups/index.ctp -->
<?php //debug($posts); ?>
<h1>Web Groups</h1>
<p><?php echo $this->Html->link("Add admin or user", array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Action</th>
        <th>Action</th>
        <th>Created</th>
        <th>Modified</th>
    </tr>

    <!-- ここから、$group配列をループして、グループの情報を表示 -->

    <?php foreach ($groups as $group): 
       // debug($post);

    ?>
    <tr>
        <td><?php echo $group['Group']['id']; ?></td>
        <td><?php echo $group['Group']['name'];?></td>
        <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $group['Group']['id'])); ?>
        </td>
        <td>
        <?php echo $this->Form->postlink('Delete', array('action' => 'delete', $group['Group']['id'])); ?>
        </td>
        <td><?php echo $group['Group']['created']; ?></td>
        <td><?php echo $group['Group']['modified']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($group); ?>
</table>