
<?php if(!empty($this->single)): ?>
<a href="<?php echo base_url() ?>pages/new_post">
<button class="btn btn-info new-post"><i class="far fa-edit"></i> Add New Post</button>	
</a>
<?php endif; ?>

<div class="cat-box">
  <h6>Topic <i class="far fa-lightbulb"></i></h6>
<ul>
<?php if(!empty($category)): foreach($category as $c): ?>
<li >
  <a href="<?php echo $c['url'] ?>" >
  <?php echo $c['name']; ?><span class="badge badge-primary badge-pill"> <?php echo $c['post']; ?></span>
   </a>
 </li>

<?php  endforeach; endif; ?>

</ul>
</div>
