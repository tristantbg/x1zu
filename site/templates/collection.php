<?php snippet('header') ?>

<?php 

$gallery = $page->gallery()->toStructure();
$img_nb = $gallery->count();

?>

<div class="page_content">
	<footer>
		<span class="collection_title<?= ' '.$page->season() ?> column animate"><span class="season"></span><span class="year"><?= $page->year()->html() ?></span></span>
		<span class="column animate">
			<span class="counter"><?php if (s::get('device_class') == 'desktop') { echo "1-2"; } else { echo "1"; } ?></span> / <?= $img_nb ?>
		</span>
	</footer>

	<div class="slider">
	<?php foreach($gallery as $key => $imagename): ?>
		<?php if ($key%2 == 0 ): ?>
			<div class="gallery_cell">
		<?php endif ?>
		<?php $image = $page->image($imagename) ?>
	  		<div class="image<?php if ($key == 0 && s::get('device_class') == 'desktop' || $key == 1 && s::get('device_class') == 'desktop'){ echo " animate"; } elseif ($key == 0 && s::get('device_class') != 'desktop'){ echo " active"; } ?>">
				<?php 
				$srcset = '';
				for ($i = 200; $i <= 1200; $i += 200) $srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
					?>

				<div 
				class="img-container lazyimg<?php if ($key < 4){ echo ' lazyload'; } ?>"
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
</div>

<?php snippet('footer') ?>