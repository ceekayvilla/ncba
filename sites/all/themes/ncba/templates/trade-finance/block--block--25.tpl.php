<!-- Stock Financing Facility block -->
<h6 class="accordionTitle">	<?php print $title; ?></h6>
<section class="accordion">
	<?php 
		print $content; 	
	?>
	<section class="accordionform" data-formsubject="Stock Financing">
			<?php 
			$block = module_invoke('webform', 'block_view', 'client-block-26');
			print render($block['content']); 
			?>
	</section>
</section>
