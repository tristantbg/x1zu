<!DOCTYPE html>
<html lang="en" class="no-js">
<head>

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="canonical" href="<?php echo html($page->url()) ?>" />
	<?php if($page->isHomepage()): ?>
		<title><?php echo $site->title()->html() ?></title>
	<?php else: ?>
		<title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>
	<?php endif ?>
	<?php if($page->isHomepage()): ?>
		<meta name="description" content="<?php echo $site->description()->html() ?>">
	<?php else: ?>
		<?php if(!$page->description()->empty()): ?>
			<meta name="description" content="<?php echo $page->description()->excerpt(250) ?>">
		<?php endif ?>
	<?php endif ?>
	<meta name="robots" content="index,follow" />
	<meta name="keywords" content="<?php echo $site->keywords()->html() ?>">
	<meta name="DC.Title" content="<?php echo $page->title()->html() ?>" />
	<meta name="DC.Description" content="<?php echo $page->description()->html() ?>"/ >
	<?php if($page->isHomepage()): ?>
		<meta property="og:title" content="<?php echo $site->title()->html() ?>" />
	<?php else: ?>
		<meta property="og:title" content="<?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?>" />
	<?php endif ?>
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php echo html($page->url()) ?>" />
	<?php if(!$site->ogimage()->empty()): ?>
		<meta property="og:image" content="<?= $site->ogimage()->toFile()->width(1200)->url() ?>"/>
	<?php endif ?>
	<meta property="og:description" content="<?php echo $page->description()->html() ?>" />
	<?php if($page->isHomepage()): ?>
		<meta itemprop="name" content="<?php echo $site->title()->html() ?>">
	<?php else: ?>
		<meta itemprop="name" content="<?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?>">
	<?php endif ?>
	<meta itemprop="description" content="<?php echo $site->description()->html() ?>">
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
<body <?php if($page->isHomepage()): echo ' class="index"'; elseif($page->content()->name() == 'project'): echo ' class="album"'; else: echo ' class="page"'; endif?>>

	<div class="loader"></div>

	<span class="site_title"><a href="<?php echo $site->homePage()->url() ?>" data-target="index"><?php echo $site->title()->html() ?></a></span>

	<div id="container">

	<div class="inner">

		<header>
			<span class="current_title">
				<?php if($page->isHomepage()): ?>
					<span class="year"></span>
					<span class="project_title"></span>
				<?php elseif($page->content()->name() == 'project'): ?>
					<span class="year"><?php echo $page->date('Y') ?></span>
					<span class="project_title"><?php echo $page->title()->html() . ' (' . $page->category()->html() . ')' ?></span>
				<?php elseif($page->content()->name() == 'about'): ?>
					<li><a data-scroll href="#introduction">Introduction</a></li>
					<li><a data-scroll href="#awards">Awards</a></li>
					<li><a data-scroll href="#books">Books</a></li>
					<li><a data-scroll href="#exhibitions">Exhibitions</a></li>
					<li><a data-scroll href="#texts">Texts</a></li>
					<li><a data-scroll href="#contact">Contact</a></li>
					<li><a data-scroll href="#blog">Blog</a></li>
				<?php endif ?>
			</span>
			<ul class="nav_select">
				<?php if($page->isHomepage()): ?>
					<li><a href="<?php echo $pages->find('about')->url() ?>" data-target="page" data-title="<?php echo $pages->find('about')->title()->html() ?>"><?php echo $pages->find('about')->title()->html() ?></a></li>
				<?php elseif($page->content()->name() == 'project'): ?>
					<li class="infos_switch"><?php echo ucwords($page->textmenu()->html()) ?></li>
					<?php if($page->isChildOf($pages->find('index/work'))): ?>
						<li><a href="<?php echo $site->homePage()->url() ?>" data-target="index">Close</a></li>
					<?php else: ?>
						<li><a href="<?php echo $pages->find('about')->url() ?>" data-target="page">Close</a></li>
					<?php endif ?>
				<?php elseif($page->content()->name() == 'about'): ?>
					<li><a href="<?php echo $site->homePage()->url() ?>" data-target="index">Work</a></li>
				<?php endif ?>
			</ul>
		</header>