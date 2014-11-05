<!-- File: /app/View/Categories/index.ctp -->
<?php //debug($posts); ?>
<h1>Blog Categories</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Created</th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($categories as $category): 
       // debug($post);

    ?>
    <tr>
        <td><?php echo $category['Category']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($category['Category']['name'],
array('controller' => 'categories', 'action' => 'view', $category['Category']['id'])); ?>
        </td>
        <td><?php echo $category['Category']['created']; ?></td>
        <td><?php echo $category['Category']['modified']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($category); ?>
</table>