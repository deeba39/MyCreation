<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "scholarship_paymentinfo.php" ?>
<?php include "sponsored_studentinfo.php" ?>
<?php include "scholarship_packageinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "payment_requestinfo.php" ?>
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
$scholarship_payment_edit = new cscholarship_payment_edit();
$Page =& $scholarship_payment_edit;

// Page init
$scholarship_payment_edit->Page_Init();

// Page main
$scholarship_payment_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_payment_edit = new ew_Page("scholarship_payment_edit");

// page properties
scholarship_payment_edit.PageID = "edit"; // page ID
scholarship_payment_edit.FormID = "fscholarship_paymentedit"; // form ID
var EW_PAGE_ID = scholarship_payment_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
scholarship_payment_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_refund_amount"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_payment->refund_amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_schools_school_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_payment->schools_school_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_payment->group_id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
scholarship_payment_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_payment_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_payment_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_payment->TableCaption() ?><br><br>
<a href="<?php echo $scholarship_payment->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$scholarship_payment_edit->ShowMessage();
?>
<form name="fscholarship_paymentedit" id="fscholarship_paymentedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return scholarship_payment_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="scholarship_payment">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($scholarship_payment->scholarship_payment_id->Visible) { // scholarship_payment_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->scholarship_payment_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->scholarship_payment_id->CellAttributes() ?>><span id="el_scholarship_payment_id">
<div<?php echo $scholarship_payment->scholarship_payment_id->ViewAttributes() ?>><?php echo $scholarship_payment->scholarship_payment_id->EditValue ?></div><input type="hidden" name="x_scholarship_payment_id" id="x_scholarship_payment_id" value="<?php echo ew_HtmlEncode($scholarship_payment->scholarship_payment_id->CurrentValue) ?>">
</span><?php echo $scholarship_payment->scholarship_payment_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->date->Visible) { // date ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $scholarship_payment->date->CellAttributes() ?>><span id="el_date">
<div<?php echo $scholarship_payment->date->ViewAttributes() ?>><?php echo $scholarship_payment->date->EditValue ?></div><input type="hidden" name="x_date" id="x_date" value="<?php echo ew_HtmlEncode($scholarship_payment->date->CurrentValue) ?>">
</span><?php echo $scholarship_payment->date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->status->Visible) { // status ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->status->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $scholarship_payment->status->FldTitle() ?>" value="{value}"<?php echo $scholarship_payment->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $scholarship_payment->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($scholarship_payment->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $scholarship_payment->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $scholarship_payment->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $scholarship_payment->status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->amount->Visible) { // amount ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->amount->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $scholarship_payment->amount->CellAttributes() ?>><span id="el_amount">
<div<?php echo $scholarship_payment->amount->ViewAttributes() ?>><?php echo $scholarship_payment->amount->EditValue ?></div><input type="hidden" name="x_amount" id="x_amount" value="<?php echo ew_HtmlEncode($scholarship_payment->amount->CurrentValue) ?>">
</span><?php echo $scholarship_payment->amount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->memo->Visible) { // memo ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->memo->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->memo->CellAttributes() ?>><span id="el_memo">
<div<?php echo $scholarship_payment->memo->ViewAttributes() ?>><?php echo $scholarship_payment->memo->EditValue ?></div><input type="hidden" name="x_memo" id="x_memo" value="<?php echo ew_HtmlEncode($scholarship_payment->memo->CurrentValue) ?>">
</span><?php echo $scholarship_payment->memo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->year->Visible) { // year ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->year->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $scholarship_payment->year->CellAttributes() ?>><span id="el_year">
<div<?php echo $scholarship_payment->year->ViewAttributes() ?>><?php echo $scholarship_payment->year->EditValue ?></div><input type="hidden" name="x_year" id="x_year" value="<?php echo ew_HtmlEncode($scholarship_payment->year->CurrentValue) ?>">
</span><?php echo $scholarship_payment->year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->scholarship_package_scholarship_package_id->Visible) { // scholarship_package_scholarship_package_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->scholarship_package_scholarship_package_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->scholarship_package_scholarship_package_id->CellAttributes() ?>><span id="el_scholarship_package_scholarship_package_id">
<div<?php echo $scholarship_payment->scholarship_package_scholarship_package_id->ViewAttributes() ?>><?php echo $scholarship_payment->scholarship_package_scholarship_package_id->EditValue ?></div><input type="hidden" name="x_scholarship_package_scholarship_package_id" id="x_scholarship_package_scholarship_package_id" value="<?php echo ew_HtmlEncode($scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue) ?>">
</span><?php echo $scholarship_payment->scholarship_package_scholarship_package_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->programarea_residentarea_id->Visible) { // programarea_residentarea_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->programarea_residentarea_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->programarea_residentarea_id->CellAttributes() ?>><span id="el_programarea_residentarea_id">
<div<?php echo $scholarship_payment->programarea_residentarea_id->ViewAttributes() ?>><?php echo $scholarship_payment->programarea_residentarea_id->EditValue ?></div><input type="hidden" name="x_programarea_residentarea_id" id="x_programarea_residentarea_id" value="<?php echo ew_HtmlEncode($scholarship_payment->programarea_residentarea_id->CurrentValue) ?>">
</span><?php echo $scholarship_payment->programarea_residentarea_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->programarea_payingarea_id->Visible) { // programarea_payingarea_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->programarea_payingarea_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->programarea_payingarea_id->CellAttributes() ?>><span id="el_programarea_payingarea_id">
<div<?php echo $scholarship_payment->programarea_payingarea_id->ViewAttributes() ?>><?php echo $scholarship_payment->programarea_payingarea_id->EditValue ?></div><input type="hidden" name="x_programarea_payingarea_id" id="x_programarea_payingarea_id" value="<?php echo ew_HtmlEncode($scholarship_payment->programarea_payingarea_id->CurrentValue) ?>">
</span><?php echo $scholarship_payment->programarea_payingarea_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->refund_amount->Visible) { // refund_amount ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->refund_amount->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->refund_amount->CellAttributes() ?>><span id="el_refund_amount">
<input type="text" name="x_refund_amount" id="x_refund_amount" title="<?php echo $scholarship_payment->refund_amount->FldTitle() ?>" size="30" value="<?php echo $scholarship_payment->refund_amount->EditValue ?>"<?php echo $scholarship_payment->refund_amount->EditAttributes() ?>>
</span><?php echo $scholarship_payment->refund_amount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->payment_request_payment_request_id->Visible) { // payment_request_payment_request_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->payment_request_payment_request_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->payment_request_payment_request_id->CellAttributes() ?>><span id="el_payment_request_payment_request_id">
<div<?php echo $scholarship_payment->payment_request_payment_request_id->ViewAttributes() ?>><?php echo $scholarship_payment->payment_request_payment_request_id->EditValue ?></div><input type="hidden" name="x_payment_request_payment_request_id" id="x_payment_request_payment_request_id" value="<?php echo ew_HtmlEncode($scholarship_payment->payment_request_payment_request_id->CurrentValue) ?>">
</span><?php echo $scholarship_payment->payment_request_payment_request_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->bankname->Visible) { // bankname ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->bankname->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->bankname->CellAttributes() ?>><span id="el_bankname">
<input type="text" name="x_bankname" id="x_bankname" title="<?php echo $scholarship_payment->bankname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $scholarship_payment->bankname->EditValue ?>"<?php echo $scholarship_payment->bankname->EditAttributes() ?>>
</span><?php echo $scholarship_payment->bankname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->account_no->Visible) { // account_no ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->account_no->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->account_no->CellAttributes() ?>><span id="el_account_no">
<input type="text" name="x_account_no" id="x_account_no" title="<?php echo $scholarship_payment->account_no->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $scholarship_payment->account_no->EditValue ?>"<?php echo $scholarship_payment->account_no->EditAttributes() ?>>
</span><?php echo $scholarship_payment->account_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->schools_school_id->Visible) { // schools_school_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->schools_school_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->schools_school_id->CellAttributes() ?>><span id="el_schools_school_id">
<div id="as_x_schools_school_id" style="z-index: 8860">
	<input type="text" name="sv_x_schools_school_id" id="sv_x_schools_school_id" value="<?php echo $scholarship_payment->schools_school_id->EditValue ?>" title="<?php echo $scholarship_payment->schools_school_id->FldTitle() ?>" size="30"<?php echo $scholarship_payment->schools_school_id->EditAttributes() ?>>&nbsp;<span id="em_x_schools_school_id" class="ewMessage" style="display: none"><?php echo $Language->Phrase("UnmatchedValue") ?></span>
	<div id="sc_x_schools_school_id"></div>
</div>
<input type="hidden" name="x_schools_school_id" id="x_schools_school_id" value="<?php echo $scholarship_payment->schools_school_id->CurrentValue ?>">
<?php
$sSqlWrk = "SELECT `school_id`, `school_name` FROM `schools`";
$sWhereWrk = "`school_name` LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_schools_school_id" id="s_x_schools_school_id" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_schools_school_id = new ew_AutoSuggest("sv_x_schools_school_id", "sc_x_schools_school_id", "s_x_schools_school_id", "em_x_schools_school_id", "x_schools_school_id", "", false);
oas_x_schools_school_id.formatResult = function(ar) {	
	var df1 = ar[1];
	return df1;
};
oas_x_schools_school_id.ac.typeAhead = false;

//-->
</script>
</span><?php echo $scholarship_payment->schools_school_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($scholarship_payment->group_id->Visible) { // group_id ?>
	<tr<?php echo $scholarship_payment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_payment->group_id->FldCaption() ?></td>
		<td<?php echo $scholarship_payment->group_id->CellAttributes() ?>><span id="el_group_id">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $scholarship_payment->group_id->FldTitle() ?>"<?php echo $scholarship_payment->group_id->EditAttributes() ?>>
<?php
if (is_array($scholarship_payment->group_id->EditValue)) {
	$arwrk = $scholarship_payment->group_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($scholarship_payment->group_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="text" name="x_group_id" id="x_group_id" title="<?php echo $scholarship_payment->group_id->FldTitle() ?>" size="30" value="<?php echo $scholarship_payment->group_id->EditValue ?>"<?php echo $scholarship_payment->group_id->EditAttributes() ?>>
<?php } ?>
</span><?php echo $scholarship_payment->group_id->CustomMsg ?></td>
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
$scholarship_payment_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_payment_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'scholarship_payment';

	// Page object name
	var $PageObjName = 'scholarship_payment_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $scholarship_payment;
		if ($scholarship_payment->UseTokenInUrl) $PageUrl .= "t=" . $scholarship_payment->TableVar . "&"; // Add page token
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
		global $objForm, $scholarship_payment;
		if ($scholarship_payment->UseTokenInUrl) {
			if ($objForm)
				return ($scholarship_payment->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($scholarship_payment->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cscholarship_payment_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (scholarship_payment)
		$GLOBALS["scholarship_payment"] = new cscholarship_payment();

		// Table object (sponsored_student)
		$GLOBALS['sponsored_student'] = new csponsored_student();

		// Table object (scholarship_package)
		$GLOBALS['scholarship_package'] = new cscholarship_package();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (payment_request)
		$GLOBALS['payment_request'] = new cpayment_request();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'scholarship_payment', TRUE);

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
		global $scholarship_payment;

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
			$this->Page_Terminate("scholarship_paymentlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("scholarship_paymentlist.php");
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
		global $objForm, $Language, $gsFormError, $scholarship_payment;

		// Load key from QueryString
		if (@$_GET["scholarship_payment_id"] <> "")
			$scholarship_payment->scholarship_payment_id->setQueryStringValue($_GET["scholarship_payment_id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$scholarship_payment->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$scholarship_payment->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$scholarship_payment->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$scholarship_payment->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($scholarship_payment->scholarship_payment_id->CurrentValue == "")
			$this->Page_Terminate("scholarship_paymentlist.php"); // Invalid key, return to list
		switch ($scholarship_payment->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("scholarship_paymentlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$scholarship_payment->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $scholarship_payment->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$scholarship_payment->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$scholarship_payment->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $scholarship_payment;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $scholarship_payment;
		$scholarship_payment->scholarship_payment_id->setFormValue($objForm->GetValue("x_scholarship_payment_id"));
		$scholarship_payment->date->setFormValue($objForm->GetValue("x_date"));
		$scholarship_payment->date->CurrentValue = ew_UnFormatDateTime($scholarship_payment->date->CurrentValue, 7);
		$scholarship_payment->status->setFormValue($objForm->GetValue("x_status"));
		$scholarship_payment->amount->setFormValue($objForm->GetValue("x_amount"));
		$scholarship_payment->memo->setFormValue($objForm->GetValue("x_memo"));
		$scholarship_payment->year->setFormValue($objForm->GetValue("x_year"));
		$scholarship_payment->scholarship_package_scholarship_package_id->setFormValue($objForm->GetValue("x_scholarship_package_scholarship_package_id"));
		$scholarship_payment->programarea_residentarea_id->setFormValue($objForm->GetValue("x_programarea_residentarea_id"));
		$scholarship_payment->programarea_payingarea_id->setFormValue($objForm->GetValue("x_programarea_payingarea_id"));
		$scholarship_payment->refund_amount->setFormValue($objForm->GetValue("x_refund_amount"));
		$scholarship_payment->payment_request_payment_request_id->setFormValue($objForm->GetValue("x_payment_request_payment_request_id"));
		$scholarship_payment->bankname->setFormValue($objForm->GetValue("x_bankname"));
		$scholarship_payment->account_no->setFormValue($objForm->GetValue("x_account_no"));
		$scholarship_payment->schools_school_id->setFormValue($objForm->GetValue("x_schools_school_id"));
		$scholarship_payment->group_id->setFormValue($objForm->GetValue("x_group_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $scholarship_payment;
		$this->LoadRow();
		$scholarship_payment->scholarship_payment_id->CurrentValue = $scholarship_payment->scholarship_payment_id->FormValue;
		$scholarship_payment->date->CurrentValue = $scholarship_payment->date->FormValue;
		$scholarship_payment->date->CurrentValue = ew_UnFormatDateTime($scholarship_payment->date->CurrentValue, 7);
		$scholarship_payment->status->CurrentValue = $scholarship_payment->status->FormValue;
		$scholarship_payment->amount->CurrentValue = $scholarship_payment->amount->FormValue;
		$scholarship_payment->memo->CurrentValue = $scholarship_payment->memo->FormValue;
		$scholarship_payment->year->CurrentValue = $scholarship_payment->year->FormValue;
		$scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue = $scholarship_payment->scholarship_package_scholarship_package_id->FormValue;
		$scholarship_payment->programarea_residentarea_id->CurrentValue = $scholarship_payment->programarea_residentarea_id->FormValue;
		$scholarship_payment->programarea_payingarea_id->CurrentValue = $scholarship_payment->programarea_payingarea_id->FormValue;
		$scholarship_payment->refund_amount->CurrentValue = $scholarship_payment->refund_amount->FormValue;
		$scholarship_payment->payment_request_payment_request_id->CurrentValue = $scholarship_payment->payment_request_payment_request_id->FormValue;
		$scholarship_payment->bankname->CurrentValue = $scholarship_payment->bankname->FormValue;
		$scholarship_payment->account_no->CurrentValue = $scholarship_payment->account_no->FormValue;
		$scholarship_payment->schools_school_id->CurrentValue = $scholarship_payment->schools_school_id->FormValue;
		$scholarship_payment->group_id->CurrentValue = $scholarship_payment->group_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $scholarship_payment;
		$sFilter = $scholarship_payment->KeyFilter();

		// Call Row Selecting event
		$scholarship_payment->Row_Selecting($sFilter);

		// Load SQL based on filter
		$scholarship_payment->CurrentFilter = $sFilter;
		$sSql = $scholarship_payment->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$scholarship_payment->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $scholarship_payment;
		$scholarship_payment->scholarship_payment_id->setDbValue($rs->fields('scholarship_payment_id'));
		$scholarship_payment->date->setDbValue($rs->fields('date'));
		$scholarship_payment->status->setDbValue($rs->fields('status'));
		$scholarship_payment->amount->setDbValue($rs->fields('amount'));
		$scholarship_payment->memo->setDbValue($rs->fields('memo'));
		$scholarship_payment->year->setDbValue($rs->fields('year'));
		$scholarship_payment->scholarship_package_scholarship_package_id->setDbValue($rs->fields('scholarship_package_scholarship_package_id'));
		$scholarship_payment->programarea_residentarea_id->setDbValue($rs->fields('programarea_residentarea_id'));
		$scholarship_payment->programarea_payingarea_id->setDbValue($rs->fields('programarea_payingarea_id'));
		$scholarship_payment->refund_amount->setDbValue($rs->fields('refund_amount'));
		$scholarship_payment->payment_request_payment_request_id->setDbValue($rs->fields('payment_request_payment_request_id'));
		$scholarship_payment->bankname->setDbValue($rs->fields('bankname'));
		$scholarship_payment->account_no->setDbValue($rs->fields('account_no'));
		$scholarship_payment->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$scholarship_payment->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $scholarship_payment;

		// Initialize URLs
		// Call Row_Rendering event

		$scholarship_payment->Row_Rendering();

		// Common render codes for all row types
		// scholarship_payment_id

		$scholarship_payment->scholarship_payment_id->CellCssStyle = ""; $scholarship_payment->scholarship_payment_id->CellCssClass = "";
		$scholarship_payment->scholarship_payment_id->CellAttrs = array(); $scholarship_payment->scholarship_payment_id->ViewAttrs = array(); $scholarship_payment->scholarship_payment_id->EditAttrs = array();

		// date
		$scholarship_payment->date->CellCssStyle = ""; $scholarship_payment->date->CellCssClass = "";
		$scholarship_payment->date->CellAttrs = array(); $scholarship_payment->date->ViewAttrs = array(); $scholarship_payment->date->EditAttrs = array();

		// status
		$scholarship_payment->status->CellCssStyle = ""; $scholarship_payment->status->CellCssClass = "";
		$scholarship_payment->status->CellAttrs = array(); $scholarship_payment->status->ViewAttrs = array(); $scholarship_payment->status->EditAttrs = array();

		// amount
		$scholarship_payment->amount->CellCssStyle = ""; $scholarship_payment->amount->CellCssClass = "";
		$scholarship_payment->amount->CellAttrs = array(); $scholarship_payment->amount->ViewAttrs = array(); $scholarship_payment->amount->EditAttrs = array();

		// memo
		$scholarship_payment->memo->CellCssStyle = ""; $scholarship_payment->memo->CellCssClass = "";
		$scholarship_payment->memo->CellAttrs = array(); $scholarship_payment->memo->ViewAttrs = array(); $scholarship_payment->memo->EditAttrs = array();

		// year
		$scholarship_payment->year->CellCssStyle = ""; $scholarship_payment->year->CellCssClass = "";
		$scholarship_payment->year->CellAttrs = array(); $scholarship_payment->year->ViewAttrs = array(); $scholarship_payment->year->EditAttrs = array();

		// scholarship_package_scholarship_package_id
		$scholarship_payment->scholarship_package_scholarship_package_id->CellCssStyle = ""; $scholarship_payment->scholarship_package_scholarship_package_id->CellCssClass = "";
		$scholarship_payment->scholarship_package_scholarship_package_id->CellAttrs = array(); $scholarship_payment->scholarship_package_scholarship_package_id->ViewAttrs = array(); $scholarship_payment->scholarship_package_scholarship_package_id->EditAttrs = array();

		// programarea_residentarea_id
		$scholarship_payment->programarea_residentarea_id->CellCssStyle = ""; $scholarship_payment->programarea_residentarea_id->CellCssClass = "";
		$scholarship_payment->programarea_residentarea_id->CellAttrs = array(); $scholarship_payment->programarea_residentarea_id->ViewAttrs = array(); $scholarship_payment->programarea_residentarea_id->EditAttrs = array();

		// programarea_payingarea_id
		$scholarship_payment->programarea_payingarea_id->CellCssStyle = ""; $scholarship_payment->programarea_payingarea_id->CellCssClass = "";
		$scholarship_payment->programarea_payingarea_id->CellAttrs = array(); $scholarship_payment->programarea_payingarea_id->ViewAttrs = array(); $scholarship_payment->programarea_payingarea_id->EditAttrs = array();

		// refund_amount
		$scholarship_payment->refund_amount->CellCssStyle = ""; $scholarship_payment->refund_amount->CellCssClass = "";
		$scholarship_payment->refund_amount->CellAttrs = array(); $scholarship_payment->refund_amount->ViewAttrs = array(); $scholarship_payment->refund_amount->EditAttrs = array();

		// payment_request_payment_request_id
		$scholarship_payment->payment_request_payment_request_id->CellCssStyle = ""; $scholarship_payment->payment_request_payment_request_id->CellCssClass = "";
		$scholarship_payment->payment_request_payment_request_id->CellAttrs = array(); $scholarship_payment->payment_request_payment_request_id->ViewAttrs = array(); $scholarship_payment->payment_request_payment_request_id->EditAttrs = array();

		// bankname
		$scholarship_payment->bankname->CellCssStyle = ""; $scholarship_payment->bankname->CellCssClass = "";
		$scholarship_payment->bankname->CellAttrs = array(); $scholarship_payment->bankname->ViewAttrs = array(); $scholarship_payment->bankname->EditAttrs = array();

		// account_no
		$scholarship_payment->account_no->CellCssStyle = ""; $scholarship_payment->account_no->CellCssClass = "";
		$scholarship_payment->account_no->CellAttrs = array(); $scholarship_payment->account_no->ViewAttrs = array(); $scholarship_payment->account_no->EditAttrs = array();

		// schools_school_id
		$scholarship_payment->schools_school_id->CellCssStyle = ""; $scholarship_payment->schools_school_id->CellCssClass = "";
		$scholarship_payment->schools_school_id->CellAttrs = array(); $scholarship_payment->schools_school_id->ViewAttrs = array(); $scholarship_payment->schools_school_id->EditAttrs = array();

		// group_id
		$scholarship_payment->group_id->CellCssStyle = ""; $scholarship_payment->group_id->CellCssClass = "";
		$scholarship_payment->group_id->CellAttrs = array(); $scholarship_payment->group_id->ViewAttrs = array(); $scholarship_payment->group_id->EditAttrs = array();
		if ($scholarship_payment->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_payment_id
			$scholarship_payment->scholarship_payment_id->ViewValue = $scholarship_payment->scholarship_payment_id->CurrentValue;
			$scholarship_payment->scholarship_payment_id->CssStyle = "";
			$scholarship_payment->scholarship_payment_id->CssClass = "";
			$scholarship_payment->scholarship_payment_id->ViewCustomAttributes = "";

			// date
			$scholarship_payment->date->ViewValue = $scholarship_payment->date->CurrentValue;
			$scholarship_payment->date->ViewValue = ew_FormatDateTime($scholarship_payment->date->ViewValue, 7);
			$scholarship_payment->date->CssStyle = "";
			$scholarship_payment->date->CssClass = "";
			$scholarship_payment->date->ViewCustomAttributes = "";

			// status
			if (strval($scholarship_payment->status->CurrentValue) <> "") {
				switch ($scholarship_payment->status->CurrentValue) {
					case "PENDING":
						$scholarship_payment->status->ViewValue = "PENDING";
						break;
					case "PAID":
						$scholarship_payment->status->ViewValue = "PAID";
						break;
					default:
						$scholarship_payment->status->ViewValue = $scholarship_payment->status->CurrentValue;
				}
			} else {
				$scholarship_payment->status->ViewValue = NULL;
			}
			$scholarship_payment->status->CssStyle = "";
			$scholarship_payment->status->CssClass = "";
			$scholarship_payment->status->ViewCustomAttributes = "";

			// amount
			$scholarship_payment->amount->ViewValue = $scholarship_payment->amount->CurrentValue;
			$scholarship_payment->amount->CssStyle = "";
			$scholarship_payment->amount->CssClass = "";
			$scholarship_payment->amount->ViewCustomAttributes = "";

			// memo
			$scholarship_payment->memo->ViewValue = $scholarship_payment->memo->CurrentValue;
			$scholarship_payment->memo->CssStyle = "";
			$scholarship_payment->memo->CssClass = "";
			$scholarship_payment->memo->ViewCustomAttributes = "";

			// year
			$scholarship_payment->year->ViewValue = $scholarship_payment->year->CurrentValue;
			$scholarship_payment->year->CssStyle = "";
			$scholarship_payment->year->CssClass = "";
			$scholarship_payment->year->ViewCustomAttributes = "";

			// scholarship_package_scholarship_package_id
			if (strval($scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_package_id` = " . ew_AdjustSql($scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `annual_amount` FROM `scholarship_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->scholarship_package_scholarship_package_id->ViewValue = $rswrk->fields('annual_amount');
					$rswrk->Close();
				} else {
					$scholarship_payment->scholarship_package_scholarship_package_id->ViewValue = $scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue;
				}
			} else {
				$scholarship_payment->scholarship_package_scholarship_package_id->ViewValue = NULL;
			}
			$scholarship_payment->scholarship_package_scholarship_package_id->CssStyle = "";
			$scholarship_payment->scholarship_package_scholarship_package_id->CssClass = "";
			$scholarship_payment->scholarship_package_scholarship_package_id->ViewCustomAttributes = "";

			// programarea_residentarea_id
			if (strval($scholarship_payment->programarea_residentarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($scholarship_payment->programarea_residentarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->programarea_residentarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$scholarship_payment->programarea_residentarea_id->ViewValue = $scholarship_payment->programarea_residentarea_id->CurrentValue;
				}
			} else {
				$scholarship_payment->programarea_residentarea_id->ViewValue = NULL;
			}
			$scholarship_payment->programarea_residentarea_id->CssStyle = "";
			$scholarship_payment->programarea_residentarea_id->CssClass = "";
			$scholarship_payment->programarea_residentarea_id->ViewCustomAttributes = "";

			// programarea_payingarea_id
			if (strval($scholarship_payment->programarea_payingarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($scholarship_payment->programarea_payingarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->programarea_payingarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$scholarship_payment->programarea_payingarea_id->ViewValue = $scholarship_payment->programarea_payingarea_id->CurrentValue;
				}
			} else {
				$scholarship_payment->programarea_payingarea_id->ViewValue = NULL;
			}
			$scholarship_payment->programarea_payingarea_id->CssStyle = "";
			$scholarship_payment->programarea_payingarea_id->CssClass = "";
			$scholarship_payment->programarea_payingarea_id->ViewCustomAttributes = "";

			// refund_amount
			$scholarship_payment->refund_amount->ViewValue = $scholarship_payment->refund_amount->CurrentValue;
			$scholarship_payment->refund_amount->CssStyle = "";
			$scholarship_payment->refund_amount->CssClass = "";
			$scholarship_payment->refund_amount->ViewCustomAttributes = "";

			// payment_request_payment_request_id
			if (strval($scholarship_payment->payment_request_payment_request_id->CurrentValue) <> "") {
				$sFilterWrk = "`payment_request_id` = " . ew_AdjustSql($scholarship_payment->payment_request_payment_request_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `code` FROM `payment_request`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->payment_request_payment_request_id->ViewValue = $rswrk->fields('code');
					$rswrk->Close();
				} else {
					$scholarship_payment->payment_request_payment_request_id->ViewValue = $scholarship_payment->payment_request_payment_request_id->CurrentValue;
				}
			} else {
				$scholarship_payment->payment_request_payment_request_id->ViewValue = NULL;
			}
			$scholarship_payment->payment_request_payment_request_id->CssStyle = "";
			$scholarship_payment->payment_request_payment_request_id->CssClass = "";
			$scholarship_payment->payment_request_payment_request_id->ViewCustomAttributes = "";

			// bankname
			$scholarship_payment->bankname->ViewValue = $scholarship_payment->bankname->CurrentValue;
			$scholarship_payment->bankname->CssStyle = "";
			$scholarship_payment->bankname->CssClass = "";
			$scholarship_payment->bankname->ViewCustomAttributes = "";

			// account_no
			$scholarship_payment->account_no->ViewValue = $scholarship_payment->account_no->CurrentValue;
			$scholarship_payment->account_no->CssStyle = "";
			$scholarship_payment->account_no->CssClass = "";
			$scholarship_payment->account_no->ViewCustomAttributes = "";

			// schools_school_id
			$scholarship_payment->schools_school_id->ViewValue = $scholarship_payment->schools_school_id->CurrentValue;
			if (strval($scholarship_payment->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($scholarship_payment->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$scholarship_payment->schools_school_id->ViewValue = $scholarship_payment->schools_school_id->CurrentValue;
				}
			} else {
				$scholarship_payment->schools_school_id->ViewValue = NULL;
			}
			$scholarship_payment->schools_school_id->CssStyle = "";
			$scholarship_payment->schools_school_id->CssClass = "";
			$scholarship_payment->schools_school_id->ViewCustomAttributes = "";

			// group_id
			$scholarship_payment->group_id->ViewValue = $scholarship_payment->group_id->CurrentValue;
			$scholarship_payment->group_id->CssStyle = "";
			$scholarship_payment->group_id->CssClass = "";
			$scholarship_payment->group_id->ViewCustomAttributes = "";

			// scholarship_payment_id
			$scholarship_payment->scholarship_payment_id->HrefValue = "";
			$scholarship_payment->scholarship_payment_id->TooltipValue = "";

			// date
			$scholarship_payment->date->HrefValue = "";
			$scholarship_payment->date->TooltipValue = "";

			// status
			$scholarship_payment->status->HrefValue = "";
			$scholarship_payment->status->TooltipValue = "";

			// amount
			$scholarship_payment->amount->HrefValue = "";
			$scholarship_payment->amount->TooltipValue = "";

			// memo
			$scholarship_payment->memo->HrefValue = "";
			$scholarship_payment->memo->TooltipValue = "";

			// year
			$scholarship_payment->year->HrefValue = "";
			$scholarship_payment->year->TooltipValue = "";

			// scholarship_package_scholarship_package_id
			$scholarship_payment->scholarship_package_scholarship_package_id->HrefValue = "";
			$scholarship_payment->scholarship_package_scholarship_package_id->TooltipValue = "";

			// programarea_residentarea_id
			$scholarship_payment->programarea_residentarea_id->HrefValue = "";
			$scholarship_payment->programarea_residentarea_id->TooltipValue = "";

			// programarea_payingarea_id
			$scholarship_payment->programarea_payingarea_id->HrefValue = "";
			$scholarship_payment->programarea_payingarea_id->TooltipValue = "";

			// refund_amount
			$scholarship_payment->refund_amount->HrefValue = "";
			$scholarship_payment->refund_amount->TooltipValue = "";

			// payment_request_payment_request_id
			$scholarship_payment->payment_request_payment_request_id->HrefValue = "";
			$scholarship_payment->payment_request_payment_request_id->TooltipValue = "";

			// bankname
			$scholarship_payment->bankname->HrefValue = "";
			$scholarship_payment->bankname->TooltipValue = "";

			// account_no
			$scholarship_payment->account_no->HrefValue = "";
			$scholarship_payment->account_no->TooltipValue = "";

			// schools_school_id
			$scholarship_payment->schools_school_id->HrefValue = "";
			$scholarship_payment->schools_school_id->TooltipValue = "";

			// group_id
			$scholarship_payment->group_id->HrefValue = "";
			$scholarship_payment->group_id->TooltipValue = "";
		} elseif ($scholarship_payment->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// scholarship_payment_id
			$scholarship_payment->scholarship_payment_id->EditCustomAttributes = "";
			$scholarship_payment->scholarship_payment_id->EditValue = $scholarship_payment->scholarship_payment_id->CurrentValue;
			$scholarship_payment->scholarship_payment_id->CssStyle = "";
			$scholarship_payment->scholarship_payment_id->CssClass = "";
			$scholarship_payment->scholarship_payment_id->ViewCustomAttributes = "";

			// date
			$scholarship_payment->date->EditCustomAttributes = "";
			$scholarship_payment->date->EditValue = $scholarship_payment->date->CurrentValue;
			$scholarship_payment->date->EditValue = ew_FormatDateTime($scholarship_payment->date->EditValue, 7);
			$scholarship_payment->date->CssStyle = "";
			$scholarship_payment->date->CssClass = "";
			$scholarship_payment->date->ViewCustomAttributes = "";

			// status
			$scholarship_payment->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("PENDING", "PENDING");
			$arwrk[] = array("PAID", "PAID");
			$scholarship_payment->status->EditValue = $arwrk;

			// amount
			$scholarship_payment->amount->EditCustomAttributes = "";
			$scholarship_payment->amount->EditValue = $scholarship_payment->amount->CurrentValue;
			$scholarship_payment->amount->CssStyle = "";
			$scholarship_payment->amount->CssClass = "";
			$scholarship_payment->amount->ViewCustomAttributes = "";

			// memo
			$scholarship_payment->memo->EditCustomAttributes = "";
			$scholarship_payment->memo->EditValue = $scholarship_payment->memo->CurrentValue;
			$scholarship_payment->memo->CssStyle = "";
			$scholarship_payment->memo->CssClass = "";
			$scholarship_payment->memo->ViewCustomAttributes = "";

			// year
			$scholarship_payment->year->EditCustomAttributes = "";
			$scholarship_payment->year->EditValue = $scholarship_payment->year->CurrentValue;
			$scholarship_payment->year->CssStyle = "";
			$scholarship_payment->year->CssClass = "";
			$scholarship_payment->year->ViewCustomAttributes = "";

			// scholarship_package_scholarship_package_id
			$scholarship_payment->scholarship_package_scholarship_package_id->EditCustomAttributes = "";
			if (strval($scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_package_id` = " . ew_AdjustSql($scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `annual_amount` FROM `scholarship_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->scholarship_package_scholarship_package_id->EditValue = $rswrk->fields('annual_amount');
					$rswrk->Close();
				} else {
					$scholarship_payment->scholarship_package_scholarship_package_id->EditValue = $scholarship_payment->scholarship_package_scholarship_package_id->CurrentValue;
				}
			} else {
				$scholarship_payment->scholarship_package_scholarship_package_id->EditValue = NULL;
			}
			$scholarship_payment->scholarship_package_scholarship_package_id->CssStyle = "";
			$scholarship_payment->scholarship_package_scholarship_package_id->CssClass = "";
			$scholarship_payment->scholarship_package_scholarship_package_id->ViewCustomAttributes = "";

			// programarea_residentarea_id
			$scholarship_payment->programarea_residentarea_id->EditCustomAttributes = "";
			if (strval($scholarship_payment->programarea_residentarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($scholarship_payment->programarea_residentarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->programarea_residentarea_id->EditValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$scholarship_payment->programarea_residentarea_id->EditValue = $scholarship_payment->programarea_residentarea_id->CurrentValue;
				}
			} else {
				$scholarship_payment->programarea_residentarea_id->EditValue = NULL;
			}
			$scholarship_payment->programarea_residentarea_id->CssStyle = "";
			$scholarship_payment->programarea_residentarea_id->CssClass = "";
			$scholarship_payment->programarea_residentarea_id->ViewCustomAttributes = "";

			// programarea_payingarea_id
			$scholarship_payment->programarea_payingarea_id->EditCustomAttributes = "";
			if (strval($scholarship_payment->programarea_payingarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($scholarship_payment->programarea_payingarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->programarea_payingarea_id->EditValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$scholarship_payment->programarea_payingarea_id->EditValue = $scholarship_payment->programarea_payingarea_id->CurrentValue;
				}
			} else {
				$scholarship_payment->programarea_payingarea_id->EditValue = NULL;
			}
			$scholarship_payment->programarea_payingarea_id->CssStyle = "";
			$scholarship_payment->programarea_payingarea_id->CssClass = "";
			$scholarship_payment->programarea_payingarea_id->ViewCustomAttributes = "";

			// refund_amount
			$scholarship_payment->refund_amount->EditCustomAttributes = "";
			$scholarship_payment->refund_amount->EditValue = ew_HtmlEncode($scholarship_payment->refund_amount->CurrentValue);

			// payment_request_payment_request_id
			$scholarship_payment->payment_request_payment_request_id->EditCustomAttributes = "";
			if (strval($scholarship_payment->payment_request_payment_request_id->CurrentValue) <> "") {
				$sFilterWrk = "`payment_request_id` = " . ew_AdjustSql($scholarship_payment->payment_request_payment_request_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `code` FROM `payment_request`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->payment_request_payment_request_id->EditValue = $rswrk->fields('code');
					$rswrk->Close();
				} else {
					$scholarship_payment->payment_request_payment_request_id->EditValue = $scholarship_payment->payment_request_payment_request_id->CurrentValue;
				}
			} else {
				$scholarship_payment->payment_request_payment_request_id->EditValue = NULL;
			}
			$scholarship_payment->payment_request_payment_request_id->CssStyle = "";
			$scholarship_payment->payment_request_payment_request_id->CssClass = "";
			$scholarship_payment->payment_request_payment_request_id->ViewCustomAttributes = "";

			// bankname
			$scholarship_payment->bankname->EditCustomAttributes = "";
			$scholarship_payment->bankname->EditValue = ew_HtmlEncode($scholarship_payment->bankname->CurrentValue);

			// account_no
			$scholarship_payment->account_no->EditCustomAttributes = "";
			$scholarship_payment->account_no->EditValue = ew_HtmlEncode($scholarship_payment->account_no->CurrentValue);

			// schools_school_id
			$scholarship_payment->schools_school_id->EditCustomAttributes = "";
			$scholarship_payment->schools_school_id->EditValue = ew_HtmlEncode($scholarship_payment->schools_school_id->CurrentValue);
			if (strval($scholarship_payment->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($scholarship_payment->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$scholarship_payment->schools_school_id->EditValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$scholarship_payment->schools_school_id->EditValue = $scholarship_payment->schools_school_id->CurrentValue;
				}
			} else {
				$scholarship_payment->schools_school_id->EditValue = NULL;
			}

			// group_id
			$scholarship_payment->group_id->EditCustomAttributes = "";
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
			$scholarship_payment->group_id->EditValue = $arwrk;
			} else {
			$scholarship_payment->group_id->EditValue = ew_HtmlEncode($scholarship_payment->group_id->CurrentValue);
			}

			// Edit refer script
			// scholarship_payment_id

			$scholarship_payment->scholarship_payment_id->HrefValue = "";

			// date
			$scholarship_payment->date->HrefValue = "";

			// status
			$scholarship_payment->status->HrefValue = "";

			// amount
			$scholarship_payment->amount->HrefValue = "";

			// memo
			$scholarship_payment->memo->HrefValue = "";

			// year
			$scholarship_payment->year->HrefValue = "";

			// scholarship_package_scholarship_package_id
			$scholarship_payment->scholarship_package_scholarship_package_id->HrefValue = "";

			// programarea_residentarea_id
			$scholarship_payment->programarea_residentarea_id->HrefValue = "";

			// programarea_payingarea_id
			$scholarship_payment->programarea_payingarea_id->HrefValue = "";

			// refund_amount
			$scholarship_payment->refund_amount->HrefValue = "";

			// payment_request_payment_request_id
			$scholarship_payment->payment_request_payment_request_id->HrefValue = "";

			// bankname
			$scholarship_payment->bankname->HrefValue = "";

			// account_no
			$scholarship_payment->account_no->HrefValue = "";

			// schools_school_id
			$scholarship_payment->schools_school_id->HrefValue = "";

			// group_id
			$scholarship_payment->group_id->HrefValue = "";
		}

		// Call Row Rendered event
		if ($scholarship_payment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$scholarship_payment->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $scholarship_payment;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckNumber($scholarship_payment->refund_amount->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $scholarship_payment->refund_amount->FldErrMsg();
		}
		if (!ew_CheckInteger($scholarship_payment->schools_school_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $scholarship_payment->schools_school_id->FldErrMsg();
		}
		if (!ew_CheckInteger($scholarship_payment->group_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $scholarship_payment->group_id->FldErrMsg();
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
		global $conn, $Security, $Language, $scholarship_payment;
		$sFilter = $scholarship_payment->KeyFilter();
		$scholarship_payment->CurrentFilter = $sFilter;
		$sSql = $scholarship_payment->SQL();
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

			// status
			$scholarship_payment->status->SetDbValueDef($rsnew, $scholarship_payment->status->CurrentValue, NULL, FALSE);

			// refund_amount
			$scholarship_payment->refund_amount->SetDbValueDef($rsnew, $scholarship_payment->refund_amount->CurrentValue, NULL, FALSE);

			// bankname
			$scholarship_payment->bankname->SetDbValueDef($rsnew, $scholarship_payment->bankname->CurrentValue, NULL, FALSE);

			// account_no
			$scholarship_payment->account_no->SetDbValueDef($rsnew, $scholarship_payment->account_no->CurrentValue, NULL, FALSE);

			// schools_school_id
			$scholarship_payment->schools_school_id->SetDbValueDef($rsnew, $scholarship_payment->schools_school_id->CurrentValue, NULL, FALSE);

			// group_id
			$scholarship_payment->group_id->SetDbValueDef($rsnew, $scholarship_payment->group_id->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $scholarship_payment->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($scholarship_payment->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($scholarship_payment->CancelMessage <> "") {
					$this->setMessage($scholarship_payment->CancelMessage);
					$scholarship_payment->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$scholarship_payment->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $scholarship_payment;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "scholarship_package") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $scholarship_payment->SqlMasterFilter_scholarship_package();
				$this->sDbDetailFilter = $scholarship_payment->SqlDetailFilter_scholarship_package();
				if (@$_GET["scholarship_package_id"] <> "") {
					$GLOBALS["scholarship_package"]->scholarship_package_id->setQueryStringValue($_GET["scholarship_package_id"]);
					$scholarship_payment->scholarship_package_scholarship_package_id->setQueryStringValue($GLOBALS["scholarship_package"]->scholarship_package_id->QueryStringValue);
					$scholarship_payment->scholarship_package_scholarship_package_id->setSessionValue($scholarship_payment->scholarship_package_scholarship_package_id->QueryStringValue);
					if (!is_numeric($GLOBALS["scholarship_package"]->scholarship_package_id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@scholarship_package_id@", ew_AdjustSql($GLOBALS["scholarship_package"]->scholarship_package_id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@scholarship_package_scholarship_package_id@", ew_AdjustSql($GLOBALS["scholarship_package"]->scholarship_package_id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$scholarship_payment->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$scholarship_payment->setStartRecordNumber($this->lStartRec);
			$scholarship_payment->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$scholarship_payment->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "scholarship_package") {
				if ($scholarship_payment->scholarship_package_scholarship_package_id->QueryStringValue == "") $scholarship_payment->scholarship_package_scholarship_package_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $scholarship_payment->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $scholarship_payment->getDetailFilter(); // Restore detail filter
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'scholarship_payment';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $scholarship_payment;
		$table = 'scholarship_payment';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['scholarship_payment_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if ($scholarship_payment->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($scholarship_payment->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($scholarship_payment->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} elseif ($scholarship_payment->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
