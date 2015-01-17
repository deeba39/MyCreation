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
$school_attendance_edit = new cschool_attendance_edit();
$Page =& $school_attendance_edit;

// Page init
$school_attendance_edit->Page_Init();

// Page main
$school_attendance_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var school_attendance_edit = new ew_Page("school_attendance_edit");

// page properties
school_attendance_edit.PageID = "edit"; // page ID
school_attendance_edit.FormID = "fschool_attendanceedit"; // form ID
var EW_PAGE_ID = school_attendance_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
school_attendance_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_start_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($school_attendance->start_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_end_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($school_attendance->end_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_schools_school_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($school_attendance->schools_school_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_entry_class"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($school_attendance->entry_class->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($school_attendance->group_id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
school_attendance_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
school_attendance_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
school_attendance_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $school_attendance->TableCaption() ?><br><br>
<a href="<?php echo $school_attendance->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$school_attendance_edit->ShowMessage();
?>
<form name="fschool_attendanceedit" id="fschool_attendanceedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return school_attendance_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="school_attendance">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($school_attendance->school_attendance_id->Visible) { // school_attendance_id ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->school_attendance_id->FldCaption() ?></td>
		<td<?php echo $school_attendance->school_attendance_id->CellAttributes() ?>><span id="el_school_attendance_id">
<div<?php echo $school_attendance->school_attendance_id->ViewAttributes() ?>><?php echo $school_attendance->school_attendance_id->EditValue ?></div><input type="hidden" name="x_school_attendance_id" id="x_school_attendance_id" value="<?php echo ew_HtmlEncode($school_attendance->school_attendance_id->CurrentValue) ?>">
</span><?php echo $school_attendance->school_attendance_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->start_date->Visible) { // start_date ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->start_date->FldCaption() ?></td>
		<td<?php echo $school_attendance->start_date->CellAttributes() ?>><span id="el_start_date">
<input type="text" name="x_start_date" id="x_start_date" title="<?php echo $school_attendance->start_date->FldTitle() ?>" value="<?php echo $school_attendance->start_date->EditValue ?>"<?php echo $school_attendance->start_date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_start_date" name="cal_x_start_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_start_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_start_date" // button id
});
</script>
</span><?php echo $school_attendance->start_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->end_date->Visible) { // end_date ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->end_date->FldCaption() ?></td>
		<td<?php echo $school_attendance->end_date->CellAttributes() ?>><span id="el_end_date">
<input type="text" name="x_end_date" id="x_end_date" title="<?php echo $school_attendance->end_date->FldTitle() ?>" value="<?php echo $school_attendance->end_date->EditValue ?>"<?php echo $school_attendance->end_date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_end_date" name="cal_x_end_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_end_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_end_date" // button id
});
</script>
</span><?php echo $school_attendance->end_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->schools_school_id->Visible) { // schools_school_id ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->schools_school_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $school_attendance->schools_school_id->CellAttributes() ?>><span id="el_schools_school_id">
<select id="x_schools_school_id" name="x_schools_school_id" title="<?php echo $school_attendance->schools_school_id->FldTitle() ?>"<?php echo $school_attendance->schools_school_id->EditAttributes() ?>>
<?php
if (is_array($school_attendance->schools_school_id->EditValue)) {
	$arwrk = $school_attendance->schools_school_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($school_attendance->schools_school_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $school_attendance->schools_school_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->entry_level->Visible) { // entry_level ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->entry_level->FldCaption() ?></td>
		<td<?php echo $school_attendance->entry_level->CellAttributes() ?>><span id="el_entry_level">
<div id="tp_x_entry_level" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_entry_level" id="x_entry_level" title="<?php echo $school_attendance->entry_level->FldTitle() ?>" value="{value}"<?php echo $school_attendance->entry_level->EditAttributes() ?>></label></div>
<div id="dsl_x_entry_level" repeatcolumn="5">
<?php
$arwrk = $school_attendance->entry_level->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($school_attendance->entry_level->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
</span><?php echo $school_attendance->entry_level->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->entry_class->Visible) { // entry_class ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->entry_class->FldCaption() ?></td>
		<td<?php echo $school_attendance->entry_class->CellAttributes() ?>><span id="el_entry_class">
<input type="text" name="x_entry_class" id="x_entry_class" title="<?php echo $school_attendance->entry_class->FldTitle() ?>" size="30" value="<?php echo $school_attendance->entry_class->EditValue ?>"<?php echo $school_attendance->entry_class->EditAttributes() ?>>
</span><?php echo $school_attendance->entry_class->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->sponsored_student_sponsored_student_id->Visible) { // sponsored_student_sponsored_student_id ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->sponsored_student_sponsored_student_id->FldCaption() ?></td>
		<td<?php echo $school_attendance->sponsored_student_sponsored_student_id->CellAttributes() ?>><span id="el_sponsored_student_sponsored_student_id">
<?php if ($school_attendance->sponsored_student_sponsored_student_id->getSessionValue() <> "") { ?>
<div<?php echo $school_attendance->sponsored_student_sponsored_student_id->ViewAttributes() ?>><?php echo $school_attendance->sponsored_student_sponsored_student_id->ViewValue ?></div>
<input type="hidden" id="x_sponsored_student_sponsored_student_id" name="x_sponsored_student_sponsored_student_id" value="<?php echo ew_HtmlEncode($school_attendance->sponsored_student_sponsored_student_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x_sponsored_student_sponsored_student_id" name="x_sponsored_student_sponsored_student_id" title="<?php echo $school_attendance->sponsored_student_sponsored_student_id->FldTitle() ?>"<?php echo $school_attendance->sponsored_student_sponsored_student_id->EditAttributes() ?>>
<?php
if (is_array($school_attendance->sponsored_student_sponsored_student_id->EditValue)) {
	$arwrk = $school_attendance->sponsored_student_sponsored_student_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($school_attendance->sponsored_student_sponsored_student_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
</span><?php echo $school_attendance->sponsored_student_sponsored_student_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->program->Visible) { // program ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->program->FldCaption() ?></td>
		<td<?php echo $school_attendance->program->CellAttributes() ?>><span id="el_program">
<input type="text" name="x_program" id="x_program" title="<?php echo $school_attendance->program->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $school_attendance->program->EditValue ?>"<?php echo $school_attendance->program->EditAttributes() ?>>
</span><?php echo $school_attendance->program->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->attendance_type->Visible) { // attendance_type ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->attendance_type->FldCaption() ?></td>
		<td<?php echo $school_attendance->attendance_type->CellAttributes() ?>><span id="el_attendance_type">
<div id="tp_x_attendance_type" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_attendance_type" id="x_attendance_type" title="<?php echo $school_attendance->attendance_type->FldTitle() ?>" value="{value}"<?php echo $school_attendance->attendance_type->EditAttributes() ?>></label></div>
<div id="dsl_x_attendance_type" repeatcolumn="5">
<?php
$arwrk = $school_attendance->attendance_type->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($school_attendance->attendance_type->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
</span><?php echo $school_attendance->attendance_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($school_attendance->group_id->Visible) { // group_id ?>
	<tr<?php echo $school_attendance->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_attendance->group_id->FldCaption() ?></td>
		<td<?php echo $school_attendance->group_id->CellAttributes() ?>><span id="el_group_id">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $school_attendance->group_id->FldTitle() ?>"<?php echo $school_attendance->group_id->EditAttributes() ?>>
<?php
if (is_array($school_attendance->group_id->EditValue)) {
	$arwrk = $school_attendance->group_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($school_attendance->group_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $school_attendance->group_id->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$school_attendance_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cschool_attendance_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'school_attendance';

	// Page object name
	var $PageObjName = 'school_attendance_edit';

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
	function cschool_attendance_edit() {
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
			define("EW_PAGE_ID", 'edit', TRUE);

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
		if (!$Security->CanEdit()) {
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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $school_attendance;

		// Load key from QueryString
		if (@$_GET["school_attendance_id"] <> "")
			$school_attendance->school_attendance_id->setQueryStringValue($_GET["school_attendance_id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$school_attendance->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$school_attendance->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$school_attendance->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$school_attendance->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($school_attendance->school_attendance_id->CurrentValue == "")
			$this->Page_Terminate("school_attendancelist.php"); // Invalid key, return to list
		switch ($school_attendance->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("school_attendancelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$school_attendance->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $school_attendance->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$school_attendance->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$school_attendance->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $school_attendance;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $school_attendance;
		$school_attendance->school_attendance_id->setFormValue($objForm->GetValue("x_school_attendance_id"));
		$school_attendance->start_date->setFormValue($objForm->GetValue("x_start_date"));
		$school_attendance->start_date->CurrentValue = ew_UnFormatDateTime($school_attendance->start_date->CurrentValue, 7);
		$school_attendance->end_date->setFormValue($objForm->GetValue("x_end_date"));
		$school_attendance->end_date->CurrentValue = ew_UnFormatDateTime($school_attendance->end_date->CurrentValue, 7);
		$school_attendance->schools_school_id->setFormValue($objForm->GetValue("x_schools_school_id"));
		$school_attendance->entry_level->setFormValue($objForm->GetValue("x_entry_level"));
		$school_attendance->entry_class->setFormValue($objForm->GetValue("x_entry_class"));
		$school_attendance->sponsored_student_sponsored_student_id->setFormValue($objForm->GetValue("x_sponsored_student_sponsored_student_id"));
		$school_attendance->program->setFormValue($objForm->GetValue("x_program"));
		$school_attendance->attendance_type->setFormValue($objForm->GetValue("x_attendance_type"));
		$school_attendance->group_id->setFormValue($objForm->GetValue("x_group_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $school_attendance;
		$this->LoadRow();
		$school_attendance->school_attendance_id->CurrentValue = $school_attendance->school_attendance_id->FormValue;
		$school_attendance->start_date->CurrentValue = $school_attendance->start_date->FormValue;
		$school_attendance->start_date->CurrentValue = ew_UnFormatDateTime($school_attendance->start_date->CurrentValue, 7);
		$school_attendance->end_date->CurrentValue = $school_attendance->end_date->FormValue;
		$school_attendance->end_date->CurrentValue = ew_UnFormatDateTime($school_attendance->end_date->CurrentValue, 7);
		$school_attendance->schools_school_id->CurrentValue = $school_attendance->schools_school_id->FormValue;
		$school_attendance->entry_level->CurrentValue = $school_attendance->entry_level->FormValue;
		$school_attendance->entry_class->CurrentValue = $school_attendance->entry_class->FormValue;
		$school_attendance->sponsored_student_sponsored_student_id->CurrentValue = $school_attendance->sponsored_student_sponsored_student_id->FormValue;
		$school_attendance->program->CurrentValue = $school_attendance->program->FormValue;
		$school_attendance->attendance_type->CurrentValue = $school_attendance->attendance_type->FormValue;
		$school_attendance->group_id->CurrentValue = $school_attendance->group_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $school_attendance;
		$sFilter = $school_attendance->KeyFilter();

		// Call Row Selecting event
		$school_attendance->Row_Selecting($sFilter);

		// Load SQL based on filter
		$school_attendance->CurrentFilter = $sFilter;
		$sSql = $school_attendance->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$school_attendance->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $school_attendance;
		$school_attendance->school_attendance_id->setDbValue($rs->fields('school_attendance_id'));
		$school_attendance->start_date->setDbValue($rs->fields('start_date'));
		$school_attendance->end_date->setDbValue($rs->fields('end_date'));
		$school_attendance->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$school_attendance->entry_level->setDbValue($rs->fields('entry_level'));
		$school_attendance->entry_class->setDbValue($rs->fields('entry_class'));
		$school_attendance->sponsored_student_sponsored_student_id->setDbValue($rs->fields('sponsored_student_sponsored_student_id'));
		$school_attendance->program->setDbValue($rs->fields('program'));
		$school_attendance->attendance_type->setDbValue($rs->fields('attendance_type'));
		$school_attendance->group_id->setDbValue($rs->fields('group_id'));
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
		} elseif ($school_attendance->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// school_attendance_id
			$school_attendance->school_attendance_id->EditCustomAttributes = "";
			$school_attendance->school_attendance_id->EditValue = $school_attendance->school_attendance_id->CurrentValue;
			$school_attendance->school_attendance_id->CssStyle = "";
			$school_attendance->school_attendance_id->CssClass = "";
			$school_attendance->school_attendance_id->ViewCustomAttributes = "";

			// start_date
			$school_attendance->start_date->EditCustomAttributes = "";
			$school_attendance->start_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($school_attendance->start_date->CurrentValue, 7));

			// end_date
			$school_attendance->end_date->EditCustomAttributes = "";
			$school_attendance->end_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($school_attendance->end_date->CurrentValue, 7));

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
			$school_attendance->entry_class->EditValue = ew_HtmlEncode($school_attendance->entry_class->CurrentValue);

			// sponsored_student_sponsored_student_id
			$school_attendance->sponsored_student_sponsored_student_id->EditCustomAttributes = "";
			if ($school_attendance->sponsored_student_sponsored_student_id->getSessionValue() <> "") {
				$school_attendance->sponsored_student_sponsored_student_id->CurrentValue = $school_attendance->sponsored_student_sponsored_student_id->getSessionValue();
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
			} else {
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
			}

			// program
			$school_attendance->program->EditCustomAttributes = "";
			$school_attendance->program->EditValue = ew_HtmlEncode($school_attendance->program->CurrentValue);

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
			$school_attendance->group_id->EditValue = ew_HtmlEncode($school_attendance->group_id->CurrentValue);
			}

			// Edit refer script
			// school_attendance_id

			$school_attendance->school_attendance_id->HrefValue = "";

			// start_date
			$school_attendance->start_date->HrefValue = "";

			// end_date
			$school_attendance->end_date->HrefValue = "";

			// schools_school_id
			$school_attendance->schools_school_id->HrefValue = "";

			// entry_level
			$school_attendance->entry_level->HrefValue = "";

			// entry_class
			$school_attendance->entry_class->HrefValue = "";

			// sponsored_student_sponsored_student_id
			$school_attendance->sponsored_student_sponsored_student_id->HrefValue = "";

			// program
			$school_attendance->program->HrefValue = "";

			// attendance_type
			$school_attendance->attendance_type->HrefValue = "";

			// group_id
			$school_attendance->group_id->HrefValue = "";
		}

		// Call Row Rendered event
		if ($school_attendance->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$school_attendance->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $school_attendance;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckEuroDate($school_attendance->start_date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $school_attendance->start_date->FldErrMsg();
		}
		if (!ew_CheckEuroDate($school_attendance->end_date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $school_attendance->end_date->FldErrMsg();
		}
		if (!is_null($school_attendance->schools_school_id->FormValue) && $school_attendance->schools_school_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $school_attendance->schools_school_id->FldCaption();
		}
		if (!ew_CheckInteger($school_attendance->entry_class->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $school_attendance->entry_class->FldErrMsg();
		}
		if (!ew_CheckInteger($school_attendance->group_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $school_attendance->group_id->FldErrMsg();
		}

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
		global $conn, $Security, $Language, $school_attendance;
		$sFilter = $school_attendance->KeyFilter();
		$school_attendance->CurrentFilter = $sFilter;
		$sSql = $school_attendance->SQL();
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

			// start_date
			$school_attendance->start_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($school_attendance->start_date->CurrentValue, 7, FALSE), NULL);

			// end_date
			$school_attendance->end_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($school_attendance->end_date->CurrentValue, 7, FALSE), NULL);

			// schools_school_id
			$school_attendance->schools_school_id->SetDbValueDef($rsnew, $school_attendance->schools_school_id->CurrentValue, NULL, FALSE);

			// entry_level
			$school_attendance->entry_level->SetDbValueDef($rsnew, $school_attendance->entry_level->CurrentValue, NULL, FALSE);

			// entry_class
			$school_attendance->entry_class->SetDbValueDef($rsnew, $school_attendance->entry_class->CurrentValue, NULL, FALSE);

			// sponsored_student_sponsored_student_id
			$school_attendance->sponsored_student_sponsored_student_id->SetDbValueDef($rsnew, $school_attendance->sponsored_student_sponsored_student_id->CurrentValue, NULL, FALSE);

			// program
			$school_attendance->program->SetDbValueDef($rsnew, $school_attendance->program->CurrentValue, NULL, FALSE);

			// attendance_type
			$school_attendance->attendance_type->SetDbValueDef($rsnew, $school_attendance->attendance_type->CurrentValue, NULL, FALSE);

			// group_id
			$school_attendance->group_id->SetDbValueDef($rsnew, $school_attendance->group_id->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $school_attendance->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($school_attendance->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($school_attendance->CancelMessage <> "") {
					$this->setMessage($school_attendance->CancelMessage);
					$school_attendance->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$school_attendance->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $school_attendance;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "sponsored_student") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $school_attendance->SqlMasterFilter_sponsored_student();
				$this->sDbDetailFilter = $school_attendance->SqlDetailFilter_sponsored_student();
				if (@$_GET["sponsored_student_id"] <> "") {
					$GLOBALS["sponsored_student"]->sponsored_student_id->setQueryStringValue($_GET["sponsored_student_id"]);
					$school_attendance->sponsored_student_sponsored_student_id->setQueryStringValue($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue);
					$school_attendance->sponsored_student_sponsored_student_id->setSessionValue($school_attendance->sponsored_student_sponsored_student_id->QueryStringValue);
					if (!is_numeric($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@sponsored_student_sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
			if ($sMasterTblVar == "sponsored_student_detail") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $school_attendance->SqlMasterFilter_sponsored_student_detail();
				$this->sDbDetailFilter = $school_attendance->SqlDetailFilter_sponsored_student_detail();
				if (@$_GET["sponsored_student_id"] <> "") {
					$GLOBALS["sponsored_student_detail"]->sponsored_student_id->setQueryStringValue($_GET["sponsored_student_id"]);
					$school_attendance->sponsored_student_sponsored_student_id->setQueryStringValue($GLOBALS["sponsored_student_detail"]->sponsored_student_id->QueryStringValue);
					$school_attendance->sponsored_student_sponsored_student_id->setSessionValue($school_attendance->sponsored_student_sponsored_student_id->QueryStringValue);
					if (!is_numeric($GLOBALS["sponsored_student_detail"]->sponsored_student_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student_detail"]->sponsored_student_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@sponsored_student_sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student_detail"]->sponsored_student_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$school_attendance->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$school_attendance->setStartRecordNumber($this->lStartRec);
			$school_attendance->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$school_attendance->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "sponsored_student") {
				if ($school_attendance->sponsored_student_sponsored_student_id->QueryStringValue == "") $school_attendance->sponsored_student_sponsored_student_id->setSessionValue("");
			}
			if ($sMasterTblVar <> "sponsored_student_detail") {
				if ($school_attendance->sponsored_student_sponsored_student_id->QueryStringValue == "") $school_attendance->sponsored_student_sponsored_student_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $school_attendance->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $school_attendance->getDetailFilter(); // Restore detail filter
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'school_attendance';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $school_attendance;
		$table = 'school_attendance';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['school_attendance_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if ($school_attendance->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($school_attendance->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($school_attendance->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} elseif ($school_attendance->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "<XML>";
						$newvalue = "<XML>";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
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
}
?>
