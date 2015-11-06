<?php
if(!session_id()) session_start();
require_once('../Connections/userbasic.php');

//ini_set('display_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
error_reporting(E_ERROR | E_WARNING | E_PARSE);


date_default_timezone_set("America/Los_Angeles");

$currmonth = date("m");
$curryear = date("y");
$curryearfull = date("Y");
$mstart = date("m/d/y", mktime(0,0,0,$currmonth-1, 1, $curryear));
$mend = date("m/d/y", mktime(0,0,0,$currmonth-0, 0, $curryear));
//rev Date Signup
$t=getdate();
//rev 86400 = sec per day
//$past=$t[0]-(86400*30);
$twstart2=date('m-d-Y',$past);
//$today=date('m-d-Y',$t[0]);
$td=getdate();
$today=date('m-d-Y',$td[0]);
$back=$td[0]-(86400*999); // fix
$past=date('m-d-Y',$back);
$pastshow=date('F Y',$back);
$searchDateString = $past."...".$today;
$searchDateStringfullyear = "1/1/".$curryearfull."..."."12/31/".$curryearfull;



// YOYO SHOW FULL YEAR not 365 but jan 1 to dec 31


/*
$getclient_find = $userbasic->newFindCommand('clients1');
//$getclient_find = $userbasic->newFindCommand('clientsemp1');
$getclient_findCriterions = array(

//
'Client_ID'=>'=='.$_SESSION["nowuser"],

//'Client_ID'=>'=='.'44864 ', 46765

//'Client_ID'=>'=='.'46765',



//'z_webtmp'=>'=='.$rand,

);
foreach($getclient_findCriterions as $key=>$value) {
    $getclient_find->AddFindCriterion($key,$value);
}

fmsSetPage($getclient_find,'getclient',10); 

//$getclient_find->SetPreCommandScript('cc_new_client_emp_inv',$randstuff); 

$getclient_result = $getclient_find->execute(); 

//if(FileMaker::isError($getclient_result)) fmsTrapError($getclient_result,"error.php"); 

fmsSetLastPage($getclient_result,'getclient',10); 

$getclient_row = current($getclient_result->getRecords());


*/



//kill top

//newwwwwwwwwwwwwwwww

//36252 test

//$yum = 36252; // real
$yum = 25658; // house - 25658 - 7104 TMMP ONLY
//tmmmp
//$yum = $_SESSION["nowuser"];
//7104


$rtemp_find = $userbasic->newFindCommand('rantests_emp_list');
//


$rtemp_findCriterions = array(
//'rte_emp::Client_ID'=>'=='.$_SESSION["nowuser"],

'rte_emp::Client_ID'=>'=='.$yum,
'TestRequired'=>'sel',
'RandomTests::TestRequestDate'=> $searchDateStringfullyear,


//'RandomTestID'=>$_GET['id'],
);


foreach($rtemp_findCriterions as $key=>$value) {
    $rtemp_find->AddFindCriterion($key,$value);
}

fmsSetPage($rtemp_find,'rtemp',501); 

$rtemp_find->addSortRule('rte_emp::Last',1,FILEMAKER_SORT_ASCEND); 


$rtemp_result = $rtemp_find->execute(); 

//if(FileMaker::isError($rtemp_result)) fmsTrapError($rtemp_result,"error.php"); 

//if(FileMaker::isError($rtemp_result)) fmsTrapError($rtemp_result,"random_print_none.php?id=".$_GET['id']);




//if(FileMaker::isError($rtemp_result)) fmsTrapError($rtemp_result,"random_print_none.php?id=".$_SESSION["nowuser"]);

fmsSetLastPage($rtemp_result,'rtemp',501); 

$rtemp_row = current($rtemp_result->getRecords());



//keep
$rtemp__RandomTests_portal = fmsRelatedRecord($rtemp_row, 'RandomTests');

/*

$rtemp__ranclients_portal = fmsRelatedRecord($rtemp_row, 'ran_clients');

$rtemp__rteemp_portal = fmsRelatedRecord($rtemp_row, 'rte_emp');


$rtemp__rantoc_portal = fmsRelatedRecord($rtemp_row, 'ran_toc');
$rtemp__rteempclient_portal = fmsRelatedRecord($rtemp_row, 'rte_emp_client');
$rtemp__rteempcltoc_portal = fmsRelatedRecord($rtemp_row, 'rte_emp_cl_toc');
$rtemp__rteTestsCompleteCheck_portal = fmsRelatedRecord($rtemp_row, 'rte_Tests_CompleteCheck');
$rtemp__rteclients4cons_portal = fmsRelatedRecord($rtemp_row, 'rte_clients_4cons');

*/

 
// FMStudio v1.0 - do not remove comment, needed for DreamWeaver support ?>




