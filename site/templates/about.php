<?php snippet('header') ?>

<div class="page_content">
	<h2 id="introduction">Introduction</h2>
	<?php echo $page->text()->kt() ?>

	<h2 id="awards">Awards</h2>
	<?php echo $page->awards()->kt() ?>

	<h2 id="books">Books</h2>
	<?php //echo $page->text()->kt() ?>

	<h2 id="exhibitions">Exhibitions</h2>
	<?php //echo $page->text()->kt() ?>
	
	<h2 id="texts">Interviews, Texts & Reviews</h2>
	<?php echo $page->texts()->kt() ?>

	<h2 id="contact">Contact</h2>
	<?php echo $page->contact()->kt() ?>

	<h2 id="blog">Blog</h2>
	<?php echo $page->blog()->kt() ?>
	
</div>


<?php snippet('footer') ?>