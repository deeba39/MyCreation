<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "Disburse_Paymentsinfo.php" ?>
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
$Disburse_Payments_search = new cDisburse_Payments_search();
$Page =& $Disburse_Payments_search;

// Page init
$Disburse_Payments_search->Page_Init();

// Page main
$Disburse_Payments_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var Disburse_Payments_search = new ew_Page("Disburse_Payments_search");

// page properties
Disburse_Payments_search.PageID = "search"; // page ID
Disburse_Payments_search.FormID = "fDisburse_Paymentssearch"; // form ID
var EW_PAGE_ID = Disburse_Payments_search.PageID; // for backward compatibility

// extend page with validate function for search
Disburse_Payments_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_payment_request_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Disburse_Payments->payment_request_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Disburse_Payments->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_request_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Disburse_Payments->request_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_amount"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Disburse_Payments->amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Disburse_Payments->group_id->FldErrMsg()) ?>");

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
Disburse_Payments_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
Disburse_Payments_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Disburse_Payments_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $Disburse_Payments->TableCaption() ?><br><br>
<a href="<?php echo $Disburse_Payments->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$Disburse_Payments_search->ShowMessage();
?>
<form name="fDisburse_Paymentssearch" id="fDisburse_Paymentssearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return Disburse_Payments_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="Disburse_Payments">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->payment_request_id->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->payment_request_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_payment_request_id" id="z_payment_request_id" value="="></span></td>
		<td<?php echo $Disburse_Payments->payment_request_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_payment_request_id" id="x_payment_request_id" title="<?php echo $Disburse_Payments->payment_request_id->FldTitle() ?>" size="30" value="<?php echo $Disburse_Payments->payment_request_id->EditValue ?>"<?php echo $Disburse_Payments->payment_request_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->code->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->code->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_code" id="z_code" value="LIKE"></span></td>
		<td<?php echo $Disburse_Payments->code->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_code" id="x_code" title="<?php echo $Disburse_Payments->code->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $Disburse_Payments->code->EditValue ?>"<?php echo $Disburse_Payments->code->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->programarea_id->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->programarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_id" id="z_programarea_id" value="="></span></td>
		<td<?php echo $Disburse_Payments->programarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_id" name="x_programarea_id" title="<?php echo $Disburse_Payments->programarea_id->FldTitle() ?>"<?php echo $Disburse_Payments->programarea_id->EditAttributes() ?>>
