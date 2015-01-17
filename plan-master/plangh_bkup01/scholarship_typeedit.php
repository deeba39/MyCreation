<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "scholarship_typeinfo.php" ?>
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
$scholarship_type_edit = new cscholarship_type_edit();
$Page =& $scholarship_type_edit;

// Page init
$scholarship_type_edit->Page_Init();

// Page main
$scholarship_type_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_type_edit = new ew_Page("scholarship_type_edit");

// page properties
scholarship_type_edit.PageID = "edit"; // page ID
scholarship_type_edit.FormID = "fscholarship_typeedit"; // form ID
var EW_PAGE_ID = scholarship_type_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
scholarship_type_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_scholarship_type_scale"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_type->scholarship_type_scale->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
scholarship_type_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_type_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_type_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_type->TableCaption() ?><br><br>
<a href="<?php echo $scholarship_type->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$scholarship_type_edit->ShowMessage();
?>
<form name="fscholarship_typeedit" id="fscholarship_typeedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return scholarship_type_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="scholarship_type">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($scholarship_type->scholarship_type_id->Visible) { // scholarship_type_id ?>
	<tr<?php echo $scholarship_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_type->scholarship_type_id->FldCaption() ?></td>
		<td<?php echo $scholarship_type->scholarship_type_id->CellAttributes() ?>><span id="el_scholarship_type_id">
