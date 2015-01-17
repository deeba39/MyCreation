<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "userlevelpermissionsinfo.php" ?>
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
$userlevelpermissions_search = new cuserlevelpermissions_search();
$Page =& $userlevelpermissions_search;

// Page init
$userlevelpermissions_search->Page_Init();

// Page main
$userlevelpermissions_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var userlevelpermissions_search = new ew_Page("userlevelpermissions_search");

// page properties
userlevelpermissions_search.PageID = "search"; // page ID
userlevelpermissions_search.FormID = "fuserlevelpermissionssearch"; // form ID
var EW_PAGE_ID = userlevelpermissions_search.PageID; // for backward compatibility

// extend page with validate function for search
userlevelpermissions_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";

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
userlevelpermissions_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
userlevelpermissions_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
userlevelpermissions_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $userlevelpermissions->TableCaption() ?><br><br>
<a href="<?php echo $userlevelpermissions->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$userlevelpermissions_search->ShowMessage();
?>
<form name="fuserlevelpermissionssearch" id="fuserlevelpermissionssearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return userlevelpermissions_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="userlevelpermissions">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $userlevelpermissions->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $userlevelpermissions->userlevelid->FldCaption() ?></td>
		<td<?php echo $userlevelpermissions->userlevelid->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_userlevelid" id="z_userlevelid" value="="></span></td>
		<td<?php echo $userlevelpermissions->userlevelid->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_userlevelid" name="x_userlevelid" title="<?php echo $userlevelpermissions->userlevelid->FldTitle() ?>"<?php echo $userlevelpermissions->userlevelid->EditAttributes() ?>>
