<table>
    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($genres as $genre): ?>
    <tr>
        <!-- 先生の解答、リンクを消す -->
        <td>
            <?php 
            if (isset ($selectedGenre)){
	            if ($selectedGenre[0]['Genre']['id'] == $genre['Genre']['id']){
                echo $genre['Genre']['genre_title'];
            }else{
                echo $this->Html->link($genre['Genre']['genre_title'], array('controller' => 'posts','action' => 'genre_index', $genre['Genre']['id']));
                 }
            }else{
            	echo $this->Html->link($genre['Genre']['genre_title'], array('controller' => 'posts','action' => 'genre_index', $genre['Genre']['id']));
            }
             ?>
        </td>
    </tr>

    <?php endforeach; ?>
    <?php unset($genre); ?>
</table>