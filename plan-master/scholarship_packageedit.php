<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "scholarship_packageinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "sponsored_student_detailinfo.php" ?>
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
$scholarship_package_edit = new cscholarship_package_edit();
$Page =& $scholarship_package_edit;

// Page init
$scholarship_package_edit->Page_Init();

// Page main
$scholarship_package_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_package_edit = new ew_Page("scholarship_package_edit");

// page properties
scholarship_package_edit.PageID = "edit"; // page ID
scholarship_package_edit.FormID = "fscholarship_packageedit"; // form ID
var EW_PAGE_ID = scholarship_package_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
scholarship_package_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_start_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($scholarship_package->start_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_start_date"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->start_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_end_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($scholarship_package->end_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_end_date"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->end_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($scholarship_package->status->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_grant_package_grant_package_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->grant_package_grant_package_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_sponsored_student_sponsored_student_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->sponsored_student_sponsored_student_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_scholarship_type"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->scholarship_type->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->group_id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
scholarship_package_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_package_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_package_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_package->TableCaption() ?><br><br>
<a href="<?php echo $scholarship_package->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$scholarship_package_edit->ShowMessage();
?>
<form name="fscholarship_packageedit" id="fscholarship_packageedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return scholarship_package_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="scholarship_package">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($scholarship_package->scholarship_package_id->Visible) { // scholarship_package_id ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->scholarship_package_id->FldCaption() ?></td>
		<td<?php echo $scholarship_package->scholarship_package_id->CellAttributes() ?>><span id="el_scholarship_package_id">
<div<?php echo $scholarship_package->scholarship_package_id->ViewAttributes() ?>><?php echo $scholarship_package->scholarship_package_id->EditValue ?></div><input type="hidden" name="x_scholarship_package_id" id="x_scholarship_package_id" value="<?php echo ew_HtmlEncode($scholarship_package->scholarship_package_id->CurrentValue) ?>">
</span><?php echo $scholarship_package->scholarship_package_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->start_date->Visible) { // start_date ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->start_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $scholarship_package->start_date->CellAttributes() ?>><span id="el_start_date">
<input type="text" name="x_start_date" id="x_start_date" title="<?php echo $scholarship_package->start_date->FldTitle() ?>" value="<?php echo $scholarship_package->start_date->EditValue ?>"<?php echo $scholarship_package->start_date->EditAttributes() ?>>
</span><?php echo $scholarship_package->start_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->end_date->Visible) { // end_date ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->end_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $scholarship_package->end_date->CellAttributes() ?>><span id="el_end_date">
<input type="text" name="x_end_date" id="x_end_date" title="<?php echo $scholarship_package->end_date->FldTitle() ?>" value="<?php echo $scholarship_package->end_date->EditValue ?>"<?php echo $scholarship_package->end_date->EditAttributes() ?>>
</span><?php echo $scholarship_package->end_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->status->Visible) { // status ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $scholarship_package->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $scholarship_package->status->FldTitle() ?>" value="{value}"<?php echo $scholarship_package->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $scholarship_package->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($scholarship_package->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $scholarship_package->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $scholarship_package->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $scholarship_package->status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->annual_amount->Visible) { // annual_amount ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->annual_amount->FldCaption() ?></td>
		<td<?php echo $scholarship_package->annual_amount->CellAttributes() ?>><span id="el_annual_amount">
<div<?php echo $scholarship_package->annual_amount->ViewAttributes() ?>><?php echo $scholarship_package->annual_amount->EditValue ?></div><input type="hidden" name="x_annual_amount" id="x_annual_amount" value="<?php echo ew_HtmlEncode($scholarship_package->annual_amount->CurrentValue) ?>">
</span><?php echo $scholarship_package->annual_amount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->grant_package_grant_package_id->Visible) { // grant_package_grant_package_id ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->grant_package_grant_package_id->FldCaption() ?></td>
		<td<?php echo $scholarship_package->grant_package_grant_package_id->CellAttributes() ?>><span id="el_grant_package_grant_package_id">
<div id="as_x_grant_package_grant_package_id" style="z-index: 8940">
	<input type="text" name="sv_x_grant_package_grant_package_id" id="sv_x_grant_package_grant_package_id" value="<?php echo $scholarship_package->grant_package_grant_package_id->EditValue ?>" title="<?php echo $scholarship_package->grant_package_grant_package_id->FldTitle() ?>" size="30"<?php echo $scholarship_package->grant_package_grant_package_id->EditAttributes() ?>>&nbsp;<span id="em_x_grant_package_grant_package_id" class="ewMessage" style="display: none"><?php echo $Language->Phrase("UnmatchedValue") ?></span>
	<div id="sc_x_grant_package_grant_package_id"></div>
</div>
<input type="hidden" name="x_grant_package_grant_package_id" id="x_grant_package_grant_package_id" value="<?php echo $scholarship_package->grant_package_grant_package_id->CurrentValue ?>">
<?php
$sSqlWrk = "SELECT `grant_package_id`, `name` FROM `grant_package`";
$sWhereWrk = "`name` LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_grant_package_grant_package_id" id="s_x_grant_package_grant_package_id" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_grant_package_grant_package_id = new ew_AutoSuggest("sv_x_grant_package_grant_package_id", "sc_x_grant_package_grant_package_id", "s_x_grant_package_grant_package_id", "em_x_grant_package_grant_package_id", "x_grant_package_grant_package_id", "", false);
oas_x_grant_package_grant_package_id.formatResult = function(ar) {	
	var df1 = ar[1];
	return df1;
};
oas_x_grant_package_grant_package_id.ac.typeAhead = false;

//-->
</script>
</span><?php echo $scholarship_package->grant_package_grant_package_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->sponsored_student_sponsored_student_id->Visible) { // sponsored_student_sponsored_student_id ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->sponsored_student_sponsored_student_id->FldCaption() ?></td>
		<td<?php echo $scholarship_package->sponsored_student_sponsored_student_id->CellAttributes() ?>><span id="el_sponsored_student_sponsored_student_id">
<?php if ($scholarship_package->sponsored_student_sponsored_student_id->getSessionValue() <> "") { ?>
<div<?php echo $scholarship_package->sponsored_student_sponsored_student_id->ViewAttributes() ?>><?php echo $scholarship_package->sponsored_student_sponsored_student_id->ViewValue ?></div>
<input type="hidden" id="x_sponsored_student_sponsored_student_id" name="x_sponsored_student_sponsored_student_id" value="<?php echo ew_HtmlEncode($scholarship_package->sponsored_student_sponsored_student_id->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x_sponsored_student_sponsored_student_id" id="x_sponsored_student_sponsored_student_id" title="<?php echo $scholarship_package->sponsored_student_sponsored_student_id->FldTitle() ?>" size="30" value="<?php echo $scholarship_package->sponsored_student_sponsored_student_id->EditValue ?>"<?php echo $scholarship_package->sponsored_student_sponsored_student_id->EditAttributes() ?>>
<?php } ?>
</span><?php echo $scholarship_package->sponsored_student_sponsored_student_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->scholarship_type->Visible) { // scholarship_type ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->scholarship_type->FldCaption() ?></td>
		<td<?php echo $scholarship_package->scholarship_type->CellAttributes() ?>><span id="el_scholarship_type">
<div id="as_x_scholarship_type" style="z-index: 8920">
	<input type="text" name="sv_x_scholarship_type" id="sv_x_scholarship_type" value="<?php echo $scholarship_package->scholarship_type->EditValue ?>" title="<?php echo $scholarship_package->scholarship_type->FldTitle() ?>" size="30"<?php echo $scholarship_package->scholarship_type->EditAttributes() ?>>&nbsp;<span id="em_x_scholarship_type" class="ewMessage" style="display: none"><?php echo $Language->Phrase("UnmatchedValue") ?></span>
	<div id="sc_x_scholarship_type"></div>
</div>
<input type="hidden" name="x_scholarship_type" id="x_scholarship_type" value="<?php echo $scholarship_package->scholarship_type->CurrentValue ?>">
<?php
$sSqlWrk = "SELECT `scholarship_type_id`, `scholarship_type_name` FROM `scholarship_type`";
$sWhereWrk = "`scholarship_type_name` LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_scholarship_type" id="s_x_scholarship_type" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_scholarship_type = new ew_AutoSuggest("sv_x_scholarship_type", "sc_x_scholarship_type", "s_x_scholarship_type", "em_x_scholarship_type", "x_scholarship_type", "", false);
oas_x_scholarship_type.formatResult = function(ar) {	
	var df1 = ar[1];
	return df1;
};
oas_x_scholarship_type.ac.typeAhead = false;

//-->
</script>
</span><?php echo $scholarship_package->scholarship_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_package->group_id->Visible) { // group_id ?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->group_id->FldCaption() ?></td>
		<td<?php echo $scholarship_package->group_id->CellAttributes() ?>><span id="el_group_id">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $scholarship_package->group_id->FldTitle() ?>"<?php echo $scholarship_package->group_id->EditAttributes() ?>>
<?php
if (is_array($scholarship_package->group_id->EditValue)) {
	$arwrk = $scholarship_package->group_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($scholarship_package->group_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } else { ?>
<input type="text" name="x_group_id" id="x_group_id" title="<?php echo $scholarship_package->group_id->FldTitle() ?>" size="30" value="<?php echo $scholarship_package->group_id->EditValue ?>"<?php echo $scholarship_package->group_id->EditAttributes() ?>>
<?php } ?>
</span><?php echo $scholarship_package->group_id->CustomMsg ?></td>
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
$scholarship_package_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_package_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'scholarship_package';

	// Page object name
	var $PageObjName = 'scholarship_package_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $scholarship_package;
		if ($scholarship_package->UseTokenInUrl) $PageUrl .= "t=" . $scholarship_package->TableVar . "&"; // Add page token
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
		global $objForm, $scholarship_package;
		if ($scholarship_package->UseTokenInUrl) {
			if ($objForm)
				return ($scholarship_package->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($scholarship_package->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cscholarship_package_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (scholarship_package)
		$GLOBALS["scholarship_package"] = new cscholarship_package();

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (sponsored_student_detail)
		$GLOBALS['sponsored_student_detail'] = new csponsored_student_detail();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'scholarship_package', TRUE);

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
		global $scholarship_package;

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
			$this->Page_Terminate("scholarship_packagelist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("scholarship_packagelist.php");
		}

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
		global $objForm, $Language, $gsFormError, $scholarship_package;

		// Load key from QueryString
		if (@$_GET["scholarship_package_id"] <> "")
			$scholarship_package->scholarship_package_id->setQueryStringValue($_GET["scholarship_package_id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$scholarship_package->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$scholarship_package->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$scholarship_package->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$scholarship_package->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($scholarship_package->scholarship_package_id->CurrentValue == "")
			$this->Page_Terminate("scholarship_packagelist.php"); // Invalid key, return to list
		switch ($scholarship_package->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("scholarship_packagelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$scholarship_package->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $scholarship_package->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$scholarship_package->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$scholarship_package->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $scholarship_package;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $scholarship_package;
		$scholarship_package->scholarship_package_id->setFormValue($objForm->GetValue("x_scholarship_package_id"));
		$scholarship_package->start_date->setFormValue($objForm->GetValue("x_start_date"));
		$scholarship_package->start_date->CurrentValue = ew_UnFormatDateTime($scholarship_package->start_date->CurrentValue, 2);
		$scholarship_package->end_date->setFormValue($objForm->GetValue("x_end_date"));
		$scholarship_package->end_date->CurrentValue = ew_UnFormatDateTime($scholarship_package->end_date->CurrentValue, 7);
		$scholarship_package->status->setFormValue($objForm->GetValue("x_status"));
		$scholarship_package->annual_amount->setFormValue($objForm->GetValue("x_annual_amount"));
		$scholarship_package->grant_package_grant_package_id->setFormValue($objForm->GetValue("x_grant_package_grant_package_id"));
		$scholarship_package->sponsored_student_sponsored_student_id->setFormValue($objForm->GetValue("x_sponsored_student_sponsored_student_id"));
		$scholarship_package->scholarship_type->setFormValue($objForm->GetValue("x_scholarship_type"));
		$scholarship_package->group_id->setFormValue($objForm->GetValue("x_group_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $scholarship_package;
		$this->LoadRow();
		$scholarship_package->scholarship_package_id->CurrentValue = $scholarship_package->scholarship_package_id->FormValue;
		$scholarship_package->start_date->CurrentValue = $scholarship_package->start_date->FormValue;
		$scholarship_package->start_date->CurrentValue = ew_UnFormatDateTime($scholarship_package->start_date->CurrentValue, 2);
		$scholarship_package->end_date->CurrentValue = $scholarship_package->end_date->FormValue;
		$scholarship_package->end_date->CurrentValue = ew_UnFormatDateTime($scholarship_package->end_date->CurrentValue, 7);
		$scholarship_package->status->CurrentValue = $scholarship_package->status->FormValue;
		$scholarship_package->annual_amount->CurrentValue = $scholarship_package->annual_amount->FormValue;
		$scholarship_package->grant_package_grant_package_id->CurrentValue = $scholarship_package->grant_package_grant_package_id->FormValue;
		$scholarship_package->sponsored_student_sponsored_student_id->CurrentValue = $scholarship_package->sponsored_student_sponsored_student_id->FormValue;
		$scholarship_package->scholarship_type->CurrentValue = $scholarship_package->scholarship_type->FormValue;
		$scholarship_package->group_id->CurrentValue = $scholarship_package->group_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $scholarship_package;
		$sFilter = $scholarship_package->KeyFilter();

		// Call Row Selecting event
		$scholarship_package->Row_Selecting($sFilter);

		// Load SQL based on filter
		$scholarship_package->CurrentFilter = $sFilter;
		$sSql = $scholarship_package->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$scholarship_package->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $scholarship_package;
		$scholarship_package->scholarship_package_id->setDbValue($rs->fields('scholarship_package_id'));
		$scholarship_package->start_date->setDbValue($rs->fields('start_date'));
		$scholarship_package->end_date->setDbValue($rs->fields('end_date'));
		$scholarship_package->status->setDbValue($rs->fields('status'));
		$scholarship_package->annual_amount->setDbValue($rs->fields('annual_amount'));
		$scholarship_package->grant_package_grant_package_id->setDbValue($rs->fields('grant_package_grant_package_id'));
		$scholarship_package->sponsored_student_sponsored_student_id->setDbValue($rs->fields('sponsored_student_sponsored_student_id'));
		$scholarship_package->scholarship_type->setDbValue($rs->fields('scholarship_type'));
		$scholarship_package->scholarship_type_scholarship_type->setDbValue($rs->fields('scholarship_type_scholarship_type'));
		$scholarship_package->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $scholarship_package;

		// Initialize URLs
		// Call Row_Rendering event

		$scholarship_package->Row_Rendering();

		// Common render codes for all row types
		// scholarship_package_id

		$scholarship_package->scholarship_package_id->CellCssStyle = ""; $scholarship_package->scholarship_package_id->CellCssClass = "";
		$scholarship_package->scholarship_package_id->CellAttrs = array(); $scholarship_package->scholarship_package_id->ViewAttrs = array(); $scholarship_package->scholarship_package_id->EditAttrs = array();

		// start_date
		$scholarship_package->start_date->CellCssStyle = ""; $scholarship_package->start_date->CellCssClass = "";
		$scholarship_package->start_date->CellAttrs = array(); $scholarship_package->start_date->ViewAttrs = array(); $scholarship_package->start_date->EditAttrs = array();

		// end_date
		$scholarship_package->end_date->CellCssStyle = ""; $scholarship_package->end_date->CellCssClass = "";
		$scholarship_package->end_date->CellAttrs = array(); $scholarship_package->end_date->ViewAttrs = array(); $scholarship_package->end_date->EditAttrs = array();

		// status
		$scholarship_package->status->CellCssStyle = ""; $scholarship_package->status->CellCssClass = "";
		$scholarship_package->status->CellAttrs = array(); $scholarship_package->status->ViewAttrs = array(); $scholarship_package->status->EditAttrs = array();

		// annual_amount
		$scholarship_package->annual_amount->CellCssStyle = ""; $scholarship_package->annual_amount->CellCssClass = "";
		$scholarship_package->annual_amount->CellAttrs = array(); $scholarship_package->annual_amount->ViewAttrs = array(); $scholarship_package->annual_amount->EditAttrs = array();

		// grant_package_grant_package_id
		$scholarship_package->grant_package_grant_package_id->CellCssStyle = ""; $scholarship_package->grant_package_grant_package_id->CellCssClass = "";
		$scholarship_package->grant_package_grant_package_id->CellAttrs = array(); $scholarship_package->grant_package_grant_package_id->ViewAttrs = array(); $scholarship_package->grant_package_grant_package_id->EditAttrs = array();

		// sponsored_student_sponsored_student_id
		$scholarship_package->sponsored_student_sponsored_student_id->CellCssStyle = ""; $scholarship_package->sponsored_student_sponsored_student_id->CellCssClass = "";
		$scholarship_package->sponsored_student_sponsored_student_id->CellAttrs = array(); $scholarship_package->sponsored_student_sponsored_student_id->ViewAttrs = array(); $scholarship_package->sponsored_student_sponsored_student_id->EditAttrs = array();

		// scholarship_type
		$scholarship_package->scholarship_type->CellCssStyle = ""; $scholarship_package->scholarship_type->CellCssClass = "";
		$scholarship_package->scholarship_type->CellAttrs = array(); $scholarship_package->scholarship_type->ViewAttrs = array(); $scholarship_package->scholarship_type->EditAttrs = array();

		// group_id
		$scholarship_package->group_id->CellCssStyle = ""; $scholarship_package->group_id->CellCssClass = "";
		$scholarship_package->group_id->CellAttrs = array(); $scholarship_package->group_id->ViewAttrs = array(); $scholarship_package->group_id->EditAttrs = array();
		if ($scholarship_package->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_package_id
			$scholarship_package->scholarship_package_id->ViewValue = $scholarship_package->scholarship_package_id->CurrentValue;
			$scholarship_package->scholarship_package_id->CssStyle = "";
			$scholarship_package->scholarship_package_id->CssClass = "";
			$scholarship_package->scholarship_package_id->ViewCustomAttributes = "";

			// start_date
			$scholarship_package->start_date->ViewValue = $scholarship_package->start_date->CurrentValue;
			$scholarship_package->start_date->ViewValue = ew_FormatNumber($scholarship_package->start_date->ViewValue, 0, 0, 0, 0);
			$scholarship_package->start_date->CssStyle = "";
			$scholarship_package->start_date->CssClass = "";
			$scholarship_package->start_date->ViewCustomAttributes = "";

			// end_date
			$scholarship_package->end_date->ViewValue = $scholarship_package->end_date->CurrentValue;
			$scholarship_package->end_date->ViewValue = ew_FormatNumber($scholarship_package->end_date->ViewValue, 0, 0, 0, 0);
			$scholarship_package->end_date->CssStyle = "";
			$scholarship_package->end_date->CssClass = "";
			$scholarship_package->end_date->ViewCustomAttributes = "";

			// status
			if (strval($scholarship_package->status->CurrentValue) <> "") {
				switch ($scholarship_package->status->CurrentValue) {
					case "active":
						$scholarship_package->status->ViewValue = "Active";
						break;
					case "suspended":
						$scholarship_package->status->ViewValue = "Suspended";
						break;
					default:
						$scholarship_package->status->ViewValue = $scholarship_package->status->CurrentValue;
				}
			} else {
				$scholarship_package->status->ViewValue = NULL;
			}
			$scholarship_package->status->CssStyle = "";
			$scholarship_package->status->CssClass = "";
			$scholarship_package->status->ViewCustomAttributes = "";

			// annual_amount
			$scholarship_package->annual_amount->ViewValue = $scholarship_package->annual_amount->CurrentValue;
			$scholarship_package->annual_amount->CssStyle = "";
			$scholarship_package->annual_amount->CssClass = "";
			$scholarship_package->annual_amount->ViewCustomAttributes = "";

			// grant_package_grant_package_id
			$scholarship_package->grant_package_grant_package_id->ViewValue = $scholarship_package->grant_package_grant_package_id->CurrentValue;
			if (strval($scholarship_package->grant_package_grant_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`grant_package_id` = " . ew_AdjustSql($scholarship_package->grant_package_grant_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `grant_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_package->grant_package_grant_package_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$scholarship_package->grant_package_grant_package_id->ViewValue = $scholarship_package->grant_package_grant_package_id->CurrentValue;
				}
			} else {
				$scholarship_package->grant_package_grant_package_id->ViewValue = NULL;
			}
			$scholarship_package->grant_package_grant_package_id->CssStyle = "";
			$scholarship_package->grant_package_grant_package_id->CssClass = "";
			$scholarship_package->grant_package_grant_package_id->ViewCustomAttributes = "";

			// sponsored_student_sponsored_student_id
			$scholarship_package->sponsored_student_sponsored_student_id->ViewValue = $scholarship_package->sponsored_student_sponsored_student_id->CurrentValue;
			$scholarship_package->sponsored_student_sponsored_student_id->CssStyle = "";
			$scholarship_package->sponsored_student_sponsored_student_id->CssClass = "";
			$scholarship_package->sponsored_student_sponsored_student_id->ViewCustomAttributes = "";

			// scholarship_type
			$scholarship_package->scholarship_type->ViewValue = $scholarship_package->scholarship_type->CurrentValue;
			if (strval($scholarship_package->scholarship_type->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_type_id` = " . ew_AdjustSql($scholarship_package->scholarship_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `scholarship_type_name` FROM `scholarship_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_package->scholarship_type->ViewValue = $rswrk->fields('scholarship_type_name');
					$rswrk->Close();
				} else {
					$scholarship_package->scholarship_type->ViewValue = $scholarship_package->scholarship_type->CurrentValue;
				}
			} else {
				$scholarship_package->scholarship_type->ViewValue = NULL;
			}
			$scholarship_package->scholarship_type->CssStyle = "";
			$scholarship_package->scholarship_type->CssClass = "";
			$scholarship_package->scholarship_type->ViewCustomAttributes = "";

			// scholarship_type_scholarship_type
			$scholarship_package->scholarship_type_scholarship_type->ViewValue = $scholarship_package->scholarship_type_scholarship_type->CurrentValue;
			if (strval($scholarship_package->scholarship_type_scholarship_type->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_type_id` = " . ew_AdjustSql($scholarship_package->scholarship_type_scholarship_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `scholarship_type_name` FROM `scholarship_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_package->scholarship_type_scholarship_type->ViewValue = $rswrk->fields('scholarship_type_name');
					$rswrk->Close();
				} else {
					$scholarship_package->scholarship_type_scholarship_type->ViewValue = $scholarship_package->scholarship_type_scholarship_type->CurrentValue;
				}
			} else {
				$scholarship_package->scholarship_type_scholarship_type->ViewValue = NULL;
			}
			$scholarship_package->scholarship_type_scholarship_type->CssStyle = "";
			$scholarship_package->scholarship_type_scholarship_type->CssClass = "";
			$scholarship_package->scholarship_type_scholarship_type->ViewCustomAttributes = "";

			// group_id
			$scholarship_package->group_id->ViewValue = $scholarship_package->group_id->CurrentValue;
			$scholarship_package->group_id->CssStyle = "";
			$scholarship_package->group_id->CssClass = "";
			$scholarship_package->group_id->ViewCustomAttributes = "";

			// scholarship_package_id
			$scholarship_package->scholarship_package_id->HrefValue = "";
			$scholarship_package->scholarship_package_id->TooltipValue = "";

			// start_date
			$scholarship_package->start_date->HrefValue = "";
			$scholarship_package->start_date->TooltipValue = "";

			// end_date
			$scholarship_package->end_date->HrefValue = "";
			$scholarship_package->end_date->TooltipValue = "";

			// status
			$scholarship_package->status->HrefValue = "";
			$scholarship_package->status->TooltipValue = "";

			// annual_amount
			$scholarship_package->annual_amount->HrefValue = "";
			$scholarship_package->annual_amount->TooltipValue = "";

			// grant_package_grant_package_id
			$scholarship_package->grant_package_grant_package_id->HrefValue = "";
			$scholarship_package->grant_package_grant_package_id->TooltipValue = "";

			// sponsored_student_sponsored_student_id
			$scholarship_package->sponsored_student_sponsored_student_id->HrefValue = "";
			$scholarship_package->sponsored_student_sponsored_student_id->TooltipValue = "";

			// scholarship_type
			$scholarship_package->scholarship_type->HrefValue = "";
			$scholarship_package->scholarship_type->TooltipValue = "";

			// group_id
			$scholarship_package->group_id->HrefValue = "";
			$scholarship_package->group_id->TooltipValue = "";
		} elseif ($scholarship_package->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// scholarship_package_id
			$scholarship_package->scholarship_package_id->EditCustomAttributes = "";
			$scholarship_package->scholarship_package_id->EditValue = $scholarship_package->scholarship_package_id->CurrentValue;
			$scholarship_package->scholarship_package_id->CssStyle = "";
			$scholarship_package->scholarship_package_id->CssClass = "";
			$scholarship_package->scholarship_package_id->ViewCustomAttributes = "";

			// start_date
			$scholarship_package->start_date->EditCustomAttributes = "";
			$scholarship_package->start_date->EditValue = ew_HtmlEncode($scholarship_package->start_date->CurrentValue);

			// end_date
			$scholarship_package->end_date->EditCustomAttributes = "";
			$scholarship_package->end_date->EditValue = ew_HtmlEncode($scholarship_package->end_date->CurrentValue);

			// status
			$scholarship_package->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("active", "Active");
			$arwrk[] = array("suspended", "Suspended");
			$scholarship_package->status->EditValue = $arwrk;

			// annual_amount
			$scholarship_package->annual_amount->EditCustomAttributes = "";
			$scholarship_package->annual_amount->EditValue = $scholarship_package->annual_amount->CurrentValue;
			$scholarship_package->annual_amount->CssStyle = "";
			$scholarship_package->annual_amount->CssClass = "";
			$scholarship_package->annual_amount->ViewCustomAttributes = "";

			// grant_package_grant_package_id
			$scholarship_package->grant_package_grant_package_id->EditCustomAttributes = "";
			$scholarship_package->grant_package_grant_package_id->EditValue = ew_HtmlEncode($scholarship_package->grant_package_grant_package_id->CurrentValue);
			if (strval($scholarship_package->grant_package_grant_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`grant_package_id` = " . ew_AdjustSql($scholarship_package->grant_package_grant_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `name` FROM `grant_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_package->grant_package_grant_package_id->EditValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$scholarship_package->grant_package_grant_package_id->EditValue = $scholarship_package->grant_package_grant_package_id->CurrentValue;
				}
			} else {
				$scholarship_package->grant_package_grant_package_id->EditValue = NULL;
			}

			// sponsored_student_sponsored_student_id
			$scholarship_package->sponsored_student_sponsored_student_id->EditCustomAttributes = "";
			if ($scholarship_package->sponsored_student_sponsored_student_id->getSessionValue() <> "") {
				$scholarship_package->sponsored_student_sponsored_student_id->CurrentValue = $scholarship_package->sponsored_student_sponsored_student_id->getSessionValue();
			$scholarship_package->sponsored_student_sponsored_student_id->ViewValue = $scholarship_package->sponsored_student_sponsored_student_id->CurrentValue;
			$scholarship_package->sponsored_student_sponsored_student_id->CssStyle = "";
			$scholarship_package->sponsored_student_sponsored_student_id->CssClass = "";
			$scholarship_package->sponsored_student_sponsored_student_id->ViewCustomAttributes = "";
			} else {
			$scholarship_package->sponsored_student_sponsored_student_id->EditValue = ew_HtmlEncode($scholarship_package->sponsored_student_sponsored_student_id->CurrentValue);
			}

			// scholarship_type
			$scholarship_package->scholarship_type->EditCustomAttributes = "";
			$scholarship_package->scholarship_type->EditValue = ew_HtmlEncode($scholarship_package->scholarship_type->CurrentValue);
			if (strval($scholarship_package->scholarship_type->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_type_id` = " . ew_AdjustSql($scholarship_package->scholarship_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `scholarship_type_name` FROM `scholarship_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_package->scholarship_type->EditValue = $rswrk->fields('scholarship_type_name');
					$rswrk->Close();
				} else {
					$scholarship_package->scholarship_type->EditValue = $scholarship_package->scholarship_type->CurrentValue;
				}
			} else {
				$scholarship_package->scholarship_type->EditValue = NULL;
			}

			// group_id
			$scholarship_package->group_id->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
			$sFilterWrk = "";
			$sFilterWrk = $GLOBALS["users"]->AddUserIDFilter("");
			$sSqlWrk = "SELECT `userlevelid`, `userlevelid` FROM `users`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$scholarship_package->group_id->EditValue = $arwrk;
			} else {
			$scholarship_package->group_id->EditValue = ew_HtmlEncode($scholarship_package->group_id->CurrentValue);
			}

			// Edit refer script
			// scholarship_package_id

			$scholarship_package->scholarship_package_id->HrefValue = "";

			// start_date
			$scholarship_package->start_date->HrefValue = "";

			// end_date
			$scholarship_package->end_date->HrefValue = "";

			// status
			$scholarship_package->status->HrefValue = "";

			// annual_amount
			$scholarship_package->annual_amount->HrefValue = "";

			// grant_package_grant_package_id
			$scholarship_package->grant_package_grant_package_id->HrefValue = "";

			// sponsored_student_sponsored_student_id
			$scholarship_package->sponsored_student_sponsored_student_id->HrefValue = "";

			// scholarship_type
			$scholarship_package->scholarship_type->HrefValue = "";

			// group_id
			$scholarship_package->group_id->HrefValue = "";
		}

		// Call Row Rendered event
		if ($scholarship_package->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$scholarship_package->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $scholarship_package;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($scholarship_package->start_date->FormValue) && $scholarship_package->start_date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $scholarship_package->start_date->FldCaption();
		}
		if (!ew_CheckInteger($scholarship_package->start_date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $scholarship_package->start_date->FldErrMsg();
		}
		if (!is_null($scholarship_package->end_date->FormValue) && $scholarship_package->end_date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $scholarship_package->end_date->FldCaption();
		}
		if (!ew_CheckInteger($scholarship_package->end_date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $scholarship_package->end_date->FldErrMsg();
		}
		if ($scholarship_package->status->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $scholarship_package->status->FldCaption();
		}
		if (!ew_CheckInteger($scholarship_package->grant_package_grant_package_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $scholarship_package->grant_package_grant_package_id->FldErrMsg();
		}
		if (!ew_CheckInteger($scholarship_package->sponsored_student_sponsored_student_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $scholarship_package->sponsored_student_sponsored_student_id->FldErrMsg();
		}
		if (!ew_CheckInteger($scholarship_package->scholarship_type->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $scholarship_package->scholarship_type->FldErrMsg();
		}
		if (!ew_CheckInteger($scholarship_package->group_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $scholarship_package->group_id->FldErrMsg();
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
		global $conn, $Security, $Language, $scholarship_package;
		$sFilter = $scholarship_package->KeyFilter();
		$scholarship_package->CurrentFilter = $sFilter;
		$sSql = $scholarship_package->SQL();
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

			// start_date
			$scholarship_package->start_date->SetDbValueDef($rsnew, $scholarship_package->start_date->CurrentValue, NULL, FALSE);

			// end_date
			$scholarship_package->end_date->SetDbValueDef($rsnew, $scholarship_package->end_date->CurrentValue, NULL, FALSE);

			// status
			$scholarship_package->status->SetDbValueDef($rsnew, $scholarship_package->status->CurrentValue, NULL, FALSE);

			// grant_package_grant_package_id
			$scholarship_package->grant_package_grant_package_id->SetDbValueDef($rsnew, $scholarship_package->grant_package_grant_package_id->CurrentValue, NULL, FALSE);

			// sponsored_student_sponsored_student_id
			$scholarship_package->sponsored_student_sponsored_student_id->SetDbValueDef($rsnew, $scholarship_package->sponsored_student_sponsored_student_id->CurrentValue, NULL, FALSE);

			// scholarship_type
			$scholarship_package->scholarship_type->SetDbValueDef($rsnew, $scholarship_package->scholarship_type->CurrentValue, NULL, FALSE);

			// group_id
			$scholarship_package->group_id->SetDbValueDef($rsnew, $scholarship_package->group_id->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $scholarship_package->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($scholarship_package->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($scholarship_package->CancelMessage <> "") {
					$this->setMessage($scholarship_package->CancelMessage);
					$scholarship_package->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$scholarship_package->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $scholarship_package;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "sponsored_student") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $scholarship_package->SqlMasterFilter_sponsored_student();
				$this->sDbDetailFilter = $scholarship_package->SqlDetailFilter_sponsored_student();
				if (@$_GET["sponsored_student_id"] <> "") {
					$GLOBALS["sponsored_student"]->sponsored_student_id->setQueryStringValue($_GET["sponsored_student_id"]);
					$scholarship_package->sponsored_student_sponsored_student_id->setQueryStringValue($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue);
					$scholarship_package->sponsored_student_sponsored_student_id->setSessionValue($scholarship_package->sponsored_student_sponsored_student_id->QueryStringValue);
					if (!is_numeric($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@sponsored_student_sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student"]->sponsored_student_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
			if ($sMasterTblVar == "sponsored_student_detail") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $scholarship_package->SqlMasterFilter_sponsored_student_detail();
				$this->sDbDetailFilter = $scholarship_package->SqlDetailFilter_sponsored_student_detail();
				if (@$_GET["sponsored_student_id"] <> "") {
					$GLOBALS["sponsored_student_detail"]->sponsored_student_id->setQueryStringValue($_GET["sponsored_student_id"]);
					$scholarship_package->sponsored_student_sponsored_student_id->setQueryStringValue($GLOBALS["sponsored_student_detail"]->sponsored_student_id->QueryStringValue);
					$scholarship_package->sponsored_student_sponsored_student_id->setSessionValue($scholarship_package->sponsored_student_sponsored_student_id->QueryStringValue);
					if (!is_numeric($GLOBALS["sponsored_student_detail"]->sponsored_student_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student_detail"]->sponsored_student_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@sponsored_student_sponsored_student_id@", ew_AdjustSql($GLOBALS["sponsored_student_detail"]->sponsored_student_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$scholarship_package->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$scholarship_package->setStartRecordNumber($this->lStartRec);
			$scholarship_package->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$scholarship_package->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "sponsored_student") {
				if ($scholarship_package->sponsored_student_sponsored_student_id->QueryStringValue == "") $scholarship_package->sponsored_student_sponsored_student_id->setSessionValue("");
			}
			if ($sMasterTblVar <> "sponsored_student_detail") {
				if ($scholarship_package->sponsored_student_sponsored_student_id->QueryStringValue == "") $scholarship_package->sponsored_student_sponsored_student_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $scholarship_package->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $scholarship_package->getDetailFilter(); // Restore detail filter
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'scholarship_package';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $scholarship_package;
		$table = 'scholarship_package';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['scholarship_package_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if ($scholarship_package->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($scholarship_package->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($scholarship_package->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} elseif ($scholarship_package->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "<XML>";
						$newvalue = "<XML>";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
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
