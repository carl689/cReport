<?php
/**
 * Example using cReport to output a html table
 * @author Carl <carl689@gmail.com>
 */
include('../cReport.php');

$dataSet1 = new cReportDataSet();
$dataSet1->addAttribute('Title','Amazing Story');
$dataSet1->addAttribute('Author','Mr.Awesome');
$dataSet1->addAttribute('Email','Mr@Awesome.com');
$dataSet1->addAttribute('ISBN','54565-5456');
	$bs = new cReportDataSet(); //Nested Data
	$bs->addAttribute('Amazon','1st');
	$bs->addAttribute('NYT','1st');
	$bs->addAttribute('Times','2nd');
	$dataSet1->addAttribute('Best Seller Info',$bs);
	
$dataSet2 = new cReportDataSet('34');//You can name datasets
$dataSet2->addAttribute('Title','The book about numbers');
$dataSet2->addAttribute('Author','Math Women');
$dataSet2->addAttribute('ISBN','554489-6548');		//Notice ISBN,Author are not in the same order as above
$dataSet2->addAttribute('Email','women@math.com');
		$nr1 = new cReport();//Nested Report
			$row1 = new cReportDataSet(); 
			$row1->addAttribute('Amazon','1st');
			$row1->addAttribute('NYT','1st');
			$row1->addAttribute('Times','2nd');
			$row2 = new cReportDataSet(); 
			$row2->addAttribute('Amazon','1st');
			$row2->addAttribute('NYT','1st');
			$row2->addAttribute('Times','2nd');		
		$nr1->setOutput('html');
		$nr1->addDataSet($row1);
		$nr1->addDataSet($row2);
	$dataSet2->addAttribute('Best Seller Info',$nr1);

$r = new cReport();
$r->addDataSet($dataSet1);
$r->addDataSet($dataSet2);

$r->setOutput('html');
echo $r->outputString();
?>