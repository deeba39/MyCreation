<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "student_applicantinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php
include_once("ext/applicants.php");
$app=new applicants();
$app_year=get_data("app_year");
if($app_year===false)
{
    
    $app_year=$app->get_admission_year();
    
}
if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
    $programarea_id=(int)get_data("programarea_id");
}
else{
    //use the session value for selection
    $programarea_id=$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];
}
// Create page object
$student_applicant_list = new cstudent_applicant_list();
$Page =& $student_applicant_list;

// Page init
$student_applicant_list->Page_Init();

// Page main
$student_applicant_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($student_applicant->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var student_applicant_list = new ew_Page("student_applicant_list");

// page properties
student_applicant_list.PageID = "list"; // page ID
student_applicant_list.FormID = "fstudent_applicantlist"; // form ID
var EW_PAGE_ID = student_applicant_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
student_applicant_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
student_applicant_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
student_applicant_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($student_applicant->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$student_applicant_list->lTotalRecs = $student_applicant->SelectRecordCount();
	} else {
		if ($rs = $student_applicant_list->LoadRecordset())
			$student_applicant_list->lTotalRecs = $rs->RecordCount();
	}
	$student_applicant_list->lStartRec = 1;
	if ($student_applicant_list->lDisplayRecs <= 0 || ($student_applicant->Export <> "" && $student_applicant->ExportAll)) // Display all records
		$student_applicant_list->lDisplayRecs = $student_applicant_list->lTotalRecs;
	if (!($student_applicant->Export <> "" && $student_applicant->ExportAll))
		$student_applicant_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $student_applicant_list->LoadRecordset($student_applicant_list->lStartRec-1, $student_applicant_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $student_applicant->TableCaption() ?>
<?php if ($student_applicant->Export == "" && $student_applicant->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $student_applicant_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $student_applicant_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $student_applicant_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($student_applicant->Export == "" && $student_applicant->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(student_applicant_list);" style="text-decoration: none;"><img id="student_applicant_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="student_applicant_list_SearchPanel">
<form name="fstudent_applicantlistsrch" id="fstudent_applicantlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="student_applicant">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $student_applicant_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="student_applicantsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$student_applicant_list->ShowMessage();
?>
<?php
    
    

?>
<form action="student_applicantlist.php" method="GET">
	<table>
		<tr>
                        <td>
                            <b>Application Year :</b> 
                                <?php 
                                    $app=new applicants();
                                    if(!$app->get_years()){

                                        echo "<input name='app_year' value='$app_year' title='enter 0 to select all'>";
                                    }
                                    else
                                    {
                                        
                                 ?>
                                <select name="app_year">
                                    <option value="0" >--all---</option>
                                    <?php
                                        $row=$app->fetch();
                                        while($row)
                                        {
                                            $selected="";
                                            if($row['app_year']==$app_year)
                                            {
                                                $selected="selected";
                                            }
                                            echo "<option value=\"{$row['app_year']}\" $selected>{$row['app_year']}</option>";
                                            $row=$app->fetch();
                                        }
                                    }
                                    ?>
                                </select>
			</td>
			<td>
		<?php
                include("ext/programarea.php");
                if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){
                    
                    echo "<b>Program Area/Unit :</b><select name='programarea_id' >";
                    echo "<option value='0'>--include all---</option>";
                    $p=new programareas();
                    if($p->get_programareas()){
                        $row=$p->fetch();
                        while($row){
                            $selected="";
                            if($programarea_id==$row['programarea_id'])
                            {
                                $selected="selected";
                            }

                            echo "<option value='{$row['programarea_id']}' $selected >{$row['programarea_name']}</option>";
                            $row=$p->fetch();
                        }
                    }
				echo "</select> ";
                }else{

                        $p=new programareas();
                        $row=$p->get_programarea($programarea_id);
                        if(!$row){
                                echo "Could not display programarea name.";
                        }else{
                                echo "<b>Program Area :</b> {$row["programarea_name"]} ";
                        }
                }


            ?>

			</td>

			<td colspan="2" align="right">
				<input type="submit" value="get applicants">
			</td>
		</tr>
	</table>
	<input type="hidden" name="ck" value="1">

</form>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fstudent_applicantlist" id="fstudent_applicantlist" class="ewForm" action="" method="post">
<div id="gmp_student_applicant" class="ewGridMiddlePanel">
<?php if ($student_applicant_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $student_applicant->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$student_applicant_list->RenderListOptions();

// Render list options (header, left)
$student_applicant_list->ListOptions->Render("header", "left");
?>
<?php if ($student_applicant->student_applicant_id->Visible) { // student_applicant_id ?>
	<?php if ($student_applicant->SortUrl($student_applicant->student_applicant_id) == "") { ?>
		<td><?php echo $student_applicant->student_applicant_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_applicant->SortUrl($student_applicant->student_applicant_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_applicant->student_applicant_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_applicant->student_applicant_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_applicant->student_applicant_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_applicant->app_submission_year->Visible) { // app_submission_year ?>
	<?php if ($student_applicant->SortUrl($student_applicant->app_submission_year) == "") { ?>
		<td><?php echo $student_applicant->app_submission_year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_applicant->SortUrl($student_applicant->app_submission_year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_applicant->app_submission_year->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_applicant->app_submission_year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_applicant->app_submission_year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_applicant->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
	<?php if ($student_applicant->SortUrl($student_applicant->student_resident_programarea_id) == "") { ?>
		<td><?php echo $student_applicant->student_resident_programarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_applicant->SortUrl($student_applicant->student_resident_programarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_applicant->student_resident_programarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_applicant->student_resident_programarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_applicant->student_resident_programarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_applicant->community_community_id->Visible) { // community_community_id ?>
	<?php if ($student_applicant->SortUrl($student_applicant->community_community_id) == "") { ?>
		<td><?php echo $student_applicant->community_community_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_applicant->SortUrl($student_applicant->community_community_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_applicant->community_community_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_applicant->community_community_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_applicant->community_community_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_applicant->app_status->Visible) { // app_status ?>
	<?php if ($student_applicant->SortUrl($student_applicant->app_status) == "") { ?>
		<td><?php echo $student_applicant->app_status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_applicant->SortUrl($student_applicant->app_status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_applicant->app_status->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_applicant->app_status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_applicant->app_status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_applicant->app_points->Visible) { // app_points ?>
	<?php if ($student_applicant->SortUrl($student_applicant->app_points) == "") { ?>
		<td><?php echo $student_applicant->app_points->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_applicant->SortUrl($student_applicant->app_points) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_applicant->app_points->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_applicant->app_points->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_applicant->app_points->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_applicant->app_grant_id->Visible) { // app_grant_id ?>
	<?php if ($student_applicant->SortUrl($student_applicant->app_grant_id) == "") { ?>
		<td><?php echo $student_applicant->app_grant_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_applicant->SortUrl($student_applicant->app_grant_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_applicant->app_grant_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_applicant->app_grant_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_applicant->app_grant_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_applicant->student_firstname->Visible) { // student_firstname ?>
	<?php if ($student_applicant->SortUrl($student_applicant->student_firstname) == "") { ?>
		<td><?php echo $student_applicant->student_firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_applicant->SortUrl($student_applicant->student_firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_applicant->student_firstname->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_applicant->student_firstname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_applicant->student_firstname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_applicant->student_lastname->Visible) { // student_lastname ?>
	<?php if ($student_applicant->SortUrl($student_applicant->student_lastname) == "") { ?>
		<td><?php echo $student_applicant->student_lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_applicant->SortUrl($student_applicant->student_lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_applicant->student_lastname->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_applicant->student_lastname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_applicant->student_lastname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_applicant->student_gender->Visible) { // student_gender ?>
	<?php if ($student_applicant->SortUrl($student_applicant->student_gender) == "") { ?>
		<td><?php echo $student_applicant->student_gender->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_applicant->SortUrl($student_applicant->student_gender) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_applicant->student_gender->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_applicant->student_gender->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_applicant->student_gender->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_applicant->student_dob->Visible) { // student_dob ?>
	<?php if ($student_applicant->SortUrl($student_applicant->student_dob) == "") { ?>
		<td><?php echo $student_applicant->student_dob->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_applicant->SortUrl($student_applicant->student_dob) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_applicant->student_dob->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_applicant->student_dob->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_applicant->student_dob->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_applicant->sponsored_child_no->Visible) { // sponsored_child_no ?>
	<?php if ($student_applicant->SortUrl($student_applicant->sponsored_child_no) == "") { ?>
		<td><?php echo $student_applicant->sponsored_child_no->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_applicant->SortUrl($student_applicant->sponsored_child_no) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_applicant->sponsored_child_no->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_applicant->sponsored_child_no->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_applicant->sponsored_child_no->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$student_applicant_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($student_applicant->ExportAll && $student_applicant->Export <> "") {
	$student_applicant_list->lStopRec = $student_applicant_list->lTotalRecs;
} else {
	$student_applicant_list->lStopRec = $student_applicant_list->lStartRec + $student_applicant_list->lDisplayRecs - 1; // Set the last record to display
}
$student_applicant_list->lRecCount = $student_applicant_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $student_applicant_list->lStartRec > 1)
		$rs->Move($student_applicant_list->lStartRec - 1);
}

// Initialize aggregate
$student_applicant->RowType = EW_ROWTYPE_AGGREGATEINIT;
$student_applicant_list->RenderRow();
$student_applicant_list->lRowCnt = 0;
while (($student_applicant->CurrentAction == "gridadd" || !$rs->EOF) &&
	$student_applicant_list->lRecCount < $student_applicant_list->lStopRec) {
	$student_applicant_list->lRecCount++;
	if (intval($student_applicant_list->lRecCount) >= intval($student_applicant_list->lStartRec)) {
		$student_applicant_list->lRowCnt++;

	// Init row class and style
	$student_applicant->CssClass = "";
	$student_applicant->CssStyle = "";
	$student_applicant->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($student_applicant->CurrentAction == "gridadd") {
		$student_applicant_list->LoadDefaultValues(); // Load default values
	} else {
		$student_applicant_list->LoadRowValues($rs); // Load row values
	}
	$student_applicant->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$student_applicant_list->RenderRow();

	// Render list options
	$student_applicant_list->RenderListOptions();
?>
	<tr<?php echo $student_applicant->RowAttributes() ?>>
<?php

// Render list options (body, left)
$student_applicant_list->ListOptions->Render("body", "left");
?>
	<?php if ($student_applicant->student_applicant_id->Visible) { // student_applicant_id ?>
		<td<?php echo $student_applicant->student_applicant_id->CellAttributes() ?>>
<div<?php echo $student_applicant->student_applicant_id->ViewAttributes() ?>><?php echo $student_applicant->student_applicant_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_applicant->app_submission_year->Visible) { // app_submission_year ?>
		<td<?php echo $student_applicant->app_submission_year->CellAttributes() ?>>
<div<?php echo $student_applicant->app_submission_year->ViewAttributes() ?>><?php echo $student_applicant->app_submission_year->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_applicant->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
		<td<?php echo $student_applicant->student_resident_programarea_id->CellAttributes() ?>>
<div<?php echo $student_applicant->student_resident_programarea_id->ViewAttributes() ?>><?php echo $student_applicant->student_resident_programarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_applicant->community_community_id->Visible) { // community_community_id ?>
		<td<?php echo $student_applicant->community_community_id->CellAttributes() ?>>
<div<?php echo $student_applicant->community_community_id->ViewAttributes() ?>><?php echo $student_applicant->community_community_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_applicant->app_status->Visible) { // app_status ?>
		<td<?php echo $student_applicant->app_status->CellAttributes() ?>>
<div<?php echo $student_applicant->app_status->ViewAttributes() ?>><?php echo $student_applicant->app_status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_applicant->app_points->Visible) { // app_points ?>
		<td<?php echo $student_applicant->app_points->CellAttributes() ?>>
<div<?php echo $student_applicant->app_points->ViewAttributes() ?>><?php echo $student_applicant->app_points->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_applicant->app_grant_id->Visible) { // app_grant_id ?>
		<td<?php echo $student_applicant->app_grant_id->CellAttributes() ?>>
<div<?php echo $student_applicant->app_grant_id->ViewAttributes() ?>><?php echo $student_applicant->app_grant_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_applicant->student_firstname->Visible) { // student_firstname ?>
		<td<?php echo $student_applicant->student_firstname->CellAttributes() ?>>
<div<?php echo $student_applicant->student_firstname->ViewAttributes() ?>><?php echo $student_applicant->student_firstname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_applicant->student_lastname->Visible) { // student_lastname ?>
		<td<?php echo $student_applicant->student_lastname->CellAttributes() ?>>
<div<?php echo $student_applicant->student_lastname->ViewAttributes() ?>><?php echo $student_applicant->student_lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_applicant->student_gender->Visible) { // student_gender ?>
		<td<?php echo $student_applicant->student_gender->CellAttributes() ?>>
<div<?php echo $student_applicant->student_gender->ViewAttributes() ?>><?php echo $student_applicant->student_gender->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_applicant->student_dob->Visible) { // student_dob ?>
		<td<?php echo $student_applicant->student_dob->CellAttributes() ?>>
<div<?php echo $student_applicant->student_dob->ViewAttributes() ?>><?php echo $student_applicant->student_dob->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_applicant->sponsored_child_no->Visible) { // sponsored_child_no ?>
		<td<?php echo $student_applicant->sponsored_child_no->CellAttributes() ?>>
<div<?php echo $student_applicant->sponsored_child_no->ViewAttributes() ?>><?php echo $student_applicant->sponsored_child_no->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$student_applicant_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($student_applicant->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($student_applicant->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($student_applicant->CurrentAction <> "gridadd" && $student_applicant->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($student_applicant_list->Pager)) $student_applicant_list->Pager = new cPrevNextPager($student_applicant_list->lStartRec, $student_applicant_list->lDisplayRecs, $student_applicant_list->lTotalRecs) ?>
<?php if ($student_applicant_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($student_applicant_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $student_applicant_list->PageUrl() ?>start=<?php echo $student_applicant_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($student_applicant_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $student_applicant_list->PageUrl() ?>start=<?php echo $student_applicant_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $student_applicant_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($student_applicant_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $student_applicant_list->PageUrl() ?>start=<?php echo $student_applicant_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($student_applicant_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $student_applicant_list->PageUrl() ?>start=<?php echo $student_applicant_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $student_applicant_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $student_applicant_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $student_applicant_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $student_applicant_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($student_applicant_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($student_applicant_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $student_applicant_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($student_applicant->Export == "" && $student_applicant->CurrentAction == "") { ?>
<?php } ?>
<?php if ($student_applicant->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$student_applicant_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cstudent_applicant_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'student_applicant';

	// Page object name
	var $PageObjName = 'student_applicant_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $student_applicant;
		if ($student_applicant->UseTokenInUrl) $PageUrl .= "t=" . $student_applicant->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $student_applicant;
		if ($student_applicant->UseTokenInUrl) {
			if ($objForm)
				return ($student_applicant->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($student_applicant->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstudent_applicant_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (student_applicant)
		$GLOBALS["student_applicant"] = new cstudent_applicant();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["student_applicant"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "student_applicantdelete.php";
		$this->MultiUpdateUrl = "student_applicantupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'student_applicant', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $student_applicant;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$student_applicant->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$student_applicant->Export = $_POST["exporttype"];
		} else {
			$student_applicant->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $student_applicant->Export; // Get export parameter, used in header
		$gsExportFile = $student_applicant->TableVar; // Get export file, used in header
		if ($student_applicant->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($student_applicant->Export == "csv") {
			header('Content-Type: application/csv');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
		}

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 20;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $student_applicant;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$student_applicant->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($student_applicant->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $student_applicant->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$student_applicant->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$student_applicant->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$student_applicant->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $student_applicant->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$student_applicant->setSessionWhere($sFilter);
		$student_applicant->CurrentFilter = "";

		// Export data only
		if (in_array($student_applicant->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($student_applicant->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $student_applicant;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $student_applicant->student_applicant_id, FALSE); // student_applicant_id
		$this->BuildSearchSql($sWhere, $student_applicant->app_submission_year, FALSE); // app_submission_year
		$this->BuildSearchSql($sWhere, $student_applicant->student_resident_programarea_id, FALSE); // student_resident_programarea_id
		$this->BuildSearchSql($sWhere, $student_applicant->community_community_id, FALSE); // community_community_id
		$this->BuildSearchSql($sWhere, $student_applicant->app_status, FALSE); // app_status
		$this->BuildSearchSql($sWhere, $student_applicant->app_points, FALSE); // app_points
		$this->BuildSearchSql($sWhere, $student_applicant->app_grant_id, FALSE); // app_grant_id
		$this->BuildSearchSql($sWhere, $student_applicant->student_firstname, FALSE); // student_firstname
		$this->BuildSearchSql($sWhere, $student_applicant->student_middlename, FALSE); // student_middlename
		$this->BuildSearchSql($sWhere, $student_applicant->student_lastname, FALSE); // student_lastname
		$this->BuildSearchSql($sWhere, $student_applicant->student_gender, FALSE); // student_gender
		$this->BuildSearchSql($sWhere, $student_applicant->student_dob, FALSE); // student_dob
		$this->BuildSearchSql($sWhere, $student_applicant->app_mother_name, FALSE); // app_mother_name
		$this->BuildSearchSql($sWhere, $student_applicant->app_mother_isalive, FALSE); // app_mother_isalive
		$this->BuildSearchSql($sWhere, $student_applicant->app_mother_occupation, FALSE); // app_mother_occupation
		$this->BuildSearchSql($sWhere, $student_applicant->app_father_name, FALSE); // app_father_name
		$this->BuildSearchSql($sWhere, $student_applicant->app_father_occupation, FALSE); // app_father_occupation
		$this->BuildSearchSql($sWhere, $student_applicant->app_father_isalive, FALSE); // app_father_isalive
		$this->BuildSearchSql($sWhere, $student_applicant->app_guardian_name, FALSE); // app_guardian_name
		$this->BuildSearchSql($sWhere, $student_applicant->app_guardian_relation, FALSE); // app_guardian_relation
		$this->BuildSearchSql($sWhere, $student_applicant->app_guardian_occupation, FALSE); // app_guardian_occupation
		$this->BuildSearchSql($sWhere, $student_applicant->sponsored_child_no, FALSE); // sponsored_child_no
		$this->BuildSearchSql($sWhere, $student_applicant->student_grades, FALSE); // student_grades
		$this->BuildSearchSql($sWhere, $student_applicant->student_address, FALSE); // student_address
		$this->BuildSearchSql($sWhere, $student_applicant->student_admitted_school_id, FALSE); // student_admitted_school_id
		$this->BuildSearchSql($sWhere, $student_applicant->app_primary_school_id, FALSE); // app_primary_school_id
		$this->BuildSearchSql($sWhere, $student_applicant->app_junior_secondary_id, FALSE); // app_junior_secondary_id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($student_applicant->student_applicant_id); // student_applicant_id
			$this->SetSearchParm($student_applicant->app_submission_year); // app_submission_year
			$this->SetSearchParm($student_applicant->student_resident_programarea_id); // student_resident_programarea_id
			$this->SetSearchParm($student_applicant->community_community_id); // community_community_id
			$this->SetSearchParm($student_applicant->app_status); // app_status
			$this->SetSearchParm($student_applicant->app_points); // app_points
			$this->SetSearchParm($student_applicant->app_grant_id); // app_grant_id
			$this->SetSearchParm($student_applicant->student_firstname); // student_firstname
			$this->SetSearchParm($student_applicant->student_middlename); // student_middlename
			$this->SetSearchParm($student_applicant->student_lastname); // student_lastname
			$this->SetSearchParm($student_applicant->student_gender); // student_gender
			$this->SetSearchParm($student_applicant->student_dob); // student_dob
			$this->SetSearchParm($student_applicant->app_mother_name); // app_mother_name
			$this->SetSearchParm($student_applicant->app_mother_isalive); // app_mother_isalive
			$this->SetSearchParm($student_applicant->app_mother_occupation); // app_mother_occupation
			$this->SetSearchParm($student_applicant->app_father_name); // app_father_name
			$this->SetSearchParm($student_applicant->app_father_occupation); // app_father_occupation
			$this->SetSearchParm($student_applicant->app_father_isalive); // app_father_isalive
			$this->SetSearchParm($student_applicant->app_guardian_name); // app_guardian_name
			$this->SetSearchParm($student_applicant->app_guardian_relation); // app_guardian_relation
			$this->SetSearchParm($student_applicant->app_guardian_occupation); // app_guardian_occupation
			$this->SetSearchParm($student_applicant->sponsored_child_no); // sponsored_child_no
			$this->SetSearchParm($student_applicant->student_grades); // student_grades
			$this->SetSearchParm($student_applicant->student_address); // student_address
			$this->SetSearchParm($student_applicant->student_admitted_school_id); // student_admitted_school_id
			$this->SetSearchParm($student_applicant->app_primary_school_id); // app_primary_school_id
			$this->SetSearchParm($student_applicant->app_junior_secondary_id); // app_junior_secondary_id
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $student_applicant;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$student_applicant->setAdvancedSearch("x_$FldParm", $FldVal);
		$student_applicant->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$student_applicant->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$student_applicant->setAdvancedSearch("y_$FldParm", $FldVal2);
		$student_applicant->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $student_applicant;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $student_applicant->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $student_applicant->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $student_applicant->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $student_applicant->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $student_applicant->GetAdvancedSearch("w_$FldParm");
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $student_applicant;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$student_applicant->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $student_applicant;
		$student_applicant->setAdvancedSearch("x_student_applicant_id", "");
		$student_applicant->setAdvancedSearch("x_app_submission_year", "");
		$student_applicant->setAdvancedSearch("x_student_resident_programarea_id", "");
		$student_applicant->setAdvancedSearch("x_community_community_id", "");
		$student_applicant->setAdvancedSearch("x_app_status", "");
		$student_applicant->setAdvancedSearch("x_app_points", "");
		$student_applicant->setAdvancedSearch("x_app_grant_id", "");
		$student_applicant->setAdvancedSearch("x_student_firstname", "");
		$student_applicant->setAdvancedSearch("x_student_middlename", "");
		$student_applicant->setAdvancedSearch("x_student_lastname", "");
		$student_applicant->setAdvancedSearch("x_student_gender", "");
		$student_applicant->setAdvancedSearch("x_student_dob", "");
		$student_applicant->setAdvancedSearch("y_student_dob", "");
		$student_applicant->setAdvancedSearch("x_app_mother_name", "");
		$student_applicant->setAdvancedSearch("x_app_mother_isalive", "");
		$student_applicant->setAdvancedSearch("x_app_mother_occupation", "");
		$student_applicant->setAdvancedSearch("x_app_father_name", "");
		$student_applicant->setAdvancedSearch("x_app_father_occupation", "");
		$student_applicant->setAdvancedSearch("x_app_father_isalive", "");
		$student_applicant->setAdvancedSearch("x_app_guardian_name", "");
		$student_applicant->setAdvancedSearch("x_app_guardian_relation", "");
		$student_applicant->setAdvancedSearch("x_app_guardian_occupation", "");
		$student_applicant->setAdvancedSearch("x_sponsored_child_no", "");
		$student_applicant->setAdvancedSearch("x_student_grades", "");
		$student_applicant->setAdvancedSearch("x_student_address", "");
		$student_applicant->setAdvancedSearch("x_student_admitted_school_id", "");
		$student_applicant->setAdvancedSearch("x_app_primary_school_id", "");
		$student_applicant->setAdvancedSearch("x_app_junior_secondary_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $student_applicant;
		$bRestore = TRUE;
		if (@$_GET["x_student_applicant_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_submission_year"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_resident_programarea_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_community_community_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_status"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_points"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_grant_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_firstname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_middlename"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_lastname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_gender"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_dob"] <> "") $bRestore = FALSE;
		if (@$_GET["y_student_dob"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_mother_name"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_mother_isalive"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_mother_occupation"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_father_name"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_father_occupation"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_father_isalive"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_guardian_name"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_guardian_relation"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_guardian_occupation"] <> "") $bRestore = FALSE;
		if (@$_GET["x_sponsored_child_no"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_grades"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_address"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_admitted_school_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_primary_school_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_app_junior_secondary_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($student_applicant->student_applicant_id);
			$this->GetSearchParm($student_applicant->app_submission_year);
			$this->GetSearchParm($student_applicant->student_resident_programarea_id);
			$this->GetSearchParm($student_applicant->community_community_id);
			$this->GetSearchParm($student_applicant->app_status);
			$this->GetSearchParm($student_applicant->app_points);
			$this->GetSearchParm($student_applicant->app_grant_id);
			$this->GetSearchParm($student_applicant->student_firstname);
			$this->GetSearchParm($student_applicant->student_middlename);
			$this->GetSearchParm($student_applicant->student_lastname);
			$this->GetSearchParm($student_applicant->student_gender);
			$this->GetSearchParm($student_applicant->student_dob);
			$this->GetSearchParm($student_applicant->app_mother_name);
			$this->GetSearchParm($student_applicant->app_mother_isalive);
			$this->GetSearchParm($student_applicant->app_mother_occupation);
			$this->GetSearchParm($student_applicant->app_father_name);
			$this->GetSearchParm($student_applicant->app_father_occupation);
			$this->GetSearchParm($student_applicant->app_father_isalive);
			$this->GetSearchParm($student_applicant->app_guardian_name);
			$this->GetSearchParm($student_applicant->app_guardian_relation);
			$this->GetSearchParm($student_applicant->app_guardian_occupation);
			$this->GetSearchParm($student_applicant->sponsored_child_no);
			$this->GetSearchParm($student_applicant->student_grades);
			$this->GetSearchParm($student_applicant->student_address);
			$this->GetSearchParm($student_applicant->student_admitted_school_id);
			$this->GetSearchParm($student_applicant->app_primary_school_id);
			$this->GetSearchParm($student_applicant->app_junior_secondary_id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $student_applicant;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$student_applicant->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$student_applicant->CurrentOrderType = @$_GET["ordertype"];
			$student_applicant->UpdateSort($student_applicant->student_applicant_id); // student_applicant_id
			$student_applicant->UpdateSort($student_applicant->app_submission_year); // app_submission_year
			$student_applicant->UpdateSort($student_applicant->student_resident_programarea_id); // student_resident_programarea_id
			$student_applicant->UpdateSort($student_applicant->community_community_id); // community_community_id
			$student_applicant->UpdateSort($student_applicant->app_status); // app_status
			$student_applicant->UpdateSort($student_applicant->app_points); // app_points
			$student_applicant->UpdateSort($student_applicant->app_grant_id); // app_grant_id
			$student_applicant->UpdateSort($student_applicant->student_firstname); // student_firstname
			$student_applicant->UpdateSort($student_applicant->student_lastname); // student_lastname
			$student_applicant->UpdateSort($student_applicant->student_gender); // student_gender
			$student_applicant->UpdateSort($student_applicant->student_dob); // student_dob
			$student_applicant->UpdateSort($student_applicant->sponsored_child_no); // sponsored_child_no
			$student_applicant->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $student_applicant;
		$sOrderBy = $student_applicant->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($student_applicant->SqlOrderBy() <> "") {
				$sOrderBy = $student_applicant->SqlOrderBy();
				$student_applicant->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $student_applicant;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$student_applicant->setSessionOrderBy($sOrderBy);
				$student_applicant->student_applicant_id->setSort("");
				$student_applicant->app_submission_year->setSort("");
				$student_applicant->student_resident_programarea_id->setSort("");
				$student_applicant->community_community_id->setSort("");
				$student_applicant->app_status->setSort("");
				$student_applicant->app_points->setSort("");
				$student_applicant->app_grant_id->setSort("");
				$student_applicant->student_firstname->setSort("");
				$student_applicant->student_lastname->setSort("");
				$student_applicant->student_gender->setSort("");
				$student_applicant->student_dob->setSort("");
				$student_applicant->sponsored_child_no->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$student_applicant->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $student_applicant;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = FALSE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

		// "copy"
		$this->ListOptions->Add("copy");
		$item =& $this->ListOptions->Items["copy"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd();
		$item->OnLeft = FALSE;

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($student_applicant->Export <> "" ||
			$student_applicant->CurrentAction == "gridadd" ||
			$student_applicant->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $student_applicant;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . "<img src=\"images/view.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("ViewLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . "<img src=\"images/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->CanAdd() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . "<img src=\"images/copy.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("CopyLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("CopyLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . "<img src=\"images/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $student_applicant;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $student_applicant;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$student_applicant->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$student_applicant->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $student_applicant->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$student_applicant->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$student_applicant->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$student_applicant->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $student_applicant;

		// Load search values
		// student_applicant_id

		$student_applicant->student_applicant_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_applicant_id"]);
		$student_applicant->student_applicant_id->AdvancedSearch->SearchOperator = @$_GET["z_student_applicant_id"];

		// app_submission_year
		$student_applicant->app_submission_year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_submission_year"]);
		$student_applicant->app_submission_year->AdvancedSearch->SearchOperator = @$_GET["z_app_submission_year"];

		// student_resident_programarea_id
		$student_applicant->student_resident_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_resident_programarea_id"]);
		$student_applicant->student_resident_programarea_id->AdvancedSearch->SearchOperator = @$_GET["z_student_resident_programarea_id"];

		// community_community_id
		$student_applicant->community_community_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_community_community_id"]);
		$student_applicant->community_community_id->AdvancedSearch->SearchOperator = @$_GET["z_community_community_id"];

		// app_status
		$student_applicant->app_status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_status"]);
		$student_applicant->app_status->AdvancedSearch->SearchOperator = @$_GET["z_app_status"];

		// app_points
		$student_applicant->app_points->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_points"]);
		$student_applicant->app_points->AdvancedSearch->SearchOperator = @$_GET["z_app_points"];

		// app_grant_id
		$student_applicant->app_grant_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_grant_id"]);
		$student_applicant->app_grant_id->AdvancedSearch->SearchOperator = @$_GET["z_app_grant_id"];

		// student_firstname
		$student_applicant->student_firstname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_firstname"]);
		$student_applicant->student_firstname->AdvancedSearch->SearchOperator = @$_GET["z_student_firstname"];

		// student_middlename
		$student_applicant->student_middlename->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_middlename"]);
		$student_applicant->student_middlename->AdvancedSearch->SearchOperator = @$_GET["z_student_middlename"];

		// student_lastname
		$student_applicant->student_lastname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_lastname"]);
		$student_applicant->student_lastname->AdvancedSearch->SearchOperator = @$_GET["z_student_lastname"];

		// student_gender
		$student_applicant->student_gender->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_gender"]);
		$student_applicant->student_gender->AdvancedSearch->SearchOperator = @$_GET["z_student_gender"];

		// student_dob
		$student_applicant->student_dob->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_dob"]);
		$student_applicant->student_dob->AdvancedSearch->SearchOperator = @$_GET["z_student_dob"];
		$student_applicant->student_dob->AdvancedSearch->SearchCondition = @$_GET["v_student_dob"];
		$student_applicant->student_dob->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_student_dob"]);
		$student_applicant->student_dob->AdvancedSearch->SearchOperator2 = @$_GET["w_student_dob"];

		// app_mother_name
		$student_applicant->app_mother_name->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_mother_name"]);
		$student_applicant->app_mother_name->AdvancedSearch->SearchOperator = @$_GET["z_app_mother_name"];

		// app_mother_isalive
		$student_applicant->app_mother_isalive->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_mother_isalive"]);
		$student_applicant->app_mother_isalive->AdvancedSearch->SearchOperator = @$_GET["z_app_mother_isalive"];

		// app_mother_occupation
		$student_applicant->app_mother_occupation->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_mother_occupation"]);
		$student_applicant->app_mother_occupation->AdvancedSearch->SearchOperator = @$_GET["z_app_mother_occupation"];

		// app_father_name
		$student_applicant->app_father_name->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_father_name"]);
		$student_applicant->app_father_name->AdvancedSearch->SearchOperator = @$_GET["z_app_father_name"];

		// app_father_occupation
		$student_applicant->app_father_occupation->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_father_occupation"]);
		$student_applicant->app_father_occupation->AdvancedSearch->SearchOperator = @$_GET["z_app_father_occupation"];

		// app_father_isalive
		$student_applicant->app_father_isalive->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_father_isalive"]);
		$student_applicant->app_father_isalive->AdvancedSearch->SearchOperator = @$_GET["z_app_father_isalive"];

		// app_guardian_name
		$student_applicant->app_guardian_name->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_guardian_name"]);
		$student_applicant->app_guardian_name->AdvancedSearch->SearchOperator = @$_GET["z_app_guardian_name"];

		// app_guardian_relation
		$student_applicant->app_guardian_relation->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_guardian_relation"]);
		$student_applicant->app_guardian_relation->AdvancedSearch->SearchOperator = @$_GET["z_app_guardian_relation"];

		// app_guardian_occupation
		$student_applicant->app_guardian_occupation->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_guardian_occupation"]);
		$student_applicant->app_guardian_occupation->AdvancedSearch->SearchOperator = @$_GET["z_app_guardian_occupation"];

		// sponsored_child_no
		$student_applicant->sponsored_child_no->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_sponsored_child_no"]);
		$student_applicant->sponsored_child_no->AdvancedSearch->SearchOperator = @$_GET["z_sponsored_child_no"];

		// student_grades
		$student_applicant->student_grades->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_grades"]);
		$student_applicant->student_grades->AdvancedSearch->SearchOperator = @$_GET["z_student_grades"];

		// student_address
		$student_applicant->student_address->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_address"]);
		$student_applicant->student_address->AdvancedSearch->SearchOperator = @$_GET["z_student_address"];

		// student_admitted_school_id
		$student_applicant->student_admitted_school_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_admitted_school_id"]);
		$student_applicant->student_admitted_school_id->AdvancedSearch->SearchOperator = @$_GET["z_student_admitted_school_id"];

		// app_primary_school_id
		$student_applicant->app_primary_school_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_primary_school_id"]);
		$student_applicant->app_primary_school_id->AdvancedSearch->SearchOperator = @$_GET["z_app_primary_school_id"];

		// app_junior_secondary_id
		$student_applicant->app_junior_secondary_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_app_junior_secondary_id"]);
		$student_applicant->app_junior_secondary_id->AdvancedSearch->SearchOperator = @$_GET["z_app_junior_secondary_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $student_applicant;

		// Call Recordset Selecting event
		$student_applicant->Recordset_Selecting($student_applicant->CurrentFilter);

		// Load List page SQL
		$sSql = $student_applicant->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$student_applicant->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $student_applicant;
		$sFilter = $student_applicant->KeyFilter();

		// Call Row Selecting event
		$student_applicant->Row_Selecting($sFilter);

		// Load SQL based on filter
		$student_applicant->CurrentFilter = $sFilter;
		$sSql = $student_applicant->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$student_applicant->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $student_applicant;
		$student_applicant->student_applicant_id->setDbValue($rs->fields('student_applicant_id'));
		$student_applicant->app_submission_year->setDbValue($rs->fields('app_submission_year'));
		$student_applicant->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$student_applicant->community_community_id->setDbValue($rs->fields('community_community_id'));
		$student_applicant->app_status->setDbValue($rs->fields('app_status'));
		$student_applicant->app_points->setDbValue($rs->fields('app_points'));
		$student_applicant->app_grant_id->setDbValue($rs->fields('app_grant_id'));
		$student_applicant->app_amount->setDbValue($rs->fields('app_amount'));
		$student_applicant->student_firstname->setDbValue($rs->fields('student_firstname'));
		$student_applicant->student_middlename->setDbValue($rs->fields('student_middlename'));
		$student_applicant->student_lastname->setDbValue($rs->fields('student_lastname'));
		$student_applicant->student_gender->setDbValue($rs->fields('student_gender'));
		$student_applicant->student_dob->setDbValue($rs->fields('student_dob'));
		$student_applicant->app_mother_name->setDbValue($rs->fields('app_mother_name'));
		$student_applicant->app_mother_isalive->setDbValue($rs->fields('app_mother_isalive'));
		$student_applicant->app_mother_occupation->setDbValue($rs->fields('app_mother_occupation'));
		$student_applicant->app_father_name->setDbValue($rs->fields('app_father_name'));
		$student_applicant->app_father_occupation->setDbValue($rs->fields('app_father_occupation'));
		$student_applicant->app_father_isalive->setDbValue($rs->fields('app_father_isalive'));
		$student_applicant->student_picture->Upload->DbValue = $rs->fields('student_picture');
		$student_applicant->app_guardian_name->setDbValue($rs->fields('app_guardian_name'));
		$student_applicant->app_guardian_relation->setDbValue($rs->fields('app_guardian_relation'));
		$student_applicant->app_guardian_occupation->setDbValue($rs->fields('app_guardian_occupation'));
		$student_applicant->app_referees->setDbValue($rs->fields('app_referees'));
		$student_applicant->sponsored_child_no->setDbValue($rs->fields('sponsored_child_no'));
		$student_applicant->student_grades->setDbValue($rs->fields('student_grades'));
		$student_applicant->student_address->setDbValue($rs->fields('student_address'));
		$student_applicant->student_telephone_1->setDbValue($rs->fields('student_telephone_1'));
		$student_applicant->student_telephone_2->setDbValue($rs->fields('student_telephone_2'));
		$student_applicant->student_admitted_school_id->setDbValue($rs->fields('student_admitted_school_id'));
		$student_applicant->app_primary_school_id->setDbValue($rs->fields('app_primary_school_id'));
		$student_applicant->app_junior_secondary_id->setDbValue($rs->fields('app_junior_secondary_id'));
		$student_applicant->app_scanneddocument->Upload->DbValue = $rs->fields('app_scanneddocument');
		$student_applicant->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $student_applicant;

		// Initialize URLs
		$this->ViewUrl = $student_applicant->ViewUrl();
		$this->EditUrl = $student_applicant->EditUrl();
		$this->InlineEditUrl = $student_applicant->InlineEditUrl();
		$this->CopyUrl = $student_applicant->CopyUrl();
		$this->InlineCopyUrl = $student_applicant->InlineCopyUrl();
		$this->DeleteUrl = $student_applicant->DeleteUrl();

		// Call Row_Rendering event
		$student_applicant->Row_Rendering();

		// Common render codes for all row types
		// student_applicant_id

		$student_applicant->student_applicant_id->CellCssStyle = ""; $student_applicant->student_applicant_id->CellCssClass = "";
		$student_applicant->student_applicant_id->CellAttrs = array(); $student_applicant->student_applicant_id->ViewAttrs = array(); $student_applicant->student_applicant_id->EditAttrs = array();

		// app_submission_year
		$student_applicant->app_submission_year->CellCssStyle = ""; $student_applicant->app_submission_year->CellCssClass = "";
		$student_applicant->app_submission_year->CellAttrs = array(); $student_applicant->app_submission_year->ViewAttrs = array(); $student_applicant->app_submission_year->EditAttrs = array();

		// student_resident_programarea_id
		$student_applicant->student_resident_programarea_id->CellCssStyle = ""; $student_applicant->student_resident_programarea_id->CellCssClass = "";
		$student_applicant->student_resident_programarea_id->CellAttrs = array(); $student_applicant->student_resident_programarea_id->ViewAttrs = array(); $student_applicant->student_resident_programarea_id->EditAttrs = array();

		// community_community_id
		$student_applicant->community_community_id->CellCssStyle = ""; $student_applicant->community_community_id->CellCssClass = "";
		$student_applicant->community_community_id->CellAttrs = array(); $student_applicant->community_community_id->ViewAttrs = array(); $student_applicant->community_community_id->EditAttrs = array();

		// app_status
		$student_applicant->app_status->CellCssStyle = ""; $student_applicant->app_status->CellCssClass = "";
		$student_applicant->app_status->CellAttrs = array(); $student_applicant->app_status->ViewAttrs = array(); $student_applicant->app_status->EditAttrs = array();

		// app_points
		$student_applicant->app_points->CellCssStyle = ""; $student_applicant->app_points->CellCssClass = "";
		$student_applicant->app_points->CellAttrs = array(); $student_applicant->app_points->ViewAttrs = array(); $student_applicant->app_points->EditAttrs = array();

		// app_grant_id
		$student_applicant->app_grant_id->CellCssStyle = ""; $student_applicant->app_grant_id->CellCssClass = "";
		$student_applicant->app_grant_id->CellAttrs = array(); $student_applicant->app_grant_id->ViewAttrs = array(); $student_applicant->app_grant_id->EditAttrs = array();

		// student_firstname
		$student_applicant->student_firstname->CellCssStyle = ""; $student_applicant->student_firstname->CellCssClass = "";
		$student_applicant->student_firstname->CellAttrs = array(); $student_applicant->student_firstname->ViewAttrs = array(); $student_applicant->student_firstname->EditAttrs = array();

		// student_lastname
		$student_applicant->student_lastname->CellCssStyle = ""; $student_applicant->student_lastname->CellCssClass = "";
		$student_applicant->student_lastname->CellAttrs = array(); $student_applicant->student_lastname->ViewAttrs = array(); $student_applicant->student_lastname->EditAttrs = array();

		// student_gender
		$student_applicant->student_gender->CellCssStyle = ""; $student_applicant->student_gender->CellCssClass = "";
		$student_applicant->student_gender->CellAttrs = array(); $student_applicant->student_gender->ViewAttrs = array(); $student_applicant->student_gender->EditAttrs = array();

		// student_dob
		$student_applicant->student_dob->CellCssStyle = ""; $student_applicant->student_dob->CellCssClass = "";
		$student_applicant->student_dob->CellAttrs = array(); $student_applicant->student_dob->ViewAttrs = array(); $student_applicant->student_dob->EditAttrs = array();

		// sponsored_child_no
		$student_applicant->sponsored_child_no->CellCssStyle = ""; $student_applicant->sponsored_child_no->CellCssClass = "";
		$student_applicant->sponsored_child_no->CellAttrs = array(); $student_applicant->sponsored_child_no->ViewAttrs = array(); $student_applicant->sponsored_child_no->EditAttrs = array();
		if ($student_applicant->RowType == EW_ROWTYPE_VIEW) { // View row

			// student_applicant_id
			$student_applicant->student_applicant_id->ViewValue = $student_applicant->student_applicant_id->CurrentValue;
			$student_applicant->student_applicant_id->CssStyle = "";
			$student_applicant->student_applicant_id->CssClass = "";
			$student_applicant->student_applicant_id->ViewCustomAttributes = "";

			// app_submission_year
			$student_applicant->app_submission_year->ViewValue = $student_applicant->app_submission_year->CurrentValue;
			if (strval($student_applicant->app_submission_year->CurrentValue) <> "") {
				$sFilterWrk = "`app_year` = " . ew_AdjustSql($student_applicant->app_submission_year->CurrentValue) . "";
			$sSqlWrk = "SELECT `app_year` FROM `academic_year`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "active='ACTIVE'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `app_year` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_submission_year->ViewValue = $rswrk->fields('app_year');
					$rswrk->Close();
				} else {
					$student_applicant->app_submission_year->ViewValue = $student_applicant->app_submission_year->CurrentValue;
				}
			} else {
				$student_applicant->app_submission_year->ViewValue = NULL;
			}
			$student_applicant->app_submission_year->CssStyle = "";
			$student_applicant->app_submission_year->CssClass = "";
			$student_applicant->app_submission_year->ViewCustomAttributes = "";

			// student_resident_programarea_id
			if (strval($student_applicant->student_resident_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($student_applicant->student_resident_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$student_applicant->student_resident_programarea_id->ViewValue = $student_applicant->student_resident_programarea_id->CurrentValue;
				}
			} else {
				$student_applicant->student_resident_programarea_id->ViewValue = NULL;
			}
			$student_applicant->student_resident_programarea_id->CssStyle = "";
			$student_applicant->student_resident_programarea_id->CssClass = "";
			$student_applicant->student_resident_programarea_id->ViewCustomAttributes = "";

			// community_community_id
			if (strval($student_applicant->community_community_id->CurrentValue) <> "") {
				$sFilterWrk = "`community_id` = " . ew_AdjustSql($student_applicant->community_community_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `community` FROM `community`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->community_community_id->ViewValue = $rswrk->fields('community');
					$rswrk->Close();
				} else {
					$student_applicant->community_community_id->ViewValue = $student_applicant->community_community_id->CurrentValue;
				}
			} else {
				$student_applicant->community_community_id->ViewValue = NULL;
			}
			$student_applicant->community_community_id->CssStyle = "";
			$student_applicant->community_community_id->CssClass = "";
			$student_applicant->community_community_id->ViewCustomAttributes = "";

			// app_status
			$student_applicant->app_status->ViewValue = $student_applicant->app_status->CurrentValue;
			if (strval($student_applicant->app_status->CurrentValue) <> "") {
				$sFilterWrk = "`application_status_id` = " . ew_AdjustSql($student_applicant->app_status->CurrentValue) . "";
			$sSqlWrk = "SELECT `application_status` FROM `application_status`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_status->ViewValue = $rswrk->fields('application_status');
					$rswrk->Close();
				} else {
					$student_applicant->app_status->ViewValue = $student_applicant->app_status->CurrentValue;
				}
			} else {
				$student_applicant->app_status->ViewValue = NULL;
			}
			$student_applicant->app_status->CssStyle = "";
			$student_applicant->app_status->CssClass = "";
			$student_applicant->app_status->ViewCustomAttributes = "";

			// app_points
			$student_applicant->app_points->ViewValue = $student_applicant->app_points->CurrentValue;
			$student_applicant->app_points->CssStyle = "";
			$student_applicant->app_points->CssClass = "";
			$student_applicant->app_points->ViewCustomAttributes = "";

			// app_grant_id
			$student_applicant->app_grant_id->ViewValue = $student_applicant->app_grant_id->CurrentValue;
			if (strval($student_applicant->app_grant_id->CurrentValue) <> "") {
				$sFilterWrk = "`grant_package_id` = " . ew_AdjustSql($student_applicant->app_grant_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `grant_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_grant_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_grant_id->ViewValue = $student_applicant->app_grant_id->CurrentValue;
				}
			} else {
				$student_applicant->app_grant_id->ViewValue = NULL;
			}
			$student_applicant->app_grant_id->CssStyle = "";
			$student_applicant->app_grant_id->CssClass = "";
			$student_applicant->app_grant_id->ViewCustomAttributes = "";

			// app_amount
			$student_applicant->app_amount->ViewValue = $student_applicant->app_amount->CurrentValue;
			$student_applicant->app_amount->CssStyle = "";
			$student_applicant->app_amount->CssClass = "";
			$student_applicant->app_amount->ViewCustomAttributes = "";

			// student_firstname
			$student_applicant->student_firstname->ViewValue = $student_applicant->student_firstname->CurrentValue;
			$student_applicant->student_firstname->CssStyle = "";
			$student_applicant->student_firstname->CssClass = "";
			$student_applicant->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$student_applicant->student_middlename->ViewValue = $student_applicant->student_middlename->CurrentValue;
			$student_applicant->student_middlename->CssStyle = "";
			$student_applicant->student_middlename->CssClass = "";
			$student_applicant->student_middlename->ViewCustomAttributes = "";

			// student_lastname
			$student_applicant->student_lastname->ViewValue = $student_applicant->student_lastname->CurrentValue;
			$student_applicant->student_lastname->CssStyle = "";
			$student_applicant->student_lastname->CssClass = "";
			$student_applicant->student_lastname->ViewCustomAttributes = "";

			// student_gender
			if (strval($student_applicant->student_gender->CurrentValue) <> "") {
				switch ($student_applicant->student_gender->CurrentValue) {
					case "M":
						$student_applicant->student_gender->ViewValue = "Male";
						break;
					case "F":
						$student_applicant->student_gender->ViewValue = "Female";
						break;
					default:
						$student_applicant->student_gender->ViewValue = $student_applicant->student_gender->CurrentValue;
				}
			} else {
				$student_applicant->student_gender->ViewValue = NULL;
			}
			$student_applicant->student_gender->CssStyle = "";
			$student_applicant->student_gender->CssClass = "";
			$student_applicant->student_gender->ViewCustomAttributes = "";

			// student_dob
			$student_applicant->student_dob->ViewValue = $student_applicant->student_dob->CurrentValue;
			$student_applicant->student_dob->ViewValue = ew_FormatDateTime($student_applicant->student_dob->ViewValue, 7);
			$student_applicant->student_dob->CssStyle = "";
			$student_applicant->student_dob->CssClass = "";
			$student_applicant->student_dob->ViewCustomAttributes = "";

			// app_mother_name
			$student_applicant->app_mother_name->ViewValue = $student_applicant->app_mother_name->CurrentValue;
			$student_applicant->app_mother_name->CssStyle = "";
			$student_applicant->app_mother_name->CssClass = "";
			$student_applicant->app_mother_name->ViewCustomAttributes = "";

			// app_mother_isalive
			if (strval($student_applicant->app_mother_isalive->CurrentValue) <> "") {
				switch ($student_applicant->app_mother_isalive->CurrentValue) {
					case "1":
						$student_applicant->app_mother_isalive->ViewValue = "Alive";
						break;
					case "0":
						$student_applicant->app_mother_isalive->ViewValue = "Deceased";
						break;
					default:
						$student_applicant->app_mother_isalive->ViewValue = $student_applicant->app_mother_isalive->CurrentValue;
				}
			} else {
				$student_applicant->app_mother_isalive->ViewValue = NULL;
			}
			$student_applicant->app_mother_isalive->CssStyle = "";
			$student_applicant->app_mother_isalive->CssClass = "";
			$student_applicant->app_mother_isalive->ViewCustomAttributes = "";

			// app_mother_occupation
			if (strval($student_applicant->app_mother_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($student_applicant->app_mother_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_mother_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_mother_occupation->ViewValue = $student_applicant->app_mother_occupation->CurrentValue;
				}
			} else {
				$student_applicant->app_mother_occupation->ViewValue = NULL;
			}
			$student_applicant->app_mother_occupation->CssStyle = "";
			$student_applicant->app_mother_occupation->CssClass = "";
			$student_applicant->app_mother_occupation->ViewCustomAttributes = "";

			// app_father_name
			$student_applicant->app_father_name->ViewValue = $student_applicant->app_father_name->CurrentValue;
			$student_applicant->app_father_name->CssStyle = "";
			$student_applicant->app_father_name->CssClass = "";
			$student_applicant->app_father_name->ViewCustomAttributes = "";

			// app_father_occupation
			if (strval($student_applicant->app_father_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($student_applicant->app_father_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_father_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_father_occupation->ViewValue = $student_applicant->app_father_occupation->CurrentValue;
				}
			} else {
				$student_applicant->app_father_occupation->ViewValue = NULL;
			}
			$student_applicant->app_father_occupation->CssStyle = "";
			$student_applicant->app_father_occupation->CssClass = "";
			$student_applicant->app_father_occupation->ViewCustomAttributes = "";

			// app_father_isalive
			if (strval($student_applicant->app_father_isalive->CurrentValue) <> "") {
				switch ($student_applicant->app_father_isalive->CurrentValue) {
					case "1":
						$student_applicant->app_father_isalive->ViewValue = "Alive";
						break;
					case "0":
						$student_applicant->app_father_isalive->ViewValue = "Deceased";
						break;
					default:
						$student_applicant->app_father_isalive->ViewValue = $student_applicant->app_father_isalive->CurrentValue;
				}
			} else {
				$student_applicant->app_father_isalive->ViewValue = NULL;
			}
			$student_applicant->app_father_isalive->CssStyle = "";
			$student_applicant->app_father_isalive->CssClass = "";
			$student_applicant->app_father_isalive->ViewCustomAttributes = "";

			// app_guardian_name
			$student_applicant->app_guardian_name->ViewValue = $student_applicant->app_guardian_name->CurrentValue;
			$student_applicant->app_guardian_name->CssStyle = "";
			$student_applicant->app_guardian_name->CssClass = "";
			$student_applicant->app_guardian_name->ViewCustomAttributes = "";

			// app_guardian_relation
			if (strval($student_applicant->app_guardian_relation->CurrentValue) <> "") {
				switch ($student_applicant->app_guardian_relation->CurrentValue) {
					case "NA":
						$student_applicant->app_guardian_relation->ViewValue = "not applicable";
						break;
					case "grandparent":
						$student_applicant->app_guardian_relation->ViewValue = "grandparent";
						break;
					case "grandparent":
						$student_applicant->app_guardian_relation->ViewValue = "grandparent";
						break;
					case "aunt":
						$student_applicant->app_guardian_relation->ViewValue = "aunt";
						break;
					case "sibling":
						$student_applicant->app_guardian_relation->ViewValue = "sibling";
						break;
					case "cousin":
						$student_applicant->app_guardian_relation->ViewValue = "cousin";
						break;
					case "in law":
						$student_applicant->app_guardian_relation->ViewValue = "in law";
						break;
					case "father family":
						$student_applicant->app_guardian_relation->ViewValue = "father family";
						break;
					case "mother family":
						$student_applicant->app_guardian_relation->ViewValue = "mother family";
						break;
					case "extended family":
						$student_applicant->app_guardian_relation->ViewValue = "extended family";
						break;
					case "other relation":
						$student_applicant->app_guardian_relation->ViewValue = "other relation";
						break;
					default:
						$student_applicant->app_guardian_relation->ViewValue = $student_applicant->app_guardian_relation->CurrentValue;
				}
			} else {
				$student_applicant->app_guardian_relation->ViewValue = NULL;
			}
			$student_applicant->app_guardian_relation->CssStyle = "";
			$student_applicant->app_guardian_relation->CssClass = "";
			$student_applicant->app_guardian_relation->ViewCustomAttributes = "";

			// app_guardian_occupation
			if (strval($student_applicant->app_guardian_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($student_applicant->app_guardian_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_guardian_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$student_applicant->app_guardian_occupation->ViewValue = $student_applicant->app_guardian_occupation->CurrentValue;
				}
			} else {
				$student_applicant->app_guardian_occupation->ViewValue = NULL;
			}
			$student_applicant->app_guardian_occupation->CssStyle = "";
			$student_applicant->app_guardian_occupation->CssClass = "";
			$student_applicant->app_guardian_occupation->ViewCustomAttributes = "";

			// app_referees
			$student_applicant->app_referees->ViewValue = $student_applicant->app_referees->CurrentValue;
			$student_applicant->app_referees->CssStyle = "";
			$student_applicant->app_referees->CssClass = "";
			$student_applicant->app_referees->ViewCustomAttributes = "";

			// sponsored_child_no
			$student_applicant->sponsored_child_no->ViewValue = $student_applicant->sponsored_child_no->CurrentValue;
			$student_applicant->sponsored_child_no->CssStyle = "";
			$student_applicant->sponsored_child_no->CssClass = "";
			$student_applicant->sponsored_child_no->ViewCustomAttributes = "";

			// student_grades
			$student_applicant->student_grades->ViewValue = $student_applicant->student_grades->CurrentValue;
			$student_applicant->student_grades->CssStyle = "";
			$student_applicant->student_grades->CssClass = "";
			$student_applicant->student_grades->ViewCustomAttributes = "";

			// student_address
			$student_applicant->student_address->ViewValue = $student_applicant->student_address->CurrentValue;
			$student_applicant->student_address->CssStyle = "";
			$student_applicant->student_address->CssClass = "";
			$student_applicant->student_address->ViewCustomAttributes = "";

			// student_telephone_1
			$student_applicant->student_telephone_1->ViewValue = $student_applicant->student_telephone_1->CurrentValue;
			$student_applicant->student_telephone_1->CssStyle = "";
			$student_applicant->student_telephone_1->CssClass = "";
			$student_applicant->student_telephone_1->ViewCustomAttributes = "";

			// student_telephone_2
			$student_applicant->student_telephone_2->ViewValue = $student_applicant->student_telephone_2->CurrentValue;
			$student_applicant->student_telephone_2->CssStyle = "";
			$student_applicant->student_telephone_2->CssClass = "";
			$student_applicant->student_telephone_2->ViewCustomAttributes = "";

			// student_admitted_school_id
			if (strval($student_applicant->student_admitted_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($student_applicant->student_admitted_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->student_admitted_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$student_applicant->student_admitted_school_id->ViewValue = $student_applicant->student_admitted_school_id->CurrentValue;
				}
			} else {
				$student_applicant->student_admitted_school_id->ViewValue = NULL;
			}
			$student_applicant->student_admitted_school_id->CssStyle = "";
			$student_applicant->student_admitted_school_id->CssClass = "";
			$student_applicant->student_admitted_school_id->ViewCustomAttributes = "";

			// app_primary_school_id
			if (strval($student_applicant->app_primary_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_id` = " . ew_AdjustSql($student_applicant->app_primary_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_name` FROM `applicant_school`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`applicant_school_type`=1" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_primary_school_id->ViewValue = $rswrk->fields('applicant_school_name');
					$rswrk->Close();
				} else {
					$student_applicant->app_primary_school_id->ViewValue = $student_applicant->app_primary_school_id->CurrentValue;
				}
			} else {
				$student_applicant->app_primary_school_id->ViewValue = NULL;
			}
			$student_applicant->app_primary_school_id->CssStyle = "";
			$student_applicant->app_primary_school_id->CssClass = "";
			$student_applicant->app_primary_school_id->ViewCustomAttributes = "";

			// app_junior_secondary_id
			if (strval($student_applicant->app_junior_secondary_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_id` = " . ew_AdjustSql($student_applicant->app_junior_secondary_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_name` FROM `applicant_school`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`applicant_school_type`=2" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_applicant->app_junior_secondary_id->ViewValue = $rswrk->fields('applicant_school_name');
					$rswrk->Close();
				} else {
					$student_applicant->app_junior_secondary_id->ViewValue = $student_applicant->app_junior_secondary_id->CurrentValue;
				}
			} else {
				$student_applicant->app_junior_secondary_id->ViewValue = NULL;
			}
			$student_applicant->app_junior_secondary_id->CssStyle = "";
			$student_applicant->app_junior_secondary_id->CssClass = "";
			$student_applicant->app_junior_secondary_id->ViewCustomAttributes = "";

			// app_scanneddocument
			if (!ew_Empty($student_applicant->app_scanneddocument->Upload->DbValue)) {
				$student_applicant->app_scanneddocument->ViewValue = $student_applicant->app_scanneddocument->Upload->DbValue;
			} else {
				$student_applicant->app_scanneddocument->ViewValue = "";
			}
			$student_applicant->app_scanneddocument->CssStyle = "";
			$student_applicant->app_scanneddocument->CssClass = "";
			$student_applicant->app_scanneddocument->ViewCustomAttributes = "";

			// group_id
			$student_applicant->group_id->ViewValue = $student_applicant->group_id->CurrentValue;
			$student_applicant->group_id->CssStyle = "";
			$student_applicant->group_id->CssClass = "";
			$student_applicant->group_id->ViewCustomAttributes = "";

			// student_applicant_id
			$student_applicant->student_applicant_id->HrefValue = "";
			$student_applicant->student_applicant_id->TooltipValue = "";

			// app_submission_year
			$student_applicant->app_submission_year->HrefValue = "";
			$student_applicant->app_submission_year->TooltipValue = "";

			// student_resident_programarea_id
			$student_applicant->student_resident_programarea_id->HrefValue = "";
			$student_applicant->student_resident_programarea_id->TooltipValue = "";

			// community_community_id
			$student_applicant->community_community_id->HrefValue = "";
			$student_applicant->community_community_id->TooltipValue = "";

			// app_status
			$student_applicant->app_status->HrefValue = "";
			$student_applicant->app_status->TooltipValue = "";

			// app_points
			$student_applicant->app_points->HrefValue = "";
			$student_applicant->app_points->TooltipValue = "";

			// app_grant_id
			$student_applicant->app_grant_id->HrefValue = "";
			$student_applicant->app_grant_id->TooltipValue = "";

			// student_firstname
			$student_applicant->student_firstname->HrefValue = "";
			$student_applicant->student_firstname->TooltipValue = "";

			// student_lastname
			$student_applicant->student_lastname->HrefValue = "";
			$student_applicant->student_lastname->TooltipValue = "";

			// student_gender
			$student_applicant->student_gender->HrefValue = "";
			$student_applicant->student_gender->TooltipValue = "";

			// student_dob
			$student_applicant->student_dob->HrefValue = "";
			$student_applicant->student_dob->TooltipValue = "";

			// sponsored_child_no
			$student_applicant->sponsored_child_no->HrefValue = "";
			$student_applicant->sponsored_child_no->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($student_applicant->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$student_applicant->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $student_applicant;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $student_applicant;
		$student_applicant->student_applicant_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_applicant_id");
		$student_applicant->app_submission_year->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_submission_year");
		$student_applicant->student_resident_programarea_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_resident_programarea_id");
		$student_applicant->community_community_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_community_community_id");
		$student_applicant->app_status->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_status");
		$student_applicant->app_points->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_points");
		$student_applicant->app_grant_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_grant_id");
		$student_applicant->student_firstname->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_firstname");
		$student_applicant->student_middlename->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_middlename");
		$student_applicant->student_lastname->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_lastname");
		$student_applicant->student_gender->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_gender");
		$student_applicant->student_dob->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_dob");
		$student_applicant->student_dob->AdvancedSearch->SearchValue2 = $student_applicant->getAdvancedSearch("y_student_dob");
		$student_applicant->app_mother_name->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_mother_name");
		$student_applicant->app_mother_isalive->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_mother_isalive");
		$student_applicant->app_mother_occupation->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_mother_occupation");
		$student_applicant->app_father_name->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_father_name");
		$student_applicant->app_father_occupation->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_father_occupation");
		$student_applicant->app_father_isalive->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_father_isalive");
		$student_applicant->app_guardian_name->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_guardian_name");
		$student_applicant->app_guardian_relation->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_guardian_relation");
		$student_applicant->app_guardian_occupation->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_guardian_occupation");
		$student_applicant->sponsored_child_no->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_sponsored_child_no");
		$student_applicant->student_grades->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_grades");
		$student_applicant->student_address->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_address");
		$student_applicant->student_admitted_school_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_student_admitted_school_id");
		$student_applicant->app_primary_school_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_primary_school_id");
		$student_applicant->app_junior_secondary_id->AdvancedSearch->SearchValue = $student_applicant->getAdvancedSearch("x_app_junior_secondary_id");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $student_applicant;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $student_applicant->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($student_applicant->ExportAll) {
			$this->lDisplayRecs = $this->lTotalRecs;
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->lStartRec-1, $this->lDisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($student_applicant->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($student_applicant, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($student_applicant->student_applicant_id);
				$ExportDoc->ExportCaption($student_applicant->app_submission_year);
				$ExportDoc->ExportCaption($student_applicant->student_resident_programarea_id);
				$ExportDoc->ExportCaption($student_applicant->community_community_id);
				$ExportDoc->ExportCaption($student_applicant->app_status);
				$ExportDoc->ExportCaption($student_applicant->app_points);
				$ExportDoc->ExportCaption($student_applicant->app_grant_id);
				$ExportDoc->ExportCaption($student_applicant->app_amount);
				$ExportDoc->ExportCaption($student_applicant->student_firstname);
				$ExportDoc->ExportCaption($student_applicant->student_middlename);
				$ExportDoc->ExportCaption($student_applicant->student_lastname);
				$ExportDoc->ExportCaption($student_applicant->student_gender);
				$ExportDoc->ExportCaption($student_applicant->student_dob);
				$ExportDoc->ExportCaption($student_applicant->app_mother_name);
				$ExportDoc->ExportCaption($student_applicant->app_mother_isalive);
				$ExportDoc->ExportCaption($student_applicant->app_mother_occupation);
				$ExportDoc->ExportCaption($student_applicant->app_father_name);
				$ExportDoc->ExportCaption($student_applicant->app_father_occupation);
				$ExportDoc->ExportCaption($student_applicant->app_father_isalive);
				$ExportDoc->ExportCaption($student_applicant->app_guardian_name);
				$ExportDoc->ExportCaption($student_applicant->app_guardian_relation);
				$ExportDoc->ExportCaption($student_applicant->app_guardian_occupation);
				$ExportDoc->ExportCaption($student_applicant->app_referees);
				$ExportDoc->ExportCaption($student_applicant->sponsored_child_no);
				$ExportDoc->ExportCaption($student_applicant->student_grades);
				$ExportDoc->ExportCaption($student_applicant->student_address);
				$ExportDoc->ExportCaption($student_applicant->student_telephone_1);
				$ExportDoc->ExportCaption($student_applicant->student_telephone_2);
				$ExportDoc->ExportCaption($student_applicant->student_admitted_school_id);
				$ExportDoc->ExportCaption($student_applicant->app_primary_school_id);
				$ExportDoc->ExportCaption($student_applicant->app_junior_secondary_id);
				$ExportDoc->ExportCaption($student_applicant->app_scanneddocument);
				$ExportDoc->ExportCaption($student_applicant->group_id);
				$ExportDoc->EndExportRow();
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			if (!$bSelectLimit && $this->lStartRec > 1)
				$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row
				$student_applicant->CssClass = "";
				$student_applicant->CssStyle = "";
				$student_applicant->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($student_applicant->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('student_applicant_id', $student_applicant->student_applicant_id->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_submission_year', $student_applicant->app_submission_year->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('student_resident_programarea_id', $student_applicant->student_resident_programarea_id->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('community_community_id', $student_applicant->community_community_id->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_status', $student_applicant->app_status->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_points', $student_applicant->app_points->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_grant_id', $student_applicant->app_grant_id->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_amount', $student_applicant->app_amount->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('student_firstname', $student_applicant->student_firstname->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('student_middlename', $student_applicant->student_middlename->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('student_lastname', $student_applicant->student_lastname->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('student_gender', $student_applicant->student_gender->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('student_dob', $student_applicant->student_dob->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_mother_name', $student_applicant->app_mother_name->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_mother_isalive', $student_applicant->app_mother_isalive->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_mother_occupation', $student_applicant->app_mother_occupation->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_father_name', $student_applicant->app_father_name->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_father_occupation', $student_applicant->app_father_occupation->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_father_isalive', $student_applicant->app_father_isalive->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_guardian_name', $student_applicant->app_guardian_name->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_guardian_relation', $student_applicant->app_guardian_relation->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_guardian_occupation', $student_applicant->app_guardian_occupation->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_referees', $student_applicant->app_referees->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('sponsored_child_no', $student_applicant->sponsored_child_no->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('student_grades', $student_applicant->student_grades->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('student_address', $student_applicant->student_address->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('student_telephone_1', $student_applicant->student_telephone_1->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('student_telephone_2', $student_applicant->student_telephone_2->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('student_admitted_school_id', $student_applicant->student_admitted_school_id->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_primary_school_id', $student_applicant->app_primary_school_id->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_junior_secondary_id', $student_applicant->app_junior_secondary_id->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('app_scanneddocument', $student_applicant->app_scanneddocument->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
					$XmlDoc->AddField('group_id', $student_applicant->group_id->ExportValue($student_applicant->Export, $student_applicant->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($student_applicant->student_applicant_id);
					$ExportDoc->ExportField($student_applicant->app_submission_year);
					$ExportDoc->ExportField($student_applicant->student_resident_programarea_id);
					$ExportDoc->ExportField($student_applicant->community_community_id);
					$ExportDoc->ExportField($student_applicant->app_status);
					$ExportDoc->ExportField($student_applicant->app_points);
					$ExportDoc->ExportField($student_applicant->app_grant_id);
					$ExportDoc->ExportField($student_applicant->app_amount);
					$ExportDoc->ExportField($student_applicant->student_firstname);
					$ExportDoc->ExportField($student_applicant->student_middlename);
					$ExportDoc->ExportField($student_applicant->student_lastname);
					$ExportDoc->ExportField($student_applicant->student_gender);
					$ExportDoc->ExportField($student_applicant->student_dob);
					$ExportDoc->ExportField($student_applicant->app_mother_name);
					$ExportDoc->ExportField($student_applicant->app_mother_isalive);
					$ExportDoc->ExportField($student_applicant->app_mother_occupation);
					$ExportDoc->ExportField($student_applicant->app_father_name);
					$ExportDoc->ExportField($student_applicant->app_father_occupation);
					$ExportDoc->ExportField($student_applicant->app_father_isalive);
					$ExportDoc->ExportField($student_applicant->app_guardian_name);
					$ExportDoc->ExportField($student_applicant->app_guardian_relation);
					$ExportDoc->ExportField($student_applicant->app_guardian_occupation);
					$ExportDoc->ExportField($student_applicant->app_referees);
					$ExportDoc->ExportField($student_applicant->sponsored_child_no);
					$ExportDoc->ExportField($student_applicant->student_grades);
					$ExportDoc->ExportField($student_applicant->student_address);
					$ExportDoc->ExportField($student_applicant->student_telephone_1);
					$ExportDoc->ExportField($student_applicant->student_telephone_2);
					$ExportDoc->ExportField($student_applicant->student_admitted_school_id);
					$ExportDoc->ExportField($student_applicant->app_primary_school_id);
					$ExportDoc->ExportField($student_applicant->app_junior_secondary_id);
					$ExportDoc->ExportField($student_applicant->app_scanneddocument);
					$ExportDoc->ExportField($student_applicant->group_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($student_applicant->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($student_applicant->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($student_applicant->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($student_applicant->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($student_applicant->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'student_applicant';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
