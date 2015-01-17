<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "Disburse_Paymentsinfo.php" ?>
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
$Disburse_Payments_edit = new cDisburse_Payments_edit();
$Page =& $Disburse_Payments_edit;

// Page init
$Disburse_Payments_edit->Page_Init();

// Page main
$Disburse_Payments_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var Disburse_Payments_edit = new ew_Page("Disburse_Payments_edit");

// page properties
Disburse_Payments_edit.PageID = "edit"; // page ID
Disburse_Payments_edit.FormID = "fDisburse_Paymentsedit"; // form ID
var EW_PAGE_ID = Disburse_Payments_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
Disburse_Payments_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_financial_year_financial_year_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Disburse_Payments->financial_year_financial_year_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_amount"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Disburse_Payments->amount->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
Disburse_Payments_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
Disburse_Payments_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Disburse_Payments_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $Disburse_Payments->TableCaption() ?><br><br>
<a href="<?php echo $Disburse_Payments->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$Disburse_Payments_edit->ShowMessage();
?>
<form name="fDisburse_Paymentsedit" id="fDisburse_Paymentsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return Disburse_Payments_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="Disburse_Payments">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($Disburse_Payments->payment_request_id->Visible) { // payment_request_id ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->payment_request_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $Disburse_Payments->payment_request_id->CellAttributes() ?>><span id="el_payment_request_id">
<div<?php echo $Disburse_Payments->payment_request_id->ViewAttributes() ?>><?php echo $Disburse_Payments->payment_request_id->EditValue ?></div><input type="hidden" name="x_payment_request_id" id="x_payment_request_id" value="<?php echo ew_HtmlEncode($Disburse_Payments->payment_request_id->CurrentValue) ?>">
</span><?php echo $Disburse_Payments->payment_request_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->code->Visible) { // code ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->code->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->code->CellAttributes() ?>><span id="el_code">
<input type="text" name="x_code" id="x_code" title="<?php echo $Disburse_Payments->code->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $Disburse_Payments->code->EditValue ?>"<?php echo $Disburse_Payments->code->EditAttributes() ?>>
</span><?php echo $Disburse_Payments->code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->programarea_id->Visible) { // programarea_id ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->programarea_id->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->programarea_id->CellAttributes() ?>><span id="el_programarea_id">
<div<?php echo $Disburse_Payments->programarea_id->ViewAttributes() ?>><?php echo $Disburse_Payments->programarea_id->EditValue ?></div><input type="hidden" name="x_programarea_id" id="x_programarea_id" value="<?php echo ew_HtmlEncode($Disburse_Payments->programarea_id->CurrentValue) ?>">
</span><?php echo $Disburse_Payments->programarea_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->year->Visible) { // year ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->year->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->year->CellAttributes() ?>><span id="el_year">
<div<?php echo $Disburse_Payments->year->ViewAttributes() ?>><?php echo $Disburse_Payments->year->EditValue ?></div><input type="hidden" name="x_year" id="x_year" value="<?php echo ew_HtmlEncode($Disburse_Payments->year->CurrentValue) ?>">
</span><?php echo $Disburse_Payments->year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->request_date->Visible) { // request_date ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->request_date->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->request_date->CellAttributes() ?>><span id="el_request_date">
<div<?php echo $Disburse_Payments->request_date->ViewAttributes() ?>><?php echo $Disburse_Payments->request_date->EditValue ?></div><input type="hidden" name="x_request_date" id="x_request_date" value="<?php echo ew_HtmlEncode($Disburse_Payments->request_date->CurrentValue) ?>">
</span><?php echo $Disburse_Payments->request_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->request_status->Visible) { // request_status ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->request_status->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->request_status->CellAttributes() ?>><span id="el_request_status">
<div id="tp_x_request_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $Disburse_Payments->request_status->FldTitle() ?>" value="{value}"<?php echo $Disburse_Payments->request_status->EditAttributes() ?>></label></div>
<div id="dsl_x_request_status" repeatcolumn="5">
<?php
$arwrk = $Disburse_Payments->request_status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Disburse_Payments->request_status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $Disburse_Payments->request_status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $Disburse_Payments->request_status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $Disburse_Payments->request_status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->financial_year_financial_year_id->Visible) { // financial_year_financial_year_id ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->financial_year_financial_year_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $Disburse_Payments->financial_year_financial_year_id->CellAttributes() ?>><span id="el_financial_year_financial_year_id">
<select id="x_financial_year_financial_year_id" name="x_financial_year_financial_year_id" title="<?php echo $Disburse_Payments->financial_year_financial_year_id->FldTitle() ?>"<?php echo $Disburse_Payments->financial_year_financial_year_id->EditAttributes() ?>>
<?php
if (is_array($Disburse_Payments->financial_year_financial_year_id->EditValue)) {
	$arwrk = $Disburse_Payments->financial_year_financial_year_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Disburse_Payments->financial_year_financial_year_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $Disburse_Payments->financial_year_financial_year_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Disburse_Payments->amount->Visible) { // amount ?>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->amount->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->amount->CellAttributes() ?>><span id="el_amount">
<input type="text" name="x_amount" id="x_amount" title="<?php echo $Disburse_Payments->amount->FldTitle() ?>" size="30" value="<?php echo $Disburse_Payments->amount->EditValue ?>"<?php echo $Disburse_Payments->amount->EditAttributes() ?>>
</span><?php echo $Disburse_Payments->amount->CustomMsg ?></td>
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
$Disburse_Payments_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cDisburse_Payments_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'Disburse Payments';

	// Page object name
	var $PageObjName = 'Disburse_Payments_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $Disburse_Payments;
		if ($Disburse_Payments->UseTokenInUrl) $PageUrl .= "t=" . $Disburse_Payments->TableVar . "&"; // Add page token
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
		global $objForm, $Disburse_Payments;
		if ($Disburse_Payments->UseTokenInUrl) {
			if ($objForm)
				return ($Disburse_Payments->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($Disburse_Payments->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cDisburse_Payments_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Disburse_Payments)
		$GLOBALS["Disburse_Payments"] = new cDisburse_Payments();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Disburse Payments', TRUE);

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
		global $Disburse_Payments;

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
			$this->Page_Terminate("Disburse_Paymentslist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("Disburse_Paymentslist.php");
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
		global $objForm, $Language, $gsFormError, $Disburse_Payments;

		// Load key from QueryString
		if (@$_GET["payment_request_id"] <> "")
			$Disburse_Payments->payment_request_id->setQueryStringValue($_GET["payment_request_id"]);
		if (@$_POST["a_edit"] <> "") {
			$Disburse_Payments->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$Disburse_Payments->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$Disburse_Payments->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$Disburse_Payments->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($Disburse_Payments->payment_request_id->CurrentValue == "")
			$this->Page_Terminate("Disburse_Paymentslist.php"); // Invalid key, return to list
		switch ($Disburse_Payments->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("Disburse_Paymentslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$Disburse_Payments->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $Disburse_Payments->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$Disburse_Payments->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$Disburse_Payments->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Disburse_Payments;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $Disburse_Payments;
		$Disburse_Payments->payment_request_id->setFormValue($objForm->GetValue("x_payment_request_id"));
		$Disburse_Payments->code->setFormValue($objForm->GetValue("x_code"));
		$Disburse_Payments->programarea_id->setFormValue($objForm->GetValue("x_programarea_id"));
		$Disburse_Payments->year->setFormValue($objForm->GetValue("x_year"));
		$Disburse_Payments->request_date->setFormValue($objForm->GetValue("x_request_date"));
		$Disburse_Payments->request_date->CurrentValue = ew_UnFormatDateTime($Disburse_Payments->request_date->CurrentValue, 7);
		$Disburse_Payments->request_status->setFormValue($objForm->GetValue("x_request_status"));
		$Disburse_Payments->financial_year_financial_year_id->setFormValue($objForm->GetValue("x_financial_year_financial_year_id"));
		$Disburse_Payments->amount->setFormValue($objForm->GetValue("x_amount"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $Disburse_Payments;
		$this->LoadRow();
		$Disburse_Payments->payment_request_id->CurrentValue = $Disburse_Payments->payment_request_id->FormValue;
		$Disburse_Payments->code->CurrentValue = $Disburse_Payments->code->FormValue;
		$Disburse_Payments->programarea_id->CurrentValue = $Disburse_Payments->programarea_id->FormValue;
		$Disburse_Payments->year->CurrentValue = $Disburse_Payments->year->FormValue;
		$Disburse_Payments->request_date->CurrentValue = $Disburse_Payments->request_date->FormValue;
		$Disburse_Payments->request_date->CurrentValue = ew_UnFormatDateTime($Disburse_Payments->request_date->CurrentValue, 7);
		$Disburse_Payments->request_status->CurrentValue = $Disburse_Payments->request_status->FormValue;
		$Disburse_Payments->financial_year_financial_year_id->CurrentValue = $Disburse_Payments->financial_year_financial_year_id->FormValue;
		$Disburse_Payments->amount->CurrentValue = $Disburse_Payments->amount->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Disburse_Payments;
		$sFilter = $Disburse_Payments->KeyFilter();

		// Call Row Selecting event
		$Disburse_Payments->Row_Selecting($sFilter);

		// Load SQL based on filter
		$Disburse_Payments->CurrentFilter = $sFilter;
		$sSql = $Disburse_Payments->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$Disburse_Payments->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $Disburse_Payments;
		$Disburse_Payments->payment_request_id->setDbValue($rs->fields('payment_request_id'));
		$Disburse_Payments->code->setDbValue($rs->fields('code'));
		$Disburse_Payments->programarea_id->setDbValue($rs->fields('programarea_id'));
		$Disburse_Payments->year->setDbValue($rs->fields('year'));
		$Disburse_Payments->request_date->setDbValue($rs->fields('request_date'));
		$Disburse_Payments->request_status->setDbValue($rs->fields('request_status'));
		$Disburse_Payments->financial_year_financial_year_id->setDbValue($rs->fields('financial_year_financial_year_id'));
		$Disburse_Payments->amount->setDbValue($rs->fields('amount'));
		$Disburse_Payments->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Disburse_Payments;

		// Initialize URLs
		// Call Row_Rendering event

		$Disburse_Payments->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$Disburse_Payments->payment_request_id->CellCssStyle = ""; $Disburse_Payments->payment_request_id->CellCssClass = "";
		$Disburse_Payments->payment_request_id->CellAttrs = array(); $Disburse_Payments->payment_request_id->ViewAttrs = array(); $Disburse_Payments->payment_request_id->EditAttrs = array();

		// code
		$Disburse_Payments->code->CellCssStyle = ""; $Disburse_Payments->code->CellCssClass = "";
		$Disburse_Payments->code->CellAttrs = array(); $Disburse_Payments->code->ViewAttrs = array(); $Disburse_Payments->code->EditAttrs = array();

		// programarea_id
		$Disburse_Payments->programarea_id->CellCssStyle = ""; $Disburse_Payments->programarea_id->CellCssClass = "";
		$Disburse_Payments->programarea_id->CellAttrs = array(); $Disburse_Payments->programarea_id->ViewAttrs = array(); $Disburse_Payments->programarea_id->EditAttrs = array();

		// year
		$Disburse_Payments->year->CellCssStyle = ""; $Disburse_Payments->year->CellCssClass = "";
		$Disburse_Payments->year->CellAttrs = array(); $Disburse_Payments->year->ViewAttrs = array(); $Disburse_Payments->year->EditAttrs = array();

		// request_date
		$Disburse_Payments->request_date->CellCssStyle = ""; $Disburse_Payments->request_date->CellCssClass = "";
		$Disburse_Payments->request_date->CellAttrs = array(); $Disburse_Payments->request_date->ViewAttrs = array(); $Disburse_Payments->request_date->EditAttrs = array();

		// request_status
		$Disburse_Payments->request_status->CellCssStyle = ""; $Disburse_Payments->request_status->CellCssClass = "";
		$Disburse_Payments->request_status->CellAttrs = array(); $Disburse_Payments->request_status->ViewAttrs = array(); $Disburse_Payments->request_status->EditAttrs = array();

		// financial_year_financial_year_id
		$Disburse_Payments->financial_year_financial_year_id->CellCssStyle = ""; $Disburse_Payments->financial_year_financial_year_id->CellCssClass = "";
		$Disburse_Payments->financial_year_financial_year_id->CellAttrs = array(); $Disburse_Payments->financial_year_financial_year_id->ViewAttrs = array(); $Disburse_Payments->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$Disburse_Payments->amount->CellCssStyle = ""; $Disburse_Payments->amount->CellCssClass = "";
		$Disburse_Payments->amount->CellAttrs = array(); $Disburse_Payments->amount->ViewAttrs = array(); $Disburse_Payments->amount->EditAttrs = array();
		if ($Disburse_Payments->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$Disburse_Payments->payment_request_id->ViewValue = $Disburse_Payments->payment_request_id->CurrentValue;
			$Disburse_Payments->payment_request_id->CssStyle = "";
			$Disburse_Payments->payment_request_id->CssClass = "";
			$Disburse_Payments->payment_request_id->ViewCustomAttributes = "";

			// code
			$Disburse_Payments->code->ViewValue = $Disburse_Payments->code->CurrentValue;
			$Disburse_Payments->code->CssStyle = "";
			$Disburse_Payments->code->CssClass = "";
			$Disburse_Payments->code->ViewCustomAttributes = "";

			// programarea_id
			if (strval($Disburse_Payments->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Disburse_Payments->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Disburse_Payments->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Disburse_Payments->programarea_id->ViewValue = $Disburse_Payments->programarea_id->CurrentValue;
				}
			} else {
				$Disburse_Payments->programarea_id->ViewValue = NULL;
			}
			$Disburse_Payments->programarea_id->CssStyle = "";
			$Disburse_Payments->programarea_id->CssClass = "";
			$Disburse_Payments->programarea_id->ViewCustomAttributes = "";

			// year
			$Disburse_Payments->year->ViewValue = $Disburse_Payments->year->CurrentValue;
			$Disburse_Payments->year->CssStyle = "";
			$Disburse_Payments->year->CssClass = "";
			$Disburse_Payments->year->ViewCustomAttributes = "";

			// request_date
			$Disburse_Payments->request_date->ViewValue = $Disburse_Payments->request_date->CurrentValue;
			$Disburse_Payments->request_date->ViewValue = ew_FormatDateTime($Disburse_Payments->request_date->ViewValue, 7);
			$Disburse_Payments->request_date->CssStyle = "";
			$Disburse_Payments->request_date->CssClass = "";
			$Disburse_Payments->request_date->ViewCustomAttributes = "";

			// request_status
			if (strval($Disburse_Payments->request_status->CurrentValue) <> "") {
				switch ($Disburse_Payments->request_status->CurrentValue) {
					case "NEWREQ":
						$Disburse_Payments->request_status->ViewValue = "NEWREQ";
						break;
					case "REQUESTED":
						$Disburse_Payments->request_status->ViewValue = "REQUESTED";
						break;
					case "DISBURSED":
						$Disburse_Payments->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$Disburse_Payments->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$Disburse_Payments->request_status->ViewValue = $Disburse_Payments->request_status->CurrentValue;
				}
			} else {
				$Disburse_Payments->request_status->ViewValue = NULL;
			}
			$Disburse_Payments->request_status->CssStyle = "";
			$Disburse_Payments->request_status->CssClass = "";
			$Disburse_Payments->request_status->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($Disburse_Payments->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($Disburse_Payments->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Disburse_Payments->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$Disburse_Payments->financial_year_financial_year_id->ViewValue = $Disburse_Payments->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$Disburse_Payments->financial_year_financial_year_id->ViewValue = NULL;
			}
			$Disburse_Payments->financial_year_financial_year_id->CssStyle = "";
			$Disburse_Payments->financial_year_financial_year_id->CssClass = "";
			$Disburse_Payments->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$Disburse_Payments->amount->ViewValue = $Disburse_Payments->amount->CurrentValue;
			$Disburse_Payments->amount->CssStyle = "";
			$Disburse_Payments->amount->CssClass = "";
			$Disburse_Payments->amount->ViewCustomAttributes = "";

			// payment_request_id
			$Disburse_Payments->payment_request_id->HrefValue = "";
			$Disburse_Payments->payment_request_id->TooltipValue = "";

			// code
			$Disburse_Payments->code->HrefValue = "";
			$Disburse_Payments->code->TooltipValue = "";

			// programarea_id
			$Disburse_Payments->programarea_id->HrefValue = "";
			$Disburse_Payments->programarea_id->TooltipValue = "";

			// year
			$Disburse_Payments->year->HrefValue = "";
			$Disburse_Payments->year->TooltipValue = "";

			// request_date
			$Disburse_Payments->request_date->HrefValue = "";
			$Disburse_Payments->request_date->TooltipValue = "";

			// request_status
			$Disburse_Payments->request_status->HrefValue = "";
			$Disburse_Payments->request_status->TooltipValue = "";

			// financial_year_financial_year_id
			$Disburse_Payments->financial_year_financial_year_id->HrefValue = "";
			$Disburse_Payments->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$Disburse_Payments->amount->HrefValue = "";
			$Disburse_Payments->amount->TooltipValue = "";
		} elseif ($Disburse_Payments->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// payment_request_id
			$Disburse_Payments->payment_request_id->EditCustomAttributes = "";
			$Disburse_Payments->payment_request_id->EditValue = $Disburse_Payments->payment_request_id->CurrentValue;
			$Disburse_Payments->payment_request_id->CssStyle = "";
			$Disburse_Payments->payment_request_id->CssClass = "";
			$Disburse_Payments->payment_request_id->ViewCustomAttributes = "";

			// code
			$Disburse_Payments->code->EditCustomAttributes = "";
			$Disburse_Payments->code->EditValue = ew_HtmlEncode($Disburse_Payments->code->CurrentValue);

			// programarea_id
			$Disburse_Payments->programarea_id->EditCustomAttributes = "";
			if (strval($Disburse_Payments->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Disburse_Payments->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Disburse_Payments->programarea_id->EditValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Disburse_Payments->programarea_id->EditValue = $Disburse_Payments->programarea_id->CurrentValue;
				}
			} else {
				$Disburse_Payments->programarea_id->EditValue = NULL;
			}
			$Disburse_Payments->programarea_id->CssStyle = "";
			$Disburse_Payments->programarea_id->CssClass = "";
			$Disburse_Payments->programarea_id->ViewCustomAttributes = "";

			// year
			$Disburse_Payments->year->EditCustomAttributes = "";
			$Disburse_Payments->year->EditValue = $Disburse_Payments->year->CurrentValue;
			$Disburse_Payments->year->CssStyle = "";
			$Disburse_Payments->year->CssClass = "";
			$Disburse_Payments->year->ViewCustomAttributes = "";

			// request_date
			$Disburse_Payments->request_date->EditCustomAttributes = "";
			$Disburse_Payments->request_date->EditValue = $Disburse_Payments->request_date->CurrentValue;
			$Disburse_Payments->request_date->EditValue = ew_FormatDateTime($Disburse_Payments->request_date->EditValue, 7);
			$Disburse_Payments->request_date->CssStyle = "";
			$Disburse_Payments->request_date->CssClass = "";
			$Disburse_Payments->request_date->ViewCustomAttributes = "";

			// request_status
			$Disburse_Payments->request_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("NEWREQ", "NEWREQ");
			$arwrk[] = array("REQUESTED", "REQUESTED");
			$arwrk[] = array("DISBURSED", "DISBURSED");
			$arwrk[] = array("LIQUIDATED", "LIQUIDATED");
			$Disburse_Payments->request_status->EditValue = $arwrk;

			// financial_year_financial_year_id
			$Disburse_Payments->financial_year_financial_year_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `financial_year_id`, `year_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `financial_year`";
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
			$Disburse_Payments->financial_year_financial_year_id->EditValue = $arwrk;

			// amount
			$Disburse_Payments->amount->EditCustomAttributes = "";
			$Disburse_Payments->amount->EditValue = ew_HtmlEncode($Disburse_Payments->amount->CurrentValue);

			// Edit refer script
			// payment_request_id

			$Disburse_Payments->payment_request_id->HrefValue = "";

			// code
			$Disburse_Payments->code->HrefValue = "";

			// programarea_id
			$Disburse_Payments->programarea_id->HrefValue = "";

			// year
			$Disburse_Payments->year->HrefValue = "";

			// request_date
			$Disburse_Payments->request_date->HrefValue = "";

			// request_status
			$Disburse_Payments->request_status->HrefValue = "";

			// financial_year_financial_year_id
			$Disburse_Payments->financial_year_financial_year_id->HrefValue = "";

			// amount
			$Disburse_Payments->amount->HrefValue = "";
		}

		// Call Row Rendered event
		if ($Disburse_Payments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$Disburse_Payments->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $Disburse_Payments;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($Disburse_Payments->financial_year_financial_year_id->FormValue) && $Disburse_Payments->financial_year_financial_year_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $Disburse_Payments->financial_year_financial_year_id->FldCaption();
		}
		if (!ew_CheckInteger($Disburse_Payments->amount->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $Disburse_Payments->amount->FldErrMsg();
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
		global $conn, $Security, $Language, $Disburse_Payments;
		$sFilter = $Disburse_Payments->KeyFilter();
		$Disburse_Payments->CurrentFilter = $sFilter;
		$sSql = $Disburse_Payments->SQL();
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

			// code
			$Disburse_Payments->code->SetDbValueDef($rsnew, $Disburse_Payments->code->CurrentValue, NULL, FALSE);

			// request_status
			$Disburse_Payments->request_status->SetDbValueDef($rsnew, $Disburse_Payments->request_status->CurrentValue, NULL, FALSE);

			// financial_year_financial_year_id
			$Disburse_Payments->financial_year_financial_year_id->SetDbValueDef($rsnew, $Disburse_Payments->financial_year_financial_year_id->CurrentValue, 0, FALSE);

			// amount
			$Disburse_Payments->amount->SetDbValueDef($rsnew, $Disburse_Payments->amount->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $Disburse_Payments->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($Disburse_Payments->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($Disburse_Payments->CancelMessage <> "") {
					$this->setMessage($Disburse_Payments->CancelMessage);
					$Disburse_Payments->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$Disburse_Payments->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'Disburse Payments';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $Disburse_Payments;
		$table = 'Disburse Payments';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['payment_request_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if ($Disburse_Payments->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($Disburse_Payments->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($Disburse_Payments->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} elseif ($Disburse_Payments->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
