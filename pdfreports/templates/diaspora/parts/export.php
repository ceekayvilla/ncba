<?php if(is_numeric($_SESSION['uID'])){ ?>
<?php $exportArray=array(
					'resource'=>$useTable,
					'duration_type'=>$cleanData['duration_type'],
					'company_id'=>$cleanData['company_id']
				);
				$dataT=$genObj->prepTransmit($exportArray);
				 ?>
<a class="export_to_excel" onClick="MyWindow=window.open('<?php echo BASE_URL."export/resource/".$dataT ?>','Export to Excel',width=600,height=300); return false;" href="javascript:void();" target="_new">Export in excel</a>
<?php } ?>