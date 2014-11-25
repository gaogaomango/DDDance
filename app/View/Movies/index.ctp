<!-- File: /app/View/Users/index.ctp -->
<?php //debug($posts); ?>
<h1>Movie</h1>
    <td><?php 
        if($checkuser == 'adminuser'){
            echo $this->Html->link('Add Movie', array('action' => 'add'));
        }else{
            echo 'Add Movie';
    }
    ?>
    </td>
<table>
    <tr>
        <th>Id</th>
        <th>User_ID</th>
        <th>Genre_ID</th>
        <th>Movie_Name</th>
        <th>Movie_tag</th>
        <th>Thumbnail</th>
        <th>discription</th>
        <th>Play_count</th>
        <th>Action</th>
        <th>Action</th>
        <th>Created</th>
        <th>Modified</th>
        <th>Good!!</th>
        <th>Good_Number</th>
    </tr>
<p><?php echo 'ユーザー情報', $userSession['username']; ?></p>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($movies as $movie): 
       // debug($post);
    ?>

    <tr>
        <td><?php echo $movie['Movie']['id']; ?></td>
        <td><?php echo $movie['User']['id']; ?></td>
        <td><?php echo $movie['Genre']['genre_title'];?></td>
        <td><?php echo $this->Html->link($movie['Movie']['movie_name'], array('action' => 'view', $movie['Movie']['id'])); ?>
        <img src="http://192.168.33.10/DDDance/files/P<?php echo str_pad($movie['Movie']['id'], 5, "0", STR_PAD_LEFT);?>">
        <td><?php echo $this->Html->link($movie['Movie']['thumbnail'], array('action' => 'view', $movie['Movie']['id'], $movie['User']['id'])); ?>
        </td>
    <!-- 仮 -->
        <td><?php echo $movie['Movie']['movie_tag'];?></td> 
        <td><?php echo $movie['Movie']['discription'];?></td>
        <td><?php echo $movie['Movie']['play_count'];?></td>
        <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $movie['Movie']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postlink('Delete', array('action' => 'delete', $movie['Movie']['id'])); ?>
        </td>
        <td><?php echo $movie['Movie']['created']; ?></td>
        <td><?php echo $movie['Movie']['modified']; ?></td>
        <td><?php 
            if($checkuser == 'adminuser'){
                echo $this->Form->postlink('Add Favarite', array('controller' => 'favarites', 'action' => 'add', $movie['Movie']['id']));
            }else{
                echo 'add favarite';
        }
        ?>
        </td>
        <td><?php echo $this->Html->link('look favarite lists' , array('controller' => 'favarites', 'action' => 'index')); ?>
        </td>
        <td><?php 
            if($checkuser == 'adminuser'){
                echo $this->Form->postlink('Good!!', array('controller' => 'goods', 'action' => 'add', $movie['Movie']['id']));
            }else{
                echo 'Good!!';
        }
        ?>
        </td>
        <td><?php if(isset($movie['Good'])){
            echo count($movie['Good']);
            }else{
                echo '0';
            }
             ?>
        </td>
    </tr>
<?php endforeach; ?>
<?php unset($movie); ?>
</table>