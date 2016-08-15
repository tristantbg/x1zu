<?php $image = page()->image($data->content()) ?>

<div class="image<?= ' '.$data->position()->html() ?>" style="top: <?= $data->top() ?>vw">
		<?php 
		$srcset = '';
		for ($i = 200; $i <= 1200; $i += 200) $srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
			?>

		<img 
		srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
		data-srcset="<?php echo $srcset ?>" 
		data-sizes="auto" 
		data-optimumx="1.5" 
		class="lazyimg lazyload"
		alt="<?= site()->title()->html().' — '.page()->title()->html() ?>" 
		width="100%" height="auto">
		
		<noscript>
			<img src="<?= $image->url() ?>" alt="<?= site()->title()->html().' — '.page()->title()->html() ?>" 
		width="100%" height="auto">
		</noscript>
</div>