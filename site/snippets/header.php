<!-- Website developed by Tristan Bagot -->

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="canonical" href="<?php echo html($page->url()) ?>" />
	<?php if($page->isHomepage()): ?>
		<title><?= $site->title()->html() ?></title>
	<?php else: ?>
		<title><?= $page->title()->html() ?> | <?= $site->title()->html() ?></title>
	<?php endif ?>
	<?php if($page->isHomepage()): ?>
		<meta name="description" content="<?= $site->description()->html() ?>">
	<?php else: ?>
		<meta name="DC.Title" content="<?= $page->title()->html() ?>" />
		<?php if(!$page->text()->empty()): ?>
			<meta name="description" content="<?= $page->text()->excerpt(250) ?>">
			<meta name="DC.Description" content="<?= $page->text()->excerpt(250) ?>"/ >
			<meta property="og:description" content="<?= $page->text()->excerpt(250) ?>" />
		<?php else: ?>
			<meta name="description" content="">
			<meta name="DC.Description" content=""/ >
			<meta property="og:description" content="" />
		<?php endif ?>
	<?php endif ?>
	<meta name="robots" content="index,follow" />
	<meta name="keywords" content="<?= $site->keywords()->html() ?>">
	<?php if($page->isHomepage()): ?>
		<meta itemprop="name" content="<?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $site->title()->html() ?>" />
	<?php else: ?>
		<meta itemprop="name" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>" />
	<?php endif ?>
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= html($page->url()) ?>" />
	<?php if($page->content()->name() == "collection"): ?>	
		<?php $gallery = $page->gallery()->toStructure(); ?>
		<?php if ($gallery->count() > 0): ?>
			<?php foreach ($gallery as $key => $value): ?>
				<?php if ($key < 4): ?>
					<meta property="og:image" content="<?= resizeOnDemand($page->image($value), 1200) ?>"/>
				<?php endif ?>
			<?php endforeach ?>
		<?php else: ?>
			<?php if(!$site->ogimage()->empty()): ?>
				<meta property="og:image" content="<?= $site->ogimage()->toFile()->width(1200)->url() ?>"/>
			<?php endif ?>
		<?php endif ?>
	<?php else: ?>
		<?php if(!$site->ogimage()->empty()): ?>
			<meta property="og:image" content="<?= $site->ogimage()->toFile()->width(1200)->url() ?>"/>
		<?php endif ?>
	<?php endif ?>

	<meta itemprop="description" content="<?= $site->description()->html() ?>">
	<link rel="shortcut icon" href="<?= url('assets/images/favicon.ico') ?>">
	<link rel="icon" href="<?= url('assets/images/favicon.ico') ?>" type="image/x-icon">

	<?php 
	echo css('assets/css/app.min.css');
	echo js('assets/js/vendor/modernizr.min.js');
	?>
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?= url('assets/js/vendor/jquery.min.js') ?>">\x3C/script>')</script>

	<?php if(!$site->customcss()->empty()): ?>
		<style type="text/css">
			<?php echo $site->customcss()->html() ?>
		</style>
	<?php endif ?>

</head>

<?php 
	$collectionsPage = $pages->find('collections');
    $info = $pages->find('info');
    $press = $pages->find('press');
?>

<body <?php if($page->content()->name() == 'collection'): echo ' class="collection"'; else: echo ' class="page"'; endif?>>

	<div class="loader"></div>

	<header>
			<span id="site_title" class="animate">
				<a href="<?php echo $site->homePage()->url() ?>" data-target="index">
					<h1>XU <span class="type-offset">ZHI</span></h1>
				</a>
			</span>

			<nav id="menu" class="animate">
				<ul>
					<li<?php e($page->is($collectionsPage), ' class="active"'); ?>>
						<a href="<?php echo $collectionsPage->url() ?>" data-title="<?php echo $collectionsPage->title()->html() ?>" data-target="page"><h2><?php echo $collectionsPage->title()->html() ?></h2></a>
					</li>
					<li id="info_btn"<?php e($page->is($info), ' class="active"'); ?>>
						<a href="<?php echo $info->url() ?>" data-title="<?php echo $info->title()->html() ?>" data-target="page"><h2><?php echo $info->title()->html() ?></h2></a>
					</li>
					<?php if(size($press->entries()->yaml()) > 0): ?>
					<li class="hidden<?php e($page->is($press), ' active'); ?>">
						<a href="<?php echo $press->url() ?>" data-title="<?php echo $press->title()->html() ?>" data-target="page"><h2><?php echo $press->title()->html() ?></h2></a>
					</li>
					<?php endif ?>
				</ul>
			</nav>

	</header>

	<div id="container">

	<div class="inner">