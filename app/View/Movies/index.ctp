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

    <div>
        <?php echo $this->Form->create('Movie', array('action'=>'index')); ?>
        <fieldset>
            <legend>検索</legend>
        </fieldset>
         <?php echo $this->Form->input('keyword', array('label' => '検索バー', 'class' => 'span12', 'placeholder' => '検索内容')); ?>


 <!-- 検索機能の&とorを手動で切り替える方法 -->
<!--         <div class="control-group">
        <?php echo $this->Form->label('keyword', 'キーワード', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $this->Form->text('keyword', array('class' => 'span12', 'placeholder' => '検索内容')); ?>
                <?php
                    $options = array('and' => 'AND', 'or' => 'OR');
                    $attributes = array('default' => 'and', 'class' => 'radio inline');
                    echo $this->Form->radio('andor', $options, $attributes);
                ?>
            </div>
        </div> -->

        <?php echo $this->Form->end('検索'); ?>
    </div>

     <?php
         echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
         echo $this->Paginator->numbers(array('separator' => ''));
         echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
    ?>


<table>
    <tr>
        <th><?php echo $this->Paginator->sort('id','ID')?></th>
        <th><?php echo $this->Paginator->sort('user_id','USER_ID')?></th>
        <th><?php echo $this->Paginator->sort('genre_id','GENRE_ID')?></th>
        <th><?php echo $this->Paginator->sort('movie_name','MOVIE_NAME')?></th>
        <th>THUMBNAIL</th>
        <!-- <th><?php echo $this->Paginator->sort('movie_tag','MOVIE_TAG')?></th> -->
        <th><?php echo $this->Paginator->sort('discription','DISCRIPTION')?></th>
        <th><?php echo $this->Paginator->sort('play_count','PLAY_COUNT')?></th>
        <th>Action</th>
        <th>Action</th>
        <th><?php echo $this->Paginator->sort('created','CREATED')?></th>
        <th><?php echo $this->Paginator->sort('modified','MODIDIED')?></th>
        <th>Good!!</th>
        <th><?php echo $this->Paginator->sort('good','GOOD_NUMBER!!')?></th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($movies as $movie): 
       // debug($post);
    ?>

    <tr>
        <td><?php echo $movie['Movie']['id']; ?></td>
        <td><?php echo $movie['User']['id']; ?></td>
        <td><?php echo $movie['Genre']['genre_title'];?></td>
        <td><?php echo $this->Html->link($movie['Movie']['movie_name'], array('action' => 'view', $movie['Movie']['id'])); ?>
        </td>
        <td><?php echo $this->Html->link('<img src="http://192.168.33.10/DDDance/files/P'.str_pad($movie['Movie']['id'], 5, "0", STR_PAD_LEFT).'">', array('action' => 'view', $movie['Movie']['id']), array('escape' => false)); ?>
        </td>
        <td><?php echo $movie['Movie']['discription'];?></td>
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
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $movie['Movie']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Form->postlink('Delete', array('action' => 'delete', $movie['Movie']['id'])); ?>
        </td>
        <td><?php echo $movie['Movie']['created']; ?></td>
        <td><?php echo $movie['Movie']['modified']; ?></td>
        <td><?php 
            if($checkuser == 'adminuser'){
                echo $this->Form->postlink('Add Favarite', array('controller' => 'favarites', 'action' => 'add', $movie['Movie']['id'], $movie['Genre']['id']));
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