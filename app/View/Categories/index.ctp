<!-- File: /app/View/Categories/index.ctp -->
<?php //debug($posts); ?>
<h1>Blog Categories</h1>
<p><?php echo $this->Html->link("Add Category", array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Action</th>
        <th>Action</th>
        <th>Created</th>
        <th>Modified</th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($categories as $category): 
       // debug($post);

    ?>
    <tr>
        <td><?php echo $category['Category']['id']; ?></td>
        <td><?php echo $category['Category']['name'];?></td>
        <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $category['Category']['id'])); ?>
        </td>
        <td>
        <?php echo $this->Html->link('Delete', array('action' => 'delete', $category['Category']['id'])); ?>
        </td>
        <td><?php echo $category['Category']['created']; ?></td>
        <td><?php echo $category['Category']['modified']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php //unset($category); ?>
</table>