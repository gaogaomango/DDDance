<!-- File: /app/View/Favarites/index.ctp -->
<?php //debug($posts); ?>
<h1>Favarite</h1>
 
    <td>
        <?php 
        echo $this->Html->link('ユーザーログアウト' ,array('controller' => 'users', 'action' => 'logout'));
        ?>
    <p><?php echo 'ユーザー情報', $userSession['username']; ?></p>
    </td>

    <div>
        <?php echo $this->Form->create('Movie', array('action'=>'index')); ?>
        <fieldset>
            <legend>検索</legend>
        </fieldset>
         <!-- 検索機能の全体検索かジャンル検索かを手動で切り替える方法 -->
 <div class="control-group">
        <?php echo $this->Form->label('keyword', 'キーワード', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $this->Form->text('keyword', array('class' => 'span12', 'placeholder' => '検索内容'));
                        
                $options = array(
                    -1 => '全体検索',
                    1 => 'HIPHOP',
                    2 => 'HOUSE',
                    3 => 'LOCK',
                    4 => 'POP',
                    5 => 'SOUL',
                    6 => 'BREAK'
                    )
                    ;
                    $attributes = array('default' => -1, 'class' => 'radio inline');
                     
                    echo $this->Form->radio('search_type', $options, $attributes);

                ?>
            </div>
</div>
        <?php echo $this->Form->end('検索'); ?>
    </div>

<table>
    <tr>
        <th>User_ID</th>
        <th>Genre_ID</th>
        <th>Movie_Name</th>
        <th>Movie_tag</th>
        <th>Play_count</th>
        <th>Created</th>
    </tr>

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($favarites as $favarite): 
       // debug($post);

    ?>
    <tr>
        <td><?php echo $favarite['User']['id']; ?></td>
        <td><?php echo $favarite['Genre']['genre_title'];?></td>
        <td><?php echo $this->Html->link($favarite['Movie']['movie_name'], array('controller' => 'movies', 'action' => 'view', $favarite['Movie']['id'])); ?>
        </td>
        <td><?php echo $this->Html->link('<img src="http://192.168.33.10/DDDance/files/P'.str_pad($favarite['Movie']['id'], 5, "0", STR_PAD_LEFT).'">', array('action' => 'view', $favarite['Movie']['id']), array('escape' => false)); ?>
        </td>
<!-- 　      <td><?php echo $this->Html->link($favarite['Movie']['movie_tag'], array('controller' => 'movies', 'action' => 'view', $favarite['Movie']['id'])); ?> -->
        <td><?php echo $favarite['Movie']['play_count'];?></td>
        <td><?php echo $favarite['Favarite']['created']; ?></td>
    　   <td>
            <?php echo $this->Form->postlink('Delete', array('action' => 'delete', $favarite['Favarite']['id'])); ?>
        </td>
    </tr>
<?php endforeach; ?>
<?php // unset($watch_history); ?>
</table>