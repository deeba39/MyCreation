<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "Liquidate_Payment_Requestinfo.php" ?>
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
$Liquidate_Payment_Request_search = new cLiquidate_Payment_Request_search();
$Page =& $Liquidate_Payment_Request_search;

// Page init
$Liquidate_Payment_Request_search->Page_Init();

// Page main
$Liquidate_Payment_Request_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var Liquidate_Payment_Request_search = new ew_Page("Liquidate_Payment_Request_search");

// page properties
Liquidate_Payment_Request_search.PageID = "search"; // page ID
Liquidate_Payment_Request_search.FormID = "fLiquidate_Payment_Requestsearch"; // form ID
var EW_PAGE_ID = Liquidate_Payment_Request_search.PageID; // for backward compatibility

// extend page with validate function for search
Liquidate_Payment_Request_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_payment_request_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Liquidate_Payment_Request->payment_request_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Liquidate_Payment_Request->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_request_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Liquidate_Payment_Request->request_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_amount"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Liquidate_Payment_Request->amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($Liquidate_Payment_Request->group_id->FldErrMsg()) ?>");

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
Liquidate_Payment_Request_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
Liquidate_Payment_Request_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Liquidate_Payment_Request_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $Liquidate_Payment_Request->TableCaption() ?><br><br>
<a href="<?php echo $Liquidate_Payment_Request->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$Liquidate_Payment_Request_search->ShowMessage();
?>
<form name="fLiquidate_Payment_Requestsearch" id="fLiquidate_Payment_Requestsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return Liquidate_Payment_Request_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="Liquidate_Payment_Request">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->payment_request_id->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->payment_request_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_payment_request_id" id="z_payment_request_id" value="="></span></td>
		<td<?php echo $Liquidate_Payment_Request->payment_request_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_payment_request_id" id="x_payment_request_id" title="<?php echo $Liquidate_Payment_Request->payment_request_id->FldTitle() ?>" size="30" value="<?php echo $Liquidate_Payment_Request->payment_request_id->EditValue ?>"<?php echo $Liquidate_Payment_Request->payment_request_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->year->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_year" id="z_year" value="="></span></td>
		<td<?php echo $Liquidate_Payment_Request->year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_year" id="x_year" title="<?php echo $Liquidate_Payment_Request->year->FldTitle() ?>" size="30" value="<?php echo $Liquidate_Payment_Request->year->EditValue ?>"<?php echo $Liquidate_Payment_Request->year->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->request_date->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->request_date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_request_date" id="z_request_date" value="="></span></td>
		<td<?php echo $Liquidate_Payment_Request->request_date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_request_date" id="x_request_date" title="<?php echo $Liquidate_Payment_Request->request_date->FldTitle() ?>" value="<?php echo $Liquidate_Payment_Request->request_date->EditValue ?>"<?php echo $Liquidate_Payment_Request->request_date->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->programarea_id->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->programarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_id" id="z_programarea_id" value="="></span></td>
		<td<?php echo $Liquidate_Payment_Request->programarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_id" name="x_programarea_id" title="<?php echo $Liquidate_Payment_Request->programarea_id->FldTitle() ?>"<?php echo $Liquidate_Payment_Request->programarea_id->EditAttributes() ?>>
