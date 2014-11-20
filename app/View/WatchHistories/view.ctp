<!-- File: /app/View/Movies/view.ctp -->

<h1><?php echo h($watch_history['Movie']['name']); ?></h1>

<p><small>Created: <?php echo $watch_history['Watch_history']['created']; ?></small></p>

<p><?php echo h($watch_history['Watch_history']['body']); ?></p>

    <tr>
        <td><?php echo $watch_histories[0]['Movie']['id']; ?></td>
        <td><?php echo $watch_histories[0]['User']['id']; ?></td>
        <td><?php echo $watch_histories[0]['Genre']['id'];?></td>
        <td><?php echo $watch_histories[0]['Movie']['movie_name']?></td>
        <td><?php echo $watch_histories[0]['Movie']['discrition']?></td>
        <td><?php echo $watch_histories[0]['Movie']['movie_tag'];?></td>
        <td><?php echo $watch_histories[0]['Movie']['play_count']?></td>
        <td>
            <?php 
            if($watch_histories[0]['User']['id'] == 'administrator'){
            echo $this->Html->link('Edit', array('action' => 'edit', $watch_histories[0]['Movie']['id']));
            }
             ?>
        </td>
        <td>
        <?php 
        if($watch_histories[0]['User']['id'] == 'administrator'){
        echo $this->Form->postlink('Delete', array('action' => 'delete', $watch_histories[0]['Movie']['id']));
            }
            ?>
        </td>
        <td><?php echo $watch_histories[0]['Movie']['created']; ?></td>
        <td><?php echo $watch_histories[0]['Movie']['modified']; ?></td>
    </tr>
    <!-- <?php unset($movie); ?> -->