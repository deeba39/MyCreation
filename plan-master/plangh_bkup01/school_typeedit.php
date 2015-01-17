<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "school_typeinfo.php" ?>
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
$school_type_edit = new cschool_type_edit();
$Page =& $school_type_edit;

// Page init
$school_type_edit->Page_Init();

// Page main
$school_type_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var school_type_edit = new ew_Page("school_type_edit");

// page properties
school_type_edit.PageID = "edit"; // page ID
school_type_edit.FormID = "fschool_typeedit"; // form ID
var EW_PAGE_ID = school_type_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
school_type_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_school_type_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($school_type->school_type_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_school_type_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($school_type->school_type_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_school_type_1"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($school_type->school_type_1->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
school_type_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
school_type_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
school_type_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $school_type->TableCaption() ?><br><br>
<a href="<?php echo $school_type->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$school_type_edit->ShowMessage();
?>
<form name="fschool_typeedit" id="fschool_typeedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return school_type_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="school_type">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($school_type->school_type_id->Visible) { // school_type_id ?>
	<tr<?php echo $school_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_type->school_type_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $school_type->school_type_id->CellAttributes() ?>><span id="el_school_type_id">
<div<?php echo $school_type->school_type_id->ViewAttributes() ?>><?php echo $school_type->school_type_id->EditValue ?></div><input type="hidden" name="x_school_type_id" id="x_school_type_id" value="<?php echo ew_HtmlEncode($school_type->school_type_id->CurrentValue) ?>">
</span><?php echo $school_type->school_type_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($school_type->school_type_1->Visible) { // school_type ?>
	<tr<?php echo $school_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_type->school_type_1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $school_type->school_type_1->CellAttributes() ?>><span id="el_school_type_1">
<input type="text" name="x_school_type_1" id="x_school_type_1" title="<?php echo $school_type->school_type_1->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $school_type->school_type_1->EditValue ?>"<?php echo $school_type->school_type_1->EditAttributes() ?>>
</span><?php echo $school_type->school_type_1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($school_type->description->Visible) { // description ?>
	<tr<?php echo $school_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $school_type->description->FldCaption() ?></td>
		<td<?php echo $school_type->description->CellAttributes() ?>><span id="el_description">
<input type="text" name="x_description" id="x_description" title="<?php echo $school_type->description->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $school_type->description->EditValue ?>"<?php echo $school_type->description->EditAttributes() ?>>
</span><?php echo $school_type->description->CustomMsg ?></td>
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
$school_type_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cschool_type_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'school_type';

	// Page object name
	var $PageObjName = 'school_type_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $school_type;
		if ($school_type->UseTokenInUrl) $PageUrl .= "t=" . $school_type->TableVar . "&"; // Add page token
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
		global $objForm, $school_type;
		if ($school_type->UseTokenInUrl) {
			if ($objForm)
				return ($school_type->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($school_type->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cschool_type_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (school_type)
		$GLOBALS["school_type"] = new cschool_type();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'school_type', TRUE);

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
		global $school_type;

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
			$this->Page_Terminate("school_typelist.php");
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
		global $objForm, $Language, $gsFormError, $school_type;

		// Load key from QueryString
		if (@$_GET["school_type_id"] <> "")
			$school_type->school_type_id->setQueryStringValue($_GET["school_type_id"]);
		if (@$_POST["a_edit"] <> "") {
			$school_type->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$school_type->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$school_type->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$school_type->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($school_type->school_type_id->CurrentValue == "")
			$this->Page_Terminate("school_typelist.php"); // Invalid key, return to list
		switch ($school_type->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("school_typelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$school_type->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $school_type->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$school_type->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$school_type->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $school_type;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $school_type;
		$school_type->school_type_id->setFormValue($objForm->GetValue("x_school_type_id"));
		$school_type->school_type_1->setFormValue($objForm->GetValue("x_school_type_1"));
		$school_type->description->setFormValue($objForm->GetValue("x_description"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $school_type;
		$this->LoadRow();
		$school_type->school_type_id->CurrentValue = $school_type->school_type_id->FormValue;
		$school_type->school_type_1->CurrentValue = $school_type->school_type_1->FormValue;
		$school_type->description->CurrentValue = $school_type->description->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $school_type;
		$sFilter = $school_type->KeyFilter();

		// Call Row Selecting event
		$school_type->Row_Selecting($sFilter);

		// Load SQL based on filter
		$school_type->CurrentFilter = $sFilter;
		$sSql = $school_type->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$school_type->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $school_type;
		$school_type->school_type_id->setDbValue($rs->fields('school_type_id'));
		$school_type->school_type_1->setDbValue($rs->fields('school_type'));
		$school_type->description->setDbValue($rs->fields('description'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $school_type;

		// Initialize URLs
		// Call Row_Rendering event

		$school_type->Row_Rendering();

		// Common render codes for all row types
		// school_type_id

		$school_type->school_type_id->CellCssStyle = ""; $school_type->school_type_id->CellCssClass = "";
		$school_type->school_type_id->CellAttrs = array(); $school_type->school_type_id->ViewAttrs = array(); $school_type->school_type_id->EditAttrs = array();

		// school_type
		$school_type->school_type_1->CellCssStyle = ""; $school_type->school_type_1->CellCssClass = "";
		$school_type->school_type_1->CellAttrs = array(); $school_type->school_type_1->ViewAttrs = array(); $school_type->school_type_1->EditAttrs = array();

		// description
		$school_type->description->CellCssStyle = ""; $school_type->description->CellCssClass = "";
		$school_type->description->CellAttrs = array(); $school_type->description->ViewAttrs = array(); $school_type->description->EditAttrs = array();
		if ($school_type->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_type_id
			$school_type->school_type_id->ViewValue = $school_type->school_type_id->CurrentValue;
			$school_type->school_type_id->CssStyle = "";
			$school_type->school_type_id->CssClass = "";
			$school_type->school_type_id->ViewCustomAttributes = "";

			// school_type
			$school_type->school_type_1->ViewValue = $school_type->school_type_1->CurrentValue;
			$school_type->school_type_1->CssStyle = "";
			$school_type->school_type_1->CssClass = "";
			$school_type->school_type_1->ViewCustomAttributes = "";

			// description
			$school_type->description->ViewValue = $school_type->description->CurrentValue;
			$school_type->description->CssStyle = "";
			$school_type->description->CssClass = "";
			$school_type->description->ViewCustomAttributes = "";

			// school_type_id
			$school_type->school_type_id->HrefValue = "";
			$school_type->school_type_id->TooltipValue = "";

			// school_type
			$school_type->school_type_1->HrefValue = "";
			$school_type->school_type_1->TooltipValue = "";

			// description
			$school_type->description->HrefValue = "";
			$school_type->description->TooltipValue = "";
		} elseif ($school_type->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// school_type_id
			$school_type->school_type_id->EditCustomAttributes = "";
			$school_type->school_type_id->EditValue = $school_type->school_type_id->CurrentValue;
			$school_type->school_type_id->CssStyle = "";
			$school_type->school_type_id->CssClass = "";
			$school_type->school_type_id->ViewCustomAttributes = "";

			// school_type
			$school_type->school_type_1->EditCustomAttributes = "";
			$school_type->school_type_1->EditValue = ew_HtmlEncode($school_type->school_type_1->CurrentValue);

			// description
			$school_type->description->EditCustomAttributes = "";
			$school_type->description->EditValue = ew_HtmlEncode($school_type->description->CurrentValue);

			// Edit refer script
			// school_type_id

			$school_type->school_type_id->HrefValue = "";

			// school_type
			$school_type->school_type_1->HrefValue = "";

			// description
			$school_type->description->HrefValue = "";
		}

		// Call Row Rendered event
		if ($school_type->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$school_type->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $school_type;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($school_type->school_type_id->FormValue) && $school_type->school_type_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $school_type->school_type_id->FldCaption();
		}
		if (!ew_CheckInteger($school_type->school_type_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $school_type->school_type_id->FldErrMsg();
		}
		if (!is_null($school_type->school_type_1->FormValue) && $school_type->school_type_1->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $school_type->school_type_1->FldCaption();
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
		global $conn, $Security, $Language, $school_type;
		$sFilter = $school_type->KeyFilter();
		$school_type->CurrentFilter = $sFilter;
		$sSql = $school_type->SQL();
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

			// school_type
			$school_type->school_type_1->SetDbValueDef($rsnew, $school_type->school_type_1->CurrentValue, NULL, FALSE);

			// description
			$school_type->description->SetDbValueDef($rsnew, $school_type->description->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $school_type->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($school_type->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($school_type->CancelMessage <> "") {
					$this->setMessage($school_type->CancelMessage);
					$school_type->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$school_type->Row_Updated($rsold, $rsnew);
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
