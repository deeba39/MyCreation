<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "programareainfo.php" ?>
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
$programarea_add = new cprogramarea_add();
$Page =& $programarea_add;

// Page init
$programarea_add->Page_Init();

// Page main
$programarea_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var programarea_add = new ew_Page("programarea_add");

// page properties
programarea_add.PageID = "add"; // page ID
programarea_add.FormID = "fprogramareaadd"; // form ID
var EW_PAGE_ID = programarea_add.PageID; // for backward compatibility

// extend page with ValidateForm function
programarea_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_programarea_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($programarea->programarea_name->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
programarea_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
programarea_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
programarea_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $programarea->TableCaption() ?><br><br>
<a href="<?php echo $programarea->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$programarea_add->ShowMessage();
?>
<form name="fprogramareaadd" id="fprogramareaadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return programarea_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="programarea">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($programarea->address->Visible) { // address ?>
	<tr<?php echo $programarea->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $programarea->address->FldCaption() ?></td>
		<td<?php echo $programarea->address->CellAttributes() ?>><span id="el_address">
<input type="text" name="x_address" id="x_address" title="<?php echo $programarea->address->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $programarea->address->EditValue ?>"<?php echo $programarea->address->EditAttributes() ?>>
</span><?php echo $programarea->address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($programarea->programarea_name->Visible) { // programarea_name ?>
	<tr<?php echo $programarea->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $programarea->programarea_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $programarea->programarea_name->CellAttributes() ?>><span id="el_programarea_name">
<input type="text" name="x_programarea_name" id="x_programarea_name" title="<?php echo $programarea->programarea_name->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $programarea->programarea_name->EditValue ?>"<?php echo $programarea->programarea_name->EditAttributes() ?>>
</span><?php echo $programarea->programarea_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($programarea->regionID->Visible) { // regionID ?>
	<tr<?php echo $programarea->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $programarea->regionID->FldCaption() ?></td>
		<td<?php echo $programarea->regionID->CellAttributes() ?>><span id="el_regionID">
<select id="x_regionID" name="x_regionID" title="<?php echo $programarea->regionID->FldTitle() ?>"<?php echo $programarea->regionID->EditAttributes() ?>>
<?php
if (is_array($programarea->regionID->EditValue)) {
	$arwrk = $programarea->regionID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($programarea->regionID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $programarea->regionID->CustomMsg ?></td>
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
$programarea_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cprogramarea_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'programarea';

	// Page object name
	var $PageObjName = 'programarea_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $programarea;
		if ($programarea->UseTokenInUrl) $PageUrl .= "t=" . $programarea->TableVar . "&"; // Add page token
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
		global $objForm, $programarea;
		if ($programarea->UseTokenInUrl) {
			if ($objForm)
				return ($programarea->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($programarea->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cprogramarea_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (programarea)
		$GLOBALS["programarea"] = new cprogramarea();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'programarea', TRUE);

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
		global $programarea;

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
			$this->Page_Terminate("programarealist.php");
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
		global $objForm, $Language, $gsFormError, $programarea;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["programarea_id"] != "") {
		  $programarea->programarea_id->setQueryStringValue($_GET["programarea_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $programarea->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$programarea->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $programarea->CurrentAction = "C"; // Copy record
		  } else {
		    $programarea->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($programarea->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("programarealist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$programarea->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $programarea->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$programarea->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $programarea;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $programarea;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $programarea;
		$programarea->address->setFormValue($objForm->GetValue("x_address"));
		$programarea->programarea_name->setFormValue($objForm->GetValue("x_programarea_name"));
		$programarea->regionID->setFormValue($objForm->GetValue("x_regionID"));
		$programarea->programarea_id->setFormValue($objForm->GetValue("x_programarea_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $programarea;
		$programarea->programarea_id->CurrentValue = $programarea->programarea_id->FormValue;
		$programarea->address->CurrentValue = $programarea->address->FormValue;
		$programarea->programarea_name->CurrentValue = $programarea->programarea_name->FormValue;
		$programarea->regionID->CurrentValue = $programarea->regionID->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $programarea;
		$sFilter = $programarea->KeyFilter();

		// Call Row Selecting event
		$programarea->Row_Selecting($sFilter);

		// Load SQL based on filter
		$programarea->CurrentFilter = $sFilter;
		$sSql = $programarea->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$programarea->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $programarea;
		$programarea->programarea_id->setDbValue($rs->fields('programarea_id'));
		$programarea->address->setDbValue($rs->fields('address'));
		$programarea->programarea_name->setDbValue($rs->fields('programarea_name'));
		$programarea->regionID->setDbValue($rs->fields('regionID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $programarea;

		// Initialize URLs
		// Call Row_Rendering event

		$programarea->Row_Rendering();

		// Common render codes for all row types
		// address

		$programarea->address->CellCssStyle = ""; $programarea->address->CellCssClass = "";
		$programarea->address->CellAttrs = array(); $programarea->address->ViewAttrs = array(); $programarea->address->EditAttrs = array();

		// programarea_name
		$programarea->programarea_name->CellCssStyle = ""; $programarea->programarea_name->CellCssClass = "";
		$programarea->programarea_name->CellAttrs = array(); $programarea->programarea_name->ViewAttrs = array(); $programarea->programarea_name->EditAttrs = array();

		// regionID
		$programarea->regionID->CellCssStyle = ""; $programarea->regionID->CellCssClass = "";
		$programarea->regionID->CellAttrs = array(); $programarea->regionID->ViewAttrs = array(); $programarea->regionID->EditAttrs = array();
		if ($programarea->RowType == EW_ROWTYPE_VIEW) { // View row

			// programarea_id
			$programarea->programarea_id->ViewValue = $programarea->programarea_id->CurrentValue;
			$programarea->programarea_id->CssStyle = "";
			$programarea->programarea_id->CssClass = "";
			$programarea->programarea_id->ViewCustomAttributes = "";

			// address
			$programarea->address->ViewValue = $programarea->address->CurrentValue;
			$programarea->address->CssStyle = "";
			$programarea->address->CssClass = "";
			$programarea->address->ViewCustomAttributes = "";

			// programarea_name
			$programarea->programarea_name->ViewValue = $programarea->programarea_name->CurrentValue;
			$programarea->programarea_name->CssStyle = "";
			$programarea->programarea_name->CssClass = "";
			$programarea->programarea_name->ViewCustomAttributes = "";

			// regionID
			if (strval($programarea->regionID->CurrentValue) <> "") {
				$sFilterWrk = "`RegionID` = " . ew_AdjustSql($programarea->regionID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Region` FROM `regions`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$programarea->regionID->ViewValue = $rswrk->fields('Region');
					$rswrk->Close();
				} else {
					$programarea->regionID->ViewValue = $programarea->regionID->CurrentValue;
				}
			} else {
				$programarea->regionID->ViewValue = NULL;
			}
			$programarea->regionID->CssStyle = "";
			$programarea->regionID->CssClass = "";
			$programarea->regionID->ViewCustomAttributes = "";

			// address
			$programarea->address->HrefValue = "";
			$programarea->address->TooltipValue = "";

			// programarea_name
			$programarea->programarea_name->HrefValue = "";
			$programarea->programarea_name->TooltipValue = "";

			// regionID
			$programarea->regionID->HrefValue = "";
			$programarea->regionID->TooltipValue = "";
		} elseif ($programarea->RowType == EW_ROWTYPE_ADD) { // Add row

			// address
			$programarea->address->EditCustomAttributes = "";
			$programarea->address->EditValue = ew_HtmlEncode($programarea->address->CurrentValue);

			// programarea_name
			$programarea->programarea_name->EditCustomAttributes = "";
			$programarea->programarea_name->EditValue = ew_HtmlEncode($programarea->programarea_name->CurrentValue);

			// regionID
			$programarea->regionID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `RegionID`, `Region`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `regions`";
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
			$programarea->regionID->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($programarea->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$programarea->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $programarea;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($programarea->programarea_name->FormValue) && $programarea->programarea_name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $programarea->programarea_name->FldCaption();
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
		global $conn, $Language, $Security, $programarea;
		$rsnew = array();

		// address
		$programarea->address->SetDbValueDef($rsnew, $programarea->address->CurrentValue, NULL, FALSE);

		// programarea_name
		$programarea->programarea_name->SetDbValueDef($rsnew, $programarea->programarea_name->CurrentValue, NULL, FALSE);

		// regionID
		$programarea->regionID->SetDbValueDef($rsnew, $programarea->regionID->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $programarea->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($programarea->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($programarea->CancelMessage <> "") {
				$this->setMessage($programarea->CancelMessage);
				$programarea->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$programarea->programarea_id->setDbValue($conn->Insert_ID());
			$rsnew['programarea_id'] = $programarea->programarea_id->DbValue;

			// Call Row Inserted event
			$programarea->Row_Inserted($rsnew);
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
