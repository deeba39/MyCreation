<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "application_occupationinfo.php" ?>
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
$application_occupation_add = new capplication_occupation_add();
$Page =& $application_occupation_add;

// Page init
$application_occupation_add->Page_Init();

// Page main
$application_occupation_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var application_occupation_add = new ew_Page("application_occupation_add");

// page properties
application_occupation_add.PageID = "add"; // page ID
application_occupation_add.FormID = "fapplication_occupationadd"; // form ID
var EW_PAGE_ID = application_occupation_add.PageID; // for backward compatibility

// extend page with ValidateForm function
application_occupation_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($application_occupation->name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_app_point"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($application_occupation->app_point->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
application_occupation_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
application_occupation_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
application_occupation_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $application_occupation->TableCaption() ?><br><br>
<a href="<?php echo $application_occupation->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$application_occupation_add->ShowMessage();
?>
<form name="fapplication_occupationadd" id="fapplication_occupationadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return application_occupation_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="application_occupation">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($application_occupation->name->Visible) { // name ?>
	<tr<?php echo $application_occupation->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $application_occupation->name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $application_occupation->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" title="<?php echo $application_occupation->name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $application_occupation->name->EditValue ?>"<?php echo $application_occupation->name->EditAttributes() ?>>
</span><?php echo $application_occupation->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($application_occupation->description->Visible) { // description ?>
	<tr<?php echo $application_occupation->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $application_occupation->description->FldCaption() ?></td>
		<td<?php echo $application_occupation->description->CellAttributes() ?>><span id="el_description">
<input type="text" name="x_description" id="x_description" title="<?php echo $application_occupation->description->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $application_occupation->description->EditValue ?>"<?php echo $application_occupation->description->EditAttributes() ?>>
</span><?php echo $application_occupation->description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($application_occupation->app_point->Visible) { // app_point ?>
	<tr<?php echo $application_occupation->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $application_occupation->app_point->FldCaption() ?></td>
		<td<?php echo $application_occupation->app_point->CellAttributes() ?>><span id="el_app_point">
<input type="text" name="x_app_point" id="x_app_point" title="<?php echo $application_occupation->app_point->FldTitle() ?>" size="30" value="<?php echo $application_occupation->app_point->EditValue ?>"<?php echo $application_occupation->app_point->EditAttributes() ?>>
</span><?php echo $application_occupation->app_point->CustomMsg ?></td>
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
$application_occupation_add->Page_Terminate();
?>
<?php

//
// Page class
//
class capplication_occupation_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'application_occupation';

	// Page object name
	var $PageObjName = 'application_occupation_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $application_occupation;
		if ($application_occupation->UseTokenInUrl) $PageUrl .= "t=" . $application_occupation->TableVar . "&"; // Add page token
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
		global $objForm, $application_occupation;
		if ($application_occupation->UseTokenInUrl) {
			if ($objForm)
				return ($application_occupation->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($application_occupation->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function capplication_occupation_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (application_occupation)
		$GLOBALS["application_occupation"] = new capplication_occupation();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'application_occupation', TRUE);

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
		global $application_occupation;

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
			$this->Page_Terminate("application_occupationlist.php");
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
		global $objForm, $Language, $gsFormError, $application_occupation;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["application_occupation_id"] != "") {
		  $application_occupation->application_occupation_id->setQueryStringValue($_GET["application_occupation_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $application_occupation->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$application_occupation->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $application_occupation->CurrentAction = "C"; // Copy record
		  } else {
		    $application_occupation->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($application_occupation->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("application_occupationlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$application_occupation->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $application_occupation->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$application_occupation->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $application_occupation;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $application_occupation;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $application_occupation;
		$application_occupation->name->setFormValue($objForm->GetValue("x_name"));
		$application_occupation->description->setFormValue($objForm->GetValue("x_description"));
		$application_occupation->app_point->setFormValue($objForm->GetValue("x_app_point"));
		$application_occupation->application_occupation_id->setFormValue($objForm->GetValue("x_application_occupation_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $application_occupation;
		$application_occupation->application_occupation_id->CurrentValue = $application_occupation->application_occupation_id->FormValue;
		$application_occupation->name->CurrentValue = $application_occupation->name->FormValue;
		$application_occupation->description->CurrentValue = $application_occupation->description->FormValue;
		$application_occupation->app_point->CurrentValue = $application_occupation->app_point->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $application_occupation;
		$sFilter = $application_occupation->KeyFilter();

		// Call Row Selecting event
		$application_occupation->Row_Selecting($sFilter);

		// Load SQL based on filter
		$application_occupation->CurrentFilter = $sFilter;
		$sSql = $application_occupation->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$application_occupation->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $application_occupation;
		$application_occupation->application_occupation_id->setDbValue($rs->fields('application_occupation_id'));
		$application_occupation->name->setDbValue($rs->fields('name'));
		$application_occupation->description->setDbValue($rs->fields('description'));
		$application_occupation->app_point->setDbValue($rs->fields('app_point'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $application_occupation;

		// Initialize URLs
		// Call Row_Rendering event

		$application_occupation->Row_Rendering();

		// Common render codes for all row types
		// name

		$application_occupation->name->CellCssStyle = ""; $application_occupation->name->CellCssClass = "";
		$application_occupation->name->CellAttrs = array(); $application_occupation->name->ViewAttrs = array(); $application_occupation->name->EditAttrs = array();

		// description
		$application_occupation->description->CellCssStyle = ""; $application_occupation->description->CellCssClass = "";
		$application_occupation->description->CellAttrs = array(); $application_occupation->description->ViewAttrs = array(); $application_occupation->description->EditAttrs = array();

		// app_point
		$application_occupation->app_point->CellCssStyle = ""; $application_occupation->app_point->CellCssClass = "";
		$application_occupation->app_point->CellAttrs = array(); $application_occupation->app_point->ViewAttrs = array(); $application_occupation->app_point->EditAttrs = array();
		if ($application_occupation->RowType == EW_ROWTYPE_VIEW) { // View row

			// application_occupation_id
			$application_occupation->application_occupation_id->ViewValue = $application_occupation->application_occupation_id->CurrentValue;
			$application_occupation->application_occupation_id->CssStyle = "";
			$application_occupation->application_occupation_id->CssClass = "";
			$application_occupation->application_occupation_id->ViewCustomAttributes = "";

			// name
			$application_occupation->name->ViewValue = $application_occupation->name->CurrentValue;
			$application_occupation->name->CssStyle = "";
			$application_occupation->name->CssClass = "";
			$application_occupation->name->ViewCustomAttributes = "";

			// description
			$application_occupation->description->ViewValue = $application_occupation->description->CurrentValue;
			$application_occupation->description->CssStyle = "";
			$application_occupation->description->CssClass = "";
			$application_occupation->description->ViewCustomAttributes = "";

			// app_point
			$application_occupation->app_point->ViewValue = $application_occupation->app_point->CurrentValue;
			$application_occupation->app_point->CssStyle = "";
			$application_occupation->app_point->CssClass = "";
			$application_occupation->app_point->ViewCustomAttributes = "";

			// name
			$application_occupation->name->HrefValue = "";
			$application_occupation->name->TooltipValue = "";

			// description
			$application_occupation->description->HrefValue = "";
			$application_occupation->description->TooltipValue = "";

			// app_point
			$application_occupation->app_point->HrefValue = "";
			$application_occupation->app_point->TooltipValue = "";
		} elseif ($application_occupation->RowType == EW_ROWTYPE_ADD) { // Add row

			// name
			$application_occupation->name->EditCustomAttributes = "";
			$application_occupation->name->EditValue = ew_HtmlEncode($application_occupation->name->CurrentValue);

			// description
			$application_occupation->description->EditCustomAttributes = "";
			$application_occupation->description->EditValue = ew_HtmlEncode($application_occupation->description->CurrentValue);

			// app_point
			$application_occupation->app_point->EditCustomAttributes = "";
			$application_occupation->app_point->EditValue = ew_HtmlEncode($application_occupation->app_point->CurrentValue);
		}

		// Call Row Rendered event
		if ($application_occupation->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$application_occupation->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $application_occupation;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($application_occupation->name->FormValue) && $application_occupation->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $application_occupation->name->FldCaption();
		}
		if (!ew_CheckInteger($application_occupation->app_point->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $application_occupation->app_point->FldErrMsg();
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
		global $conn, $Language, $Security, $application_occupation;
		$rsnew = array();

		// name
		$application_occupation->name->SetDbValueDef($rsnew, $application_occupation->name->CurrentValue, NULL, FALSE);

		// description
		$application_occupation->description->SetDbValueDef($rsnew, $application_occupation->description->CurrentValue, NULL, FALSE);

		// app_point
		$application_occupation->app_point->SetDbValueDef($rsnew, $application_occupation->app_point->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $application_occupation->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($application_occupation->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($application_occupation->CancelMessage <> "") {
				$this->setMessage($application_occupation->CancelMessage);
				$application_occupation->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$application_occupation->application_occupation_id->setDbValue($conn->Insert_ID());
			$rsnew['application_occupation_id'] = $application_occupation->application_occupation_id->DbValue;

			// Call Row Inserted event
			$application_occupation->Row_Inserted($rsnew);
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
