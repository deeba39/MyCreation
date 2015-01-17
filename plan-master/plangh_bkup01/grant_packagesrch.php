<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "grant_packageinfo.php" ?>
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
$grant_package_search = new cgrant_package_search();
$Page =& $grant_package_search;

// Page init
$grant_package_search->Page_Init();

// Page main
$grant_package_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var grant_package_search = new ew_Page("grant_package_search");

// page properties
grant_package_search.PageID = "search"; // page ID
grant_package_search.FormID = "fgrant_packagesearch"; // form ID
var EW_PAGE_ID = grant_package_search.PageID; // for backward compatibility

// extend page with validate function for search
grant_package_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_annual_amount"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($grant_package->annual_amount->FldErrMsg()) ?>");

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
grant_package_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
grant_package_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
grant_package_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $grant_package->TableCaption() ?><br><br>
<a href="<?php echo $grant_package->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$grant_package_search->ShowMessage();
?>
<form name="fgrant_packagesearch" id="fgrant_packagesearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return grant_package_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="grant_package">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $grant_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grant_package->name->FldCaption() ?></td>
		<td<?php echo $grant_package->name->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_name" id="z_name" value="LIKE"></span></td>
		<td<?php echo $grant_package->name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_name" id="x_name" title="<?php echo $grant_package->name->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $grant_package->name->EditValue ?>"<?php echo $grant_package->name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $grant_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grant_package->code->FldCaption() ?></td>
		<td<?php echo $grant_package->code->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_code" id="z_code" value="LIKE"></span></td>
		<td<?php echo $grant_package->code->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_code" id="x_code" title="<?php echo $grant_package->code->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $grant_package->code->EditValue ?>"<?php echo $grant_package->code->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $grant_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $grant_package->annual_amount->FldCaption() ?></td>
		<td<?php echo $grant_package->annual_amount->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_annual_amount" id="z_annual_amount" onchange="ew_SrchOprChanged('z_annual_amount')"><option value="="<?php echo ($grant_package->annual_amount->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($grant_package->annual_amount->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($grant_package->annual_amount->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($grant_package->annual_amount->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($grant_package->annual_amount->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($grant_package->annual_amount->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="BETWEEN"<?php echo ($grant_package->annual_amount->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $grant_package->annual_amount->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_annual_amount" id="x_annual_amount" title="<?php echo $grant_package->annual_amount->FldTitle() ?>" size="30" value="<?php echo $grant_package->annual_amount->EditValue ?>"<?php echo $grant_package->annual_amount->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_annual_amount" name="btw1_annual_amount">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_annual_amount" name="btw1_annual_amount">
