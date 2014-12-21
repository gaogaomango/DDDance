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


<div>
<h1>Genre</h1>
<table>
    <tr>
        <th>genre一覧へ</th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($genres as $genre): 
       // debug($post);
    ?>
<!--     <tr>
        <td>
            <?php echo $this->Html->link($genre['Genre']['genre_title'], array('controller' => 'movies', 'action' => 'genre_index', $genre['Genre']['id'])); 
        ?>
        </td>
    </tr> -->

        <tr>
     <td>
        <?php 
            if (isset ($selectedGenre)){
                if ($selectedGenre[0]['Genre']['id'] == $genre['Genre']['id']){
                echo $genre['Genre']['genre_title'];
            }else{
                echo $this->Html->link($genre['Genre']['genre_title'], array('controller' => 'movies','action' => 'genre_index', $genre['Genre']['id']));
                 }
            }else{
                echo $this->Html->link($genre['Genre']['genre_title'], array('controller' => 'movies','action' => 'genre_index', $genre['Genre']['id']));
            }
        ?>
    </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($genre); ?>
</table>
</div>