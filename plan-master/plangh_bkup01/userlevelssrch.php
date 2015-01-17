<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "userlevelsinfo.php" ?>
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
$userlevels_search = new cuserlevels_search();
$Page =& $userlevels_search;

// Page init
$userlevels_search->Page_Init();

// Page main
$userlevels_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var userlevels_search = new ew_Page("userlevels_search");

// page properties
userlevels_search.PageID = "search"; // page ID
userlevels_search.FormID = "fuserlevelssearch"; // form ID
var EW_PAGE_ID = userlevels_search.PageID; // for backward compatibility

// extend page with validate function for search
userlevels_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_userlevelid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($userlevels->userlevelid->FldErrMsg()) ?>");

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
userlevels_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
userlevels_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
userlevels_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $userlevels->TableCaption() ?><br><br>
<a href="<?php echo $userlevels->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$userlevels_search->ShowMessage();
?>
<form name="fuserlevelssearch" id="fuserlevelssearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return userlevels_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="userlevels">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $userlevels->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $userlevels->userlevelid->FldCaption() ?></td>
		<td<?php echo $userlevels->userlevelid->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_userlevelid" id="z_userlevelid" value="="></span></td>
		<td<?php echo $userlevels->userlevelid->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_userlevelid" id="x_userlevelid" title="<?php echo $userlevels->userlevelid->FldTitle() ?>" size="30" value="<?php echo $userlevels->userlevelid->EditValue ?>"<?php echo $userlevels->userlevelid->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $userlevels->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $userlevels->userlevelname->FldCaption() ?></td>
		<td<?php echo $userlevels->userlevelname->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_userlevelname" id="z_userlevelname" value="LIKE"></span></td>
		<td<?php echo $userlevels->userlevelname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_userlevelname" id="x_userlevelname" title="<?php echo $userlevels->userlevelname->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $userlevels->userlevelname->EditValue ?>"<?php echo $userlevels->userlevelname->EditAttributes() ?>>
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
$userlevels_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cuserlevels_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'userlevels';

	// Page object name
	var $PageObjName = 'userlevels_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $userlevels;
		if ($userlevels->UseTokenInUrl) $PageUrl .= "t=" . $userlevels->TableVar . "&"; // Add page token
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
		global $objForm, $userlevels;
		if ($userlevels->UseTokenInUrl) {
			if ($objForm)
				return ($userlevels->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($userlevels->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cuserlevels_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (userlevels)
		$GLOBALS["userlevels"] = new cuserlevels();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'userlevels', TRUE);

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
		global $userlevels;

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
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
		global $objForm, $Language, $gsSearchError, $userlevels;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$userlevels->CurrentAction = $objForm->GetValue("a_search");
			switch ($userlevels->CurrentAction) {
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
						$sSrchStr = $userlevels->UrlParm($sSrchStr);
						$this->Page_Terminate("userlevelslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$userlevels->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $userlevels;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $userlevels->userlevelid); // userlevelid
	$this->BuildSearchUrl($sSrchUrl, $userlevels->userlevelname); // userlevelname
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
		global $objForm, $userlevels;

		// Load search values
		// userlevelid

		$userlevels->userlevelid->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_userlevelid"));
		$userlevels->userlevelid->AdvancedSearch->SearchOperator = $objForm->GetValue("z_userlevelid");

		// userlevelname
		$userlevels->userlevelname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_userlevelname"));
		$userlevels->userlevelname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_userlevelname");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $userlevels;

		// Initialize URLs
		// Call Row_Rendering event

		$userlevels->Row_Rendering();

		// Common render codes for all row types
		// userlevelid

		$userlevels->userlevelid->CellCssStyle = ""; $userlevels->userlevelid->CellCssClass = "";
		$userlevels->userlevelid->CellAttrs = array(); $userlevels->userlevelid->ViewAttrs = array(); $userlevels->userlevelid->EditAttrs = array();

		// userlevelname
		$userlevels->userlevelname->CellCssStyle = ""; $userlevels->userlevelname->CellCssClass = "";
		$userlevels->userlevelname->CellAttrs = array(); $userlevels->userlevelname->ViewAttrs = array(); $userlevels->userlevelname->EditAttrs = array();
		if ($userlevels->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			$userlevels->userlevelid->ViewValue = $userlevels->userlevelid->CurrentValue;
			$userlevels->userlevelid->CssStyle = "";
			$userlevels->userlevelid->CssClass = "";
			$userlevels->userlevelid->ViewCustomAttributes = "";

			// userlevelname
			$userlevels->userlevelname->ViewValue = $userlevels->userlevelname->CurrentValue;
			$userlevels->userlevelname->CssStyle = "";
			$userlevels->userlevelname->CssClass = "";
			$userlevels->userlevelname->ViewCustomAttributes = "";

			// userlevelid
			$userlevels->userlevelid->HrefValue = "";
			$userlevels->userlevelid->TooltipValue = "";

			// userlevelname
			$userlevels->userlevelname->HrefValue = "";
			$userlevels->userlevelname->TooltipValue = "";
		} elseif ($userlevels->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// userlevelid
			$userlevels->userlevelid->EditCustomAttributes = "";
			$userlevels->userlevelid->EditValue = ew_HtmlEncode($userlevels->userlevelid->AdvancedSearch->SearchValue);

			// userlevelname
			$userlevels->userlevelname->EditCustomAttributes = "";
			$userlevels->userlevelname->EditValue = ew_HtmlEncode($userlevels->userlevelname->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($userlevels->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$userlevels->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $userlevels;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($userlevels->userlevelid->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $userlevels->userlevelid->FldErrMsg();
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
		global $userlevels;
		$userlevels->userlevelid->AdvancedSearch->SearchValue = $userlevels->getAdvancedSearch("x_userlevelid");
		$userlevels->userlevelname->AdvancedSearch->SearchValue = $userlevels->getAdvancedSearch("x_userlevelname");
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
