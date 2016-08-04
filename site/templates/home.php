<?php snippet('header') ?>

<?php $thumbmin = $site->thumbmin()->value(); $thumbmax = $site->thumbmax()->value(); ?>
<?php $albums = $pages->find('index/work')->children()->visible();?>

	<div class="page_content albums">

	<?php //for ($i=0; $i < 20; $i++) { ?>
	

		<?php foreach ($albums as $album): ?>
			<?php if (!$album->featured()->empty()): ?>

				<div class="album_thumb<?php echo ' '.$album->thumbsize()->html() ?>" data-year="<?php echo $album->date('Y') ?>" data-title="<?php echo $album->title()->html() ?>" data-category="<?php echo $album->category()->html() ?>" data-yvel="<?php echo mt_rand(-2,0) ?>">
				<a data-title="<?php echo $album->title()->html() ?>" href="<?php echo $album->url() ?>" data-target="project">

					<?php 
					$image = $album->featured()->toFile();
					$srcset = '';
					for ($i = 100; $i <= 1300; $i += 200) $srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
						?>

					<img 
					src="<?php echo resizeOnDemand($image, 500) ?>" 
					srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
					data-srcset="<?php echo $srcset ?>" 
					data-sizes="auto" 
					data-optimumx="1.2" 
					class="lazyimg lazyload"
					alt="<?php echo $album->title()->html().' — © '.$album->date("Y").', '.$site->title(); ?>" 
					width="100%" height="auto">

					<div class="thumb_title">
						<span class="year"><?php echo $album->date('Y') ?></span>
						<span class="project_title"><?php echo $album->title()->html() . ' (' . $album->category()->lower()->html() . ')' ?></span>
					</div>

				</a>
					
				</div>

			<?php endif ?>
		<?php endforeach ?>

	<?php //} ?>

	</div>


	<?php snippet('footer') ?>