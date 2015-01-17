<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "view_school_lists_paymentsinfo.php" ?>
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
$view_school_lists_payments_list = new cview_school_lists_payments_list();
$Page =& $view_school_lists_payments_list;

// Page init
$view_school_lists_payments_list->Page_Init();

// Page main
$view_school_lists_payments_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($view_school_lists_payments->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var view_school_lists_payments_list = new ew_Page("view_school_lists_payments_list");

// page properties
view_school_lists_payments_list.PageID = "list"; // page ID
view_school_lists_payments_list.FormID = "fview_school_lists_paymentslist"; // form ID
var EW_PAGE_ID = view_school_lists_payments_list.PageID; // for backward compatibility

// extend page with ValidateForm function
view_school_lists_payments_list.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with validate function for search
view_school_lists_payments_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($view_school_lists_payments->year->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
view_school_lists_payments_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
view_school_lists_payments_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
view_school_lists_payments_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js");(id).innerHTML = 'Could not retrieve data';
                }
            } 
            else 
            {
                document.getElementById(id).innerHTML = '<img src="ajax-loader.gif"> Loading...';

            }
        }
        req.send('');
    }
    else return true;
    return false;
}

var req;

function getXHR()
{
    if(window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        return true;
    }
    else try {
        req = new ActiveXObject('Msxml2.XMLHTTP');
        return true;
    } catch(e) {
        try {
            req = new ActiveXObject("Microsoft.XMLHTTP");
            return true;
        } catch(e) {
            req = false;
            return false;
        }
    }
}

function updateElm(url, id)
{
    if(getXHR())
    {
        req.open('POST', url, true);
        req.onreadystatechange = function()
        {
            if(req.readyState == 4)
             {
                if(req.status==200)
                {
                    document.getElementById(id).innerHTML = req.responseText;
                }
                else
                {
                    document.getElementById(id).innerHTML = 'Could not retrieve data';
                }
            } 
            else 
            {
                document.getElementById(id).innerHTML = '<img src="ajax-loader.gif"> Loading...';

            }
        }
        req.send('');
    }
    else return true;
    return false;
}





//-->

