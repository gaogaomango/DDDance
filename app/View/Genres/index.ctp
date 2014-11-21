<!-- File: /app/View/Genre/index.ctp -->
<?php //debug($posts); ?>
<h1>Genre</h1>
<!-- <p><?php echo $this->Html->link("Add User", array('action' => 'add')); ?></p> -->
<table>
    <tr>
        <th>Id</th>
        <th>genre_title</th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($genres as $genre): 
       // debug($post);

    ?>
    <tr>
        <td><?php echo $genre['Genre']['genre_title']; ?></td>
        <td><?php echo $genre['Genre']['id']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($genre); ?>
</table>