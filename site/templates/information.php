<?php snippet('header') ?>

<?php 
	$sections = $page->children();
	$press = $pages->find('press');
?>

<div id="info" class="page_content">
	
	<section class="about animate">
		<span class="section-title">
			<h2>About</h2>
		</span>
		<span class="subsections">
			<span class="subsection">
				<span class="column">
			  		<h2>The Brand</h2>
			  	</span>
			  	<span class="entries">
			  		<?= $page->brand()->kt() ?>
			  	</span>
			</span>
		</span>	
	</section>
	<section class="about animate">
		<span class="subsections right">
			<span class="subsection">
				<span class="column">
			  		<h2>The Designer</h2>
			  	</span>
			  	<span class="entries">
			  		<?= $page->designer()->kt() ?>
			  	</span>
			</span>
		</span>	
	</section>

	<section id="awards" class="animate">
		<span class="section-title">
			<h2>Awards</h2>
		</span>
		<span class="subsections">
		<span class="column right">
			<?= $page->awards()->kt() ?>
		</span>
		</span>
	</section>

	<?php foreach ($sections as $section): ?>

	<?php $subsections = $section->children() ?>

	<section id="<?= tagslug($section->title()) ?>" class="animate">
		<span class="section-title">
			<h2><?= $section->title()->html() ?></h2>
		</span>
		<span class="subsections">
			<?php foreach($subsections as $subsection): ?>
				<span class="subsection">
				<?php if (!$subsection->hidetitle()->bool()):?>
		  			<span class="column">
		  				<h2><?= $subsection->title()->html() ?></h2>
		  			</span>
		  		<?php endif ?>
		  			<span class="entries<?php if ($subsection->hidetitle()->bool()) { echo " column right"; } ?>">
			  			<?php foreach($subsection->entries()->toStructure() as $entry): ?>
				  			<span class="column">
				  				<?php if(!$entry->addresslink()->empty()): ?>
				  				<a class="addresslink" href="<?= $entry->addresslink() ?>" target="_blank">
				  					<?= $entry->title()->html() ?>
				  				</a>
				  				<?php else: echo $entry->title()->html(); endif ?>
				  			</span>
				  			<span class="column">
				  				<span class="address">
						  			<?php if(!$entry->addresslink()->empty()): ?>
						  				<a class="addresslink" href="<?= $entry->addresslink() ?>" target="_blank">
						  					<?= $entry->address()->kt() ?>
						  				</a>
						  			<?php else: echo $entry->address()->kt(); endif ?>
						  		</span>
				  				<?= $entry->text()->kt() ?>
				  			</span>
			  			<?php endforeach ?>
		  			</span>
	  			</span>
			<?php endforeach ?>
		</span>
	</section>

	<?php endforeach ?>
	
	<section id="press_access" class="animate">
		<a href="<?php echo $press->url() ?>" data-title="<?php echo $press->title()->html() ?>" data-target="page">
			<h2>Access <?php echo $press->title()->html() ?> page</h2>
		</a>
	</section>
</div>


<?php snippet('footer') ?>