</script>
<?php } ?>
<?php if ($view_school_lists_payments->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$view_school_lists_payments_list->lTotalRecs = $view_school_lists_payments->SelectRecordCount();
	} else {
		if ($rs = $view_school_lists_payments_list->LoadRecordset())
			$view_school_lists_payments_list->lTotalRecs = $rs->RecordCount();
	}
	$view_school_lists_payments_list->lStartRec = 1;
	if ($view_school_lists_payments_list->lDisplayRecs <= 0 || ($view_school_lists_payments->Export <> "" && $view_school_lists_payments->ExportAll)) // Display all records
		$view_school_lists_payments_list->lDisplayRecs = $view_school_lists_payments_list->lTotalRecs;
	if (!($view_school_lists_payments->Export <> "" && $view_school_lists_payments->ExportAll))
		$view_school_lists_payments_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $view_school_lists_payments_list->LoadRecordset($view_school_lists_payments_list->lStartRec-1, $view_school_lists_payments_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $view_school_lists_payments->TableCaption() ?>
<?php if ($view_school_lists_payments->Export == "" && $view_school_lists_payments->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $view_school_lists_payments_list->ExportPrintUrl ?>"><img src="images/print.gif" alt="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" title="<?php echo ew_HtmlEncode($Language->Phrase("PrinterFriendly")) ?>" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $view_school_lists_payments_list->ExportExcelUrl ?>"><img src='images/exportxls.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToExcel")) ?>' width='16' height='16' border='0'></a>
&nbsp;&nbsp;<a href="<?php echo $view_school_lists_payments_list->ExportCsvUrl ?>"><img src='images/exportcsv.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("ExportToCsv")) ?>' width='16' height='16' border='0'></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($view_school_lists_payments->Export == "" && $view_school_lists_payments->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(view_school_lists_payments_list);" style="text-decoration: none;"><img id="view_school_lists_payments_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="view_school_lists_payments_list_SearchPanel">
<form name="fview_school_lists_paymentslistsrch" id="fview_school_lists_paymentslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return view_school_lists_payments_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="view_school_lists_payments">
<?php
if ($gsSearchError == "")
	$view_school_lists_payments_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$view_school_lists_payments->RowType = EW_ROWTYPE_SEARCH;

// Render row
$view_school_lists_payments_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $view_school_lists_payments->schools_school_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_schools_school_id" id="z_schools_school_id" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_schools_school_id" name="x_schools_school_id" title="<?php echo $view_school_lists_payments->schools_school_id->FldTitle() ?>"<?php echo $view_school_lists_payments->schools_school_id->EditAttributes() ?>>
<?php
if (is_array($view_school_lists_payments->schools_school_id->EditValue)) {
	$arwrk = $view_school_lists_payments->schools_school_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($view_school_lists_payments->schools_school_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $view_school_lists_payments->year->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_year" id="z_year" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_year" id="x_year" title="<?php echo $view_school_lists_payments->year->FldTitle() ?>" size="30" value="<?php echo $view_school_lists_payments->year->EditValue ?>"<?php echo $view_school_lists_payments->year->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $view_school_lists_payments_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ResetSearch") ?></a>&nbsp;
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
$view_school_lists_payments_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fview_school_lists_paymentslist" id="fview_school_lists_paymentslist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="view_school_lists_payments">
<div id="gmp_view_school_lists_payments" class="ewGridMiddlePanel">
<?php if ($view_school_lists_payments_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $view_school_lists_payments->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$view_school_lists_payments_list->RenderListOptions();

// Render list options (header, left)
$view_school_lists_payments_list->ListOptions->Render("header", "left");
?>
<?php if ($view_school_lists_payments->student_firstname->Visible) { // student_firstname ?>
	<?php if ($view_school_lists_payments->SortUrl($view_school_lists_payments->student_firstname) == "") { ?>
		<td><?php echo $view_school_lists_payments->student_firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_school_lists_payments->SortUrl($view_school_lists_payments->student_firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_school_lists_payments->student_firstname->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_school_lists_payments->student_firstname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_school_lists_payments->student_firstname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_school_lists_payments->student_lastname->Visible) { // student_lastname ?>
	<?php if ($view_school_lists_payments->SortUrl($view_school_lists_payments->student_lastname) == "") { ?>
		<td><?php echo $view_school_lists_payments->student_lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_school_lists_payments->SortUrl($view_school_lists_payments->student_lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_school_lists_payments->student_lastname->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_school_lists_payments->student_lastname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_school_lists_payments->student_lastname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_school_lists_payments->schools_school_id->Visible) { // schools_school_id ?>
	<?php if ($view_school_lists_payments->SortUrl($view_school_lists_payments->schools_school_id) == "") { ?>
		<td><?php echo $view_school_lists_payments->schools_school_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_school_lists_payments->SortUrl($view_school_lists_payments->schools_school_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_school_lists_payments->schools_school_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_school_lists_payments->schools_school_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_school_lists_payments->schools_school_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_school_lists_payments->year->Visible) { // year ?>
	<?php if ($view_school_lists_payments->SortUrl($view_school_lists_payments->year) == "") { ?>
		<td><?php echo $view_school_lists_payments->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_school_lists_payments->SortUrl($view_school_lists_payments->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_school_lists_payments->year->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_school_lists_payments->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_school_lists_payments->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_school_lists_payments->program->Visible) { // program ?>
	<?php if ($view_school_lists_payments->SortUrl($view_school_lists_payments->program) == "") { ?>
		<td><?php echo $view_school_lists_payments->program->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_school_lists_payments->SortUrl($view_school_lists_payments->program) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_school_lists_payments->program->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_school_lists_payments->program->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_school_lists_payments->program->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_school_lists_payments->attendance_type->Visible) { // attendance_type ?>
	<?php if ($view_school_lists_payments->SortUrl($view_school_lists_payments->attendance_type) == "") { ?>
		<td><?php echo $view_school_lists_payments->attendance_type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_school_lists_payments->SortUrl($view_school_lists_payments->attendance_type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_school_lists_payments->attendance_type->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_school_lists_payments->attendance_type->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_school_lists_payments->attendance_type->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_school_lists_payments->grade_year_id->Visible) { // grade_year_id ?>
	<?php if ($view_school_lists_payments->SortUrl($view_school_lists_payments->grade_year_id) == "") { ?>
		<td><?php echo $view_school_lists_payments->grade_year_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_school_lists_payments->SortUrl($view_school_lists_payments->grade_year_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_school_lists_payments->grade_year_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_school_lists_payments->grade_year_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_school_lists_payments->grade_year_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($view_school_lists_payments->verified->Visible) { // verified ?>
	<?php if ($view_school_lists_payments->SortUrl($view_school_lists_payments->verified) == "") { ?>
		<td><?php echo $view_school_lists_payments->verified->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $view_school_lists_payments->SortUrl($view_school_lists_payments->verified) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $view_school_lists_payments->verified->FldCaption() ?></td><td style="width: 10px;"><?php if ($view_school_lists_payments->verified->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view_school_lists_payments->verified->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$view_school_lists_payments_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($view_school_lists_payments->ExportAll && $view_school_lists_payments->Export <> "") {
	$view_school_lists_payments_list->lStopRec = $view_school_lists_payments_list->lTotalRecs;
} else {
	$view_school_lists_payments_list->lStopRec = $view_school_lists_payments_list->lStartRec + $view_school_lists_payments_list->lDisplayRecs - 1; // Set the last record to display
}
$view_school_lists_payments_list->lRecCount = $view_school_lists_payments_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $view_school_lists_payments_list->lStartRec > 1)
		$rs->Move($view_school_lists_payments_list->lStartRec - 1);
}

// Initialize aggregate
$view_school_lists_payments->RowType = EW_ROWTYPE_AGGREGATEINIT;
$view_school_lists_payments_list->RenderRow();
$view_school_lists_payments_list->lRowCnt = 0;
if ($view_school_lists_payments->CurrentAction == "gridedit")
	$view_school_lists_payments_list->lRowIndex = 0;
while (($view_school_lists_payments->CurrentAction == "gridadd" || !$rs->EOF) &&
	$view_school_lists_payments_list->lRecCount < $view_school_lists_payments_list->lStopRec) {
	$view_school_lists_payments_list->lRecCount++;
	if (intval($view_school_lists_payments_list->lRecCount) >= intval($view_school_lists_payments_list->lStartRec)) {
		$view_school_lists_payments_list->lRowCnt++;
		if ($view_school_lists_payments->CurrentAction == "gridadd" || $view_school_lists_payments->CurrentAction == "gridedit")
			$view_school_lists_payments_list->lRowIndex++;

	// Init row class and style
	$view_school_lists_payments->CssClass = "";
	$view_school_lists_payments->CssStyle = "";
	$view_school_lists_payments->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($view_school_lists_payments->CurrentAction == "gridadd") {
		$view_school_lists_payments_list->LoadDefaultValues(); // Load default values
	} else {
		$view_school_lists_payments_list->LoadRowValues($rs); // Load row values
	}
	$view_school_lists_payments->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($view_school_lists_payments->CurrentAction == "gridedit") { // Grid edit
		$view_school_lists_payments->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($view_school_lists_payments->RowType == EW_ROWTYPE_EDIT && $view_school_lists_payments->EventCancelled) { // Update failed
		if ($view_school_lists_payments->CurrentAction == "gridedit")
			$view_school_lists_payments_list->RestoreCurrentRowFormValues($view_school_lists_payments_list->lRowIndex); // Restore form values
	}
	if ($view_school_lists_payments->RowType == EW_ROWTYPE_EDIT) // Edit row
		$view_school_lists_payments_list->lEditRowCnt++;
	if ($view_school_lists_payments->RowType == EW_ROWTYPE_ADD || $view_school_lists_payments->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
		$view_school_lists_payments->RowAttrs = array_merge($view_school_lists_payments->RowAttrs, array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);'));
		$view_school_lists_payments->CssClass = "ewTableEditRow";
	}

	// Render row
	$view_school_lists_payments_list->RenderRow();

	// Render list options
	$view_school_lists_payments_list->RenderListOptions();
?>
	<tr<?php echo $view_school_lists_payments->RowAttributes() ?>>
<?php

// Render list options (body, left)
$view_school_lists_payments_list->ListOptions->Render("body", "left");
?>
	<?php if ($view_school_lists_payments->student_firstname->Visible) { // student_firstname ?>
		<td<?php echo $view_school_lists_payments->student_firstname->CellAttributes() ?>>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $view_school_lists_payments->student_firstname->ViewAttributes() ?>><?php echo $view_school_lists_payments->student_firstname->EditValue ?></div><input type="hidden" name="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_student_firstname" id="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_student_firstname" value="<?php echo ew_HtmlEncode($view_school_lists_payments->student_firstname->CurrentValue) ?>">
<?php } ?>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $view_school_lists_payments->student_firstname->ViewAttributes() ?>><?php echo $view_school_lists_payments->student_firstname->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($view_school_lists_payments->student_lastname->Visible) { // student_lastname ?>
		<td<?php echo $view_school_lists_payments->student_lastname->CellAttributes() ?>>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $view_school_lists_payments->student_lastname->ViewAttributes() ?>><?php echo $view_school_lists_payments->student_lastname->EditValue ?></div><input type="hidden" name="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_student_lastname" id="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_student_lastname" value="<?php echo ew_HtmlEncode($view_school_lists_payments->student_lastname->CurrentValue) ?>">
<?php } ?>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $view_school_lists_payments->student_lastname->ViewAttributes() ?>><?php echo $view_school_lists_payments->student_lastname->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($view_school_lists_payments->schools_school_id->Visible) { // schools_school_id ?>
		<td<?php echo $view_school_lists_payments->schools_school_id->CellAttributes() ?>>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $view_school_lists_payments->schools_school_id->ViewAttributes() ?>><?php echo $view_school_lists_payments->schools_school_id->EditValue ?></div><input type="hidden" name="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_schools_school_id" id="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_schools_school_id" value="<?php echo ew_HtmlEncode($view_school_lists_payments->schools_school_id->CurrentValue) ?>">
<?php } ?>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $view_school_lists_payments->schools_school_id->ViewAttributes() ?>><?php echo $view_school_lists_payments->schools_school_id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($view_school_lists_payments->year->Visible) { // year ?>
		<td<?php echo $view_school_lists_payments->year->CellAttributes() ?>>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $view_school_lists_payments->year->ViewAttributes() ?>><?php echo $view_school_lists_payments->year->EditValue ?></div><input type="hidden" name="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_year" id="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_year" value="<?php echo ew_HtmlEncode($view_school_lists_payments->year->CurrentValue) ?>">
<?php } ?>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $view_school_lists_payments->year->ViewAttributes() ?>><?php echo $view_school_lists_payments->year->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($view_school_lists_payments->program->Visible) { // program ?>
		<td<?php echo $view_school_lists_payments->program->CellAttributes() ?>>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $view_school_lists_payments->program->ViewAttributes() ?>><?php echo $view_school_lists_payments->program->EditValue ?></div><input type="hidden" name="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_program" id="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_program" value="<?php echo ew_HtmlEncode($view_school_lists_payments->program->CurrentValue) ?>">
<?php } ?>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $view_school_lists_payments->program->ViewAttributes() ?>><?php echo $view_school_lists_payments->program->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($view_school_lists_payments->attendance_type->Visible) { // attendance_type ?>
		<td<?php echo $view_school_lists_payments->attendance_type->CellAttributes() ?>>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $view_school_lists_payments->attendance_type->ViewAttributes() ?>><?php echo $view_school_lists_payments->attendance_type->EditValue ?></div><input type="hidden" name="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_attendance_type" id="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_attendance_type" value="<?php echo ew_HtmlEncode($view_school_lists_payments->attendance_type->CurrentValue) ?>">
<?php } ?>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $view_school_lists_payments->attendance_type->ViewAttributes() ?>><?php echo $view_school_lists_payments->attendance_type->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($view_school_lists_payments->grade_year_id->Visible) { // grade_year_id ?>
		<td<?php echo $view_school_lists_payments->grade_year_id->CellAttributes() ?>>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $view_school_lists_payments->grade_year_id->ViewAttributes() ?>><?php echo $view_school_lists_payments->grade_year_id->EditValue ?></div><input type="hidden" name="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_grade_year_id" id="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_grade_year_id" value="<?php echo ew_HtmlEncode($view_school_lists_payments->grade_year_id->CurrentValue) ?>">
<?php } ?>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $view_school_lists_payments->grade_year_id->ViewAttributes() ?>><?php echo $view_school_lists_payments->grade_year_id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($view_school_lists_payments->verified->Visible) { // verified ?>
		<td<?php echo $view_school_lists_payments->verified->CellAttributes() ?>>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $view_school_lists_payments_list->lRowIndex ?>_verified" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_verified" id="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_verified" title="<?php echo $view_school_lists_payments->verified->FldTitle() ?>" value="{value}"<?php echo $view_school_lists_payments->verified->EditAttributes() ?>></label></div>
<div id="dsl_x<?php echo $view_school_lists_payments_list->lRowIndex ?>_verified" repeatcolumn="5">
<?php
$arwrk = $view_school_lists_payments->verified->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($view_school_lists_payments->verified->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_verified" id="x<?php echo $view_school_lists_payments_list->lRowIndex ?>_verified" title="<?php echo $view_school_lists_payments->verified->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $view_school_lists_payments->verified->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
<?php } ?>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $view_school_lists_payments->verified->ViewAttributes() ?>><?php echo $view_school_lists_payments->verified->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view_school_lists_payments_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($view_school_lists_payments->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($view_school_lists_payments->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($view_school_lists_payments->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $view_school_lists_payments_list->lRowIndex ?>">
<?php echo $view_school_lists_payments_list->sMultiSelectKey ?>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($view_school_lists_payments->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($view_school_lists_payments->CurrentAction <> "gridadd" && $view_school_lists_payments->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($view_school_lists_payments_list->Pager)) $view_school_lists_payments_list->Pager = new cPrevNextPager($view_school_lists_payments_list->lStartRec, $view_school_lists_payments_list->lDisplayRecs, $view_school_lists_payments_list->lTotalRecs) ?>
<?php if ($view_school_lists_payments_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($view_school_lists_payments_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $view_school_lists_payments_list->PageUrl() ?>start=<?php echo $view_school_lists_payments_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($view_school_lists_payments_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $view_school_lists_payments_list->PageUrl() ?>start=<?php echo $view_school_lists_payments_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $view_school_lists_payments_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($view_school_lists_payments_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $view_school_lists_payments_list->PageUrl() ?>start=<?php echo $view_school_lists_payments_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($view_school_lists_payments_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $view_school_lists_payments_list->PageUrl() ?>start=<?php echo $view_school_lists_payments_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $view_school_lists_payments_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $view_school_lists_payments_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $view_school_lists_payments_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $view_school_lists_payments_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($view_school_lists_payments_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($view_school_lists_payments_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($view_school_lists_payments->CurrentAction <> "gridadd" && $view_school_lists_payments->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->CanEdit()) { ?>
<?php if ($view_school_lists_payments_list->lTotalRecs > 0) { ?>
<a href="<?php echo $view_school_lists_payments_list->GridEditUrl ?>"><?php echo $Language->Phrase("GridEditLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($view_school_lists_payments->CurrentAction == "gridedit") { ?>
<a href="" onclick="f=document.fview_school_lists_paymentslist;if(view_school_lists_payments_list.ValidateForm(f))f.submit();return false;"><img src='images/update.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("GridSaveLink")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("GridSaveLink")) ?>' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<a href="<?php echo $view_school_lists_payments_list->PageUrl() ?>a=cancel"><img src='images/cancel.gif' alt='<?php echo ew_HtmlEncode($Language->Phrase("GridCancelLink")) ?>' title='<?php echo ew_HtmlEncode($Language->Phrase("GridCancelLink")) ?>' width='16' height='16' border='0'></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($view_school_lists_payments->Export == "" && $view_school_lists_payments->CurrentAction == "") { ?>
<?php } ?>
<?php if ($view_school_lists_payments->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$view_school_lists_payments_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cview_school_lists_payments_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'view_school_lists_payments';

	// Page object name
	var $PageObjName = 'view_school_lists_payments_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $view_school_lists_payments;
		if ($view_school_lists_payments->UseTokenInUrl) $PageUrl .= "t=" . $view_school_lists_payments->TableVar . "&"; // Add page token
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
		global $objForm, $view_school_lists_payments;
		if ($view_school_lists_payments->UseTokenInUrl) {
			if ($objForm)
				return ($view_school_lists_payments->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($view_school_lists_payments->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cview_school_lists_payments_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (view_school_lists_payments)
		$GLOBALS["view_school_lists_payments"] = new cview_school_lists_payments();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["view_school_lists_payments"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "view_school_lists_paymentsdelete.php";
		$this->MultiUpdateUrl = "view_school_lists_paymentsupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'view_school_lists_payments', TRUE);

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
		global $view_school_lists_payments;

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

		// Create form object
		$objForm = new cFormObj();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$view_school_lists_payments->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$view_school_lists_payments->Export = $_POST["exporttype"];
		} else {
			$view_school_lists_payments->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $view_school_lists_payments->Export; // Get export parameter, used in header
		$gsExportFile = $view_school_lists_payments->TableVar; // Get export file, used in header
		if ($view_school_lists_payments->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($view_school_lists_payments->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $view_school_lists_payments;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$view_school_lists_payments->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($view_school_lists_payments->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($view_school_lists_payments->CurrentAction == "gridedit")
					$this->GridEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$view_school_lists_payments->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if (($view_school_lists_payments->CurrentAction == "gridupdate" || $view_school_lists_payments->CurrentAction == "gridoverwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();
				}
			}

			// Set up list options
			$this->SetupListOptions();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$view_school_lists_payments->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($view_school_lists_payments->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $view_school_lists_payments->getRecordsPerPage(); // Restore from Session
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
		$view_school_lists_payments->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$view_school_lists_payments->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$view_school_lists_payments->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $view_school_lists_payments->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;
		if ($sFilter == "") {
			$sFilter = "0=101";
			$this->sSrchWhere = $sFilter;
		}

		// Set up filter in session
		$view_school_lists_payments->setSessionWhere($sFilter);
		$view_school_lists_payments->CurrentFilter = "";

		// Export data only
		if (in_array($view_school_lists_payments->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($view_school_lists_payments->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $view_school_lists_payments;
		$view_school_lists_payments->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $Language, $objForm, $gsFormError, $view_school_lists_payments;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$view_school_lists_payments->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $view_school_lists_payments->SQL();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));

		// Update all rows based on key
		while ($sThisKey <> "") {

			// Load all values and keys
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$bGridUpdate = FALSE; // Form error, reset action
				$this->setMessage($gsFormError);
			} else {
				if ($this->SetupKeyValues($sThisKey)) { // Set up key values
					$view_school_lists_payments->SendEmail = FALSE; // Do not send email on update success
					$bGridUpdate = $this->EditRow(); // Update this row
				} else {
					$bGridUpdate = FALSE; // update failed
				}
			}
			if ($bGridUpdate) {
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			} else {
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->setMessage($Language->Phrase("UpdateSuccess")); // Set update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getMessage() == "")
				$this->setMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$view_school_lists_payments->EventCancelled = TRUE; // Set event cancelled
			$view_school_lists_payments->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $view_school_lists_payments;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $view_school_lists_payments->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		global $view_school_lists_payments;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$view_school_lists_payments->grade_year_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($view_school_lists_payments->grade_year_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $view_school_lists_payments;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($view_school_lists_payments->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($view_school_lists_payments->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($view_school_lists_payments->grade_year_id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $view_school_lists_payments;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $view_school_lists_payments->sponsored_student_id, FALSE); // sponsored_student_id
		$this->BuildSearchSql($sWhere, $view_school_lists_payments->student_firstname, FALSE); // student_firstname
		$this->BuildSearchSql($sWhere, $view_school_lists_payments->student_middlename, FALSE); // student_middlename
		$this->BuildSearchSql($sWhere, $view_school_lists_payments->student_lastname, FALSE); // student_lastname
		$this->BuildSearchSql($sWhere, $view_school_lists_payments->schools_school_id, FALSE); // schools_school_id
		$this->BuildSearchSql($sWhere, $view_school_lists_payments->year, FALSE); // year
		$this->BuildSearchSql($sWhere, $view_school_lists_payments->class, FALSE); // class
		$this->BuildSearchSql($sWhere, $view_school_lists_payments->program, FALSE); // program
		$this->BuildSearchSql($sWhere, $view_school_lists_payments->attendance_type, FALSE); // attendance_type
		$this->BuildSearchSql($sWhere, $view_school_lists_payments->grade_year_id, FALSE); // grade_year_id
		$this->BuildSearchSql($sWhere, $view_school_lists_payments->school_attendance_school_attendance_id, FALSE); // school_attendance_school_attendance_id
		$this->BuildSearchSql($sWhere, $view_school_lists_payments->verified, FALSE); // verified

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($view_school_lists_payments->sponsored_student_id); // sponsored_student_id
			$this->SetSearchParm($view_school_lists_payments->student_firstname); // student_firstname
			$this->SetSearchParm($view_school_lists_payments->student_middlename); // student_middlename
			$this->SetSearchParm($view_school_lists_payments->student_lastname); // student_lastname
			$this->SetSearchParm($view_school_lists_payments->schools_school_id); // schools_school_id
			$this->SetSearchParm($view_school_lists_payments->year); // year
			$this->SetSearchParm($view_school_lists_payments->class); // class
			$this->SetSearchParm($view_school_lists_payments->program); // program
			$this->SetSearchParm($view_school_lists_payments->attendance_type); // attendance_type
			$this->SetSearchParm($view_school_lists_payments->grade_year_id); // grade_year_id
			$this->SetSearchParm($view_school_lists_payments->school_attendance_school_attendance_id); // school_attendance_school_attendance_id
			$this->SetSearchParm($view_school_lists_payments->verified); // verified
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
		global $view_school_lists_payments;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$view_school_lists_payments->setAdvancedSearch("x_$FldParm", $FldVal);
		$view_school_lists_payments->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$view_school_lists_payments->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$view_school_lists_payments->setAdvancedSearch("y_$FldParm", $FldVal2);
		$view_school_lists_payments->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $view_school_lists_payments;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $view_school_lists_payments->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $view_school_lists_payments->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $view_school_lists_payments->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $view_school_lists_payments->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $view_school_lists_payments->GetAdvancedSearch("w_$FldParm");
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
		global $view_school_lists_payments;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$view_school_lists_payments->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $view_school_lists_payments;
		$view_school_lists_payments->setAdvancedSearch("x_sponsored_student_id", "");
		$view_school_lists_payments->setAdvancedSearch("x_student_firstname", "");
		$view_school_lists_payments->setAdvancedSearch("x_student_middlename", "");
		$view_school_lists_payments->setAdvancedSearch("x_student_lastname", "");
		$view_school_lists_payments->setAdvancedSearch("x_schools_school_id", "");
		$view_school_lists_payments->setAdvancedSearch("x_year", "");
		$view_school_lists_payments->setAdvancedSearch("x_class", "");
		$view_school_lists_payments->setAdvancedSearch("x_program", "");
		$view_school_lists_payments->setAdvancedSearch("x_attendance_type", "");
		$view_school_lists_payments->setAdvancedSearch("x_grade_year_id", "");
		$view_school_lists_payments->setAdvancedSearch("x_school_attendance_school_attendance_id", "");
		$view_school_lists_payments->setAdvancedSearch("x_verified", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $view_school_lists_payments;
		$bRestore = TRUE;
		if (@$_GET["x_sponsored_student_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_firstname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_middlename"] <> "") $bRestore = FALSE;
		if (@$_GET["x_student_lastname"] <> "") $bRestore = FALSE;
		if (@$_GET["x_schools_school_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_year"] <> "") $bRestore = FALSE;
		if (@$_GET["x_class"] <> "") $bRestore = FALSE;
		if (@$_GET["x_program"] <> "") $bRestore = FALSE;
		if (@$_GET["x_attendance_type"] <> "") $bRestore = FALSE;
		if (@$_GET["x_grade_year_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_school_attendance_school_attendance_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_verified"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($view_school_lists_payments->sponsored_student_id);
			$this->GetSearchParm($view_school_lists_payments->student_firstname);
			$this->GetSearchParm($view_school_lists_payments->student_middlename);
			$this->GetSearchParm($view_school_lists_payments->student_lastname);
			$this->GetSearchParm($view_school_lists_payments->schools_school_id);
			$this->GetSearchParm($view_school_lists_payments->year);
			$this->GetSearchParm($view_school_lists_payments->class);
			$this->GetSearchParm($view_school_lists_payments->program);
			$this->GetSearchParm($view_school_lists_payments->attendance_type);
			$this->GetSearchParm($view_school_lists_payments->grade_year_id);
			$this->GetSearchParm($view_school_lists_payments->school_attendance_school_attendance_id);
			$this->GetSearchParm($view_school_lists_payments->verified);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $view_school_lists_payments;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$view_school_lists_payments->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$view_school_lists_payments->CurrentOrderType = @$_GET["ordertype"];
			$view_school_lists_payments->UpdateSort($view_school_lists_payments->student_firstname); // student_firstname
			$view_school_lists_payments->UpdateSort($view_school_lists_payments->student_lastname); // student_lastname
			$view_school_lists_payments->UpdateSort($view_school_lists_payments->schools_school_id); // schools_school_id
			$view_school_lists_payments->UpdateSort($view_school_lists_payments->year); // year
			$view_school_lists_payments->UpdateSort($view_school_lists_payments->program); // program
			$view_school_lists_payments->UpdateSort($view_school_lists_payments->attendance_type); // attendance_type
			$view_school_lists_payments->UpdateSort($view_school_lists_payments->grade_year_id); // grade_year_id
			$view_school_lists_payments->UpdateSort($view_school_lists_payments->verified); // verified
			$view_school_lists_payments->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $view_school_lists_payments;
		$sOrderBy = $view_school_lists_payments->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($view_school_lists_payments->SqlOrderBy() <> "") {
				$sOrderBy = $view_school_lists_payments->SqlOrderBy();
				$view_school_lists_payments->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $view_school_lists_payments;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$view_school_lists_payments->setSessionOrderBy($sOrderBy);
				$view_school_lists_payments->student_firstname->setSort("");
				$view_school_lists_payments->student_lastname->setSort("");
				$view_school_lists_payments->schools_school_id->setSort("");
				$view_school_lists_payments->year->setSort("");
				$view_school_lists_payments->program->setSort("");
				$view_school_lists_payments->attendance_type->setSort("");
				$view_school_lists_payments->grade_year_id->setSort("");
				$view_school_lists_payments->verified->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$view_school_lists_payments->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $view_school_lists_payments;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($view_school_lists_payments->Export <> "" ||
			$view_school_lists_payments->CurrentAction == "gridadd" ||
			$view_school_lists_payments->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $view_school_lists_payments;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . "<img src=\"images/edit.gif\" alt=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" title=\"" . ew_HtmlEncode($Language->Phrase("EditLink")) . "\" width=\"16\" height=\"16\" border=\"0\">" . "</a>";
		}
		if ($view_school_lists_payments->CurrentAction == "gridedit")
			$this->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->lRowIndex . "_key\" id=\"k" . $this->lRowIndex . "_key\" value=\"" . $view_school_lists_payments->grade_year_id->CurrentValue . "\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $view_school_lists_payments;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $view_school_lists_payments;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$view_school_lists_payments->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$view_school_lists_payments->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $view_school_lists_payments->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$view_school_lists_payments->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$view_school_lists_payments->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$view_school_lists_payments->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $view_school_lists_payments;

		// Load search values
		// sponsored_student_id

		$view_school_lists_payments->sponsored_student_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_sponsored_student_id"]);
		$view_school_lists_payments->sponsored_student_id->AdvancedSearch->SearchOperator = @$_GET["z_sponsored_student_id"];

		// student_firstname
		$view_school_lists_payments->student_firstname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_firstname"]);
		$view_school_lists_payments->student_firstname->AdvancedSearch->SearchOperator = @$_GET["z_student_firstname"];

		// student_middlename
		$view_school_lists_payments->student_middlename->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_middlename"]);
		$view_school_lists_payments->student_middlename->AdvancedSearch->SearchOperator = @$_GET["z_student_middlename"];

		// student_lastname
		$view_school_lists_payments->student_lastname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_student_lastname"]);
		$view_school_lists_payments->student_lastname->AdvancedSearch->SearchOperator = @$_GET["z_student_lastname"];

		// schools_school_id
		$view_school_lists_payments->schools_school_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_schools_school_id"]);
		$view_school_lists_payments->schools_school_id->AdvancedSearch->SearchOperator = @$_GET["z_schools_school_id"];

		// year
		$view_school_lists_payments->year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_year"]);
		$view_school_lists_payments->year->AdvancedSearch->SearchOperator = @$_GET["z_year"];

		// class
		$view_school_lists_payments->class->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_class"]);
		$view_school_lists_payments->class->AdvancedSearch->SearchOperator = @$_GET["z_class"];

		// program
		$view_school_lists_payments->program->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_program"]);
		$view_school_lists_payments->program->AdvancedSearch->SearchOperator = @$_GET["z_program"];

		// attendance_type
		$view_school_lists_payments->attendance_type->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_attendance_type"]);
		$view_school_lists_payments->attendance_type->AdvancedSearch->SearchOperator = @$_GET["z_attendance_type"];

		// grade_year_id
		$view_school_lists_payments->grade_year_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_grade_year_id"]);
		$view_school_lists_payments->grade_year_id->AdvancedSearch->SearchOperator = @$_GET["z_grade_year_id"];

		// school_attendance_school_attendance_id
		$view_school_lists_payments->school_attendance_school_attendance_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_school_attendance_school_attendance_id"]);
		$view_school_lists_payments->school_attendance_school_attendance_id->AdvancedSearch->SearchOperator = @$_GET["z_school_attendance_school_attendance_id"];

		// verified
		$view_school_lists_payments->verified->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_verified"]);
		$view_school_lists_payments->verified->AdvancedSearch->SearchOperator = @$_GET["z_verified"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $view_school_lists_payments;
		$view_school_lists_payments->student_firstname->setFormValue($objForm->GetValue("x_student_firstname"));
		$view_school_lists_payments->student_lastname->setFormValue($objForm->GetValue("x_student_lastname"));
		$view_school_lists_payments->schools_school_id->setFormValue($objForm->GetValue("x_schools_school_id"));
		$view_school_lists_payments->year->setFormValue($objForm->GetValue("x_year"));
		$view_school_lists_payments->program->setFormValue($objForm->GetValue("x_program"));
		$view_school_lists_payments->attendance_type->setFormValue($objForm->GetValue("x_attendance_type"));
		$view_school_lists_payments->grade_year_id->setFormValue($objForm->GetValue("x_grade_year_id"));
		$view_school_lists_payments->verified->setFormValue($objForm->GetValue("x_verified"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $view_school_lists_payments;
		$view_school_lists_payments->student_firstname->CurrentValue = $view_school_lists_payments->student_firstname->FormValue;
		$view_school_lists_payments->student_lastname->CurrentValue = $view_school_lists_payments->student_lastname->FormValue;
		$view_school_lists_payments->schools_school_id->CurrentValue = $view_school_lists_payments->schools_school_id->FormValue;
		$view_school_lists_payments->year->CurrentValue = $view_school_lists_payments->year->FormValue;
		$view_school_lists_payments->program->CurrentValue = $view_school_lists_payments->program->FormValue;
		$view_school_lists_payments->attendance_type->CurrentValue = $view_school_lists_payments->attendance_type->FormValue;
		$view_school_lists_payments->grade_year_id->CurrentValue = $view_school_lists_payments->grade_year_id->FormValue;
		$view_school_lists_payments->verified->CurrentValue = $view_school_lists_payments->verified->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $view_school_lists_payments;

		// Call Recordset Selecting event
		$view_school_lists_payments->Recordset_Selecting($view_school_lists_payments->CurrentFilter);

		// Load List page SQL
		$sSql = $view_school_lists_payments->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$view_school_lists_payments->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $view_school_lists_payments;
		$sFilter = $view_school_lists_payments->KeyFilter();

		// Call Row Selecting event
		$view_school_lists_payments->Row_Selecting($sFilter);

		// Load SQL based on filter
		$view_school_lists_payments->CurrentFilter = $sFilter;
		$sSql = $view_school_lists_payments->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$view_school_lists_payments->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $view_school_lists_payments;
		$view_school_lists_payments->sponsored_student_id->setDbValue($rs->fields('sponsored_student_id'));
		$view_school_lists_payments->student_firstname->setDbValue($rs->fields('student_firstname'));
		$view_school_lists_payments->student_middlename->setDbValue($rs->fields('student_middlename'));
		$view_school_lists_payments->student_lastname->setDbValue($rs->fields('student_lastname'));
		$view_school_lists_payments->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$view_school_lists_payments->year->setDbValue($rs->fields('year'));
		$view_school_lists_payments->class->setDbValue($rs->fields('class'));
		$view_school_lists_payments->program->setDbValue($rs->fields('program'));
		$view_school_lists_payments->attendance_type->setDbValue($rs->fields('attendance_type'));
		$view_school_lists_payments->grade_year_id->setDbValue($rs->fields('grade_year_id'));
		$view_school_lists_payments->school_attendance_school_attendance_id->setDbValue($rs->fields('school_attendance_school_attendance_id'));
		$view_school_lists_payments->verified->setDbValue($rs->fields('verified'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $view_school_lists_payments;

		// Initialize URLs
		$this->ViewUrl = $view_school_lists_payments->ViewUrl();
		$this->EditUrl = $view_school_lists_payments->EditUrl();
		$this->InlineEditUrl = $view_school_lists_payments->InlineEditUrl();
		$this->CopyUrl = $view_school_lists_payments->CopyUrl();
		$this->InlineCopyUrl = $view_school_lists_payments->InlineCopyUrl();
		$this->DeleteUrl = $view_school_lists_payments->DeleteUrl();

		// Call Row_Rendering event
		$view_school_lists_payments->Row_Rendering();

		// Common render codes for all row types
		// student_firstname

		$view_school_lists_payments->student_firstname->CellCssStyle = ""; $view_school_lists_payments->student_firstname->CellCssClass = "";
		$view_school_lists_payments->student_firstname->CellAttrs = array(); $view_school_lists_payments->student_firstname->ViewAttrs = array(); $view_school_lists_payments->student_firstname->EditAttrs = array();

		// student_lastname
		$view_school_lists_payments->student_lastname->CellCssStyle = ""; $view_school_lists_payments->student_lastname->CellCssClass = "";
		$view_school_lists_payments->student_lastname->CellAttrs = array(); $view_school_lists_payments->student_lastname->ViewAttrs = array(); $view_school_lists_payments->student_lastname->EditAttrs = array();

		// schools_school_id
		$view_school_lists_payments->schools_school_id->CellCssStyle = ""; $view_school_lists_payments->schools_school_id->CellCssClass = "";
		$view_school_lists_payments->schools_school_id->CellAttrs = array(); $view_school_lists_payments->schools_school_id->ViewAttrs = array(); $view_school_lists_payments->schools_school_id->EditAttrs = array();

		// year
		$view_school_lists_payments->year->CellCssStyle = ""; $view_school_lists_payments->year->CellCssClass = "";
		$view_school_lists_payments->year->CellAttrs = array(); $view_school_lists_payments->year->ViewAttrs = array(); $view_school_lists_payments->year->EditAttrs = array();

		// program
		$view_school_lists_payments->program->CellCssStyle = ""; $view_school_lists_payments->program->CellCssClass = "";
		$view_school_lists_payments->program->CellAttrs = array(); $view_school_lists_payments->program->ViewAttrs = array(); $view_school_lists_payments->program->EditAttrs = array();

		// attendance_type
		$view_school_lists_payments->attendance_type->CellCssStyle = ""; $view_school_lists_payments->attendance_type->CellCssClass = "";
		$view_school_lists_payments->attendance_type->CellAttrs = array(); $view_school_lists_payments->attendance_type->ViewAttrs = array(); $view_school_lists_payments->attendance_type->EditAttrs = array();

		// grade_year_id
		$view_school_lists_payments->grade_year_id->CellCssStyle = ""; $view_school_lists_payments->grade_year_id->CellCssClass = "";
		$view_school_lists_payments->grade_year_id->CellAttrs = array(); $view_school_lists_payments->grade_year_id->ViewAttrs = array(); $view_school_lists_payments->grade_year_id->EditAttrs = array();

		// verified
		$view_school_lists_payments->verified->CellCssStyle = ""; $view_school_lists_payments->verified->CellCssClass = "";
		$view_school_lists_payments->verified->CellAttrs = array(); $view_school_lists_payments->verified->ViewAttrs = array(); $view_school_lists_payments->verified->EditAttrs = array();
		if ($view_school_lists_payments->RowType == EW_ROWTYPE_VIEW) { // View row

			// student_firstname
			$view_school_lists_payments->student_firstname->ViewValue = $view_school_lists_payments->student_firstname->CurrentValue;
			$view_school_lists_payments->student_firstname->CssStyle = "";
			$view_school_lists_payments->student_firstname->CssClass = "";
			$view_school_lists_payments->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$view_school_lists_payments->student_middlename->ViewValue = $view_school_lists_payments->student_middlename->CurrentValue;
			$view_school_lists_payments->student_middlename->CssStyle = "";
			$view_school_lists_payments->student_middlename->CssClass = "";
			$view_school_lists_payments->student_middlename->ViewCustomAttributes = "";

			// student_lastname
			$view_school_lists_payments->student_lastname->ViewValue = $view_school_lists_payments->student_lastname->CurrentValue;
			$view_school_lists_payments->student_lastname->CssStyle = "";
			$view_school_lists_payments->student_lastname->CssClass = "";
			$view_school_lists_payments->student_lastname->ViewCustomAttributes = "";

			// schools_school_id
			if (strval($view_school_lists_payments->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($view_school_lists_payments->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_school_lists_payments->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$view_school_lists_payments->schools_school_id->ViewValue = $view_school_lists_payments->schools_school_id->CurrentValue;
				}
			} else {
				$view_school_lists_payments->schools_school_id->ViewValue = NULL;
			}
			$view_school_lists_payments->schools_school_id->CssStyle = "";
			$view_school_lists_payments->schools_school_id->CssClass = "";
			$view_school_lists_payments->schools_school_id->ViewCustomAttributes = "";

			// year
			$view_school_lists_payments->year->ViewValue = $view_school_lists_payments->year->CurrentValue;
			$view_school_lists_payments->year->CssStyle = "";
			$view_school_lists_payments->year->CssClass = "";
			$view_school_lists_payments->year->ViewCustomAttributes = "";

			// class
			$view_school_lists_payments->class->ViewValue = $view_school_lists_payments->class->CurrentValue;
			$view_school_lists_payments->class->CssStyle = "";
			$view_school_lists_payments->class->CssClass = "";
			$view_school_lists_payments->class->ViewCustomAttributes = "";

			// program
			$view_school_lists_payments->program->ViewValue = $view_school_lists_payments->program->CurrentValue;
			$view_school_lists_payments->program->CssStyle = "";
			$view_school_lists_payments->program->CssClass = "";
			$view_school_lists_payments->program->ViewCustomAttributes = "";

			// attendance_type
			if (strval($view_school_lists_payments->attendance_type->CurrentValue) <> "") {
				switch ($view_school_lists_payments->attendance_type->CurrentValue) {
					case "BOARDER":
						$view_school_lists_payments->attendance_type->ViewValue = "BOARDER";
						break;
					case "DAY":
						$view_school_lists_payments->attendance_type->ViewValue = "DAY";
						break;
					default:
						$view_school_lists_payments->attendance_type->ViewValue = $view_school_lists_payments->attendance_type->CurrentValue;
				}
			} else {
				$view_school_lists_payments->attendance_type->ViewValue = NULL;
			}
			$view_school_lists_payments->attendance_type->CssStyle = "";
			$view_school_lists_payments->attendance_type->CssClass = "";
			$view_school_lists_payments->attendance_type->ViewCustomAttributes = "";

			// grade_year_id
			$view_school_lists_payments->grade_year_id->ViewValue = $view_school_lists_payments->grade_year_id->CurrentValue;
			$view_school_lists_payments->grade_year_id->CssStyle = "";
			$view_school_lists_payments->grade_year_id->CssClass = "";
			$view_school_lists_payments->grade_year_id->ViewCustomAttributes = "";

			// school_attendance_school_attendance_id
			$view_school_lists_payments->school_attendance_school_attendance_id->ViewValue = $view_school_lists_payments->school_attendance_school_attendance_id->CurrentValue;
			$view_school_lists_payments->school_attendance_school_attendance_id->CssStyle = "";
			$view_school_lists_payments->school_attendance_school_attendance_id->CssClass = "";
			$view_school_lists_payments->school_attendance_school_attendance_id->ViewCustomAttributes = "";

			// verified
			if (strval($view_school_lists_payments->verified->CurrentValue) <> "") {
				switch ($view_school_lists_payments->verified->CurrentValue) {
					case "Pending":
						$view_school_lists_payments->verified->ViewValue = "Pending";
						break;
					case "Verified":
						$view_school_lists_payments->verified->ViewValue = "Verified";
						break;
					case "PaymentRequested":
						$view_school_lists_payments->verified->ViewValue = "PaymentRequested";
						break;
					default:
						$view_school_lists_payments->verified->ViewValue = $view_school_lists_payments->verified->CurrentValue;
				}
			} else {
				$view_school_lists_payments->verified->ViewValue = NULL;
			}
			$view_school_lists_payments->verified->CssStyle = "";
			$view_school_lists_payments->verified->CssClass = "";
			$view_school_lists_payments->verified->ViewCustomAttributes = "";

			// student_firstname
			$view_school_lists_payments->student_firstname->HrefValue = "";
			$view_school_lists_payments->student_firstname->TooltipValue = "";

			// student_lastname
			$view_school_lists_payments->student_lastname->HrefValue = "";
			$view_school_lists_payments->student_lastname->TooltipValue = "";

			// schools_school_id
			$view_school_lists_payments->schools_school_id->HrefValue = "";
			$view_school_lists_payments->schools_school_id->TooltipValue = "";

			// year
			$view_school_lists_payments->year->HrefValue = "";
			$view_school_lists_payments->year->TooltipValue = "";

			// program
			$view_school_lists_payments->program->HrefValue = "";
			$view_school_lists_payments->program->TooltipValue = "";

			// attendance_type
			$view_school_lists_payments->attendance_type->HrefValue = "";
			$view_school_lists_payments->attendance_type->TooltipValue = "";

			// grade_year_id
			$view_school_lists_payments->grade_year_id->HrefValue = "";
			$view_school_lists_payments->grade_year_id->TooltipValue = "";

			// verified
			$view_school_lists_payments->verified->HrefValue = "";
			$view_school_lists_payments->verified->TooltipValue = "";
		} elseif ($view_school_lists_payments->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// student_firstname
			$view_school_lists_payments->student_firstname->EditCustomAttributes = "";
			$view_school_lists_payments->student_firstname->EditValue = $view_school_lists_payments->student_firstname->CurrentValue;
			$view_school_lists_payments->student_firstname->CssStyle = "";
			$view_school_lists_payments->student_firstname->CssClass = "";
			$view_school_lists_payments->student_firstname->ViewCustomAttributes = "";

			// student_lastname
			$view_school_lists_payments->student_lastname->EditCustomAttributes = "";
			$view_school_lists_payments->student_lastname->EditValue = $view_school_lists_payments->student_lastname->CurrentValue;
			$view_school_lists_payments->student_lastname->CssStyle = "";
			$view_school_lists_payments->student_lastname->CssClass = "";
			$view_school_lists_payments->student_lastname->ViewCustomAttributes = "";

			// schools_school_id
			$view_school_lists_payments->schools_school_id->EditCustomAttributes = "";
			if (strval($view_school_lists_payments->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($view_school_lists_payments->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$view_school_lists_payments->schools_school_id->EditValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$view_school_lists_payments->schools_school_id->EditValue = $view_school_lists_payments->schools_school_id->CurrentValue;
				}
			} else {
				$view_school_lists_payments->schools_school_id->EditValue = NULL;
			}
			$view_school_lists_payments->schools_school_id->CssStyle = "";
			$view_school_lists_payments->schools_school_id->CssClass = "";
			$view_school_lists_payments->schools_school_id->ViewCustomAttributes = "";

			// year
			$view_school_lists_payments->year->EditCustomAttributes = "";
			$view_school_lists_payments->year->EditValue = $view_school_lists_payments->year->CurrentValue;
			$view_school_lists_payments->year->CssStyle = "";
			$view_school_lists_payments->year->CssClass = "";
			$view_school_lists_payments->year->ViewCustomAttributes = "";

			// program
			$view_school_lists_payments->program->EditCustomAttributes = "";
			$view_school_lists_payments->program->EditValue = $view_school_lists_payments->program->CurrentValue;
			$view_school_lists_payments->program->CssStyle = "";
			$view_school_lists_payments->program->CssClass = "";
			$view_school_lists_payments->program->ViewCustomAttributes = "";

			// attendance_type
			$view_school_lists_payments->attendance_type->EditCustomAttributes = "";
			if (strval($view_school_lists_payments->attendance_type->CurrentValue) <> "") {
				switch ($view_school_lists_payments->attendance_type->CurrentValue) {
					case "BOARDER":
						$view_school_lists_payments->attendance_type->EditValue = "BOARDER";
						break;
					case "DAY":
						$view_school_lists_payments->attendance_type->EditValue = "DAY";
						break;
					default:
						$view_school_lists_payments->attendance_type->EditValue = $view_school_lists_payments->attendance_type->CurrentValue;
				}
			} else {
				$view_school_lists_payments->attendance_type->EditValue = NULL;
			}
			$view_school_lists_payments->attendance_type->CssStyle = "";
			$view_school_lists_payments->attendance_type->CssClass = "";
			$view_school_lists_payments->attendance_type->ViewCustomAttributes = "";

			// grade_year_id
			$view_school_lists_payments->grade_year_id->EditCustomAttributes = "";
			$view_school_lists_payments->grade_year_id->EditValue = $view_school_lists_payments->grade_year_id->CurrentValue;
			$view_school_lists_payments->grade_year_id->CssStyle = "";
			$view_school_lists_payments->grade_year_id->CssClass = "";
			$view_school_lists_payments->grade_year_id->ViewCustomAttributes = "";

			// verified
			$view_school_lists_payments->verified->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("Pending", "Pending");
			$arwrk[] = array("Verified", "Verified");
			$arwrk[] = array("PaymentRequested", "PaymentRequested");
			$view_school_lists_payments->verified->EditValue = $arwrk;

			// Edit refer script
			// student_firstname

			$view_school_lists_payments->student_firstname->HrefValue = "";

			// student_lastname
			$view_school_lists_payments->student_lastname->HrefValue = "";

			// schools_school_id
			$view_school_lists_payments->schools_school_id->HrefValue = "";

			// year
			$view_school_lists_payments->year->HrefValue = "";

			// program
			$view_school_lists_payments->program->HrefValue = "";

			// attendance_type
			$view_school_lists_payments->attendance_type->HrefValue = "";

			// grade_year_id
			$view_school_lists_payments->grade_year_id->HrefValue = "";

			// verified
			$view_school_lists_payments->verified->HrefValue = "";
		} elseif ($view_school_lists_payments->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// student_firstname
			$view_school_lists_payments->student_firstname->EditCustomAttributes = "";
			$view_school_lists_payments->student_firstname->EditValue = ew_HtmlEncode($view_school_lists_payments->student_firstname->AdvancedSearch->SearchValue);

			// student_lastname
			$view_school_lists_payments->student_lastname->EditCustomAttributes = "";
			$view_school_lists_payments->student_lastname->EditValue = ew_HtmlEncode($view_school_lists_payments->student_lastname->AdvancedSearch->SearchValue);

			// schools_school_id
			$view_school_lists_payments->schools_school_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `school_id`, `school_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$view_school_lists_payments->schools_school_id->EditValue = $arwrk;

			// year
			$view_school_lists_payments->year->EditCustomAttributes = "";
			$view_school_lists_payments->year->EditValue = ew_HtmlEncode($view_school_lists_payments->year->AdvancedSearch->SearchValue);

			// program
			$view_school_lists_payments->program->EditCustomAttributes = "";
			$view_school_lists_payments->program->EditValue = ew_HtmlEncode($view_school_lists_payments->program->AdvancedSearch->SearchValue);

			// attendance_type
			$view_school_lists_payments->attendance_type->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("BOARDER", "BOARDER");
			$arwrk[] = array("DAY", "DAY");
			$view_school_lists_payments->attendance_type->EditValue = $arwrk;

			// grade_year_id
			$view_school_lists_payments->grade_year_id->EditCustomAttributes = "";
			$view_school_lists_payments->grade_year_id->EditValue = ew_HtmlEncode($view_school_lists_payments->grade_year_id->AdvancedSearch->SearchValue);

			// verified
			$view_school_lists_payments->verified->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("Pending", "Pending");
			$arwrk[] = array("Verified", "Verified");
			$arwrk[] = array("PaymentRequested", "PaymentRequested");
			$view_school_lists_payments->verified->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($view_school_lists_payments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$view_school_lists_payments->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $view_school_lists_payments;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($view_school_lists_payments->year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $view_school_lists_payments->year->FldErrMsg();
		}

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

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $view_school_lists_payments;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $view_school_lists_payments;
		$sFilter = $view_school_lists_payments->KeyFilter();
		$view_school_lists_payments->CurrentFilter = $sFilter;
		$sSql = $view_school_lists_payments->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// verified
			$view_school_lists_payments->verified->SetDbValueDef($rsnew, $view_school_lists_payments->verified->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $view_school_lists_payments->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($view_school_lists_payments->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($view_school_lists_payments->CancelMessage <> "") {
					$this->setMessage($view_school_lists_payments->CancelMessage);
					$view_school_lists_payments->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$view_school_lists_payments->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $view_school_lists_payments;
		$view_school_lists_payments->sponsored_student_id->AdvancedSearch->SearchValue = $view_school_lists_payments->getAdvancedSearch("x_sponsored_student_id");
		$view_school_lists_payments->student_firstname->AdvancedSearch->SearchValue = $view_school_lists_payments->getAdvancedSearch("x_student_firstname");
		$view_school_lists_payments->student_middlename->AdvancedSearch->SearchValue = $view_school_lists_payments->getAdvancedSearch("x_student_middlename");
		$view_school_lists_payments->student_lastname->AdvancedSearch->SearchValue = $view_school_lists_payments->getAdvancedSearch("x_student_lastname");
		$view_school_lists_payments->schools_school_id->AdvancedSearch->SearchValue = $view_school_lists_payments->getAdvancedSearch("x_schools_school_id");
		$view_school_lists_payments->year->AdvancedSearch->SearchValue = $view_school_lists_payments->getAdvancedSearch("x_year");
		$view_school_lists_payments->class->AdvancedSearch->SearchValue = $view_school_lists_payments->getAdvancedSearch("x_class");
		$view_school_lists_payments->program->AdvancedSearch->SearchValue = $view_school_lists_payments->getAdvancedSearch("x_program");
		$view_school_lists_payments->attendance_type->AdvancedSearch->SearchValue = $view_school_lists_payments->getAdvancedSearch("x_attendance_type");
		$view_school_lists_payments->grade_year_id->AdvancedSearch->SearchValue = $view_school_lists_payments->getAdvancedSearch("x_grade_year_id");
		$view_school_lists_payments->school_attendance_school_attendance_id->AdvancedSearch->SearchValue = $view_school_lists_payments->getAdvancedSearch("x_school_attendance_school_attendance_id");
		$view_school_lists_payments->verified->AdvancedSearch->SearchValue = $view_school_lists_payments->getAdvancedSearch("x_verified");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $view_school_lists_payments;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $view_school_lists_payments->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($view_school_lists_payments->ExportAll) {
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
		if ($view_school_lists_payments->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($view_school_lists_payments, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($view_school_lists_payments->student_firstname);
				$ExportDoc->ExportCaption($view_school_lists_payments->student_middlename);
				$ExportDoc->ExportCaption($view_school_lists_payments->student_lastname);
				$ExportDoc->ExportCaption($view_school_lists_payments->schools_school_id);
				$ExportDoc->ExportCaption($view_school_lists_payments->year);
				$ExportDoc->ExportCaption($view_school_lists_payments->class);
				$ExportDoc->ExportCaption($view_school_lists_payments->program);
				$ExportDoc->ExportCaption($view_school_lists_payments->attendance_type);
				$ExportDoc->ExportCaption($view_school_lists_payments->grade_year_id);
				$ExportDoc->ExportCaption($view_school_lists_payments->school_attendance_school_attendance_id);
				$ExportDoc->ExportCaption($view_school_lists_payments->verified);
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
				$view_school_lists_payments->CssClass = "";
				$view_school_lists_payments->CssStyle = "";
				$view_school_lists_payments->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($view_school_lists_payments->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('student_firstname', $view_school_lists_payments->student_firstname->ExportValue($view_school_lists_payments->Export, $view_school_lists_payments->ExportOriginalValue));
					$XmlDoc->AddField('student_middlename', $view_school_lists_payments->student_middlename->ExportValue($view_school_lists_payments->Export, $view_school_lists_payments->ExportOriginalValue));
					$XmlDoc->AddField('student_lastname', $view_school_lists_payments->student_lastname->ExportValue($view_school_lists_payments->Export, $view_school_lists_payments->ExportOriginalValue));
					$XmlDoc->AddField('schools_school_id', $view_school_lists_payments->schools_school_id->ExportValue($view_school_lists_payments->Export, $view_school_lists_payments->ExportOriginalValue));
					$XmlDoc->AddField('year', $view_school_lists_payments->year->ExportValue($view_school_lists_payments->Export, $view_school_lists_payments->ExportOriginalValue));
					$XmlDoc->AddField('class', $view_school_lists_payments->class->ExportValue($view_school_lists_payments->Export, $view_school_lists_payments->ExportOriginalValue));
					$XmlDoc->AddField('program', $view_school_lists_payments->program->ExportValue($view_school_lists_payments->Export, $view_school_lists_payments->ExportOriginalValue));
					$XmlDoc->AddField('attendance_type', $view_school_lists_payments->attendance_type->ExportValue($view_school_lists_payments->Export, $view_school_lists_payments->ExportOriginalValue));
					$XmlDoc->AddField('grade_year_id', $view_school_lists_payments->grade_year_id->ExportValue($view_school_lists_payments->Export, $view_school_lists_payments->ExportOriginalValue));
					$XmlDoc->AddField('school_attendance_school_attendance_id', $view_school_lists_payments->school_attendance_school_attendance_id->ExportValue($view_school_lists_payments->Export, $view_school_lists_payments->ExportOriginalValue));
					$XmlDoc->AddField('verified', $view_school_lists_payments->verified->ExportValue($view_school_lists_payments->Export, $view_school_lists_payments->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($view_school_lists_payments->student_firstname);
					$ExportDoc->ExportField($view_school_lists_payments->student_middlename);
					$ExportDoc->ExportField($view_school_lists_payments->student_lastname);
					$ExportDoc->ExportField($view_school_lists_payments->schools_school_id);
					$ExportDoc->ExportField($view_school_lists_payments->year);
					$ExportDoc->ExportField($view_school_lists_payments->class);
					$ExportDoc->ExportField($view_school_lists_payments->program);
					$ExportDoc->ExportField($view_school_lists_payments->attendance_type);
					$ExportDoc->ExportField($view_school_lists_payments->grade_year_id);
					$ExportDoc->ExportField($view_school_lists_payments->school_attendance_school_attendance_id);
					$ExportDoc->ExportField($view_school_lists_payments->verified);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($view_school_lists_payments->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($view_school_lists_payments->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($view_school_lists_payments->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($view_school_lists_payments->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($view_school_lists_payments->ExportReturnUrl());
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
    // Example: 
    //$this->ListOptions->Add("new");
    //$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
    //$this->ListOptions->MoveItem("new", 0); // Move to first column
           $this->ListOptions->Add("Verified");                             
    $this->ListOptions->Items["Verified"]->OnLeft = FALSE; // Link on left
}

		// ListOptions Rendered event
function ListOptions_Rendered() {
    // Example: 
    //$this->ListOptions->Items["new"]->Body = "xxx";
    $this->ListOptions->Items["Verified"]->Body = "<a href='../Payslip_basic.php?StaffID2=".$GLOBALS["people"]->StaffID->CurrentValue."&theMonth=".$GLOBALS["people"]->theMonth->CurrentValue."&theYear=".$GLOBALS["people"]->theYear->CurrentValue."'>Verified</a>";
$this->ListOptions->Items["Verified"]->Body = "<a href='view_school_lists_paymentslist.php' onclick=\"return updateElm('setattendance.php?'\"".$GLOBALS["view_school_lists_payments"]->grage_year_id.", 'va');\" >Present</a> |";
//"<a href='view_school_lists_paymentslist.php' onclick='return updateElm('setattendance.php?'".$GLOBALS["view_school_lists_payments"]->grage_year_id.", 'va');' >Present</a> |"   
//<a href="view_school_lists_paymentslist.php" onclick="return updateElm('setattendance.php', 'va');" >Absent</a>
}                         


}
?>
