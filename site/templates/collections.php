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
			<?php if($collection->incollection()->bool()): ?>
					<a href="<?= $collection->url() ?>" data-title="<?= $collection->title()->html() ?>" data-target="collection">
						<div class="column">
							<span class="season"><strong><?= $collection->season() ?></strong></span>
							<span class="date"><strong><?= $collection->year()->html() ?></strong></span>
						</div>
						<div class="category column">
							<?= $collection->category()->html() ?>
						</div>
					</a>
			<?php endif ?>
			<?php endforeach ?>
	</section>
	<section id="collaborations" class="column right animate">
			<h2>Collaborations</h2>
			<?php foreach ($collaborations as $collaboration): ?>
				<?php 
					$type = $collaboration->collabtype();

					if ($type == "external"){
						$season = $collaboration->season();
						$year = $collaboration->year()->html();
						$title = $collaboration->collabtitle()->html();
						$link = $collaboration->link();
						$text = $collaboration->collabtext()->html();
					}
					else if ($type == "local") {
						$collabpage = $pages->find('collections/'.$collaboration->collabpage()->value());
						$season = $collabpage->season();
						$year = $collabpage->year()->html();
						$title = $collabpage->title()->html();
						$link = $collabpage->url();
						$text = $collabpage->text()->html();
					}
					
					$image = $page->image($collaboration->image());
				?>
				<section>
					<?php if ($type == "external" && $link->isNotEmpty()): ?>
						<a href="<?= $link ?>" target="_blank" 
						<?php if($image): ?>
						data-image="<?= resizeOnDemand($image, 800) ?>"
						<?php endif ?>>
					<?php elseif ($type == "local"): ?>
						<a href="<?= $link ?>" data-title="<?= $title ?>" data-target="collection"
						<?php if($image): ?>
						data-image="<?= resizeOnDemand($image, 800) ?>"
						<?php endif ?>>
					<?php endif ?>
						<div class="column">
						<?php if (!$season->empty()): ?>
							<span class="season"><strong><?= $season ?></strong></span>
						<?php endif ?>
							<span class="date"><strong><?= $year ?></strong></span>
						</div>
						<div class="column">
							<span class="collabtitle"><?= $title ?></span><br/>
							<span class="collabtext"><?= $text ?></span><br/>
							<?php if($image): ?>
							<span class="img_mobile <?= $image->orientation() ?>"><img src="<?= resizeOnDemand($image, 500) ?>" width="auto" height="auto"></span>
							<?php endif ?>
						</div>
					<?php if ($type == "local" || !$link->empty()): ?>
						</a>
					<?php endif ?>
				</section>
			<?php endforeach ?>
	</section>
</div>

<?php snippet('footer') ?>