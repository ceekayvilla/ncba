<?php
	/* 
		Carta
		Derrick - widget to pick different input types
	 */
	 
	 
	switch($type){
		case 'select_box':
		//varriables type,inputName,inputTitle,optArrays
		?>
        	<div class="customselect">
            <select  class='switch' name="<?php echo $inputName ?>" id="<?php echo $inputName ?>" >
            	<option value="">Select <?php echo $inputTtitle ?></option>
				<?php foreach($optArrays as $optArray){ ?>
				<option value="<?php echo $optArray->id ?>"><?php echo $optArray->opt_name ?></option>
                <?php } ?>
			</select>
            </div>
            <!--span class="formdivider"></span-->
        <?php
		break;
		
		case 'input_normal':
		
		break;
		
		
		case 'input_date': 
		//inputName,type
		?>
		<input class="datepicker" name="<?php echo $inputName ?>" type="text" placeholder="<?php echo date('d M y'); ?>" />
        <span class="formdivider"></span>
        <?php 
		break;
		
		}//END SWITCH CASE
?>