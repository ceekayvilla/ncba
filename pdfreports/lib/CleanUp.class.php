<?php

class CleanUp extends General{

	public function getAndUpdate($lastId=0,$list=NULL,$limit = 1)
	{
		
		//$list = "3";
		if($list){
			$sql="SELECT A.sid,A.nid,A.completed FROM webform_submissions AS A WHERE A.sid < '{$lastId}'  AND A.nid IN ($list) AND submitted < NOW() - INTERVAL 2 WEEK ";
		}else{
			$sql="SELECT A.sid,A.nid,A.completed FROM webform_submissions AS A WHERE A.sid < '{$lastId}' AND submitted < NOW() - INTERVAL 2 WEEK ";
		}
		
		$entries=$this->execute($sql);

		echo count($entries);
		$datas = array();
		$worksheetPos = array();
		$pos = 0;
		$count = 0;
		foreach ($entries as $key => $entry) 
		{
			$formData = array('delete'=>1);
			$where = " sid = '{$entry->sid}' ";
			$this->update('webform_submitted_data',$formData,$where,$exclude = array());
			$count++;
		}
		echo $count;
		//echo "<pre>";
		//print_r($datas);
		return $datas;
	}
	
}

?>