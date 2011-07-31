<!-- File: /app/views/posts/index.ctp -->

<h1>Blog posts</h1>

<table>
  <tr>
    <th>Id</th>
    <th>Title</th>
    <th>Actions</th>
    <th>Created</th>
  </tr>

  <?php foreach ($posts as $post): ?>
  <tr>
	<td><?php echo $post['Post']['id'];  ?></td>
	<td>
		<?php echo $html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
	</td>
	<td>
	
	<?php echo $this->Html->link('Delete', array('action' => 'delete', $post['Post']['id']), null, 'Are you sure?')?>
	
	<?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id']));?>

	</td>
	<td><?php echo $post['Post']['created']; ?></td>
  </tr>
  <?php endforeach; ?>
	
  <?php echo $this->Html->link('Add Post', array('controller' => 'posts', 'action' => 'add')); ?>

</table>
