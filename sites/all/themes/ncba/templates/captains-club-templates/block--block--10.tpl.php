<!-- Captain's Club Text Block -->
<div class="webform-client-form-25">
	<?php print $content; ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(".webform-client-form-25").wrapAll("<section class='description' style='min-height: 367px  padding-bottom: 10px;'><article></article></section>");
	$("webform-client-form").addClass("shareForm");
	$(".form-item").wrap("<p/>");
});
</script>