<div<?php echo $scholarship_type->scholarship_type_id->ViewAttributes() ?>><?php echo $scholarship_type->scholarship_type_id->EditValue ?></div><input type="hidden" name="x_scholarship_type_id" id="x_scholarship_type_id" value="<?php echo ew_HtmlEncode($scholarship_type->scholarship_type_id->CurrentValue) ?>">
</span><?php echo $scholarship_type->scholarship_type_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_type->scholarship_type_name->Visible) { // scholarship_type_name ?>
	<tr<?php echo $scholarship_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_type->scholarship_type_name->FldCaption() ?></td>
		<td<?php echo $scholarship_type->scholarship_type_name->CellAttributes() ?>><span id="el_scholarship_type_name">
<input type="text" name="x_scholarship_type_name" id="x_scholarship_type_name" title="<?php echo $scholarship_type->scholarship_type_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $scholarship_type->scholarship_type_name->EditValue ?>"<?php echo $scholarship_type->scholarship_type_name->EditAttributes() ?>>
</span><?php echo $scholarship_type->scholarship_type_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_type->scholarship_type_scale->Visible) { // scholarship_type_scale ?>
	<tr<?php echo $scholarship_type->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_type->scholarship_type_scale->FldCaption() ?></td>
		<td<?php echo $scholarship_type->scholarship_type_scale->CellAttributes() ?>><span id="el_scholarship_type_scale">
<input type="text" name="x_scholarship_type_scale" id="x_scholarship_type_scale" title="<?php echo $scholarship_type->scholarship_type_scale->FldTitle() ?>" size="30" value="<?php echo $scholarship_type->scholarship_type_scale->EditValue ?>"<?php echo $scholarship_type->scholarship_type_scale->EditAttributes() ?>>
</span><?php echo $scholarship_type->scholarship_type_scale->CustomMsg ?></td>
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
$scholarship_type_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_type_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'scholarship_type';

	// Page object name
	var $PageObjName = 'scholarship_type_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $scholarship_type;
		if ($scholarship_type->UseTokenInUrl) $PageUrl .= "t=" . $scholarship_type->TableVar . "&"; // Add page token
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
		global $objForm, $scholarship_type;
		if ($scholarship_type->UseTokenInUrl) {
			if ($objForm)
				return ($scholarship_type->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($scholarship_type->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cscholarship_type_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (scholarship_type)
		$GLOBALS["scholarship_type"] = new cscholarship_type();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'scholarship_type', TRUE);

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
		global $scholarship_type;

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
			$this->Page_Terminate("scholarship_typelist.php");
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
		global $objForm, $Language, $gsFormError, $scholarship_type;

		// Load key from QueryString
		if (@$_GET["scholarship_type_id"] <> "")
			$scholarship_type->scholarship_type_id->setQueryStringValue($_GET["scholarship_type_id"]);
		if (@$_POST["a_edit"] <> "") {
			$scholarship_type->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$scholarship_type->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$scholarship_type->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$scholarship_type->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($scholarship_type->scholarship_type_id->CurrentValue == "")
			$this->Page_Terminate("scholarship_typelist.php"); // Invalid key, return to list
		switch ($scholarship_type->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("scholarship_typelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$scholarship_type->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $scholarship_type->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$scholarship_type->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$scholarship_type->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $scholarship_type;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $scholarship_type;
		$scholarship_type->scholarship_type_id->setFormValue($objForm->GetValue("x_scholarship_type_id"));
		$scholarship_type->scholarship_type_name->setFormValue($objForm->GetValue("x_scholarship_type_name"));
		$scholarship_type->scholarship_type_scale->setFormValue($objForm->GetValue("x_scholarship_type_scale"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $scholarship_type;
		$this->LoadRow();
		$scholarship_type->scholarship_type_id->CurrentValue = $scholarship_type->scholarship_type_id->FormValue;
		$scholarship_type->scholarship_type_name->CurrentValue = $scholarship_type->scholarship_type_name->FormValue;
		$scholarship_type->scholarship_type_scale->CurrentValue = $scholarship_type->scholarship_type_scale->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $scholarship_type;
		$sFilter = $scholarship_type->KeyFilter();

		// Call Row Selecting event
		$scholarship_type->Row_Selecting($sFilter);

		// Load SQL based on filter
		$scholarship_type->CurrentFilter = $sFilter;
		$sSql = $scholarship_type->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$scholarship_type->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $scholarship_type;
		$scholarship_type->scholarship_type_id->setDbValue($rs->fields('scholarship_type_id'));
		$scholarship_type->scholarship_type_name->setDbValue($rs->fields('scholarship_type_name'));
		$scholarship_type->scholarship_type_scale->setDbValue($rs->fields('scholarship_type_scale'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $scholarship_type;

		// Initialize URLs
		// Call Row_Rendering event

		$scholarship_type->Row_Rendering();

		// Common render codes for all row types
		// scholarship_type_id

		$scholarship_type->scholarship_type_id->CellCssStyle = ""; $scholarship_type->scholarship_type_id->CellCssClass = "";
		$scholarship_type->scholarship_type_id->CellAttrs = array(); $scholarship_type->scholarship_type_id->ViewAttrs = array(); $scholarship_type->scholarship_type_id->EditAttrs = array();

		// scholarship_type_name
		$scholarship_type->scholarship_type_name->CellCssStyle = ""; $scholarship_type->scholarship_type_name->CellCssClass = "";
		$scholarship_type->scholarship_type_name->CellAttrs = array(); $scholarship_type->scholarship_type_name->ViewAttrs = array(); $scholarship_type->scholarship_type_name->EditAttrs = array();

		// scholarship_type_scale
		$scholarship_type->scholarship_type_scale->CellCssStyle = ""; $scholarship_type->scholarship_type_scale->CellCssClass = "";
		$scholarship_type->scholarship_type_scale->CellAttrs = array(); $scholarship_type->scholarship_type_scale->ViewAttrs = array(); $scholarship_type->scholarship_type_scale->EditAttrs = array();
		if ($scholarship_type->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_type_id
			$scholarship_type->scholarship_type_id->ViewValue = $scholarship_type->scholarship_type_id->CurrentValue;
			$scholarship_type->scholarship_type_id->CssStyle = "";
			$scholarship_type->scholarship_type_id->CssClass = "";
			$scholarship_type->scholarship_type_id->ViewCustomAttributes = "";

			// scholarship_type_name
			$scholarship_type->scholarship_type_name->ViewValue = $scholarship_type->scholarship_type_name->CurrentValue;
			$scholarship_type->scholarship_type_name->CssStyle = "";
			$scholarship_type->scholarship_type_name->CssClass = "";
			$scholarship_type->scholarship_type_name->ViewCustomAttributes = "";

			// scholarship_type_scale
			$scholarship_type->scholarship_type_scale->ViewValue = $scholarship_type->scholarship_type_scale->CurrentValue;
			$scholarship_type->scholarship_type_scale->CssStyle = "";
			$scholarship_type->scholarship_type_scale->CssClass = "";
			$scholarship_type->scholarship_type_scale->ViewCustomAttributes = "";

			// scholarship_type_id
			$scholarship_type->scholarship_type_id->HrefValue = "";
			$scholarship_type->scholarship_type_id->TooltipValue = "";

			// scholarship_type_name
			$scholarship_type->scholarship_type_name->HrefValue = "";
			$scholarship_type->scholarship_type_name->TooltipValue = "";

			// scholarship_type_scale
			$scholarship_type->scholarship_type_scale->HrefValue = "";
			$scholarship_type->scholarship_type_scale->TooltipValue = "";
		} elseif ($scholarship_type->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// scholarship_type_id
			$scholarship_type->scholarship_type_id->EditCustomAttributes = "";
			$scholarship_type->scholarship_type_id->EditValue = $scholarship_type->scholarship_type_id->CurrentValue;
			$scholarship_type->scholarship_type_id->CssStyle = "";
			$scholarship_type->scholarship_type_id->CssClass = "";
			$scholarship_type->scholarship_type_id->ViewCustomAttributes = "";

			// scholarship_type_name
			$scholarship_type->scholarship_type_name->EditCustomAttributes = "";
			$scholarship_type->scholarship_type_name->EditValue = ew_HtmlEncode($scholarship_type->scholarship_type_name->CurrentValue);

			// scholarship_type_scale
			$scholarship_type->scholarship_type_scale->EditCustomAttributes = "";
			$scholarship_type->scholarship_type_scale->EditValue = ew_HtmlEncode($scholarship_type->scholarship_type_scale->CurrentValue);

			// Edit refer script
			// scholarship_type_id

			$scholarship_type->scholarship_type_id->HrefValue = "";

			// scholarship_type_name
			$scholarship_type->scholarship_type_name->HrefValue = "";

			// scholarship_type_scale
			$scholarship_type->scholarship_type_scale->HrefValue = "";
		}

		// Call Row Rendered event
		if ($scholarship_type->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$scholarship_type->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $scholarship_type;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckNumber($scholarship_type->scholarship_type_scale->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $scholarship_type->scholarship_type_scale->FldErrMsg();
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
		global $conn, $Security, $Language, $scholarship_type;
		$sFilter = $scholarship_type->KeyFilter();
		$scholarship_type->CurrentFilter = $sFilter;
		$sSql = $scholarship_type->SQL();
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

			// scholarship_type_name
			$scholarship_type->scholarship_type_name->SetDbValueDef($rsnew, $scholarship_type->scholarship_type_name->CurrentValue, NULL, FALSE);

			// scholarship_type_scale
			$scholarship_type->scholarship_type_scale->SetDbValueDef($rsnew, $scholarship_type->scholarship_type_scale->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $scholarship_type->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($scholarship_type->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($scholarship_type->CancelMessage <> "") {
					$this->setMessage($scholarship_type->CancelMessage);
					$scholarship_type->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$scholarship_type->Row_Updated($rsold, $rsnew);
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
