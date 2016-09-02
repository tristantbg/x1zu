<?php snippet('header') ?>

<?php 
	$sections = $pages->find('info')->children();
?>

<div id="information" class="page_content">
	
	<section id="about" class="column right">
		<?php echo $page->text()->kt() ?>
	</section>

	<?php foreach ($sections as $section): ?>

	<?php $subsections = $section->children() ?>

	<section id="<?= tagslug($section->title()) ?>">
		<span class="section-title">
			<h2><?= $section->title()->html() ?></h2>
		</span>
		<span class="subsections">
			<?php foreach($subsections as $subsection): ?>
				<span class="subsection">
		  			<span class="column">
		  				<h2><?= $subsection->title()->html() ?></h2>
		  			</span>
		  			<span class="entries">
			  			<?php foreach($subsection->entries()->toStructure() as $entry): ?>
				  			<span class="column">
				  				<?= $entry->title()->html() ?>
				  			</span>
				  			<span class="column">
				  				<?= $entry->text()->kt() ?>
				  			</span>
			  			<?php endforeach ?>
		  			</span>
	  			</span>
			<?php endforeach ?>
		</span>
	</section>

	<?php endforeach ?>
	
</div>


<?php snippet('footer') ?>