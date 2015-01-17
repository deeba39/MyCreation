<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
$users_search = new cusers_search();
$Page =& $users_search;

// Page init
$users_search->Page_Init();

// Page main
$users_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var users_search = new ew_Page("users_search");

// page properties
users_search.PageID = "search"; // page ID
users_search.FormID = "fuserssearch"; // form ID
var EW_PAGE_ID = users_search.PageID; // for backward compatibility

// extend page with validate function for search
users_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_zuserid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($users->zuserid->FldErrMsg()) ?>");

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
users_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
users_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
users_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $users->TableCaption() ?><br><br>
<a href="<?php echo $users->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$users_search->ShowMessage();
?>
<form name="fuserssearch" id="fuserssearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return users_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="users">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->zuserid->FldCaption() ?></td>
		<td<?php echo $users->zuserid->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_zuserid" id="z_zuserid" value="="></span></td>
		<td<?php echo $users->zuserid->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_zuserid" id="x_zuserid" title="<?php echo $users->zuserid->FldTitle() ?>" value="<?php echo $users->zuserid->EditValue ?>"<?php echo $users->zuserid->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->username->FldCaption() ?></td>
		<td<?php echo $users->username->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_username" id="z_username" value="LIKE"></span></td>
		<td<?php echo $users->username->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_username" id="x_username" title="<?php echo $users->username->FldTitle() ?>" size="30" maxlength="30" value="<?php echo $users->username->EditValue ?>"<?php echo $users->username->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->password->FldCaption() ?></td>
		<td<?php echo $users->password->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_password" id="z_password" value="LIKE"></span></td>
		<td<?php echo $users->password->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="password" name="x_password" id="x_password" title="<?php echo $users->password->FldTitle() ?>" size="30" maxlength="30"<?php echo $users->password->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->userlevelid->FldCaption() ?></td>
		<td<?php echo $users->userlevelid->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_userlevelid" id="z_userlevelid" value="="></span></td>
		<td<?php echo $users->userlevelid->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_userlevelid" name="x_userlevelid" title="<?php echo $users->userlevelid->FldTitle() ?>"<?php echo $users->userlevelid->EditAttributes() ?>>
