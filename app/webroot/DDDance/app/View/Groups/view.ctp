<!-- File: /app/View/Groups/view.ctp -->

<h1><?php echo h($group['Group']['name']); ?></h1>

<p><small>Created: <?php echo $group['Group']['created']; ?></small></p>

<p><?php echo h($group['Group']['body']); ?></p>