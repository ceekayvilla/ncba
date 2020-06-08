<div class="search">
	<div class="maxwidth">
		<h3>What data are you looking for?</h3>
		<form action="<?php echo BASE_URL.'proc/home-redirect.php' ?>" method="post">
			<section class="formrow" >
           
				<div class="customselect" style="float:left" >
					<select class="switch" name="data_type" id="data_type">
						<?php foreach($optArrays as $optArray){ ?>
                        <option value="<?php echo $optArray->id ?>" <?php if($cleanData['data_type']==$optArray->id){ echo "selected=selected"; } ?> ><?php echo $optArray->opt_name ?></option>
                        <?php } ?>
					</select>
				</div>
               <div id="row_0" style="float:left;">
              </div>
				
                <div class="width_30" id="row_1">
                    <input class="datepicker" name="start_date" type="text" placeholder="<?php echo date('d F Y',strtotime($startDate)); ?>" 
                        value="<?php echo date('d F Y',strtotime($startDate)); ?>" />
                    <input class="datepicker" name="end_date" type="text" placeholder="<?php echo date('d F Y',strtotime($endDate)); ?>" 
                            value="<?php echo date('d F Y',strtotime($endDate)); ?>"  />
                    <div class="customselect">
                        <select name="duration_type" id="duration_type">
                            <option value="">Duration</option>
                            <?php foreach($durationArrays as $durationArray){ ?>
                            <option value="<?php echo $durationArray->id ?>" <?php if($cleanData['duration_type']==$durationArray->id){ echo "selected=selected"; } ?> ><?php echo $durationArray->opt_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
				<input type="submit" class="refinebutton" value="Refine Data" />
			</section>
            <div class="home_loading"><img src="<?php echo BASE_URL; ?>/img/ajax-loader.gif"></div>
		</form>
		
	</div>
</div>