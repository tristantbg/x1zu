<?php snippet('header') ?>

<div id="information" class="page_content">
	
	<div class="column">
	<section class="section-bloc">
		<h2>About</h2>
		<section class="section-row"><?php echo $page->text()->kt() ?></section>
	</section>

	<section class="section-bloc">
		<h2>Contact</h2>
		<?php foreach($page->contact()->toStructure() as $section): ?>
  			<?php snippet('builder/' . $section->_fieldset(), array('data' => $section)) ?>
		<?php endforeach ?>
	</section>

	</div>

	<div class="column">
	<h2 class="column_title">Stockists</h2>
	<section id="stockists" class="section-bloc">
		<div class="hidescroll">
			<?php foreach($page->stockists()->toStructure() as $section): ?>
  				<?php snippet('builder/' . $section->_fieldset(), array('data' => $section)) ?>
			<?php endforeach ?>
		</div>
	</section>
	</div>
	
</div>


<?php snippet('footer') ?>