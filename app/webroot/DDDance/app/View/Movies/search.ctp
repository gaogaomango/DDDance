<!-- File: /app/View/Movies/search.ctp -->

<?php

    echo $this->Form->create('Post', array('url' => '/movies/search', 'type' => 'get'));
    echo $this->Form->input('title');
    echo $this->Form->end('Search');