<?php
if (is_array($users->userlevelid->EditValue)) {
	$arwrk = $users->userlevelid->EditValue;
	if ($arwrk[0][0] <> "") echo "<option value=\"\">" . $Language->Phrase("PleaseSelect") . "</option>";
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($users->userlevelid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } elseif (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<div<?php echo $users->userlevelid->ViewAttributes() ?>><?php echo $users->userlevelid->EditValue ?></div>
<?php } else { ?>
<select id="x_userlevelid" name="x_userlevelid" title="<?php echo $users->userlevelid->FldTitle() ?>"<?php echo $users->userlevelid->EditAttributes() ?>>
<?php
if (is_array($users->userlevelid->EditValue)) {
	$arwrk = $users->userlevelid->EditValue;
	if ($arwrk[0][0] <> "") echo "<option value=\"\">" . $Language->Phrase("PleaseSelect") . "</option>";
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($users->userlevelid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->groupid->FldCaption() ?></td>
		<td<?php echo $users->groupid->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_groupid" id="z_groupid" value="="></span></td>
		<td<?php echo $users->groupid->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_groupid" name="x_groupid" title="<?php echo $users->groupid->FldTitle() ?>"<?php echo $users->groupid->EditAttributes() ?>>
<?php
if (is_array($users->groupid->EditValue)) {
	$arwrk = $users->groupid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($users->groupid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->parentid->FldCaption() ?></td>
		<td<?php echo $users->parentid->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_parentid" id="z_parentid" value="="></span></td>
		<td<?php echo $users->parentid->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<?php if (strval($users->parentid->AdvancedSearch->SearchValue) == "") $users->parentid->AdvancedSearch->SearchValue = CurrentUserID() ?>
<select id="x_parentid" name="x_parentid" title="<?php echo $users->parentid->FldTitle() ?>"<?php echo $users->parentid->EditAttributes() ?>>
<?php
if (is_array($users->parentid->EditValue)) {
	$arwrk = $users->parentid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($users->parentid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<select id="x_parentid" name="x_parentid" title="<?php echo $users->parentid->FldTitle() ?>"<?php echo $users->parentid->EditAttributes() ?>>
<?php
if (is_array($users->parentid->EditValue)) {
	$arwrk = $users->parentid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($users->parentid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->programarea_programarea_id->FldCaption() ?></td>
		<td<?php echo $users->programarea_programarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_programarea_programarea_id" id="z_programarea_programarea_id" value="="></span></td>
		<td<?php echo $users->programarea_programarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_programarea_programarea_id" name="x_programarea_programarea_id" title="<?php echo $users->programarea_programarea_id->FldTitle() ?>"<?php echo $users->programarea_programarea_id->EditAttributes() ?>>
<?php
if (is_array($users->programarea_programarea_id->EditValue)) {
	$arwrk = $users->programarea_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($users->programarea_programarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
$users_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cusers_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'users';

	// Page object name
	var $PageObjName = 'users_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $users;
		if ($users->UseTokenInUrl) $PageUrl .= "t=" . $users->TableVar . "&"; // Add page token
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
		global $objForm, $users;
		if ($users->UseTokenInUrl) {
			if ($objForm)
				return ($users->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($users->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cusers_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (users)
		$GLOBALS["users"] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'users', TRUE);

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
		global $users;

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
			$this->Page_Terminate("userslist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("userslist.php");
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
		global $objForm, $Language, $gsSearchError, $users;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$users->CurrentAction = $objForm->GetValue("a_search");
			switch ($users->CurrentAction) {
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
						$sSrchStr = $users->UrlParm($sSrchStr);
						$this->Page_Terminate("userslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$users->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $users;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $users->zuserid); // userid
	$this->BuildSearchUrl($sSrchUrl, $users->username); // username
	$this->BuildSearchUrl($sSrchUrl, $users->password); // password
	$this->BuildSearchUrl($sSrchUrl, $users->userlevelid); // userlevelid
	$this->BuildSearchUrl($sSrchUrl, $users->groupid); // groupid
	$this->BuildSearchUrl($sSrchUrl, $users->parentid); // parentid
	$this->BuildSearchUrl($sSrchUrl, $users->programarea_programarea_id); // programarea_programarea_id
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
		global $objForm, $users;

		// Load search values
		// userid

		$users->zuserid->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_zuserid"));
		$users->zuserid->AdvancedSearch->SearchOperator = $objForm->GetValue("z_zuserid");

		// username
		$users->username->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_username"));
		$users->username->AdvancedSearch->SearchOperator = $objForm->GetValue("z_username");

		// password
		$users->password->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_password"));
		$users->password->AdvancedSearch->SearchOperator = $objForm->GetValue("z_password");

		// userlevelid
		$users->userlevelid->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_userlevelid"));
		$users->userlevelid->AdvancedSearch->SearchOperator = $objForm->GetValue("z_userlevelid");

		// groupid
		$users->groupid->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_groupid"));
		$users->groupid->AdvancedSearch->SearchOperator = $objForm->GetValue("z_groupid");

		// parentid
		$users->parentid->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_parentid"));
		$users->parentid->AdvancedSearch->SearchOperator = $objForm->GetValue("z_parentid");

		// programarea_programarea_id
		$users->programarea_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_programarea_programarea_id"));
		$users->programarea_programarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_programarea_programarea_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $users;

		// Initialize URLs
		// Call Row_Rendering event

		$users->Row_Rendering();

		// Common render codes for all row types
		// userid

		$users->zuserid->CellCssStyle = ""; $users->zuserid->CellCssClass = "";
		$users->zuserid->CellAttrs = array(); $users->zuserid->ViewAttrs = array(); $users->zuserid->EditAttrs = array();

		// username
		$users->username->CellCssStyle = ""; $users->username->CellCssClass = "";
		$users->username->CellAttrs = array(); $users->username->ViewAttrs = array(); $users->username->EditAttrs = array();

		// password
		$users->password->CellCssStyle = ""; $users->password->CellCssClass = "";
		$users->password->CellAttrs = array(); $users->password->ViewAttrs = array(); $users->password->EditAttrs = array();

		// userlevelid
		$users->userlevelid->CellCssStyle = ""; $users->userlevelid->CellCssClass = "";
		$users->userlevelid->CellAttrs = array(); $users->userlevelid->ViewAttrs = array(); $users->userlevelid->EditAttrs = array();

		// groupid
		$users->groupid->CellCssStyle = ""; $users->groupid->CellCssClass = "";
		$users->groupid->CellAttrs = array(); $users->groupid->ViewAttrs = array(); $users->groupid->EditAttrs = array();

		// parentid
		$users->parentid->CellCssStyle = ""; $users->parentid->CellCssClass = "";
		$users->parentid->CellAttrs = array(); $users->parentid->ViewAttrs = array(); $users->parentid->EditAttrs = array();

		// programarea_programarea_id
		$users->programarea_programarea_id->CellCssStyle = ""; $users->programarea_programarea_id->CellCssClass = "";
		$users->programarea_programarea_id->CellAttrs = array(); $users->programarea_programarea_id->ViewAttrs = array(); $users->programarea_programarea_id->EditAttrs = array();
		if ($users->RowType == EW_ROWTYPE_VIEW) { // View row

			// userid
			$users->zuserid->ViewValue = $users->zuserid->CurrentValue;
			$users->zuserid->CssStyle = "";
			$users->zuserid->CssClass = "";
			$users->zuserid->ViewCustomAttributes = "";

			// username
			$users->username->ViewValue = $users->username->CurrentValue;
			$users->username->CssStyle = "";
			$users->username->CssClass = "";
			$users->username->ViewCustomAttributes = "";

			// password
			$users->password->ViewValue = "********";
			$users->password->CssStyle = "";
			$users->password->CssClass = "";
			$users->password->ViewCustomAttributes = "";

			// userlevelid
			if ($Security->CanAdmin()) { // System admin
			if (strval($users->userlevelid->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($users->userlevelid->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$users->userlevelid->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$users->userlevelid->ViewValue = $users->userlevelid->CurrentValue;
				}
			} else {
				$users->userlevelid->ViewValue = NULL;
			}
			} else {
				$users->userlevelid->ViewValue = "********";
			}
			$users->userlevelid->CssStyle = "";
			$users->userlevelid->CssClass = "";
			$users->userlevelid->ViewCustomAttributes = "";

			// groupid
			if (strval($users->groupid->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($users->groupid->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$users->groupid->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$users->groupid->ViewValue = $users->groupid->CurrentValue;
				}
			} else {
				$users->groupid->ViewValue = NULL;
			}
			$users->groupid->CssStyle = "";
			$users->groupid->CssClass = "";
			$users->groupid->ViewCustomAttributes = "";

			// parentid
			if (strval($users->parentid->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($users->parentid->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$users->parentid->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$users->parentid->ViewValue = $users->parentid->CurrentValue;
				}
			} else {
				$users->parentid->ViewValue = NULL;
			}
			$users->parentid->CssStyle = "";
			$users->parentid->CssClass = "";
			$users->parentid->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($users->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($users->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$users->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$users->programarea_programarea_id->ViewValue = $users->programarea_programarea_id->CurrentValue;
				}
			} else {
				$users->programarea_programarea_id->ViewValue = NULL;
			}
			$users->programarea_programarea_id->CssStyle = "";
			$users->programarea_programarea_id->CssClass = "";
			$users->programarea_programarea_id->ViewCustomAttributes = "";

			// userid
			$users->zuserid->HrefValue = "";
			$users->zuserid->TooltipValue = "";

			// username
			$users->username->HrefValue = "";
			$users->username->TooltipValue = "";

			// password
			$users->password->HrefValue = "";
			$users->password->TooltipValue = "";

			// userlevelid
			$users->userlevelid->HrefValue = "";
			$users->userlevelid->TooltipValue = "";

			// groupid
			$users->groupid->HrefValue = "";
			$users->groupid->TooltipValue = "";

			// parentid
			$users->parentid->HrefValue = "";
			$users->parentid->TooltipValue = "";

			// programarea_programarea_id
			$users->programarea_programarea_id->HrefValue = "";
			$users->programarea_programarea_id->TooltipValue = "";
		} elseif ($users->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// userid
			$users->zuserid->EditCustomAttributes = "";
			$users->zuserid->EditValue = ew_HtmlEncode($users->zuserid->AdvancedSearch->SearchValue);

			// username
			$users->username->EditCustomAttributes = "";
			$users->username->EditValue = ew_HtmlEncode($users->username->AdvancedSearch->SearchValue);

			// password
			$users->password->EditCustomAttributes = "";
			$users->password->EditValue = ew_HtmlEncode($users->password->AdvancedSearch->SearchValue);

			// userlevelid
			$users->userlevelid->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
			$sFilterWrk = "";
			$sSqlWrk = "SELECT `userlevelid`, `userlevelname` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$users->userlevelid->EditValue = $arwrk;
			} elseif (!$Security->CanAdmin()) { // System admin
				$users->userlevelid->EditValue = "********";
			} else {
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
			$users->userlevelid->EditValue = $arwrk;
			}

			// groupid
			$users->groupid->EditCustomAttributes = "";
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
			$users->groupid->EditValue = $arwrk;

			// parentid
			$users->parentid->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
			$sFilterWrk = "";
			$sSqlWrk = "SELECT `userlevelid`, `userlevelname` FROM `userlevels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$users->parentid->EditValue = $arwrk;
			} else {
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
			$users->parentid->EditValue = $arwrk;
			}

			// programarea_programarea_id
			$users->programarea_programarea_id->EditCustomAttributes = "";
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
			$users->programarea_programarea_id->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($users->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$users->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $users;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($users->zuserid->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $users->zuserid->FldErrMsg();
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
		global $users;
		$users->zuserid->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_zuserid");
		$users->username->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_username");
		$users->password->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_password");
		$users->userlevelid->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_userlevelid");
		$users->groupid->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_groupid");
		$users->parentid->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_parentid");
		$users->programarea_programarea_id->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_programarea_programarea_id");
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
