<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "academic_yearinfo.php" ?>
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
$academic_year_edit = new cacademic_year_edit();
$Page =& $academic_year_edit;

// Page init
$academic_year_edit->Page_Init();

// Page main
$academic_year_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var academic_year_edit = new ew_Page("academic_year_edit");

// page properties
academic_year_edit.PageID = "edit"; // page ID
academic_year_edit.FormID = "facademic_yearedit"; // form ID
var EW_PAGE_ID = academic_year_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
academic_year_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_app_year"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($academic_year->app_year->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_app_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($academic_year->app_year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_active"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($academic_year->active->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
academic_year_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
academic_year_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
academic_year_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $academic_year->TableCaption() ?><br><br>
<a href="<?php echo $academic_year->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$academic_year_edit->ShowMessage();
?>
<form name="facademic_yearedit" id="facademic_yearedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return academic_year_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="academic_year">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($academic_year->app_year->Visible) { // app_year ?>
	<tr<?php echo $academic_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $academic_year->app_year->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $academic_year->app_year->CellAttributes() ?>><span id="el_app_year">
<div<?php echo $academic_year->app_year->ViewAttributes() ?>><?php echo $academic_year->app_year->EditValue ?></div><input type="hidden" name="x_app_year" id="x_app_year" value="<?php echo ew_HtmlEncode($academic_year->app_year->CurrentValue) ?>">
</span><?php echo $academic_year->app_year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($academic_year->active->Visible) { // active ?>
	<tr<?php echo $academic_year->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $academic_year->active->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $academic_year->active->CellAttributes() ?>><span id="el_active">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_active" id="x_active" title="<?php echo $academic_year->active->FldTitle() ?>" value="{value}"<?php echo $academic_year->active->EditAttributes() ?>></label></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $academic_year->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($academic_year->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_active" id="x_active" title="<?php echo $academic_year->active->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $academic_year->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $academic_year->active->CustomMsg ?></td>
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
$academic_year_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cacademic_year_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'academic_year';

	// Page object name
	var $PageObjName = 'academic_year_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $academic_year;
		if ($academic_year->UseTokenInUrl) $PageUrl .= "t=" . $academic_year->TableVar . "&"; // Add page token
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
		global $objForm, $academic_year;
		if ($academic_year->UseTokenInUrl) {
			if ($objForm)
				return ($academic_year->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($academic_year->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cacademic_year_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (academic_year)
		$GLOBALS["academic_year"] = new cacademic_year();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'academic_year', TRUE);

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
		global $academic_year;

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
			$this->Page_Terminate("academic_yearlist.php");
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
		global $objForm, $Language, $gsFormError, $academic_year;

		// Load key from QueryString
		if (@$_GET["app_year"] <> "")
			$academic_year->app_year->setQueryStringValue($_GET["app_year"]);
		if (@$_POST["a_edit"] <> "") {
			$academic_year->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$academic_year->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$academic_year->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$academic_year->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($academic_year->app_year->CurrentValue == "")
			$this->Page_Terminate("academic_yearlist.php"); // Invalid key, return to list
		switch ($academic_year->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("academic_yearlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$academic_year->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $academic_year->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$academic_year->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$academic_year->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $academic_year;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $academic_year;
		$academic_year->app_year->setFormValue($objForm->GetValue("x_app_year"));
		$academic_year->active->setFormValue($objForm->GetValue("x_active"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $academic_year;
		$this->LoadRow();
		$academic_year->app_year->CurrentValue = $academic_year->app_year->FormValue;
		$academic_year->active->CurrentValue = $academic_year->active->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $academic_year;
		$sFilter = $academic_year->KeyFilter();

		// Call Row Selecting event
		$academic_year->Row_Selecting($sFilter);

		// Load SQL based on filter
		$academic_year->CurrentFilter = $sFilter;
		$sSql = $academic_year->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$academic_year->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $academic_year;
		$academic_year->app_year->setDbValue($rs->fields('app_year'));
		$academic_year->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $academic_year;

		// Initialize URLs
		// Call Row_Rendering event

		$academic_year->Row_Rendering();

		// Common render codes for all row types
		// app_year

		$academic_year->app_year->CellCssStyle = ""; $academic_year->app_year->CellCssClass = "";
		$academic_year->app_year->CellAttrs = array(); $academic_year->app_year->ViewAttrs = array(); $academic_year->app_year->EditAttrs = array();

		// active
		$academic_year->active->CellCssStyle = ""; $academic_year->active->CellCssClass = "";
		$academic_year->active->CellAttrs = array(); $academic_year->active->ViewAttrs = array(); $academic_year->active->EditAttrs = array();
		if ($academic_year->RowType == EW_ROWTYPE_VIEW) { // View row

			// app_year
			$academic_year->app_year->ViewValue = $academic_year->app_year->CurrentValue;
			$academic_year->app_year->CssStyle = "";
			$academic_year->app_year->CssClass = "";
			$academic_year->app_year->ViewCustomAttributes = "";

			// active
			if (strval($academic_year->active->CurrentValue) <> "") {
				switch ($academic_year->active->CurrentValue) {
					case "ADMISSION":
						$academic_year->active->ViewValue = "ADMISSION";
						break;
					case "GRADE_RECORDING":
						$academic_year->active->ViewValue = "GRADE_RECORDING";
						break;
					case "INACTIVE":
						$academic_year->active->ViewValue = "INACTIVE";
						break;
					default:
						$academic_year->active->ViewValue = $academic_year->active->CurrentValue;
				}
			} else {
				$academic_year->active->ViewValue = NULL;
			}
			$academic_year->active->CssStyle = "";
			$academic_year->active->CssClass = "";
			$academic_year->active->ViewCustomAttributes = "";

			// app_year
			$academic_year->app_year->HrefValue = "";
			$academic_year->app_year->TooltipValue = "";

			// active
			$academic_year->active->HrefValue = "";
			$academic_year->active->TooltipValue = "";
		} elseif ($academic_year->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// app_year
			$academic_year->app_year->EditCustomAttributes = "";
			$academic_year->app_year->EditValue = $academic_year->app_year->CurrentValue;
			$academic_year->app_year->CssStyle = "";
			$academic_year->app_year->CssClass = "";
			$academic_year->app_year->ViewCustomAttributes = "";

			// active
			$academic_year->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("ADMISSION", "ADMISSION");
			$arwrk[] = array("GRADE_RECORDING", "GRADE_RECORDING");
			$arwrk[] = array("INACTIVE", "INACTIVE");
			$academic_year->active->EditValue = $arwrk;

			// Edit refer script
			// app_year

			$academic_year->app_year->HrefValue = "";

			// active
			$academic_year->active->HrefValue = "";
		}

		// Call Row Rendered event
		if ($academic_year->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$academic_year->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $academic_year;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($academic_year->app_year->FormValue) && $academic_year->app_year->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $academic_year->app_year->FldCaption();
		}
		if (!ew_CheckInteger($academic_year->app_year->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $academic_year->app_year->FldErrMsg();
		}
		if ($academic_year->active->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $academic_year->active->FldCaption();
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
		global $conn, $Security, $Language, $academic_year;
		$sFilter = $academic_year->KeyFilter();
		$academic_year->CurrentFilter = $sFilter;
		$sSql = $academic_year->SQL();
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

			// app_year
			// active

			$academic_year->active->SetDbValueDef($rsnew, $academic_year->active->CurrentValue, "", FALSE);

			// Call Row Updating event
			$bUpdateRow = $academic_year->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($academic_year->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($academic_year->CancelMessage <> "") {
					$this->setMessage($academic_year->CancelMessage);
					$academic_year->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$academic_year->Row_Updated($rsold, $rsnew);
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
