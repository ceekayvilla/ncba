<?php
/*
4/11/2013
this is a revamp of general class meant to make it reliable and fit new scenarios
*/
class Db{
	public $result_summary;
	private $connection;
	public $debug_sql;

	function __construct(){
		$this->connection=new MySQLi(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	}//end constructor


	/*
		7/11/2013
		Execute can run sql statments in a single function and return result in an array
	*/
	function execute($sql){
		
		$this->debug_sql.=$sql.'<br><hr>';

		//echo $this->debug_sql;
		//die($sql);
		try{
		$result=$this->connection->query($sql);
		
		$this->result_meta=$result;
		$transactionsarr=array();
		$counter=0;
		while($row=$result->fetch_object()){
			$transactionsarr[$counter]=$row;
			foreach ($transactionsarr[$counter] as $key => $value) {
				$transactionsarr[$counter]->$key=stripslashes(stripslashes($value));
			}
			$counter++;
			}//end while loop
		return $transactionsarr;
		}catch(Exception $e) 
		{ $return='Message: ' .$e->getMessage(); return $return; }
	}//execute

	/* 
	4/11/2013
	create function
	This will inser
	*/
	function create($tablename, $data, $exclude = array()){
		$fields = $values = array();
		if(!is_array($exclude) ){ $exclude = array(); };
		foreach($data as $key=>$dataValues){
			if(!in_array($key, $exclude)){
			$fields[]=$key;
			$values[]="'".$dataValues."'";
			}//end if not in array
		}
 
    	$fields = implode(",", $fields);
    	$values = implode(",", $values);
		
		$sql="INSERT INTO `$tablename` ($fields) VALUES ($values)";
		//echo $sql;
		$this->debug_sql.=$sql."<br>";
		if($tablename=='users'){
		//die($sql);
		}
		//return $sql;
		
		try{ 
		$result=$this->connection->query($sql);
		}catch(Exception $e) { echo 'Message: ' .$e->getMessage(); }
		return $this->connection->insert_id;
	}
	function getColumns($tableName){
		$sql="DESCRIBE `$tableName`";
		$resultColumns=$this->execute($sql);
		$tableColumns=array();
		foreach($resultColumns as $resultColumn){
		$tableColumns[]=$resultColumn->Field;
		}
		return $tableColumns;
	}
	
	function getTables(){
		$sql="SHOW TABLES";
		$resultColumns=$this->execute($sql);
		$tableColumns=array();
		foreach($resultColumns as $resultColumn){
		$tableColumns[]=$resultColumn->Tables_in_real_advisor;
		}
		return $tableColumns;
	}

	function read($tablename, $conditions='', $start=0,$interval=1000000000000, $status=NULL,$order=NULL, $fields='*'){
		if($order==''){ $order='fid'; }

		if($status!=NULL){
			$sql="SELECT $fields FROM $tablename WHERE 1=1 {$conditions}  ORDER BY $order LIMIT $start, $interval";
		}else{
			$sql="SELECT $fields FROM $tablename WHERE 1=1 {$conditions} ORDER BY $order LIMIT $start, $interval";
		}
		//echo $sql;
		if($tablename=='farm_sites'){
		//echo $sql;
		}
		$result=$this->execute($sql);
		return $result;
	}//end update
	
	
	
	function countRecords($tablename, $conditions='', $status=NULL,$order=NULL){
		if($order==''){ $order='id'; }

		if($status){
			$sql="SELECT COUNT(*) AS record_count FROM $tablename WHERE  {$conditions} ";
		}else{
			$sql="SELECT COUNT(*) AS record_count FROM $tablename WHERE  {$conditions} ";
		}
		if($tablename=='users'){
		//die($sql);
		}
		$result=$this->execute($sql);
		return $result;
	}//end update

	/* 19/12/2013. Derrick
	 Update function. Copied from the old general function*/
	function update($table,$data,$where,$exclude = array()){
		$fields = $values = array();
      $sql = "UPDATE ".$table." SET ";
		if( !is_array($exclude) ) $exclude = array($exclude);
		$loopCount = 0;
		foreach(array_keys($data) as $key){
                    if( !in_array($key, $exclude) ) {
                        if($loopCount <= 0){
                            $sql .= " `$key`="."'".addslashes($data[$key])."'";
                        }else {
                            $sql .= " ,`$key`="."'".addslashes($data[$key])."'";
                        }
                        $loopCount++;
                    }
                }
      $sql .= ' WHERE '.$where.' LIMIT 40';
      
      $this->debug_sql.=$sql.'<br><hr>';
	 //die($sql);
		$result=$this->connection->query($sql);
      return $result;
	}//end update function
	

	/* 19/12/2013. Derrick
	This should be really avoided instead use update function above to update status id */
	function delete($tablename,$id){
		$sql="DELETE FROM `$tablename` WHERE id=`$id` LIMIT 1";
		$result=$this->connection->query($sql);
      return $result;
	}//end function delete
	
	public function prepSubmit($var){
		$var=trim($var);
		$var=addslashes(htmlentities($var));
		return $var;
		}//end function
}//end mysql class
?>
