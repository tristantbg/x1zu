<?php snippet('header') ?>

<?php 

$gallery = $page->gallery()->toStructure();
$img_nb = $gallery->count();

?>

<div class="page_content">
	<footer>
		<span class="collection_title<?= ' '.$page->season() ?> column animate"><span class="season"></span><span class="year"><?= $page->year()->html() ?></span></span>
		<span class="column animate">
			<span class="counter"><?php if (s::get('device_class') == 'desktop') { echo "1–2"; } else { echo "1"; } ?></span> / <?= $img_nb ?>
		</span>
	</footer>

	<div class="slider">
	<?php foreach($gallery as $key => $imagename): ?>
		<?php if ($key%2 == 0 ): ?>
			<div class="gallery_cell">
		<?php endif ?>
		<?php $image = $page->image($imagename) ?>
	  		<div class="image">
				<?php 
				$srcset = '';
				for ($i = 200; $i <= 1200; $i += 200) $srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
					?>

				<div 
				class="img-container lazyimg"
				data-bgset="<?php echo $srcset ?>" 
				data-sizes="auto" 
				data-optimumx="1.2" 
				alt="<?= site()->title()->html().' — '.page()->title()->html() ?>"></div>
				
				<noscript>
					<img src="<?= resizeOnDemand($image, 1500) ?>" alt="<?= site()->title()->html().' — '.page()->title()->html() ?>" 
				width="auto" height="100%" />
				</noscript>
			</div>
		<?php if ($key%2 != 0 || $key == $img_nb - 1): ?>
			</div>
		<?php endif ?>
	<?php endforeach ?>
	</div>
	<div class="slider-navigation">
		<div class="prev"></div>
		<div class="next"></div>
	</div>
</div>

<?php snippet('footer') ?>