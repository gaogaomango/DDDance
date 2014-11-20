<!-- File: /app/View/Movies/view.ctp -->

<h1><?php echo h($movie['Movie']['name']); ?></h1>

<p><small>Created: <?php echo $movie['Movie']['created']; ?></small></p>

<p><?php echo h($movie['Movie']['body']); ?></p>

    <tr>
        <td><?php echo $movies[0]['Movie']['id']; ?></td>
        <td><?php echo $movies[0]['User']['id']; ?></td>
        <td><?php echo $movies[0]['Genre']['id'];?></td>
        <td><?php echo $movies[0]['Movie']['movie_name']?></td>
        <td><?php echo $movies[0]['Movie']['discrition']?></td>
        <td><?php echo $movies[0]['Movie']['movie_tag'];?></td>
        <td><?php echo $movies[0]['Movie']['play_count']?></td>
        <td>
            <?php 
            if($movies[0]['User']['id'] == 'administrator'){
            echo $this->Html->link('Edit', array('action' => 'edit', $movies[0]['Movie']['id']));
            }
             ?>
        </td>
        <td>
        <?php 
        if($movies[0]['User']['id'] == 'administrator'){
        echo $this->Form->postlink('Delete', array('action' => 'delete', $movies[0]['Movie']['id']));
            }
            ?>
        </td>
        <td><?php echo $movies[0]['Movie']['created']; ?></td>
        <td><?php echo $movies[0]['Movie']['modified']; ?></td>
    </tr>
    <?php unset($movie); ?>