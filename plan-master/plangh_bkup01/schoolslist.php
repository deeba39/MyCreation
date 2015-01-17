<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "schoolsinfo.php" ?>
<?php include "communityinfo.php" ?>
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
$schools_list = new cschools_list();
$Page =& $schools_list;

// Page init
$schools_list->Page_Init();

// Page main
$schools_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($schools->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var schools_list = new ew_Page("schools_list");

// page properties
schools_list.PageID = "list"; // page ID
schools_list.FormID = "fschoolslist"; // form ID
var EW_PAGE_ID = schools_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
schools_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
schools_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
schools_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($schools->Export == "") { ?>
<?php
$gsMasterReturnUrl = "communitylist.php";
if ($schools_list->sDbMasterFilter <> "" && $schools->getCurrentMasterTable() == "community") {
	if ($schools_list->bMasterRecordExists) {
		if ($schools->getCurrentMasterTable() == $schools->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "communitymaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$schools_list->lTotalRecs = $schools->SelectRecordCount();
	} else {
		if ($rs = $schools_list->LoadRecordset())
			$schools_list->lTotalRecs = $rs->RecordCount();
	}
	$schools_list->lStartRec = 1;
	if ($schools_list->lDisplayRecs <= 0 || ($schools->Export <> "" && $schools->ExportAll)) // Display all records
		$schools_list->lDisplayRecs = $schools_list->lTotalRecs;
	if (!($schools->Export <> "" && $schools->ExportAll))
		$schools_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $schools_list->LoadRecordset($schools_list->lStartRec-1, $schools_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $schools->TableCaption() ?>
<?php if ($schools->Export == "" && $schools->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $schools_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $schools_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $schools_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($schools->Export == "" && $schools->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(schools_list);" style="text-decoration: none;"><img id="schools_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="schools_list_SearchPanel">
<form name="fschoolslistsrch" id="fschoolslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="schools">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $schools_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="schoolssrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
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
$schools_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fschoolslist" id="fschoolslist" class="ewForm" action="" method="post">
<div id="gmp_schools" class="ewGridMiddlePanel">
<?php if ($schools_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $schools->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$schools_list->RenderListOptions();

// Render list options (header, left)
$schools_list->ListOptions->Render("header", "left");
?>
<?php if ($schools->school_id->Visible) { // school_id ?>
	<?php if ($schools->SortUrl($schools->school_id) == "") { ?>
		<td><?php echo $schools->school_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $schools->SortUrl($schools->school_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $schools->school_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($schools->school_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($schools->school_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($schools->school_name->Visible) { // school_name ?>
	<?php if ($schools->SortUrl($schools->school_name) == "") { ?>
		<td><?php echo $schools->school_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $schools->SortUrl($schools->school_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $schools->school_name->FldCaption() ?></td><td style="width: 10px;"><?php if ($schools->school_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($schools->school_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($schools->address->Visible) { // address ?>
	<?php if ($schools->SortUrl($schools->address) == "") { ?>
		<td><?php echo $schools->address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $schools->SortUrl($schools->address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $schools->address->FldCaption() ?></td><td style="width: 10px;"><?php if ($schools->address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($schools->address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($schools->towncity->Visible) { // towncity ?>
	<?php if ($schools->SortUrl($schools->towncity) == "") { ?>
		<td><?php echo $schools->towncity->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $schools->SortUrl($schools->towncity) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $schools->towncity->FldCaption() ?></td><td style="width: 10px;"><?php if ($schools->towncity->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($schools->towncity->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($schools->community_community_id->Visible) { // community_community_id ?>
	<?php if ($schools->SortUrl($schools->community_community_id) == "") { ?>
		<td><?php echo $schools->community_community_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $schools->SortUrl($schools->community_community_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $schools->community_community_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($schools->community_community_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($schools->community_community_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($schools->school_type->Visible) { // school_type ?>
	<?php if ($schools->SortUrl($schools->school_type) == "") { ?>
		<td><?php echo $schools->school_type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $schools->SortUrl($schools->school_type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $schools->school_type->FldCaption() ?></td><td style="width: 10px;"><?php if ($schools->school_type->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($schools->school_type->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($schools->contact_person_name->Visible) { // contact_person_name ?>
	<?php if ($schools->SortUrl($schools->contact_person_name) == "") { ?>
		<td><?php echo $schools->contact_person_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $schools->SortUrl($schools->contact_person_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $schools->contact_person_name->FldCaption() ?></td><td style="width: 10px;"><?php if ($schools->contact_person_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($schools->contact_person_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($schools->telephone->Visible) { // telephone ?>
	<?php if ($schools->SortUrl($schools->telephone) == "") { ?>
		<td><?php echo $schools->telephone->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $schools->SortUrl($schools->telephone) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $schools->telephone->FldCaption() ?></td><td style="width: 10px;"><?php if ($schools->telephone->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($schools->telephone->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($schools->bankname->Visible) { // bankname ?>
	<?php if ($schools->SortUrl($schools->bankname) == "") { ?>
		<td><?php echo $schools->bankname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $schools->SortUrl($schools->bankname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $schools->bankname->FldCaption() ?></td><td style="width: 10px;"><?php if ($schools->bankname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($schools->bankname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($schools->account_no->Visible) { // account_no ?>
	<?php if ($schools->SortUrl($schools->account_no) == "") { ?>
		<td><?php echo $schools->account_no->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $schools->SortUrl($schools->account_no) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $schools->account_no->FldCaption() ?></td><td style="width: 10px;"><?php if ($schools->account_no->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($schools->account_no->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$schools_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($schools->ExportAll && $schools->Export <> "") {
	$schools_list->lStopRec = $schools_list->lTotalRecs;
} else {
	$schools_list->lStopRec = $schools_list->lStartRec + $schools_list->lDisplayRecs - 1; // Set the last record to display
}
$schools_list->lRecCount = $schools_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $schools_list->lStartRec > 1)
		$rs->Move($schools_list->lStartRec - 1);
}

// Initialize aggregate
$schools->RowType = EW_ROWTYPE_AGGREGATEINIT;
$schools_list->RenderRow();
$schools_list->lRowCnt = 0;
while (($schools->CurrentAction == "gridadd" || !$rs->EOF) &&
	$schools_list->lRecCount < $schools_list->lStopRec) {
	$schools_list->lRecCount++;
	if (intval($schools_list->lRecCount) >= intval($schools_list->lStartRec)) {
		$schools_list->lRowCnt++;

	// Init row class and style
	$schools->CssClass = "";
	$schools->CssStyle = "";
	$schools->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($schools->CurrentAction == "gridadd") {
		$schools_list->LoadDefaultValues(); // Load default values
	} else {
		$schools_list->LoadRowValues($rs); // Load row values
	}
	$schools->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$schools_list->RenderRow();

	// Render list options
	$schools_list->RenderListOptions();
?>
	<tr<?php echo $schools->RowAttributes() ?>>
<?php

// Render list options (body, left)
$schools_list->ListOptions->Render("body", "left");
?>
	<?php if ($schools->school_id->Visible) { // school_id ?>
		<td<?php echo $schools->school_id->CellAttributes() ?>>
<div<?php echo $schools->school_id->ViewAttributes() ?>><?php echo $schools->school_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($schools->school_name->Visible) { // school_name ?>
		<td<?php echo $schools->school_name->CellAttributes() ?>>
<div<?php echo $schools->school_name->ViewAttributes() ?>><?php echo $schools->school_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($schools->address->Visible) { // address ?>
		<td<?php echo $schools->address->CellAttributes() ?>>
<div<?php echo $schools->address->ViewAttributes() ?>><?php echo $schools->address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($schools->towncity->Visible) { // towncity ?>
		<td<?php echo $schools->towncity->CellAttributes() ?>>
<div<?php echo $schools->towncity->ViewAttributes() ?>><?php echo $schools->towncity->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($schools->community_community_id->Visible) { // community_community_id ?>
		<td<?php echo $schools->community_community_id->CellAttributes() ?>>
<div<?php echo $schools->community_community_id->ViewAttributes() ?>><?php echo $schools->community_community_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($schools->school_type->Visible) { // school_type ?>
		<td<?php echo $schools->school_type->CellAttributes() ?>>
<div<?php echo $schools->school_type->ViewAttributes() ?>><?php echo $schools->school_type->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($schools->contact_person_name->Visible) { // contact_person_name ?>
		<td<?php echo $schools->contact_person_name->CellAttributes() ?>>
<div<?php echo $schools->contact_person_name->ViewAttributes() ?>><?php echo $schools->contact_person_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($schools->telephone->Visible) { // telephone ?>
		<td<?php echo $schools->telephone->CellAttributes() ?>>
<div<?php echo $schools->telephone->ViewAttributes() ?>><?php echo $schools->telephone->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($schools->bankname->Visible) { // bankname ?>
		<td<?php echo $schools->bankname->CellAttributes() ?>>
<div<?php echo $schools->bankname->ViewAttributes() ?>><?php echo $schools->bankname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($schools->account_no->Visible) { // account_no ?>
		<td<?php echo $schools->account_no->CellAttributes() ?>>
<div<?php echo $schools->account_no->ViewAttributes() ?>><?php echo $schools->account_no->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$schools_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($schools->CurrentAction <> "gridadd")
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
<?php if ($schools->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($schools->CurrentAction <> "gridadd" && $schools->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($schools_list->Pager)) $schools_list->Pager = new cPrevNextPager($schools_list->lStartRec, $schools_list->lDisplayRecs, $schools_list->lTotalRecs) ?>
<?php if ($schools_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($schools_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $schools_list->PageUrl() ?>start=<?php echo $schools_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($schools_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $schools_list->PageUrl() ?>start=<?php echo $schools_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $schools_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($schools_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $schools_list->PageUrl() ?>start=<?php echo $schools_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($schools_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $schools_list->PageUrl() ?>start=<?php echo $schools_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $schools_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $schools_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $schools_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $schools_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($schools_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($schools_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $schools_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($schools->Export == "" && $schools->CurrentAction == "") { ?>
<?php } ?>
<?php if ($schools->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$schools_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cschools_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'schools';

	// Page object name
	var $PageObjName = 'schools_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $schools;
		if ($schools->UseTokenInUrl) $PageUrl .= "t=" . $schools->TableVar . "&"; // Add page token
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
		global $objForm, $schools;
		if ($schools->UseTokenInUrl) {
			if ($objForm)
				return ($schools->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($schools->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cschools_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (schools)
		$GLOBALS["schools"] = new cschools();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["schools"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "schoolsdelete.php";
		$this->MultiUpdateUrl = "schoolsupdate.php";

		// Table object (community)
		$GLOBALS['community'] = new ccommunity();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'schools', TRUE);

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
		global $schools;

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
			$schools->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$schools->Export = $_POST["exporttype"];
		} else {
			$schools->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $schools->Export; // Get export parameter, used in header
		$gsExportFile = $schools->TableVar; // Get export file, used in header
		if ($schools->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($schools->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $schools;

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

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$schools->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($schools->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $schools->getRecordsPerPage(); // Restore from Session
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
		$schools->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$schools->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$schools->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $schools->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $schools->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $schools->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($schools->getMasterFilter() <> "" && $schools->getCurrentMasterTable() == "community") {
			global $community;
			$rsmaster = $community->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$schools->setMasterFilter(""); // Clear master filter
				$schools->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($schools->getReturnUrl()); // Return to caller
			} else {
				$community->LoadListRowValues($rsmaster);
				$community->RowType = EW_ROWTYPE_MASTER; // Master row
				$community->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$schools->setSessionWhere($sFilter);
		$schools->CurrentFilter = "";

		// Export data only
		if (in_array($schools->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($schools->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $schools;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $schools->school_id, FALSE); // school_id
		$this->BuildSearchSql($sWhere, $schools->school_name, FALSE); // school_name
		$this->BuildSearchSql($sWhere, $schools->address, FALSE); // address
		$this->BuildSearchSql($sWhere, $schools->towncity, FALSE); // towncity
		$this->BuildSearchSql($sWhere, $schools->community_community_id, FALSE); // community_community_id
		$this->BuildSearchSql($sWhere, $schools->school_type, FALSE); // school_type
		$this->BuildSearchSql($sWhere, $schools->contact_person_name, FALSE); // contact_person_name
		$this->BuildSearchSql($sWhere, $schools->telephone, FALSE); // telephone
		$this->BuildSearchSql($sWhere, $schools->bankname, FALSE); // bankname
		$this->BuildSearchSql($sWhere, $schools->account_no, FALSE); // account_no

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($schools->school_id); // school_id
			$this->SetSearchParm($schools->school_name); // school_name
			$this->SetSearchParm($schools->address); // address
			$this->SetSearchParm($schools->towncity); // towncity
			$this->SetSearchParm($schools->community_community_id); // community_community_id
			$this->SetSearchParm($schools->school_type); // school_type
			$this->SetSearchParm($schools->contact_person_name); // contact_person_name
			$this->SetSearchParm($schools->telephone); // telephone
			$this->SetSearchParm($schools->bankname); // bankname
			$this->SetSearchParm($schools->account_no); // account_no
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
		global $schools;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$schools->setAdvancedSearch("x_$FldParm", $FldVal);
		$schools->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$schools->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$schools->setAdvancedSearch("y_$FldParm", $FldVal2);
		$schools->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $schools;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $schools->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $schools->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $schools->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $schools->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $schools->GetAdvancedSearch("w_$FldParm");
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
		global $schools;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$schools->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $schools;
		$schools->setAdvancedSearch("x_school_id", "");
		$schools->setAdvancedSearch("x_school_name", "");
		$schools->setAdvancedSearch("x_address", "");
		$schools->setAdvancedSearch("x_towncity", "");
		$schools->setAdvancedSearch("x_community_community_id", "");
		$schools->setAdvancedSearch("x_school_type", "");
		$schools->setAdvancedSearch("x_contact_person_name", "");
		$schools->setAdvancedSearch("x_telephone", "");
		$schools->setAdvancedSearch("x_bankname", "");
		$schools->setAdvancedSearch("x_account_no", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $schools;
		$bRestore = TRUE;
		if (@$_GET["x_school_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_school_name"] <> "") $bRestore = FALSE;
		if (@$_GET["x_address"] <> "") $bRestore = FALSE;
		if (@$_GET["x_towncity"] <> "") $bRestore = FALSE;
		if (@$_GET["x_community_community_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_school_type"] <> "") $bRestore = FALSE;
		if (@$_GET["x_contact_person_name"] <> "") $bRestore = FALSE;
		if (@$_GET["x_telephone"] <> "") $bRestore = FALSE;
		if (@$_GET["x_bankname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_account_no"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($schools->school_id);
			$this->GetSearchParm($schools->school_name);
			$this->GetSearchParm($schools->address);
			$this->GetSearchParm($schools->towncity);
			$this->GetSearchParm($schools->community_community_id);
			$this->GetSearchParm($schools->school_type);
			$this->GetSearchParm($schools->contact_person_name);
			$this->GetSearchParm($schools->telephone);
			$this->GetSearchParm($schools->bankname);
			$this->GetSearchParm($schools->account_no);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $schools;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$schools->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$schools->CurrentOrderType = @$_GET["ordertype"];
			$schools->UpdateSort($schools->school_id); // school_id
			$schools->UpdateSort($schools->school_name); // school_name
			$schools->UpdateSort($schools->address); // address
			$schools->UpdateSort($schools->towncity); // towncity
			$schools->UpdateSort($schools->community_community_id); // community_community_id
			$schools->UpdateSort($schools->school_type); // school_type
			$schools->UpdateSort($schools->contact_person_name); // contact_person_name
			$schools->UpdateSort($schools->telephone); // telephone
			$schools->UpdateSort($schools->bankname); // bankname
			$schools->UpdateSort($schools->account_no); // account_no
			$schools->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $schools;
		$sOrderBy = $schools->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($schools->SqlOrderBy() <> "") {
				$sOrderBy = $schools->SqlOrderBy();
				$schools->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $schools;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$schools->getCurrentMasterTable = ""; // Clear master table
				$schools->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$schools->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$schools->community_community_id->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$schools->setSessionOrderBy($sOrderBy);
				$schools->school_id->setSort("");
				$schools->school_name->setSort("");
				$schools->address->setSort("");
				$schools->towncity->setSort("");
				$schools->community_community_id->setSort("");
				$schools->school_type->setSort("");
				$schools->contact_person_name->setSort("");
				$schools->telephone->setSort("");
				$schools->bankname->setSort("");
				$schools->account_no->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$schools->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $schools;

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

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;

		// "detail_view_sponsored_student_school"
		$this->ListOptions->Add("detail_view_sponsored_student_school");
		$item =& $this->ListOptions->Items["detail_view_sponsored_student_school"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('view_sponsored_student_school');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($schools->Export <> "" ||
			$schools->CurrentAction == "gridadd" ||
			$schools->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $schools;
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

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . "<img src=\"images/delete.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DeleteLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";

		// "detail_view_sponsored_student_school"
		$oListOpt =& $this->ListOptions->Items["detail_view_sponsored_student_school"];
		if ($Security->AllowList('view_sponsored_student_school')) {
			$oListOpt->Body = "<img src=\"images/detail.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("DetailLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . $Language->TablePhrase("view_sponsored_student_school", "TblCaption");
			$oListOpt->Body = "<a href=\"view_sponsored_student_schoollist.php?" . EW_TABLE_SHOW_MASTER . "=schools&school_id=" . urlencode(strval($schools->school_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $schools;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $schools;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$schools->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$schools->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $schools->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$schools->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$schools->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$schools->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $schools;

		// Load search values
		// school_id

		$schools->school_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_school_id"]);
		$schools->school_id->AdvancedSearch->SearchOperator = @$_GET["z_school_id"];

		// school_name
		$schools->school_name->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_school_name"]);
		$schools->school_name->AdvancedSearch->SearchOperator = @$_GET["z_school_name"];

		// address
		$schools->address->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_address"]);
		$schools->address->AdvancedSearch->SearchOperator = @$_GET["z_address"];

		// towncity
		$schools->towncity->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_towncity"]);
		$schools->towncity->AdvancedSearch->SearchOperator = @$_GET["z_towncity"];

		// community_community_id
		$schools->community_community_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_community_community_id"]);
		$schools->community_community_id->AdvancedSearch->SearchOperator = @$_GET["z_community_community_id"];

		// school_type
		$schools->school_type->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_school_type"]);
		$schools->school_type->AdvancedSearch->SearchOperator = @$_GET["z_school_type"];

		// contact_person_name
		$schools->contact_person_name->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_contact_person_name"]);
		$schools->contact_person_name->AdvancedSearch->SearchOperator = @$_GET["z_contact_person_name"];

		// telephone
		$schools->telephone->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_telephone"]);
		$schools->telephone->AdvancedSearch->SearchOperator = @$_GET["z_telephone"];

		// bankname
		$schools->bankname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_bankname"]);
		$schools->bankname->AdvancedSearch->SearchOperator = @$_GET["z_bankname"];

		// account_no
		$schools->account_no->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_account_no"]);
		$schools->account_no->AdvancedSearch->SearchOperator = @$_GET["z_account_no"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $schools;

		// Call Recordset Selecting event
		$schools->Recordset_Selecting($schools->CurrentFilter);

		// Load List page SQL
		$sSql = $schools->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$schools->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $schools;
		$sFilter = $schools->KeyFilter();

		// Call Row Selecting event
		$schools->Row_Selecting($sFilter);

		// Load SQL based on filter
		$schools->CurrentFilter = $sFilter;
		$sSql = $schools->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$schools->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $schools;
		$schools->school_id->setDbValue($rs->fields('school_id'));
		$schools->school_name->setDbValue($rs->fields('school_name'));
		$schools->address->setDbValue($rs->fields('address'));
		$schools->towncity->setDbValue($rs->fields('towncity'));
		$schools->community_community_id->setDbValue($rs->fields('community_community_id'));
		$schools->school_type->setDbValue($rs->fields('school_type'));
		$schools->contact_person_name->setDbValue($rs->fields('contact_person_name'));
		$schools->telephone->setDbValue($rs->fields('telephone'));
		$schools->bankname->setDbValue($rs->fields('bankname'));
		$schools->account_no->setDbValue($rs->fields('account_no'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $schools;

		// Initialize URLs
		$this->ViewUrl = $schools->ViewUrl();
		$this->EditUrl = $schools->EditUrl();
		$this->InlineEditUrl = $schools->InlineEditUrl();
		$this->CopyUrl = $schools->CopyUrl();
		$this->InlineCopyUrl = $schools->InlineCopyUrl();
		$this->DeleteUrl = $schools->DeleteUrl();

		// Call Row_Rendering event
		$schools->Row_Rendering();

		// Common render codes for all row types
		// school_id

		$schools->school_id->CellCssStyle = ""; $schools->school_id->CellCssClass = "";
		$schools->school_id->CellAttrs = array(); $schools->school_id->ViewAttrs = array(); $schools->school_id->EditAttrs = array();

		// school_name
		$schools->school_name->CellCssStyle = ""; $schools->school_name->CellCssClass = "";
		$schools->school_name->CellAttrs = array(); $schools->school_name->ViewAttrs = array(); $schools->school_name->EditAttrs = array();

		// address
		$schools->address->CellCssStyle = ""; $schools->address->CellCssClass = "";
		$schools->address->CellAttrs = array(); $schools->address->ViewAttrs = array(); $schools->address->EditAttrs = array();

		// towncity
		$schools->towncity->CellCssStyle = ""; $schools->towncity->CellCssClass = "";
		$schools->towncity->CellAttrs = array(); $schools->towncity->ViewAttrs = array(); $schools->towncity->EditAttrs = array();

		// community_community_id
		$schools->community_community_id->CellCssStyle = ""; $schools->community_community_id->CellCssClass = "";
		$schools->community_community_id->CellAttrs = array(); $schools->community_community_id->ViewAttrs = array(); $schools->community_community_id->EditAttrs = array();

		// school_type
		$schools->school_type->CellCssStyle = ""; $schools->school_type->CellCssClass = "";
		$schools->school_type->CellAttrs = array(); $schools->school_type->ViewAttrs = array(); $schools->school_type->EditAttrs = array();

		// contact_person_name
		$schools->contact_person_name->CellCssStyle = ""; $schools->contact_person_name->CellCssClass = "";
		$schools->contact_person_name->CellAttrs = array(); $schools->contact_person_name->ViewAttrs = array(); $schools->contact_person_name->EditAttrs = array();

		// telephone
		$schools->telephone->CellCssStyle = ""; $schools->telephone->CellCssClass = "";
		$schools->telephone->CellAttrs = array(); $schools->telephone->ViewAttrs = array(); $schools->telephone->EditAttrs = array();

		// bankname
		$schools->bankname->CellCssStyle = ""; $schools->bankname->CellCssClass = "";
		$schools->bankname->CellAttrs = array(); $schools->bankname->ViewAttrs = array(); $schools->bankname->EditAttrs = array();

		// account_no
		$schools->account_no->CellCssStyle = ""; $schools->account_no->CellCssClass = "";
		$schools->account_no->CellAttrs = array(); $schools->account_no->ViewAttrs = array(); $schools->account_no->EditAttrs = array();
		if ($schools->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_id
			$schools->school_id->ViewValue = $schools->school_id->CurrentValue;
			$schools->school_id->CssStyle = "";
			$schools->school_id->CssClass = "";
			$schools->school_id->ViewCustomAttributes = "";

			// school_name
			$schools->school_name->ViewValue = $schools->school_name->CurrentValue;
			$schools->school_name->CssStyle = "";
			$schools->school_name->CssClass = "";
			$schools->school_name->ViewCustomAttributes = "";

			// address
			$schools->address->ViewValue = $schools->address->CurrentValue;
			$schools->address->CssStyle = "";
			$schools->address->CssClass = "";
			$schools->address->ViewCustomAttributes = "";

			// towncity
			$schools->towncity->ViewValue = $schools->towncity->CurrentValue;
			$schools->towncity->CssStyle = "";
			$schools->towncity->CssClass = "";
			$schools->towncity->ViewCustomAttributes = "";

			// community_community_id
			if (strval($schools->community_community_id->CurrentValue) <> "") {
				$sFilterWrk = "`community_id` = " . ew_AdjustSql($schools->community_community_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `community` FROM `community`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `community` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$schools->community_community_id->ViewValue = $rswrk->fields('community');
					$rswrk->Close();
				} else {
					$schools->community_community_id->ViewValue = $schools->community_community_id->CurrentValue;
				}
			} else {
				$schools->community_community_id->ViewValue = NULL;
			}
			$schools->community_community_id->CssStyle = "";
			$schools->community_community_id->CssClass = "";
			$schools->community_community_id->ViewCustomAttributes = "";

			// school_type
			if (strval($schools->school_type->CurrentValue) <> "") {
				$sFilterWrk = "`school_type` = '" . ew_AdjustSql($schools->school_type->CurrentValue) . "'";
			$sSqlWrk = "SELECT `school_type` FROM `school_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$schools->school_type->ViewValue = $rswrk->fields('school_type');
					$rswrk->Close();
				} else {
					$schools->school_type->ViewValue = $schools->school_type->CurrentValue;
				}
			} else {
				$schools->school_type->ViewValue = NULL;
			}
			$schools->school_type->CssStyle = "";
			$schools->school_type->CssClass = "";
			$schools->school_type->ViewCustomAttributes = "";

			// contact_person_name
			$schools->contact_person_name->ViewValue = $schools->contact_person_name->CurrentValue;
			$schools->contact_person_name->CssStyle = "";
			$schools->contact_person_name->CssClass = "";
			$schools->contact_person_name->ViewCustomAttributes = "";

			// telephone
			$schools->telephone->ViewValue = $schools->telephone->CurrentValue;
			$schools->telephone->CssStyle = "";
			$schools->telephone->CssClass = "";
			$schools->telephone->ViewCustomAttributes = "";

			// bankname
			$schools->bankname->ViewValue = $schools->bankname->CurrentValue;
			$schools->bankname->CssStyle = "";
			$schools->bankname->CssClass = "";
			$schools->bankname->ViewCustomAttributes = "";

			// account_no
			$schools->account_no->ViewValue = $schools->account_no->CurrentValue;
			$schools->account_no->CssStyle = "";
			$schools->account_no->CssClass = "";
			$schools->account_no->ViewCustomAttributes = "";

			// school_id
			$schools->school_id->HrefValue = "";
			$schools->school_id->TooltipValue = "";

			// school_name
			$schools->school_name->HrefValue = "";
			$schools->school_name->TooltipValue = "";

			// address
			$schools->address->HrefValue = "";
			$schools->address->TooltipValue = "";

			// towncity
			$schools->towncity->HrefValue = "";
			$schools->towncity->TooltipValue = "";

			// community_community_id
			$schools->community_community_id->HrefValue = "";
			$schools->community_community_id->TooltipValue = "";

			// school_type
			$schools->school_type->HrefValue = "";
			$schools->school_type->TooltipValue = "";

			// contact_person_name
			$schools->contact_person_name->HrefValue = "";
			$schools->contact_person_name->TooltipValue = "";

			// telephone
			$schools->telephone->HrefValue = "";
			$schools->telephone->TooltipValue = "";

			// bankname
			$schools->bankname->HrefValue = "";
			$schools->bankname->TooltipValue = "";

			// account_no
			$schools->account_no->HrefValue = "";
			$schools->account_no->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($schools->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$schools->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $schools;

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
		global $schools;
		$schools->school_id->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_school_id");
		$schools->school_name->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_school_name");
		$schools->address->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_address");
		$schools->towncity->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_towncity");
		$schools->community_community_id->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_community_community_id");
		$schools->school_type->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_school_type");
		$schools->contact_person_name->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_contact_person_name");
		$schools->telephone->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_telephone");
		$schools->bankname->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_bankname");
		$schools->account_no->AdvancedSearch->SearchValue = $schools->getAdvancedSearch("x_account_no");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $schools;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $schools->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($schools->ExportAll) {
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
		if ($schools->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($schools, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($schools->school_id);
				$ExportDoc->ExportCaption($schools->school_name);
				$ExportDoc->ExportCaption($schools->address);
				$ExportDoc->ExportCaption($schools->towncity);
				$ExportDoc->ExportCaption($schools->community_community_id);
				$ExportDoc->ExportCaption($schools->school_type);
				$ExportDoc->ExportCaption($schools->contact_person_name);
				$ExportDoc->ExportCaption($schools->telephone);
				$ExportDoc->ExportCaption($schools->bankname);
				$ExportDoc->ExportCaption($schools->account_no);
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
				$schools->CssClass = "";
				$schools->CssStyle = "";
				$schools->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($schools->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('school_id', $schools->school_id->ExportValue($schools->Export, $schools->ExportOriginalValue));
					$XmlDoc->AddField('school_name', $schools->school_name->ExportValue($schools->Export, $schools->ExportOriginalValue));
					$XmlDoc->AddField('address', $schools->address->ExportValue($schools->Export, $schools->ExportOriginalValue));
					$XmlDoc->AddField('towncity', $schools->towncity->ExportValue($schools->Export, $schools->ExportOriginalValue));
					$XmlDoc->AddField('community_community_id', $schools->community_community_id->ExportValue($schools->Export, $schools->ExportOriginalValue));
					$XmlDoc->AddField('school_type', $schools->school_type->ExportValue($schools->Export, $schools->ExportOriginalValue));
					$XmlDoc->AddField('contact_person_name', $schools->contact_person_name->ExportValue($schools->Export, $schools->ExportOriginalValue));
					$XmlDoc->AddField('telephone', $schools->telephone->ExportValue($schools->Export, $schools->ExportOriginalValue));
					$XmlDoc->AddField('bankname', $schools->bankname->ExportValue($schools->Export, $schools->ExportOriginalValue));
					$XmlDoc->AddField('account_no', $schools->account_no->ExportValue($schools->Export, $schools->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($schools->school_id);
					$ExportDoc->ExportField($schools->school_name);
					$ExportDoc->ExportField($schools->address);
					$ExportDoc->ExportField($schools->towncity);
					$ExportDoc->ExportField($schools->community_community_id);
					$ExportDoc->ExportField($schools->school_type);
					$ExportDoc->ExportField($schools->contact_person_name);
					$ExportDoc->ExportField($schools->telephone);
					$ExportDoc->ExportField($schools->bankname);
					$ExportDoc->ExportField($schools->account_no);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($schools->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($schools->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($schools->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($schools->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($schools->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $schools;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "community") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $schools->SqlMasterFilter_community();
				$this->sDbDetailFilter = $schools->SqlDetailFilter_community();
				if (@$_GET["community_id"] <> "") {
					$GLOBALS["community"]->community_id->setQueryStringValue($_GET["community_id"]);
					$schools->community_community_id->setQueryStringValue($GLOBALS["community"]->community_id->QueryStringValue);
					$schools->community_community_id->setSessionValue($schools->community_community_id->QueryStringValue);
					if (!is_numeric($GLOBALS["community"]->community_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@community_id@", ew_AdjustSql($GLOBALS["community"]->community_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@community_community_id@", ew_AdjustSql($GLOBALS["community"]->community_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$schools->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$schools->setStartRecordNumber($this->lStartRec);
			$schools->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$schools->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "community") {
				if ($schools->community_community_id->QueryStringValue == "") $schools->community_community_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $schools->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $schools->getDetailFilter(); // Restore detail filter
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
