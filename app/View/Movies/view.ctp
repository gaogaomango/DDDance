<!-- File: /app/View/Movies/view.ctp -->

<h1><?php echo h($movie['Movie']['movie_name']); ?></h1>

<p><small>Created: <?php echo $movie['Movie']['created']; ?></small></p>

<div>
    <td>
        <?php 
        if($checkuser == null){
        echo $this->Html->link('ユーザーログイン' ,array('controller' => 'users', 'action' => 'login'));
        echo $this->Html->link('ユーザー登録', array('controller' => 'users', 'action' => 'add'));
        }else{
        echo 'ユーザーログイン';
        echo 'ユーザー登録';
        echo $this->Html->link('ユーザーログアウト' ,array('controller' => 'users', 'action' => 'logout'));
        }?>
    <p><?php echo 'ユーザー情報', $userSession['username']; ?></p>
    </td>
    <tr>
        <td><?php echo $movie['Movie']['id']; ?></td>
        <td><?php echo $movie['User']['id']; ?></td>
        <td><?php echo $movie['Genre']['id'];?></td>
        <td><?php echo $movie['Movie']['movie_name'];?></td>
        <td><?php echo $movie['Movie']['discription'];?></td>
        <td><?php echo $movie['Movie']['movie_tag'];?></td>
        <td><?php echo $movie['Movie']['play_count'];?></td>
<!--         <td><?php if(isset($movie['Watch_history'])){
            echo '再生回数 : ';
            echo count($movie['Watch_history']);
            echo '回';
            }else{
                echo '0だよーん';
            }
             ?>
        </td> -->
        <td>
            <?php 
            if($userSession['username'] == 'administrator'){
            echo $this->Html->link('Edit', array('action' => 'edit', $movie['Movie']['id']));
            }
             ?>
        </td>
        <td>
        <?php 
        if($userSession['username'] == 'administrator'){
        echo $this->Form->postlink('Delete', array('action' => 'delete', $movie['Movie']['id']));
            }
            ?>
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
        <td><?php 
            if($userSession['username'] == 'adminuser'){
                echo $this->Form->postlink('Good!!', array('controller' => 'goods', 'action' => 'add', $movie['Movie']['id']));
            }else{
                echo 'Good!!';
        }
        ?>
        <td><?php if(isset($movie['Good'])){
            echo count($movie['Good']);
            }else{
                echo '0';
            }
             ?>
        </td>
    </tr>
    <?php unset($movie); ?>

</div>

<!-- comment index -->
<div>
<h1>Movie Comments</h1>
<p><?php echo $this->Html->link("Add Comments", array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>user_name</th>
        <th>movie_name</th>
        <th>comment</th>
        <th>Action</th>
        <th>Action</th>
        <th>Created</th>
        <th>Modified</th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($comments as $comment): 
       // debug($post);

    ?>
    <tr>
        <td><?php echo $comment['User']['username']; ?></td>
        <td><?php echo $comment['Movie']['movie_name']; ?></td>
        <td><?php echo $comment['Comment']['comment'];?></td>
<!--         <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $comment['Comment']['id'])); ?>
        </td> -->
        <td>
        <?php echo $this->Form->postlink('Delete', array('action' => 'delete', $comment['Comment']['id'])); ?>
        </td>
        <td><?php echo $comment['Comment']['created']; ?></td>
        <td><?php echo $comment['Comment']['modified']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($comment); ?>
</table>
</div>
