<h1>All threads</h1>


<?php foreach ($threads as $thread) : ?>
  <span class="section">
    <a href="<?php to_html_entities(url('thread/view',array('thread_id' => $thread->id))) ?>">
      <?php echo $thread->title ?>
    </a>
  </span><br><br>
<?php endforeach; ?>




<!-- pagination -->
<?php if ($pagination->current > 1) : ?>
  <a href='?page=<?php echo $pagination->prev ?>'>Previous</a>
<?php else: ?>
  Previous
<?php endif ?>

<?php for ($i = 1; $i <= $num_pages; $i++) : ?>
  <?php if ($i == $page): ?>
    <?php echo $i ?>
  <?php else: ?>
   <a href='?page=<?php echo $i ?>'><?php echo $i ?></a>
  <?php endif; ?>
<?php endfor; ?>

<?php if (!$pagination->is_last_page) : ?>
  <a href='?page=<?php echo $pagination->next ?>'>Next</a>
<?php else: ?>
  Next
<?php endif ?>