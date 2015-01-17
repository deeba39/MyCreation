<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "districtsinfo.php" ?>
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
$districts_edit = new cdistricts_edit();
$Page =& $districts_edit;

// Page init
$districts_edit->Page_Init();

// Page main
$districts_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var districts_edit = new ew_Page("districts_edit");

// page properties
districts_edit.PageID = "edit"; // page ID
districts_edit.FormID = "fdistrictsedit"; // form ID
var EW_PAGE_ID = districts_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
districts_edit.ValidateForm = function(fobj) {
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
districts_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
districts_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
districts_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $districts->TableCaption() ?><br><br>
<a href="<?php echo $districts->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$districts_edit->ShowMessage();
?>
<form name="fdistrictsedit" id="fdistrictsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return districts_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="districts">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($districts->DistrictID->Visible) { // DistrictID ?>
	<tr<?php echo $districts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $districts->DistrictID->FldCaption() ?></td>
		<td<?php echo $districts->DistrictID->CellAttributes() ?>><span id="el_DistrictID">
<div<?php echo $districts->DistrictID->ViewAttributes() ?>><?php echo $districts->DistrictID->EditValue ?></div><input type="hidden" name="x_DistrictID" id="x_DistrictID" value="<?php echo ew_HtmlEncode($districts->DistrictID->CurrentValue) ?>">
</span><?php echo $districts->DistrictID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($districts->District->Visible) { // District ?>
	<tr<?php echo $districts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $districts->District->FldCaption() ?></td>
		<td<?php echo $districts->District->CellAttributes() ?>><span id="el_District">
<input type="text" name="x_District" id="x_District" title="<?php echo $districts->District->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $districts->District->EditValue ?>"<?php echo $districts->District->EditAttributes() ?>>
</span><?php echo $districts->District->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($districts->RegionID->Visible) { // RegionID ?>
	<tr<?php echo $districts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $districts->RegionID->FldCaption() ?></td>
		<td<?php echo $districts->RegionID->CellAttributes() ?>><span id="el_RegionID">
<select id="x_RegionID" name="x_RegionID" title="<?php echo $districts->RegionID->FldTitle() ?>"<?php echo $districts->RegionID->EditAttributes() ?>>
<?php
if (is_array($districts->RegionID->EditValue)) {
	$arwrk = $districts->RegionID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($districts->RegionID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $districts->RegionID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($districts->programarea_programarea_id->Visible) { // programarea_programarea_id ?>
	<tr<?php echo $districts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $districts->programarea_programarea_id->FldCaption() ?></td>
		<td<?php echo $districts->programarea_programarea_id->CellAttributes() ?>><span id="el_programarea_programarea_id">
<select id="x_programarea_programarea_id" name="x_programarea_programarea_id" title="<?php echo $districts->programarea_programarea_id->FldTitle() ?>"<?php echo $districts->programarea_programarea_id->EditAttributes() ?>>
<?php
if (is_array($districts->programarea_programarea_id->EditValue)) {
	$arwrk = $districts->programarea_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($districts->programarea_programarea_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $districts->programarea_programarea_id->CustomMsg ?></td>
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
$districts_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cdistricts_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'districts';

	// Page object name
	var $PageObjName = 'districts_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $districts;
		if ($districts->UseTokenInUrl) $PageUrl .= "t=" . $districts->TableVar . "&"; // Add page token
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
		global $objForm, $districts;
		if ($districts->UseTokenInUrl) {
			if ($objForm)
				return ($districts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($districts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdistricts_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (districts)
		$GLOBALS["districts"] = new cdistricts();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'districts', TRUE);

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
		global $districts;

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
			$this->Page_Terminate("districtslist.php");
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
		global $objForm, $Language, $gsFormError, $districts;

		// Load key from QueryString
		if (@$_GET["DistrictID"] <> "")
			$districts->DistrictID->setQueryStringValue($_GET["DistrictID"]);
		if (@$_POST["a_edit"] <> "") {
			$districts->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$districts->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$districts->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$districts->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($districts->DistrictID->CurrentValue == "")
			$this->Page_Terminate("districtslist.php"); // Invalid key, return to list
		switch ($districts->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("districtslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$districts->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $districts->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$districts->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$districts->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $districts;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $districts;
		$districts->DistrictID->setFormValue($objForm->GetValue("x_DistrictID"));
		$districts->District->setFormValue($objForm->GetValue("x_District"));
		$districts->RegionID->setFormValue($objForm->GetValue("x_RegionID"));
		$districts->programarea_programarea_id->setFormValue($objForm->GetValue("x_programarea_programarea_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $districts;
		$this->LoadRow();
		$districts->DistrictID->CurrentValue = $districts->DistrictID->FormValue;
		$districts->District->CurrentValue = $districts->District->FormValue;
		$districts->RegionID->CurrentValue = $districts->RegionID->FormValue;
		$districts->programarea_programarea_id->CurrentValue = $districts->programarea_programarea_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $districts;
		$sFilter = $districts->KeyFilter();

		// Call Row Selecting event
		$districts->Row_Selecting($sFilter);

		// Load SQL based on filter
		$districts->CurrentFilter = $sFilter;
		$sSql = $districts->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$districts->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $districts;
		$districts->DistrictID->setDbValue($rs->fields('DistrictID'));
		$districts->District->setDbValue($rs->fields('District'));
		$districts->RegionID->setDbValue($rs->fields('RegionID'));
		$districts->programarea_programarea_id->setDbValue($rs->fields('programarea_programarea_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $districts;

		// Initialize URLs
		// Call Row_Rendering event

		$districts->Row_Rendering();

		// Common render codes for all row types
		// DistrictID

		$districts->DistrictID->CellCssStyle = ""; $districts->DistrictID->CellCssClass = "";
		$districts->DistrictID->CellAttrs = array(); $districts->DistrictID->ViewAttrs = array(); $districts->DistrictID->EditAttrs = array();

		// District
		$districts->District->CellCssStyle = ""; $districts->District->CellCssClass = "";
		$districts->District->CellAttrs = array(); $districts->District->ViewAttrs = array(); $districts->District->EditAttrs = array();

		// RegionID
		$districts->RegionID->CellCssStyle = ""; $districts->RegionID->CellCssClass = "";
		$districts->RegionID->CellAttrs = array(); $districts->RegionID->ViewAttrs = array(); $districts->RegionID->EditAttrs = array();

		// programarea_programarea_id
		$districts->programarea_programarea_id->CellCssStyle = ""; $districts->programarea_programarea_id->CellCssClass = "";
		$districts->programarea_programarea_id->CellAttrs = array(); $districts->programarea_programarea_id->ViewAttrs = array(); $districts->programarea_programarea_id->EditAttrs = array();
		if ($districts->RowType == EW_ROWTYPE_VIEW) { // View row

			// DistrictID
			$districts->DistrictID->ViewValue = $districts->DistrictID->CurrentValue;
			$districts->DistrictID->CssStyle = "";
			$districts->DistrictID->CssClass = "";
			$districts->DistrictID->ViewCustomAttributes = "";

			// District
			$districts->District->ViewValue = $districts->District->CurrentValue;
			$districts->District->CssStyle = "";
			$districts->District->CssClass = "";
			$districts->District->ViewCustomAttributes = "";

			// RegionID
			if (strval($districts->RegionID->CurrentValue) <> "") {
				$sFilterWrk = "`RegionID` = " . ew_AdjustSql($districts->RegionID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Region` FROM `regions`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$districts->RegionID->ViewValue = $rswrk->fields('Region');
					$rswrk->Close();
				} else {
					$districts->RegionID->ViewValue = $districts->RegionID->CurrentValue;
				}
			} else {
				$districts->RegionID->ViewValue = NULL;
			}
			$districts->RegionID->CssStyle = "";
			$districts->RegionID->CssClass = "";
			$districts->RegionID->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($districts->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($districts->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$districts->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$districts->programarea_programarea_id->ViewValue = $districts->programarea_programarea_id->CurrentValue;
				}
			} else {
				$districts->programarea_programarea_id->ViewValue = NULL;
			}
			$districts->programarea_programarea_id->CssStyle = "";
			$districts->programarea_programarea_id->CssClass = "";
			$districts->programarea_programarea_id->ViewCustomAttributes = "";

			// DistrictID
			$districts->DistrictID->HrefValue = "";
			$districts->DistrictID->TooltipValue = "";

			// District
			$districts->District->HrefValue = "";
			$districts->District->TooltipValue = "";

			// RegionID
			$districts->RegionID->HrefValue = "";
			$districts->RegionID->TooltipValue = "";

			// programarea_programarea_id
			$districts->programarea_programarea_id->HrefValue = "";
			$districts->programarea_programarea_id->TooltipValue = "";
		} elseif ($districts->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// DistrictID
			$districts->DistrictID->EditCustomAttributes = "";
			$districts->DistrictID->EditValue = $districts->DistrictID->CurrentValue;
			$districts->DistrictID->CssStyle = "";
			$districts->DistrictID->CssClass = "";
			$districts->DistrictID->ViewCustomAttributes = "";

			// District
			$districts->District->EditCustomAttributes = "";
			$districts->District->EditValue = ew_HtmlEncode($districts->District->CurrentValue);

			// RegionID
			$districts->RegionID->EditCustomAttributes = "";
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
			$districts->RegionID->EditValue = $arwrk;

			// programarea_programarea_id
			$districts->programarea_programarea_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `programarea_id`, `programarea_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `programarea`";
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
			$districts->programarea_programarea_id->EditValue = $arwrk;

			// Edit refer script
			// DistrictID

			$districts->DistrictID->HrefValue = "";

			// District
			$districts->District->HrefValue = "";

			// RegionID
			$districts->RegionID->HrefValue = "";

			// programarea_programarea_id
			$districts->programarea_programarea_id->HrefValue = "";
		}

		// Call Row Rendered event
		if ($districts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$districts->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $districts;

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
		global $conn, $Security, $Language, $districts;
		$sFilter = $districts->KeyFilter();
		$districts->CurrentFilter = $sFilter;
		$sSql = $districts->SQL();
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

			// District
			$districts->District->SetDbValueDef($rsnew, $districts->District->CurrentValue, NULL, FALSE);

			// RegionID
			$districts->RegionID->SetDbValueDef($rsnew, $districts->RegionID->CurrentValue, NULL, FALSE);

			// programarea_programarea_id
			$districts->programarea_programarea_id->SetDbValueDef($rsnew, $districts->programarea_programarea_id->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $districts->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($districts->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($districts->CancelMessage <> "") {
					$this->setMessage($districts->CancelMessage);
					$districts->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$districts->Row_Updated($rsold, $rsnew);
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