<input type="text" name="y_annual_amount" id="y_annual_amount" title="<?php echo $grant_package->annual_amount->FldTitle() ?>" size="30" value="<?php echo $grant_package->annual_amount->EditValue2 ?>"<?php echo $grant_package->annual_amount->EditAttributes() ?>>
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
ew_SrchOprChanged('z_annual_amount');

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$grant_package_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cgrant_package_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'grant_package';

	// Page object name
	var $PageObjName = 'grant_package_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $grant_package;
		if ($grant_package->UseTokenInUrl) $PageUrl .= "t=" . $grant_package->TableVar . "&"; // Add page token
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
		global $objForm, $grant_package;
		if ($grant_package->UseTokenInUrl) {
			if ($objForm)
				return ($grant_package->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($grant_package->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgrant_package_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (grant_package)
		$GLOBALS["grant_package"] = new cgrant_package();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'grant_package', TRUE);

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
		global $grant_package;

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
			$this->Page_Terminate("grant_packagelist.php");
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $grant_package;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$grant_package->CurrentAction = $objForm->GetValue("a_search");
			switch ($grant_package->CurrentAction) {
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
						$sSrchStr = $grant_package->UrlParm($sSrchStr);
						$this->Page_Terminate("grant_packagelist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$grant_package->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $grant_package;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $grant_package->name); // name
	$this->BuildSearchUrl($sSrchUrl, $grant_package->code); // code
	$this->BuildSearchUrl($sSrchUrl, $grant_package->annual_amount); // annual_amount
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
		global $objForm, $grant_package;

		// Load search values
		// name

		$grant_package->name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_name"));
		$grant_package->name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_name");

		// code
		$grant_package->code->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_code"));
		$grant_package->code->AdvancedSearch->SearchOperator = $objForm->GetValue("z_code");

		// annual_amount
		$grant_package->annual_amount->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_annual_amount"));
		$grant_package->annual_amount->AdvancedSearch->SearchOperator = $objForm->GetValue("z_annual_amount");
		$grant_package->annual_amount->AdvancedSearch->SearchCondition = $objForm->GetValue("v_annual_amount");
		$grant_package->annual_amount->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_annual_amount"));
		$grant_package->annual_amount->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_annual_amount");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $grant_package;

		// Initialize URLs
		// Call Row_Rendering event

		$grant_package->Row_Rendering();

		// Common render codes for all row types
		// name

		$grant_package->name->CellCssStyle = ""; $grant_package->name->CellCssClass = "";
		$grant_package->name->CellAttrs = array(); $grant_package->name->ViewAttrs = array(); $grant_package->name->EditAttrs = array();

		// code
		$grant_package->code->CellCssStyle = ""; $grant_package->code->CellCssClass = "";
		$grant_package->code->CellAttrs = array(); $grant_package->code->ViewAttrs = array(); $grant_package->code->EditAttrs = array();

		// annual_amount
		$grant_package->annual_amount->CellCssStyle = ""; $grant_package->annual_amount->CellCssClass = "";
		$grant_package->annual_amount->CellAttrs = array(); $grant_package->annual_amount->ViewAttrs = array(); $grant_package->annual_amount->EditAttrs = array();
		if ($grant_package->RowType == EW_ROWTYPE_VIEW) { // View row

			// grant_package_id
			$grant_package->grant_package_id->ViewValue = $grant_package->grant_package_id->CurrentValue;
			$grant_package->grant_package_id->CssStyle = "";
			$grant_package->grant_package_id->CssClass = "";
			$grant_package->grant_package_id->ViewCustomAttributes = "";

			// name
			$grant_package->name->ViewValue = $grant_package->name->CurrentValue;
			$grant_package->name->CssStyle = "";
			$grant_package->name->CssClass = "";
			$grant_package->name->ViewCustomAttributes = "";

			// code
			$grant_package->code->ViewValue = $grant_package->code->CurrentValue;
			$grant_package->code->CssStyle = "";
			$grant_package->code->CssClass = "";
			$grant_package->code->ViewCustomAttributes = "";

			// annual_amount
			$grant_package->annual_amount->ViewValue = $grant_package->annual_amount->CurrentValue;
			$grant_package->annual_amount->CssStyle = "";
			$grant_package->annual_amount->CssClass = "";
			$grant_package->annual_amount->ViewCustomAttributes = "";

			// name
			$grant_package->name->HrefValue = "";
			$grant_package->name->TooltipValue = "";

			// code
			$grant_package->code->HrefValue = "";
			$grant_package->code->TooltipValue = "";

			// annual_amount
			$grant_package->annual_amount->HrefValue = "";
			$grant_package->annual_amount->TooltipValue = "";
		} elseif ($grant_package->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// name
			$grant_package->name->EditCustomAttributes = "";
			$grant_package->name->EditValue = ew_HtmlEncode($grant_package->name->AdvancedSearch->SearchValue);

			// code
			$grant_package->code->EditCustomAttributes = "";
			$grant_package->code->EditValue = ew_HtmlEncode($grant_package->code->AdvancedSearch->SearchValue);

			// annual_amount
			$grant_package->annual_amount->EditCustomAttributes = "";
			$grant_package->annual_amount->EditValue = ew_HtmlEncode($grant_package->annual_amount->AdvancedSearch->SearchValue);
			$grant_package->annual_amount->EditCustomAttributes = "";
			$grant_package->annual_amount->EditValue2 = ew_HtmlEncode($grant_package->annual_amount->AdvancedSearch->SearchValue2);
		}

		// Call Row Rendered event
		if ($grant_package->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$grant_package->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $grant_package;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckNumber($grant_package->annual_amount->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $grant_package->annual_amount->FldErrMsg();
		}
		if (!ew_CheckNumber($grant_package->annual_amount->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $grant_package->annual_amount->FldErrMsg();
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
		global $grant_package;
		$grant_package->name->AdvancedSearch->SearchValue = $grant_package->getAdvancedSearch("x_name");
		$grant_package->code->AdvancedSearch->SearchValue = $grant_package->getAdvancedSearch("x_code");
		$grant_package->annual_amount->AdvancedSearch->SearchValue = $grant_package->getAdvancedSearch("x_annual_amount");
		$grant_package->annual_amount->AdvancedSearch->SearchOperator = $grant_package->getAdvancedSearch("z_annual_amount");
		$grant_package->annual_amount->AdvancedSearch->SearchValue2 = $grant_package->getAdvancedSearch("y_annual_amount");
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
