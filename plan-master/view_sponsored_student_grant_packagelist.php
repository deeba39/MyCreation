<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "view_sponsored_student_grant_packageinfo.php" ?>
<?php include "grant_packageinfo.php" ?>
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

// Create page object
$view_sponsored_student_grant_package_list = new cview_sponsored_student_grant_package_list();
$Page =& $view_sponsored_student_grant_package_list;

// Page init
$view_sponsored_student_grant_package_list->Page_Init();

// Page main
$view_sponsored_student_grant_package_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($view_sponsored_student_grant_package->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var view_sponsored_student_grant_package_list = new ew_Page("view_sponsored_student_grant_package_list");

// page properties
view_sponsored_student_grant_package_list.PageID = "list"; // page ID
view_sponsored_student_grant_package_list.FormID = "fview_sponsored_student_grant_packagelist"; // form ID
var EW_PAGE_ID = view_sponsored_student_grant_package_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
view_sponsored_student_grant_package_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
view_sponsored_student_grant_package_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
view_sponsored_student_grant_package_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($view_sponsored_student_grant_package->Export == "") { ?>
<?php
$gsMasterReturnUrl = "grant_packagelist.php";
if ($view_sponsored_student_grant_package_list->sDbMasterFilter <> "" && $view_sponsored_student_grant_package->getCurrentMasterTable() == "grant_package") {
	if ($view_sponsored_student_grant_package_list->bMasterRecordExists) {
		if ($view_sponsored_student_grant_package->getCurrentMasterTable() == $view_sponsored_student_grant_package->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "grant_packagemaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$view_sponsored_student_grant_package_list->lTotalRecs = $view_sponsored_student_grant_package->SelectRecordCount();
	} else {
		if ($rs = $view_sponsored_student_grant_package_list->LoadRecordset())
			$view_sponsored_student_grant_package_list->lTotalRecs = $rs->RecordCount();
	}
	$view_sponsored_student_grant_package_list->lStartRec = 1;
	if ($view_sponsored_student_grant_package_list->lDisplayRecs <= 0 || ($view_sponsored_student_grant_package->Export <> "" && $view_sponsored_student_grant_package->ExportAll)) // Display all records
		$view_sponsored_student_grant_package_list->lDisplayRecs = $view_sponsored_student_grant_package_list->lTotalRecs;
	if (!($view_sponsored_student_grant_package->Export <> "" && $view_sponsored_student_grant_package->ExportAll))
		$view_sponsored_student_grant_package_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $view_sponsored_student_grant_package_list->LoadRecordset($view_sponsored_student_grant_package_list->lStartRec-1, $view_sponsored_student_grant_package_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $view_sponsored_student_grant_package->TableCaption() ?>
<?php if ($view_sponsored_student_grant_package->Export == "" && $view_sponsored_student_grant_package->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $view_sponsored_student_grant_package_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $view_sponsored_student_grant_package_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $view_sponsored_student_grant_package_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($view_sponsored_student_grant_package->Export == "" && $view_sponsored_student_grant_package->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(view_sponsored_student_grant_package_list);" style="text-decoration: none;"><img id="view_sponsored_student_grant_package_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="view_sponsored_student_grant_package_list_SearchPanel">
<form name="fview_sponsored_student_grant_packagelistsrch" id="fview_sponsored_student_grant_packagelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="view_sponsored_student_grant_package">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($view_sponsored_student_grant_package->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $view_sponsored_student_grant_package_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($view_sponsored_student_grant_package->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($view_sponsored_student_grant_package->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($view_sponsored_student_grant_package->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$view_sponsored_student_grant_package_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fview_sponsored_student_grant_packagelist" id="fview_sponsored_student_grant_packagelist" class="ewForm" action="" method="post">
<div id="gmp_view_sponsored_student_grant_package" class="ewGridMiddlePanel">
<?php if ($view_sponsored_student_grant_package_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $view_sponsored_student_grant_package->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$view_sponsored_student_grant_package_list->RenderListOptions();

// Render list options (header, left)
$view_sponsored_student_grant_package_list->ListOptions->Render("header", "left");
?>
<?php if ($view_sponsored_student_grant_package->student_firstname->Visible) { // student_firstname ?>
	<?php if ($view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->student_firstname) == "") { ?>
		<td><?php echo $view_sponsored_student_grant_package->student_firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->student_firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grant_package->student_firstname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grant_package->student_firstname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grant_package->student_firstname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grant_package->student_lastname->Visible) { // student_lastname ?>
	<?php if ($view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->student_lastname) == "") { ?>
		<td><?php echo $view_sponsored_student_grant_package->student_lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->student_lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grant_package->student_lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grant_package->student_lastname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grant_package->student_lastname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grant_package->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
	<?php if ($view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->student_resident_programarea_id) == "") { ?>
		<td><?php echo $view_sponsored_student_grant_package->student_resident_programarea_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->student_resident_programarea_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grant_package->student_resident_programarea_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grant_package->student_resident_programarea_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grant_package->student_resident_programarea_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grant_package->grant_package_grant_package_id->Visible) { // grant_package_grant_package_id ?>
	<?php if ($view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->grant_package_grant_package_id) == "") { ?>
		<td><?php echo $view_sponsored_student_grant_package->grant_package_grant_package_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->grant_package_grant_package_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grant_package->grant_package_grant_package_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grant_package->grant_package_grant_package_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grant_package->grant_package_grant_package_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grant_package->annual_amount->Visible) { // annual_amount ?>
	<?php if ($view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->annual_amount) == "") { ?>
		<td><?php echo $view_sponsored_student_grant_package->annual_amount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->annual_amount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grant_package->annual_amount->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grant_package->annual_amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grant_package->annual_amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grant_package->status->Visible) { // status ?>
	<?php if ($view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->status) == "") { ?>
		<td><?php echo $view_sponsored_student_grant_package->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grant_package->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grant_package->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grant_package->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grant_package->start_date->Visible) { // start_date ?>
	<?php if ($view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->start_date) == "") { ?>
		<td><?php echo $view_sponsored_student_grant_package->start_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->start_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grant_package->start_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grant_package->start_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grant_package->start_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grant_package->end_date->Visible) { // end_date ?>
	<?php if ($view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->end_date) == "") { ?>
		<td><?php echo $view_sponsored_student_grant_package->end_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->end_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grant_package->end_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grant_package->end_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grant_package->end_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_sponsored_student_grant_package->scholarship_type_scholarship_type->Visible) { // scholarship_type_scholarship_type ?>
	<?php if ($view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->scholarship_type_scholarship_type) == "") { ?>
		<td><?php echo $view_sponsored_student_grant_package->scholarship_type_scholarship_type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_sponsored_student_grant_package->SortUrl($view_sponsored_student_grant_package->scholarship_type_scholarship_type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_sponsored_student_grant_package->scholarship_type_scholarship_type->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_sponsored_student_grant_package->scholarship_type_scholarship_type->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_sponsored_student_grant_package->scholarship_type_scholarship_type->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$view_sponsored_student_grant_package_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($view_sponsored_student_grant_package->ExportAll && $view_sponsored_student_grant_package->Export <> "") {
	$view_sponsored_student_grant_package_list->lStopRec = $view_sponsored_student_grant_package_list->lTotalRecs;
} else {
	$view_sponsored_student_grant_package_list->lStopRec = $view_sponsored_student_grant_package_list->lStartRec + $view_sponsored_student_grant_package_list->lDisplayRecs - 1; // Set the last record to display
}
$view_sponsored_student_grant_package_list->lRecCount = $view_sponsored_student_grant_package_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $view_sponsored_student_grant_package_list->lStartRec > 1)
		$rs->Move($view_sponsored_student_grant_package_list->lStartRec - 1);
}

// Initialize aggregate
$view_sponsored_student_grant_package->RowType = EW_ROWTYPE_AGGREGATEINIT;
$view_sponsored_student_grant_package_list->RenderRow();
$view_sponsored_student_grant_package_list->lRowCnt = 0;
while (($view_sponsored_student_grant_package->CurrentAction == "gridadd" || !$rs->EOF) &&
	$view_sponsored_student_grant_package_list->lRecCount < $view_sponsored_student_grant_package_list->lStopRec) {
	$view_sponsored_student_grant_package_list->lRecCount++;
	if (intval($view_sponsored_student_grant_package_list->lRecCount) >= intval($view_sponsored_student_grant_package_list->lStartRec)) {
		$view_sponsored_student_grant_package_list->lRowCnt++;

	// Init row class and style
	$view_sponsored_student_grant_package->CssClass = "";
	$view_sponsored_student_grant_package->CssStyle = "";
	$view_sponsored_student_grant_package->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($view_sponsored_student_grant_package->CurrentAction == "gridadd") {
		$view_sponsored_student_grant_package_list->LoadDefaultValues(); // Load default values
	} else {
		$view_sponsored_student_grant_package_list->LoadRowValues($rs); // Load row values
	}
	$view_sponsored_student_grant_package->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$view_sponsored_student_grant_package_list->RenderRow();

	// Render list options
	$view_sponsored_student_grant_package_list->RenderListOptions();
?>
	<tr<?php echo $view_sponsored_student_grant_package->RowAttributes() ?>>
<?php

// Render list options (body, left)
$view_sponsored_student_grant_package_list->ListOptions->Render("body", "left");
?>
	<?php if ($view_sponsored_student_grant_package->student_firstname->Visible) { // student_firstname ?>
		<td<?php echo $view_sponsored_student_grant_package->student_firstname->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grant_package->student_firstname->ViewAttributes() ?>><?php echo $view_sponsored_student_grant_package->student_firstname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grant_package->student_lastname->Visible) { // student_lastname ?>
		<td<?php echo $view_sponsored_student_grant_package->student_lastname->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grant_package->student_lastname->ViewAttributes() ?>><?php echo $view_sponsored_student_grant_package->student_lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grant_package->student_resident_programarea_id->Visible) { // student_resident_programarea_id ?>
		<td<?php echo $view_sponsored_student_grant_package->student_resident_programarea_id->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grant_package->student_resident_programarea_id->ViewAttributes() ?>><?php echo $view_sponsored_student_grant_package->student_resident_programarea_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grant_package->grant_package_grant_package_id->Visible) { // grant_package_grant_package_id ?>
		<td<?php echo $view_sponsored_student_grant_package->grant_package_grant_package_id->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grant_package->grant_package_grant_package_id->ViewAttributes() ?>><?php echo $view_sponsored_student_grant_package->grant_package_grant_package_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grant_package->annual_amount->Visible) { // annual_amount ?>
		<td<?php echo $view_sponsored_student_grant_package->annual_amount->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grant_package->annual_amount->ViewAttributes() ?>><?php echo $view_sponsored_student_grant_package->annual_amount->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grant_package->status->Visible) { // status ?>
		<td<?php echo $view_sponsored_student_grant_package->status->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grant_package->status->ViewAttributes() ?>><?php echo $view_sponsored_student_grant_package->status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grant_package->start_date->Visible) { // start_date ?>
		<td<?php echo $view_sponsored_student_grant_package->start_date->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grant_package->start_date->ViewAttributes() ?>><?php echo $view_sponsored_student_grant_package->start_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grant_package->end_date->Visible) { // end_date ?>
		<td<?php echo $view_sponsored_student_grant_package->end_date->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grant_package->end_date->ViewAttributes() ?>><?php echo $view_sponsored_student_grant_package->end_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($view_sponsored_student_grant_package->scholarship_type_scholarship_type->Visible) { // scholarship_type_scholarship_type ?>
		<td<?php echo $view_sponsored_student_grant_package->scholarship_type_scholarship_type->CellAttributes() ?>>
<div<?php echo $view_sponsored_student_grant_package->scholarship_type_scholarship_type->ViewAttributes() ?>><?php echo $view_sponsored_student_grant_package->scholarship_type_scholarship_type->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view_sponsored_student_grant_package_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($view_sponsored_student_grant_package->CurrentAction <> "gridadd")
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
<?php if ($view_sponsored_student_grant_package->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($view_sponsored_student_grant_package->CurrentAction <> "gridadd" && $view_sponsored_student_grant_package->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($view_sponsored_student_grant_package_list->Pager)) $view_sponsored_student_grant_package_list->Pager = new cPrevNextPager($view_sponsored_student_grant_package_list->lStartRec, $view_sponsored_student_grant_package_list->lDisplayRecs, $view_sponsored_student_grant_package_list->lTotalRecs) ?>
<?php if ($view_sponsored_student_grant_package_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($view_sponsored_student_grant_package_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $view_sponsored_student_grant_package_list->PageUrl() ?>start=<?php echo $view_sponsored_student_grant_package_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($view_sponsored_student_grant_package_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $view_sponsored_student_grant_package_list->PageUrl() ?>start=<?php echo $view_sponsored_student_grant_package_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $view_sponsored_student_grant_package_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($view_sponsored_student_grant_package_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $view_sponsored_student_grant_package_list->PageUrl() ?>start=<?php echo $view_sponsored_student_grant_package_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($view_sponsored_student_grant_package_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $view_sponsored_student_grant_package_list->PageUrl() ?>start=<?php echo $view_sponsored_student_grant_package_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $view_sponsored_student_grant_package_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $view_sponsored_student_grant_package_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $view_sponsored_student_grant_package_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $view_sponsored_student_grant_package_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($view_sponsored_student_grant_package_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($view_sponsored_student_grant_package_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($view_sponsored_student_grant_package->Export == "" && $view_sponsored_student_grant_package->CurrentAction == "") { ?>
<?php } ?>
<?php if ($view_sponsored_student_grant_package->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$view_sponsored_student_grant_package_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cview_sponsored_student_grant_package_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'view_sponsored_student_grant_package';

	// Page object name
	var $PageObjName = 'view_sponsored_student_grant_package_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $view_sponsored_student_grant_package;
		if ($view_sponsored_student_grant_package->UseTokenInUrl) $PageUrl .= "t=" . $view_sponsored_student_grant_package->TableVar . "&"; // Add page token
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
		global $objForm, $view_sponsored_student_grant_package;
		if ($view_sponsored_student_grant_package->UseTokenInUrl) {
			if ($objForm)
				return ($view_sponsored_student_grant_package->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($view_sponsored_student_grant_package->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cview_sponsored_student_grant_package_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (view_sponsored_student_grant_package)
		$GLOBALS["view_sponsored_student_grant_package"] = new cview_sponsored_student_grant_package();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["view_sponsored_student_grant_package"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "view_sponsored_student_grant_packagedelete.php";
		$this->MultiUpdateUrl = "view_sponsored_student_grant_packageupdate.php";

		// Table object (grant_package)
		$GLOBALS['grant_package'] = new cgrant_package();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'view_sponsored_student_grant_package', TRUE);

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
		global $view_sponsored_student_grant_package;

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
			$view_sponsored_student_grant_package->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$view_sponsored_student_grant_package->Export = $_POST["exporttype"];
		} else {
			$view_sponsored_student_grant_package->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $view_sponsored_student_grant_package->Export; // Get export parameter, used in header
		$gsExportFile = $view_sponsored_student_grant_package->TableVar; // Get export file, used in header
		if ($view_sponsored_student_grant_package->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($view_sponsored_student_grant_package->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $view_sponsored_student_grant_package;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterDetail();

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$view_sponsored_student_grant_package->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($view_sponsored_student_grant_package->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $view_sponsored_student_grant_package->getRecordsPerPage(); // Restore from Session
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
		$view_sponsored_student_grant_package->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$view_sponsored_student_grant_package->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$view_sponsored_student_grant_package->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $view_sponsored_student_grant_package->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $view_sponsored_student_grant_package->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $view_sponsored_student_grant_package->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($view_sponsored_student_grant_package->getMasterFilter() <> "" && $view_sponsored_student_grant_package->getCurrentMasterTable() == "grant_package") {
			global $grant_package;
			$rsmaster = $grant_package->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$view_sponsored_student_grant_package->setMasterFilter(""); // Clear master filter
				$view_sponsored_student_grant_package->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($view_sponsored_student_grant_package->getReturnUrl()); // Return to caller
			} else {
				$grant_package->LoadListRowValues($rsmaster);
				$grant_package->RowType = EW_ROWTYPE_MASTER; // Master row
				$grant_package->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$view_sponsored_student_grant_package->setSessionWhere($sFilter);
		$view_sponsored_student_grant_package->CurrentFilter = "";

		// Export data only
		if (in_array($view_sponsored_student_grant_package->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($view_sponsored_student_grant_package->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $view_sponsored_student_grant_package;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grant_package->student_firstname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $view_sponsored_student_grant_package->student_lastname, $Keyword);
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
		global $Security, $view_sponsored_student_grant_package;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $view_sponsored_student_grant_package->BasicSearchKeyword;
		$sSearchType = $view_sponsored_student_grant_package->BasicSearchType;
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
			$view_sponsored_student_grant_package->setSessionBasicSearchKeyword($sSearchKeyword);
			$view_sponsored_student_grant_package->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $view_sponsored_student_grant_package;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$view_sponsored_student_grant_package->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $view_sponsored_student_grant_package;
		$view_sponsored_student_grant_package->setSessionBasicSearchKeyword("");
		$view_sponsored_student_grant_package->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $view_sponsored_student_grant_package;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$view_sponsored_student_grant_package->BasicSearchKeyword = $view_sponsored_student_grant_package->getSessionBasicSearchKeyword();
			$view_sponsored_student_grant_package->BasicSearchType = $view_sponsored_student_grant_package->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $view_sponsored_student_grant_package;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$view_sponsored_student_grant_package->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$view_sponsored_student_grant_package->CurrentOrderType = @$_GET["ordertype"];
			$view_sponsored_student_grant_package->UpdateSort($view_sponsored_student_grant_package->student_firstname); // student_firstname
			$view_sponsored_student_grant_package->UpdateSort($view_sponsored_student_grant_package->student_lastname); // student_lastname
			$view_sponsored_student_grant_package->UpdateSort($view_sponsored_student_grant_package->student_resident_programarea_id); // student_resident_programarea_id
			$view_sponsored_student_grant_package->UpdateSort($view_sponsored_student_grant_package->grant_package_grant_package_id); // grant_package_grant_package_id
			$view_sponsored_student_grant_package->UpdateSort($view_sponsored_student_grant_package->annual_amount); // annual_amount
			$view_sponsored_student_grant_package->UpdateSort($view_sponsored_student_grant_package->status); // status
			$view_sponsored_student_grant_package->UpdateSort($view_sponsored_student_grant_package->start_date); // start_date
			$view_sponsored_student_grant_package->UpdateSort($view_sponsored_student_grant_package->end_date); // end_date
			$view_sponsored_student_grant_package->UpdateSort($view_sponsored_student_grant_package->scholarship_type_scholarship_type); // scholarship_type_scholarship_type
			$view_sponsored_student_grant_package->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $view_sponsored_student_grant_package;
		$sOrderBy = $view_sponsored_student_grant_package->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($view_sponsored_student_grant_package->SqlOrderBy() <> "") {
				$sOrderBy = $view_sponsored_student_grant_package->SqlOrderBy();
				$view_sponsored_student_grant_package->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $view_sponsored_student_grant_package;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$view_sponsored_student_grant_package->getCurrentMasterTable = ""; // Clear master table
				$view_sponsored_student_grant_package->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$view_sponsored_student_grant_package->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$view_sponsored_student_grant_package->grant_package_grant_package_id->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$view_sponsored_student_grant_package->setSessionOrderBy($sOrderBy);
				$view_sponsored_student_grant_package->student_firstname->setSort("");
				$view_sponsored_student_grant_package->student_lastname->setSort("");
				$view_sponsored_student_grant_package->student_resident_programarea_id->setSort("");
				$view_sponsored_student_grant_package->grant_package_grant_package_id->setSort("");
				$view_sponsored_student_grant_package->annual_amount->setSort("");
				$view_sponsored_student_grant_package->status->setSort("");
				$view_sponsored_student_grant_package->start_date->setSort("");
				$view_sponsored_student_grant_package->end_date->setSort("");
				$view_sponsored_student_grant_package->scholarship_type_scholarship_type->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$view_sponsored_student_grant_package->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $view_sponsored_student_grant_package;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($view_sponsored_student_grant_package->Export <> "" ||
			$view_sponsored_student_grant_package->CurrentAction == "gridadd" ||
			$view_sponsored_student_grant_package->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $view_sponsored_student_grant_package;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $view_sponsored_student_grant_package;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $view_sponsored_student_grant_package;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$view_sponsored_student_grant_package->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$view_sponsored_student_grant_package->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $view_sponsored_student_grant_package->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$view_sponsored_student_grant_package->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$view_sponsored_student_grant_package->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$view_sponsored_student_grant_package->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $view_sponsored_student_grant_package;
		$view_sponsored_student_grant_package->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$view_sponsored_student_grant_package->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $view_sponsored_student_grant_package;

		// Call Recordset Selecting event
		$view_sponsored_student_grant_package->Recordset_Selecting($view_sponsored_student_grant_package->CurrentFilter);

		// Load List page SQL
		$sSql = $view_sponsored_student_grant_package->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$view_sponsored_student_grant_package->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $view_sponsored_student_grant_package;
		$sFilter = $view_sponsored_student_grant_package->KeyFilter();

		// Call Row Selecting event
		$view_sponsored_student_grant_package->Row_Selecting($sFilter);

		// Load SQL based on filter
		$view_sponsored_student_grant_package->CurrentFilter = $sFilter;
		$sSql = $view_sponsored_student_grant_package->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$view_sponsored_student_grant_package->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $view_sponsored_student_grant_package;
		$view_sponsored_student_grant_package->student_firstname->setDbValue($rs->fields('student_firstname'));
		$view_sponsored_student_grant_package->student_lastname->setDbValue($rs->fields('student_lastname'));
		$view_sponsored_student_grant_package->student_resident_programarea_id->setDbValue($rs->fields('student_resident_programarea_id'));
		$view_sponsored_student_grant_package->student_applicant_student_applicant_id->setDbValue($rs->fields('student_applicant_student_applicant_id'));
		$view_sponsored_student_grant_package->grant_package_grant_package_id->setDbValue($rs->fields('grant_package_grant_package_id'));
		$view_sponsored_student_grant_package->annual_amount->setDbValue($rs->fields('annual_amount'));
		$view_sponsored_student_grant_package->status->setDbValue($rs->fields('status'));
		$view_sponsored_student_grant_package->start_date->setDbValue($rs->fields('start_date'));
		$view_sponsored_student_grant_package->end_date->setDbValue($rs->fields('end_date'));
		$view_sponsored_student_grant_package->sponsored_student_sponsored_student_id->setDbValue($rs->fields('sponsored_student_sponsored_student_id'));
		$view_sponsored_student_grant_package->scholarship_type_scholarship_type->setDbValue($rs->fields('scholarship_type_scholarship_type'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $view_sponsored_student_grant_package;

		// Initialize URLs
		$this->ViewUrl = $view_sponsored_student_grant_package->ViewUrl();
		$this->EditUrl = $view_sponsored_student_grant_package->EditUrl();
		$this->InlineEditUrl = $view_sponsored_student_grant_package->InlineEditUrl();
		$this->CopyUrl = $view_sponsored_student_grant_package->CopyUrl();
		$this->InlineCopyUrl = $view_sponsored_student_grant_package->InlineCopyUrl();
		$this->DeleteUrl = $view_sponsored_student_grant_package->DeleteUrl();

		// Call Row_Rendering event
		$view_sponsored_student_grant_package->Row_Rendering();

		// Common render codes for all row types
		// student_firstname

		$view_sponsored_student_grant_package->student_firstname->CellCssStyle = ""; $view_sponsored_student_grant_package->student_firstname->CellCssClass = "";
		$view_sponsored_student_grant_package->student_firstname->CellAttrs = array(); $view_sponsored_student_grant_package->student_firstname->ViewAttrs = array(); $view_sponsored_student_grant_package->student_firstname->EditAttrs = array();

		// student_lastname
		$view_sponsored_student_grant_package->student_lastname->CellCssStyle = ""; $view_sponsored_student_grant_package->student_lastname->CellCssClass = "";
		$view_sponsored_student_grant_package->student_lastname->CellAttrs = array(); $view_sponsored_student_grant_package->student_lastname->ViewAttrs = array(); $view_sponsored_student_grant_package->student_lastname->EditAttrs = array();

		// student_resident_programarea_id
		$view_sponsored_student_grant_package->student_resident_programarea_id->CellCssStyle = ""; $view_sponsored_student_grant_package->student_resident_programarea_id->CellCssClass = "";
		$view_sponsored_student_grant_package->student_resident_programarea_id->CellAttrs = array(); $view_sponsored_student_grant_package->student_resident_programarea_id->ViewAttrs = array(); $view_sponsored_student_grant_package->student_resident_programarea_id->EditAttrs = array();

		// grant_package_grant_package_id
		$view_sponsored_student_grant_package->grant_package_grant_package_id->CellCssStyle = ""; $view_sponsored_student_grant_package->grant_package_grant_package_id->CellCssClass = "";
		$view_sponsored_student_grant_package->grant_package_grant_package_id->CellAttrs = array(); $view_sponsored_student_grant_package->grant_package_grant_package_id->ViewAttrs = array(); $view_sponsored_student_grant_package->grant_package_grant_package_id->EditAttrs = array();

		// annual_amount
		$view_sponsored_student_grant_package->annual_amount->CellCssStyle = ""; $view_sponsored_student_grant_package->annual_amount->CellCssClass = "";
		$view_sponsored_student_grant_package->annual_amount->CellAttrs = array(); $view_sponsored_student_grant_package->annual_amount->ViewAttrs = array(); $view_sponsored_student_grant_package->annual_amount->EditAttrs = array();

		// status
		$view_sponsored_student_grant_package->status->CellCssStyle = ""; $view_sponsored_student_grant_package->status->CellCssClass = "";
		$view_sponsored_student_grant_package->status->CellAttrs = array(); $view_sponsored_student_grant_package->status->ViewAttrs = array(); $view_sponsored_student_grant_package->status->EditAttrs = array();

		// start_date
		$view_sponsored_student_grant_package->start_date->CellCssStyle = ""; $view_sponsored_student_grant_package->start_date->CellCssClass = "";
		$view_sponsored_student_grant_package->start_date->CellAttrs = array(); $view_sponsored_student_grant_package->start_date->ViewAttrs = array(); $view_sponsored_student_grant_package->start_date->EditAttrs = array();

		// end_date
		$view_sponsored_student_grant_package->end_date->CellCssStyle = ""; $view_sponsored_student_grant_package->end_date->CellCssClass = "";
		$view_sponsored_student_grant_package->end_date->CellAttrs = array(); $view_sponsored_student_grant_package->end_date->ViewAttrs = array(); $view_sponsored_student_grant_package->end_date->EditAttrs = array();

		// scholarship_type_scholarship_type
		$view_sponsored_student_grant_package->scholarship_type_scholarship_type->CellCssStyle = ""; $view_sponsored_student_grant_package->scholarship_type_scholarship_type->CellCssClass = "";
		$view_sponsored_student_grant_package->scholarship_type_scholarship_type->CellAttrs = array(); $view_sponsored_student_grant_package->scholarship_type_scholarship_type->ViewAttrs = array(); $view_sponsored_student_grant_package->scholarship_type_scholarship_type->EditAttrs = array();
		if ($view_sponsored_student_grant_package->RowType == EW_ROWTYPE_VIEW) { // View row

			// student_firstname
			$view_sponsored_student_grant_package->student_firstname->ViewValue = $view_sponsored_student_grant_package->student_firstname->CurrentValue;
			$view_sponsored_student_grant_package->student_firstname->CssStyle = "";
			$view_sponsored_student_grant_package->student_firstname->CssClass = "";
			$view_sponsored_student_grant_package->student_firstname->ViewCustomAttributes = "";

			// student_lastname
			$view_sponsored_student_grant_package->student_lastname->ViewValue = $view_sponsored_student_grant_package->student_lastname->CurrentValue;
			$view_sponsored_student_grant_package->student_lastname->CssStyle = "";
			$view_sponsored_student_grant_package->student_lastname->CssClass = "";
			$view_sponsored_student_grant_package->student_lastname->ViewCustomAttributes = "";

			// student_resident_programarea_id
			if (strval($view_sponsored_student_grant_package->student_resident_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($view_sponsored_student_grant_package->student_resident_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_sponsored_student_grant_package->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$view_sponsored_student_grant_package->student_resident_programarea_id->ViewValue = $view_sponsored_student_grant_package->student_resident_programarea_id->CurrentValue;
				}
			} else {
				$view_sponsored_student_grant_package->student_resident_programarea_id->ViewValue = NULL;
			}
			$view_sponsored_student_grant_package->student_resident_programarea_id->CssStyle = "";
			$view_sponsored_student_grant_package->student_resident_programarea_id->CssClass = "";
			$view_sponsored_student_grant_package->student_resident_programarea_id->ViewCustomAttributes = "";

			// student_applicant_student_applicant_id
			$view_sponsored_student_grant_package->student_applicant_student_applicant_id->ViewValue = $view_sponsored_student_grant_package->student_applicant_student_applicant_id->CurrentValue;
			if (strval($view_sponsored_student_grant_package->student_applicant_student_applicant_id->CurrentValue) <> "") {
				$sFilterWrk = "`student_applicant_id` = " . ew_AdjustSql($view_sponsored_student_grant_package->student_applicant_student_applicant_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `student_lastname`, `student_firstname` FROM `student_applicant`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_sponsored_student_grant_package->student_applicant_student_applicant_id->ViewValue = $rswrk->fields('student_lastname');
					$view_sponsored_student_grant_package->student_applicant_student_applicant_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('student_firstname');
					$rswrk->Close();
				} else {
					$view_sponsored_student_grant_package->student_applicant_student_applicant_id->ViewValue = $view_sponsored_student_grant_package->student_applicant_student_applicant_id->CurrentValue;
				}
			} else {
				$view_sponsored_student_grant_package->student_applicant_student_applicant_id->ViewValue = NULL;
			}
			$view_sponsored_student_grant_package->student_applicant_student_applicant_id->CssStyle = "";
			$view_sponsored_student_grant_package->student_applicant_student_applicant_id->CssClass = "";
			$view_sponsored_student_grant_package->student_applicant_student_applicant_id->ViewCustomAttributes = "";

			// grant_package_grant_package_id
			$view_sponsored_student_grant_package->grant_package_grant_package_id->ViewValue = $view_sponsored_student_grant_package->grant_package_grant_package_id->CurrentValue;
			if (strval($view_sponsored_student_grant_package->grant_package_grant_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`grant_package_id` = " . ew_AdjustSql($view_sponsored_student_grant_package->grant_package_grant_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `grant_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_sponsored_student_grant_package->grant_package_grant_package_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$view_sponsored_student_grant_package->grant_package_grant_package_id->ViewValue = $view_sponsored_student_grant_package->grant_package_grant_package_id->CurrentValue;
				}
			} else {
				$view_sponsored_student_grant_package->grant_package_grant_package_id->ViewValue = NULL;
			}
			$view_sponsored_student_grant_package->grant_package_grant_package_id->CssStyle = "";
			$view_sponsored_student_grant_package->grant_package_grant_package_id->CssClass = "";
			$view_sponsored_student_grant_package->grant_package_grant_package_id->ViewCustomAttributes = "";

			// annual_amount
			$view_sponsored_student_grant_package->annual_amount->ViewValue = $view_sponsored_student_grant_package->annual_amount->CurrentValue;
			$view_sponsored_student_grant_package->annual_amount->CssStyle = "";
			$view_sponsored_student_grant_package->annual_amount->CssClass = "";
			$view_sponsored_student_grant_package->annual_amount->ViewCustomAttributes = "";

			// status
			if (strval($view_sponsored_student_grant_package->status->CurrentValue) <> "") {
				switch ($view_sponsored_student_grant_package->status->CurrentValue) {
					case "1":
						$view_sponsored_student_grant_package->status->ViewValue = "Active";
						break;
					case "2":
						$view_sponsored_student_grant_package->status->ViewValue = "NOT ACTIVE";
						break;
					default:
						$view_sponsored_student_grant_package->status->ViewValue = $view_sponsored_student_grant_package->status->CurrentValue;
				}
			} else {
				$view_sponsored_student_grant_package->status->ViewValue = NULL;
			}
			$view_sponsored_student_grant_package->status->CssStyle = "";
			$view_sponsored_student_grant_package->status->CssClass = "";
			$view_sponsored_student_grant_package->status->ViewCustomAttributes = "";

			// start_date
			$view_sponsored_student_grant_package->start_date->ViewValue = $view_sponsored_student_grant_package->start_date->CurrentValue;
			$view_sponsored_student_grant_package->start_date->ViewValue = ew_FormatNumber($view_sponsored_student_grant_package->start_date->ViewValue, 0, 0, 0, 0);
			$view_sponsored_student_grant_package->start_date->CssStyle = "";
			$view_sponsored_student_grant_package->start_date->CssClass = "";
			$view_sponsored_student_grant_package->start_date->ViewCustomAttributes = "";

			// end_date
			$view_sponsored_student_grant_package->end_date->ViewValue = $view_sponsored_student_grant_package->end_date->CurrentValue;
			$view_sponsored_student_grant_package->end_date->ViewValue = ew_FormatNumber($view_sponsored_student_grant_package->end_date->ViewValue, 0, 0, 0, 0);
			$view_sponsored_student_grant_package->end_date->CssStyle = "";
			$view_sponsored_student_grant_package->end_date->CssClass = "";
			$view_sponsored_student_grant_package->end_date->ViewCustomAttributes = "";

			// scholarship_type_scholarship_type
			$view_sponsored_student_grant_package->scholarship_type_scholarship_type->ViewValue = $view_sponsored_student_grant_package->scholarship_type_scholarship_type->CurrentValue;
			if (strval($view_sponsored_student_grant_package->scholarship_type_scholarship_type->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_type_id` = " . ew_AdjustSql($view_sponsored_student_grant_package->scholarship_type_scholarship_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `scholarship_type_name` FROM `scholarship_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_sponsored_student_grant_package->scholarship_type_scholarship_type->ViewValue = $rswrk->fields('scholarship_type_name');
					$rswrk->Close();
				} else {
					$view_sponsored_student_grant_package->scholarship_type_scholarship_type->ViewValue = $view_sponsored_student_grant_package->scholarship_type_scholarship_type->CurrentValue;
				}
			} else {
				$view_sponsored_student_grant_package->scholarship_type_scholarship_type->ViewValue = NULL;
			}
			$view_sponsored_student_grant_package->scholarship_type_scholarship_type->CssStyle = "";
			$view_sponsored_student_grant_package->scholarship_type_scholarship_type->CssClass = "";
			$view_sponsored_student_grant_package->scholarship_type_scholarship_type->ViewCustomAttributes = "";

			// student_firstname
			$view_sponsored_student_grant_package->student_firstname->HrefValue = "";
			$view_sponsored_student_grant_package->student_firstname->TooltipValue = "";

			// student_lastname
			$view_sponsored_student_grant_package->student_lastname->HrefValue = "";
			$view_sponsored_student_grant_package->student_lastname->TooltipValue = "";

			// student_resident_programarea_id
			$view_sponsored_student_grant_package->student_resident_programarea_id->HrefValue = "";
			$view_sponsored_student_grant_package->student_resident_programarea_id->TooltipValue = "";

			// grant_package_grant_package_id
			$view_sponsored_student_grant_package->grant_package_grant_package_id->HrefValue = "";
			$view_sponsored_student_grant_package->grant_package_grant_package_id->TooltipValue = "";

			// annual_amount
			$view_sponsored_student_grant_package->annual_amount->HrefValue = "";
			$view_sponsored_student_grant_package->annual_amount->TooltipValue = "";

			// status
			$view_sponsored_student_grant_package->status->HrefValue = "";
			$view_sponsored_student_grant_package->status->TooltipValue = "";

			// start_date
			$view_sponsored_student_grant_package->start_date->HrefValue = "";
			$view_sponsored_student_grant_package->start_date->TooltipValue = "";

			// end_date
			$view_sponsored_student_grant_package->end_date->HrefValue = "";
			$view_sponsored_student_grant_package->end_date->TooltipValue = "";

			// scholarship_type_scholarship_type
			$view_sponsored_student_grant_package->scholarship_type_scholarship_type->HrefValue = "";
			$view_sponsored_student_grant_package->scholarship_type_scholarship_type->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($view_sponsored_student_grant_package->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$view_sponsored_student_grant_package->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $view_sponsored_student_grant_package;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $view_sponsored_student_grant_package->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($view_sponsored_student_grant_package->ExportAll) {
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
		if ($view_sponsored_student_grant_package->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($view_sponsored_student_grant_package, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($view_sponsored_student_grant_package->student_firstname);
				$ExportDoc->ExportCaption($view_sponsored_student_grant_package->student_lastname);
				$ExportDoc->ExportCaption($view_sponsored_student_grant_package->student_resident_programarea_id);
				$ExportDoc->ExportCaption($view_sponsored_student_grant_package->student_applicant_student_applicant_id);
				$ExportDoc->ExportCaption($view_sponsored_student_grant_package->grant_package_grant_package_id);
				$ExportDoc->ExportCaption($view_sponsored_student_grant_package->annual_amount);
				$ExportDoc->ExportCaption($view_sponsored_student_grant_package->status);
				$ExportDoc->ExportCaption($view_sponsored_student_grant_package->start_date);
				$ExportDoc->ExportCaption($view_sponsored_student_grant_package->end_date);
				$ExportDoc->ExportCaption($view_sponsored_student_grant_package->scholarship_type_scholarship_type);
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
				$view_sponsored_student_grant_package->CssClass = "";
				$view_sponsored_student_grant_package->CssStyle = "";
				$view_sponsored_student_grant_package->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($view_sponsored_student_grant_package->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('student_firstname', $view_sponsored_student_grant_package->student_firstname->ExportValue($view_sponsored_student_grant_package->Export, $view_sponsored_student_grant_package->ExportOriginalValue));
					$XmlDoc->AddField('student_lastname', $view_sponsored_student_grant_package->student_lastname->ExportValue($view_sponsored_student_grant_package->Export, $view_sponsored_student_grant_package->ExportOriginalValue));
					$XmlDoc->AddField('student_resident_programarea_id', $view_sponsored_student_grant_package->student_resident_programarea_id->ExportValue($view_sponsored_student_grant_package->Export, $view_sponsored_student_grant_package->ExportOriginalValue));
					$XmlDoc->AddField('student_applicant_student_applicant_id', $view_sponsored_student_grant_package->student_applicant_student_applicant_id->ExportValue($view_sponsored_student_grant_package->Export, $view_sponsored_student_grant_package->ExportOriginalValue));
					$XmlDoc->AddField('grant_package_grant_package_id', $view_sponsored_student_grant_package->grant_package_grant_package_id->ExportValue($view_sponsored_student_grant_package->Export, $view_sponsored_student_grant_package->ExportOriginalValue));
					$XmlDoc->AddField('annual_amount', $view_sponsored_student_grant_package->annual_amount->ExportValue($view_sponsored_student_grant_package->Export, $view_sponsored_student_grant_package->ExportOriginalValue));
					$XmlDoc->AddField('status', $view_sponsored_student_grant_package->status->ExportValue($view_sponsored_student_grant_package->Export, $view_sponsored_student_grant_package->ExportOriginalValue));
					$XmlDoc->AddField('start_date', $view_sponsored_student_grant_package->start_date->ExportValue($view_sponsored_student_grant_package->Export, $view_sponsored_student_grant_package->ExportOriginalValue));
					$XmlDoc->AddField('end_date', $view_sponsored_student_grant_package->end_date->ExportValue($view_sponsored_student_grant_package->Export, $view_sponsored_student_grant_package->ExportOriginalValue));
					$XmlDoc->AddField('scholarship_type_scholarship_type', $view_sponsored_student_grant_package->scholarship_type_scholarship_type->ExportValue($view_sponsored_student_grant_package->Export, $view_sponsored_student_grant_package->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($view_sponsored_student_grant_package->student_firstname);
					$ExportDoc->ExportField($view_sponsored_student_grant_package->student_lastname);
					$ExportDoc->ExportField($view_sponsored_student_grant_package->student_resident_programarea_id);
					$ExportDoc->ExportField($view_sponsored_student_grant_package->student_applicant_student_applicant_id);
					$ExportDoc->ExportField($view_sponsored_student_grant_package->grant_package_grant_package_id);
					$ExportDoc->ExportField($view_sponsored_student_grant_package->annual_amount);
					$ExportDoc->ExportField($view_sponsored_student_grant_package->status);
					$ExportDoc->ExportField($view_sponsored_student_grant_package->start_date);
					$ExportDoc->ExportField($view_sponsored_student_grant_package->end_date);
					$ExportDoc->ExportField($view_sponsored_student_grant_package->scholarship_type_scholarship_type);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($view_sponsored_student_grant_package->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($view_sponsored_student_grant_package->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($view_sponsored_student_grant_package->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($view_sponsored_student_grant_package->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($view_sponsored_student_grant_package->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $view_sponsored_student_grant_package;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "grant_package") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $view_sponsored_student_grant_package->SqlMasterFilter_grant_package();
				$this->sDbDetailFilter = $view_sponsored_student_grant_package->SqlDetailFilter_grant_package();
				if (@$_GET["grant_package_id"] <> "") {
					$GLOBALS["grant_package"]->grant_package_id->setQueryStringValue($_GET["grant_package_id"]);
					$view_sponsored_student_grant_package->grant_package_grant_package_id->setQueryStringValue($GLOBALS["grant_package"]->grant_package_id->QueryStringValue);
					$view_sponsored_student_grant_package->grant_package_grant_package_id->setSessionValue($view_sponsored_student_grant_package->grant_package_grant_package_id->QueryStringValue);
					if (!is_numeric($GLOBALS["grant_package"]->grant_package_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@grant_package_id@", ew_AdjustSql($GLOBALS["grant_package"]->grant_package_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@grant_package_grant_package_id@", ew_AdjustSql($GLOBALS["grant_package"]->grant_package_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$view_sponsored_student_grant_package->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$view_sponsored_student_grant_package->setStartRecordNumber($this->lStartRec);
			$view_sponsored_student_grant_package->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$view_sponsored_student_grant_package->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "grant_package") {
				if ($view_sponsored_student_grant_package->grant_package_grant_package_id->QueryStringValue == "") $view_sponsored_student_grant_package->grant_package_grant_package_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $view_sponsored_student_grant_package->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $view_sponsored_student_grant_package->getDetailFilter(); // Restore detail filter
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
