<?php snippet('header') ?>

<?php $thumbmin = $site->thumbmin()->value(); $thumbmax = $site->thumbmax()->value(); ?>
<?php $albums = $pages->find('index/work')->children()->visible();?>

	<div class="page_content albums">

	<?php //for ($i=0; $i < 20; $i++) { ?>
	

		<?php foreach ($albums as $album): ?>
			<?php if (!$album->featured()->empty()): ?>

				<div class="album_thumb" data-year="<?php echo $album->date('Y') ?>" data-title="<?php echo $album->title()->html() ?>" data-category="<?php echo $album->category()->html() ?>" data-rellax-speed="<?php echo mt_rand(-2,0) ?>">
				<a data-title="<?php echo $album->title()->html() ?>" href="<?php echo $album->url() ?>" data-target="project">
						<img data-src="<?php echo resizeOnDemand($album->featured()->toFile(), $thumbmin) ?>" height="auto" width="100%" alt="<?php  echo $album->title()->html().' — © '.$album->date("Y").', '.$site->title(); ?>">
					</a>
					
				</div>

			<?php endif ?>
		<?php endforeach ?>

	<?php //} ?>

	</div>


	<?php snippet('footer') ?>