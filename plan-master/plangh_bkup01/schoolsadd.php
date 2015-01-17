<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "schoolsinfo.php" ?>
<?php include "communityinfo.php" ?>
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
$schools_add = new cschools_add();
$Page =& $schools_add;

// Page init
$schools_add->Page_Init();

// Page main
$schools_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var schools_add = new ew_Page("schools_add");

// page properties
schools_add.PageID = "add"; // page ID
schools_add.FormID = "fschoolsadd"; // form ID
var EW_PAGE_ID = schools_add.PageID; // for backward compatibility

// extend page with ValidateForm function
schools_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_school_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($schools->school_name->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
schools_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
schools_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
schools_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $schools->TableCaption() ?><br><br>
<a href="<?php echo $schools->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$schools_add->ShowMessage();
?>
<form name="fschoolsadd" id="fschoolsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return schools_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="schools">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($schools->school_name->Visible) { // school_name ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->school_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $schools->school_name->CellAttributes() ?>><span id="el_school_name">
<input type="text" name="x_school_name" id="x_school_name" title="<?php echo $schools->school_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->school_name->EditValue ?>"<?php echo $schools->school_name->EditAttributes() ?>>
</span><?php echo $schools->school_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($schools->address->Visible) { // address ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->address->FldCaption() ?></td>
		<td<?php echo $schools->address->CellAttributes() ?>><span id="el_address">
<input type="text" name="x_address" id="x_address" title="<?php echo $schools->address->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->address->EditValue ?>"<?php echo $schools->address->EditAttributes() ?>>
</span><?php echo $schools->address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($schools->towncity->Visible) { // towncity ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->towncity->FldCaption() ?></td>
		<td<?php echo $schools->towncity->CellAttributes() ?>><span id="el_towncity">
<input type="text" name="x_towncity" id="x_towncity" title="<?php echo $schools->towncity->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->towncity->EditValue ?>"<?php echo $schools->towncity->EditAttributes() ?>>
</span><?php echo $schools->towncity->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($schools->community_community_id->Visible) { // community_community_id ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->community_community_id->FldCaption() ?></td>
		<td<?php echo $schools->community_community_id->CellAttributes() ?>><span id="el_community_community_id">
<?php if ($schools->community_community_id->getSessionValue() <> "") { ?>
<div<?php echo $schools->community_community_id->ViewAttributes() ?>><?php echo $schools->community_community_id->ViewValue ?></div>
<input type="hidden" id="x_community_community_id" name="x_community_community_id" value="<?php echo ew_HtmlEncode($schools->community_community_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x_community_community_id" name="x_community_community_id" title="<?php echo $schools->community_community_id->FldTitle() ?>"<?php echo $schools->community_community_id->EditAttributes() ?>>
<?php
if (is_array($schools->community_community_id->EditValue)) {
	$arwrk = $schools->community_community_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($schools->community_community_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $schools->community_community_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($schools->school_type->Visible) { // school_type ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->school_type->FldCaption() ?></td>
		<td<?php echo $schools->school_type->CellAttributes() ?>><span id="el_school_type">
<select id="x_school_type" name="x_school_type" title="<?php echo $schools->school_type->FldTitle() ?>"<?php echo $schools->school_type->EditAttributes() ?>>
<?php
if (is_array($schools->school_type->EditValue)) {
	$arwrk = $schools->school_type->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($schools->school_type->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $schools->school_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($schools->contact_person_name->Visible) { // contact_person_name ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->contact_person_name->FldCaption() ?></td>
		<td<?php echo $schools->contact_person_name->CellAttributes() ?>><span id="el_contact_person_name">
<input type="text" name="x_contact_person_name" id="x_contact_person_name" title="<?php echo $schools->contact_person_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->contact_person_name->EditValue ?>"<?php echo $schools->contact_person_name->EditAttributes() ?>>
</span><?php echo $schools->contact_person_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($schools->telephone->Visible) { // telephone ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->telephone->FldCaption() ?></td>
		<td<?php echo $schools->telephone->CellAttributes() ?>><span id="el_telephone">
<input type="text" name="x_telephone" id="x_telephone" title="<?php echo $schools->telephone->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->telephone->EditValue ?>"<?php echo $schools->telephone->EditAttributes() ?>>
</span><?php echo $schools->telephone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($schools->bankname->Visible) { // bankname ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->bankname->FldCaption() ?></td>
		<td<?php echo $schools->bankname->CellAttributes() ?>><span id="el_bankname">
<input type="text" name="x_bankname" id="x_bankname" title="<?php echo $schools->bankname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->bankname->EditValue ?>"<?php echo $schools->bankname->EditAttributes() ?>>
</span><?php echo $schools->bankname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($schools->account_no->Visible) { // account_no ?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $schools->account_no->FldCaption() ?></td>
		<td<?php echo $schools->account_no->CellAttributes() ?>><span id="el_account_no">
<input type="text" name="x_account_no" id="x_account_no" title="<?php echo $schools->account_no->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $schools->account_no->EditValue ?>"<?php echo $schools->account_no->EditAttributes() ?>>
</span><?php echo $schools->account_no->CustomMsg ?></td>
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
$schools_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cschools_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'schools';

	// Page object name
	var $PageObjName = 'schools_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $schools;
		if ($schools->UseTokenInUrl) $PageUrl .= "t=" . $schools->TableVar . "&"; // Add page token
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
		global $objForm, $schools;
		if ($schools->UseTokenInUrl) {
			if ($objForm)
				return ($schools->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($schools->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cschools_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (schools)
		$GLOBALS["schools"] = new cschools();

		// Table object (community)
		$GLOBALS['community'] = new ccommunity();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'schools', TRUE);

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
		global $schools;

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
			$this->Page_Terminate("schoolslist.php");
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
		global $objForm, $Language, $gsFormError, $schools;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["school_id"] != "") {
		  $schools->school_id->setQueryStringValue($_GET["school_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $schools->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$schools->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $schools->CurrentAction = "C"; // Copy record
		  } else {
		    $schools->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($schools->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("schoolslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$schools->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $schools->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$schools->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $schools;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $schools;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $schools;
		$schools->school_name->setFormValue($objForm->GetValue("x_school_name"));
		$schools->address->setFormValue($objForm->GetValue("x_address"));
		$schools->towncity->setFormValue($objForm->GetValue("x_towncity"));
		$schools->community_community_id->setFormValue($objForm->GetValue("x_community_community_id"));
		$schools->school_type->setFormValue($objForm->GetValue("x_school_type"));
		$schools->contact_person_name->setFormValue($objForm->GetValue("x_contact_person_name"));
		$schools->telephone->setFormValue($objForm->GetValue("x_telephone"));
		$schools->bankname->setFormValue($objForm->GetValue("x_bankname"));
		$schools->account_no->setFormValue($objForm->GetValue("x_account_no"));
		$schools->school_id->setFormValue($objForm->GetValue("x_school_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $schools;
		$schools->school_id->CurrentValue = $schools->school_id->FormValue;
		$schools->school_name->CurrentValue = $schools->school_name->FormValue;
		$schools->address->CurrentValue = $schools->address->FormValue;
		$schools->towncity->CurrentValue = $schools->towncity->FormValue;
		$schools->community_community_id->CurrentValue = $schools->community_community_id->FormValue;
		$schools->school_type->CurrentValue = $schools->school_type->FormValue;
		$schools->contact_person_name->CurrentValue = $schools->contact_person_name->FormValue;
		$schools->telephone->CurrentValue = $schools->telephone->FormValue;
		$schools->bankname->CurrentValue = $schools->bankname->FormValue;
		$schools->account_no->CurrentValue = $schools->account_no->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $schools;
		$sFilter = $schools->KeyFilter();

		// Call Row Selecting event
		$schools->Row_Selecting($sFilter);

		// Load SQL based on filter
		$schools->CurrentFilter = $sFilter;
		$sSql = $schools->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$schools->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $schools;
		$schools->school_id->setDbValue($rs->fields('school_id'));
		$schools->school_name->setDbValue($rs->fields('school_name'));
		$schools->address->setDbValue($rs->fields('address'));
		$schools->towncity->setDbValue($rs->fields('towncity'));
		$schools->community_community_id->setDbValue($rs->fields('community_community_id'));
		$schools->school_type->setDbValue($rs->fields('school_type'));
		$schools->contact_person_name->setDbValue($rs->fields('contact_person_name'));
		$schools->telephone->setDbValue($rs->fields('telephone'));
		$schools->bankname->setDbValue($rs->fields('bankname'));
		$schools->account_no->setDbValue($rs->fields('account_no'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $schools;

		// Initialize URLs
		// Call Row_Rendering event

		$schools->Row_Rendering();

		// Common render codes for all row types
		// school_name

		$schools->school_name->CellCssStyle = ""; $schools->school_name->CellCssClass = "";
		$schools->school_name->CellAttrs = array(); $schools->school_name->ViewAttrs = array(); $schools->school_name->EditAttrs = array();

		// address
		$schools->address->CellCssStyle = ""; $schools->address->CellCssClass = "";
		$schools->address->CellAttrs = array(); $schools->address->ViewAttrs = array(); $schools->address->EditAttrs = array();

		// towncity
		$schools->towncity->CellCssStyle = ""; $schools->towncity->CellCssClass = "";
		$schools->towncity->CellAttrs = array(); $schools->towncity->ViewAttrs = array(); $schools->towncity->EditAttrs = array();

		// community_community_id
		$schools->community_community_id->CellCssStyle = ""; $schools->community_community_id->CellCssClass = "";
		$schools->community_community_id->CellAttrs = array(); $schools->community_community_id->ViewAttrs = array(); $schools->community_community_id->EditAttrs = array();

		// school_type
		$schools->school_type->CellCssStyle = ""; $schools->school_type->CellCssClass = "";
		$schools->school_type->CellAttrs = array(); $schools->school_type->ViewAttrs = array(); $schools->school_type->EditAttrs = array();

		// contact_person_name
		$schools->contact_person_name->CellCssStyle = ""; $schools->contact_person_name->CellCssClass = "";
		$schools->contact_person_name->CellAttrs = array(); $schools->contact_person_name->ViewAttrs = array(); $schools->contact_person_name->EditAttrs = array();

		// telephone
		$schools->telephone->CellCssStyle = ""; $schools->telephone->CellCssClass = "";
		$schools->telephone->CellAttrs = array(); $schools->telephone->ViewAttrs = array(); $schools->telephone->EditAttrs = array();

		// bankname
		$schools->bankname->CellCssStyle = ""; $schools->bankname->CellCssClass = "";
		$schools->bankname->CellAttrs = array(); $schools->bankname->ViewAttrs = array(); $schools->bankname->EditAttrs = array();

		// account_no
		$schools->account_no->CellCssStyle = ""; $schools->account_no->CellCssClass = "";
		$schools->account_no->CellAttrs = array(); $schools->account_no->ViewAttrs = array(); $schools->account_no->EditAttrs = array();
		if ($schools->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_id
			$schools->school_id->ViewValue = $schools->school_id->CurrentValue;
			$schools->school_id->CssStyle = "";
			$schools->school_id->CssClass = "";
			$schools->school_id->ViewCustomAttributes = "";

			// school_name
			$schools->school_name->ViewValue = $schools->school_name->CurrentValue;
			$schools->school_name->CssStyle = "";
			$schools->school_name->CssClass = "";
			$schools->school_name->ViewCustomAttributes = "";

			// address
			$schools->address->ViewValue = $schools->address->CurrentValue;
			$schools->address->CssStyle = "";
			$schools->address->CssClass = "";
			$schools->address->ViewCustomAttributes = "";

			// towncity
			$schools->towncity->ViewValue = $schools->towncity->CurrentValue;
			$schools->towncity->CssStyle = "";
			$schools->towncity->CssClass = "";
			$schools->towncity->ViewCustomAttributes = "";

			// community_community_id
			if (strval($schools->community_community_id->CurrentValue) <> "") {
				$sFilterWrk = "`community_id` = " . ew_AdjustSql($schools->community_community_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `community` FROM `community`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `community` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$schools->community_community_id->ViewValue = $rswrk->fields('community');
					$rswrk->Close();
				} else {
					$schools->community_community_id->ViewValue = $schools->community_community_id->CurrentValue;
				}
			} else {
				$schools->community_community_id->ViewValue = NULL;
			}
			$schools->community_community_id->CssStyle = "";
			$schools->community_community_id->CssClass = "";
			$schools->community_community_id->ViewCustomAttributes = "";

			// school_type
			if (strval($schools->school_type->CurrentValue) <> "") {
				$sFilterWrk = "`school_type` = '" . ew_AdjustSql($schools->school_type->CurrentValue) . "'";
			$sSqlWrk = "SELECT `school_type` FROM `school_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$schools->school_type->ViewValue = $rswrk->fields('school_type');
					$rswrk->Close();
				} else {
					$schools->school_type->ViewValue = $schools->school_type->CurrentValue;
				}
			} else {
				$schools->school_type->ViewValue = NULL;
			}
			$schools->school_type->CssStyle = "";
			$schools->school_type->CssClass = "";
			$schools->school_type->ViewCustomAttributes = "";

			// contact_person_name
			$schools->contact_person_name->ViewValue = $schools->contact_person_name->CurrentValue;
			$schools->contact_person_name->CssStyle = "";
			$schools->contact_person_name->CssClass = "";
			$schools->contact_person_name->ViewCustomAttributes = "";

			// telephone
			$schools->telephone->ViewValue = $schools->telephone->CurrentValue;
			$schools->telephone->CssStyle = "";
			$schools->telephone->CssClass = "";
			$schools->telephone->ViewCustomAttributes = "";

			// bankname
			$schools->bankname->ViewValue = $schools->bankname->CurrentValue;
			$schools->bankname->CssStyle = "";
			$schools->bankname->CssClass = "";
			$schools->bankname->ViewCustomAttributes = "";

			// account_no
			$schools->account_no->ViewValue = $schools->account_no->CurrentValue;
			$schools->account_no->CssStyle = "";
			$schools->account_no->CssClass = "";
			$schools->account_no->ViewCustomAttributes = "";

			// school_name
			$schools->school_name->HrefValue = "";
			$schools->school_name->TooltipValue = "";

			// address
			$schools->address->HrefValue = "";
			$schools->address->TooltipValue = "";

			// towncity
			$schools->towncity->HrefValue = "";
			$schools->towncity->TooltipValue = "";

			// community_community_id
			$schools->community_community_id->HrefValue = "";
			$schools->community_community_id->TooltipValue = "";

			// school_type
			$schools->school_type->HrefValue = "";
			$schools->school_type->TooltipValue = "";

			// contact_person_name
			$schools->contact_person_name->HrefValue = "";
			$schools->contact_person_name->TooltipValue = "";

			// telephone
			$schools->telephone->HrefValue = "";
			$schools->telephone->TooltipValue = "";

			// bankname
			$schools->bankname->HrefValue = "";
			$schools->bankname->TooltipValue = "";

			// account_no
			$schools->account_no->HrefValue = "";
			$schools->account_no->TooltipValue = "";
		} elseif ($schools->RowType == EW_ROWTYPE_ADD) { // Add row

			// school_name
			$schools->school_name->EditCustomAttributes = "";
			$schools->school_name->EditValue = ew_HtmlEncode($schools->school_name->CurrentValue);

			// address
			$schools->address->EditCustomAttributes = "";
			$schools->address->EditValue = ew_HtmlEncode($schools->address->CurrentValue);

			// towncity
			$schools->towncity->EditCustomAttributes = "";
			$schools->towncity->EditValue = ew_HtmlEncode($schools->towncity->CurrentValue);

			// community_community_id
			$schools->community_community_id->EditCustomAttributes = "";
			if ($schools->community_community_id->getSessionValue() <> "") {
				$schools->community_community_id->CurrentValue = $schools->community_community_id->getSessionValue();
			if (strval($schools->community_community_id->CurrentValue) <> "") {
				$sFilterWrk = "`community_id` = " . ew_AdjustSql($schools->community_community_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `community` FROM `community`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `community` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$schools->community_community_id->ViewValue = $rswrk->fields('community');
					$rswrk->Close();
				} else {
					$schools->community_community_id->ViewValue = $schools->community_community_id->CurrentValue;
				}
			} else {
				$schools->community_community_id->ViewValue = NULL;
			}
			$schools->community_community_id->CssStyle = "";
			$schools->community_community_id->CssClass = "";
			$schools->community_community_id->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `community_id`, `community`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `community`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `community` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$schools->community_community_id->EditValue = $arwrk;
			}

			// school_type
			$schools->school_type->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `school_type`, `school_type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `school_type`";
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
			$schools->school_type->EditValue = $arwrk;

			// contact_person_name
			$schools->contact_person_name->EditCustomAttributes = "";
			$schools->contact_person_name->EditValue = ew_HtmlEncode($schools->contact_person_name->CurrentValue);

			// telephone
			$schools->telephone->EditCustomAttributes = "";
			$schools->telephone->EditValue = ew_HtmlEncode($schools->telephone->CurrentValue);

			// bankname
			$schools->bankname->EditCustomAttributes = "";
			$schools->bankname->EditValue = ew_HtmlEncode($schools->bankname->CurrentValue);

			// account_no
			$schools->account_no->EditCustomAttributes = "";
			$schools->account_no->EditValue = ew_HtmlEncode($schools->account_no->CurrentValue);
		}

		// Call Row Rendered event
		if ($schools->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$schools->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $schools;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($schools->school_name->FormValue) && $schools->school_name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $schools->school_name->FldCaption();
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
		global $conn, $Language, $Security, $schools;
		$rsnew = array();

		// school_name
		$schools->school_name->SetDbValueDef($rsnew, $schools->school_name->CurrentValue, NULL, FALSE);

		// address
		$schools->address->SetDbValueDef($rsnew, $schools->address->CurrentValue, NULL, FALSE);

		// towncity
		$schools->towncity->SetDbValueDef($rsnew, $schools->towncity->CurrentValue, NULL, FALSE);

		// community_community_id
		$schools->community_community_id->SetDbValueDef($rsnew, $schools->community_community_id->CurrentValue, NULL, FALSE);

		// school_type
		$schools->school_type->SetDbValueDef($rsnew, $schools->school_type->CurrentValue, NULL, FALSE);

		// contact_person_name
		$schools->contact_person_name->SetDbValueDef($rsnew, $schools->contact_person_name->CurrentValue, NULL, FALSE);

		// telephone
		$schools->telephone->SetDbValueDef($rsnew, $schools->telephone->CurrentValue, NULL, FALSE);

		// bankname
		$schools->bankname->SetDbValueDef($rsnew, $schools->bankname->CurrentValue, NULL, FALSE);

		// account_no
		$schools->account_no->SetDbValueDef($rsnew, $schools->account_no->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $schools->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($schools->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($schools->CancelMessage <> "") {
				$this->setMessage($schools->CancelMessage);
				$schools->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$schools->school_id->setDbValue($conn->Insert_ID());
			$rsnew['school_id'] = $schools->school_id->DbValue;

			// Call Row Inserted event
			$schools->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $schools;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "community") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $schools->SqlMasterFilter_community();
				$this->sDbDetailFilter = $schools->SqlDetailFilter_community();
				if (@$_GET["community_id"] <> "") {
					$GLOBALS["community"]->community_id->setQueryStringValue($_GET["community_id"]);
					$schools->community_community_id->setQueryStringValue($GLOBALS["community"]->community_id->QueryStringValue);
					$schools->community_community_id->setSessionValue($schools->community_community_id->QueryStringValue);
					if (!is_numeric($GLOBALS["community"]->community_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@community_id@", ew_AdjustSql($GLOBALS["community"]->community_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@community_community_id@", ew_AdjustSql($GLOBALS["community"]->community_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$schools->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$schools->setStartRecordNumber($this->lStartRec);
			$schools->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$schools->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "community") {
				if ($schools->community_community_id->QueryStringValue == "") $schools->community_community_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $schools->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $schools->getDetailFilter(); // Restore detail filter
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
