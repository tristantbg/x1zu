<?php snippet('header') ?>

<?php snippet('slider') ?>

<div class="page_content">
	<?php foreach($page->gallery()->toStructure() as $thumb): ?>
  		<?php snippet('builder/' . $thumb->_fieldset(), array('data' => $thumb)) ?>
	<?php endforeach ?>
</div>

<?php snippet('footer') ?>