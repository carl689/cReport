<?php
/**
 * Help generate tabular reports and charts?
 * 
 * Key Features
 * - OO Design
 * - Recursive Data Sets
 * - Named attributes
 * - Export in HTML/XML/CSV 
 * 
 * Example Usage
 * @see example.php
 * 
 * @author Carl <carl689@gmail.com>  
 */
class cReport{
	private $dataSets; //array of Datasets
	private $output; //html table,csv,xml
        private $id = '';
	
	protected $log = array();
	
        /**
         * Sets the initial id
         */
        public function __construct(){
            $this->setId('cReport-'.rand(1,9999));
        }
        
        
	/**
	 * Add a set of information. Think of it as a spreadsheet row
	 * @param cReportDataSet $data
	 */
	public function addDataSet(cReportDataSet $data){		
		$this->dataSets[] = $data;
	}
        
        /**
         * Set an id for this cReport. Example usage is HTML table id
         * @param string $name
         * @return bool True on success
         */
        public function setId($name){
            $this->id = $name;
            return true;
        }
	
	/**
	 * Log what is going on.
	 * @param string $msg Message to log
	 * @param bool $isError Optional, Is this a error message
	 * @return bool True on success
	 */
	private function log($msg,$isError=false){
		$this->log[] = array($msg,$isError);
		return true;
	}
	
	/**
	 * Get logs information
	 * @param bool $includeAll Defaults to False, False shows only error log messages
	 * @todo
	 */
	public function getLogs($includeAll=false){
		if(isset($this->log)){
			
		}
	}
	
	/**
	 * Set output type
	 * @param string $type Accepts html,csv,xml
	 * @return boolean true on success false on failsure
	 */
	public function setOutput($type){
		switch(strtolower($type)){
			case 'html':
				$this->output = 'html';
			break;
			case 'csv':
				$this->output = 'csv';
			break;
			case 'xml':
				$this->output = 'xml';
			break;
			default:
				return false;
			break;
		}
		return true;
	}
	
	/**
	 * Generate output data
	 * @return boolean true on success
	 */
	private function generate(){
		if(!isset($this->output)){
			$this->log('You must set output first',true);
			return false;
		}
		if(!isset($this->dataSets)){
			$this->log('You must add dataSets first',true);
			return false;
		}
		
		switch($this->output){
			case 'html':
				return $this->generateHTML();
			break;
		}
		
		
	}
	
	/**
	 * Generate an HTML table of the added datasets
	 * @param cReportDataSet $recursive
	 * @return string HTML tables
	 */
	private function generateHTML($recursive=null){
		$header = array();		
		$r = null;
		
		if(is_object($recursive)){			
			$dataSets[] = $recursive;
		}else{
			$dataSets = $this->dataSets;
		}
		
		foreach($dataSets as $dataSet){	//Find all headers used			
			foreach($dataSet->getAttributes() as $attribute){
				$header[$attribute->getName()] = $attribute->getName();		
			}			
		}			
		
		$r .= '<tr>';
		$r .= '<th />';//Data set name
		foreach($header as $head){
			$r .= '<th>'.$head.'</th>';
		}
		$r .= '</tr>';
		
		
		foreach($dataSets as $aDataSet){
			$r .= '<tr>';
			$r .= '<td>'.$aDataSet->getName().'</td>';			
			foreach($header as $atrName){				
				$atData = $aDataSet->getAttribute($atrName);
				if($atData){					
					if(is_object($atData->getValue()) && get_class($atData->getValue()) == 'cReportDataSet'){						
						$r .= '<td>'.$this->generateHTML($atData->getValue()).'</td>';//recursive DataSet support here. Will anybody actually use this?
					}elseif(is_object($atData->getValue()) && get_class($atData->getValue()) == 'cReport'){
						//$atData->getValue()->setOutput('html');  //Let them set the output type!
						$r .= '<td>'.$atData->getValue()->outputString('html').'</td>';
					}else{						
						$r .= '<td>'.$atData->getValue().'</td>';	
					}					
				}else{
					$r .= '<td />';
				}
			}
			$r .= '</tr>';
		}		
		
		return '<table id=\''.$this->id.'\' >'.$r.'</table>';
	}
	
	/**
	 * @todo
	 */
	public function outputFile(){
		$file = $this->generate();
		//@todo add file save code here
	}
	
	/**
	 * Return output as a string	
	 * @return string
	 */
	public function outputString(){
		return $this->generate();		
	}
	
}

?>
