<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "communityinfo.php" ?>
<?php include "districtsinfo.php" ?>
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
$community_search = new ccommunity_search();
$Page =& $community_search;

// Page init
$community_search->Page_Init();

// Page main
$community_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var community_search = new ew_Page("community_search");

// page properties
community_search.PageID = "search"; // page ID
community_search.FormID = "fcommunitysearch"; // form ID
var EW_PAGE_ID = community_search.PageID; // for backward compatibility

// extend page with validate function for search
community_search.ValidateSearch = function(fobj) {
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
community_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
community_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
community_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $community->TableCaption() ?><br><br>
<a href="<?php echo $community->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$community_search->ShowMessage();
?>
<form name="fcommunitysearch" id="fcommunitysearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return community_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="community">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->community_1->FldCaption() ?></td>
		<td<?php echo $community->community_1->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_community_1" id="z_community_1" value="LIKE"></span></td>
		<td<?php echo $community->community_1->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_community_1" id="x_community_1" title="<?php echo $community->community_1->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $community->community_1->EditValue ?>"<?php echo $community->community_1->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->programarea_programarea_id->FldCaption() ?></td>
		<td<?php echo $community->programarea_programarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_programarea_id" id="z_programarea_programarea_id" value="="></span></td>
		<td<?php echo $community->programarea_programarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_programarea_id" name="x_programarea_programarea_id" title="<?php echo $community->programarea_programarea_id->FldTitle() ?>"<?php echo $community->programarea_programarea_id->EditAttributes() ?>>
<?php
if (is_array($community->programarea_programarea_id->EditValue)) {
	$arwrk = $community->programarea_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($community->programarea_programarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->community_category_community_category_id->FldCaption() ?></td>
		<td<?php echo $community->community_category_community_category_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_community_category_community_category_id" id="z_community_category_community_category_id" value="="></span></td>
		<td<?php echo $community->community_category_community_category_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_community_category_community_category_id" name="x_community_category_community_category_id" title="<?php echo $community->community_category_community_category_id->FldTitle() ?>"<?php echo $community->community_category_community_category_id->EditAttributes() ?>>
<?php
if (is_array($community->community_category_community_category_id->EditValue)) {
	$arwrk = $community->community_category_community_category_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($community->community_category_community_category_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $community->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $community->community_districts_DistrictID->FldCaption() ?></td>
		<td<?php echo $community->community_districts_DistrictID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_community_districts_DistrictID" id="z_community_districts_DistrictID" value="="></span></td>
		<td<?php echo $community->community_districts_DistrictID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_community_districts_DistrictID" name="x_community_districts_DistrictID" title="<?php echo $community->community_districts_DistrictID->FldTitle() ?>"<?php echo $community->community_districts_DistrictID->EditAttributes() ?>>
<?php
if (is_array($community->community_districts_DistrictID->EditValue)) {
	$arwrk = $community->community_districts_DistrictID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($community->community_districts_DistrictID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
$community_search->Page_Terminate();
?>
<?php

//
// Page class
//
class ccommunity_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'community';

	// Page object name
	var $PageObjName = 'community_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $community;
		if ($community->UseTokenInUrl) $PageUrl .= "t=" . $community->TableVar . "&"; // Add page token
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
		global $objForm, $community;
		if ($community->UseTokenInUrl) {
			if ($objForm)
				return ($community->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($community->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccommunity_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (community)
		$GLOBALS["community"] = new ccommunity();

		// Table object (districts)
		$GLOBALS['districts'] = new cdistricts();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'community', TRUE);

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
		global $community;

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
			$this->Page_Terminate("communitylist.php");
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
		global $objForm, $Language, $gsSearchError, $community;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$community->CurrentAction = $objForm->GetValue("a_search");
			switch ($community->CurrentAction) {
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
						$sSrchStr = $community->UrlParm($sSrchStr);
						$this->Page_Terminate("communitylist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$community->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $community;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $community->community_1); // community
	$this->BuildSearchUrl($sSrchUrl, $community->programarea_programarea_id); // programarea_programarea_id
	$this->BuildSearchUrl($sSrchUrl, $community->community_category_community_category_id); // community_category_community_category_id
	$this->BuildSearchUrl($sSrchUrl, $community->community_districts_DistrictID); // community_districts_DistrictID
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
		global $objForm, $community;

		// Load search values
		// community

		$community->community_1->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_community_1"));
		$community->community_1->AdvancedSearch->SearchOperator = $objForm->GetValue("z_community_1");

		// programarea_programarea_id
		$community->programarea_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_programarea_id"));
		$community->programarea_programarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_programarea_id");

		// community_category_community_category_id
		$community->community_category_community_category_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_community_category_community_category_id"));
		$community->community_category_community_category_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_community_category_community_category_id");

		// community_districts_DistrictID
		$community->community_districts_DistrictID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_community_districts_DistrictID"));
		$community->community_districts_DistrictID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_community_districts_DistrictID");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $community;

		// Initialize URLs
		// Call Row_Rendering event

		$community->Row_Rendering();

		// Common render codes for all row types
		// community

		$community->community_1->CellCssStyle = ""; $community->community_1->CellCssClass = "";
		$community->community_1->CellAttrs = array(); $community->community_1->ViewAttrs = array(); $community->community_1->EditAttrs = array();

		// programarea_programarea_id
		$community->programarea_programarea_id->CellCssStyle = ""; $community->programarea_programarea_id->CellCssClass = "";
		$community->programarea_programarea_id->CellAttrs = array(); $community->programarea_programarea_id->ViewAttrs = array(); $community->programarea_programarea_id->EditAttrs = array();

		// community_category_community_category_id
		$community->community_category_community_category_id->CellCssStyle = ""; $community->community_category_community_category_id->CellCssClass = "";
		$community->community_category_community_category_id->CellAttrs = array(); $community->community_category_community_category_id->ViewAttrs = array(); $community->community_category_community_category_id->EditAttrs = array();

		// community_districts_DistrictID
		$community->community_districts_DistrictID->CellCssStyle = ""; $community->community_districts_DistrictID->CellCssClass = "";
		$community->community_districts_DistrictID->CellAttrs = array(); $community->community_districts_DistrictID->ViewAttrs = array(); $community->community_districts_DistrictID->EditAttrs = array();
		if ($community->RowType == EW_ROWTYPE_VIEW) { // View row

			// community_id
			$community->community_id->ViewValue = $community->community_id->CurrentValue;
			$community->community_id->CssStyle = "";
			$community->community_id->CssClass = "";
			$community->community_id->ViewCustomAttributes = "";

			// community
			$community->community_1->ViewValue = $community->community_1->CurrentValue;
			$community->community_1->CssStyle = "";
			$community->community_1->CssClass = "";
			$community->community_1->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($community->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($community->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$community->programarea_programarea_id->ViewValue = $community->programarea_programarea_id->CurrentValue;
				}
			} else {
				$community->programarea_programarea_id->ViewValue = NULL;
			}
			$community->programarea_programarea_id->CssStyle = "";
			$community->programarea_programarea_id->CssClass = "";
			$community->programarea_programarea_id->ViewCustomAttributes = "";

			// community_category_community_category_id
			if (strval($community->community_category_community_category_id->CurrentValue) <> "") {
				$sFilterWrk = "`community_category_id` = " . ew_AdjustSql($community->community_category_community_category_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `community_category_name` FROM `community_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->community_category_community_category_id->ViewValue = $rswrk->fields('community_category_name');
					$rswrk->Close();
				} else {
					$community->community_category_community_category_id->ViewValue = $community->community_category_community_category_id->CurrentValue;
				}
			} else {
				$community->community_category_community_category_id->ViewValue = NULL;
			}
			$community->community_category_community_category_id->CssStyle = "";
			$community->community_category_community_category_id->CssClass = "";
			$community->community_category_community_category_id->ViewCustomAttributes = "";

			// community_districts_DistrictID
			if (strval($community->community_districts_DistrictID->CurrentValue) <> "") {
				$sFilterWrk = "`DistrictID` = " . ew_AdjustSql($community->community_districts_DistrictID->CurrentValue) . "";
			$sSqlWrk = "SELECT `District` FROM `districts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$community->community_districts_DistrictID->ViewValue = $rswrk->fields('District');
					$rswrk->Close();
				} else {
					$community->community_districts_DistrictID->ViewValue = $community->community_districts_DistrictID->CurrentValue;
				}
			} else {
				$community->community_districts_DistrictID->ViewValue = NULL;
			}
			$community->community_districts_DistrictID->CssStyle = "";
			$community->community_districts_DistrictID->CssClass = "";
			$community->community_districts_DistrictID->ViewCustomAttributes = "";

			// community
			$community->community_1->HrefValue = "";
			$community->community_1->TooltipValue = "";

			// programarea_programarea_id
			$community->programarea_programarea_id->HrefValue = "";
			$community->programarea_programarea_id->TooltipValue = "";

			// community_category_community_category_id
			$community->community_category_community_category_id->HrefValue = "";
			$community->community_category_community_category_id->TooltipValue = "";

			// community_districts_DistrictID
			$community->community_districts_DistrictID->HrefValue = "";
			$community->community_districts_DistrictID->TooltipValue = "";
		} elseif ($community->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// community
			$community->community_1->EditCustomAttributes = "";
			$community->community_1->EditValue = ew_HtmlEncode($community->community_1->AdvancedSearch->SearchValue);

			// programarea_programarea_id
			$community->programarea_programarea_id->EditCustomAttributes = "";
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
			$community->programarea_programarea_id->EditValue = $arwrk;

			// community_category_community_category_id
			$community->community_category_community_category_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `community_category_id`, `community_category_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `community_category`";
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
			$community->community_category_community_category_id->EditValue = $arwrk;

			// community_districts_DistrictID
			$community->community_districts_DistrictID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `DistrictID`, `District`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `districts`";
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
			$community->community_districts_DistrictID->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($community->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$community->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $community;

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
		global $community;
		$community->community_1->AdvancedSearch->SearchValue = $community->getAdvancedSearch("x_community_1");
		$community->programarea_programarea_id->AdvancedSearch->SearchValue = $community->getAdvancedSearch("x_programarea_programarea_id");
		$community->community_category_community_category_id->AdvancedSearch->SearchValue = $community->getAdvancedSearch("x_community_category_community_category_id");
		$community->community_districts_DistrictID->AdvancedSearch->SearchValue = $community->getAdvancedSearch("x_community_districts_DistrictID");
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
