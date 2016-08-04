<?php snippet('header') ?>

<div id="introduction" class="page_content">
	<h2>Introduction</h2>
	<?php echo $page->text()->kt() ?>

	<h2 id="awards">Awards</h2>
	<div class="about_list">
		<?php foreach ($page->awards()->toStructure() as $award): ?>
			<div class="date"><?php echo $award->year()->html() ?></div>
			<div class="content"><?php echo $award->text()->kt() ?></div>
		<?php endforeach ?>
	</div>

	<h2 id="books">Books</h2>
	<?php foreach ($page->books()->toStructure() as $book): ?>
		<?php if (!$book->content()->empty()): ?>
			<span class="book about_list">
				<div class="date"><?php echo $book->year()->html() ?></div>
				<div class="content"><?php echo $book->text()->kt() ?></div>
				<div class="img_hover"><img src="<?php echo resizeOnDemand($book->content()->toFile(), 600) ?>" width="100%" height="auto"></div>
			</span>
		<?php endif ?>
	<?php endforeach ?>

	<h2 id="exhibitions">Exhibitions</h2>
	<?php $exhibitions = $pages->find('index/exhibitions')->children()->visible()->sortBy('date', 'desc');?>
	<div class="about_list">
	<?php foreach ($exhibitions as $exhibition): ?>
		<div class="date"><?php echo $exhibition->date('Y') ?></div>
		<a class="content" data-title="<?php echo $exhibition->title()->html() ?>" href="<?php echo $exhibition->url() ?>" data-target="project">
		<div>
			<?php echo '<em>'.$exhibition->title()->html().'</em>'; if(!$exhibition->subtitle()->empty()){ echo ', '.$exhibition->subtitle()->html(); } ?>
		</div>
		</a>
	<?php endforeach ?>
	</div>

	<h2 id="texts">Interviews, Texts & Reviews</h2>
	<div class="about_list">
		<?php foreach ($page->texts()->toStructure() as $text): ?>
			<div class="date"><?php echo $text->year()->html() ?></div>
			<div class="content"><?php echo $text->text()->kt() ?></div>
		<?php endforeach ?>
	</div>

	<h2 id="contact">Contact</h2>
	<?php echo $page->contact()->kt() ?>

	<h2 id="blog">Blog</h2>
	<?php echo $page->blog()->kt() ?>
	
</div>


<?php snippet('footer') ?>