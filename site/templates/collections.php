<?php snippet('header') ?>

<?php 
	$collectionsPage = $pages->find('collections');
    $collections = $collectionsPage->children()->visible();
?>

<div class="page_content">
	<section id="collections" class="column right animate">
			<?php foreach ($collections as $collection): ?>
				<?php if($collection->collabtoggle() == 'false'): ?>
					<a href="<?php echo $collection->url() ?>" data-title="<?php echo $collection->title()->html() ?>" data-target="collection">
							<div class="column">
								<span class="season"><strong><?= $collection->season() ?></strong></span>
								<span class="date"><strong><?= $collection->year()->html() ?></strong></span>
							</div>
							<div class="column">
								<span class="season"><?= $collection->category()->html() ?></span>
							</div>
							</a>
				<?php endif ?>
			<?php endforeach ?>
	</section>
	<section id="collaborations" class="animate">
		<div class="column">
			<div class="column">
				<h2>Collaborations</h2>
			</div>
			<div class="column">
				<?php foreach ($collections as $collection): ?>
					<?php if($collection->collabtoggle() == 'true'): ?>
						<li>
							<?php echo $collection->collabtitle()->html() ?>
						</li>
					<?php endif ?>
				<?php endforeach ?>
			</div>
		</div>
		<div class="column">
			<ul>
				<?php foreach ($collections as $collection): ?>
					<?php if($collection->collabtoggle() == 'true'): ?>
							<a href="<?php echo $collection->url() ?>" data-title="<?php echo $collection->title()->html() ?>" data-target="collection">
							<div class="column">
								<span class="season"><strong><?= $collection->season() ?></strong></span>
								<span class="date"><strong><?= $collection->year()->html() ?></strong></span>
							</div>
							<div class="column">
								<span class="season"><?= $collection->category()->html() ?></span>
							</div>
							</a>
					<?php endif ?>
				<?php endforeach ?>
			</ul>
		</div>
	</section>
</div>

<?php snippet('footer') ?>