<?php
if (is_array($Liquidate_Payment_Request->programarea_id->EditValue)) {
	$arwrk = $Liquidate_Payment_Request->programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Liquidate_Payment_Request->programarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->request_status->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->request_status->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_request_status" id="z_request_status" value="="></span></td>
		<td<?php echo $Liquidate_Payment_Request->request_status->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_request_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $Liquidate_Payment_Request->request_status->FldTitle() ?>" value="{value}"<?php echo $Liquidate_Payment_Request->request_status->EditAttributes() ?>></label></div>
<div id="dsl_x_request_status" repeatcolumn="5">
<?php
$arwrk = $Liquidate_Payment_Request->request_status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Liquidate_Payment_Request->request_status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $Liquidate_Payment_Request->request_status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $Liquidate_Payment_Request->request_status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->code->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->code->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_code" id="z_code" value="LIKE"></span></td>
		<td<?php echo $Liquidate_Payment_Request->code->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_code" id="x_code" title="<?php echo $Liquidate_Payment_Request->code->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $Liquidate_Payment_Request->code->EditValue ?>"<?php echo $Liquidate_Payment_Request->code->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_financial_year_financial_year_id" id="z_financial_year_financial_year_id" value="="></span></td>
		<td<?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_financial_year_financial_year_id" name="x_financial_year_financial_year_id" title="<?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->FldTitle() ?>"<?php echo $Liquidate_Payment_Request->financial_year_financial_year_id->EditAttributes() ?>>
<?php
if (is_array($Liquidate_Payment_Request->financial_year_financial_year_id->EditValue)) {
	$arwrk = $Liquidate_Payment_Request->financial_year_financial_year_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Liquidate_Payment_Request->financial_year_financial_year_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->amount->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->amount->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_amount" id="z_amount" value="="></span></td>
		<td<?php echo $Liquidate_Payment_Request->amount->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_amount" id="x_amount" title="<?php echo $Liquidate_Payment_Request->amount->FldTitle() ?>" size="30" value="<?php echo $Liquidate_Payment_Request->amount->EditValue ?>"<?php echo $Liquidate_Payment_Request->amount->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $Liquidate_Payment_Request->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $Liquidate_Payment_Request->group_id->FldCaption() ?></td>
		<td<?php echo $Liquidate_Payment_Request->group_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_group_id" id="z_group_id" value="="></span></td>
		<td<?php echo $Liquidate_Payment_Request->group_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $Liquidate_Payment_Request->group_id->FldTitle() ?>"<?php echo $Liquidate_Payment_Request->group_id->EditAttributes() ?>>
<?php
if (is_array($Liquidate_Payment_Request->group_id->EditValue)) {
	$arwrk = $Liquidate_Payment_Request->group_id->EditValue;
	if ($arwrk[0][0] <> "") echo "<option value=\"\">" . $Language->Phrase("PleaseSelect") . "</option>";
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($Liquidate_Payment_Request->group_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="text" name="x_group_id" id="x_group_id" title="<?php echo $Liquidate_Payment_Request->group_id->FldTitle() ?>" size="30" value="<?php echo $Liquidate_Payment_Request->group_id->EditValue ?>"<?php echo $Liquidate_Payment_Request->group_id->EditAttributes() ?>>
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
$Liquidate_Payment_Request_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cLiquidate_Payment_Request_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'Liquidate Payment Request';

	// Page object name
	var $PageObjName = 'Liquidate_Payment_Request_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $Liquidate_Payment_Request;
		if ($Liquidate_Payment_Request->UseTokenInUrl) $PageUrl .= "t=" . $Liquidate_Payment_Request->TableVar . "&"; // Add page token
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
		global $objForm, $Liquidate_Payment_Request;
		if ($Liquidate_Payment_Request->UseTokenInUrl) {
			if ($objForm)
				return ($Liquidate_Payment_Request->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($Liquidate_Payment_Request->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cLiquidate_Payment_Request_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (Liquidate_Payment_Request)
		$GLOBALS["Liquidate_Payment_Request"] = new cLiquidate_Payment_Request();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Liquidate Payment Request', TRUE);

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
		global $Liquidate_Payment_Request;

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
			$this->Page_Terminate("Liquidate_Payment_Requestlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("Liquidate_Payment_Requestlist.php");
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
		global $objForm, $Language, $gsSearchError, $Liquidate_Payment_Request;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$Liquidate_Payment_Request->CurrentAction = $objForm->GetValue("a_search");
			switch ($Liquidate_Payment_Request->CurrentAction) {
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
						$sSrchStr = $Liquidate_Payment_Request->UrlParm($sSrchStr);
						$this->Page_Terminate("Liquidate_Payment_Requestlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$Liquidate_Payment_Request->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $Liquidate_Payment_Request;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $Liquidate_Payment_Request->payment_request_id); // payment_request_id
	$this->BuildSearchUrl($sSrchUrl, $Liquidate_Payment_Request->year); // year
	$this->BuildSearchUrl($sSrchUrl, $Liquidate_Payment_Request->request_date); // request_date
	$this->BuildSearchUrl($sSrchUrl, $Liquidate_Payment_Request->programarea_id); // programarea_id
	$this->BuildSearchUrl($sSrchUrl, $Liquidate_Payment_Request->request_status); // request_status
	$this->BuildSearchUrl($sSrchUrl, $Liquidate_Payment_Request->code); // code
	$this->BuildSearchUrl($sSrchUrl, $Liquidate_Payment_Request->financial_year_financial_year_id); // financial_year_financial_year_id
	$this->BuildSearchUrl($sSrchUrl, $Liquidate_Payment_Request->amount); // amount
	$this->BuildSearchUrl($sSrchUrl, $Liquidate_Payment_Request->group_id); // group_id
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
		global $objForm, $Liquidate_Payment_Request;

		// Load search values
		// payment_request_id

		$Liquidate_Payment_Request->payment_request_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_payment_request_id"));
		$Liquidate_Payment_Request->payment_request_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_payment_request_id");

		// year
		$Liquidate_Payment_Request->year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_year"));
		$Liquidate_Payment_Request->year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_year");

		// request_date
		$Liquidate_Payment_Request->request_date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_request_date"));
		$Liquidate_Payment_Request->request_date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_request_date");

		// programarea_id
		$Liquidate_Payment_Request->programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_id"));
		$Liquidate_Payment_Request->programarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_id");

		// request_status
		$Liquidate_Payment_Request->request_status->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_request_status"));
		$Liquidate_Payment_Request->request_status->AdvancedSearch->SearchOperator = $objForm->GetValue("z_request_status");

		// code
		$Liquidate_Payment_Request->code->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_code"));
		$Liquidate_Payment_Request->code->AdvancedSearch->SearchOperator = $objForm->GetValue("z_code");

		// financial_year_financial_year_id
		$Liquidate_Payment_Request->financial_year_financial_year_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_financial_year_financial_year_id"));
		$Liquidate_Payment_Request->financial_year_financial_year_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_financial_year_financial_year_id");

		// amount
		$Liquidate_Payment_Request->amount->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_amount"));
		$Liquidate_Payment_Request->amount->AdvancedSearch->SearchOperator = $objForm->GetValue("z_amount");

		// group_id
		$Liquidate_Payment_Request->group_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_group_id"));
		$Liquidate_Payment_Request->group_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_group_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $Liquidate_Payment_Request;

		// Initialize URLs
		// Call Row_Rendering event

		$Liquidate_Payment_Request->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$Liquidate_Payment_Request->payment_request_id->CellCssStyle = ""; $Liquidate_Payment_Request->payment_request_id->CellCssClass = "";
		$Liquidate_Payment_Request->payment_request_id->CellAttrs = array(); $Liquidate_Payment_Request->payment_request_id->ViewAttrs = array(); $Liquidate_Payment_Request->payment_request_id->EditAttrs = array();

		// year
		$Liquidate_Payment_Request->year->CellCssStyle = ""; $Liquidate_Payment_Request->year->CellCssClass = "";
		$Liquidate_Payment_Request->year->CellAttrs = array(); $Liquidate_Payment_Request->year->ViewAttrs = array(); $Liquidate_Payment_Request->year->EditAttrs = array();

		// request_date
		$Liquidate_Payment_Request->request_date->CellCssStyle = ""; $Liquidate_Payment_Request->request_date->CellCssClass = "";
		$Liquidate_Payment_Request->request_date->CellAttrs = array(); $Liquidate_Payment_Request->request_date->ViewAttrs = array(); $Liquidate_Payment_Request->request_date->EditAttrs = array();

		// programarea_id
		$Liquidate_Payment_Request->programarea_id->CellCssStyle = ""; $Liquidate_Payment_Request->programarea_id->CellCssClass = "";
		$Liquidate_Payment_Request->programarea_id->CellAttrs = array(); $Liquidate_Payment_Request->programarea_id->ViewAttrs = array(); $Liquidate_Payment_Request->programarea_id->EditAttrs = array();

		// request_status
		$Liquidate_Payment_Request->request_status->CellCssStyle = ""; $Liquidate_Payment_Request->request_status->CellCssClass = "";
		$Liquidate_Payment_Request->request_status->CellAttrs = array(); $Liquidate_Payment_Request->request_status->ViewAttrs = array(); $Liquidate_Payment_Request->request_status->EditAttrs = array();

		// code
		$Liquidate_Payment_Request->code->CellCssStyle = ""; $Liquidate_Payment_Request->code->CellCssClass = "";
		$Liquidate_Payment_Request->code->CellAttrs = array(); $Liquidate_Payment_Request->code->ViewAttrs = array(); $Liquidate_Payment_Request->code->EditAttrs = array();

		// financial_year_financial_year_id
		$Liquidate_Payment_Request->financial_year_financial_year_id->CellCssStyle = ""; $Liquidate_Payment_Request->financial_year_financial_year_id->CellCssClass = "";
		$Liquidate_Payment_Request->financial_year_financial_year_id->CellAttrs = array(); $Liquidate_Payment_Request->financial_year_financial_year_id->ViewAttrs = array(); $Liquidate_Payment_Request->financial_year_financial_year_id->EditAttrs = array();

		// amount
		$Liquidate_Payment_Request->amount->CellCssStyle = ""; $Liquidate_Payment_Request->amount->CellCssClass = "";
		$Liquidate_Payment_Request->amount->CellAttrs = array(); $Liquidate_Payment_Request->amount->ViewAttrs = array(); $Liquidate_Payment_Request->amount->EditAttrs = array();

		// group_id
		$Liquidate_Payment_Request->group_id->CellCssStyle = ""; $Liquidate_Payment_Request->group_id->CellCssClass = "";
		$Liquidate_Payment_Request->group_id->CellAttrs = array(); $Liquidate_Payment_Request->group_id->ViewAttrs = array(); $Liquidate_Payment_Request->group_id->EditAttrs = array();
		if ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$Liquidate_Payment_Request->payment_request_id->ViewValue = $Liquidate_Payment_Request->payment_request_id->CurrentValue;
			$Liquidate_Payment_Request->payment_request_id->CssStyle = "";
			$Liquidate_Payment_Request->payment_request_id->CssClass = "";
			$Liquidate_Payment_Request->payment_request_id->ViewCustomAttributes = "";

			// year
			$Liquidate_Payment_Request->year->ViewValue = $Liquidate_Payment_Request->year->CurrentValue;
			$Liquidate_Payment_Request->year->CssStyle = "";
			$Liquidate_Payment_Request->year->CssClass = "";
			$Liquidate_Payment_Request->year->ViewCustomAttributes = "";

			// request_date
			$Liquidate_Payment_Request->request_date->ViewValue = $Liquidate_Payment_Request->request_date->CurrentValue;
			$Liquidate_Payment_Request->request_date->ViewValue = ew_FormatDateTime($Liquidate_Payment_Request->request_date->ViewValue, 7);
			$Liquidate_Payment_Request->request_date->CssStyle = "";
			$Liquidate_Payment_Request->request_date->CssClass = "";
			$Liquidate_Payment_Request->request_date->ViewCustomAttributes = "";

			// programarea_id
			if (strval($Liquidate_Payment_Request->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($Liquidate_Payment_Request->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Liquidate_Payment_Request->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$Liquidate_Payment_Request->programarea_id->ViewValue = $Liquidate_Payment_Request->programarea_id->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->programarea_id->ViewValue = NULL;
			}
			$Liquidate_Payment_Request->programarea_id->CssStyle = "";
			$Liquidate_Payment_Request->programarea_id->CssClass = "";
			$Liquidate_Payment_Request->programarea_id->ViewCustomAttributes = "";

			// request_status
			if (strval($Liquidate_Payment_Request->request_status->CurrentValue) <> "") {
				switch ($Liquidate_Payment_Request->request_status->CurrentValue) {
					case "NEWREQ":
						$Liquidate_Payment_Request->request_status->ViewValue = "NEWREQ";
						break;
					case "REQUESTED":
						$Liquidate_Payment_Request->request_status->ViewValue = "REQUESTED";
						break;
					case "DISBURSED":
						$Liquidate_Payment_Request->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$Liquidate_Payment_Request->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$Liquidate_Payment_Request->request_status->ViewValue = $Liquidate_Payment_Request->request_status->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->request_status->ViewValue = NULL;
			}
			$Liquidate_Payment_Request->request_status->CssStyle = "";
			$Liquidate_Payment_Request->request_status->CssClass = "";
			$Liquidate_Payment_Request->request_status->ViewCustomAttributes = "";

			// code
			$Liquidate_Payment_Request->code->ViewValue = $Liquidate_Payment_Request->code->CurrentValue;
			$Liquidate_Payment_Request->code->CssStyle = "";
			$Liquidate_Payment_Request->code->CssClass = "";
			$Liquidate_Payment_Request->code->ViewCustomAttributes = "";

			// financial_year_financial_year_id
			if (strval($Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue) <> "") {
				$sFilterWrk = "`financial_year_id` = " . ew_AdjustSql($Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `year_name` FROM `financial_year`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue = $rswrk->fields('year_name');
					$rswrk->Close();
				} else {
					$Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue = $Liquidate_Payment_Request->financial_year_financial_year_id->CurrentValue;
				}
			} else {
				$Liquidate_Payment_Request->financial_year_financial_year_id->ViewValue = NULL;
			}
			$Liquidate_Payment_Request->financial_year_financial_year_id->CssStyle = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->CssClass = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->ViewCustomAttributes = "";

			// amount
			$Liquidate_Payment_Request->amount->ViewValue = $Liquidate_Payment_Request->amount->CurrentValue;
			$Liquidate_Payment_Request->amount->CssStyle = "";
			$Liquidate_Payment_Request->amount->CssClass = "";
			$Liquidate_Payment_Request->amount->ViewCustomAttributes = "";

			// group_id
			$Liquidate_Payment_Request->group_id->ViewValue = $Liquidate_Payment_Request->group_id->CurrentValue;
			$Liquidate_Payment_Request->group_id->CssStyle = "";
			$Liquidate_Payment_Request->group_id->CssClass = "";
			$Liquidate_Payment_Request->group_id->ViewCustomAttributes = "";

			// payment_request_id
			$Liquidate_Payment_Request->payment_request_id->HrefValue = "";
			$Liquidate_Payment_Request->payment_request_id->TooltipValue = "";

			// year
			$Liquidate_Payment_Request->year->HrefValue = "";
			$Liquidate_Payment_Request->year->TooltipValue = "";

			// request_date
			$Liquidate_Payment_Request->request_date->HrefValue = "";
			$Liquidate_Payment_Request->request_date->TooltipValue = "";

			// programarea_id
			$Liquidate_Payment_Request->programarea_id->HrefValue = "";
			$Liquidate_Payment_Request->programarea_id->TooltipValue = "";

			// request_status
			$Liquidate_Payment_Request->request_status->HrefValue = "";
			$Liquidate_Payment_Request->request_status->TooltipValue = "";

			// code
			$Liquidate_Payment_Request->code->HrefValue = "";
			$Liquidate_Payment_Request->code->TooltipValue = "";

			// financial_year_financial_year_id
			$Liquidate_Payment_Request->financial_year_financial_year_id->HrefValue = "";
			$Liquidate_Payment_Request->financial_year_financial_year_id->TooltipValue = "";

			// amount
			$Liquidate_Payment_Request->amount->HrefValue = "";
			$Liquidate_Payment_Request->amount->TooltipValue = "";

			// group_id
			$Liquidate_Payment_Request->group_id->HrefValue = "";
			$Liquidate_Payment_Request->group_id->TooltipValue = "";
		} elseif ($Liquidate_Payment_Request->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// payment_request_id
			$Liquidate_Payment_Request->payment_request_id->EditCustomAttributes = "";
			$Liquidate_Payment_Request->payment_request_id->EditValue = ew_HtmlEncode($Liquidate_Payment_Request->payment_request_id->AdvancedSearch->SearchValue);

			// year
			$Liquidate_Payment_Request->year->EditCustomAttributes = "";
			$Liquidate_Payment_Request->year->EditValue = ew_HtmlEncode($Liquidate_Payment_Request->year->AdvancedSearch->SearchValue);

			// request_date
			$Liquidate_Payment_Request->request_date->EditCustomAttributes = "";
			$Liquidate_Payment_Request->request_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($Liquidate_Payment_Request->request_date->AdvancedSearch->SearchValue, 7), 7));

			// programarea_id
			$Liquidate_Payment_Request->programarea_id->EditCustomAttributes = "";
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
			$Liquidate_Payment_Request->programarea_id->EditValue = $arwrk;

			// request_status
			$Liquidate_Payment_Request->request_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("NEWREQ", "NEWREQ");
			$arwrk[] = array("REQUESTED", "REQUESTED");
			$arwrk[] = array("DISBURSED", "DISBURSED");
			$arwrk[] = array("LIQUIDATED", "LIQUIDATED");
			$Liquidate_Payment_Request->request_status->EditValue = $arwrk;

			// code
			$Liquidate_Payment_Request->code->EditCustomAttributes = "";
			$Liquidate_Payment_Request->code->EditValue = ew_HtmlEncode($Liquidate_Payment_Request->code->AdvancedSearch->SearchValue);

			// financial_year_financial_year_id
			$Liquidate_Payment_Request->financial_year_financial_year_id->EditCustomAttributes = "";
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
			$Liquidate_Payment_Request->financial_year_financial_year_id->EditValue = $arwrk;

			// amount
			$Liquidate_Payment_Request->amount->EditCustomAttributes = "";
			$Liquidate_Payment_Request->amount->EditValue = ew_HtmlEncode($Liquidate_Payment_Request->amount->AdvancedSearch->SearchValue);

			// group_id
			$Liquidate_Payment_Request->group_id->EditCustomAttributes = "";
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
			$Liquidate_Payment_Request->group_id->EditValue = $arwrk;
			} else {
			$Liquidate_Payment_Request->group_id->EditValue = ew_HtmlEncode($Liquidate_Payment_Request->group_id->AdvancedSearch->SearchValue);
			}
		}

		// Call Row Rendered event
		if ($Liquidate_Payment_Request->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$Liquidate_Payment_Request->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $Liquidate_Payment_Request;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($Liquidate_Payment_Request->payment_request_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Liquidate_Payment_Request->payment_request_id->FldErrMsg();
		}
		if (!ew_CheckInteger($Liquidate_Payment_Request->year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Liquidate_Payment_Request->year->FldErrMsg();
		}
		if (!ew_CheckEuroDate($Liquidate_Payment_Request->request_date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Liquidate_Payment_Request->request_date->FldErrMsg();
		}
		if (!ew_CheckInteger($Liquidate_Payment_Request->amount->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Liquidate_Payment_Request->amount->FldErrMsg();
		}
		if (!ew_CheckInteger($Liquidate_Payment_Request->group_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $Liquidate_Payment_Request->group_id->FldErrMsg();
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
		global $Liquidate_Payment_Request;
		$Liquidate_Payment_Request->payment_request_id->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_payment_request_id");
		$Liquidate_Payment_Request->year->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_year");
		$Liquidate_Payment_Request->request_date->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_request_date");
		$Liquidate_Payment_Request->programarea_id->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_programarea_id");
		$Liquidate_Payment_Request->request_status->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_request_status");
		$Liquidate_Payment_Request->code->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_code");
		$Liquidate_Payment_Request->financial_year_financial_year_id->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_financial_year_financial_year_id");
		$Liquidate_Payment_Request->amount->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_amount");
		$Liquidate_Payment_Request->group_id->AdvancedSearch->SearchValue = $Liquidate_Payment_Request->getAdvancedSearch("x_group_id");
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
