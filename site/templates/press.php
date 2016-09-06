<?php snippet('header') ?>

<?php 
    $press = $page->entries()->toStructure();
?>

<div class="page_content">
	<div class="img_hover">
		<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" width="100%">
	</div>
	<section id="<?= tagslug($page->title()) ?>" class="column right animate">
			<?php foreach ($press as $entry): ?>
				<?php 
					$link = $entry->link();
					$image = $page->image($entry->image());
				?>
				<section>
					<?php if (!$link->empty()): ?>
						<a href="<?php echo $entry->link() ?>" target="_blank" data-image="<?= resizeOnDemand($image, 1000) ?>">
					<?php endif ?>
						<div class="column">
							<?= $entry->title()->html() ?>
						</div>
						<div class="column">
							<?= $entry->date('F Y') ?>
						</div>
					<?php if (!$link->empty()): ?>
						</a>
					<?php endif ?>
				</section>
			<?php endforeach ?>
	</section>
</div>

<?php snippet('footer') ?>