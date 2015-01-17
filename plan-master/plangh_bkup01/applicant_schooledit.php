<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "applicant_schoolinfo.php" ?>
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
$applicant_school_edit = new capplicant_school_edit();
$Page =& $applicant_school_edit;

// Page init
$applicant_school_edit->Page_Init();

// Page main
$applicant_school_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var applicant_school_edit = new ew_Page("applicant_school_edit");

// page properties
applicant_school_edit.PageID = "edit"; // page ID
applicant_school_edit.FormID = "fapplicant_schooledit"; // form ID
var EW_PAGE_ID = applicant_school_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
applicant_school_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_applicant_school_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($applicant_school->applicant_school_name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_applicant_school_category_applicant_school_category_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($applicant_school->applicant_school_category_applicant_school_category_id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
applicant_school_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
applicant_school_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
applicant_school_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $applicant_school->TableCaption() ?><br><br>
<a href="<?php echo $applicant_school->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$applicant_school_edit->ShowMessage();
?>
<form name="fapplicant_schooledit" id="fapplicant_schooledit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return applicant_school_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="applicant_school">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($applicant_school->applicant_school_name->Visible) { // applicant_school_name ?>
	<tr<?php echo $applicant_school->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $applicant_school->applicant_school_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $applicant_school->applicant_school_name->CellAttributes() ?>><span id="el_applicant_school_name">
<input type="text" name="x_applicant_school_name" id="x_applicant_school_name" title="<?php echo $applicant_school->applicant_school_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $applicant_school->applicant_school_name->EditValue ?>"<?php echo $applicant_school->applicant_school_name->EditAttributes() ?>>
</span><?php echo $applicant_school->applicant_school_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($applicant_school->applicant_school_type->Visible) { // applicant_school_type ?>
	<tr<?php echo $applicant_school->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $applicant_school->applicant_school_type->FldCaption() ?></td>
		<td<?php echo $applicant_school->applicant_school_type->CellAttributes() ?>><span id="el_applicant_school_type">
<select id="x_applicant_school_type" name="x_applicant_school_type" title="<?php echo $applicant_school->applicant_school_type->FldTitle() ?>"<?php echo $applicant_school->applicant_school_type->EditAttributes() ?>>
<?php
if (is_array($applicant_school->applicant_school_type->EditValue)) {
	$arwrk = $applicant_school->applicant_school_type->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($applicant_school->applicant_school_type->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $applicant_school->applicant_school_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($applicant_school->applicant_school_category_applicant_school_category_id->Visible) { // applicant_school_category_applicant_school_category_id ?>
	<tr<?php echo $applicant_school->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $applicant_school->applicant_school_category_applicant_school_category_id->FldCaption() ?></td>
		<td<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->CellAttributes() ?>><span id="el_applicant_school_category_applicant_school_category_id">
<div id="as_x_applicant_school_category_applicant_school_category_id" style="z-index: 8960">
	<input type="text" name="sv_x_applicant_school_category_applicant_school_category_id" id="sv_x_applicant_school_category_applicant_school_category_id" value="<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->EditValue ?>" title="<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->FldTitle() ?>" size="30"<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->EditAttributes() ?>>&nbsp;<span id="em_x_applicant_school_category_applicant_school_category_id" class="ewMessage" style="display: none"><?php echo $Language->Phrase("UnmatchedValue") ?></span>
	<div id="sc_x_applicant_school_category_applicant_school_category_id"></div>
</div>
<input type="hidden" name="x_applicant_school_category_applicant_school_category_id" id="x_applicant_school_category_applicant_school_category_id" value="<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue ?>">
<?php
$sSqlWrk = "SELECT `applicant_school_category_id`, `applicant_school_category_name` FROM `applicant_school_category`";
$sWhereWrk = "`applicant_school_category_name` LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_applicant_school_category_applicant_school_category_id" id="s_x_applicant_school_category_applicant_school_category_id" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_applicant_school_category_applicant_school_category_id = new ew_AutoSuggest("sv_x_applicant_school_category_applicant_school_category_id", "sc_x_applicant_school_category_applicant_school_category_id", "s_x_applicant_school_category_applicant_school_category_id", "em_x_applicant_school_category_applicant_school_category_id", "x_applicant_school_category_applicant_school_category_id", "", false);
oas_x_applicant_school_category_applicant_school_category_id.formatResult = function(ar) {	
	var df1 = ar[1];
	return df1;
};
oas_x_applicant_school_category_applicant_school_category_id.ac.typeAhead = false;

//-->
</script>
</span><?php echo $applicant_school->applicant_school_category_applicant_school_category_id->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_applicant_school_id" id="x_applicant_school_id" value="<?php echo ew_HtmlEncode($applicant_school->applicant_school_id->CurrentValue) ?>">
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
$applicant_school_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class capplicant_school_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'applicant_school';

	// Page object name
	var $PageObjName = 'applicant_school_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $applicant_school;
		if ($applicant_school->UseTokenInUrl) $PageUrl .= "t=" . $applicant_school->TableVar . "&"; // Add page token
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
		global $objForm, $applicant_school;
		if ($applicant_school->UseTokenInUrl) {
			if ($objForm)
				return ($applicant_school->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($applicant_school->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function capplicant_school_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (applicant_school)
		$GLOBALS["applicant_school"] = new capplicant_school();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'applicant_school', TRUE);

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
		global $applicant_school;

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
			$this->Page_Terminate("applicant_schoollist.php");
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
		global $objForm, $Language, $gsFormError, $applicant_school;

		// Load key from QueryString
		if (@$_GET["applicant_school_id"] <> "")
			$applicant_school->applicant_school_id->setQueryStringValue($_GET["applicant_school_id"]);
		if (@$_POST["a_edit"] <> "") {
			$applicant_school->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$applicant_school->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$applicant_school->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$applicant_school->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($applicant_school->applicant_school_id->CurrentValue == "")
			$this->Page_Terminate("applicant_schoollist.php"); // Invalid key, return to list
		switch ($applicant_school->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("applicant_schoollist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$applicant_school->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $applicant_school->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$applicant_school->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$applicant_school->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $applicant_school;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $applicant_school;
		$applicant_school->applicant_school_name->setFormValue($objForm->GetValue("x_applicant_school_name"));
		$applicant_school->applicant_school_type->setFormValue($objForm->GetValue("x_applicant_school_type"));
		$applicant_school->applicant_school_category_applicant_school_category_id->setFormValue($objForm->GetValue("x_applicant_school_category_applicant_school_category_id"));
		$applicant_school->applicant_school_id->setFormValue($objForm->GetValue("x_applicant_school_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $applicant_school;
		$applicant_school->applicant_school_id->CurrentValue = $applicant_school->applicant_school_id->FormValue;
		$this->LoadRow();
		$applicant_school->applicant_school_name->CurrentValue = $applicant_school->applicant_school_name->FormValue;
		$applicant_school->applicant_school_type->CurrentValue = $applicant_school->applicant_school_type->FormValue;
		$applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue = $applicant_school->applicant_school_category_applicant_school_category_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $applicant_school;
		$sFilter = $applicant_school->KeyFilter();

		// Call Row Selecting event
		$applicant_school->Row_Selecting($sFilter);

		// Load SQL based on filter
		$applicant_school->CurrentFilter = $sFilter;
		$sSql = $applicant_school->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$applicant_school->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $applicant_school;
		$applicant_school->applicant_school_id->setDbValue($rs->fields('applicant_school_id'));
		$applicant_school->applicant_school_name->setDbValue($rs->fields('applicant_school_name'));
		$applicant_school->applicant_school_type->setDbValue($rs->fields('applicant_school_type'));
		$applicant_school->applicant_school_category_applicant_school_category_id->setDbValue($rs->fields('applicant_school_category_applicant_school_category_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $applicant_school;

		// Initialize URLs
		// Call Row_Rendering event

		$applicant_school->Row_Rendering();

		// Common render codes for all row types
		// applicant_school_name

		$applicant_school->applicant_school_name->CellCssStyle = ""; $applicant_school->applicant_school_name->CellCssClass = "";
		$applicant_school->applicant_school_name->CellAttrs = array(); $applicant_school->applicant_school_name->ViewAttrs = array(); $applicant_school->applicant_school_name->EditAttrs = array();

		// applicant_school_type
		$applicant_school->applicant_school_type->CellCssStyle = ""; $applicant_school->applicant_school_type->CellCssClass = "";
		$applicant_school->applicant_school_type->CellAttrs = array(); $applicant_school->applicant_school_type->ViewAttrs = array(); $applicant_school->applicant_school_type->EditAttrs = array();

		// applicant_school_category_applicant_school_category_id
		$applicant_school->applicant_school_category_applicant_school_category_id->CellCssStyle = ""; $applicant_school->applicant_school_category_applicant_school_category_id->CellCssClass = "";
		$applicant_school->applicant_school_category_applicant_school_category_id->CellAttrs = array(); $applicant_school->applicant_school_category_applicant_school_category_id->ViewAttrs = array(); $applicant_school->applicant_school_category_applicant_school_category_id->EditAttrs = array();
		if ($applicant_school->RowType == EW_ROWTYPE_VIEW) { // View row

			// applicant_school_id
			$applicant_school->applicant_school_id->ViewValue = $applicant_school->applicant_school_id->CurrentValue;
			if (strval($applicant_school->applicant_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_category_id` = " . ew_AdjustSql($applicant_school->applicant_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_category_name` FROM `applicant_school_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_id->ViewValue = $rswrk->fields('applicant_school_category_name');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_id->ViewValue = $applicant_school->applicant_school_id->CurrentValue;
				}
			} else {
				$applicant_school->applicant_school_id->ViewValue = NULL;
			}
			$applicant_school->applicant_school_id->CssStyle = "";
			$applicant_school->applicant_school_id->CssClass = "";
			$applicant_school->applicant_school_id->ViewCustomAttributes = "";

			// applicant_school_name
			$applicant_school->applicant_school_name->ViewValue = $applicant_school->applicant_school_name->CurrentValue;
			$applicant_school->applicant_school_name->CssStyle = "";
			$applicant_school->applicant_school_name->CssClass = "";
			$applicant_school->applicant_school_name->ViewCustomAttributes = "";

			// applicant_school_type
			if (strval($applicant_school->applicant_school_type->CurrentValue) <> "") {
				$sFilterWrk = "`school_type_id` = " . ew_AdjustSql($applicant_school->applicant_school_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_type` FROM `school_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_type->ViewValue = $rswrk->fields('school_type');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_type->ViewValue = $applicant_school->applicant_school_type->CurrentValue;
				}
			} else {
				$applicant_school->applicant_school_type->ViewValue = NULL;
			}
			$applicant_school->applicant_school_type->CssStyle = "";
			$applicant_school->applicant_school_type->CssClass = "";
			$applicant_school->applicant_school_type->ViewCustomAttributes = "";

			// applicant_school_category_applicant_school_category_id
			$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = $applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue;
			if (strval($applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_category_id` = " . ew_AdjustSql($applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_category_name` FROM `applicant_school_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = $rswrk->fields('applicant_school_category_name');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = $applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue;
				}
			} else {
				$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = NULL;
			}
			$applicant_school->applicant_school_category_applicant_school_category_id->CssStyle = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->CssClass = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->ViewCustomAttributes = "";

			// applicant_school_name
			$applicant_school->applicant_school_name->HrefValue = "";
			$applicant_school->applicant_school_name->TooltipValue = "";

			// applicant_school_type
			$applicant_school->applicant_school_type->HrefValue = "";
			$applicant_school->applicant_school_type->TooltipValue = "";

			// applicant_school_category_applicant_school_category_id
			$applicant_school->applicant_school_category_applicant_school_category_id->HrefValue = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->TooltipValue = "";
		} elseif ($applicant_school->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// applicant_school_name
			$applicant_school->applicant_school_name->EditCustomAttributes = "";
			$applicant_school->applicant_school_name->EditValue = ew_HtmlEncode($applicant_school->applicant_school_name->CurrentValue);

			// applicant_school_type
			$applicant_school->applicant_school_type->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `school_type_id`, `school_type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `school_type`";
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
			$applicant_school->applicant_school_type->EditValue = $arwrk;

			// applicant_school_category_applicant_school_category_id
			$applicant_school->applicant_school_category_applicant_school_category_id->EditCustomAttributes = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->EditValue = ew_HtmlEncode($applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue);
			if (strval($applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_category_id` = " . ew_AdjustSql($applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_category_name` FROM `applicant_school_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_category_applicant_school_category_id->EditValue = $rswrk->fields('applicant_school_category_name');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_category_applicant_school_category_id->EditValue = $applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue;
				}
			} else {
				$applicant_school->applicant_school_category_applicant_school_category_id->EditValue = NULL;
			}

			// Edit refer script
			// applicant_school_name

			$applicant_school->applicant_school_name->HrefValue = "";

			// applicant_school_type
			$applicant_school->applicant_school_type->HrefValue = "";

			// applicant_school_category_applicant_school_category_id
			$applicant_school->applicant_school_category_applicant_school_category_id->HrefValue = "";
		}

		// Call Row Rendered event
		if ($applicant_school->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$applicant_school->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $applicant_school;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($applicant_school->applicant_school_name->FormValue) && $applicant_school->applicant_school_name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $applicant_school->applicant_school_name->FldCaption();
		}
		if (!ew_CheckInteger($applicant_school->applicant_school_category_applicant_school_category_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $applicant_school->applicant_school_category_applicant_school_category_id->FldErrMsg();
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
		global $conn, $Security, $Language, $applicant_school;
		$sFilter = $applicant_school->KeyFilter();
		$applicant_school->CurrentFilter = $sFilter;
		$sSql = $applicant_school->SQL();
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

			// applicant_school_name
			$applicant_school->applicant_school_name->SetDbValueDef($rsnew, $applicant_school->applicant_school_name->CurrentValue, NULL, FALSE);

			// applicant_school_type
			$applicant_school->applicant_school_type->SetDbValueDef($rsnew, $applicant_school->applicant_school_type->CurrentValue, NULL, FALSE);

			// applicant_school_category_applicant_school_category_id
			$applicant_school->applicant_school_category_applicant_school_category_id->SetDbValueDef($rsnew, $applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $applicant_school->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($applicant_school->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($applicant_school->CancelMessage <> "") {
					$this->setMessage($applicant_school->CancelMessage);
					$applicant_school->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$applicant_school->Row_Updated($rsold, $rsnew);
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
