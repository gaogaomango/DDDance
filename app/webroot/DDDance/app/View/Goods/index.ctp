<!-- File: /app/View/Users/index.ctp -->
<?php //debug($posts); ?>
<h1>Good</h1>
<table>
    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->
    <?php foreach ($goods as $good): 
       // debug($post);

    ?>
    <tr>
        <td><?php 
            if($good['User']['name'] == 'adminuser'){
                $this->Form->postlink('Good!!', array('action' => 'add',$good['good']['id']));
            }else{
                echo 'Good!!';
        }
        
        ?>
        <td><?php echo $good['Good']['id']; ?></td>
    </tr>
<?php endforeach; ?>
<?php // unset($watch_history); ?>
</table>