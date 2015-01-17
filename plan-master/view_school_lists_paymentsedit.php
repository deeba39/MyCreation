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
$view_school_lists_payments_edit = new cview_school_lists_payments_edit();
$Page =& $view_school_lists_payments_edit;

// Page init
$view_school_lists_payments_edit->Page_Init();

// Page main
$view_school_lists_payments_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var view_school_lists_payments_edit = new ew_Page("view_school_lists_payments_edit");

// page properties
view_school_lists_payments_edit.PageID = "edit"; // page ID
view_school_lists_payments_edit.FormID = "fview_school_lists_paymentsedit"; // form ID
var EW_PAGE_ID = view_school_lists_payments_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
view_school_lists_payments_edit.ValidateForm = function(fobj) {
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

// extend page with Form_CustomValidate function
view_school_lists_payments_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
view_school_lists_payments_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
view_school_lists_payments_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $view_school_lists_payments->TableCaption() ?><br><br>
<a href="<?php echo $view_school_lists_payments->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$view_school_lists_payments_edit->ShowMessage();
?>
<form name="fview_school_lists_paymentsedit" id="fview_school_lists_paymentsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return view_school_lists_payments_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="view_school_lists_payments">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($view_school_lists_payments->student_firstname->Visible) { // student_firstname ?>
	<tr<?php echo $view_school_lists_payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $view_school_lists_payments->student_firstname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $view_school_lists_payments->student_firstname->CellAttributes() ?>><span id="el_student_firstname">
<div<?php echo $view_school_lists_payments->student_firstname->ViewAttributes() ?>><?php echo $view_school_lists_payments->student_firstname->EditValue ?></div><input type="hidden" name="x_student_firstname" id="x_student_firstname" value="<?php echo ew_HtmlEncode($view_school_lists_payments->student_firstname->CurrentValue) ?>">
</span><?php echo $view_school_lists_payments->student_firstname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($view_school_lists_payments->student_middlename->Visible) { // student_middlename ?>
	<tr<?php echo $view_school_lists_payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $view_school_lists_payments->student_middlename->FldCaption() ?></td>
		<td<?php echo $view_school_lists_payments->student_middlename->CellAttributes() ?>><span id="el_student_middlename">
<div<?php echo $view_school_lists_payments->student_middlename->ViewAttributes() ?>><?php echo $view_school_lists_payments->student_middlename->EditValue ?></div><input type="hidden" name="x_student_middlename" id="x_student_middlename" value="<?php echo ew_HtmlEncode($view_school_lists_payments->student_middlename->CurrentValue) ?>">
</span><?php echo $view_school_lists_payments->student_middlename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($view_school_lists_payments->student_lastname->Visible) { // student_lastname ?>
	<tr<?php echo $view_school_lists_payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $view_school_lists_payments->student_lastname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $view_school_lists_payments->student_lastname->CellAttributes() ?>><span id="el_student_lastname">
<div<?php echo $view_school_lists_payments->student_lastname->ViewAttributes() ?>><?php echo $view_school_lists_payments->student_lastname->EditValue ?></div><input type="hidden" name="x_student_lastname" id="x_student_lastname" value="<?php echo ew_HtmlEncode($view_school_lists_payments->student_lastname->CurrentValue) ?>">
</span><?php echo $view_school_lists_payments->student_lastname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($view_school_lists_payments->schools_school_id->Visible) { // schools_school_id ?>
	<tr<?php echo $view_school_lists_payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $view_school_lists_payments->schools_school_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $view_school_lists_payments->schools_school_id->CellAttributes() ?>><span id="el_schools_school_id">
<div<?php echo $view_school_lists_payments->schools_school_id->ViewAttributes() ?>><?php echo $view_school_lists_payments->schools_school_id->EditValue ?></div><input type="hidden" name="x_schools_school_id" id="x_schools_school_id" value="<?php echo ew_HtmlEncode($view_school_lists_payments->schools_school_id->CurrentValue) ?>">
</span><?php echo $view_school_lists_payments->schools_school_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($view_school_lists_payments->year->Visible) { // year ?>
	<tr<?php echo $view_school_lists_payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $view_school_lists_payments->year->FldCaption() ?></td>
		<td<?php echo $view_school_lists_payments->year->CellAttributes() ?>><span id="el_year">
<div<?php echo $view_school_lists_payments->year->ViewAttributes() ?>><?php echo $view_school_lists_payments->year->EditValue ?></div><input type="hidden" name="x_year" id="x_year" value="<?php echo ew_HtmlEncode($view_school_lists_payments->year->CurrentValue) ?>">
</span><?php echo $view_school_lists_payments->year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($view_school_lists_payments->class->Visible) { // class ?>
	<tr<?php echo $view_school_lists_payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $view_school_lists_payments->class->FldCaption() ?></td>
		<td<?php echo $view_school_lists_payments->class->CellAttributes() ?>><span id="el_class">
<div<?php echo $view_school_lists_payments->class->ViewAttributes() ?>><?php echo $view_school_lists_payments->class->EditValue ?></div><input type="hidden" name="x_class" id="x_class" value="<?php echo ew_HtmlEncode($view_school_lists_payments->class->CurrentValue) ?>">
</span><?php echo $view_school_lists_payments->class->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($view_school_lists_payments->attendance_type->Visible) { // attendance_type ?>
	<tr<?php echo $view_school_lists_payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $view_school_lists_payments->attendance_type->FldCaption() ?></td>
		<td<?php echo $view_school_lists_payments->attendance_type->CellAttributes() ?>><span id="el_attendance_type">
<div<?php echo $view_school_lists_payments->attendance_type->ViewAttributes() ?>><?php echo $view_school_lists_payments->attendance_type->EditValue ?></div><input type="hidden" name="x_attendance_type" id="x_attendance_type" value="<?php echo ew_HtmlEncode($view_school_lists_payments->attendance_type->CurrentValue) ?>">
</span><?php echo $view_school_lists_payments->attendance_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($view_school_lists_payments->grade_year_id->Visible) { // grade_year_id ?>
	<tr<?php echo $view_school_lists_payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $view_school_lists_payments->grade_year_id->FldCaption() ?></td>
		<td<?php echo $view_school_lists_payments->grade_year_id->CellAttributes() ?>><span id="el_grade_year_id">
<div<?php echo $view_school_lists_payments->grade_year_id->ViewAttributes() ?>><?php echo $view_school_lists_payments->grade_year_id->EditValue ?></div><input type="hidden" name="x_grade_year_id" id="x_grade_year_id" value="<?php echo ew_HtmlEncode($view_school_lists_payments->grade_year_id->CurrentValue) ?>">
</span><?php echo $view_school_lists_payments->grade_year_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($view_school_lists_payments->school_attendance_school_attendance_id->Visible) { // school_attendance_school_attendance_id ?>
	<tr<?php echo $view_school_lists_payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $view_school_lists_payments->school_attendance_school_attendance_id->FldCaption() ?></td>
		<td<?php echo $view_school_lists_payments->school_attendance_school_attendance_id->CellAttributes() ?>><span id="el_school_attendance_school_attendance_id">
<div<?php echo $view_school_lists_payments->school_attendance_school_attendance_id->ViewAttributes() ?>><?php echo $view_school_lists_payments->school_attendance_school_attendance_id->EditValue ?></div><input type="hidden" name="x_school_attendance_school_attendance_id" id="x_school_attendance_school_attendance_id" value="<?php echo ew_HtmlEncode($view_school_lists_payments->school_attendance_school_attendance_id->CurrentValue) ?>">
</span><?php echo $view_school_lists_payments->school_attendance_school_attendance_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($view_school_lists_payments->verified->Visible) { // verified ?>
	<tr<?php echo $view_school_lists_payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $view_school_lists_payments->verified->FldCaption() ?></td>
		<td<?php echo $view_school_lists_payments->verified->CellAttributes() ?>><span id="el_verified">
<div id="tp_x_verified" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_verified" id="x_verified" title="<?php echo $view_school_lists_payments->verified->FldTitle() ?>" value="{value}"<?php echo $view_school_lists_payments->verified->EditAttributes() ?>></label></div>
<div id="dsl_x_verified" repeatcolumn="5">
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
<label><input type="radio" name="x_verified" id="x_verified" title="<?php echo $view_school_lists_payments->verified->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $view_school_lists_payments->verified->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $view_school_lists_payments->verified->CustomMsg ?></td>
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
$view_school_lists_payments_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cview_school_lists_payments_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'view_school_lists_payments';

	// Page object name
	var $PageObjName = 'view_school_lists_payments_edit';

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
	function cview_school_lists_payments_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (view_school_lists_payments)
		$GLOBALS["view_school_lists_payments"] = new cview_school_lists_payments();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'view_school_lists_payments', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("view_school_lists_paymentslist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
		global $objForm, $Language, $gsFormError, $view_school_lists_payments;

		// Load key from QueryString
		if (@$_GET["grade_year_id"] <> "")
			$view_school_lists_payments->grade_year_id->setQueryStringValue($_GET["grade_year_id"]);
		if (@$_POST["a_edit"] <> "") {
			$view_school_lists_payments->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$view_school_lists_payments->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$view_school_lists_payments->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$view_school_lists_payments->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($view_school_lists_payments->grade_year_id->CurrentValue == "")
			$this->Page_Terminate("view_school_lists_paymentslist.php"); // Invalid key, return to list
		switch ($view_school_lists_payments->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("view_school_lists_paymentslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$view_school_lists_payments->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $view_school_lists_payments->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$view_school_lists_payments->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$view_school_lists_payments->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $view_school_lists_payments;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $view_school_lists_payments;
		$view_school_lists_payments->student_firstname->setFormValue($objForm->GetValue("x_student_firstname"));
		$view_school_lists_payments->student_middlename->setFormValue($objForm->GetValue("x_student_middlename"));
		$view_school_lists_payments->student_lastname->setFormValue($objForm->GetValue("x_student_lastname"));
		$view_school_lists_payments->schools_school_id->setFormValue($objForm->GetValue("x_schools_school_id"));
		$view_school_lists_payments->year->setFormValue($objForm->GetValue("x_year"));
		$view_school_lists_payments->class->setFormValue($objForm->GetValue("x_class"));
		$view_school_lists_payments->attendance_type->setFormValue($objForm->GetValue("x_attendance_type"));
		$view_school_lists_payments->grade_year_id->setFormValue($objForm->GetValue("x_grade_year_id"));
		$view_school_lists_payments->school_attendance_school_attendance_id->setFormValue($objForm->GetValue("x_school_attendance_school_attendance_id"));
		$view_school_lists_payments->verified->setFormValue($objForm->GetValue("x_verified"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $view_school_lists_payments;
		$this->LoadRow();
		$view_school_lists_payments->student_firstname->CurrentValue = $view_school_lists_payments->student_firstname->FormValue;
		$view_school_lists_payments->student_middlename->CurrentValue = $view_school_lists_payments->student_middlename->FormValue;
		$view_school_lists_payments->student_lastname->CurrentValue = $view_school_lists_payments->student_lastname->FormValue;
		$view_school_lists_payments->schools_school_id->CurrentValue = $view_school_lists_payments->schools_school_id->FormValue;
		$view_school_lists_payments->year->CurrentValue = $view_school_lists_payments->year->FormValue;
		$view_school_lists_payments->class->CurrentValue = $view_school_lists_payments->class->FormValue;
		$view_school_lists_payments->attendance_type->CurrentValue = $view_school_lists_payments->attendance_type->FormValue;
		$view_school_lists_payments->grade_year_id->CurrentValue = $view_school_lists_payments->grade_year_id->FormValue;
		$view_school_lists_payments->school_attendance_school_attendance_id->CurrentValue = $view_school_lists_payments->school_attendance_school_attendance_id->FormValue;
		$view_school_lists_payments->verified->CurrentValue = $view_school_lists_payments->verified->FormValue;
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
		// Call Row_Rendering event

		$view_school_lists_payments->Row_Rendering();

		// Common render codes for all row types
		// student_firstname

		$view_school_lists_payments->student_firstname->CellCssStyle = ""; $view_school_lists_payments->student_firstname->CellCssClass = "";
		$view_school_lists_payments->student_firstname->CellAttrs = array(); $view_school_lists_payments->student_firstname->ViewAttrs = array(); $view_school_lists_payments->student_firstname->EditAttrs = array();

		// student_middlename
		$view_school_lists_payments->student_middlename->CellCssStyle = ""; $view_school_lists_payments->student_middlename->CellCssClass = "";
		$view_school_lists_payments->student_middlename->CellAttrs = array(); $view_school_lists_payments->student_middlename->ViewAttrs = array(); $view_school_lists_payments->student_middlename->EditAttrs = array();

		// student_lastname
		$view_school_lists_payments->student_lastname->CellCssStyle = ""; $view_school_lists_payments->student_lastname->CellCssClass = "";
		$view_school_lists_payments->student_lastname->CellAttrs = array(); $view_school_lists_payments->student_lastname->ViewAttrs = array(); $view_school_lists_payments->student_lastname->EditAttrs = array();

		// schools_school_id
		$view_school_lists_payments->schools_school_id->CellCssStyle = ""; $view_school_lists_payments->schools_school_id->CellCssClass = "";
		$view_school_lists_payments->schools_school_id->CellAttrs = array(); $view_school_lists_payments->schools_school_id->ViewAttrs = array(); $view_school_lists_payments->schools_school_id->EditAttrs = array();

		// year
		$view_school_lists_payments->year->CellCssStyle = ""; $view_school_lists_payments->year->CellCssClass = "";
		$view_school_lists_payments->year->CellAttrs = array(); $view_school_lists_payments->year->ViewAttrs = array(); $view_school_lists_payments->year->EditAttrs = array();

		// class
		$view_school_lists_payments->class->CellCssStyle = ""; $view_school_lists_payments->class->CellCssClass = "";
		$view_school_lists_payments->class->CellAttrs = array(); $view_school_lists_payments->class->ViewAttrs = array(); $view_school_lists_payments->class->EditAttrs = array();

		// attendance_type
		$view_school_lists_payments->attendance_type->CellCssStyle = ""; $view_school_lists_payments->attendance_type->CellCssClass = "";
		$view_school_lists_payments->attendance_type->CellAttrs = array(); $view_school_lists_payments->attendance_type->ViewAttrs = array(); $view_school_lists_payments->attendance_type->EditAttrs = array();

		// grade_year_id
		$view_school_lists_payments->grade_year_id->CellCssStyle = ""; $view_school_lists_payments->grade_year_id->CellCssClass = "";
		$view_school_lists_payments->grade_year_id->CellAttrs = array(); $view_school_lists_payments->grade_year_id->ViewAttrs = array(); $view_school_lists_payments->grade_year_id->EditAttrs = array();

		// school_attendance_school_attendance_id
		$view_school_lists_payments->school_attendance_school_attendance_id->CellCssStyle = ""; $view_school_lists_payments->school_attendance_school_attendance_id->CellCssClass = "";
		$view_school_lists_payments->school_attendance_school_attendance_id->CellAttrs = array(); $view_school_lists_payments->school_attendance_school_attendance_id->ViewAttrs = array(); $view_school_lists_payments->school_attendance_school_attendance_id->EditAttrs = array();

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

			// student_middlename
			$view_school_lists_payments->student_middlename->HrefValue = "";
			$view_school_lists_payments->student_middlename->TooltipValue = "";

			// student_lastname
			$view_school_lists_payments->student_lastname->HrefValue = "";
			$view_school_lists_payments->student_lastname->TooltipValue = "";

			// schools_school_id
			$view_school_lists_payments->schools_school_id->HrefValue = "";
			$view_school_lists_payments->schools_school_id->TooltipValue = "";

			// year
			$view_school_lists_payments->year->HrefValue = "";
			$view_school_lists_payments->year->TooltipValue = "";

			// class
			$view_school_lists_payments->class->HrefValue = "";
			$view_school_lists_payments->class->TooltipValue = "";

			// attendance_type
			$view_school_lists_payments->attendance_type->HrefValue = "";
			$view_school_lists_payments->attendance_type->TooltipValue = "";

			// grade_year_id
			$view_school_lists_payments->grade_year_id->HrefValue = "";
			$view_school_lists_payments->grade_year_id->TooltipValue = "";

			// school_attendance_school_attendance_id
			$view_school_lists_payments->school_attendance_school_attendance_id->HrefValue = "";
			$view_school_lists_payments->school_attendance_school_attendance_id->TooltipValue = "";

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

			// student_middlename
			$view_school_lists_payments->student_middlename->EditCustomAttributes = "";
			$view_school_lists_payments->student_middlename->EditValue = $view_school_lists_payments->student_middlename->CurrentValue;
			$view_school_lists_payments->student_middlename->CssStyle = "";
			$view_school_lists_payments->student_middlename->CssClass = "";
			$view_school_lists_payments->student_middlename->ViewCustomAttributes = "";

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

			// class
			$view_school_lists_payments->class->EditCustomAttributes = "";
			$view_school_lists_payments->class->EditValue = $view_school_lists_payments->class->CurrentValue;
			$view_school_lists_payments->class->CssStyle = "";
			$view_school_lists_payments->class->CssClass = "";
			$view_school_lists_payments->class->ViewCustomAttributes = "";

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

			// school_attendance_school_attendance_id
			$view_school_lists_payments->school_attendance_school_attendance_id->EditCustomAttributes = "";
			$view_school_lists_payments->school_attendance_school_attendance_id->EditValue = $view_school_lists_payments->school_attendance_school_attendance_id->CurrentValue;
			$view_school_lists_payments->school_attendance_school_attendance_id->CssStyle = "";
			$view_school_lists_payments->school_attendance_school_attendance_id->CssClass = "";
			$view_school_lists_payments->school_attendance_school_attendance_id->ViewCustomAttributes = "";

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

			// student_middlename
			$view_school_lists_payments->student_middlename->HrefValue = "";

			// student_lastname
			$view_school_lists_payments->student_lastname->HrefValue = "";

			// schools_school_id
			$view_school_lists_payments->schools_school_id->HrefValue = "";

			// year
			$view_school_lists_payments->year->HrefValue = "";

			// class
			$view_school_lists_payments->class->HrefValue = "";

			// attendance_type
			$view_school_lists_payments->attendance_type->HrefValue = "";

			// grade_year_id
			$view_school_lists_payments->grade_year_id->HrefValue = "";

			// school_attendance_school_attendance_id
			$view_school_lists_payments->school_attendance_school_attendance_id->HrefValue = "";

			// verified
			$view_school_lists_payments->verified->HrefValue = "";
		}

		// Call Row Rendered event
		if ($view_school_lists_payments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$view_school_lists_payments->Row_Rendered();
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
