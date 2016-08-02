<?php snippet('header') ?>

<div id="introduction" class="page_content">
	<h2>Introduction</h2>
	<?php echo $page->text()->kt() ?>

	<h2 id="awards">Awards</h2>
	<?php echo $page->awards()->kt() ?>

	<h2 id="books">Books</h2>
	<?php foreach ($page->books()->toStructure() as $book): ?>
		<?php if (!$book->content()->empty()): ?>
			<span class="book">
			<?php echo $book->text()->kt() ?>
			<div class="img_hover"><img src="<?php echo resizeOnDemand($book->content()->toFile(), 600) ?>" width="100%" height="auto"></div>
			</span>

		<?php endif ?>
	<?php endforeach ?>

	<h2 id="exhibitions">Exhibitions</h2>
	<?php $exhibitions = $pages->find('index/exhibitions')->children()->visible()->sortBy('date', 'desc');?>
	<div class="exhibitions">
	<?php foreach ($exhibitions as $exhibition): ?>
		<div class="date"><?php echo $exhibition->date('Y') ?></div>
		<a data-title="<?php echo $exhibition->title()->html() ?>" href="<?php echo $exhibition->url() ?>" data-target="project">
		<div>
			<?php echo '<em>'.$exhibition->title()->html().'</em>'; if(!$exhibition->subtitle()->empty()){ echo ', '.$exhibition->subtitle()->html(); } ?>
		</div>
		</a>
	<?php endforeach ?>
	</div>

	<h2 id="texts">Interviews, Texts & Reviews</h2>
	<?php echo $page->texts()->kt() ?>

	<h2 id="contact">Contact</h2>
	<?php echo $page->contact()->kt() ?>

	<h2 id="blog">Blog</h2>
	<?php echo $page->blog()->kt() ?>
	
</div>


<?php snippet('footer') ?>