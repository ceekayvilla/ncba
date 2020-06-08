<div class="select_all">
	<label for="select-all">
		<input type="checkbox" name="" id="select-all" />
		Select All
	</label>
	<input class="refinebutton" type="submit" value="Add to Cart">
	<?php if(is_numeric($_SESSION['uID'])){ ?>
	<?php $exportArray=array(
					'resource'=>$useTable,
					'duration_type'=>$cleanData['duration_type'],
					'company_id'=>$cleanData['company_id'],
					'country_id'=>$cleanData['country_id']
				);
				$dataT=$genObj->prepTransmit($exportArray);
				 ?>
<a class="export_to_excel" onClick="MyWindow=window.open('<?php echo BASE_URL."export/".$dataT ?>','Export to Excel',width=600,height=300); return false;" href="javascript:void();" target="_new">Export to Excel</a>
<?php } ?>
	
</div>