<?php
namespace carl689\cReport;
/**
 * Dataset object. A dataset is a set of information, think of it as a CSV row.
 */
class cReportDataSet{
	private $data = array();
	private $name = null;
	
	/**
	 * Create your dataset
	 * @param string $name Name of your dataset
	 */
	public function __construct($name=null){
		if($name)$this->name = $name;
	}
	
	/**
	 * Get the dataset name
	 * @return string Dataset name
	 */
	public function getName(){
		return $this->name;
	}
	
	/**
	 * Add an attribute.
	 * @see cReportAttribute
	 * @param string $name Attributes name
	 * @param string $value Attributes value
	 * @return true on success
	 */
	public function addAttribute($name,$value){
		if(!empty($name)){
			$this->data[$name] = new cReportAttribute($name, $value);					
		}
		return true;
		//$this->log('Added attribute '.$name);
	}
	/**
	 * Get an attributes value
	 * @param string $name
	 * @return mixed String on success/ null on failsure @todo I don't like this
	 */
	public function getAttribute($name){
		if(isset($this->data[$name])){	
			return $this->data[$name];
		}else{
			return null;
		}
	}
	/**
	 * Get all attributes in this dataset
	 * @return array Contains cReportAttribute objects
	 */
	public function getAttributes(){
		return $this->data;
	}
		
	/**
	 * Modify an existing attributes value
	 * @param string $name Attribute name
	 * @param string $newValue New value
	 * @return boolean True on success / False on failure
	 */
	public function modifyAttributeValue($name,$newValue){
		if(isset($this->data[$name])){			
			$this->data[$name]->setValue($newValue);
			//$this->log('Modified Attribute '.$name.' to '.$newValue);
			return true;
		}else{
			//$this->log('Attribute '.$name.' does not exist in the dataSet',true);
			return false;
		}
		
	}
}
?>
