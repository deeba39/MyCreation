<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "New_Payment_Requestsinfo.php" ?>
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
$New_Payment_Requests_search = new cNew_Payment_Requests_search();
$Page =& $New_Payment_Requests_search;

// Page init
$New_Payment_Requests_search->Page_Init();

// Page main
$New_Payment_Requests_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var New_Payment_Requests_search = new ew_Page("New_Payment_Requests_search");

// page properties
New_Payment_Requests_search.PageID = "search"; // page ID
New_Payment_Requests_search.FormID = "fNew_Payment_Requestssearch"; // form ID
var EW_PAGE_ID = New_Payment_Requests_search.PageID; // for backward compatibility

// extend page with validate function for search
New_Payment_Requests_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_payment_request_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($New_Payment_Requests->payment_request_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($New_Payment_Requests->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_request_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($New_Payment_Requests->request_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($New_Payment_Requests->group_id->FldErrMsg()) ?>");

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
New_Payment_Requests_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
New_Payment_Requests_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
New_Payment_Requests_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeCUSTOMVIEW") ?><?php echo $New_Payment_Requests->TableCaption() ?><br><br>
<a href="<?php echo $New_Payment_Requests->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$New_Payment_Requests_search->ShowMessage();
?>
<form name="fNew_Payment_Requestssearch" id="fNew_Payment_Requestssearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return New_Payment_Requests_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="New_Payment_Requests">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $New_Payment_Requests->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $New_Payment_Requests->payment_request_id->FldCaption() ?></td>
		<td<?php echo $New_Payment_Requests->payment_request_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_payment_request_id" id="z_payment_request_id" value="="></span></td>
		<td<?php echo $New_Payment_Requests->payment_request_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_payment_request_id" id="x_payment_request_id" title="<?php echo $New_Payment_Requests->payment_request_id->FldTitle() ?>" size="30" value="<?php echo $New_Payment_Requests->payment_request_id->EditValue ?>"<?php echo $New_Payment_Requests->payment_request_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $New_Payment_Requests->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $New_Payment_Requests->year->FldCaption() ?></td>
		<td<?php echo $New_Payment_Requests->year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_year" id="z_year" value="="></span></td>
		<td<?php echo $New_Payment_Requests->year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_year" id="x_year" title="<?php echo $New_Payment_Requests->year->FldTitle() ?>" size="30" value="<?php echo $New_Payment_Requests->year->EditValue ?>"<?php echo $New_Payment_Requests->year->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $New_Payment_Requests->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $New_Payment_Requests->request_date->FldCaption() ?></td>
		<td<?php echo $New_Payment_Requests->request_date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_request_date" id="z_request_date" value="="></span></td>
		<td<?php echo $New_Payment_Requests->request_date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_request_date" id="x_request_date" title="<?php echo $New_Payment_Requests->request_date->FldTitle() ?>" value="<?php echo $New_Payment_Requests->request_date->EditValue ?>"<?php echo $New_Payment_Requests->request_date->EditAttributes() ?>>
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
	<tr<?php echo $New_Payment_Requests->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $New_Payment_Requests->programarea_id->FldCaption() ?></td>
		<td<?php echo $New_Payment_Requests->programarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_id" id="z_programarea_id" value="="></span></td>
		<td<?php echo $New_Payment_Requests->programarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_id" name="x_programarea_id" title="<?php echo $New_Payment_Requests->programarea_id->FldTitle() ?>"<?php echo $New_Payment_Requests->programarea_id->EditAttributes() ?>>
<?php
if (is_array($New_Payment_Requests->programarea_id->EditValue)) {
	$arwrk = $New_Payment_Requests->programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($New_Payment_Requests->programarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $New_Payment_Requests->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $New_Payment_Requests->request_status->FldCaption() ?></td>
		<td<?php echo $New_Payment_Requests->request_status->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_request_status" id="z_request_status" value="="></span></td>
		<td<?php echo $New_Payment_Requests->request_status->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_request_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $New_Payment_Requests->request_status->FldTitle() ?>" value="{value}"<?php echo $New_Payment_Requests->request_status->EditAttributes() ?>></label></div>
<div id="dsl_x_request_status" repeatcolumn="5">
<?php
$arwrk = $New_Payment_Requests->request_status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($New_Payment_Requests->request_status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_request_status" id="x_request_status" title="<?php echo $New_Payment_Requests->request_status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $New_Payment_Requests->request_status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
	<tr<?php echo $New_Payment_Requests->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $New_Payment_Requests->code->FldCaption() ?></td>
		<td<?php echo $New_Payment_Requests->code->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_code" id="z_code" value="LIKE"></span></td>
		<td<?php echo $New_Payment_Requests->code->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_code" id="x_code" title="<?php echo $New_Payment_Requests->code->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $New_Payment_Requests->code->EditValue ?>"<?php echo $New_Payment_Requests->code->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $New_Payment_Requests->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $New_Payment_Requests->group_id->FldCaption() ?></td>
		<td<?php echo $New_Payment_Requests->group_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_group_id" id="z_group_id" value="="></span></td>
		<td<?php echo $New_Payment_Requests->group_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $New_Payment_Requests->group_id->FldTitle() ?>"<?php echo $New_Payment_Requests->group_id->EditAttributes() ?>>
<?php
if (is_array($New_Payment_Requests->group_id->EditValue)) {
	$arwrk = $New_Payment_Requests->group_id->EditValue;
	if ($arwrk[0][0] <> "") echo "<option value=\"\">" . $Language->Phrase("PleaseSelect") . "</option>";
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($New_Payment_Requests->group_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="text" name="x_group_id" id="x_group_id" title="<?php echo $New_Payment_Requests->group_id->FldTitle() ?>" size="30" value="<?php echo $New_Payment_Requests->group_id->EditValue ?>"<?php echo $New_Payment_Requests->group_id->EditAttributes() ?>>
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
$New_Payment_Requests_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cNew_Payment_Requests_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'New_Payment_Requests';

	// Page object name
	var $PageObjName = 'New_Payment_Requests_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $New_Payment_Requests;
		if ($New_Payment_Requests->UseTokenInUrl) $PageUrl .= "t=" . $New_Payment_Requests->TableVar . "&"; // Add page token
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
		global $objForm, $New_Payment_Requests;
		if ($New_Payment_Requests->UseTokenInUrl) {
			if ($objForm)
				return ($New_Payment_Requests->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($New_Payment_Requests->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cNew_Payment_Requests_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (New_Payment_Requests)
		$GLOBALS["New_Payment_Requests"] = new cNew_Payment_Requests();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'New_Payment_Requests', TRUE);

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
		global $New_Payment_Requests;

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
			$this->Page_Terminate("New_Payment_Requestslist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("New_Payment_Requestslist.php");
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
		global $objForm, $Language, $gsSearchError, $New_Payment_Requests;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$New_Payment_Requests->CurrentAction = $objForm->GetValue("a_search");
			switch ($New_Payment_Requests->CurrentAction) {
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
						$sSrchStr = $New_Payment_Requests->UrlParm($sSrchStr);
						$this->Page_Terminate("New_Payment_Requestslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$New_Payment_Requests->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $New_Payment_Requests;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $New_Payment_Requests->payment_request_id); // payment_request_id
	$this->BuildSearchUrl($sSrchUrl, $New_Payment_Requests->year); // year
	$this->BuildSearchUrl($sSrchUrl, $New_Payment_Requests->request_date); // request_date
	$this->BuildSearchUrl($sSrchUrl, $New_Payment_Requests->programarea_id); // programarea_id
	$this->BuildSearchUrl($sSrchUrl, $New_Payment_Requests->request_status); // request_status
	$this->BuildSearchUrl($sSrchUrl, $New_Payment_Requests->code); // code
	$this->BuildSearchUrl($sSrchUrl, $New_Payment_Requests->group_id); // group_id
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
		global $objForm, $New_Payment_Requests;

		// Load search values
		// payment_request_id

		$New_Payment_Requests->payment_request_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_payment_request_id"));
		$New_Payment_Requests->payment_request_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_payment_request_id");

		// year
		$New_Payment_Requests->year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_year"));
		$New_Payment_Requests->year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_year");

		// request_date
		$New_Payment_Requests->request_date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_request_date"));
		$New_Payment_Requests->request_date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_request_date");

		// programarea_id
		$New_Payment_Requests->programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_id"));
		$New_Payment_Requests->programarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_id");

		// request_status
		$New_Payment_Requests->request_status->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_request_status"));
		$New_Payment_Requests->request_status->AdvancedSearch->SearchOperator = $objForm->GetValue("z_request_status");

		// code
		$New_Payment_Requests->code->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_code"));
		$New_Payment_Requests->code->AdvancedSearch->SearchOperator = $objForm->GetValue("z_code");

		// group_id
		$New_Payment_Requests->group_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_group_id"));
		$New_Payment_Requests->group_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_group_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $New_Payment_Requests;

		// Initialize URLs
		// Call Row_Rendering event

		$New_Payment_Requests->Row_Rendering();

		// Common render codes for all row types
		// payment_request_id

		$New_Payment_Requests->payment_request_id->CellCssStyle = ""; $New_Payment_Requests->payment_request_id->CellCssClass = "";
		$New_Payment_Requests->payment_request_id->CellAttrs = array(); $New_Payment_Requests->payment_request_id->ViewAttrs = array(); $New_Payment_Requests->payment_request_id->EditAttrs = array();

		// year
		$New_Payment_Requests->year->CellCssStyle = ""; $New_Payment_Requests->year->CellCssClass = "";
		$New_Payment_Requests->year->CellAttrs = array(); $New_Payment_Requests->year->ViewAttrs = array(); $New_Payment_Requests->year->EditAttrs = array();

		// request_date
		$New_Payment_Requests->request_date->CellCssStyle = ""; $New_Payment_Requests->request_date->CellCssClass = "";
		$New_Payment_Requests->request_date->CellAttrs = array(); $New_Payment_Requests->request_date->ViewAttrs = array(); $New_Payment_Requests->request_date->EditAttrs = array();

		// programarea_id
		$New_Payment_Requests->programarea_id->CellCssStyle = ""; $New_Payment_Requests->programarea_id->CellCssClass = "";
		$New_Payment_Requests->programarea_id->CellAttrs = array(); $New_Payment_Requests->programarea_id->ViewAttrs = array(); $New_Payment_Requests->programarea_id->EditAttrs = array();

		// request_status
		$New_Payment_Requests->request_status->CellCssStyle = ""; $New_Payment_Requests->request_status->CellCssClass = "";
		$New_Payment_Requests->request_status->CellAttrs = array(); $New_Payment_Requests->request_status->ViewAttrs = array(); $New_Payment_Requests->request_status->EditAttrs = array();

		// code
		$New_Payment_Requests->code->CellCssStyle = ""; $New_Payment_Requests->code->CellCssClass = "";
		$New_Payment_Requests->code->CellAttrs = array(); $New_Payment_Requests->code->ViewAttrs = array(); $New_Payment_Requests->code->EditAttrs = array();

		// group_id
		$New_Payment_Requests->group_id->CellCssStyle = ""; $New_Payment_Requests->group_id->CellCssClass = "";
		$New_Payment_Requests->group_id->CellAttrs = array(); $New_Payment_Requests->group_id->ViewAttrs = array(); $New_Payment_Requests->group_id->EditAttrs = array();
		if ($New_Payment_Requests->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_request_id
			$New_Payment_Requests->payment_request_id->ViewValue = $New_Payment_Requests->payment_request_id->CurrentValue;
			$New_Payment_Requests->payment_request_id->CssStyle = "";
			$New_Payment_Requests->payment_request_id->CssClass = "";
			$New_Payment_Requests->payment_request_id->ViewCustomAttributes = "";

			// year
			$New_Payment_Requests->year->ViewValue = $New_Payment_Requests->year->CurrentValue;
			$New_Payment_Requests->year->CssStyle = "";
			$New_Payment_Requests->year->CssClass = "";
			$New_Payment_Requests->year->ViewCustomAttributes = "";

			// request_date
			$New_Payment_Requests->request_date->ViewValue = $New_Payment_Requests->request_date->CurrentValue;
			$New_Payment_Requests->request_date->ViewValue = ew_FormatDateTime($New_Payment_Requests->request_date->ViewValue, 7);
			$New_Payment_Requests->request_date->CssStyle = "";
			$New_Payment_Requests->request_date->CssClass = "";
			$New_Payment_Requests->request_date->ViewCustomAttributes = "";

			// programarea_id
			if (strval($New_Payment_Requests->programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($New_Payment_Requests->programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$New_Payment_Requests->programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$New_Payment_Requests->programarea_id->ViewValue = $New_Payment_Requests->programarea_id->CurrentValue;
				}
			} else {
				$New_Payment_Requests->programarea_id->ViewValue = NULL;
			}
			$New_Payment_Requests->programarea_id->CssStyle = "";
			$New_Payment_Requests->programarea_id->CssClass = "";
			$New_Payment_Requests->programarea_id->ViewCustomAttributes = "";

			// request_status
			if (strval($New_Payment_Requests->request_status->CurrentValue) <> "") {
				switch ($New_Payment_Requests->request_status->CurrentValue) {
					case "NEWREQ":
						$New_Payment_Requests->request_status->ViewValue = "NEWREQ";
						break;
					case "REQUESTED":
						$New_Payment_Requests->request_status->ViewValue = "REQUESTED";
						break;
					case "DISBURSED":
						$New_Payment_Requests->request_status->ViewValue = "DISBURSED";
						break;
					case "LIQUIDATED":
						$New_Payment_Requests->request_status->ViewValue = "LIQUIDATED";
						break;
					default:
						$New_Payment_Requests->request_status->ViewValue = $New_Payment_Requests->request_status->CurrentValue;
				}
			} else {
				$New_Payment_Requests->request_status->ViewValue = NULL;
			}
			$New_Payment_Requests->request_status->CssStyle = "";
			$New_Payment_Requests->request_status->CssClass = "";
			$New_Payment_Requests->request_status->ViewCustomAttributes = "";

			// code
			$New_Payment_Requests->code->ViewValue = $New_Payment_Requests->code->CurrentValue;
			$New_Payment_Requests->code->CssStyle = "";
			$New_Payment_Requests->code->CssClass = "";
			$New_Payment_Requests->code->ViewCustomAttributes = "";

			// group_id
			$New_Payment_Requests->group_id->ViewValue = $New_Payment_Requests->group_id->CurrentValue;
			$New_Payment_Requests->group_id->CssStyle = "";
			$New_Payment_Requests->group_id->CssClass = "";
			$New_Payment_Requests->group_id->ViewCustomAttributes = "";

			// payment_request_id
			$New_Payment_Requests->payment_request_id->HrefValue = "";
			$New_Payment_Requests->payment_request_id->TooltipValue = "";

			// year
			$New_Payment_Requests->year->HrefValue = "";
			$New_Payment_Requests->year->TooltipValue = "";

			// request_date
			$New_Payment_Requests->request_date->HrefValue = "";
			$New_Payment_Requests->request_date->TooltipValue = "";

			// programarea_id
			$New_Payment_Requests->programarea_id->HrefValue = "";
			$New_Payment_Requests->programarea_id->TooltipValue = "";

			// request_status
			$New_Payment_Requests->request_status->HrefValue = "";
			$New_Payment_Requests->request_status->TooltipValue = "";

			// code
			$New_Payment_Requests->code->HrefValue = "";
			$New_Payment_Requests->code->TooltipValue = "";

			// group_id
			$New_Payment_Requests->group_id->HrefValue = "";
			$New_Payment_Requests->group_id->TooltipValue = "";
		} elseif ($New_Payment_Requests->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// payment_request_id
			$New_Payment_Requests->payment_request_id->EditCustomAttributes = "";
			$New_Payment_Requests->payment_request_id->EditValue = ew_HtmlEncode($New_Payment_Requests->payment_request_id->AdvancedSearch->SearchValue);

			// year
			$New_Payment_Requests->year->EditCustomAttributes = "";
			$New_Payment_Requests->year->EditValue = ew_HtmlEncode($New_Payment_Requests->year->AdvancedSearch->SearchValue);

			// request_date
			$New_Payment_Requests->request_date->EditCustomAttributes = "";
			$New_Payment_Requests->request_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($New_Payment_Requests->request_date->AdvancedSearch->SearchValue, 7), 7));

			// programarea_id
			$New_Payment_Requests->programarea_id->EditCustomAttributes = "";
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
			$New_Payment_Requests->programarea_id->EditValue = $arwrk;

			// request_status
			$New_Payment_Requests->request_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("NEWREQ", "NEWREQ");
			$arwrk[] = array("REQUESTED", "REQUESTED");
			$arwrk[] = array("DISBURSED", "DISBURSED");
			$arwrk[] = array("LIQUIDATED", "LIQUIDATED");
			$New_Payment_Requests->request_status->EditValue = $arwrk;

			// code
			$New_Payment_Requests->code->EditCustomAttributes = "";
			$New_Payment_Requests->code->EditValue = ew_HtmlEncode($New_Payment_Requests->code->AdvancedSearch->SearchValue);

			// group_id
			$New_Payment_Requests->group_id->EditCustomAttributes = "";
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
			$New_Payment_Requests->group_id->EditValue = $arwrk;
			} else {
			$New_Payment_Requests->group_id->EditValue = ew_HtmlEncode($New_Payment_Requests->group_id->AdvancedSearch->SearchValue);
			}
		}

		// Call Row Rendered event
		if ($New_Payment_Requests->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$New_Payment_Requests->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $New_Payment_Requests;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($New_Payment_Requests->payment_request_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $New_Payment_Requests->payment_request_id->FldErrMsg();
		}
		if (!ew_CheckInteger($New_Payment_Requests->year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $New_Payment_Requests->year->FldErrMsg();
		}
		if (!ew_CheckEuroDate($New_Payment_Requests->request_date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $New_Payment_Requests->request_date->FldErrMsg();
		}
		if (!ew_CheckInteger($New_Payment_Requests->group_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $New_Payment_Requests->group_id->FldErrMsg();
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
		global $New_Payment_Requests;
		$New_Payment_Requests->payment_request_id->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_payment_request_id");
		$New_Payment_Requests->year->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_year");
		$New_Payment_Requests->request_date->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_request_date");
		$New_Payment_Requests->programarea_id->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_programarea_id");
		$New_Payment_Requests->request_status->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_request_status");
		$New_Payment_Requests->code->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_code");
		$New_Payment_Requests->group_id->AdvancedSearch->SearchValue = $New_Payment_Requests->getAdvancedSearch("x_group_id");
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