<!DOCTYPE html>
<html>
<head>
<title>Independent Drivers Consortium Title</title>

<meta name="viewport" content="width=device-width, initial-scale=1"> 





<link rel="stylesheet" href="inc/jq/themes/theme-02.min.css" />
<link rel="stylesheet" href="inc/jq/themes/jquery.mobile.icons.min.css" />

<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<script>
	$(function(){
		$( "[data-role='header'], [data-role='footer']" ).toolbar();
		});
    </script>



<link href="mob.css" rel="stylesheet" type="text/css" />

  
</head>
<body>


<div data-role="header" data-position="fixed" data-theme="a">

<?php include('header-inc.php'); ?>
</div>

<!-- /header -->

<section id="page01111" data-role="page">

<div role="main" class="ui-content">
<div class="content" >
<div class="box1 center1" >
  
      
<!--INSERT START -->

<br><br>

These are recent random test selections and Completion Dates<br>

Year to Date Range: <?php echo $curryearfull; ?>

<!--Date Range: <?php echo $searchDateStringfullyear; ?> -->

<br>


<table border="1" align="center" cellpadding="2" cellspacing="2">
<tr>
<td>Name</td>

<td>Date</td>
<td>Required</td>
<td>Taken</td>
<td>Date Taken</td>
<td>Time Taken</td>
<td>&nbsp;</td>


</tr>



<?php
$_SESSION['completecheck'] = 'notest';
//'YOU DO NOT NEED A TEST';

foreach($rtemp_result->getRecords() as $rtemp_row){
	
if ( $rtemp_row->getField('zdb_test_complete_check2') != 'Yes')
{
$_SESSION['completecheck'] = $completecheck.'yestest';
//'YOU NEED A TEST';
}
	
	
	
	
	
	 ?>
<tr>
<td>



<?php echo mb_convert_case($rtemp_row->getField('rte_emp::First'),MB_CASE_TITLE,"UTF-8"); ?>
 - 
<?php echo mb_convert_case($rtemp_row->getField('rte_emp::Last'),MB_CASE_TITLE,"UTF-8"); ?>





</td>

<td>
<?php echo $rtemp_row->getField('RandomTests::TestRequestDate'); ?>

</td>
<td><?php echo mb_convert_case($rtemp_row->getField('TestRequired'),MB_CASE_TITLE,"UTF-8"); ?>
</td>


<td><?php echo mb_convert_case($rtemp_row->getField('zdb_test_complete_check2'),MB_CASE_TITLE,"UTF-8"); ?>
</td>

<td>

<?php echo $rtemp_row->getField('rte_Tests_CompleteCheck::Test_Date'); ?>


</td>
<td><?php echo $rtemp_row->getField('rte_Tests_CompleteCheck::Test Collection Time'); ?></td>

<td>&nbsp;</td>
</tr>

 <?php } ?>
</table>

<br>





<?php 

if  (isset ($_SESSION['completecheck']) && $_SESSION['completecheck'] == 'yestest')
{
//echo 'YOU NEED A TEST !!!<br><br>';
?>


<!--bigred1_24b print_data_20_b buttonform2_24b -->




<strong><span class="buttonform2_24b">
<?php

echo 'YOU NEED A TEST !!!<br><br>';

// echo $_SESSION['completecheck']; 
 
 ?></span></strong>



<a href="dashboard.php" class="ui-btn ui-btn-a tsize1" rel="external">Return</a>
<br>

<!-- too much for here so skip -->

<!--<a class="ui-btn ui-btn-a tsize1" href="<?php echo $coloc; ?>?zip=<?php echo $shortzip; ?>" rel="external">Drug And Alcohol Testing<br>
Collection Sites</a> -->


<?php 	
	}

?>




<!--bigred1_24b print_data_20_b buttonform2_24b -->
<!--<strong><span class="buttonform2_24b"><?php echo $_SESSION['completecheck']; ?></span></strong>
<br> -->

<!--INSERT END -->

</div><!-- end .box -->
</div><!-- end .content -->
</div><!-- /ui-content -->
  
</section><!-- /page -->

<footer data-role="footer" class="ui-barNAH" data-position="fixed" data-theme="a">
<div class="ui-grid-c boxblue">
<?php include('footer-inc.php'); ?>
</div>
</footer>

<!-- /footer -->

</body>
</html>
