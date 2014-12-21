<!-- File: /app/View/Posts/index.ctp -->
<?php  // debug($posts); ?>
<h1>Blog posts</h1>
<p><?php echo $this->Html->link("Add Post", array('action' => 'add')); ?></p>
<div style="float:left;">
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Action</th>
        <th>Action</th>
        <th>Category</th>
        <th>Created</th>    
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($posts as $post):  ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'],array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
            'Delete',
             array('action' => 'delete', $post['Post']['id']),
             array('confirm' => 'Are you sure?'));
                  ?>
        </td>
       <td>
            <?php echo $this->Html->link($post['Genre']['genre_title'], array('controller' => 'posts', 'action' => 'category_index', $post['Genre']['id'])); ?>
        </td>
        <td><?php echo $post['Post']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php //unset($post); ?>
</table>
</div>

<div style="float:right;">
     <?php  echo $this->element('rightside_menu');?>
</div>