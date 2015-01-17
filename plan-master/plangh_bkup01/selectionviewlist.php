<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "selectionviewinfo.php" ?>
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
$app_year=$app->get_admission_year();
	
// Create page object
$SelectionView_list = new cSelectionView_list();
$Page =& $SelectionView_list;

// Page init
$SelectionView_list->Page_Init();

// Page main
$SelectionView_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($SelectionView->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var SelectionView_list = new ew_Page("SelectionView_list");

// page properties
SelectionView_list.PageID = "list"; // page ID
SelectionView_list.FormID = "fSelectionViewlist"; // form ID
var EW_PAGE_ID = SelectionView_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
SelectionView_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
SelectionView_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
SelectionView_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($SelectionView->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$SelectionView_list->lTotalRecs = $SelectionView->SelectRecordCount();
	} else {
		if ($rs = $SelectionView_list->LoadRecordset())
			$SelectionView_list->lTotalRecs = $rs->RecordCount();
	}
	$SelectionView_list->lStartRec = 1;
	if ($SelectionView_list->lDisplayRecs <= 0 || ($SelectionView->Export <> "" && $SelectionView->ExportAll)) // Display all records
		$SelectionView_list->lDisplayRecs = $SelectionView_list->lTotalRecs;
	if (!($SelectionView->Export <> "" && $SelectionView->ExportAll))
		$SelectionView_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $SelectionView_list->LoadRecordset($SelectionView_list->lStartRec-1, $SelectionView_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $SelectionView->TableCaption() ?>
<?php if ($SelectionView->Export == "" && $SelectionView->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $SelectionView_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $SelectionView_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $SelectionView_list->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($SelectionView->Export == "" && $SelectionView->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(SelectionView_list);" style="text-decoration: none;"><img id="SelectionView_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="SelectionView_list_SearchPanel">
<form name="fSelectionViewlistsrch" id="fSelectionViewlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="SelectionView">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($SelectionView->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $SelectionView_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($SelectionView->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($SelectionView->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($SelectionView->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$SelectionView_list->ShowMessage();
?>
<br>
<?php include("ext/awardscholarship2.php");?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fSelectionViewlist" id="fSelectionViewlist" class="ewForm" action="" method="post">
<div id="gmp_SelectionView" class="ewGridMiddlePanel">
<?php if ($SelectionView_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $SelectionView->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$SelectionView_list->RenderListOptions();

// Render list options (header, left)
$SelectionView_list->ListOptions->Render("header", "left");
?>
<?php if ($SelectionView->programarea_name->Visible) { // programarea_name ?>
	<?php if ($SelectionView->SortUrl($SelectionView->programarea_name) == "") { ?>
		<td><?php echo $SelectionView->programarea_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $SelectionView->SortUrl($SelectionView->programarea_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $SelectionView->programarea_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($SelectionView->programarea_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($SelectionView->programarea_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($SelectionView->community->Visible) { // community ?>
	<?php if ($SelectionView->SortUrl($SelectionView->community) == "") { ?>
		<td><?php echo $SelectionView->community->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $SelectionView->SortUrl($SelectionView->community) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $SelectionView->community->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($SelectionView->community->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($SelectionView->community->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($SelectionView->student_lastname->Visible) { // student_lastname ?>
	<?php if ($SelectionView->SortUrl($SelectionView->student_lastname) == "") { ?>
		<td><?php echo $SelectionView->student_lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $SelectionView->SortUrl($SelectionView->student_lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $SelectionView->student_lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($SelectionView->student_lastname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($SelectionView->student_lastname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($SelectionView->student_firstname->Visible) { // student_firstname ?>
	<?php if ($SelectionView->SortUrl($SelectionView->student_firstname) == "") { ?>
		<td><?php echo $SelectionView->student_firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $SelectionView->SortUrl($SelectionView->student_firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $SelectionView->student_firstname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($SelectionView->student_firstname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($SelectionView->student_firstname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($SelectionView->student_middlename->Visible) { // student_middlename ?>
	<?php if ($SelectionView->SortUrl($SelectionView->student_middlename) == "") { ?>
		<td><?php echo $SelectionView->student_middlename->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $SelectionView->SortUrl($SelectionView->student_middlename) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $SelectionView->student_middlename->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($SelectionView->student_middlename->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($SelectionView->student_middlename->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($SelectionView->student_gender->Visible) { // student_gender ?>
	<?php if ($SelectionView->SortUrl($SelectionView->student_gender) == "") { ?>
		<td><?php echo $SelectionView->student_gender->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $SelectionView->SortUrl($SelectionView->student_gender) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $SelectionView->student_gender->FldCaption() ?></td><td style="width: 10px;"><?php if ($SelectionView->student_gender->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($SelectionView->student_gender->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($SelectionView->student_dob->Visible) { // student_dob ?>
	<?php if ($SelectionView->SortUrl($SelectionView->student_dob) == "") { ?>
		<td><?php echo $SelectionView->student_dob->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $SelectionView->SortUrl($SelectionView->student_dob) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $SelectionView->student_dob->FldCaption() ?></td><td style="width: 10px;"><?php if ($SelectionView->student_dob->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($SelectionView->student_dob->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($SelectionView->app_mother_occupation->Visible) { // app_mother_occupation ?>
	<?php if ($SelectionView->SortUrl($SelectionView->app_mother_occupation) == "") { ?>
		<td><?php echo $SelectionView->app_mother_occupation->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $SelectionView->SortUrl($SelectionView->app_mother_occupation) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $SelectionView->app_mother_occupation->FldCaption() ?></td><td style="width: 10px;"><?php if ($SelectionView->app_mother_occupation->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($SelectionView->app_mother_occupation->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($SelectionView->app_father_occupation->Visible) { // app_father_occupation ?>
	<?php if ($SelectionView->SortUrl($SelectionView->app_father_occupation) == "") { ?>
		<td><?php echo $SelectionView->app_father_occupation->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $SelectionView->SortUrl($SelectionView->app_father_occupation) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $SelectionView->app_father_occupation->FldCaption() ?></td><td style="width: 10px;"><?php if ($SelectionView->app_father_occupation->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($SelectionView->app_father_occupation->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($SelectionView->app_guardian_occupation->Visible) { // app_guardian_occupation ?>
	<?php if ($SelectionView->SortUrl($SelectionView->app_guardian_occupation) == "") { ?>
		<td><?php echo $SelectionView->app_guardian_occupation->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $SelectionView->SortUrl($SelectionView->app_guardian_occupation) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $SelectionView->app_guardian_occupation->FldCaption() ?></td><td style="width: 10px;"><?php if ($SelectionView->app_guardian_occupation->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($SelectionView->app_guardian_occupation->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($SelectionView->app_points->Visible) { // app_points ?>
	<?php if ($SelectionView->SortUrl($SelectionView->app_points) == "") { ?>
		<td><?php echo $SelectionView->app_points->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $SelectionView->SortUrl($SelectionView->app_points) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $SelectionView->app_points->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($SelectionView->app_points->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($SelectionView->app_points->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($SelectionView->applicant_school_name->Visible) { // applicant_school_name ?>
	<?php if ($SelectionView->SortUrl($SelectionView->applicant_school_name) == "") { ?>
		<td><?php echo $SelectionView->applicant_school_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $SelectionView->SortUrl($SelectionView->applicant_school_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $SelectionView->applicant_school_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($SelectionView->applicant_school_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($SelectionView->applicant_school_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($SelectionView->student_grades->Visible) { // student_grades ?>
	<?php if ($SelectionView->SortUrl($SelectionView->student_grades) == "") { ?>
		<td><?php echo $SelectionView->student_grades->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $SelectionView->SortUrl($SelectionView->student_grades) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $SelectionView->student_grades->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($SelectionView->student_grades->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($SelectionView->student_grades->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$SelectionView_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($SelectionView->ExportAll && $SelectionView->Export <> "") {
	$SelectionView_list->lStopRec = $SelectionView_list->lTotalRecs;
} else {
	$SelectionView_list->lStopRec = $SelectionView_list->lStartRec + $SelectionView_list->lDisplayRecs - 1; // Set the last record to display
}
$SelectionView_list->lRecCount = $SelectionView_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $SelectionView_list->lStartRec > 1)
		$rs->Move($SelectionView_list->lStartRec - 1);
}

// Initialize aggregate
$SelectionView->RowType = EW_ROWTYPE_AGGREGATEINIT;
$SelectionView_list->RenderRow();
$SelectionView_list->lRowCnt = 0;
while (($SelectionView->CurrentAction == "gridadd" || !$rs->EOF) &&
	$SelectionView_list->lRecCount < $SelectionView_list->lStopRec) {
	$SelectionView_list->lRecCount++;
	if (intval($SelectionView_list->lRecCount) >= intval($SelectionView_list->lStartRec)) {
		$SelectionView_list->lRowCnt++;

	// Init row class and style
	$SelectionView->CssClass = "";
	$SelectionView->CssStyle = "";
	$SelectionView->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($SelectionView->CurrentAction == "gridadd") {
		$SelectionView_list->LoadDefaultValues(); // Load default values
	} else {
		$SelectionView_list->LoadRowValues($rs); // Load row values
	}
	$SelectionView->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$SelectionView_list->RenderRow();

	// Render list options
	$SelectionView_list->RenderListOptions();
?>
	<tr<?php echo $SelectionView->RowAttributes() ?>>
<?php

// Render list options (body, left)
$SelectionView_list->ListOptions->Render("body", "left");
?>
	<?php if ($SelectionView->programarea_name->Visible) { // programarea_name ?>
		<td<?php echo $SelectionView->programarea_name->CellAttributes() ?>>
<div<?php echo $SelectionView->programarea_name->ViewAttributes() ?>>
<?php if ($SelectionView->programarea_name->HrefValue <> "" || $SelectionView->programarea_name->TooltipValue <> "") { ?>
<a href="<?php echo $SelectionView->programarea_name->HrefValue ?>"><?php echo $SelectionView->programarea_name->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $SelectionView->programarea_name->ListViewValue() ?>
<?php } ?>
</div>
</td>
	<?php } ?>
	<?php if ($SelectionView->community->Visible) { // community ?>
		<td<?php echo $SelectionView->community->CellAttributes() ?>>
<div<?php echo $SelectionView->community->ViewAttributes() ?>><?php echo $SelectionView->community->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($SelectionView->student_lastname->Visible) { // student_lastname ?>
		<td<?php echo $SelectionView->student_lastname->CellAttributes() ?>>
<div<?php echo $SelectionView->student_lastname->ViewAttributes() ?>><?php echo $SelectionView->student_lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($SelectionView->student_firstname->Visible) { // student_firstname ?>
		<td<?php echo $SelectionView->student_firstname->CellAttributes() ?>>
<div<?php echo $SelectionView->student_firstname->ViewAttributes() ?>><?php echo $SelectionView->student_firstname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($SelectionView->student_middlename->Visible) { // student_middlename ?>
		<td<?php echo $SelectionView->student_middlename->CellAttributes() ?>>
<div<?php echo $SelectionView->student_middlename->ViewAttributes() ?>><?php echo $SelectionView->student_middlename->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($SelectionView->student_gender->Visible) { // student_gender ?>
		<td<?php echo $SelectionView->student_gender->CellAttributes() ?>>
<div<?php echo $SelectionView->student_gender->ViewAttributes() ?>><?php echo $SelectionView->student_gender->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($SelectionView->student_dob->Visible) { // student_dob ?>
		<td<?php echo $SelectionView->student_dob->CellAttributes() ?>>
<div<?php echo $SelectionView->student_dob->ViewAttributes() ?>><?php echo $SelectionView->student_dob->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($SelectionView->app_mother_occupation->Visible) { // app_mother_occupation ?>
		<td<?php echo $SelectionView->app_mother_occupation->CellAttributes() ?>>
<div<?php echo $SelectionView->app_mother_occupation->ViewAttributes() ?>><?php echo $SelectionView->app_mother_occupation->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($SelectionView->app_father_occupation->Visible) { // app_father_occupation ?>
		<td<?php echo $SelectionView->app_father_occupation->CellAttributes() ?>>
<div<?php echo $SelectionView->app_father_occupation->ViewAttributes() ?>><?php echo $SelectionView->app_father_occupation->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($SelectionView->app_guardian_occupation->Visible) { // app_guardian_occupation ?>
		<td<?php echo $SelectionView->app_guardian_occupation->CellAttributes() ?>>
<div<?php echo $SelectionView->app_guardian_occupation->ViewAttributes() ?>><?php echo $SelectionView->app_guardian_occupation->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($SelectionView->app_points->Visible) { // app_points ?>
		<td<?php echo $SelectionView->app_points->CellAttributes() ?>>
<div<?php echo $SelectionView->app_points->ViewAttributes() ?>><?php echo $SelectionView->app_points->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($SelectionView->applicant_school_name->Visible) { // applicant_school_name ?>
		<td<?php echo $SelectionView->applicant_school_name->CellAttributes() ?>>
<div<?php echo $SelectionView->applicant_school_name->ViewAttributes() ?>><?php echo $SelectionView->applicant_school_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($SelectionView->student_grades->Visible) { // student_grades ?>
		<td<?php echo $SelectionView->student_grades->CellAttributes() ?>>
<div<?php echo $SelectionView->student_grades->ViewAttributes() ?>><?php echo $SelectionView->student_grades->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$SelectionView_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($SelectionView->CurrentAction <> "gridadd")
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
<?php if ($SelectionView->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($SelectionView->CurrentAction <> "gridadd" && $SelectionView->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($SelectionView_list->Pager)) $SelectionView_list->Pager = new cPrevNextPager($SelectionView_list->lStartRec, $SelectionView_list->lDisplayRecs, $SelectionView_list->lTotalRecs) ?>
<?php if ($SelectionView_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($SelectionView_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $SelectionView_list->PageUrl() ?>start=<?php echo $SelectionView_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($SelectionView_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $SelectionView_list->PageUrl() ?>start=<?php echo $SelectionView_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $SelectionView_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($SelectionView_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $SelectionView_list->PageUrl() ?>start=<?php echo $SelectionView_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($SelectionView_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $SelectionView_list->PageUrl() ?>start=<?php echo $SelectionView_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $SelectionView_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $SelectionView_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $SelectionView_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $SelectionView_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($SelectionView_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($SelectionView_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($SelectionView->Export == "" && $SelectionView->CurrentAction == "") { ?>
<?php } ?>
<?php if ($SelectionView->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$SelectionView_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cSelectionView_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'SelectionView';

	// Page object name
	var $PageObjName = 'SelectionView_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $SelectionView;
		if ($SelectionView->UseTokenInUrl) $PageUrl .= "t=" . $SelectionView->TableVar . "&"; // Add page token
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
		global $objForm, $SelectionView;
		if ($SelectionView->UseTokenInUrl) {
			if ($objForm)
				return ($SelectionView->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($SelectionView->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cSelectionView_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (SelectionView)
		$GLOBALS["SelectionView"] = new cSelectionView();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["SelectionView"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "SelectionViewdelete.php";
		$this->MultiUpdateUrl = "SelectionViewupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'SelectionView', TRUE);

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
		global $SelectionView;

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$SelectionView->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$SelectionView->Export = $_POST["exporttype"];
		} else {
			$SelectionView->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $SelectionView->Export; // Get export parameter, used in header
		$gsExportFile = $SelectionView->TableVar; // Get export file, used in header
		if ($SelectionView->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($SelectionView->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $SelectionView;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$SelectionView->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($SelectionView->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $SelectionView->getRecordsPerPage(); // Restore from Session
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
		$SelectionView->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$SelectionView->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$SelectionView->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $SelectionView->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$SelectionView->setSessionWhere($sFilter);
		$SelectionView->CurrentFilter = "";

		// Export data only
		if (in_array($SelectionView->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($SelectionView->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $SelectionView;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $SelectionView->programarea_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $SelectionView->community, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $SelectionView->student_lastname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $SelectionView->student_firstname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $SelectionView->student_middlename, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $SelectionView->student_gender, $Keyword);
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $SelectionView->app_points, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $SelectionView->applicant_school_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $SelectionView->student_grades, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . " LIKE " . ew_QuotedValue("%" . $Keyword . "%", $lFldDataType);
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $SelectionView;
		$sSearchStr = "";
		$sSearchKeyword = $SelectionView->BasicSearchKeyword;
		$sSearchType = $SelectionView->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$SelectionView->setSessionBasicSearchKeyword($sSearchKeyword);
			$SelectionView->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $SelectionView;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$SelectionView->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $SelectionView;
		$SelectionView->setSessionBasicSearchKeyword("");
		$SelectionView->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $SelectionView;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$SelectionView->BasicSearchKeyword = $SelectionView->getSessionBasicSearchKeyword();
			$SelectionView->BasicSearchType = $SelectionView->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $SelectionView;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$SelectionView->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$SelectionView->CurrentOrderType = @$_GET["ordertype"];
			$SelectionView->UpdateSort($SelectionView->programarea_name); // programarea_name
			$SelectionView->UpdateSort($SelectionView->community); // community
			$SelectionView->UpdateSort($SelectionView->student_lastname); // student_lastname
			$SelectionView->UpdateSort($SelectionView->student_firstname); // student_firstname
			$SelectionView->UpdateSort($SelectionView->student_middlename); // student_middlename
			$SelectionView->UpdateSort($SelectionView->student_gender); // student_gender
			$SelectionView->UpdateSort($SelectionView->student_dob); // student_dob
			$SelectionView->UpdateSort($SelectionView->app_mother_occupation); // app_mother_occupation
			$SelectionView->UpdateSort($SelectionView->app_father_occupation); // app_father_occupation
			$SelectionView->UpdateSort($SelectionView->app_guardian_occupation); // app_guardian_occupation
			$SelectionView->UpdateSort($SelectionView->app_points); // app_points
			$SelectionView->UpdateSort($SelectionView->applicant_school_name); // applicant_school_name
			$SelectionView->UpdateSort($SelectionView->student_grades); // student_grades
			$SelectionView->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $SelectionView;
		$sOrderBy = $SelectionView->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($SelectionView->SqlOrderBy() <> "") {
				$sOrderBy = $SelectionView->SqlOrderBy();
				$SelectionView->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $SelectionView;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$SelectionView->setSessionOrderBy($sOrderBy);
				$SelectionView->programarea_name->setSort("");
				$SelectionView->community->setSort("");
				$SelectionView->student_lastname->setSort("");
				$SelectionView->student_firstname->setSort("");
				$SelectionView->student_middlename->setSort("");
				$SelectionView->student_gender->setSort("");
				$SelectionView->student_dob->setSort("");
				$SelectionView->app_mother_occupation->setSort("");
				$SelectionView->app_father_occupation->setSort("");
				$SelectionView->app_guardian_occupation->setSort("");
				$SelectionView->app_points->setSort("");
				$SelectionView->applicant_school_name->setSort("");
				$SelectionView->student_grades->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$SelectionView->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $SelectionView;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($SelectionView->Export <> "" ||
			$SelectionView->CurrentAction == "gridadd" ||
			$SelectionView->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $SelectionView;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $SelectionView;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $SelectionView;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$SelectionView->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$SelectionView->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $SelectionView->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$SelectionView->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$SelectionView->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$SelectionView->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $SelectionView;
		$SelectionView->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$SelectionView->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $SelectionView;

		// Call Recordset Selecting event
		$SelectionView->Recordset_Selecting($SelectionView->CurrentFilter);

		// Load List page SQL
		$sSql = $SelectionView->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$SelectionView->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $SelectionView;
		$sFilter = $SelectionView->KeyFilter();

		// Call Row Selecting event
		$SelectionView->Row_Selecting($sFilter);

		// Load SQL based on filter
		$SelectionView->CurrentFilter = $sFilter;
		$sSql = $SelectionView->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$SelectionView->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $SelectionView;
		$SelectionView->student_applicant_id->setDbValue($rs->fields('student_applicant_id'));
		$SelectionView->programarea_name->setDbValue($rs->fields('programarea_name'));
		$SelectionView->community->setDbValue($rs->fields('community'));
		$SelectionView->student_lastname->setDbValue($rs->fields('student_lastname'));
		$SelectionView->student_firstname->setDbValue($rs->fields('student_firstname'));
		$SelectionView->student_middlename->setDbValue($rs->fields('student_middlename'));
		$SelectionView->student_gender->setDbValue($rs->fields('student_gender'));
		$SelectionView->student_dob->setDbValue($rs->fields('student_dob'));
		$SelectionView->AGE->setDbValue($rs->fields('AGE'));
		$SelectionView->app_mother_occupation->setDbValue($rs->fields('app_mother_occupation'));
		$SelectionView->app_father_occupation->setDbValue($rs->fields('app_father_occupation'));
		$SelectionView->app_guardian_occupation->setDbValue($rs->fields('app_guardian_occupation'));
		$SelectionView->app_points->setDbValue($rs->fields('app_points'));
		$SelectionView->applicant_school_name->setDbValue($rs->fields('applicant_school_name'));
		$SelectionView->student_grades->setDbValue($rs->fields('student_grades'));
		$SelectionView->app_grant_id->setDbValue($rs->fields('app_grant_id'));
		$SelectionView->app_amount->setDbValue($rs->fields('app_amount'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $SelectionView;

		// Initialize URLs
		$this->ViewUrl = $SelectionView->ViewUrl();
		$this->EditUrl = $SelectionView->EditUrl();
		$this->InlineEditUrl = $SelectionView->InlineEditUrl();
		$this->CopyUrl = $SelectionView->CopyUrl();
		$this->InlineCopyUrl = $SelectionView->InlineCopyUrl();
		$this->DeleteUrl = $SelectionView->DeleteUrl();

		// Call Row_Rendering event
		$SelectionView->Row_Rendering();

		// Common render codes for all row types
		// programarea_name

		$SelectionView->programarea_name->CellCssStyle = ""; $SelectionView->programarea_name->CellCssClass = "";
		$SelectionView->programarea_name->CellAttrs = array(); $SelectionView->programarea_name->ViewAttrs = array(); $SelectionView->programarea_name->EditAttrs = array();

		// community
		$SelectionView->community->CellCssStyle = ""; $SelectionView->community->CellCssClass = "";
		$SelectionView->community->CellAttrs = array(); $SelectionView->community->ViewAttrs = array(); $SelectionView->community->EditAttrs = array();

		// student_lastname
		$SelectionView->student_lastname->CellCssStyle = ""; $SelectionView->student_lastname->CellCssClass = "";
		$SelectionView->student_lastname->CellAttrs = array(); $SelectionView->student_lastname->ViewAttrs = array(); $SelectionView->student_lastname->EditAttrs = array();

		// student_firstname
		$SelectionView->student_firstname->CellCssStyle = ""; $SelectionView->student_firstname->CellCssClass = "";
		$SelectionView->student_firstname->CellAttrs = array(); $SelectionView->student_firstname->ViewAttrs = array(); $SelectionView->student_firstname->EditAttrs = array();

		// student_middlename
		$SelectionView->student_middlename->CellCssStyle = ""; $SelectionView->student_middlename->CellCssClass = "";
		$SelectionView->student_middlename->CellAttrs = array(); $SelectionView->student_middlename->ViewAttrs = array(); $SelectionView->student_middlename->EditAttrs = array();

		// student_gender
		$SelectionView->student_gender->CellCssStyle = ""; $SelectionView->student_gender->CellCssClass = "";
		$SelectionView->student_gender->CellAttrs = array(); $SelectionView->student_gender->ViewAttrs = array(); $SelectionView->student_gender->EditAttrs = array();

		// student_dob
		$SelectionView->student_dob->CellCssStyle = ""; $SelectionView->student_dob->CellCssClass = "";
		$SelectionView->student_dob->CellAttrs = array(); $SelectionView->student_dob->ViewAttrs = array(); $SelectionView->student_dob->EditAttrs = array();

		// app_mother_occupation
		$SelectionView->app_mother_occupation->CellCssStyle = ""; $SelectionView->app_mother_occupation->CellCssClass = "";
		$SelectionView->app_mother_occupation->CellAttrs = array(); $SelectionView->app_mother_occupation->ViewAttrs = array(); $SelectionView->app_mother_occupation->EditAttrs = array();

		// app_father_occupation
		$SelectionView->app_father_occupation->CellCssStyle = ""; $SelectionView->app_father_occupation->CellCssClass = "";
		$SelectionView->app_father_occupation->CellAttrs = array(); $SelectionView->app_father_occupation->ViewAttrs = array(); $SelectionView->app_father_occupation->EditAttrs = array();

		// app_guardian_occupation
		$SelectionView->app_guardian_occupation->CellCssStyle = ""; $SelectionView->app_guardian_occupation->CellCssClass = "";
		$SelectionView->app_guardian_occupation->CellAttrs = array(); $SelectionView->app_guardian_occupation->ViewAttrs = array(); $SelectionView->app_guardian_occupation->EditAttrs = array();

		// app_points
		$SelectionView->app_points->CellCssStyle = ""; $SelectionView->app_points->CellCssClass = "";
		$SelectionView->app_points->CellAttrs = array(); $SelectionView->app_points->ViewAttrs = array(); $SelectionView->app_points->EditAttrs = array();

		// applicant_school_name
		$SelectionView->applicant_school_name->CellCssStyle = ""; $SelectionView->applicant_school_name->CellCssClass = "";
		$SelectionView->applicant_school_name->CellAttrs = array(); $SelectionView->applicant_school_name->ViewAttrs = array(); $SelectionView->applicant_school_name->EditAttrs = array();

		// student_grades
		$SelectionView->student_grades->CellCssStyle = ""; $SelectionView->student_grades->CellCssClass = "";
		$SelectionView->student_grades->CellAttrs = array(); $SelectionView->student_grades->ViewAttrs = array(); $SelectionView->student_grades->EditAttrs = array();
		if ($SelectionView->RowType == EW_ROWTYPE_VIEW) { // View row

			// programarea_name
			$SelectionView->programarea_name->ViewValue = $SelectionView->programarea_name->CurrentValue;
			$SelectionView->programarea_name->CssStyle = "";
			$SelectionView->programarea_name->CssClass = "";
			$SelectionView->programarea_name->ViewCustomAttributes = "";

			// community
			$SelectionView->community->ViewValue = $SelectionView->community->CurrentValue;
			$SelectionView->community->CssStyle = "";
			$SelectionView->community->CssClass = "";
			$SelectionView->community->ViewCustomAttributes = "";

			// student_lastname
			$SelectionView->student_lastname->ViewValue = $SelectionView->student_lastname->CurrentValue;
			$SelectionView->student_lastname->CssStyle = "font-weight:bold;";
			$SelectionView->student_lastname->CssClass = "";
			$SelectionView->student_lastname->ViewCustomAttributes = "";

			// student_firstname
			$SelectionView->student_firstname->ViewValue = $SelectionView->student_firstname->CurrentValue;
			$SelectionView->student_firstname->CssStyle = "";
			$SelectionView->student_firstname->CssClass = "";
			$SelectionView->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$SelectionView->student_middlename->ViewValue = $SelectionView->student_middlename->CurrentValue;
			$SelectionView->student_middlename->CssStyle = "";
			$SelectionView->student_middlename->CssClass = "";
			$SelectionView->student_middlename->ViewCustomAttributes = "";

			// student_gender
			if (strval($SelectionView->student_gender->CurrentValue) <> "") {
				switch ($SelectionView->student_gender->CurrentValue) {
					case "m":
						$SelectionView->student_gender->ViewValue = "male";
						break;
					case "f":
						$SelectionView->student_gender->ViewValue = "female";
						break;
					default:
						$SelectionView->student_gender->ViewValue = $SelectionView->student_gender->CurrentValue;
				}
			} else {
				$SelectionView->student_gender->ViewValue = NULL;
			}
			$SelectionView->student_gender->CssStyle = "";
			$SelectionView->student_gender->CssClass = "";
			$SelectionView->student_gender->ViewCustomAttributes = "";

			// student_dob
			$SelectionView->student_dob->ViewValue = $SelectionView->student_dob->CurrentValue;
			$SelectionView->student_dob->ViewValue = ew_FormatDateTime($SelectionView->student_dob->ViewValue, 5);
			$SelectionView->student_dob->CssStyle = "";
			$SelectionView->student_dob->CssClass = "";
			$SelectionView->student_dob->ViewCustomAttributes = "";

			// AGE
			$SelectionView->AGE->ViewValue = $SelectionView->AGE->CurrentValue;
			$SelectionView->AGE->CssStyle = "";
			$SelectionView->AGE->CssClass = "";
			$SelectionView->AGE->ViewCustomAttributes = "";

			// app_mother_occupation
			if (strval($SelectionView->app_mother_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($SelectionView->app_mother_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$SelectionView->app_mother_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$SelectionView->app_mother_occupation->ViewValue = $SelectionView->app_mother_occupation->CurrentValue;
				}
			} else {
				$SelectionView->app_mother_occupation->ViewValue = NULL;
			}
			$SelectionView->app_mother_occupation->CssStyle = "";
			$SelectionView->app_mother_occupation->CssClass = "";
			$SelectionView->app_mother_occupation->ViewCustomAttributes = "";

			// app_father_occupation
			if (strval($SelectionView->app_father_occupation->CurrentValue) <> "") {
				$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($SelectionView->app_father_occupation->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `application_occupation`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$SelectionView->app_father_occupation->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$SelectionView->app_father_occupation->ViewValue = $SelectionView->app_father_occupation->CurrentValue;
				}
			} else {
				$SelectionView->app_father_occupation->ViewValue = NULL;
			}
			$SelectionView->app_father_occupation->CssStyle = "";
			$SelectionView->app_father_occupation->CssClass = "";
			$SelectionView->app_father_occupation->ViewCustomAttributes = "";

			// app_guardian_occupation
			$SelectionView->app_guardian_occupation->CssStyle = "";
			$SelectionView->app_guardian_occupation->CssClass = "";
			$SelectionView->app_guardian_occupation->ViewCustomAttributes = "";

			// app_points
			$SelectionView->app_points->ViewValue = $SelectionView->app_points->CurrentValue;
			$SelectionView->app_points->CssStyle = "";
			$SelectionView->app_points->CssClass = "";
			$SelectionView->app_points->ViewCustomAttributes = "";

			// applicant_school_name
			$SelectionView->applicant_school_name->ViewValue = $SelectionView->applicant_school_name->CurrentValue;
			$SelectionView->applicant_school_name->CssStyle = "";
			$SelectionView->applicant_school_name->CssClass = "";
			$SelectionView->applicant_school_name->ViewCustomAttributes = "";

			// student_grades
			$SelectionView->student_grades->ViewValue = $SelectionView->student_grades->CurrentValue;
			$SelectionView->student_grades->CssStyle = "";
			$SelectionView->student_grades->CssClass = "";
			$SelectionView->student_grades->ViewCustomAttributes = "";

			// app_grant_id
			if (strval($SelectionView->app_grant_id->CurrentValue) <> "") {
				$sFilterWrk = "`grant_package_id` = " . ew_AdjustSql($SelectionView->app_grant_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `code` FROM `grant_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$SelectionView->app_grant_id->ViewValue = $rswrk->fields('code');
					$rswrk->Close();
				} else {
					$SelectionView->app_grant_id->ViewValue = $SelectionView->app_grant_id->CurrentValue;
				}
			} else {
				$SelectionView->app_grant_id->ViewValue = NULL;
			}
			$SelectionView->app_grant_id->CssStyle = "";
			$SelectionView->app_grant_id->CssClass = "";
			$SelectionView->app_grant_id->ViewCustomAttributes = "";

			// app_amount
			$SelectionView->app_amount->ViewValue = $SelectionView->app_amount->CurrentValue;
			$SelectionView->app_amount->ViewValue = ew_FormatCurrency($SelectionView->app_amount->ViewValue, 2, -2, -2, -2);
			$SelectionView->app_amount->CssStyle = "";
			$SelectionView->app_amount->CssClass = "";
			$SelectionView->app_amount->ViewCustomAttributes = "";

			// programarea_name
			if (!ew_Empty($SelectionView->programarea_name->CurrentValue)) {
				$SelectionView->programarea_name->HrefValue = ((!empty($SelectionView->programarea_name->ViewValue)) ? $SelectionView->programarea_name->ViewValue : $SelectionView->programarea_name->CurrentValue);
				if ($SelectionView->Export <> "") $SelectionView->programarea_name->HrefValue = ew_ConvertFullUrl($SelectionView->programarea_name->HrefValue);
			} else {
				$SelectionView->programarea_name->HrefValue = "";
			}
			$SelectionView->programarea_name->TooltipValue = "";

			// community
			$SelectionView->community->HrefValue = "";
			$SelectionView->community->TooltipValue = "";

			// student_lastname
			$SelectionView->student_lastname->HrefValue = "";
			$SelectionView->student_lastname->TooltipValue = "";

			// student_firstname
			$SelectionView->student_firstname->HrefValue = "";
			$SelectionView->student_firstname->TooltipValue = "";

			// student_middlename
			$SelectionView->student_middlename->HrefValue = "";
			$SelectionView->student_middlename->TooltipValue = "";

			// student_gender
			$SelectionView->student_gender->HrefValue = "";
			$SelectionView->student_gender->TooltipValue = "";

			// student_dob
			$SelectionView->student_dob->HrefValue = "";
			$SelectionView->student_dob->TooltipValue = "";

			// app_mother_occupation
			$SelectionView->app_mother_occupation->HrefValue = "";
			$SelectionView->app_mother_occupation->TooltipValue = "";

			// app_father_occupation
			$SelectionView->app_father_occupation->HrefValue = "";
			$SelectionView->app_father_occupation->TooltipValue = "";

			// app_guardian_occupation
			$SelectionView->app_guardian_occupation->HrefValue = "";
			$SelectionView->app_guardian_occupation->TooltipValue = "";

			// app_points
			$SelectionView->app_points->HrefValue = "";
			$SelectionView->app_points->TooltipValue = "";

			// applicant_school_name
			$SelectionView->applicant_school_name->HrefValue = "";
			$SelectionView->applicant_school_name->TooltipValue = "";

			// student_grades
			$SelectionView->student_grades->HrefValue = "";
			$SelectionView->student_grades->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($SelectionView->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$SelectionView->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $SelectionView;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $SelectionView->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($SelectionView->ExportAll) {
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
		if ($SelectionView->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($SelectionView, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($SelectionView->programarea_name);
				$ExportDoc->ExportCaption($SelectionView->community);
				$ExportDoc->ExportCaption($SelectionView->student_lastname);
				$ExportDoc->ExportCaption($SelectionView->student_firstname);
				$ExportDoc->ExportCaption($SelectionView->student_middlename);
				$ExportDoc->ExportCaption($SelectionView->student_gender);
				$ExportDoc->ExportCaption($SelectionView->student_dob);
				$ExportDoc->ExportCaption($SelectionView->AGE);
				$ExportDoc->ExportCaption($SelectionView->app_mother_occupation);
				$ExportDoc->ExportCaption($SelectionView->app_father_occupation);
				$ExportDoc->ExportCaption($SelectionView->app_guardian_occupation);
				$ExportDoc->ExportCaption($SelectionView->app_points);
				$ExportDoc->ExportCaption($SelectionView->applicant_school_name);
				$ExportDoc->ExportCaption($SelectionView->student_grades);
				$ExportDoc->ExportCaption($SelectionView->app_grant_id);
				$ExportDoc->ExportCaption($SelectionView->app_amount);
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
				$SelectionView->CssClass = "";
				$SelectionView->CssStyle = "";
				$SelectionView->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($SelectionView->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('programarea_name', $SelectionView->programarea_name->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('community', $SelectionView->community->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('student_lastname', $SelectionView->student_lastname->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('student_firstname', $SelectionView->student_firstname->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('student_middlename', $SelectionView->student_middlename->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('student_gender', $SelectionView->student_gender->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('student_dob', $SelectionView->student_dob->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('AGE', $SelectionView->AGE->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('app_mother_occupation', $SelectionView->app_mother_occupation->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('app_father_occupation', $SelectionView->app_father_occupation->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('app_guardian_occupation', $SelectionView->app_guardian_occupation->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('app_points', $SelectionView->app_points->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('applicant_school_name', $SelectionView->applicant_school_name->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('student_grades', $SelectionView->student_grades->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('app_grant_id', $SelectionView->app_grant_id->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
					$XmlDoc->AddField('app_amount', $SelectionView->app_amount->ExportValue($SelectionView->Export, $SelectionView->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($SelectionView->programarea_name);
					$ExportDoc->ExportField($SelectionView->community);
					$ExportDoc->ExportField($SelectionView->student_lastname);
					$ExportDoc->ExportField($SelectionView->student_firstname);
					$ExportDoc->ExportField($SelectionView->student_middlename);
					$ExportDoc->ExportField($SelectionView->student_gender);
					$ExportDoc->ExportField($SelectionView->student_dob);
					$ExportDoc->ExportField($SelectionView->AGE);
					$ExportDoc->ExportField($SelectionView->app_mother_occupation);
					$ExportDoc->ExportField($SelectionView->app_father_occupation);
					$ExportDoc->ExportField($SelectionView->app_guardian_occupation);
					$ExportDoc->ExportField($SelectionView->app_points);
					$ExportDoc->ExportField($SelectionView->applicant_school_name);
					$ExportDoc->ExportField($SelectionView->student_grades);
					$ExportDoc->ExportField($SelectionView->app_grant_id);
					$ExportDoc->ExportField($SelectionView->app_amount);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($SelectionView->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($SelectionView->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($SelectionView->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($SelectionView->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($SelectionView->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
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
	    $this->ListOptions->Add("award");
	    $this->ListOptions->Items["award"]->OnLeft = FALSE; // Link on left
	    $this->ListOptions->Itmes["award"]->Visible=TRUE;
	}

		// ListOptions Rendered event
	function ListOptions_Rendered() {
	    global $SelectionView;
	        if($SelectionView->app_grant_id->CurrentValue==0){
	            $this->ListOptions->Items["award"]->Body="<span></span>
	                <span onclick=\"awardScholarship(this,{$SelectionView->student_applicant_id->CurrentValue})\"
	                       style=\"color:blue;text-decoration: underline; cursor: pointer\">award</span>";
	        }else{
	            $this->ListOptions->Items["award"]->Body="<span>{$SelectionView->app_grant_id->ViewValue} GHc{$SelectionView->app_amount->ViewValue}</span>
	                        <span onclick=\"awardScholarship(this,{$SelectionView->student_applicant_id->CurrentValue})\"
	                       style=\"color:blue;text-decoration: underline; cursor: pointer\">cancel</span>";
	        }
	}
}
?>
