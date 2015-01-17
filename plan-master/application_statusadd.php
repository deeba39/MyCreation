<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "application_statusinfo.php" ?>
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
$application_status_add = new capplication_status_add();
$Page =& $application_status_add;

// Page init
$application_status_add->Page_Init();

// Page main
$application_status_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var application_status_add = new ew_Page("application_status_add");

// page properties
application_status_add.PageID = "add"; // page ID
application_status_add.FormID = "fapplication_statusadd"; // form ID
var EW_PAGE_ID = application_status_add.PageID; // for backward compatibility

// extend page with ValidateForm function
application_status_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_application_status_1"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($application_status->application_status_1->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
application_status_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
application_status_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
application_status_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $application_status->TableCaption() ?><br><br>
<a href="<?php echo $application_status->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$application_status_add->ShowMessage();
?>
<form name="fapplication_statusadd" id="fapplication_statusadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return application_status_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="application_status">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($application_status->application_status_1->Visible) { // application_status ?>
	<tr<?php echo $application_status->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $application_status->application_status_1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $application_status->application_status_1->CellAttributes() ?>><span id="el_application_status_1">
<input type="text" name="x_application_status_1" id="x_application_status_1" title="<?php echo $application_status->application_status_1->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $application_status->application_status_1->EditValue ?>"<?php echo $application_status->application_status_1->EditAttributes() ?>>
</span><?php echo $application_status->application_status_1->CustomMsg ?></td>
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
$application_status_add->Page_Terminate();
?>
<?php

//
// Page class
//
class capplication_status_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'application_status';

	// Page object name
	var $PageObjName = 'application_status_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $application_status;
		if ($application_status->UseTokenInUrl) $PageUrl .= "t=" . $application_status->TableVar . "&"; // Add page token
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
		global $objForm, $application_status;
		if ($application_status->UseTokenInUrl) {
			if ($objForm)
				return ($application_status->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($application_status->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function capplication_status_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (application_status)
		$GLOBALS["application_status"] = new capplication_status();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'application_status', TRUE);

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
		global $application_status;

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
			$this->Page_Terminate("application_statuslist.php");
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
		global $objForm, $Language, $gsFormError, $application_status;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["application_status_id"] != "") {
		  $application_status->application_status_id->setQueryStringValue($_GET["application_status_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $application_status->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$application_status->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $application_status->CurrentAction = "C"; // Copy record
		  } else {
		    $application_status->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($application_status->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("application_statuslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$application_status->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $application_status->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$application_status->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $application_status;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $application_status;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $application_status;
		$application_status->application_status_1->setFormValue($objForm->GetValue("x_application_status_1"));
		$application_status->application_status_id->setFormValue($objForm->GetValue("x_application_status_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $application_status;
		$application_status->application_status_id->CurrentValue = $application_status->application_status_id->FormValue;
		$application_status->application_status_1->CurrentValue = $application_status->application_status_1->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $application_status;
		$sFilter = $application_status->KeyFilter();

		// Call Row Selecting event
		$application_status->Row_Selecting($sFilter);

		// Load SQL based on filter
		$application_status->CurrentFilter = $sFilter;
		$sSql = $application_status->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$application_status->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $application_status;
		$application_status->application_status_id->setDbValue($rs->fields('application_status_id'));
		$application_status->application_status_1->setDbValue($rs->fields('application_status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $application_status;

		// Initialize URLs
		// Call Row_Rendering event

		$application_status->Row_Rendering();

		// Common render codes for all row types
		// application_status

		$application_status->application_status_1->CellCssStyle = ""; $application_status->application_status_1->CellCssClass = "";
		$application_status->application_status_1->CellAttrs = array(); $application_status->application_status_1->ViewAttrs = array(); $application_status->application_status_1->EditAttrs = array();
		if ($application_status->RowType == EW_ROWTYPE_VIEW) { // View row

			// application_status_id
			$application_status->application_status_id->ViewValue = $application_status->application_status_id->CurrentValue;
			$application_status->application_status_id->CssStyle = "";
			$application_status->application_status_id->CssClass = "";
			$application_status->application_status_id->ViewCustomAttributes = "";

			// application_status
			$application_status->application_status_1->ViewValue = $application_status->application_status_1->CurrentValue;
			$application_status->application_status_1->CssStyle = "";
			$application_status->application_status_1->CssClass = "";
			$application_status->application_status_1->ViewCustomAttributes = "";

			// application_status
			$application_status->application_status_1->HrefValue = "";
			$application_status->application_status_1->TooltipValue = "";
		} elseif ($application_status->RowType == EW_ROWTYPE_ADD) { // Add row

			// application_status
			$application_status->application_status_1->EditCustomAttributes = "";
			$application_status->application_status_1->EditValue = ew_HtmlEncode($application_status->application_status_1->CurrentValue);
		}

		// Call Row Rendered event
		if ($application_status->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$application_status->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $application_status;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($application_status->application_status_1->FormValue) && $application_status->application_status_1->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $application_status->application_status_1->FldCaption();
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
		global $conn, $Language, $Security, $application_status;
		$rsnew = array();

		// application_status
		$application_status->application_status_1->SetDbValueDef($rsnew, $application_status->application_status_1->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$bInsertRow = $application_status->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($application_status->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($application_status->CancelMessage <> "") {
				$this->setMessage($application_status->CancelMessage);
				$application_status->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$application_status->application_status_id->setDbValue($conn->Insert_ID());
			$rsnew['application_status_id'] = $application_status->application_status_id->DbValue;

			// Call Row Inserted event
			$application_status->Row_Inserted($rsnew);
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
