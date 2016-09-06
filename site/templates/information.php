<?php snippet('header') ?>

<?php 
	$sections = $page->children();
?>

<div class="page_content">
	
	<section id="about" class="column right animate">
		<?php echo $page->text()->kt() ?>
	</section>

	<?php foreach ($sections as $section): ?>

	<?php $subsections = $section->children() ?>

	<section id="<?= tagslug($section->title()) ?>" class="animate">
		<span class="section-title">
			<h2><?= $section->title()->html() ?></h2>
		</span>
		<span class="subsections">
			<?php foreach($subsections as $subsection): ?>
				<span class="subsection">
		  			<span class="column">
		  				<h2><?= $subsection->title()->html() ?></h2>
		  			</span>
		  			<span class="entries">
			  			<?php foreach($subsection->entries()->toStructure() as $entry): ?>
				  			<span class="column">
				  				<?php if(!$entry->addresslink()->empty()): ?>
				  				<a class="addresslink" href="<?= $entry->addresslink() ?>" target="_blank">
				  					<?= $entry->title()->html() ?>
				  				</a>
				  				<?php else: echo $entry->title()->html(); endif ?>
				  			</span>
				  			<span class="column">
				  				<span class="address">
						  			<?php if(!$entry->addresslink()->empty()): ?>
						  				<a class="addresslink" href="<?= $entry->addresslink() ?>" target="_blank">
						  					<?= $entry->address()->kt() ?>
						  				</a>
						  			<?php else: echo $entry->address()->kt(); endif ?>
						  		</span>
				  				<?= $entry->text()->kt() ?>
				  			</span>
			  			<?php endforeach ?>
		  			</span>
	  			</span>
			<?php endforeach ?>
		</span>
	</section>

	<?php endforeach ?>

	<section id="socials" class="animate">
		<span class="section-title">
			<h2>Follow</h2>
		</span>
		<span class="subsections">
			<span class="subsection">
				<span class="column">
					&nbsp;
				</span>
				<span class="entries">
					<span class="column">
						<?php foreach($page->socials()->yaml() as $social): ?>
							<a href="<?php echo $social['link'] ?>" target="_blank"><?php echo $social['name'] ?></a><br />
						<?php endforeach ?>
					</span>
				</span>
			</span>
		</span>
	</section>
	
</div>


<?php snippet('footer') ?>