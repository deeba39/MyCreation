<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "Payment_Refundinfo.php" ?>
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
$Payment_Refund_edit = new cPayment_Refund_edit();
$Page =& $Payment_Refund_edit;

// Page init
$Payment_Refund_edit->Page_Init();

// Page main
$Payment_Refund_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var Payment_Refund_edit = new ew_Page("Payment_Refund_edit");

// page properties
Payment_Refund_edit.PageID = "edit"; // page ID
Payment_Refund_edit.FormID = "fPayment_Refundedit"; // form ID
var EW_PAGE_ID = Payment_Refund_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
Payment_Refund_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Payment_Refund->date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_refund_amount"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Payment_Refund->refund_amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_amount"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Payment_Refund->amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Payment_Refund->year->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
Payment_Refund_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
Payment_Refund_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Payment_Refund_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $Payment_Refund->TableCaption() ?><br><br>
<a href="<?php echo $Payment_Refund->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$Payment_Refund_edit->ShowMessage();
?>
<form name="fPayment_Refundedit" id="fPayment_Refundedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return Payment_Refund_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="Payment_Refund">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($Payment_Refund->scholarship_payment_id->Visible) { // scholarship_payment_id ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->scholarship_payment_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->scholarship_payment_id->CellAttributes() ?>><span id="el_scholarship_payment_id">
<div<?php echo $Payment_Refund->scholarship_payment_id->ViewAttributes() ?>><?php echo $Payment_Refund->scholarship_payment_id->EditValue ?></div><input type="hidden" name="x_scholarship_payment_id" id="x_scholarship_payment_id" value="<?php echo ew_HtmlEncode($Payment_Refund->scholarship_payment_id->CurrentValue) ?>">
</span><?php echo $Payment_Refund->scholarship_payment_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->date->Visible) { // date ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->date->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->date->CellAttributes() ?>><span id="el_date">
<input type="text" name="x_date" id="x_date" title="<?php echo $Payment_Refund->date->FldTitle() ?>" value="<?php echo $Payment_Refund->date->EditValue ?>"<?php echo $Payment_Refund->date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_date" name="cal_x_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_date" // button id
});
</script>
</span><?php echo $Payment_Refund->date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->status->Visible) { // status ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->status->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $Payment_Refund->status->FldTitle() ?>" value="{value}"<?php echo $Payment_Refund->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $Payment_Refund->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Payment_Refund->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $Payment_Refund->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $Payment_Refund->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $Payment_Refund->status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->refund_amount->Visible) { // refund_amount ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->refund_amount->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->refund_amount->CellAttributes() ?>><span id="el_refund_amount">
<input type="text" name="x_refund_amount" id="x_refund_amount" title="<?php echo $Payment_Refund->refund_amount->FldTitle() ?>" size="30" value="<?php echo $Payment_Refund->refund_amount->EditValue ?>"<?php echo $Payment_Refund->refund_amount->EditAttributes() ?>>
</span><?php echo $Payment_Refund->refund_amount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->amount->Visible) { // amount ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->amount->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->amount->CellAttributes() ?>><span id="el_amount">
<input type="text" name="x_amount" id="x_amount" title="<?php echo $Payment_Refund->amount->FldTitle() ?>" size="30" value="<?php echo $Payment_Refund->amount->EditValue ?>"<?php echo $Payment_Refund->amount->EditAttributes() ?>>
</span><?php echo $Payment_Refund->amount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->memo->Visible) { // memo ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->memo->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->memo->CellAttributes() ?>><span id="el_memo">
<textarea name="x_memo" id="x_memo" title="<?php echo $Payment_Refund->memo->FldTitle() ?>" cols="35" rows="4"<?php echo $Payment_Refund->memo->EditAttributes() ?>><?php echo $Payment_Refund->memo->EditValue ?></textarea>
</span><?php echo $Payment_Refund->memo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->year->Visible) { // year ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->year->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->year->CellAttributes() ?>><span id="el_year">
<input type="text" name="x_year" id="x_year" title="<?php echo $Payment_Refund->year->FldTitle() ?>" size="30" value="<?php echo $Payment_Refund->year->EditValue ?>"<?php echo $Payment_Refund->year->EditAttributes() ?>>
</span><?php echo $Payment_Refund->year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->scholarship_package_scholarship_package_id->Visible) { // scholarship_package_scholarship_package_id ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->scholarship_package_scholarship_package_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->scholarship_package_scholarship_package_id->CellAttributes() ?>><span id="el_scholarship_package_scholarship_package_id">
<select id="x_scholarship_package_scholarship_package_id" name="x_scholarship_package_scholarship_package_id" title="<?php echo $Payment_Refund->scholarship_package_scholarship_package_id->FldTitle() ?>"<?php echo $Payment_Refund->scholarship_package_scholarship_package_id->EditAttributes() ?>>
<?php
if (is_array($Payment_Refund->scholarship_package_scholarship_package_id->EditValue)) {
	$arwrk = $Payment_Refund->scholarship_package_scholarship_package_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $Payment_Refund->scholarship_package_scholarship_package_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->programarea_residentarea_id->Visible) { // programarea_residentarea_id ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->programarea_residentarea_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->programarea_residentarea_id->CellAttributes() ?>><span id="el_programarea_residentarea_id">
<select id="x_programarea_residentarea_id" name="x_programarea_residentarea_id" title="<?php echo $Payment_Refund->programarea_residentarea_id->FldTitle() ?>"<?php echo $Payment_Refund->programarea_residentarea_id->EditAttributes() ?>>
<?php
if (is_array($Payment_Refund->programarea_residentarea_id->EditValue)) {
	$arwrk = $Payment_Refund->programarea_residentarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Payment_Refund->programarea_residentarea_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $Payment_Refund->programarea_residentarea_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->programarea_payingarea_id->Visible) { // programarea_payingarea_id ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->programarea_payingarea_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->programarea_payingarea_id->CellAttributes() ?>><span id="el_programarea_payingarea_id">
<select id="x_programarea_payingarea_id" name="x_programarea_payingarea_id" title="<?php echo $Payment_Refund->programarea_payingarea_id->FldTitle() ?>"<?php echo $Payment_Refund->programarea_payingarea_id->EditAttributes() ?>>
<?php
if (is_array($Payment_Refund->programarea_payingarea_id->EditValue)) {
	$arwrk = $Payment_Refund->programarea_payingarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Payment_Refund->programarea_payingarea_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $Payment_Refund->programarea_payingarea_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->payment_request_payment_request_id->Visible) { // payment_request_payment_request_id ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->payment_request_payment_request_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->payment_request_payment_request_id->CellAttributes() ?>><span id="el_payment_request_payment_request_id">
<select id="x_payment_request_payment_request_id" name="x_payment_request_payment_request_id" title="<?php echo $Payment_Refund->payment_request_payment_request_id->FldTitle() ?>"<?php echo $Payment_Refund->payment_request_payment_request_id->EditAttributes() ?>>
<?php
if (is_array($Payment_Refund->payment_request_payment_request_id->EditValue)) {
	$arwrk = $Payment_Refund->payment_request_payment_request_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Payment_Refund->payment_request_payment_request_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $Payment_Refund->payment_request_payment_request_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->bankname->Visible) { // bankname ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->bankname->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->bankname->CellAttributes() ?>><span id="el_bankname">
<input type="text" name="x_bankname" id="x_bankname" title="<?php echo $Payment_Refund->bankname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $Payment_Refund->bankname->EditValue ?>"<?php echo $Payment_Refund->bankname->EditAttributes() ?>>
</span><?php echo $Payment_Refund->bankname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->account_no->Visible) { // account_no ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->account_no->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->account_no->CellAttributes() ?>><span id="el_account_no">
<input type="text" name="x_account_no" id="x_account_no" title="<?php echo $Payment_Refund->account_no->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $Payment_Refund->account_no->EditValue ?>"<?php echo $Payment_Refund->account_no->EditAttributes() ?>>
</span><?php echo $Payment_Refund->account_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($Payment_Refund->schools_school_id->Visible) { // schools_school_id ?>
	<tr<?php echo $Payment_Refund->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Payment_Refund->schools_school_id->FldCaption() ?></td>
		<td<?php echo $Payment_Refund->schools_school_id->CellAttributes() ?>><span id="el_schools_school_id">
<select id="x_schools_school_id" name="x_schools_school_id" title="<?php echo $Payment_Refund->schools_school_id->FldTitle() ?>"<?php echo $Payment_Refund->schools_school_id->EditAttributes() ?>>
<?php
if (is_array($Payment_Refund->schools_school_id->EditValue)) {
	$arwrk = $Payment_Refund->schools_school_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Payment_Refund->schools_school_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $Payment_Refund->schools_school_id->CustomMsg ?></td>
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
$Payment_Refund_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cPayment_Refund_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'Payment Refund';

	// Page object name
	var $PageObjName = 'Payment_Refund_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $Payment_Refund;
		if ($Payment_Refund->UseTokenInUrl) $PageUrl .= "t=" . $Payment_Refund->TableVar . "&"; // Add page token
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
		global $objForm, $Payment_Refund;
		if ($Payment_Refund->UseTokenInUrl) {
			if ($objForm)
				return ($Payment_Refund->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($Payment_Refund->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cPayment_Refund_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Payment_Refund)
		$GLOBALS["Payment_Refund"] = new cPayment_Refund();

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
			define("EW_TABLE_NAME", 'Payment Refund', TRUE);

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
		global $Payment_Refund;

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
			$this->Page_Terminate("Payment_Refundlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("Payment_Refundlist.php");
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
		global $objForm, $Language, $gsFormError, $Payment_Refund;

		// Load key from QueryString
		if (@$_GET["scholarship_payment_id"] <> "")
			$Payment_Refund->scholarship_payment_id->setQueryStringValue($_GET["scholarship_payment_id"]);
		if (@$_POST["a_edit"] <> "") {
			$Payment_Refund->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$Payment_Refund->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$Payment_Refund->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$Payment_Refund->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($Payment_Refund->scholarship_payment_id->CurrentValue == "")
			$this->Page_Terminate("Payment_Refundlist.php"); // Invalid key, return to list
		switch ($Payment_Refund->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("Payment_Refundlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$Payment_Refund->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $Payment_Refund->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$Payment_Refund->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$Payment_Refund->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Payment_Refund;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $Payment_Refund;
		$Payment_Refund->scholarship_payment_id->setFormValue($objForm->GetValue("x_scholarship_payment_id"));
		$Payment_Refund->date->setFormValue($objForm->GetValue("x_date"));
		$Payment_Refund->date->CurrentValue = ew_UnFormatDateTime($Payment_Refund->date->CurrentValue, 7);
		$Payment_Refund->status->setFormValue($objForm->GetValue("x_status"));
		$Payment_Refund->refund_amount->setFormValue($objForm->GetValue("x_refund_amount"));
		$Payment_Refund->amount->setFormValue($objForm->GetValue("x_amount"));
		$Payment_Refund->memo->setFormValue($objForm->GetValue("x_memo"));
		$Payment_Refund->year->setFormValue($objForm->GetValue("x_year"));
		$Payment_Refund->scholarship_package_scholarship_package_id->setFormValue($objForm->GetValue("x_scholarship_package_scholarship_package_id"));
		$Payment_Refund->programarea_residentarea_id->setFormValue($objForm->GetValue("x_programarea_residentarea_id"));
		$Payment_Refund->programarea_payingarea_id->setFormValue($objForm->GetValue("x_programarea_payingarea_id"));
		$Payment_Refund->payment_request_payment_request_id->setFormValue($objForm->GetValue("x_payment_request_payment_request_id"));
		$Payment_Refund->bankname->setFormValue($objForm->GetValue("x_bankname"));
		$Payment_Refund->account_no->setFormValue($objForm->GetValue("x_account_no"));
		$Payment_Refund->schools_school_id->setFormValue($objForm->GetValue("x_schools_school_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $Payment_Refund;
		$this->LoadRow();
		$Payment_Refund->scholarship_payment_id->CurrentValue = $Payment_Refund->scholarship_payment_id->FormValue;
		$Payment_Refund->date->CurrentValue = $Payment_Refund->date->FormValue;
		$Payment_Refund->date->CurrentValue = ew_UnFormatDateTime($Payment_Refund->date->CurrentValue, 7);
		$Payment_Refund->status->CurrentValue = $Payment_Refund->status->FormValue;
		$Payment_Refund->refund_amount->CurrentValue = $Payment_Refund->refund_amount->FormValue;
		$Payment_Refund->amount->CurrentValue = $Payment_Refund->amount->FormValue;
		$Payment_Refund->memo->CurrentValue = $Payment_Refund->memo->FormValue;
		$Payment_Refund->year->CurrentValue = $Payment_Refund->year->FormValue;
		$Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue = $Payment_Refund->scholarship_package_scholarship_package_id->FormValue;
		$Payment_Refund->programarea_residentarea_id->CurrentValue = $Payment_Refund->programarea_residentarea_id->FormValue;
		$Payment_Refund->programarea_payingarea_id->CurrentValue = $Payment_Refund->programarea_payingarea_id->FormValue;
		$Payment_Refund->payment_request_payment_request_id->CurrentValue = $Payment_Refund->payment_request_payment_request_id->FormValue;
		$Payment_Refund->bankname->CurrentValue = $Payment_Refund->bankname->FormValue;
		$Payment_Refund->account_no->CurrentValue = $Payment_Refund->account_no->FormValue;
		$Payment_Refund->schools_school_id->CurrentValue = $Payment_Refund->schools_school_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Payment_Refund;
		$sFilter = $Payment_Refund->KeyFilter();

		// Call Row Selecting event
		$Payment_Refund->Row_Selecting($sFilter);

		// Load SQL based on filter
		$Payment_Refund->CurrentFilter = $sFilter;
		$sSql = $Payment_Refund->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$Payment_Refund->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $Payment_Refund;
		$Payment_Refund->scholarship_payment_id->setDbValue($rs->fields('scholarship_payment_id'));
		$Payment_Refund->date->setDbValue($rs->fields('date'));
		$Payment_Refund->status->setDbValue($rs->fields('status'));
		$Payment_Refund->refund_amount->setDbValue($rs->fields('refund_amount'));
		$Payment_Refund->amount->setDbValue($rs->fields('amount'));
		$Payment_Refund->memo->setDbValue($rs->fields('memo'));
		$Payment_Refund->year->setDbValue($rs->fields('year'));
		$Payment_Refund->scholarship_package_scholarship_package_id->setDbValue($rs->fields('scholarship_package_scholarship_package_id'));
		$Payment_Refund->programarea_residentarea_id->setDbValue($rs->fields('programarea_residentarea_id'));
		$Payment_Refund->programarea_payingarea_id->setDbValue($rs->fields('programarea_payingarea_id'));
		$Payment_Refund->payment_request_payment_request_id->setDbValue($rs->fields('payment_request_payment_request_id'));
		$Payment_Refund->bankname->setDbValue($rs->fields('bankname'));
		$Payment_Refund->account_no->setDbValue($rs->fields('account_no'));
		$Payment_Refund->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$Payment_Refund->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Payment_Refund;

		// Initialize URLs
		// Call Row_Rendering event

		$Payment_Refund->Row_Rendering();

		// Common render codes for all row types
		// scholarship_payment_id

		$Payment_Refund->scholarship_payment_id->CellCssStyle = ""; $Payment_Refund->scholarship_payment_id->CellCssClass = "";
		$Payment_Refund->scholarship_payment_id->CellAttrs = array(); $Payment_Refund->scholarship_payment_id->ViewAttrs = array(); $Payment_Refund->scholarship_payment_id->EditAttrs = array();

		// date
		$Payment_Refund->date->CellCssStyle = ""; $Payment_Refund->date->CellCssClass = "";
		$Payment_Refund->date->CellAttrs = array(); $Payment_Refund->date->ViewAttrs = array(); $Payment_Refund->date->EditAttrs = array();

		// status
		$Payment_Refund->status->CellCssStyle = ""; $Payment_Refund->status->CellCssClass = "";
		$Payment_Refund->status->CellAttrs = array(); $Payment_Refund->status->ViewAttrs = array(); $Payment_Refund->status->EditAttrs = array();

		// refund_amount
		$Payment_Refund->refund_amount->CellCssStyle = ""; $Payment_Refund->refund_amount->CellCssClass = "";
		$Payment_Refund->refund_amount->CellAttrs = array(); $Payment_Refund->refund_amount->ViewAttrs = array(); $Payment_Refund->refund_amount->EditAttrs = array();

		// amount
		$Payment_Refund->amount->CellCssStyle = ""; $Payment_Refund->amount->CellCssClass = "";
		$Payment_Refund->amount->CellAttrs = array(); $Payment_Refund->amount->ViewAttrs = array(); $Payment_Refund->amount->EditAttrs = array();

		// memo
		$Payment_Refund->memo->CellCssStyle = ""; $Payment_Refund->memo->CellCssClass = "";
		$Payment_Refund->memo->CellAttrs = array(); $Payment_Refund->memo->ViewAttrs = array(); $Payment_Refund->memo->EditAttrs = array();

		// year
		$Payment_Refund->year->CellCssStyle = ""; $Payment_Refund->year->CellCssClass = "";
		$Payment_Refund->year->CellAttrs = array(); $Payment_Refund->year->ViewAttrs = array(); $Payment_Refund->year->EditAttrs = array();

		// scholarship_package_scholarship_package_id
		$Payment_Refund->scholarship_package_scholarship_package_id->CellCssStyle = ""; $Payment_Refund->scholarship_package_scholarship_package_id->CellCssClass = "";
		$Payment_Refund->scholarship_package_scholarship_package_id->CellAttrs = array(); $Payment_Refund->scholarship_package_scholarship_package_id->ViewAttrs = array(); $Payment_Refund->scholarship_package_scholarship_package_id->EditAttrs = array();

		// programarea_residentarea_id
		$Payment_Refund->programarea_residentarea_id->CellCssStyle = ""; $Payment_Refund->programarea_residentarea_id->CellCssClass = "";
		$Payment_Refund->programarea_residentarea_id->CellAttrs = array(); $Payment_Refund->programarea_residentarea_id->ViewAttrs = array(); $Payment_Refund->programarea_residentarea_id->EditAttrs = array();

		// programarea_payingarea_id
		$Payment_Refund->programarea_payingarea_id->CellCssStyle = ""; $Payment_Refund->programarea_payingarea_id->CellCssClass = "";
		$Payment_Refund->programarea_payingarea_id->CellAttrs = array(); $Payment_Refund->programarea_payingarea_id->ViewAttrs = array(); $Payment_Refund->programarea_payingarea_id->EditAttrs = array();

		// payment_request_payment_request_id
		$Payment_Refund->payment_request_payment_request_id->CellCssStyle = ""; $Payment_Refund->payment_request_payment_request_id->CellCssClass = "";
		$Payment_Refund->payment_request_payment_request_id->CellAttrs = array(); $Payment_Refund->payment_request_payment_request_id->ViewAttrs = array(); $Payment_Refund->payment_request_payment_request_id->EditAttrs = array();

		// bankname
		$Payment_Refund->bankname->CellCssStyle = ""; $Payment_Refund->bankname->CellCssClass = "";
		$Payment_Refund->bankname->CellAttrs = array(); $Payment_Refund->bankname->ViewAttrs = array(); $Payment_Refund->bankname->EditAttrs = array();

		// account_no
		$Payment_Refund->account_no->CellCssStyle = ""; $Payment_Refund->account_no->CellCssClass = "";
		$Payment_Refund->account_no->CellAttrs = array(); $Payment_Refund->account_no->ViewAttrs = array(); $Payment_Refund->account_no->EditAttrs = array();

		// schools_school_id
		$Payment_Refund->schools_school_id->CellCssStyle = ""; $Payment_Refund->schools_school_id->CellCssClass = "";
		$Payment_Refund->schools_school_id->CellAttrs = array(); $Payment_Refund->schools_school_id->ViewAttrs = array(); $Payment_Refund->schools_school_id->EditAttrs = array();
		if ($Payment_Refund->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_payment_id
			$Payment_Refund->scholarship_payment_id->ViewValue = $Payment_Refund->scholarship_payment_id->CurrentValue;
			$Payment_Refund->scholarship_payment_id->CssStyle = "";
			$Payment_Refund->scholarship_payment_id->CssClass = "";
			$Payment_Refund->scholarship_payment_id->ViewCustomAttributes = "";

			// date
			$Payment_Refund->date->ViewValue = $Payment_Refund->date->CurrentValue;
			$Payment_Refund->date->ViewValue = ew_FormatDateTime($Payment_Refund->date->ViewValue, 7);
			$Payment_Refund->date->CssStyle = "";
			$Payment_Refund->date->CssClass = "";
			$Payment_Refund->date->ViewCustomAttributes = "";

			// status
			if (strval($Payment_Refund->status->CurrentValue) <> "") {
				switch ($Payment_Refund->status->CurrentValue) {
					case "PENDING":
						$Payment_Refund->status->ViewValue = "PENDING";
						break;
					case "PAID":
						$Payment_Refund->status->ViewValue = "PAID";
						break;
					default:
						$Payment_Refund->status->ViewValue = $Payment_Refund->status->CurrentValue;
				}
			} else {
				$Payment_Refund->status->ViewValue = NULL;
			}
			$Payment_Refund->status->CssStyle = "";
			$Payment_Refund->status->CssClass = "";
			$Payment_Refund->status->ViewCustomAttributes = "";

			// refund_amount
			$Payment_Refund->refund_amount->ViewValue = $Payment_Refund->refund_amount->CurrentValue;
			$Payment_Refund->refund_amount->CssStyle = "";
			$Payment_Refund->refund_amount->CssClass = "";
			$Payment_Refund->refund_amount->ViewCustomAttributes = "";

			// amount
			$Payment_Refund->amount->ViewValue = $Payment_Refund->amount->CurrentValue;
			$Payment_Refund->amount->CssStyle = "";
			$Payment_Refund->amount->CssClass = "";
			$Payment_Refund->amount->ViewCustomAttributes = "";

			// memo
			$Payment_Refund->memo->ViewValue = $Payment_Refund->memo->CurrentValue;
			$Payment_Refund->memo->CssStyle = "";
			$Payment_Refund->memo->CssClass = "";
			$Payment_Refund->memo->ViewCustomAttributes = "";

			// year
			$Payment_Refund->year->ViewValue = $Payment_Refund->year->CurrentValue;
			$Payment_Refund->year->CssStyle = "";
			$Payment_Refund->year->CssClass = "";
			$Payment_Refund->year->ViewCustomAttributes = "";

			// scholarship_package_scholarship_package_id
			if (strval($Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue) <> "") {
				$sFilterWrk = "`scholarship_package_id` = " . ew_AdjustSql($Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `scholarship_type` FROM `scholarship_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->scholarship_package_scholarship_package_id->ViewValue = $rswrk->fields('scholarship_type');
					$rswrk->Close();
				} else {
					$Payment_Refund->scholarship_package_scholarship_package_id->ViewValue = $Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue;
				}
			} else {
				$Payment_Refund->scholarship_package_scholarship_package_id->ViewValue = NULL;
			}
			$Payment_Refund->scholarship_package_scholarship_package_id->CssStyle = "";
			$Payment_Refund->scholarship_package_scholarship_package_id->CssClass = "";
			$Payment_Refund->scholarship_package_scholarship_package_id->ViewCustomAttributes = "";

			// programarea_residentarea_id
			if (strval($Payment_Refund->programarea_residentarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Payment_Refund->programarea_residentarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->programarea_residentarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Payment_Refund->programarea_residentarea_id->ViewValue = $Payment_Refund->programarea_residentarea_id->CurrentValue;
				}
			} else {
				$Payment_Refund->programarea_residentarea_id->ViewValue = NULL;
			}
			$Payment_Refund->programarea_residentarea_id->CssStyle = "";
			$Payment_Refund->programarea_residentarea_id->CssClass = "";
			$Payment_Refund->programarea_residentarea_id->ViewCustomAttributes = "";

			// programarea_payingarea_id
			if (strval($Payment_Refund->programarea_payingarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Payment_Refund->programarea_payingarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->programarea_payingarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Payment_Refund->programarea_payingarea_id->ViewValue = $Payment_Refund->programarea_payingarea_id->CurrentValue;
				}
			} else {
				$Payment_Refund->programarea_payingarea_id->ViewValue = NULL;
			}
			$Payment_Refund->programarea_payingarea_id->CssStyle = "";
			$Payment_Refund->programarea_payingarea_id->CssClass = "";
			$Payment_Refund->programarea_payingarea_id->ViewCustomAttributes = "";

			// payment_request_payment_request_id
			if (strval($Payment_Refund->payment_request_payment_request_id->CurrentValue) <> "") {
				$sFilterWrk = "`payment_request_id` = " . ew_AdjustSql($Payment_Refund->payment_request_payment_request_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `code` FROM `payment_request`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->payment_request_payment_request_id->ViewValue = $rswrk->fields('code');
					$rswrk->Close();
				} else {
					$Payment_Refund->payment_request_payment_request_id->ViewValue = $Payment_Refund->payment_request_payment_request_id->CurrentValue;
				}
			} else {
				$Payment_Refund->payment_request_payment_request_id->ViewValue = NULL;
			}
			$Payment_Refund->payment_request_payment_request_id->CssStyle = "";
			$Payment_Refund->payment_request_payment_request_id->CssClass = "";
			$Payment_Refund->payment_request_payment_request_id->ViewCustomAttributes = "";

			// bankname
			$Payment_Refund->bankname->ViewValue = $Payment_Refund->bankname->CurrentValue;
			$Payment_Refund->bankname->CssStyle = "";
			$Payment_Refund->bankname->CssClass = "";
			$Payment_Refund->bankname->ViewCustomAttributes = "";

			// account_no
			$Payment_Refund->account_no->ViewValue = $Payment_Refund->account_no->CurrentValue;
			$Payment_Refund->account_no->CssStyle = "";
			$Payment_Refund->account_no->CssClass = "";
			$Payment_Refund->account_no->ViewCustomAttributes = "";

			// schools_school_id
			if (strval($Payment_Refund->schools_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`school_id` = " . ew_AdjustSql($Payment_Refund->schools_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_name` FROM `schools`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Payment_Refund->schools_school_id->ViewValue = $rswrk->fields('school_name');
					$rswrk->Close();
				} else {
					$Payment_Refund->schools_school_id->ViewValue = $Payment_Refund->schools_school_id->CurrentValue;
				}
			} else {
				$Payment_Refund->schools_school_id->ViewValue = NULL;
			}
			$Payment_Refund->schools_school_id->CssStyle = "";
			$Payment_Refund->schools_school_id->CssClass = "";
			$Payment_Refund->schools_school_id->ViewCustomAttributes = "";

			// group_id
			$Payment_Refund->group_id->ViewValue = $Payment_Refund->group_id->CurrentValue;
			$Payment_Refund->group_id->CssStyle = "";
			$Payment_Refund->group_id->CssClass = "";
			$Payment_Refund->group_id->ViewCustomAttributes = "";

			// scholarship_payment_id
			$Payment_Refund->scholarship_payment_id->HrefValue = "";
			$Payment_Refund->scholarship_payment_id->TooltipValue = "";

			// date
			$Payment_Refund->date->HrefValue = "";
			$Payment_Refund->date->TooltipValue = "";

			// status
			$Payment_Refund->status->HrefValue = "";
			$Payment_Refund->status->TooltipValue = "";

			// refund_amount
			$Payment_Refund->refund_amount->HrefValue = "";
			$Payment_Refund->refund_amount->TooltipValue = "";

			// amount
			$Payment_Refund->amount->HrefValue = "";
			$Payment_Refund->amount->TooltipValue = "";

			// memo
			$Payment_Refund->memo->HrefValue = "";
			$Payment_Refund->memo->TooltipValue = "";

			// year
			$Payment_Refund->year->HrefValue = "";
			$Payment_Refund->year->TooltipValue = "";

			// scholarship_package_scholarship_package_id
			$Payment_Refund->scholarship_package_scholarship_package_id->HrefValue = "";
			$Payment_Refund->scholarship_package_scholarship_package_id->TooltipValue = "";

			// programarea_residentarea_id
			$Payment_Refund->programarea_residentarea_id->HrefValue = "";
			$Payment_Refund->programarea_residentarea_id->TooltipValue = "";

			// programarea_payingarea_id
			$Payment_Refund->programarea_payingarea_id->HrefValue = "";
			$Payment_Refund->programarea_payingarea_id->TooltipValue = "";

			// payment_request_payment_request_id
			$Payment_Refund->payment_request_payment_request_id->HrefValue = "";
			$Payment_Refund->payment_request_payment_request_id->TooltipValue = "";

			// bankname
			$Payment_Refund->bankname->HrefValue = "";
			$Payment_Refund->bankname->TooltipValue = "";

			// account_no
			$Payment_Refund->account_no->HrefValue = "";
			$Payment_Refund->account_no->TooltipValue = "";

			// schools_school_id
			$Payment_Refund->schools_school_id->HrefValue = "";
			$Payment_Refund->schools_school_id->TooltipValue = "";
		} elseif ($Payment_Refund->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// scholarship_payment_id
			$Payment_Refund->scholarship_payment_id->EditCustomAttributes = "";
			$Payment_Refund->scholarship_payment_id->EditValue = $Payment_Refund->scholarship_payment_id->CurrentValue;
			$Payment_Refund->scholarship_payment_id->CssStyle = "";
			$Payment_Refund->scholarship_payment_id->CssClass = "";
			$Payment_Refund->scholarship_payment_id->ViewCustomAttributes = "";

			// date
			$Payment_Refund->date->EditCustomAttributes = "";
			$Payment_Refund->date->EditValue = ew_HtmlEncode(ew_FormatDateTime($Payment_Refund->date->CurrentValue, 7));

			// status
			$Payment_Refund->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("PENDING", "PENDING");
			$arwrk[] = array("PAID", "PAID");
			$Payment_Refund->status->EditValue = $arwrk;

			// refund_amount
			$Payment_Refund->refund_amount->EditCustomAttributes = "";
			$Payment_Refund->refund_amount->EditValue = ew_HtmlEncode($Payment_Refund->refund_amount->CurrentValue);

			// amount
			$Payment_Refund->amount->EditCustomAttributes = "";
			$Payment_Refund->amount->EditValue = ew_HtmlEncode($Payment_Refund->amount->CurrentValue);

			// memo
			$Payment_Refund->memo->EditCustomAttributes = "";
			$Payment_Refund->memo->EditValue = ew_HtmlEncode($Payment_Refund->memo->CurrentValue);

			// year
			$Payment_Refund->year->EditCustomAttributes = "";
			$Payment_Refund->year->EditValue = ew_HtmlEncode($Payment_Refund->year->CurrentValue);

			// scholarship_package_scholarship_package_id
			$Payment_Refund->scholarship_package_scholarship_package_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `scholarship_package_id`, `scholarship_type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `scholarship_package`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			$sWhereWrk = $GLOBALS["scholarship_package"]->AddUserIDFilter($sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$Payment_Refund->scholarship_package_scholarship_package_id->EditValue = $arwrk;

			// programarea_residentarea_id
			$Payment_Refund->programarea_residentarea_id->EditCustomAttributes = "";
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
			$Payment_Refund->programarea_residentarea_id->EditValue = $arwrk;

			// programarea_payingarea_id
			$Payment_Refund->programarea_payingarea_id->EditCustomAttributes = "";
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
			$Payment_Refund->programarea_payingarea_id->EditValue = $arwrk;

			// payment_request_payment_request_id
			$Payment_Refund->payment_request_payment_request_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `payment_request_id`, `code`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `payment_request`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			$sWhereWrk = $GLOBALS["payment_request"]->AddUserIDFilter($sWhereWrk);
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$Payment_Refund->payment_request_payment_request_id->EditValue = $arwrk;

			// bankname
			$Payment_Refund->bankname->EditCustomAttributes = "";
			$Payment_Refund->bankname->EditValue = ew_HtmlEncode($Payment_Refund->bankname->CurrentValue);

			// account_no
			$Payment_Refund->account_no->EditCustomAttributes = "";
			$Payment_Refund->account_no->EditValue = ew_HtmlEncode($Payment_Refund->account_no->CurrentValue);

			// schools_school_id
			$Payment_Refund->schools_school_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `school_id`, `school_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `schools`";
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
			$Payment_Refund->schools_school_id->EditValue = $arwrk;

			// Edit refer script
			// scholarship_payment_id

			$Payment_Refund->scholarship_payment_id->HrefValue = "";

			// date
			$Payment_Refund->date->HrefValue = "";

			// status
			$Payment_Refund->status->HrefValue = "";

			// refund_amount
			$Payment_Refund->refund_amount->HrefValue = "";

			// amount
			$Payment_Refund->amount->HrefValue = "";

			// memo
			$Payment_Refund->memo->HrefValue = "";

			// year
			$Payment_Refund->year->HrefValue = "";

			// scholarship_package_scholarship_package_id
			$Payment_Refund->scholarship_package_scholarship_package_id->HrefValue = "";

			// programarea_residentarea_id
			$Payment_Refund->programarea_residentarea_id->HrefValue = "";

			// programarea_payingarea_id
			$Payment_Refund->programarea_payingarea_id->HrefValue = "";

			// payment_request_payment_request_id
			$Payment_Refund->payment_request_payment_request_id->HrefValue = "";

			// bankname
			$Payment_Refund->bankname->HrefValue = "";

			// account_no
			$Payment_Refund->account_no->HrefValue = "";

			// schools_school_id
			$Payment_Refund->schools_school_id->HrefValue = "";
		}

		// Call Row Rendered event
		if ($Payment_Refund->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$Payment_Refund->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $Payment_Refund;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckEuroDate($Payment_Refund->date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $Payment_Refund->date->FldErrMsg();
		}
		if (!ew_CheckNumber($Payment_Refund->refund_amount->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $Payment_Refund->refund_amount->FldErrMsg();
		}
		if (!ew_CheckNumber($Payment_Refund->amount->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $Payment_Refund->amount->FldErrMsg();
		}
		if (!ew_CheckInteger($Payment_Refund->year->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $Payment_Refund->year->FldErrMsg();
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
		global $conn, $Security, $Language, $Payment_Refund;
		$sFilter = $Payment_Refund->KeyFilter();
		$Payment_Refund->CurrentFilter = $sFilter;
		$sSql = $Payment_Refund->SQL();
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

			// date
			$Payment_Refund->date->SetDbValueDef($rsnew, ew_UnFormatDateTime($Payment_Refund->date->CurrentValue, 7, FALSE), NULL);

			// status
			$Payment_Refund->status->SetDbValueDef($rsnew, $Payment_Refund->status->CurrentValue, NULL, FALSE);

			// refund_amount
			$Payment_Refund->refund_amount->SetDbValueDef($rsnew, $Payment_Refund->refund_amount->CurrentValue, NULL, FALSE);

			// amount
			$Payment_Refund->amount->SetDbValueDef($rsnew, $Payment_Refund->amount->CurrentValue, NULL, FALSE);

			// memo
			$Payment_Refund->memo->SetDbValueDef($rsnew, $Payment_Refund->memo->CurrentValue, NULL, FALSE);

			// year
			$Payment_Refund->year->SetDbValueDef($rsnew, $Payment_Refund->year->CurrentValue, NULL, FALSE);

			// scholarship_package_scholarship_package_id
			$Payment_Refund->scholarship_package_scholarship_package_id->SetDbValueDef($rsnew, $Payment_Refund->scholarship_package_scholarship_package_id->CurrentValue, NULL, FALSE);

			// programarea_residentarea_id
			$Payment_Refund->programarea_residentarea_id->SetDbValueDef($rsnew, $Payment_Refund->programarea_residentarea_id->CurrentValue, NULL, FALSE);

			// programarea_payingarea_id
			$Payment_Refund->programarea_payingarea_id->SetDbValueDef($rsnew, $Payment_Refund->programarea_payingarea_id->CurrentValue, NULL, FALSE);

			// payment_request_payment_request_id
			$Payment_Refund->payment_request_payment_request_id->SetDbValueDef($rsnew, $Payment_Refund->payment_request_payment_request_id->CurrentValue, NULL, FALSE);

			// bankname
			$Payment_Refund->bankname->SetDbValueDef($rsnew, $Payment_Refund->bankname->CurrentValue, NULL, FALSE);

			// account_no
			$Payment_Refund->account_no->SetDbValueDef($rsnew, $Payment_Refund->account_no->CurrentValue, NULL, FALSE);

			// schools_school_id
			$Payment_Refund->schools_school_id->SetDbValueDef($rsnew, $Payment_Refund->schools_school_id->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $Payment_Refund->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($Payment_Refund->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($Payment_Refund->CancelMessage <> "") {
					$this->setMessage($Payment_Refund->CancelMessage);
					$Payment_Refund->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$Payment_Refund->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'Payment Refund';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $Payment_Refund;
		$table = 'Payment Refund';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['scholarship_payment_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if ($Payment_Refund->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($Payment_Refund->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($Payment_Refund->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} elseif ($Payment_Refund->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
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
