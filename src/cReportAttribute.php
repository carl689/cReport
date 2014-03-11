<?php
namespace carl689\cReport;
/**
 * Attributes are the actual information about a dataset. Think of these as the cells in a spreadsheet
 */
class cReportAttribute{
	private $name = '';
	private $value = '';
	
	/**
	 * Create a new attribute
	 * @param string $name Attributes name
	 * @param string $value Attributes value
	 */
	public function __construct($name,$value){
		$this->name = $name;
		$this->value = $value;
	}
	
	/**
	 * Get the value
	 * @return string
	 */
	public function getValue(){
		return $this->value;
	}
	/**
	 * Set the value
	 * @param string $value
	 * @return boolean True on success
	 */
	public function setValue($value){
		$this->value = $value;
		return true;
	}
	/**
	 * Get name
	 * @return string Name
	 */
	public function getName(){
		return $this->name;
	}
}
?>
