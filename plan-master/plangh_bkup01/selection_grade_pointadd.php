<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "selection_grade_pointinfo.php" ?>
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
$selection_grade_point_add = new cselection_grade_point_add();
$Page =& $selection_grade_point_add;

// Page init
$selection_grade_point_add->Page_Init();

// Page main
$selection_grade_point_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var selection_grade_point_add = new ew_Page("selection_grade_point_add");

// page properties
selection_grade_point_add.PageID = "add"; // page ID
selection_grade_point_add.FormID = "fselection_grade_pointadd"; // form ID
var EW_PAGE_ID = selection_grade_point_add.PageID; // for backward compatibility

// extend page with ValidateForm function
selection_grade_point_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_selection_grade_points_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($selection_grade_point->selection_grade_points_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_selection_grade_points_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($selection_grade_point->selection_grade_points_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_grade_point"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($selection_grade_point->grade_point->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_min_grade"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($selection_grade_point->min_grade->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_max_grade"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($selection_grade_point->max_grade->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
selection_grade_point_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
selection_grade_point_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
selection_grade_point_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $selection_grade_point->TableCaption() ?><br><br>
<a href="<?php echo $selection_grade_point->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$selection_grade_point_add->ShowMessage();
?>
<form name="fselection_grade_pointadd" id="fselection_grade_pointadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return selection_grade_point_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="selection_grade_point">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($selection_grade_point->selection_grade_points_id->Visible) { // selection_grade_points_id ?>
	<tr<?php echo $selection_grade_point->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $selection_grade_point->selection_grade_points_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $selection_grade_point->selection_grade_points_id->CellAttributes() ?>><span id="el_selection_grade_points_id">
<input type="text" name="x_selection_grade_points_id" id="x_selection_grade_points_id" title="<?php echo $selection_grade_point->selection_grade_points_id->FldTitle() ?>" size="30" value="<?php echo $selection_grade_point->selection_grade_points_id->EditValue ?>"<?php echo $selection_grade_point->selection_grade_points_id->EditAttributes() ?>>
</span><?php echo $selection_grade_point->selection_grade_points_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($selection_grade_point->grade_point->Visible) { // grade_point ?>
	<tr<?php echo $selection_grade_point->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $selection_grade_point->grade_point->FldCaption() ?></td>
		<td<?php echo $selection_grade_point->grade_point->CellAttributes() ?>><span id="el_grade_point">
<input type="text" name="x_grade_point" id="x_grade_point" title="<?php echo $selection_grade_point->grade_point->FldTitle() ?>" size="30" value="<?php echo $selection_grade_point->grade_point->EditValue ?>"<?php echo $selection_grade_point->grade_point->EditAttributes() ?>>
</span><?php echo $selection_grade_point->grade_point->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($selection_grade_point->min_grade->Visible) { // min_grade ?>
	<tr<?php echo $selection_grade_point->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $selection_grade_point->min_grade->FldCaption() ?></td>
		<td<?php echo $selection_grade_point->min_grade->CellAttributes() ?>><span id="el_min_grade">
<input type="text" name="x_min_grade" id="x_min_grade" title="<?php echo $selection_grade_point->min_grade->FldTitle() ?>" size="30" value="<?php echo $selection_grade_point->min_grade->EditValue ?>"<?php echo $selection_grade_point->min_grade->EditAttributes() ?>>
</span><?php echo $selection_grade_point->min_grade->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($selection_grade_point->max_grade->Visible) { // max_grade ?>
	<tr<?php echo $selection_grade_point->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $selection_grade_point->max_grade->FldCaption() ?></td>
		<td<?php echo $selection_grade_point->max_grade->CellAttributes() ?>><span id="el_max_grade">
<input type="text" name="x_max_grade" id="x_max_grade" title="<?php echo $selection_grade_point->max_grade->FldTitle() ?>" size="30" value="<?php echo $selection_grade_point->max_grade->EditValue ?>"<?php echo $selection_grade_point->max_grade->EditAttributes() ?>>
</span><?php echo $selection_grade_point->max_grade->CustomMsg ?></td>
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
$selection_grade_point_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cselection_grade_point_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'selection_grade_point';

	// Page object name
	var $PageObjName = 'selection_grade_point_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $selection_grade_point;
		if ($selection_grade_point->UseTokenInUrl) $PageUrl .= "t=" . $selection_grade_point->TableVar . "&"; // Add page token
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
		global $objForm, $selection_grade_point;
		if ($selection_grade_point->UseTokenInUrl) {
			if ($objForm)
				return ($selection_grade_point->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($selection_grade_point->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cselection_grade_point_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (selection_grade_point)
		$GLOBALS["selection_grade_point"] = new cselection_grade_point();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'selection_grade_point', TRUE);

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
		global $selection_grade_point;

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
			$this->Page_Terminate("selection_grade_pointlist.php");
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
		global $objForm, $Language, $gsFormError, $selection_grade_point;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["selection_grade_points_id"] != "") {
		  $selection_grade_point->selection_grade_points_id->setQueryStringValue($_GET["selection_grade_points_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $selection_grade_point->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$selection_grade_point->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $selection_grade_point->CurrentAction = "C"; // Copy record
		  } else {
		    $selection_grade_point->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($selection_grade_point->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("selection_grade_pointlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$selection_grade_point->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $selection_grade_point->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$selection_grade_point->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $selection_grade_point;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $selection_grade_point;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $selection_grade_point;
		$selection_grade_point->selection_grade_points_id->setFormValue($objForm->GetValue("x_selection_grade_points_id"));
		$selection_grade_point->grade_point->setFormValue($objForm->GetValue("x_grade_point"));
		$selection_grade_point->min_grade->setFormValue($objForm->GetValue("x_min_grade"));
		$selection_grade_point->max_grade->setFormValue($objForm->GetValue("x_max_grade"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $selection_grade_point;
		$selection_grade_point->selection_grade_points_id->CurrentValue = $selection_grade_point->selection_grade_points_id->FormValue;
		$selection_grade_point->grade_point->CurrentValue = $selection_grade_point->grade_point->FormValue;
		$selection_grade_point->min_grade->CurrentValue = $selection_grade_point->min_grade->FormValue;
		$selection_grade_point->max_grade->CurrentValue = $selection_grade_point->max_grade->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $selection_grade_point;
		$sFilter = $selection_grade_point->KeyFilter();

		// Call Row Selecting event
		$selection_grade_point->Row_Selecting($sFilter);

		// Load SQL based on filter
		$selection_grade_point->CurrentFilter = $sFilter;
		$sSql = $selection_grade_point->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$selection_grade_point->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $selection_grade_point;
		$selection_grade_point->selection_grade_points_id->setDbValue($rs->fields('selection_grade_points_id'));
		$selection_grade_point->grade_point->setDbValue($rs->fields('grade_point'));
		$selection_grade_point->min_grade->setDbValue($rs->fields('min_grade'));
		$selection_grade_point->max_grade->setDbValue($rs->fields('max_grade'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $selection_grade_point;

		// Initialize URLs
		// Call Row_Rendering event

		$selection_grade_point->Row_Rendering();

		// Common render codes for all row types
		// selection_grade_points_id

		$selection_grade_point->selection_grade_points_id->CellCssStyle = ""; $selection_grade_point->selection_grade_points_id->CellCssClass = "";
		$selection_grade_point->selection_grade_points_id->CellAttrs = array(); $selection_grade_point->selection_grade_points_id->ViewAttrs = array(); $selection_grade_point->selection_grade_points_id->EditAttrs = array();

		// grade_point
		$selection_grade_point->grade_point->CellCssStyle = ""; $selection_grade_point->grade_point->CellCssClass = "";
		$selection_grade_point->grade_point->CellAttrs = array(); $selection_grade_point->grade_point->ViewAttrs = array(); $selection_grade_point->grade_point->EditAttrs = array();

		// min_grade
		$selection_grade_point->min_grade->CellCssStyle = ""; $selection_grade_point->min_grade->CellCssClass = "";
		$selection_grade_point->min_grade->CellAttrs = array(); $selection_grade_point->min_grade->ViewAttrs = array(); $selection_grade_point->min_grade->EditAttrs = array();

		// max_grade
		$selection_grade_point->max_grade->CellCssStyle = ""; $selection_grade_point->max_grade->CellCssClass = "";
		$selection_grade_point->max_grade->CellAttrs = array(); $selection_grade_point->max_grade->ViewAttrs = array(); $selection_grade_point->max_grade->EditAttrs = array();
		if ($selection_grade_point->RowType == EW_ROWTYPE_VIEW) { // View row

			// selection_grade_points_id
			$selection_grade_point->selection_grade_points_id->ViewValue = $selection_grade_point->selection_grade_points_id->CurrentValue;
			$selection_grade_point->selection_grade_points_id->CssStyle = "";
			$selection_grade_point->selection_grade_points_id->CssClass = "";
			$selection_grade_point->selection_grade_points_id->ViewCustomAttributes = "";

			// grade_point
			$selection_grade_point->grade_point->ViewValue = $selection_grade_point->grade_point->CurrentValue;
			$selection_grade_point->grade_point->CssStyle = "";
			$selection_grade_point->grade_point->CssClass = "";
			$selection_grade_point->grade_point->ViewCustomAttributes = "";

			// min_grade
			$selection_grade_point->min_grade->ViewValue = $selection_grade_point->min_grade->CurrentValue;
			$selection_grade_point->min_grade->CssStyle = "";
			$selection_grade_point->min_grade->CssClass = "";
			$selection_grade_point->min_grade->ViewCustomAttributes = "";

			// max_grade
			$selection_grade_point->max_grade->ViewValue = $selection_grade_point->max_grade->CurrentValue;
			$selection_grade_point->max_grade->CssStyle = "";
			$selection_grade_point->max_grade->CssClass = "";
			$selection_grade_point->max_grade->ViewCustomAttributes = "";

			// selection_grade_points_id
			$selection_grade_point->selection_grade_points_id->HrefValue = "";
			$selection_grade_point->selection_grade_points_id->TooltipValue = "";

			// grade_point
			$selection_grade_point->grade_point->HrefValue = "";
			$selection_grade_point->grade_point->TooltipValue = "";

			// min_grade
			$selection_grade_point->min_grade->HrefValue = "";
			$selection_grade_point->min_grade->TooltipValue = "";

			// max_grade
			$selection_grade_point->max_grade->HrefValue = "";
			$selection_grade_point->max_grade->TooltipValue = "";
		} elseif ($selection_grade_point->RowType == EW_ROWTYPE_ADD) { // Add row

			// selection_grade_points_id
			$selection_grade_point->selection_grade_points_id->EditCustomAttributes = "";
			$selection_grade_point->selection_grade_points_id->EditValue = ew_HtmlEncode($selection_grade_point->selection_grade_points_id->CurrentValue);

			// grade_point
			$selection_grade_point->grade_point->EditCustomAttributes = "";
			$selection_grade_point->grade_point->EditValue = ew_HtmlEncode($selection_grade_point->grade_point->CurrentValue);

			// min_grade
			$selection_grade_point->min_grade->EditCustomAttributes = "";
			$selection_grade_point->min_grade->EditValue = ew_HtmlEncode($selection_grade_point->min_grade->CurrentValue);

			// max_grade
			$selection_grade_point->max_grade->EditCustomAttributes = "";
			$selection_grade_point->max_grade->EditValue = ew_HtmlEncode($selection_grade_point->max_grade->CurrentValue);
		}

		// Call Row Rendered event
		if ($selection_grade_point->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$selection_grade_point->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $selection_grade_point;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($selection_grade_point->selection_grade_points_id->FormValue) && $selection_grade_point->selection_grade_points_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $selection_grade_point->selection_grade_points_id->FldCaption();
		}
		if (!ew_CheckInteger($selection_grade_point->selection_grade_points_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $selection_grade_point->selection_grade_points_id->FldErrMsg();
		}
		if (!ew_CheckInteger($selection_grade_point->grade_point->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $selection_grade_point->grade_point->FldErrMsg();
		}
		if (!ew_CheckInteger($selection_grade_point->min_grade->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $selection_grade_point->min_grade->FldErrMsg();
		}
		if (!ew_CheckInteger($selection_grade_point->max_grade->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $selection_grade_point->max_grade->FldErrMsg();
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
		global $conn, $Language, $Security, $selection_grade_point;

		// Check if key value entered
		if ($selection_grade_point->selection_grade_points_id->CurrentValue == "" && $selection_grade_point->selection_grade_points_id->getSessionValue() == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $selection_grade_point->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $selection_grade_point->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// selection_grade_points_id
		$selection_grade_point->selection_grade_points_id->SetDbValueDef($rsnew, $selection_grade_point->selection_grade_points_id->CurrentValue, 0, FALSE);

		// grade_point
		$selection_grade_point->grade_point->SetDbValueDef($rsnew, $selection_grade_point->grade_point->CurrentValue, NULL, FALSE);

		// min_grade
		$selection_grade_point->min_grade->SetDbValueDef($rsnew, $selection_grade_point->min_grade->CurrentValue, NULL, FALSE);

		// max_grade
		$selection_grade_point->max_grade->SetDbValueDef($rsnew, $selection_grade_point->max_grade->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $selection_grade_point->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($selection_grade_point->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($selection_grade_point->CancelMessage <> "") {
				$this->setMessage($selection_grade_point->CancelMessage);
				$selection_grade_point->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$selection_grade_point->Row_Inserted($rsnew);
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
