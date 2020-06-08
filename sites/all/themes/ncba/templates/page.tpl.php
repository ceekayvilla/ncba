<?php 
$path = current_path();
$path_alias = drupal_lookup_path('alias',$path);
$theme_path = path_to_theme();
?>
<?php 
 if (!empty($page['menu'])): 
   print render($page['menu']);
  endif;
  ?>


  <?php if (!empty($page['slideshow'])): ?>
    <section class="banner">
      <?php print render($page['slideshow']); ?>
    </section>
  <?php endif; ?>
  
  <?php 
   if (!empty($page['content'])): 
   print render($page['content']);
  endif;
  ?>


<?php 
 if (!empty($page['footer'])): 
   print render($page['footer']);
  endif;
  ?>


<style type="text/css">
.other_income_source .form-type-checkbox,
/*.form-type-checkbox, */
.existing_mortgage .form-type-radio,
.bancruptcy .form-type-radio,
.loan_currency .form-type-radio,
.loan_purpose .form-type-radio,
.power_of_attorney .form-type-radio,
.marital_status .form-type-radio
 {width: 24%; float:left; margin-right:1px;}

 .biz_account_type .form-type-radio{
 	float: left;
    height: 40px;
    width: auto;
    margin-right: 3%;
}
.account_currency .form-type-radio{
	width:25%;
	float: left;
}
 .employment_nature .form-type-radio{
  width: 45%; float:left; margin-right:5px;
 }
</style>
<?php $product = trim(strip_tags($_GET['product']));
  if($product){ ?> 
<script type="text/javascript">
  $(document).ready(function(){
    $(".accordionContainer .accordionTitle").each(function(index){
      console.log( index + ": " + $( this ).text() );
      var cur_text = $( this ).text().trim();
      if(cur_text.toLowerCase() == '<?php echo strtolower($product); ?>'){
        console.log("Found one");
        $(".accordionContainer .accordionTitle").removeClass('open');
        $(".accordionContainer .accordion").slideUp();
        $(this).addClass("open").next(".accordion").slideDown(function () { });
      }
      
    });

   $("html, body").animate({ scrollTop: $(document).height()-200 }, 2000);

  });

</script>
<?php } ?>

