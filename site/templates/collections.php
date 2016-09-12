<?php snippet('header') ?>

<?php 
    $collections = $page->children()->visible();
    $collaborations = $page->collaborations()->toStructure();
?>

<div class="page_content">
	<div class="img_hover">
		<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" width="auto" height="auto">
	</div>
	<section id="collections" class="column right animate">
			<?php foreach ($collections as $collection): ?>
					<a href="<?php echo $collection->url() ?>" data-title="<?php echo $collection->title()->html() ?>" data-target="collection">
						<div class="column">
							<span class="season"><strong><?= $collection->season() ?></strong></span>
							<span class="date"><strong><?= $collection->year()->html() ?></strong></span>
						</div>
						<div class="category column">
							<?= $collection->category()->html() ?>
						</div>
					</a>
			<?php endforeach ?>
	</section>
	<section id="collaborations" class="column right animate">
			<h2>Collaborations</h2>
			<?php foreach ($collaborations as $collaboration): ?>
				<?php 
					$link = $collaboration->link();
					$season = $collaboration->season();
					$image = $page->image($collaboration->image());
				?>
				<section>
					<?php if (!$link->empty()): ?>
						<a href="<?php echo $collaboration->link() ?>" target="_blank" data-image="<?= resizeOnDemand($image, 1000) ?>">
					<?php endif ?>
						<div class="column">
						<?php if (!$season->empty()): ?>
							<span class="season"><strong><?= $collaboration->season() ?></strong></span>
						<?php endif ?>
							<span class="date"><strong><?= $collaboration->year()->html() ?></strong></span>
						</div>
						<div class="column">
							<span class="collabtitle"><?= $collaboration->title()->html() ?></span><br/>
							<span class="collabtext"><?= $collaboration->text()->html() ?></span><br/>
							<span class="img_mobile <?= $image->orientation() ?>"><img src="<?= resizeOnDemand($image, 500) ?>" width="auto" height="auto"></span>
						</div>
					<?php if (!$link->empty()): ?>
						</a>
					<?php endif ?>
				</section>
			<?php endforeach ?>
	</section>
</div>

<?php snippet('footer') ?>