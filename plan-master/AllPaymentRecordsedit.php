<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "AllPaymentRecordsinfo.php" ?>
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
$AllPaymentRecords_edit = new cAllPaymentRecords_edit();
$Page =& $AllPaymentRecords_edit;

// Page init
$AllPaymentRecords_edit->Page_Init();

// Page main
$AllPaymentRecords_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var AllPaymentRecords_edit = new ew_Page("AllPaymentRecords_edit");

// page properties
AllPaymentRecords_edit.PageID = "edit"; // page ID
AllPaymentRecords_edit.FormID = "fAllPaymentRecordsedit"; // form ID
var EW_PAGE_ID = AllPaymentRecords_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
AllPaymentRecords_edit.ValidateForm = function(fobj) {
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
AllPaymentRecords_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
AllPaymentRecords_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
AllPaymentRecords_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $AllPaymentRecords->TableCaption() ?><br><br>
<a href="<?php echo $AllPaymentRecords->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$AllPaymentRecords_edit->ShowMessage();
?>
<form name="fAllPaymentRecordsedit" id="fAllPaymentRecordsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return AllPaymentRecords_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="AllPaymentRecords">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($AllPaymentRecords->CurrentAction == "F") { // Confirm page ?>
<input type="hidden" name="a_confirm" id="a_confirm" value="F">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($AllPaymentRecords->payment_request_id->Visible) { // payment_request_id ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->payment_request_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $AllPaymentRecords->payment_request_id->CellAttributes() ?>><span id="el_payment_request_id">
<?php if ($AllPaymentRecords->CurrentAction <> "F") { ?>
<div<?php echo $AllPaymentRecords->payment_request_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->payment_request_id->EditValue ?></div><input type="hidden" name="x_payment_request_id" id="x_payment_request_id" value="<?php echo ew_HtmlEncode($AllPaymentRecords->payment_request_id->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $AllPaymentRecords->payment_request_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->payment_request_id->ViewValue ?></div>
<input type="hidden" name="x_payment_request_id" id="x_payment_request_id" value="<?php echo ew_HtmlEncode($AllPaymentRecords->payment_request_id->FormValue) ?>">
<?php } ?>
</span><?php echo $AllPaymentRecords->payment_request_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->year->Visible) { // year ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->year->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->year->CellAttributes() ?>><span id="el_year">
<?php if ($AllPaymentRecords->CurrentAction <> "F") { ?>
<div<?php echo $AllPaymentRecords->year->ViewAttributes() ?>><?php echo $AllPaymentRecords->year->EditValue ?></div><input type="hidden" name="x_year" id="x_year" value="<?php echo ew_HtmlEncode($AllPaymentRecords->year->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $AllPaymentRecords->year->ViewAttributes() ?>><?php echo $AllPaymentRecords->year->ViewValue ?></div>
<input type="hidden" name="x_year" id="x_year" value="<?php echo ew_HtmlEncode($AllPaymentRecords->year->FormValue) ?>">
<?php } ?>
</span><?php echo $AllPaymentRecords->year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->request_date->Visible) { // request_date ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->request_date->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->request_date->CellAttributes() ?>><span id="el_request_date">
<?php if ($AllPaymentRecords->CurrentAction <> "F") { ?>
<div<?php echo $AllPaymentRecords->request_date->ViewAttributes() ?>><?php echo $AllPaymentRecords->request_date->EditValue ?></div><input type="hidden" name="x_request_date" id="x_request_date" value="<?php echo ew_HtmlEncode($AllPaymentRecords->request_date->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $AllPaymentRecords->request_date->ViewAttributes() ?>><?php echo $AllPaymentRecords->request_date->ViewValue ?></div>
<input type="hidden" name="x_request_date" id="x_request_date" value="<?php echo ew_HtmlEncode($AllPaymentRecords->request_date->FormValue) ?>">
<?php } ?>
</span><?php echo $AllPaymentRecords->request_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->programarea_id->Visible) { // programarea_id ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->programarea_id->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->programarea_id->CellAttributes() ?>><span id="el_programarea_id">
<?php if ($AllPaymentRecords->CurrentAction <> "F") { ?>
<div<?php echo $AllPaymentRecords->programarea_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->programarea_id->EditValue ?></div><input type="hidden" name="x_programarea_id" id="x_programarea_id" value="<?php echo ew_HtmlEncode($AllPaymentRecords->programarea_id->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $AllPaymentRecords->programarea_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->programarea_id->ViewValue ?></div>
<input type="hidden" name="x_programarea_id" id="x_programarea_id" value="<?php echo ew_HtmlEncode($AllPaymentRecords->programarea_id->FormValue) ?>">
<?php } ?>
</span><?php echo $AllPaymentRecords->programarea_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->request_status->Visible) { // request_status ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->request_status->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->request_status->CellAttributes() ?>><span id="el_request_status">
<?php if ($AllPaymentRecords->CurrentAction <> "F") { ?>
<div id="tp_x_request_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $AllPaymentRecords->request_status->FldTitle() ?>" value="{value}"<?php echo $AllPaymentRecords->request_status->EditAttributes() ?>></label></div>
<div id="dsl_x_request_status" repeatcolumn="5">
<?php
$arwrk = $AllPaymentRecords->request_status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($AllPaymentRecords->request_status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $AllPaymentRecords->request_status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $AllPaymentRecords->request_status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
<?php } else { ?>
<div<?php echo $AllPaymentRecords->request_status->ViewAttributes() ?>><?php echo $AllPaymentRecords->request_status->ViewValue ?></div>
<input type="hidden" name="x_request_status" id="x_request_status" value="<?php echo ew_HtmlEncode($AllPaymentRecords->request_status->FormValue) ?>">
<?php } ?>
</span><?php echo $AllPaymentRecords->request_status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->code->Visible) { // code ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->code->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->code->CellAttributes() ?>><span id="el_code">
<?php if ($AllPaymentRecords->CurrentAction <> "F") { ?>
<div<?php echo $AllPaymentRecords->code->ViewAttributes() ?>><?php echo $AllPaymentRecords->code->EditValue ?></div><input type="hidden" name="x_code" id="x_code" value="<?php echo ew_HtmlEncode($AllPaymentRecords->code->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $AllPaymentRecords->code->ViewAttributes() ?>><?php echo $AllPaymentRecords->code->ViewValue ?></div>
<input type="hidden" name="x_code" id="x_code" value="<?php echo ew_HtmlEncode($AllPaymentRecords->code->FormValue) ?>">
<?php } ?>
</span><?php echo $AllPaymentRecords->code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->financial_year_financial_year_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $AllPaymentRecords->financial_year_financial_year_id->CellAttributes() ?>><span id="el_financial_year_financial_year_id">
<?php if ($AllPaymentRecords->CurrentAction <> "F") { ?>
<div<?php echo $AllPaymentRecords->financial_year_financial_year_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->financial_year_financial_year_id->EditValue ?></div><input type="hidden" name="x_financial_year_financial_year_id" id="x_financial_year_financial_year_id" value="<?php echo ew_HtmlEncode($AllPaymentRecords->financial_year_financial_year_id->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $AllPaymentRecords->financial_year_financial_year_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->financial_year_financial_year_id->ViewValue ?></div>
<input type="hidden" name="x_financial_year_financial_year_id" id="x_financial_year_financial_year_id" value="<?php echo ew_HtmlEncode($AllPaymentRecords->financial_year_financial_year_id->FormValue) ?>">
<?php } ?>
</span><?php echo $AllPaymentRecords->financial_year_financial_year_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->amount->Visible) { // amount ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->amount->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->amount->CellAttributes() ?>><span id="el_amount">
<?php if ($AllPaymentRecords->CurrentAction <> "F") { ?>
<div<?php echo $AllPaymentRecords->amount->ViewAttributes() ?>><?php echo $AllPaymentRecords->amount->EditValue ?></div><input type="hidden" name="x_amount" id="x_amount" value="<?php echo ew_HtmlEncode($AllPaymentRecords->amount->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $AllPaymentRecords->amount->ViewAttributes() ?>><?php echo $AllPaymentRecords->amount->ViewValue ?></div>
<input type="hidden" name="x_amount" id="x_amount" value="<?php echo ew_HtmlEncode($AllPaymentRecords->amount->FormValue) ?>">
<?php } ?>
</span><?php echo $AllPaymentRecords->amount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($AllPaymentRecords->group_id->Visible) { // group_id ?>
	<tr<?php echo $AllPaymentRecords->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $AllPaymentRecords->group_id->FldCaption() ?></td>
		<td<?php echo $AllPaymentRecords->group_id->CellAttributes() ?>><span id="el_group_id">
<?php if ($AllPaymentRecords->CurrentAction <> "F") { ?>
<div<?php echo $AllPaymentRecords->group_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->group_id->EditValue ?></div><input type="hidden" name="x_group_id" id="x_group_id" value="<?php echo ew_HtmlEncode($AllPaymentRecords->group_id->CurrentValue) ?>">
<?php } else { ?>
<div<?php echo $AllPaymentRecords->group_id->ViewAttributes() ?>><?php echo $AllPaymentRecords->group_id->ViewValue ?></div>
<input type="hidden" name="x_group_id" id="x_group_id" value="<?php echo ew_HtmlEncode($AllPaymentRecords->group_id->FormValue) ?>">
<?php } ?>
</span><?php echo $AllPaymentRecords->group_id->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($AllPaymentRecords->CurrentAction <> "F") { // Confirm page ?>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>" onclick="this.form.a_edit.value='F';">
<?php } else { ?>
<input type="submit" name="btnCancel" id="btnCancel" value="<?php echo ew_BtnCaption($Language->Phrase("CancelBtn")) ?>" onclick="this.form.a_edit.value='X';">
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("ConfirmBtn")) ?>">
<?php } ?>
</form>
<?php if ($AllPaymentRecords->CurrentAction <> "F") { ?>
<?php } ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$AllPaymentRecords_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cAllPaymentRecords_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'AllPaymentRecords';

	// Page object name
	var $PageObjName = 'AllPaymentRecords_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $AllPaymentRecords;
		if ($AllPaymentRecords->UseTokenInUrl) $PageUrl .= "t=" . $AllPaymentRecords->TableVar . "&"; // Add page token
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
		global $objForm, $AllPaymentRecords;
		if ($AllPaymentRecords->UseTokenInUrl) {
			if ($objForm)
				return ($AllPaymentRecords->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($AllPaymentRecords->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cAllPaymentRecords_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (AllPaymentRecords)
		$GLOBALS["AllPaymentRecords"] = new cAllPaymentRecords();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'AllPaymentRecords', TRUE);

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
		global $AllPaymentRecords;

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
			$this->Page_Terminate("AllPaymentRecordslist.php");
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
		global $objForm, $Language, $gsFormError, $AllPaymentRecords;

		// Load key from QueryString
		if (@$_GET["payment_request_id"] <> "")
			$AllPaymentRecords->payment_request_id->setQueryStringValue($_GET["payment_request_id"]);
		if (@$_POST["a_edit"] <> "") {
			$AllPaymentRecords->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$AllPaymentRecords->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$AllPaymentRecords->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$AllPaymentRecords->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($AllPaymentRecords->payment_request_id->CurrentValue == "")
			$this->Page_Terminate("AllPaymentRecordslist.php"); // Invalid key, return to list
		switch ($AllPaymentRecords->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("AllPaymentRecordslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$AllPaymentRecords->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $AllPaymentRecords->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$AllPaymentRecords->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		if ($AllPaymentRecords->CurrentAction == "F") { // Confirm page
			$AllPaymentRecords->RowType = EW_ROWTYPE_VIEW; // Render as View
		} else {
			$AllPaymentRecords->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		}
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $AllPaymentRecords;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $AllPaymentRecords;
		$AllPaymentRecords->payment_request_id->setFormValue($objForm->GetValue("x_payment_request_id"));
		$AllPaymentRecords->year->setFormValue($objForm->GetValue("x_year"));
		$AllPaymentRecords->request_date->setFormValue($objForm->GetValue("x_request_date"));
		$AllPaymentRecords->request_date->CurrentValue = ew_UnFormatDateTime($AllPaymentRecords->request_date->CurrentValue, 7);
		$AllPaymentRecords->programarea_id->setFormValue($objForm->GetValue("x_programarea_id"));
		$AllPaymentRecords->request_status->setFormValue($objForm->GetValue("x_request_status"));
		$AllPaymentRecords->code->setFormValue($objForm->GetValue("x_code"));
		$AllPaymentRecords->financial_year_financial_year_id->setFormValue($objForm->GetValue("x_financial_year_financial_year_id"));
		$AllPaymentRecords->amount->setFormValue($objForm->GetValue("x_amount"));
		$AllPaymentRecords->group_id->setFormValue($objForm->GetValue("x_group_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $AllPaymentRecords;
		$this->LoadRow();
		$AllPaymentRecords->payment_request_id->CurrentValue = $AllPaymentRecords->payment_request_id->FormValue;
		$AllPaymentRecords->year->CurrentValue = $AllPaymentRecords->year->FormValue;
		$AllPaymentRecords->request_date->CurrentValue = $AllPaymentRecords->request_date->FormValue;
		$AllPaymentRecords->request_date->CurrentValue = ew_UnFormatDateTime($AllPaymentRecords->request_date->CurrentValue, 7);
		$AllPaymentRecords->programarea_id->CurrentValue = $AllPaymentRecords->programarea_id->FormValue;
		$AllPaymentRecords->request_status->CurrentValue = $AllPaymentRecords->request_status->FormValue;
		$AllPaymentRecords->code->CurrentValue = $AllPaymentRecords->code->FormValue;
		$AllPaymentRecords->financial_year_financial_year_id->CurrentValue = $AllPaymentRecords->financial_year_financial_year_id->FormValue;
		$AllPaymentRecords->amount->CurrentValue = $AllPaymentRecords->amount->FormValue;
		$AllPaymentRecords->group_id->CurrentValue = $AllPaymentRecords->group_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $AllPaymentRecords;
		$sFilter = $AllPaymentRecords->KeyFilter();

		// Call Row Selecting event
		$AllPaymentRecords->Row_Selecting($sFilter);

		// Load SQL based on filter
		$AllPaymentRecords->CurrentFilter = $sFilter;
		$sSql = $AllPaymentRecords->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$AllPaymentRecords->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $AllPaymentRecords;
		$AllPaymentRecords->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$AllPaymentRecords->year->setDbValue($rs->fields('year'));
		$AllPaymentRecords->request_date->setDbValue($rs->fields('request_date'));
		$AllPaymentRecords->programarea_id->setDbValue($rs->fields('programarea_id'));
		$AllPaymentRecords->request_status->setDbValue($rs->fields('request_status'));
		$AllPaymentRecords->code->setDbValue($rs->fields('code'));
		$AllPaymentRecords->financial_year_financial_year_id->setDbValue($rs->fields('financial_year_financial_year_id'));
		$AllPaymentRecords->amount->setDbValue($rs->fields('amount'));
		$AllPaymentRecords->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $AllPaymentRecords;

		// Initialize URLs
		// Call Row_Rendering event

		$AllPaymentRecords->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$AllPaymentRecords->payment_request_id->CellCssStyle = ""; $AllPaymentRecords->payment_request_id->CellCssClass = "";
		$AllPaymentRecords->payment_request_id->CellAttrs = array(); $AllPaymentRecords->payment_request_id->ViewAttrs = array(); $AllPaymentRecords->payment_request_id->EditAttrs = array();

		// year
		$AllPaymentRecords->year->CellCssStyle = ""; $AllPaymentRecords->year->CellCssClass = "";
		$AllPaymentRecords->year->CellAttrs = array(); $AllPaymentRecords->year->ViewAttrs = array(); $AllPaymentRecords->year->EditAttrs = array();

		// request_date
		$AllPaymentRecords->request_date->CellCssStyle = ""; $AllPaymentRecords->request_date->CellCssClass = "";
		$AllPaymentRecords->request_date->CellAttrs = array(); $AllPaymentRecords->request_date->ViewAttrs = array(); $AllPaymentRecords->request_date->EditAttrs = array();

		// programarea_id
		$AllPaymentRecords->programarea_id->CellCssStyle = ""; $AllPaymentRecords->programarea_id->CellCssClass = "";
		$AllPaymentRecords->programarea_id->CellAttrs = array(); $AllPaymentRecords->programarea_id->ViewAttrs = array(); $AllPaymentRecords->programarea_id->EditAttrs = array();

		// request_status
		$AllPaymentRecords->request_status->CellCssStyle = ""; $AllPaymentRecords->request_status->CellCssClass = "";
		$AllPaymentRecords->request_status->CellAttrs = array(); $AllPaymentRecords->request_status->ViewAttrs = array(); $AllPaymentRecords->request_status->EditAttrs = array();

		// code
		$AllPaymentRecords->code->CellCssStyle = ""; $AllPaymentRecords->code->CellCssClass = "";
		$AllPaymentRecords->code->CellAttrs = array(); $AllPaymentRecords->code->ViewAttrs = array(); $AllPaymentRecords->code->EditAttrs = array();

		// financial_year_financial_year_id
		$AllPaymentRecords->financial_year_financial_year_id->CellCssStyle = ""; $AllPaymentRecords->financial_year_financial_year_id->CellCssClass = "";
		$AllPaymentRecords->financial_year_financial_year_id->CellAttrs = array(); $AllPaymentRecords->financial_year_financial_year_id->ViewAttrs = array(); $AllPaymentRecords->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$AllPaymentRecords->amount->CellCssStyle = ""; $AllPaymentRecords->amount->CellCssClass = "";
		$AllPaymentRecords->amount->CellAttrs = array(); $AllPaymentRecords->amount->ViewAttrs = array(); $AllPaymentRecords->amount->EditAttrs = array();

		// group_id
		$AllPaymentRecords->group_id->CellCssStyle = ""; $AllPaymentRecords->group_id->CellCssClass = "";
		$AllPaymentRecords->group_id->CellAttrs = array(); $AllPaymentRecords->group_id->ViewAttrs = array(); $AllPaymentRecords->group_id->EditAttrs = array();
		if ($AllPaymentRecords->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$AllPaymentRecords->payment_request_id->ViewValue = $AllPaymentRecords->payment_request_id->CurrentValue;
			$AllPaymentRecords->payment_request_id->CssStyle = "";
			$AllPaymentRecords->payment_request_id->CssClass = "";
			$AllPaymentRecords->payment_request_id->ViewCustomAttributes = "";

			// year
			$AllPaymentRecords->year->ViewValue = $AllPaymentRecords->year->CurrentValue;
			$AllPaymentRecords->year->CssStyle = "";
			$AllPaymentRecords->year->CssClass = "";
			$AllPaymentRecords->year->ViewCustomAttributes = "";

			// request_date
			$AllPaymentRecords->request_date->ViewValue = $AllPaymentRecords->request_date->CurrentValue;
			$AllPaymentRecords->request_date->ViewValue = ew_FormatDateTime($AllPaymentRecords->request_date->ViewValue, 7);
			$AllPaymentRecords->request_date->CssStyle = "";
			$AllPaymentRecords->request_date->CssClass = "";
			$AllPaymentRecords->request_date->ViewCustomAttributes = "";

			// programarea_id
			if (strval($AllPaymentRecords->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($AllPaymentRecords->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$AllPaymentRecords->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$AllPaymentRecords->programarea_id->ViewValue = $AllPaymentRecords->programarea_id->CurrentValue;
				}
			} else {
				$AllPaymentRecords->programarea_id->ViewValue = NULL;
			}
			$AllPaymentRecords->programarea_id->CssStyle = "";
			$AllPaymentRecords->programarea_id->CssClass = "";
			$AllPaymentRecords->programarea_id->ViewCustomAttributes = "";

			// request_status
			if (strval($AllPaymentRecords->request_status->CurrentValue) <> "") {
				switch ($AllPaymentRecords->request_status->CurrentValue) {
					case "NEWREQ":
						$AllPaymentRecords->request_status->ViewValue = "NEWREQ";
						break;
					case "REQUESTED":
						$AllPaymentRecords->request_status->ViewValue = "REQUESTED";
						break;
					case "DISBURSED":
						$AllPaymentRecords->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$AllPaymentRecords->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$AllPaymentRecords->request_status->ViewValue = $AllPaymentRecords->request_status->CurrentValue;
				}
			} else {
				$AllPaymentRecords->request_status->ViewValue = NULL;
			}
			$AllPaymentRecords->request_status->CssStyle = "";
			$AllPaymentRecords->request_status->CssClass = "";
			$AllPaymentRecords->request_status->ViewCustomAttributes = "";

			// code
			$AllPaymentRecords->code->ViewValue = $AllPaymentRecords->code->CurrentValue;
			$AllPaymentRecords->code->CssStyle = "";
			$AllPaymentRecords->code->CssClass = "";
			$AllPaymentRecords->code->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($AllPaymentRecords->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($AllPaymentRecords->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$AllPaymentRecords->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$AllPaymentRecords->financial_year_financial_year_id->ViewValue = $AllPaymentRecords->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$AllPaymentRecords->financial_year_financial_year_id->ViewValue = NULL;
			}
			$AllPaymentRecords->financial_year_financial_year_id->CssStyle = "";
			$AllPaymentRecords->financial_year_financial_year_id->CssClass = "";
			$AllPaymentRecords->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$AllPaymentRecords->amount->ViewValue = $AllPaymentRecords->amount->CurrentValue;
			$AllPaymentRecords->amount->CssStyle = "";
			$AllPaymentRecords->amount->CssClass = "";
			$AllPaymentRecords->amount->ViewCustomAttributes = "";

			// group_id
			$AllPaymentRecords->group_id->ViewValue = $AllPaymentRecords->group_id->CurrentValue;
			$AllPaymentRecords->group_id->CssStyle = "";
			$AllPaymentRecords->group_id->CssClass = "";
			$AllPaymentRecords->group_id->ViewCustomAttributes = "";

			// payment_request_id
			$AllPaymentRecords->payment_request_id->HrefValue = "";
			$AllPaymentRecords->payment_request_id->TooltipValue = "";

			// year
			$AllPaymentRecords->year->HrefValue = "";
			$AllPaymentRecords->year->TooltipValue = "";

			// request_date
			$AllPaymentRecords->request_date->HrefValue = "";
			$AllPaymentRecords->request_date->TooltipValue = "";

			// programarea_id
			$AllPaymentRecords->programarea_id->HrefValue = "";
			$AllPaymentRecords->programarea_id->TooltipValue = "";

			// request_status
			$AllPaymentRecords->request_status->HrefValue = "";
			$AllPaymentRecords->request_status->TooltipValue = "";

			// code
			$AllPaymentRecords->code->HrefValue = "";
			$AllPaymentRecords->code->TooltipValue = "";

			// financial_year_financial_year_id
			$AllPaymentRecords->financial_year_financial_year_id->HrefValue = "";
			$AllPaymentRecords->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$AllPaymentRecords->amount->HrefValue = "";
			$AllPaymentRecords->amount->TooltipValue = "";

			// group_id
			$AllPaymentRecords->group_id->HrefValue = "";
			$AllPaymentRecords->group_id->TooltipValue = "";
		} elseif ($AllPaymentRecords->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// payment_request_id
			$AllPaymentRecords->payment_request_id->EditCustomAttributes = "";
			$AllPaymentRecords->payment_request_id->EditValue = $AllPaymentRecords->payment_request_id->CurrentValue;
			$AllPaymentRecords->payment_request_id->CssStyle = "";
			$AllPaymentRecords->payment_request_id->CssClass = "";
			$AllPaymentRecords->payment_request_id->ViewCustomAttributes = "";

			// year
			$AllPaymentRecords->year->EditCustomAttributes = "";
			$AllPaymentRecords->year->EditValue = $AllPaymentRecords->year->CurrentValue;
			$AllPaymentRecords->year->CssStyle = "";
			$AllPaymentRecords->year->CssClass = "";
			$AllPaymentRecords->year->ViewCustomAttributes = "";

			// request_date
			$AllPaymentRecords->request_date->EditCustomAttributes = "";
			$AllPaymentRecords->request_date->EditValue = $AllPaymentRecords->request_date->CurrentValue;
			$AllPaymentRecords->request_date->EditValue = ew_FormatDateTime($AllPaymentRecords->request_date->EditValue, 7);
			$AllPaymentRecords->request_date->CssStyle = "";
			$AllPaymentRecords->request_date->CssClass = "";
			$AllPaymentRecords->request_date->ViewCustomAttributes = "";

			// programarea_id
			$AllPaymentRecords->programarea_id->EditCustomAttributes = "";
			if (strval($AllPaymentRecords->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($AllPaymentRecords->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$AllPaymentRecords->programarea_id->EditValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$AllPaymentRecords->programarea_id->EditValue = $AllPaymentRecords->programarea_id->CurrentValue;
				}
			} else {
				$AllPaymentRecords->programarea_id->EditValue = NULL;
			}
			$AllPaymentRecords->programarea_id->CssStyle = "";
			$AllPaymentRecords->programarea_id->CssClass = "";
			$AllPaymentRecords->programarea_id->ViewCustomAttributes = "";

			// request_status
			$AllPaymentRecords->request_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("NEWREQ", "NEWREQ");
			$arwrk[] = array("REQUESTED", "REQUESTED");
			$arwrk[] = array("DISBURSED", "DISBURSED");
			$arwrk[] = array("LIQUIDATED", "LIQUIDATED");
			$AllPaymentRecords->request_status->EditValue = $arwrk;

			// code
			$AllPaymentRecords->code->EditCustomAttributes = "";
			$AllPaymentRecords->code->EditValue = $AllPaymentRecords->code->CurrentValue;
			$AllPaymentRecords->code->CssStyle = "";
			$AllPaymentRecords->code->CssClass = "";
			$AllPaymentRecords->code->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			$AllPaymentRecords->financial_year_financial_year_id->EditCustomAttributes = "";
			if (strval($AllPaymentRecords->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($AllPaymentRecords->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$AllPaymentRecords->financial_year_financial_year_id->EditValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$AllPaymentRecords->financial_year_financial_year_id->EditValue = $AllPaymentRecords->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$AllPaymentRecords->financial_year_financial_year_id->EditValue = NULL;
			}
			$AllPaymentRecords->financial_year_financial_year_id->CssStyle = "";
			$AllPaymentRecords->financial_year_financial_year_id->CssClass = "";
			$AllPaymentRecords->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$AllPaymentRecords->amount->EditCustomAttributes = "";
			$AllPaymentRecords->amount->EditValue = $AllPaymentRecords->amount->CurrentValue;
			$AllPaymentRecords->amount->CssStyle = "";
			$AllPaymentRecords->amount->CssClass = "";
			$AllPaymentRecords->amount->ViewCustomAttributes = "";

			// group_id
			$AllPaymentRecords->group_id->EditCustomAttributes = "";
			$AllPaymentRecords->group_id->EditValue = $AllPaymentRecords->group_id->CurrentValue;
			$AllPaymentRecords->group_id->CssStyle = "";
			$AllPaymentRecords->group_id->CssClass = "";
			$AllPaymentRecords->group_id->ViewCustomAttributes = "";

			// Edit refer script
			// payment_request_id

			$AllPaymentRecords->payment_request_id->HrefValue = "";

			// year
			$AllPaymentRecords->year->HrefValue = "";

			// request_date
			$AllPaymentRecords->request_date->HrefValue = "";

			// programarea_id
			$AllPaymentRecords->programarea_id->HrefValue = "";

			// request_status
			$AllPaymentRecords->request_status->HrefValue = "";

			// code
			$AllPaymentRecords->code->HrefValue = "";

			// financial_year_financial_year_id
			$AllPaymentRecords->financial_year_financial_year_id->HrefValue = "";

			// amount
			$AllPaymentRecords->amount->HrefValue = "";

			// group_id
			$AllPaymentRecords->group_id->HrefValue = "";
		}

		// Call Row Rendered event
		if ($AllPaymentRecords->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$AllPaymentRecords->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $AllPaymentRecords;

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
		global $conn, $Security, $Language, $AllPaymentRecords;
		$sFilter = $AllPaymentRecords->KeyFilter();
		$AllPaymentRecords->CurrentFilter = $sFilter;
		$sSql = $AllPaymentRecords->SQL();
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

			// request_status
			$AllPaymentRecords->request_status->SetDbValueDef($rsnew, $AllPaymentRecords->request_status->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $AllPaymentRecords->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($AllPaymentRecords->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($AllPaymentRecords->CancelMessage <> "") {
					$this->setMessage($AllPaymentRecords->CancelMessage);
					$AllPaymentRecords->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$AllPaymentRecords->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'AllPaymentRecords';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $AllPaymentRecords;
		$table = 'AllPaymentRecords';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['payment_request_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if ($AllPaymentRecords->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($AllPaymentRecords->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($AllPaymentRecords->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} elseif ($AllPaymentRecords->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