<?php
if (is_array($userlevelpermissions->userlevelid->EditValue)) {
	$arwrk = $userlevelpermissions->userlevelid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($userlevelpermissions->userlevelid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $userlevelpermissions->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $userlevelpermissions->ztablename->FldCaption() ?></td>
		<td<?php echo $userlevelpermissions->ztablename->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_ztablename" id="z_ztablename" value="LIKE"></span></td>
		<td<?php echo $userlevelpermissions->ztablename->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ztablename" id="x_ztablename" title="<?php echo $userlevelpermissions->ztablename->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $userlevelpermissions->ztablename->EditValue ?>"<?php echo $userlevelpermissions->ztablename->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $userlevelpermissions->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $userlevelpermissions->permission->FldCaption() ?></td>
		<td<?php echo $userlevelpermissions->permission->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_permission" id="z_permission" value="="></span></td>
		<td<?php echo $userlevelpermissions->permission->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_permission" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x_permission[]" id="x_permission[]" title="<?php echo $userlevelpermissions->permission->FldTitle() ?>" value="{value}"<?php echo $userlevelpermissions->permission->EditAttributes() ?>></div>
<div id="dsl_x_permission" repeatcolumn="5">
<?php
$arwrk = $userlevelpermissions->permission->EditValue;
if (is_array($arwrk)) {
	$armultiwrk= explode(",", strval($userlevelpermissions->permission->AdvancedSearch->SearchValue));
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = "";
		for ($ari = 0; $ari < count($armultiwrk); $ari++) {
			if (strval($arwrk[$rowcntwrk][0]) == trim(strval($armultiwrk[$ari]))) {
				$selwrk = " checked=\"checked\"";
				if ($selwrk <> "") $emptywrk = FALSE;
				break;
			}
		}

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="checkbox" name="x_permission[]" id="x_permission[]" title="<?php echo $userlevelpermissions->permission->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $userlevelpermissions->permission->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
$userlevelpermissions_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cuserlevelpermissions_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'userlevelpermissions';

	// Page object name
	var $PageObjName = 'userlevelpermissions_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $userlevelpermissions;
		if ($userlevelpermissions->UseTokenInUrl) $PageUrl .= "t=" . $userlevelpermissions->TableVar . "&"; // Add page token
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
		global $objForm, $userlevelpermissions;
		if ($userlevelpermissions->UseTokenInUrl) {
			if ($objForm)
				return ($userlevelpermissions->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($userlevelpermissions->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cuserlevelpermissions_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (userlevelpermissions)
		$GLOBALS["userlevelpermissions"] = new cuserlevelpermissions();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'userlevelpermissions', TRUE);

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
		global $userlevelpermissions;

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
		global $objForm, $Language, $gsSearchError, $userlevelpermissions;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$userlevelpermissions->CurrentAction = $objForm->GetValue("a_search");
			switch ($userlevelpermissions->CurrentAction) {
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
						$sSrchStr = $userlevelpermissions->UrlParm($sSrchStr);
						$this->Page_Terminate("userlevelpermissionslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$userlevelpermissions->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $userlevelpermissions;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $userlevelpermissions->userlevelid); // userlevelid
	$this->BuildSearchUrl($sSrchUrl, $userlevelpermissions->ztablename); // tablename
	$this->BuildSearchUrl($sSrchUrl, $userlevelpermissions->permission); // permission
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
		global $objForm, $userlevelpermissions;

		// Load search values
		// userlevelid

		$userlevelpermissions->userlevelid->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_userlevelid"));
		$userlevelpermissions->userlevelid->AdvancedSearch->SearchOperator = $objForm->GetValue("z_userlevelid");

		// tablename
		$userlevelpermissions->ztablename->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ztablename"));
		$userlevelpermissions->ztablename->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ztablename");

		// permission
		$userlevelpermissions->permission->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_permission"));
		$userlevelpermissions->permission->AdvancedSearch->SearchOperator = $objForm->GetValue("z_permission");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $userlevelpermissions;

		// Initialize URLs
		// Call Row_Rendering event

		$userlevelpermissions->Row_Rendering();

		// Common render codes for all row types
		// userlevelid

		$userlevelpermissions->userlevelid->CellCssStyle = ""; $userlevelpermissions->userlevelid->CellCssClass = "";
		$userlevelpermissions->userlevelid->CellAttrs = array(); $userlevelpermissions->userlevelid->ViewAttrs = array(); $userlevelpermissions->userlevelid->EditAttrs = array();

		// tablename
		$userlevelpermissions->ztablename->CellCssStyle = ""; $userlevelpermissions->ztablename->CellCssClass = "";
		$userlevelpermissions->ztablename->CellAttrs = array(); $userlevelpermissions->ztablename->ViewAttrs = array(); $userlevelpermissions->ztablename->EditAttrs = array();

		// permission
		$userlevelpermissions->permission->CellCssStyle = ""; $userlevelpermissions->permission->CellCssClass = "";
		$userlevelpermissions->permission->CellAttrs = array(); $userlevelpermissions->permission->ViewAttrs = array(); $userlevelpermissions->permission->EditAttrs = array();
		if ($userlevelpermissions->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			if (strval($userlevelpermissions->userlevelid->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($userlevelpermissions->userlevelid->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$userlevelpermissions->userlevelid->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$userlevelpermissions->userlevelid->ViewValue = $userlevelpermissions->userlevelid->CurrentValue;
				}
			} else {
				$userlevelpermissions->userlevelid->ViewValue = NULL;
			}
			$userlevelpermissions->userlevelid->CssStyle = "";
			$userlevelpermissions->userlevelid->CssClass = "";
			$userlevelpermissions->userlevelid->ViewCustomAttributes = "";

			// tablename
			$userlevelpermissions->ztablename->ViewValue = $userlevelpermissions->ztablename->CurrentValue;
			$userlevelpermissions->ztablename->CssStyle = "";
			$userlevelpermissions->ztablename->CssClass = "";
			$userlevelpermissions->ztablename->ViewCustomAttributes = "";

			// permission
			$userlevelpermissions->permission->CssStyle = "";
			$userlevelpermissions->permission->CssClass = "";
			$userlevelpermissions->permission->ViewCustomAttributes = "";

			// userlevelid
			$userlevelpermissions->userlevelid->HrefValue = "";
			$userlevelpermissions->userlevelid->TooltipValue = "";

			// tablename
			$userlevelpermissions->ztablename->HrefValue = "";
			$userlevelpermissions->ztablename->TooltipValue = "";

			// permission
			$userlevelpermissions->permission->HrefValue = "";
			$userlevelpermissions->permission->TooltipValue = "";
		} elseif ($userlevelpermissions->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// userlevelid
			$userlevelpermissions->userlevelid->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `userlevelid`, `userlevelname`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `userlevels`";
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
			$userlevelpermissions->userlevelid->EditValue = $arwrk;

			// tablename
			$userlevelpermissions->ztablename->EditCustomAttributes = "";
			$userlevelpermissions->ztablename->EditValue = ew_HtmlEncode($userlevelpermissions->ztablename->AdvancedSearch->SearchValue);

			// permission
			$userlevelpermissions->permission->EditCustomAttributes = "";
		}

		// Call Row Rendered event
		if ($userlevelpermissions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$userlevelpermissions->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $userlevelpermissions;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

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
		global $userlevelpermissions;
		$userlevelpermissions->userlevelid->AdvancedSearch->SearchValue = $userlevelpermissions->getAdvancedSearch("x_userlevelid");
		$userlevelpermissions->ztablename->AdvancedSearch->SearchValue = $userlevelpermissions->getAdvancedSearch("x_ztablename");
		$userlevelpermissions->permission->AdvancedSearch->SearchValue = $userlevelpermissions->getAdvancedSearch("x_permission");
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
