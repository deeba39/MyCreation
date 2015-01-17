<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "grant_packageinfo.php" ?>
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
$grant_package_add = new cgrant_package_add();
$Page =& $grant_package_add;

// Page init
$grant_package_add->Page_Init();

// Page main
$grant_package_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var grant_package_add = new ew_Page("grant_package_add");

// page properties
grant_package_add.PageID = "add"; // page ID
grant_package_add.FormID = "fgrant_packageadd"; // form ID
var EW_PAGE_ID = grant_package_add.PageID; // for backward compatibility

// extend page with ValidateForm function
grant_package_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($grant_package->name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_annual_amount"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($grant_package->annual_amount->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
grant_package_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grant_package_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grant_package_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grant_package->TableCaption() ?><br><br>
<a href="<?php echo $grant_package->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$grant_package_add->ShowMessage();
?>
<form name="fgrant_packageadd" id="fgrant_packageadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return grant_package_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="grant_package">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($grant_package->name->Visible) { // name ?>
	<tr<?php echo $grant_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grant_package->name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $grant_package->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" title="<?php echo $grant_package->name->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $grant_package->name->EditValue ?>"<?php echo $grant_package->name->EditAttributes() ?>>
</span><?php echo $grant_package->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grant_package->code->Visible) { // code ?>
	<tr<?php echo $grant_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grant_package->code->FldCaption() ?></td>
		<td<?php echo $grant_package->code->CellAttributes() ?>><span id="el_code">
<input type="text" name="x_code" id="x_code" title="<?php echo $grant_package->code->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $grant_package->code->EditValue ?>"<?php echo $grant_package->code->EditAttributes() ?>>
</span><?php echo $grant_package->code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($grant_package->annual_amount->Visible) { // annual_amount ?>
	<tr<?php echo $grant_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grant_package->annual_amount->FldCaption() ?></td>
		<td<?php echo $grant_package->annual_amount->CellAttributes() ?>><span id="el_annual_amount">
<input type="text" name="x_annual_amount" id="x_annual_amount" title="<?php echo $grant_package->annual_amount->FldTitle() ?>" size="30" value="<?php echo $grant_package->annual_amount->EditValue ?>"<?php echo $grant_package->annual_amount->EditAttributes() ?>>
</span><?php echo $grant_package->annual_amount->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$grant_package_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrant_package_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'grant_package';

	// Page object name
	var $PageObjName = 'grant_package_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grant_package;
		if ($grant_package->UseTokenInUrl) $PageUrl .= "t=" . $grant_package->TableVar . "&"; // Add page token
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
		global $objForm, $grant_package;
		if ($grant_package->UseTokenInUrl) {
			if ($objForm)
				return ($grant_package->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grant_package->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrant_package_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (grant_package)
		$GLOBALS["grant_package"] = new cgrant_package();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grant_package', TRUE);

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
		global $grant_package;

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("grant_packagelist.php");
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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $grant_package;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["grant_package_id"] != "") {
		  $grant_package->grant_package_id->setQueryStringValue($_GET["grant_package_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $grant_package->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$grant_package->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $grant_package->CurrentAction = "C"; // Copy record
		  } else {
		    $grant_package->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($grant_package->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("grant_packagelist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$grant_package->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $grant_package->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$grant_package->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $grant_package;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $grant_package;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $grant_package;
		$grant_package->name->setFormValue($objForm->GetValue("x_name"));
		$grant_package->code->setFormValue($objForm->GetValue("x_code"));
		$grant_package->annual_amount->setFormValue($objForm->GetValue("x_annual_amount"));
		$grant_package->grant_package_id->setFormValue($objForm->GetValue("x_grant_package_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $grant_package;
		$grant_package->grant_package_id->CurrentValue = $grant_package->grant_package_id->FormValue;
		$grant_package->name->CurrentValue = $grant_package->name->FormValue;
		$grant_package->code->CurrentValue = $grant_package->code->FormValue;
		$grant_package->annual_amount->CurrentValue = $grant_package->annual_amount->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $grant_package;
		$sFilter = $grant_package->KeyFilter();

		// Call Row Selecting event
		$grant_package->Row_Selecting($sFilter);

		// Load SQL based on filter
		$grant_package->CurrentFilter = $sFilter;
		$sSql = $grant_package->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$grant_package->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $grant_package;
		$grant_package->grant_package_id->setDbValue($rs->fields('grant_package_id'));
		$grant_package->name->setDbValue($rs->fields('name'));
		$grant_package->code->setDbValue($rs->fields('code'));
		$grant_package->annual_amount->setDbValue($rs->fields('annual_amount'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grant_package;

		// Initialize URLs
		// Call Row_Rendering event

		$grant_package->Row_Rendering();

		// Common render codes for all row types
		// name

		$grant_package->name->CellCssStyle = ""; $grant_package->name->CellCssClass = "";
		$grant_package->name->CellAttrs = array(); $grant_package->name->ViewAttrs = array(); $grant_package->name->EditAttrs = array();

		// code
		$grant_package->code->CellCssStyle = ""; $grant_package->code->CellCssClass = "";
		$grant_package->code->CellAttrs = array(); $grant_package->code->ViewAttrs = array(); $grant_package->code->EditAttrs = array();

		// annual_amount
		$grant_package->annual_amount->CellCssStyle = ""; $grant_package->annual_amount->CellCssClass = "";
		$grant_package->annual_amount->CellAttrs = array(); $grant_package->annual_amount->ViewAttrs = array(); $grant_package->annual_amount->EditAttrs = array();
		if ($grant_package->RowType == EW_ROWTYPE_VIEW) { // View row

			// grant_package_id
			$grant_package->grant_package_id->ViewValue = $grant_package->grant_package_id->CurrentValue;
			$grant_package->grant_package_id->CssStyle = "";
			$grant_package->grant_package_id->CssClass = "";
			$grant_package->grant_package_id->ViewCustomAttributes = "";

			// name
			$grant_package->name->ViewValue = $grant_package->name->CurrentValue;
			$grant_package->name->CssStyle = "";
			$grant_package->name->CssClass = "";
			$grant_package->name->ViewCustomAttributes = "";

			// code
			$grant_package->code->ViewValue = $grant_package->code->CurrentValue;
			$grant_package->code->CssStyle = "";
			$grant_package->code->CssClass = "";
			$grant_package->code->ViewCustomAttributes = "";

			// annual_amount
			$grant_package->annual_amount->ViewValue = $grant_package->annual_amount->CurrentValue;
			$grant_package->annual_amount->CssStyle = "";
			$grant_package->annual_amount->CssClass = "";
			$grant_package->annual_amount->ViewCustomAttributes = "";

			// name
			$grant_package->name->HrefValue = "";
			$grant_package->name->TooltipValue = "";

			// code
			$grant_package->code->HrefValue = "";
			$grant_package->code->TooltipValue = "";

			// annual_amount
			$grant_package->annual_amount->HrefValue = "";
			$grant_package->annual_amount->TooltipValue = "";
		} elseif ($grant_package->RowType == EW_ROWTYPE_ADD) { // Add row

			// name
			$grant_package->name->EditCustomAttributes = "";
			$grant_package->name->EditValue = ew_HtmlEncode($grant_package->name->CurrentValue);

			// code
			$grant_package->code->EditCustomAttributes = "";
			$grant_package->code->EditValue = ew_HtmlEncode($grant_package->code->CurrentValue);

			// annual_amount
			$grant_package->annual_amount->EditCustomAttributes = "";
			$grant_package->annual_amount->EditValue = ew_HtmlEncode($grant_package->annual_amount->CurrentValue);
		}

		// Call Row Rendered event
		if ($grant_package->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grant_package->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $grant_package;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($grant_package->name->FormValue) && $grant_package->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $grant_package->name->FldCaption();
		}
		if (!ew_CheckNumber($grant_package->annual_amount->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $grant_package->annual_amount->FldErrMsg();
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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $grant_package;
		$rsnew = array();

		// name
		$grant_package->name->SetDbValueDef($rsnew, $grant_package->name->CurrentValue, NULL, FALSE);

		// code
		$grant_package->code->SetDbValueDef($rsnew, $grant_package->code->CurrentValue, NULL, FALSE);

		// annual_amount
		$grant_package->annual_amount->SetDbValueDef($rsnew, $grant_package->annual_amount->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $grant_package->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($grant_package->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($grant_package->CancelMessage <> "") {
				$this->setMessage($grant_package->CancelMessage);
				$grant_package->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$grant_package->grant_package_id->setDbValue($conn->Insert_ID());
			$rsnew['grant_package_id'] = $grant_package->grant_package_id->DbValue;

			// Call Row Inserted event
			$grant_package->Row_Inserted($rsnew);
		}
		return $AddRow;
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