<?php
if (is_array($Disburse_Payments->programarea_id->EditValue)) {
	$arwrk = $Disburse_Payments->programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Disburse_Payments->programarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->year->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_year" id="z_year" value="="></span></td>
		<td<?php echo $Disburse_Payments->year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_year" id="x_year" title="<?php echo $Disburse_Payments->year->FldTitle() ?>" size="30" value="<?php echo $Disburse_Payments->year->EditValue ?>"<?php echo $Disburse_Payments->year->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->request_date->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->request_date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_request_date" id="z_request_date" value="="></span></td>
		<td<?php echo $Disburse_Payments->request_date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_request_date" id="x_request_date" title="<?php echo $Disburse_Payments->request_date->FldTitle() ?>" value="<?php echo $Disburse_Payments->request_date->EditValue ?>"<?php echo $Disburse_Payments->request_date->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->request_status->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->request_status->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_request_status" id="z_request_status" value="="></span></td>
		<td<?php echo $Disburse_Payments->request_status->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_request_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $Disburse_Payments->request_status->FldTitle() ?>" value="{value}"<?php echo $Disburse_Payments->request_status->EditAttributes() ?>></label></div>
<div id="dsl_x_request_status" repeatcolumn="5">
<?php
$arwrk = $Disburse_Payments->request_status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Disburse_Payments->request_status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $Disburse_Payments->request_status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $Disburse_Payments->request_status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->financial_year_financial_year_id->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->financial_year_financial_year_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_financial_year_financial_year_id" id="z_financial_year_financial_year_id" value="="></span></td>
		<td<?php echo $Disburse_Payments->financial_year_financial_year_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_financial_year_financial_year_id" name="x_financial_year_financial_year_id" title="<?php echo $Disburse_Payments->financial_year_financial_year_id->FldTitle() ?>"<?php echo $Disburse_Payments->financial_year_financial_year_id->EditAttributes() ?>>
<?php
if (is_array($Disburse_Payments->financial_year_financial_year_id->EditValue)) {
	$arwrk = $Disburse_Payments->financial_year_financial_year_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Disburse_Payments->financial_year_financial_year_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->amount->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->amount->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_amount" id="z_amount" value="="></span></td>
		<td<?php echo $Disburse_Payments->amount->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_amount" id="x_amount" title="<?php echo $Disburse_Payments->amount->FldTitle() ?>" size="30" value="<?php echo $Disburse_Payments->amount->EditValue ?>"<?php echo $Disburse_Payments->amount->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Disburse_Payments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Disburse_Payments->group_id->FldCaption() ?></td>
		<td<?php echo $Disburse_Payments->group_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_group_id" id="z_group_id" value="="></span></td>
		<td<?php echo $Disburse_Payments->group_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $Disburse_Payments->group_id->FldTitle() ?>"<?php echo $Disburse_Payments->group_id->EditAttributes() ?>>
<?php
if (is_array($Disburse_Payments->group_id->EditValue)) {
	$arwrk = $Disburse_Payments->group_id->EditValue;
	if ($arwrk[0][0] <> "") echo "<option value=\"\">" . $Language->Phrase("PleaseSelect") . "</option>";
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Disburse_Payments->group_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="text" name="x_group_id" id="x_group_id" title="<?php echo $Disburse_Payments->group_id->FldTitle() ?>" size="30" value="<?php echo $Disburse_Payments->group_id->EditValue ?>"<?php echo $Disburse_Payments->group_id->EditAttributes() ?>>
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
$Disburse_Payments_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cDisburse_Payments_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'Disburse Payments';

	// Page object name
	var $PageObjName = 'Disburse_Payments_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $Disburse_Payments;
		if ($Disburse_Payments->UseTokenInUrl) $PageUrl .= "t=" . $Disburse_Payments->TableVar . "&"; // Add page token
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
		global $objForm, $Disburse_Payments;
		if ($Disburse_Payments->UseTokenInUrl) {
			if ($objForm)
				return ($Disburse_Payments->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($Disburse_Payments->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cDisburse_Payments_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Disburse_Payments)
		$GLOBALS["Disburse_Payments"] = new cDisburse_Payments();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Disburse Payments', TRUE);

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
		global $Disburse_Payments;

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
			$this->Page_Terminate("Disburse_Paymentslist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("Disburse_Paymentslist.php");
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
		global $objForm, $Language, $gsSearchError, $Disburse_Payments;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$Disburse_Payments->CurrentAction = $objForm->GetValue("a_search");
			switch ($Disburse_Payments->CurrentAction) {
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
						$sSrchStr = $Disburse_Payments->UrlParm($sSrchStr);
						$this->Page_Terminate("Disburse_Paymentslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$Disburse_Payments->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $Disburse_Payments;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $Disburse_Payments->payment_request_id); // payment_request_id
	$this->BuildSearchUrl($sSrchUrl, $Disburse_Payments->code); // code
	$this->BuildSearchUrl($sSrchUrl, $Disburse_Payments->programarea_id); // programarea_id
	$this->BuildSearchUrl($sSrchUrl, $Disburse_Payments->year); // year
	$this->BuildSearchUrl($sSrchUrl, $Disburse_Payments->request_date); // request_date
	$this->BuildSearchUrl($sSrchUrl, $Disburse_Payments->request_status); // request_status
	$this->BuildSearchUrl($sSrchUrl, $Disburse_Payments->financial_year_financial_year_id); // financial_year_financial_year_id
	$this->BuildSearchUrl($sSrchUrl, $Disburse_Payments->amount); // amount
	$this->BuildSearchUrl($sSrchUrl, $Disburse_Payments->group_id); // group_id
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
		global $objForm, $Disburse_Payments;

		// Load search values
		// payment_request_id

		$Disburse_Payments->payment_request_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_payment_request_id"));
		$Disburse_Payments->payment_request_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_payment_request_id");

		// code
		$Disburse_Payments->code->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_code"));
		$Disburse_Payments->code->AdvancedSearch->SearchOperator = $objForm->GetValue("z_code");

		// programarea_id
		$Disburse_Payments->programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_id"));
		$Disburse_Payments->programarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_id");

		// year
		$Disburse_Payments->year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_year"));
		$Disburse_Payments->year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_year");

		// request_date
		$Disburse_Payments->request_date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_request_date"));
		$Disburse_Payments->request_date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_request_date");

		// request_status
		$Disburse_Payments->request_status->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_request_status"));
		$Disburse_Payments->request_status->AdvancedSearch->SearchOperator = $objForm->GetValue("z_request_status");

		// financial_year_financial_year_id
		$Disburse_Payments->financial_year_financial_year_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_financial_year_financial_year_id"));
		$Disburse_Payments->financial_year_financial_year_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_financial_year_financial_year_id");

		// amount
		$Disburse_Payments->amount->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_amount"));
		$Disburse_Payments->amount->AdvancedSearch->SearchOperator = $objForm->GetValue("z_amount");

		// group_id
		$Disburse_Payments->group_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_group_id"));
		$Disburse_Payments->group_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_group_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Disburse_Payments;

		// Initialize URLs
		// Call Row_Rendering event

		$Disburse_Payments->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$Disburse_Payments->payment_request_id->CellCssStyle = ""; $Disburse_Payments->payment_request_id->CellCssClass = "";
		$Disburse_Payments->payment_request_id->CellAttrs = array(); $Disburse_Payments->payment_request_id->ViewAttrs = array(); $Disburse_Payments->payment_request_id->EditAttrs = array();

		// code
		$Disburse_Payments->code->CellCssStyle = ""; $Disburse_Payments->code->CellCssClass = "";
		$Disburse_Payments->code->CellAttrs = array(); $Disburse_Payments->code->ViewAttrs = array(); $Disburse_Payments->code->EditAttrs = array();

		// programarea_id
		$Disburse_Payments->programarea_id->CellCssStyle = ""; $Disburse_Payments->programarea_id->CellCssClass = "";
		$Disburse_Payments->programarea_id->CellAttrs = array(); $Disburse_Payments->programarea_id->ViewAttrs = array(); $Disburse_Payments->programarea_id->EditAttrs = array();

		// year
		$Disburse_Payments->year->CellCssStyle = ""; $Disburse_Payments->year->CellCssClass = "";
		$Disburse_Payments->year->CellAttrs = array(); $Disburse_Payments->year->ViewAttrs = array(); $Disburse_Payments->year->EditAttrs = array();

		// request_date
		$Disburse_Payments->request_date->CellCssStyle = ""; $Disburse_Payments->request_date->CellCssClass = "";
		$Disburse_Payments->request_date->CellAttrs = array(); $Disburse_Payments->request_date->ViewAttrs = array(); $Disburse_Payments->request_date->EditAttrs = array();

		// request_status
		$Disburse_Payments->request_status->CellCssStyle = ""; $Disburse_Payments->request_status->CellCssClass = "";
		$Disburse_Payments->request_status->CellAttrs = array(); $Disburse_Payments->request_status->ViewAttrs = array(); $Disburse_Payments->request_status->EditAttrs = array();

		// financial_year_financial_year_id
		$Disburse_Payments->financial_year_financial_year_id->CellCssStyle = ""; $Disburse_Payments->financial_year_financial_year_id->CellCssClass = "";
		$Disburse_Payments->financial_year_financial_year_id->CellAttrs = array(); $Disburse_Payments->financial_year_financial_year_id->ViewAttrs = array(); $Disburse_Payments->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$Disburse_Payments->amount->CellCssStyle = ""; $Disburse_Payments->amount->CellCssClass = "";
		$Disburse_Payments->amount->CellAttrs = array(); $Disburse_Payments->amount->ViewAttrs = array(); $Disburse_Payments->amount->EditAttrs = array();

		// group_id
		$Disburse_Payments->group_id->CellCssStyle = ""; $Disburse_Payments->group_id->CellCssClass = "";
		$Disburse_Payments->group_id->CellAttrs = array(); $Disburse_Payments->group_id->ViewAttrs = array(); $Disburse_Payments->group_id->EditAttrs = array();
		if ($Disburse_Payments->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$Disburse_Payments->payment_request_id->ViewValue = $Disburse_Payments->payment_request_id->CurrentValue;
			$Disburse_Payments->payment_request_id->CssStyle = "";
			$Disburse_Payments->payment_request_id->CssClass = "";
			$Disburse_Payments->payment_request_id->ViewCustomAttributes = "";

			// code
			$Disburse_Payments->code->ViewValue = $Disburse_Payments->code->CurrentValue;
			$Disburse_Payments->code->CssStyle = "";
			$Disburse_Payments->code->CssClass = "";
			$Disburse_Payments->code->ViewCustomAttributes = "";

			// programarea_id
			if (strval($Disburse_Payments->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Disburse_Payments->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Disburse_Payments->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Disburse_Payments->programarea_id->ViewValue = $Disburse_Payments->programarea_id->CurrentValue;
				}
			} else {
				$Disburse_Payments->programarea_id->ViewValue = NULL;
			}
			$Disburse_Payments->programarea_id->CssStyle = "";
			$Disburse_Payments->programarea_id->CssClass = "";
			$Disburse_Payments->programarea_id->ViewCustomAttributes = "";

			// year
			$Disburse_Payments->year->ViewValue = $Disburse_Payments->year->CurrentValue;
			$Disburse_Payments->year->CssStyle = "";
			$Disburse_Payments->year->CssClass = "";
			$Disburse_Payments->year->ViewCustomAttributes = "";

			// request_date
			$Disburse_Payments->request_date->ViewValue = $Disburse_Payments->request_date->CurrentValue;
			$Disburse_Payments->request_date->ViewValue = ew_FormatDateTime($Disburse_Payments->request_date->ViewValue, 7);
			$Disburse_Payments->request_date->CssStyle = "";
			$Disburse_Payments->request_date->CssClass = "";
			$Disburse_Payments->request_date->ViewCustomAttributes = "";

			// request_status
			if (strval($Disburse_Payments->request_status->CurrentValue) <> "") {
				switch ($Disburse_Payments->request_status->CurrentValue) {
					case "NEWREQ":
						$Disburse_Payments->request_status->ViewValue = "NEWREQ";
						break;
					case "REQUESTED":
						$Disburse_Payments->request_status->ViewValue = "REQUESTED";
						break;
					case "DISBURSED":
						$Disburse_Payments->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$Disburse_Payments->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$Disburse_Payments->request_status->ViewValue = $Disburse_Payments->request_status->CurrentValue;
				}
			} else {
				$Disburse_Payments->request_status->ViewValue = NULL;
			}
			$Disburse_Payments->request_status->CssStyle = "";
			$Disburse_Payments->request_status->CssClass = "";
			$Disburse_Payments->request_status->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($Disburse_Payments->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($Disburse_Payments->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Disburse_Payments->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$Disburse_Payments->financial_year_financial_year_id->ViewValue = $Disburse_Payments->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$Disburse_Payments->financial_year_financial_year_id->ViewValue = NULL;
			}
			$Disburse_Payments->financial_year_financial_year_id->CssStyle = "";
			$Disburse_Payments->financial_year_financial_year_id->CssClass = "";
			$Disburse_Payments->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$Disburse_Payments->amount->ViewValue = $Disburse_Payments->amount->CurrentValue;
			$Disburse_Payments->amount->CssStyle = "";
			$Disburse_Payments->amount->CssClass = "";
			$Disburse_Payments->amount->ViewCustomAttributes = "";

			// group_id
			$Disburse_Payments->group_id->ViewValue = $Disburse_Payments->group_id->CurrentValue;
			$Disburse_Payments->group_id->CssStyle = "";
			$Disburse_Payments->group_id->CssClass = "";
			$Disburse_Payments->group_id->ViewCustomAttributes = "";

			// payment_request_id
			$Disburse_Payments->payment_request_id->HrefValue = "";
			$Disburse_Payments->payment_request_id->TooltipValue = "";

			// code
			$Disburse_Payments->code->HrefValue = "";
			$Disburse_Payments->code->TooltipValue = "";

			// programarea_id
			$Disburse_Payments->programarea_id->HrefValue = "";
			$Disburse_Payments->programarea_id->TooltipValue = "";

			// year
			$Disburse_Payments->year->HrefValue = "";
			$Disburse_Payments->year->TooltipValue = "";

			// request_date
			$Disburse_Payments->request_date->HrefValue = "";
			$Disburse_Payments->request_date->TooltipValue = "";

			// request_status
			$Disburse_Payments->request_status->HrefValue = "";
			$Disburse_Payments->request_status->TooltipValue = "";

			// financial_year_financial_year_id
			$Disburse_Payments->financial_year_financial_year_id->HrefValue = "";
			$Disburse_Payments->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$Disburse_Payments->amount->HrefValue = "";
			$Disburse_Payments->amount->TooltipValue = "";

			// group_id
			$Disburse_Payments->group_id->HrefValue = "";
			$Disburse_Payments->group_id->TooltipValue = "";
		} elseif ($Disburse_Payments->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// payment_request_id
			$Disburse_Payments->payment_request_id->EditCustomAttributes = "";
			$Disburse_Payments->payment_request_id->EditValue = ew_HtmlEncode($Disburse_Payments->payment_request_id->AdvancedSearch->SearchValue);

			// code
			$Disburse_Payments->code->EditCustomAttributes = "";
			$Disburse_Payments->code->EditValue = ew_HtmlEncode($Disburse_Payments->code->AdvancedSearch->SearchValue);

			// programarea_id
			$Disburse_Payments->programarea_id->EditCustomAttributes = "";
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
			$Disburse_Payments->programarea_id->EditValue = $arwrk;

			// year
			$Disburse_Payments->year->EditCustomAttributes = "";
			$Disburse_Payments->year->EditValue = ew_HtmlEncode($Disburse_Payments->year->AdvancedSearch->SearchValue);

			// request_date
			$Disburse_Payments->request_date->EditCustomAttributes = "";
			$Disburse_Payments->request_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($Disburse_Payments->request_date->AdvancedSearch->SearchValue, 7), 7));

			// request_status
			$Disburse_Payments->request_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("NEWREQ", "NEWREQ");
			$arwrk[] = array("REQUESTED", "REQUESTED");
			$arwrk[] = array("DISBURSED", "DISBURSED");
			$arwrk[] = array("LIQUIDATED", "LIQUIDATED");
			$Disburse_Payments->request_status->EditValue = $arwrk;

			// financial_year_financial_year_id
			$Disburse_Payments->financial_year_financial_year_id->EditCustomAttributes = "";
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
			$Disburse_Payments->financial_year_financial_year_id->EditValue = $arwrk;

			// amount
			$Disburse_Payments->amount->EditCustomAttributes = "";
			$Disburse_Payments->amount->EditValue = ew_HtmlEncode($Disburse_Payments->amount->AdvancedSearch->SearchValue);

			// group_id
			$Disburse_Payments->group_id->EditCustomAttributes = "";
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
			$Disburse_Payments->group_id->EditValue = $arwrk;
			} else {
			$Disburse_Payments->group_id->EditValue = ew_HtmlEncode($Disburse_Payments->group_id->AdvancedSearch->SearchValue);
			}
		}

		// Call Row Rendered event
		if ($Disburse_Payments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$Disburse_Payments->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $Disburse_Payments;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($Disburse_Payments->payment_request_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Disburse_Payments->payment_request_id->FldErrMsg();
		}
		if (!ew_CheckInteger($Disburse_Payments->year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Disburse_Payments->year->FldErrMsg();
		}
		if (!ew_CheckEuroDate($Disburse_Payments->request_date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Disburse_Payments->request_date->FldErrMsg();
		}
		if (!ew_CheckInteger($Disburse_Payments->amount->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Disburse_Payments->amount->FldErrMsg();
		}
		if (!ew_CheckInteger($Disburse_Payments->group_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Disburse_Payments->group_id->FldErrMsg();
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
		global $Disburse_Payments;
		$Disburse_Payments->payment_request_id->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_payment_request_id");
		$Disburse_Payments->code->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_code");
		$Disburse_Payments->programarea_id->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_programarea_id");
		$Disburse_Payments->year->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_year");
		$Disburse_Payments->request_date->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_request_date");
		$Disburse_Payments->request_status->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_request_status");
		$Disburse_Payments->financial_year_financial_year_id->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_financial_year_financial_year_id");
		$Disburse_Payments->amount->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_amount");
		$Disburse_Payments->group_id->AdvancedSearch->SearchValue = $Disburse_Payments->getAdvancedSearch("x_group_id");
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
