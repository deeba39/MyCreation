<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "payment_requestinfo.php" ?>
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
$payment_request_search = new cpayment_request_search();
$Page =& $payment_request_search;

// Page init
$payment_request_search->Page_Init();

// Page main
$payment_request_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var payment_request_search = new ew_Page("payment_request_search");

// page properties
payment_request_search.PageID = "search"; // page ID
payment_request_search.FormID = "fpayment_requestsearch"; // form ID
var EW_PAGE_ID = payment_request_search.PageID; // for backward compatibility

// extend page with validate function for search
payment_request_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_payment_request_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($payment_request->payment_request_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($payment_request->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_request_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($payment_request->request_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_amount"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($payment_request->amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($payment_request->group_id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
payment_request_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
payment_request_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
payment_request_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $payment_request->TableCaption() ?><br><br>
<a href="<?php echo $payment_request->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$payment_request_search->ShowMessage();
?>
<form name="fpayment_requestsearch" id="fpayment_requestsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return payment_request_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="payment_request">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->payment_request_id->FldCaption() ?></td>
		<td<?php echo $payment_request->payment_request_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_payment_request_id" id="z_payment_request_id" value="="></span></td>
		<td<?php echo $payment_request->payment_request_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_payment_request_id" id="x_payment_request_id" title="<?php echo $payment_request->payment_request_id->FldTitle() ?>" size="30" value="<?php echo $payment_request->payment_request_id->EditValue ?>"<?php echo $payment_request->payment_request_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->year->FldCaption() ?></td>
		<td<?php echo $payment_request->year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_year" id="z_year" value="="></span></td>
		<td<?php echo $payment_request->year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_year" id="x_year" title="<?php echo $payment_request->year->FldTitle() ?>" size="30" value="<?php echo $payment_request->year->EditValue ?>"<?php echo $payment_request->year->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->request_date->FldCaption() ?></td>
		<td<?php echo $payment_request->request_date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_request_date" id="z_request_date" value="="></span></td>
		<td<?php echo $payment_request->request_date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_request_date" id="x_request_date" title="<?php echo $payment_request->request_date->FldTitle() ?>" value="<?php echo $payment_request->request_date->EditValue ?>"<?php echo $payment_request->request_date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_request_date" name="cal_x_request_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_request_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_request_date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->programarea_id->FldCaption() ?></td>
		<td<?php echo $payment_request->programarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_id" id="z_programarea_id" value="="></span></td>
		<td<?php echo $payment_request->programarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_id" name="x_programarea_id" title="<?php echo $payment_request->programarea_id->FldTitle() ?>"<?php echo $payment_request->programarea_id->EditAttributes() ?>>
<?php
if (is_array($payment_request->programarea_id->EditValue)) {
	$arwrk = $payment_request->programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($payment_request->programarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->request_status->FldCaption() ?></td>
		<td<?php echo $payment_request->request_status->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_request_status" id="z_request_status" value="="></span></td>
		<td<?php echo $payment_request->request_status->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_request_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $payment_request->request_status->FldTitle() ?>" value="{value}"<?php echo $payment_request->request_status->EditAttributes() ?>></label></div>
<div id="dsl_x_request_status" repeatcolumn="5">
<?php
$arwrk = $payment_request->request_status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($payment_request->request_status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $payment_request->request_status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $payment_request->request_status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->code->FldCaption() ?></td>
		<td<?php echo $payment_request->code->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_code" id="z_code" value="LIKE"></span></td>
		<td<?php echo $payment_request->code->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_code" id="x_code" title="<?php echo $payment_request->code->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $payment_request->code->EditValue ?>"<?php echo $payment_request->code->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->financial_year_financial_year_id->FldCaption() ?></td>
		<td<?php echo $payment_request->financial_year_financial_year_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_financial_year_financial_year_id" id="z_financial_year_financial_year_id" value="="></span></td>
		<td<?php echo $payment_request->financial_year_financial_year_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_financial_year_financial_year_id" name="x_financial_year_financial_year_id" title="<?php echo $payment_request->financial_year_financial_year_id->FldTitle() ?>"<?php echo $payment_request->financial_year_financial_year_id->EditAttributes() ?>>
<?php
if (is_array($payment_request->financial_year_financial_year_id->EditValue)) {
	$arwrk = $payment_request->financial_year_financial_year_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($payment_request->financial_year_financial_year_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->amount->FldCaption() ?></td>
		<td<?php echo $payment_request->amount->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_amount" id="z_amount" value="="></span></td>
		<td<?php echo $payment_request->amount->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_amount" id="x_amount" title="<?php echo $payment_request->amount->FldTitle() ?>" size="30" value="<?php echo $payment_request->amount->EditValue ?>"<?php echo $payment_request->amount->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $payment_request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $payment_request->group_id->FldCaption() ?></td>
		<td<?php echo $payment_request->group_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_group_id" id="z_group_id" value="="></span></td>
		<td<?php echo $payment_request->group_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $payment_request->group_id->FldTitle() ?>"<?php echo $payment_request->group_id->EditAttributes() ?>>
<?php
if (is_array($payment_request->group_id->EditValue)) {
	$arwrk = $payment_request->group_id->EditValue;
	if ($arwrk[0][0] <> "") echo "<option value=\"\">" . $Language->Phrase("PleaseSelect") . "</option>";
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($payment_request->group_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="text" name="x_group_id" id="x_group_id" title="<?php echo $payment_request->group_id->FldTitle() ?>" size="30" value="<?php echo $payment_request->group_id->EditValue ?>"<?php echo $payment_request->group_id->EditAttributes() ?>>
<?php } ?>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$payment_request_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cpayment_request_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'payment_request';

	// Page object name
	var $PageObjName = 'payment_request_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $payment_request;
		if ($payment_request->UseTokenInUrl) $PageUrl .= "t=" . $payment_request->TableVar . "&"; // Add page token
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
		global $objForm, $payment_request;
		if ($payment_request->UseTokenInUrl) {
			if ($objForm)
				return ($payment_request->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($payment_request->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpayment_request_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (payment_request)
		$GLOBALS["payment_request"] = new cpayment_request();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'payment_request', TRUE);

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
		global $payment_request;

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
		if (!$Security->CanSearch()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("payment_requestlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("payment_requestlist.php");
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $payment_request;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$payment_request->CurrentAction = $objForm->GetValue("a_search");
			switch ($payment_request->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $payment_request->UrlParm($sSrchStr);
						$this->Page_Terminate("payment_requestlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$payment_request->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $payment_request;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $payment_request->payment_request_id); // payment_request_id
	$this->BuildSearchUrl($sSrchUrl, $payment_request->year); // year
	$this->BuildSearchUrl($sSrchUrl, $payment_request->request_date); // request_date
	$this->BuildSearchUrl($sSrchUrl, $payment_request->programarea_id); // programarea_id
	$this->BuildSearchUrl($sSrchUrl, $payment_request->request_status); // request_status
	$this->BuildSearchUrl($sSrchUrl, $payment_request->code); // code
	$this->BuildSearchUrl($sSrchUrl, $payment_request->financial_year_financial_year_id); // financial_year_financial_year_id
	$this->BuildSearchUrl($sSrchUrl, $payment_request->amount); // amount
	$this->BuildSearchUrl($sSrchUrl, $payment_request->group_id); // group_id
	return $sSrchUrl;
}

// Build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

// Convert search value for date
function ConvertSearchValue(&$Fld, $FldVal) {
	$Value = $FldVal;
	if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
		$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
	return $Value;
}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $payment_request;

		// Load search values
		// payment_request_id

		$payment_request->payment_request_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_payment_request_id"));
		$payment_request->payment_request_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_payment_request_id");

		// year
		$payment_request->year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_year"));
		$payment_request->year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_year");

		// request_date
		$payment_request->request_date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_request_date"));
		$payment_request->request_date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_request_date");

		// programarea_id
		$payment_request->programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_id"));
		$payment_request->programarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_id");

		// request_status
		$payment_request->request_status->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_request_status"));
		$payment_request->request_status->AdvancedSearch->SearchOperator = $objForm->GetValue("z_request_status");

		// code
		$payment_request->code->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_code"));
		$payment_request->code->AdvancedSearch->SearchOperator = $objForm->GetValue("z_code");

		// financial_year_financial_year_id
		$payment_request->financial_year_financial_year_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_financial_year_financial_year_id"));
		$payment_request->financial_year_financial_year_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_financial_year_financial_year_id");

		// amount
		$payment_request->amount->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_amount"));
		$payment_request->amount->AdvancedSearch->SearchOperator = $objForm->GetValue("z_amount");

		// group_id
		$payment_request->group_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_group_id"));
		$payment_request->group_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_group_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $payment_request;

		// Initialize URLs
		// Call Row_Rendering event

		$payment_request->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$payment_request->payment_request_id->CellCssStyle = ""; $payment_request->payment_request_id->CellCssClass = "";
		$payment_request->payment_request_id->CellAttrs = array(); $payment_request->payment_request_id->ViewAttrs = array(); $payment_request->payment_request_id->EditAttrs = array();

		// year
		$payment_request->year->CellCssStyle = ""; $payment_request->year->CellCssClass = "";
		$payment_request->year->CellAttrs = array(); $payment_request->year->ViewAttrs = array(); $payment_request->year->EditAttrs = array();

		// request_date
		$payment_request->request_date->CellCssStyle = ""; $payment_request->request_date->CellCssClass = "";
		$payment_request->request_date->CellAttrs = array(); $payment_request->request_date->ViewAttrs = array(); $payment_request->request_date->EditAttrs = array();

		// programarea_id
		$payment_request->programarea_id->CellCssStyle = ""; $payment_request->programarea_id->CellCssClass = "";
		$payment_request->programarea_id->CellAttrs = array(); $payment_request->programarea_id->ViewAttrs = array(); $payment_request->programarea_id->EditAttrs = array();

		// request_status
		$payment_request->request_status->CellCssStyle = ""; $payment_request->request_status->CellCssClass = "";
		$payment_request->request_status->CellAttrs = array(); $payment_request->request_status->ViewAttrs = array(); $payment_request->request_status->EditAttrs = array();

		// code
		$payment_request->code->CellCssStyle = ""; $payment_request->code->CellCssClass = "";
		$payment_request->code->CellAttrs = array(); $payment_request->code->ViewAttrs = array(); $payment_request->code->EditAttrs = array();

		// financial_year_financial_year_id
		$payment_request->financial_year_financial_year_id->CellCssStyle = ""; $payment_request->financial_year_financial_year_id->CellCssClass = "";
		$payment_request->financial_year_financial_year_id->CellAttrs = array(); $payment_request->financial_year_financial_year_id->ViewAttrs = array(); $payment_request->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$payment_request->amount->CellCssStyle = ""; $payment_request->amount->CellCssClass = "";
		$payment_request->amount->CellAttrs = array(); $payment_request->amount->ViewAttrs = array(); $payment_request->amount->EditAttrs = array();

		// group_id
		$payment_request->group_id->CellCssStyle = ""; $payment_request->group_id->CellCssClass = "";
		$payment_request->group_id->CellAttrs = array(); $payment_request->group_id->ViewAttrs = array(); $payment_request->group_id->EditAttrs = array();
		if ($payment_request->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$payment_request->payment_request_id->ViewValue = $payment_request->payment_request_id->CurrentValue;
			$payment_request->payment_request_id->CssStyle = "";
			$payment_request->payment_request_id->CssClass = "";
			$payment_request->payment_request_id->ViewCustomAttributes = "";

			// year
			$payment_request->year->ViewValue = $payment_request->year->CurrentValue;
			$payment_request->year->CssStyle = "";
			$payment_request->year->CssClass = "";
			$payment_request->year->ViewCustomAttributes = "";

			// request_date
			$payment_request->request_date->ViewValue = $payment_request->request_date->CurrentValue;
			$payment_request->request_date->ViewValue = ew_FormatDateTime($payment_request->request_date->ViewValue, 7);
			$payment_request->request_date->CssStyle = "";
			$payment_request->request_date->CssClass = "";
			$payment_request->request_date->ViewCustomAttributes = "";

			// programarea_id
			if (strval($payment_request->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($payment_request->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$payment_request->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$payment_request->programarea_id->ViewValue = $payment_request->programarea_id->CurrentValue;
				}
			} else {
				$payment_request->programarea_id->ViewValue = NULL;
			}
			$payment_request->programarea_id->CssStyle = "";
			$payment_request->programarea_id->CssClass = "";
			$payment_request->programarea_id->ViewCustomAttributes = "";

			// request_status
			if (strval($payment_request->request_status->CurrentValue) <> "") {
				switch ($payment_request->request_status->CurrentValue) {
					case "NEWREQ":
						$payment_request->request_status->ViewValue = "NEWREQ";
						break;
					case "REQUESTED":
						$payment_request->request_status->ViewValue = "REQUESTED";
						break;
					case "DISBURSED":
						$payment_request->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$payment_request->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$payment_request->request_status->ViewValue = $payment_request->request_status->CurrentValue;
				}
			} else {
				$payment_request->request_status->ViewValue = NULL;
			}
			$payment_request->request_status->CssStyle = "";
			$payment_request->request_status->CssClass = "";
			$payment_request->request_status->ViewCustomAttributes = "";

			// code
			$payment_request->code->ViewValue = $payment_request->code->CurrentValue;
			$payment_request->code->CssStyle = "";
			$payment_request->code->CssClass = "";
			$payment_request->code->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($payment_request->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($payment_request->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$payment_request->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$payment_request->financial_year_financial_year_id->ViewValue = $payment_request->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$payment_request->financial_year_financial_year_id->ViewValue = NULL;
			}
			$payment_request->financial_year_financial_year_id->CssStyle = "";
			$payment_request->financial_year_financial_year_id->CssClass = "";
			$payment_request->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$payment_request->amount->ViewValue = $payment_request->amount->CurrentValue;
			$payment_request->amount->CssStyle = "";
			$payment_request->amount->CssClass = "";
			$payment_request->amount->ViewCustomAttributes = "";

			// group_id
			$payment_request->group_id->ViewValue = $payment_request->group_id->CurrentValue;
			$payment_request->group_id->CssStyle = "";
			$payment_request->group_id->CssClass = "";
			$payment_request->group_id->ViewCustomAttributes = "";

			// payment_request_id
			$payment_request->payment_request_id->HrefValue = "";
			$payment_request->payment_request_id->TooltipValue = "";

			// year
			$payment_request->year->HrefValue = "";
			$payment_request->year->TooltipValue = "";

			// request_date
			$payment_request->request_date->HrefValue = "";
			$payment_request->request_date->TooltipValue = "";

			// programarea_id
			$payment_request->programarea_id->HrefValue = "";
			$payment_request->programarea_id->TooltipValue = "";

			// request_status
			$payment_request->request_status->HrefValue = "";
			$payment_request->request_status->TooltipValue = "";

			// code
			$payment_request->code->HrefValue = "";
			$payment_request->code->TooltipValue = "";

			// financial_year_financial_year_id
			$payment_request->financial_year_financial_year_id->HrefValue = "";
			$payment_request->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$payment_request->amount->HrefValue = "";
			$payment_request->amount->TooltipValue = "";

			// group_id
			$payment_request->group_id->HrefValue = "";
			$payment_request->group_id->TooltipValue = "";
		} elseif ($payment_request->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// payment_request_id
			$payment_request->payment_request_id->EditCustomAttributes = "";
			$payment_request->payment_request_id->EditValue = ew_HtmlEncode($payment_request->payment_request_id->AdvancedSearch->SearchValue);

			// year
			$payment_request->year->EditCustomAttributes = "";
			$payment_request->year->EditValue = ew_HtmlEncode($payment_request->year->AdvancedSearch->SearchValue);

			// request_date
			$payment_request->request_date->EditCustomAttributes = "";
			$payment_request->request_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($payment_request->request_date->AdvancedSearch->SearchValue, 7), 7));

			// programarea_id
			$payment_request->programarea_id->EditCustomAttributes = "";
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
			$payment_request->programarea_id->EditValue = $arwrk;

			// request_status
			$payment_request->request_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("NEWREQ", "NEWREQ");
			$arwrk[] = array("REQUESTED", "REQUESTED");
			$arwrk[] = array("DISBURSED", "DISBURSED");
			$arwrk[] = array("LIQUIDATED", "LIQUIDATED");
			$payment_request->request_status->EditValue = $arwrk;

			// code
			$payment_request->code->EditCustomAttributes = "";
			$payment_request->code->EditValue = ew_HtmlEncode($payment_request->code->AdvancedSearch->SearchValue);

			// financial_year_financial_year_id
			$payment_request->financial_year_financial_year_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `financial_year_id`, `year_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `financial_year`";
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
			$payment_request->financial_year_financial_year_id->EditValue = $arwrk;

			// amount
			$payment_request->amount->EditCustomAttributes = "";
			$payment_request->amount->EditValue = ew_HtmlEncode($payment_request->amount->AdvancedSearch->SearchValue);

			// group_id
			$payment_request->group_id->EditCustomAttributes = "";
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
			$payment_request->group_id->EditValue = $arwrk;
			} else {
			$payment_request->group_id->EditValue = ew_HtmlEncode($payment_request->group_id->AdvancedSearch->SearchValue);
			}
		}

		// Call Row Rendered event
		if ($payment_request->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$payment_request->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $payment_request;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($payment_request->payment_request_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $payment_request->payment_request_id->FldErrMsg();
		}
		if (!ew_CheckInteger($payment_request->year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $payment_request->year->FldErrMsg();
		}
		if (!ew_CheckEuroDate($payment_request->request_date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $payment_request->request_date->FldErrMsg();
		}
		if (!ew_CheckInteger($payment_request->amount->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $payment_request->amount->FldErrMsg();
		}
		if (!ew_CheckInteger($payment_request->group_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $payment_request->group_id->FldErrMsg();
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $payment_request;
		$payment_request->payment_request_id->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_payment_request_id");
		$payment_request->year->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_year");
		$payment_request->request_date->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_request_date");
		$payment_request->programarea_id->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_programarea_id");
		$payment_request->request_status->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_request_status");
		$payment_request->code->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_code");
		$payment_request->financial_year_financial_year_id->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_financial_year_financial_year_id");
		$payment_request->amount->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_amount");
		$payment_request->group_id->AdvancedSearch->SearchValue = $payment_request->getAdvancedSearch("x_group_id");
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
