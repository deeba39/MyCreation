<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "communityinfo.php" ?>
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
$community_edit = new ccommunity_edit();
$Page =& $community_edit;

// Page init
$community_edit->Page_Init();

// Page main
$community_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var community_edit = new ew_Page("community_edit");

// page properties
community_edit.PageID = "edit"; // page ID
community_edit.FormID = "fcommunityedit"; // form ID
var EW_PAGE_ID = community_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
community_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_community_1"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($community->community_1->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_programarea_programarea_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($community->programarea_programarea_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_community_category_community_category_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($community->community_category_community_category_id->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
community_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
community_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
community_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $community->TableCaption() ?><br><br>
<a href="<?php echo $community->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$community_edit->ShowMessage();
?>
<form name="fcommunityedit" id="fcommunityedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return community_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="community">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($community->community_id->Visible) { // community_id ?>
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->community_id->FldCaption() ?></td>
		<td<?php echo $community->community_id->CellAttributes() ?>><span id="el_community_id">
<div<?php echo $community->community_id->ViewAttributes() ?>><?php echo $community->community_id->EditValue ?></div><input type="hidden" name="x_community_id" id="x_community_id" value="<?php echo ew_HtmlEncode($community->community_id->CurrentValue) ?>">
</span><?php echo $community->community_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($community->community_1->Visible) { // community ?>
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->community_1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $community->community_1->CellAttributes() ?>><span id="el_community_1">
<input type="text" name="x_community_1" id="x_community_1" title="<?php echo $community->community_1->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $community->community_1->EditValue ?>"<?php echo $community->community_1->EditAttributes() ?>>
</span><?php echo $community->community_1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($community->programarea_programarea_id->Visible) { // programarea_programarea_id ?>
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->programarea_programarea_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $community->programarea_programarea_id->CellAttributes() ?>><span id="el_programarea_programarea_id">
<select id="x_programarea_programarea_id" name="x_programarea_programarea_id" title="<?php echo $community->programarea_programarea_id->FldTitle() ?>"<?php echo $community->programarea_programarea_id->EditAttributes() ?>>
<?php
if (is_array($community->programarea_programarea_id->EditValue)) {
	$arwrk = $community->programarea_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($community->programarea_programarea_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $community->programarea_programarea_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($community->community_category_community_category_id->Visible) { // community_category_community_category_id ?>
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->community_category_community_category_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $community->community_category_community_category_id->CellAttributes() ?>><span id="el_community_category_community_category_id">
<select id="x_community_category_community_category_id" name="x_community_category_community_category_id" title="<?php echo $community->community_category_community_category_id->FldTitle() ?>"<?php echo $community->community_category_community_category_id->EditAttributes() ?>>
<?php
if (is_array($community->community_category_community_category_id->EditValue)) {
	$arwrk = $community->community_category_community_category_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($community->community_category_community_category_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $community->community_category_community_category_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($community->community_districts_DistrictID->Visible) { // community_districts_DistrictID ?>
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->community_districts_DistrictID->FldCaption() ?></td>
		<td<?php echo $community->community_districts_DistrictID->CellAttributes() ?>><span id="el_community_districts_DistrictID">
<?php if ($community->community_districts_DistrictID->getSessionValue() <> "") { ?>
<div<?php echo $community->community_districts_DistrictID->ViewAttributes() ?>><?php echo $community->community_districts_DistrictID->ViewValue ?></div>
<input type="hidden" id="x_community_districts_DistrictID" name="x_community_districts_DistrictID" value="<?php echo ew_HtmlEncode($community->community_districts_DistrictID->CurrentValue) ?>">
<?php } else { ?>
<select id="x_community_districts_DistrictID" name="x_community_districts_DistrictID" title="<?php echo $community->community_districts_DistrictID->FldTitle() ?>"<?php echo $community->community_districts_DistrictID->EditAttributes() ?>>
<?php
if (is_array($community->community_districts_DistrictID->EditValue)) {
	$arwrk = $community->community_districts_DistrictID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($community->community_districts_DistrictID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
</span><?php echo $community->community_districts_DistrictID->CustomMsg ?></td>
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
$community_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ccommunity_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'community';

	// Page object name
	var $PageObjName = 'community_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $community;
		if ($community->UseTokenInUrl) $PageUrl .= "t=" . $community->TableVar . "&"; // Add page token
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
		global $objForm, $community;
		if ($community->UseTokenInUrl) {
			if ($objForm)
				return ($community->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($community->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccommunity_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (community)
		$GLOBALS["community"] = new ccommunity();

		// Table object (districts)
		$GLOBALS['districts'] = new cdistricts();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'community', TRUE);

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
		global $community;

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
			$this->Page_Terminate("communitylist.php");
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
		global $objForm, $Language, $gsFormError, $community;

		// Load key from QueryString
		if (@$_GET["community_id"] <> "")
			$community->community_id->setQueryStringValue($_GET["community_id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$community->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$community->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$community->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$community->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($community->community_id->CurrentValue == "")
			$this->Page_Terminate("communitylist.php"); // Invalid key, return to list
		switch ($community->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("communitylist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$community->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $community->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$community->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$community->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $community;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $community;
		$community->community_id->setFormValue($objForm->GetValue("x_community_id"));
		$community->community_1->setFormValue($objForm->GetValue("x_community_1"));
		$community->programarea_programarea_id->setFormValue($objForm->GetValue("x_programarea_programarea_id"));
		$community->community_category_community_category_id->setFormValue($objForm->GetValue("x_community_category_community_category_id"));
		$community->community_districts_DistrictID->setFormValue($objForm->GetValue("x_community_districts_DistrictID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $community;
		$this->LoadRow();
		$community->community_id->CurrentValue = $community->community_id->FormValue;
		$community->community_1->CurrentValue = $community->community_1->FormValue;
		$community->programarea_programarea_id->CurrentValue = $community->programarea_programarea_id->FormValue;
		$community->community_category_community_category_id->CurrentValue = $community->community_category_community_category_id->FormValue;
		$community->community_districts_DistrictID->CurrentValue = $community->community_districts_DistrictID->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $community;
		$sFilter = $community->KeyFilter();

		// Call Row Selecting event
		$community->Row_Selecting($sFilter);

		// Load SQL based on filter
		$community->CurrentFilter = $sFilter;
		$sSql = $community->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$community->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $community;
		$community->community_id->setDbValue($rs->fields('community_id'));
		$community->community_1->setDbValue($rs->fields('community'));
		$community->programarea_programarea_id->setDbValue($rs->fields('programarea_programarea_id'));
		$community->community_category_community_category_id->setDbValue($rs->fields('community_category_community_category_id'));
		$community->community_districts_DistrictID->setDbValue($rs->fields('community_districts_DistrictID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $community;

		// Initialize URLs
		// Call Row_Rendering event

		$community->Row_Rendering();

		// Common render codes for all row types
		// community_id

		$community->community_id->CellCssStyle = ""; $community->community_id->CellCssClass = "";
		$community->community_id->CellAttrs = array(); $community->community_id->ViewAttrs = array(); $community->community_id->EditAttrs = array();

		// community
		$community->community_1->CellCssStyle = ""; $community->community_1->CellCssClass = "";
		$community->community_1->CellAttrs = array(); $community->community_1->ViewAttrs = array(); $community->community_1->EditAttrs = array();

		// programarea_programarea_id
		$community->programarea_programarea_id->CellCssStyle = ""; $community->programarea_programarea_id->CellCssClass = "";
		$community->programarea_programarea_id->CellAttrs = array(); $community->programarea_programarea_id->ViewAttrs = array(); $community->programarea_programarea_id->EditAttrs = array();

		// community_category_community_category_id
		$community->community_category_community_category_id->CellCssStyle = ""; $community->community_category_community_category_id->CellCssClass = "";
		$community->community_category_community_category_id->CellAttrs = array(); $community->community_category_community_category_id->ViewAttrs = array(); $community->community_category_community_category_id->EditAttrs = array();

		// community_districts_DistrictID
		$community->community_districts_DistrictID->CellCssStyle = ""; $community->community_districts_DistrictID->CellCssClass = "";
		$community->community_districts_DistrictID->CellAttrs = array(); $community->community_districts_DistrictID->ViewAttrs = array(); $community->community_districts_DistrictID->EditAttrs = array();
		if ($community->RowType == EW_ROWTYPE_VIEW) { // View row

			// community_id
			$community->community_id->ViewValue = $community->community_id->CurrentValue;
			$community->community_id->CssStyle = "";
			$community->community_id->CssClass = "";
			$community->community_id->ViewCustomAttributes = "";

			// community
			$community->community_1->ViewValue = $community->community_1->CurrentValue;
			$community->community_1->CssStyle = "";
			$community->community_1->CssClass = "";
			$community->community_1->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($community->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($community->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$community->programarea_programarea_id->ViewValue = $community->programarea_programarea_id->CurrentValue;
				}
			} else {
				$community->programarea_programarea_id->ViewValue = NULL;
			}
			$community->programarea_programarea_id->CssStyle = "";
			$community->programarea_programarea_id->CssClass = "";
			$community->programarea_programarea_id->ViewCustomAttributes = "";

			// community_category_community_category_id
			if (strval($community->community_category_community_category_id->CurrentValue) <> "") {
				$sFilterWrk = "`community_category_id` = " . ew_AdjustSql($community->community_category_community_category_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `community_category_name` FROM `community_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->community_category_community_category_id->ViewValue = $rswrk->fields('community_category_name');
					$rswrk->Close();
				} else {
					$community->community_category_community_category_id->ViewValue = $community->community_category_community_category_id->CurrentValue;
				}
			} else {
				$community->community_category_community_category_id->ViewValue = NULL;
			}
			$community->community_category_community_category_id->CssStyle = "";
			$community->community_category_community_category_id->CssClass = "";
			$community->community_category_community_category_id->ViewCustomAttributes = "";

			// community_districts_DistrictID
			if (strval($community->community_districts_DistrictID->CurrentValue) <> "") {
				$sFilterWrk = "`DistrictID` = " . ew_AdjustSql($community->community_districts_DistrictID->CurrentValue) . "";
			$sSqlWrk = "SELECT `District` FROM `districts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->community_districts_DistrictID->ViewValue = $rswrk->fields('District');
					$rswrk->Close();
				} else {
					$community->community_districts_DistrictID->ViewValue = $community->community_districts_DistrictID->CurrentValue;
				}
			} else {
				$community->community_districts_DistrictID->ViewValue = NULL;
			}
			$community->community_districts_DistrictID->CssStyle = "";
			$community->community_districts_DistrictID->CssClass = "";
			$community->community_districts_DistrictID->ViewCustomAttributes = "";

			// community_id
			$community->community_id->HrefValue = "";
			$community->community_id->TooltipValue = "";

			// community
			$community->community_1->HrefValue = "";
			$community->community_1->TooltipValue = "";

			// programarea_programarea_id
			$community->programarea_programarea_id->HrefValue = "";
			$community->programarea_programarea_id->TooltipValue = "";

			// community_category_community_category_id
			$community->community_category_community_category_id->HrefValue = "";
			$community->community_category_community_category_id->TooltipValue = "";

			// community_districts_DistrictID
			$community->community_districts_DistrictID->HrefValue = "";
			$community->community_districts_DistrictID->TooltipValue = "";
		} elseif ($community->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// community_id
			$community->community_id->EditCustomAttributes = "";
			$community->community_id->EditValue = $community->community_id->CurrentValue;
			$community->community_id->CssStyle = "";
			$community->community_id->CssClass = "";
			$community->community_id->ViewCustomAttributes = "";

			// community
			$community->community_1->EditCustomAttributes = "";
			$community->community_1->EditValue = ew_HtmlEncode($community->community_1->CurrentValue);

			// programarea_programarea_id
			$community->programarea_programarea_id->EditCustomAttributes = "";
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
			$community->programarea_programarea_id->EditValue = $arwrk;

			// community_category_community_category_id
			$community->community_category_community_category_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `community_category_id`, `community_category_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `community_category`";
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
			$community->community_category_community_category_id->EditValue = $arwrk;

			// community_districts_DistrictID
			$community->community_districts_DistrictID->EditCustomAttributes = "";
			if ($community->community_districts_DistrictID->getSessionValue() <> "") {
				$community->community_districts_DistrictID->CurrentValue = $community->community_districts_DistrictID->getSessionValue();
			if (strval($community->community_districts_DistrictID->CurrentValue) <> "") {
				$sFilterWrk = "`DistrictID` = " . ew_AdjustSql($community->community_districts_DistrictID->CurrentValue) . "";
			$sSqlWrk = "SELECT `District` FROM `districts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->community_districts_DistrictID->ViewValue = $rswrk->fields('District');
					$rswrk->Close();
				} else {
					$community->community_districts_DistrictID->ViewValue = $community->community_districts_DistrictID->CurrentValue;
				}
			} else {
				$community->community_districts_DistrictID->ViewValue = NULL;
			}
			$community->community_districts_DistrictID->CssStyle = "";
			$community->community_districts_DistrictID->CssClass = "";
			$community->community_districts_DistrictID->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `DistrictID`, `District`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `districts`";
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
			$community->community_districts_DistrictID->EditValue = $arwrk;
			}

			// Edit refer script
			// community_id

			$community->community_id->HrefValue = "";

			// community
			$community->community_1->HrefValue = "";

			// programarea_programarea_id
			$community->programarea_programarea_id->HrefValue = "";

			// community_category_community_category_id
			$community->community_category_community_category_id->HrefValue = "";

			// community_districts_DistrictID
			$community->community_districts_DistrictID->HrefValue = "";
		}

		// Call Row Rendered event
		if ($community->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$community->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $community;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($community->community_1->FormValue) && $community->community_1->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $community->community_1->FldCaption();
		}
		if (!is_null($community->programarea_programarea_id->FormValue) && $community->programarea_programarea_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $community->programarea_programarea_id->FldCaption();
		}
		if (!is_null($community->community_category_community_category_id->FormValue) && $community->community_category_community_category_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $community->community_category_community_category_id->FldCaption();
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
		global $conn, $Security, $Language, $community;
		$sFilter = $community->KeyFilter();
		$community->CurrentFilter = $sFilter;
		$sSql = $community->SQL();
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

			// community
			$community->community_1->SetDbValueDef($rsnew, $community->community_1->CurrentValue, NULL, FALSE);

			// programarea_programarea_id
			$community->programarea_programarea_id->SetDbValueDef($rsnew, $community->programarea_programarea_id->CurrentValue, NULL, FALSE);

			// community_category_community_category_id
			$community->community_category_community_category_id->SetDbValueDef($rsnew, $community->community_category_community_category_id->CurrentValue, NULL, FALSE);

			// community_districts_DistrictID
			$community->community_districts_DistrictID->SetDbValueDef($rsnew, $community->community_districts_DistrictID->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $community->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($community->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($community->CancelMessage <> "") {
					$this->setMessage($community->CancelMessage);
					$community->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$community->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $community;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "districts") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $community->SqlMasterFilter_districts();
				$this->sDbDetailFilter = $community->SqlDetailFilter_districts();
				if (@$_GET["DistrictID"] <> "") {
					$GLOBALS["districts"]->DistrictID->setQueryStringValue($_GET["DistrictID"]);
					$community->community_districts_DistrictID->setQueryStringValue($GLOBALS["districts"]->DistrictID->QueryStringValue);
					$community->community_districts_DistrictID->setSessionValue($community->community_districts_DistrictID->QueryStringValue);
					if (!is_numeric($GLOBALS["districts"]->DistrictID->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@DistrictID@", ew_AdjustSql($GLOBALS["districts"]->DistrictID->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@community_districts_DistrictID@", ew_AdjustSql($GLOBALS["districts"]->DistrictID->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$community->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$community->setStartRecordNumber($this->lStartRec);
			$community->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$community->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "districts") {
				if ($community->community_districts_DistrictID->QueryStringValue == "") $community->community_districts_DistrictID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $community->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $community->getDetailFilter(); // Restore detail filter
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
