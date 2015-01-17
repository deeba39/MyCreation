<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "school_attendanceinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "sponsored_student_detailinfo.php" ?>
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
$school_attendance_search = new cschool_attendance_search();
$Page =& $school_attendance_search;

// Page init
$school_attendance_search->Page_Init();

// Page main
$school_attendance_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var school_attendance_search = new ew_Page("school_attendance_search");

// page properties
school_attendance_search.PageID = "search"; // page ID
school_attendance_search.FormID = "fschool_attendancesearch"; // form ID
var EW_PAGE_ID = school_attendance_search.PageID; // for backward compatibility

// extend page with validate function for search
school_attendance_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_school_attendance_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($school_attendance->school_attendance_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_start_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($school_attendance->start_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_end_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($school_attendance->end_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_entry_class"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($school_attendance->entry_class->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($school_attendance->group_id->FldErrMsg()) ?>");

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
school_attendance_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
school_attendance_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
school_attendance_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $school_attendance->TableCaption() ?><br><br>
<a href="<?php echo $school_attendance->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$school_attendance_search->ShowMessage();
?>
<form name="fschool_attendancesearch" id="fschool_attendancesearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return school_attendance_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="school_attendance">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->school_attendance_id->FldCaption() ?></td>
		<td<?php echo $school_attendance->school_attendance_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_school_attendance_id" id="z_school_attendance_id" value="="></span></td>
		<td<?php echo $school_attendance->school_attendance_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_school_attendance_id" id="x_school_attendance_id" title="<?php echo $school_attendance->school_attendance_id->FldTitle() ?>" value="<?php echo $school_attendance->school_attendance_id->EditValue ?>"<?php echo $school_attendance->school_attendance_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->start_date->FldCaption() ?></td>
		<td<?php echo $school_attendance->start_date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_start_date" id="z_start_date" value="="></span></td>
		<td<?php echo $school_attendance->start_date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_start_date" id="x_start_date" title="<?php echo $school_attendance->start_date->FldTitle() ?>" value="<?php echo $school_attendance->start_date->EditValue ?>"<?php echo $school_attendance->start_date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_start_date" name="cal_x_start_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_start_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_start_date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->end_date->FldCaption() ?></td>
		<td<?php echo $school_attendance->end_date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_end_date" id="z_end_date" value="="></span></td>
		<td<?php echo $school_attendance->end_date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_end_date" id="x_end_date" title="<?php echo $school_attendance->end_date->FldTitle() ?>" value="<?php echo $school_attendance->end_date->EditValue ?>"<?php echo $school_attendance->end_date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_end_date" name="cal_x_end_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_end_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_end_date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->schools_school_id->FldCaption() ?></td>
		<td<?php echo $school_attendance->schools_school_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_schools_school_id" id="z_schools_school_id" value="="></span></td>
		<td<?php echo $school_attendance->schools_school_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_schools_school_id" name="x_schools_school_id" title="<?php echo $school_attendance->schools_school_id->FldTitle() ?>"<?php echo $school_attendance->schools_school_id->EditAttributes() ?>>
<?php
if (is_array($school_attendance->schools_school_id->EditValue)) {
	$arwrk = $school_attendance->schools_school_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($school_attendance->schools_school_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->entry_level->FldCaption() ?></td>
		<td<?php echo $school_attendance->entry_level->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_entry_level" id="z_entry_level" value="="></span></td>
		<td<?php echo $school_attendance->entry_level->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_entry_level" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_entry_level" id="x_entry_level" title="<?php echo $school_attendance->entry_level->FldTitle() ?>" value="{value}"<?php echo $school_attendance->entry_level->EditAttributes() ?>></label></div>
<div id="dsl_x_entry_level" repeatcolumn="5">
<?php
$arwrk = $school_attendance->entry_level->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($school_attendance->entry_level->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_entry_level" id="x_entry_level" title="<?php echo $school_attendance->entry_level->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $school_attendance->entry_level->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->entry_class->FldCaption() ?></td>
		<td<?php echo $school_attendance->entry_class->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_entry_class" id="z_entry_class" value="="></span></td>
		<td<?php echo $school_attendance->entry_class->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_entry_class" id="x_entry_class" title="<?php echo $school_attendance->entry_class->FldTitle() ?>" size="30" value="<?php echo $school_attendance->entry_class->EditValue ?>"<?php echo $school_attendance->entry_class->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->sponsored_student_sponsored_student_id->FldCaption() ?></td>
		<td<?php echo $school_attendance->sponsored_student_sponsored_student_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_sponsored_student_sponsored_student_id" id="z_sponsored_student_sponsored_student_id" value="="></span></td>
		<td<?php echo $school_attendance->sponsored_student_sponsored_student_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_sponsored_student_sponsored_student_id" name="x_sponsored_student_sponsored_student_id" title="<?php echo $school_attendance->sponsored_student_sponsored_student_id->FldTitle() ?>"<?php echo $school_attendance->sponsored_student_sponsored_student_id->EditAttributes() ?>>
<?php
if (is_array($school_attendance->sponsored_student_sponsored_student_id->EditValue)) {
	$arwrk = $school_attendance->sponsored_student_sponsored_student_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($school_attendance->sponsored_student_sponsored_student_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
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
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->program->FldCaption() ?></td>
		<td<?php echo $school_attendance->program->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_program" id="z_program" value="LIKE"></span></td>
		<td<?php echo $school_attendance->program->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_program" id="x_program" title="<?php echo $school_attendance->program->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $school_attendance->program->EditValue ?>"<?php echo $school_attendance->program->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->attendance_type->FldCaption() ?></td>
		<td<?php echo $school_attendance->attendance_type->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_attendance_type" id="z_attendance_type" value="="></span></td>
		<td<?php echo $school_attendance->attendance_type->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_attendance_type" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_attendance_type" id="x_attendance_type" title="<?php echo $school_attendance->attendance_type->FldTitle() ?>" value="{value}"<?php echo $school_attendance->attendance_type->EditAttributes() ?>></label></div>
<div id="dsl_x_attendance_type" repeatcolumn="5">
<?php
$arwrk = $school_attendance->attendance_type->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($school_attendance->attendance_type->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_attendance_type" id="x_attendance_type" title="<?php echo $school_attendance->attendance_type->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $school_attendance->attendance_type->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->group_id->FldCaption() ?></td>
		<td<?php echo $school_attendance->group_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_group_id" id="z_group_id" value="="></span></td>
		<td<?php echo $school_attendance->group_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $school_attendance->group_id->FldTitle() ?>"<?php echo $school_attendance->group_id->EditAttributes() ?>>
<?php
if (is_array($school_attendance->group_id->EditValue)) {
	$arwrk = $school_attendance->group_id->EditValue;
	if ($arwrk[0][0] <> "") echo "<option value=\"\">" . $Language->Phrase("PleaseSelect") . "</option>";
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($school_attendance->group_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } else { ?>
<input type="text" name="x_group_id" id="x_group_id" title="<?php echo $school_attendance->group_id->FldTitle() ?>" size="30" value="<?php echo $school_attendance->group_id->EditValue ?>"<?php echo $school_attendance->group_id->EditAttributes() ?>>
<?php } ?>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$school_attendance_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cschool_attendance_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'school_attendance';

	// Page object name
	var $PageObjName = 'school_attendance_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $school_attendance;
		if ($school_attendance->UseTokenInUrl) $PageUrl .= "t=" . $school_attendance->TableVar . "&"; // Add page token
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
		global $objForm, $school_attendance;
		if ($school_attendance->UseTokenInUrl) {
			if ($objForm)
				return ($school_attendance->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($school_attendance->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cschool_attendance_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (school_attendance)
		$GLOBALS["school_attendance"] = new cschool_attendance();

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (sponsored_student_detail)
		$GLOBALS['sponsored_student_detail'] = new csponsored_student_detail();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'school_attendance', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $school_attendance;

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
		if (!$Security->CanSearch()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("school_attendancelist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("school_attendancelist.php");
		}

		// Create form object
		$objForm = new cFormObj();

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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $school_attendance;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$school_attendance->CurrentAction = $objForm->GetValue("a_search");
			switch ($school_attendance->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $school_attendance->UrlParm($sSrchStr);
						$this->Page_Terminate("school_attendancelist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$school_attendance->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $school_attendance;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $school_attendance->school_attendance_id); // school_attendance_id
	$this->BuildSearchUrl($sSrchUrl, $school_attendance->start_date); // start_date
	$this->BuildSearchUrl($sSrchUrl, $school_attendance->end_date); // end_date
	$this->BuildSearchUrl($sSrchUrl, $school_attendance->schools_school_id); // schools_school_id
	$this->BuildSearchUrl($sSrchUrl, $school_attendance->entry_level); // entry_level
	$this->BuildSearchUrl($sSrchUrl, $school_attendance->entry_class); // entry_class
	$this->BuildSearchUrl($sSrchUrl, $school_attendance->sponsored_student_sponsored_student_id); // sponsored_student_sponsored_student_id
	$this->BuildSearchUrl($sSrchUrl, $school_attendance->program); // program
	$this->BuildSearchUrl($sSrchUrl, $school_attendance->attendance_type); // attendance_type
	$this->BuildSearchUrl($sSrchUrl, $school_attendance->group_id); // group_id
	return $sSrchUrl;
}

// Build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

// Convert search value for date
function ConvertSearchValue(&$Fld, $FldVal) {
	$Value = $FldVal;
	if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
		$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
	return $Value;
}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $school_attendance;

		// Load search values
		// school_attendance_id

		$school_attendance->school_attendance_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_school_attendance_id"));
		$school_attendance->school_attendance_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_school_attendance_id");

		// start_date
		$school_attendance->start_date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_start_date"));
		$school_attendance->start_date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_start_date");

		// end_date
		$school_attendance->end_date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_end_date"));
		$school_attendance->end_date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_end_date");

		// schools_school_id
		$school_attendance->schools_school_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_schools_school_id"));
		$school_attendance->schools_school_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_schools_school_id");

		// entry_level
		$school_attendance->entry_level->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_entry_level"));
		$school_attendance->entry_level->AdvancedSearch->SearchOperator = $objForm->GetValue("z_entry_level");

		// entry_class
		$school_attendance->entry_class->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_entry_class"));
		$school_attendance->entry_class->AdvancedSearch->SearchOperator = $objForm->GetValue("z_entry_class");

		// sponsored_student_sponsored_student_id
		$school_attendance->sponsored_student_sponsored_student_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_sponsored_student_sponsored_student_id"));
		$school_attendance->sponsored_student_sponsored_student_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_sponsored_student_sponsored_student_id");

		// program
		$school_attendance->program->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_program"));
		$school_attendance->program->AdvancedSearch->SearchOperator = $objForm->GetValue("z_program");

		// attendance_type
		$school_attendance->attendance_type->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_attendance_type"));
		$school_attendance->attendance_type->AdvancedSearch->SearchOperator = $objForm->GetValue("z_attendance_type");

		// group_id
		$school_attendance->group_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_group_id"));
		$school_attendance->group_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_group_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $school_attendance;

		// Initialize URLs
		// Call Row_Rendering event

		$school_attendance->Row_Rendering();

		// Common render codes for all row types
		// school_attendance_id

		$school_attendance->school_attendance_id->CellCssStyle = ""; $school_attendance->school_attendance_id->CellCssClass = "";
		$school_attendance->school_attendance_id->CellAttrs = array(); $school_attendance->school_attendance_id->ViewAttrs = array(); $school_attendance->school_attendance_id->EditAttrs = array();

		// start_date
		$school_attendance->start_date->CellCssStyle = ""; $school_attendance->start_date->CellCssClass = "";
		$school_attendance->start_date->CellAttrs = array(); $school_attendance->start_date->ViewAttrs = array(); $school_attendance->start_date->EditAttrs = array();

		// end_date
		$school_attendance->end_date->CellCssStyle = ""; $school_attendance->end_date->CellCssClass = "";
		$school_attendance->end_date->CellAttrs = array(); $school_attendance->end_date->ViewAttrs = array(); $school_attendance->end_date->EditAttrs = array();

		// schools_school_id
		$school_attendance->schools_school_id->CellCssStyle = ""; $school_attendance->schools_school_id->CellCssClass = "";
		$school_attendance->schools_school_id->CellAttrs = array(); $school_attendance->schools_school_id->ViewAttrs = array(); $school_attendance->schools_school_id->EditAttrs = array();

		// entry_level
		$school_attendance->entry_level->CellCssStyle = ""; $school_attendance->entry_level->CellCssClass = "";
		$school_attendance->entry_level->CellAttrs = array(); $school_attendance->entry_level->ViewAttrs = array(); $school_attendance->entry_level->EditAttrs = array();

		// entry_class
		$school_attendance->entry_class->CellCssStyle = ""; $school_attendance->entry_class->CellCssClass = "";
		$school_attendance->entry_class->CellAttrs = array(); $school_attendance->entry_class->ViewAttrs = array(); $school_attendance->entry_class->EditAttrs = array();

		// sponsored_student_sponsored_student_id
		$school_attendance->sponsored_student_sponsored_student_id->CellCssStyle = ""; $school_attendance->sponsored_student_sponsored_student_id->CellCssClass = "";
		$school_attendance->sponsored_student_sponsored_student_id->CellAttrs = array(); $school_attendance->sponsored_student_sponsored_student_id->ViewAttrs = array(); $school_attendance->sponsored_student_sponsored_student_id->EditAttrs = array();

		// program
		$school_attendance->program->CellCssStyle = ""; $school_attendance->program->CellCssClass = "";
		$school_attendance->program->CellAttrs = array(); $school_attendance->program->ViewAttrs = array(); $school_attendance->program->EditAttrs = array();

		// attendance_type
		$school_attendance->attendance_type->CellCssStyle = ""; $school_attendance->attendance_type->CellCssClass = "";
		$school_attendance->attendance_type->CellAttrs = array(); $school_attendance->attendance_type->ViewAttrs = array(); $school_attendance->attendance_type->EditAttrs = array();

		// group_id
		$school_attendance->group_id->CellCssStyle = ""; $school_attendance->group_id->CellCssClass = "";
		$school_attendance->group_id->CellAttrs = array(); $school_attendance->group_id->ViewAttrs = array(); $school_attendance->group_id->EditAttrs = array();
		if ($school_attendance->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_attendance_id
			$school_attendance->school_attendance_id->ViewValue = $school_attendance->school_attendance_id->CurrentValue;
			$school_attendance->school_attendance_id->CssStyle = "";
			$school_attendance->school_attendance_id->CssClass = "";
			$school_attendance->school_attendance_id->ViewCustomAttributes = "";

			// start_date
			$school_attendance->start_date->ViewValue = $school_attendance->start_date->CurrentValue;
			$school_attendance->start_date->ViewValue = ew_FormatDateTime($school_attendance->start_date->ViewValue, 7);
			$school_attendance->start_date->CssStyle = "";
			$school_attendance->start_date->CssClass = "";
			$school_attendance->start_date->ViewCustomAttributes = "";

			// end_date
			$school_attendance->end_date->ViewValue = $school_attendance->end_date->CurrentValue;
			$school_attendance->end_date->ViewValue = ew_FormatDateTime($school_attendance->end_date->ViewValue, 7);
			$school_attendance->end_date->CssStyle = "";
			$school_attendance->end_date->CssClass = "";
			$school_attendance->end_date->ViewCustomAttributes = "";

			// schools_school_id
			if (strval($school_attendance->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($school_attendance->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$school_attendance->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$school_attendance->schools_school_id->ViewValue = $school_attendance->schools_school_id->CurrentValue;
				}
			} else {
				$school_attendance->schools_school_id->ViewValue = NULL;
			}
			$school_attendance->schools_school_id->CssStyle = "";
			$school_attendance->schools_school_id->CssClass = "";
			$school_attendance->schools_school_id->ViewCustomAttributes = "";

			// entry_level
			if (strval($school_attendance->entry_level->CurrentValue) <> "") {
				switch ($school_attendance->entry_level->CurrentValue) {
					case "SSS":
						$school_attendance->entry_level->ViewValue = "SSS";
						break;
					case "TERTIARY":
						$school_attendance->entry_level->ViewValue = "TERTIARY";
						break;
					case "JSS":
						$school_attendance->entry_level->ViewValue = "JSS";
						break;
					case "PRIMARY":
						$school_attendance->entry_level->ViewValue = "PRIMARY";
						break;
					default:
						$school_attendance->entry_level->ViewValue = $school_attendance->entry_level->CurrentValue;
				}
			} else {
				$school_attendance->entry_level->ViewValue = NULL;
			}
			$school_attendance->entry_level->CssStyle = "";
			$school_attendance->entry_level->CssClass = "";
			$school_attendance->entry_level->ViewCustomAttributes = "";

			// entry_class
			$school_attendance->entry_class->ViewValue = $school_attendance->entry_class->CurrentValue;
			$school_attendance->entry_class->CssStyle = "";
			$school_attendance->entry_class->CssClass = "";
			$school_attendance->entry_class->ViewCustomAttributes = "";

			// sponsored_student_sponsored_student_id
			if (strval($school_attendance->sponsored_student_sponsored_student_id->CurrentValue) <> "") {
				$sFilterWrk = "`sponsored_student_id` = " . ew_AdjustSql($school_attendance->sponsored_student_sponsored_student_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `student_lastname`, `student_firstname` FROM `sponsored_student`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$school_attendance->sponsored_student_sponsored_student_id->ViewValue = $rswrk->fields('student_lastname');
					$school_attendance->sponsored_student_sponsored_student_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('student_firstname');
					$rswrk->Close();
				} else {
					$school_attendance->sponsored_student_sponsored_student_id->ViewValue = $school_attendance->sponsored_student_sponsored_student_id->CurrentValue;
				}
			} else {
				$school_attendance->sponsored_student_sponsored_student_id->ViewValue = NULL;
			}
			$school_attendance->sponsored_student_sponsored_student_id->CssStyle = "";
			$school_attendance->sponsored_student_sponsored_student_id->CssClass = "";
			$school_attendance->sponsored_student_sponsored_student_id->ViewCustomAttributes = "";

			// program
			$school_attendance->program->ViewValue = $school_attendance->program->CurrentValue;
			$school_attendance->program->CssStyle = "";
			$school_attendance->program->CssClass = "";
			$school_attendance->program->ViewCustomAttributes = "";

			// attendance_type
			if (strval($school_attendance->attendance_type->CurrentValue) <> "") {
				switch ($school_attendance->attendance_type->CurrentValue) {
					case "BOARDER":
						$school_attendance->attendance_type->ViewValue = "BOARDER";
						break;
					case "DAY":
						$school_attendance->attendance_type->ViewValue = "DAY";
						break;
					default:
						$school_attendance->attendance_type->ViewValue = $school_attendance->attendance_type->CurrentValue;
				}
			} else {
				$school_attendance->attendance_type->ViewValue = NULL;
			}
			$school_attendance->attendance_type->CssStyle = "";
			$school_attendance->attendance_type->CssClass = "";
			$school_attendance->attendance_type->ViewCustomAttributes = "";

			// group_id
			$school_attendance->group_id->ViewValue = $school_attendance->group_id->CurrentValue;
			$school_attendance->group_id->CssStyle = "";
			$school_attendance->group_id->CssClass = "";
			$school_attendance->group_id->ViewCustomAttributes = "";

			// school_attendance_id
			$school_attendance->school_attendance_id->HrefValue = "";
			$school_attendance->school_attendance_id->TooltipValue = "";

			// start_date
			$school_attendance->start_date->HrefValue = "";
			$school_attendance->start_date->TooltipValue = "";

			// end_date
			$school_attendance->end_date->HrefValue = "";
			$school_attendance->end_date->TooltipValue = "";

			// schools_school_id
			$school_attendance->schools_school_id->HrefValue = "";
			$school_attendance->schools_school_id->TooltipValue = "";

			// entry_level
			$school_attendance->entry_level->HrefValue = "";
			$school_attendance->entry_level->TooltipValue = "";

			// entry_class
			$school_attendance->entry_class->HrefValue = "";
			$school_attendance->entry_class->TooltipValue = "";

			// sponsored_student_sponsored_student_id
			$school_attendance->sponsored_student_sponsored_student_id->HrefValue = "";
			$school_attendance->sponsored_student_sponsored_student_id->TooltipValue = "";

			// program
			$school_attendance->program->HrefValue = "";
			$school_attendance->program->TooltipValue = "";

			// attendance_type
			$school_attendance->attendance_type->HrefValue = "";
			$school_attendance->attendance_type->TooltipValue = "";

			// group_id
			$school_attendance->group_id->HrefValue = "";
			$school_attendance->group_id->TooltipValue = "";
		} elseif ($school_attendance->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// school_attendance_id
			$school_attendance->school_attendance_id->EditCustomAttributes = "";
			$school_attendance->school_attendance_id->EditValue = ew_HtmlEncode($school_attendance->school_attendance_id->AdvancedSearch->SearchValue);

			// start_date
			$school_attendance->start_date->EditCustomAttributes = "";
			$school_attendance->start_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($school_attendance->start_date->AdvancedSearch->SearchValue, 7), 7));

			// end_date
			$school_attendance->end_date->EditCustomAttributes = "";
			$school_attendance->end_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($school_attendance->end_date->AdvancedSearch->SearchValue, 7), 7));

			// schools_school_id
			$school_attendance->schools_school_id->EditCustomAttributes = "";
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
			$school_attendance->schools_school_id->EditValue = $arwrk;

			// entry_level
			$school_attendance->entry_level->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("SSS", "SSS");
			$arwrk[] = array("TERTIARY", "TERTIARY");
			$arwrk[] = array("JSS", "JSS");
			$arwrk[] = array("PRIMARY", "PRIMARY");
			$school_attendance->entry_level->EditValue = $arwrk;

			// entry_class
			$school_attendance->entry_class->EditCustomAttributes = "";
			$school_attendance->entry_class->EditValue = ew_HtmlEncode($school_attendance->entry_class->AdvancedSearch->SearchValue);

			// sponsored_student_sponsored_student_id
			$school_attendance->sponsored_student_sponsored_student_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `sponsored_student_id`, `student_lastname`, `student_firstname`, '' AS SelectFilterFld FROM `sponsored_student`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			$sWhereWrk = $GLOBALS["sponsored_student"]->AddUserIDFilter($sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$school_attendance->sponsored_student_sponsored_student_id->EditValue = $arwrk;

			// program
			$school_attendance->program->EditCustomAttributes = "";
			$school_attendance->program->EditValue = ew_HtmlEncode($school_attendance->program->AdvancedSearch->SearchValue);

			// attendance_type
			$school_attendance->attendance_type->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("BOARDER", "BOARDER");
			$arwrk[] = array("DAY", "DAY");
			$school_attendance->attendance_type->EditValue = $arwrk;

			// group_id
			$school_attendance->group_id->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
			$sFilterWrk = "";
			$sFilterWrk = $GLOBALS["users"]->AddUserIDFilter("");
			$sSqlWrk = "SELECT `userlevelid`, `userlevelid` FROM `users`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$school_attendance->group_id->EditValue = $arwrk;
			} else {
			$school_attendance->group_id->EditValue = ew_HtmlEncode($school_attendance->group_id->AdvancedSearch->SearchValue);
			}
		}

		// Call Row Rendered event
		if ($school_attendance->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$school_attendance->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $school_attendance;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($school_attendance->school_attendance_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $school_attendance->school_attendance_id->FldErrMsg();
		}
		if (!ew_CheckEuroDate($school_attendance->start_date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $school_attendance->start_date->FldErrMsg();
		}
		if (!ew_CheckEuroDate($school_attendance->end_date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $school_attendance->end_date->FldErrMsg();
		}
		if (!ew_CheckInteger($school_attendance->entry_class->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $school_attendance->entry_class->FldErrMsg();
		}
		if (!ew_CheckInteger($school_attendance->group_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $school_attendance->group_id->FldErrMsg();
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

	// Load advanced search
	function LoadAdvancedSearch() {
		global $school_attendance;
		$school_attendance->school_attendance_id->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_school_attendance_id");
		$school_attendance->start_date->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_start_date");
		$school_attendance->end_date->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_end_date");
		$school_attendance->schools_school_id->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_schools_school_id");
		$school_attendance->entry_level->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_entry_level");
		$school_attendance->entry_class->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_entry_class");
		$school_attendance->sponsored_student_sponsored_student_id->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_sponsored_student_sponsored_student_id");
		$school_attendance->program->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_program");
		$school_attendance->attendance_type->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_attendance_type");
		$school_attendance->group_id->AdvancedSearch->SearchValue = $school_attendance->getAdvancedSearch("x_group_id");
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
}
?>
