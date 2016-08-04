<?php $thumbmin = $site->thumbmin()->value(); $thumbmax = $site->thumbmax()->value(); ?>

<div class="slider">

<?php foreach ($page->medias()->yaml() as $index=>$slide): ?>

	<div class="gallery_cell<?php if ($index == 0) {echo ' is-selected';} ?>">
			<img class="content lazyload" alt="<?php  echo $page->title()->html().' — © '.$page->date("Y").' '.$site->title(); ?>" data-src="<?php echo resizeOnDemand($page->image($slide), $thumbmin, true) ?>" data-flickity-lazyload="<?php echo resizeOnDemand($page->image($slide), $thumbmax, true) ?>" height="100%" width="auto">
			<noscript>
				<img class="content" alt="<?php  echo $page->title()->html().' — © '.$page->date("Y").' '.$site->title(); ?>" src="<?php echo resizeOnDemand($page->image($slide), $thumbmax, true) ?>" height="100%" width="auto">
			</noscript>	
	</div>

<?php endforeach ?>

</div>