<?php snippet('header') ?>

<?php $thumbmin = $site->thumbmin()->value(); $thumbmax = $site->thumbmax()->value(); ?>
<?php $albums = $pages->find('index/work')->children()->visible();?>

	<div class="page_content albums">

		<?php foreach ($albums as $album): ?>
			<?php if (!$album->featured()->empty()): ?>

				<div class="album_thumb<?php echo ' '.$album->thumbsize()->html() ?>" data-year="<?php echo $album->date('Y') ?>" data-title="<?php echo $album->title()->html() ?>" data-category="<?php echo $album->category()->html() ?>" data-top-bottom="transform:translateY(0)" data-bottom-top="transform:translateY(<?php echo mt_rand(-20,50) ?>%)" data-yvel="<?php echo mt_rand(-30,30) ?>">
				<a data-title="<?php echo $album->title()->html() ?>" href="<?php echo $album->url() ?>" data-target="project">

					<?php 
					$image = $album->featured()->toFile();
					$srcset = '';
					for ($i = 300; $i <= 1000; $i += 100) $srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
						?>

					<img 
					src="<?php echo resizeOnDemand($image, 300) ?>" 
					srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
					data-srcset="<?php echo $srcset ?>" 
					data-sizes="auto" 
					data-optimumx="0.9" 
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

	</div>


	<?php snippet('footer') ?>