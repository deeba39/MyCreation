<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "scholarship_packageinfo.php" ?>
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
$scholarship_package_search = new cscholarship_package_search();
$Page =& $scholarship_package_search;

// Page init
$scholarship_package_search->Page_Init();

// Page main
$scholarship_package_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_package_search = new ew_Page("scholarship_package_search");

// page properties
scholarship_package_search.PageID = "search"; // page ID
scholarship_package_search.FormID = "fscholarship_packagesearch"; // form ID
var EW_PAGE_ID = scholarship_package_search.PageID; // for backward compatibility

// extend page with validate function for search
scholarship_package_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_scholarship_package_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->scholarship_package_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_start_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->start_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_end_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->end_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_annual_amount"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->annual_amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_grant_package_grant_package_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->grant_package_grant_package_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_sponsored_student_sponsored_student_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->sponsored_student_sponsored_student_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_scholarship_type"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->scholarship_type->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_scholarship_type_scholarship_type"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->scholarship_type_scholarship_type->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($scholarship_package->group_id->FldErrMsg()) ?>");

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
scholarship_package_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_package_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_package_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_package->TableCaption() ?><br><br>
<a href="<?php echo $scholarship_package->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$scholarship_package_search->ShowMessage();
?>
<form name="fscholarship_packagesearch" id="fscholarship_packagesearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return scholarship_package_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="scholarship_package">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->scholarship_package_id->FldCaption() ?></td>
		<td<?php echo $scholarship_package->scholarship_package_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_scholarship_package_id" id="z_scholarship_package_id" value="="></span></td>
		<td<?php echo $scholarship_package->scholarship_package_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_scholarship_package_id" id="x_scholarship_package_id" title="<?php echo $scholarship_package->scholarship_package_id->FldTitle() ?>" value="<?php echo $scholarship_package->scholarship_package_id->EditValue ?>"<?php echo $scholarship_package->scholarship_package_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->start_date->FldCaption() ?></td>
		<td<?php echo $scholarship_package->start_date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_start_date" id="z_start_date" value="="></span></td>
		<td<?php echo $scholarship_package->start_date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_start_date" id="x_start_date" title="<?php echo $scholarship_package->start_date->FldTitle() ?>" value="<?php echo $scholarship_package->start_date->EditValue ?>"<?php echo $scholarship_package->start_date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_start_date" name="cal_x_start_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_start_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_start_date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->end_date->FldCaption() ?></td>
		<td<?php echo $scholarship_package->end_date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_end_date" id="z_end_date" value="="></span></td>
		<td<?php echo $scholarship_package->end_date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_end_date" id="x_end_date" title="<?php echo $scholarship_package->end_date->FldTitle() ?>" value="<?php echo $scholarship_package->end_date->EditValue ?>"<?php echo $scholarship_package->end_date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_end_date" name="cal_x_end_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_end_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_end_date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->status->FldCaption() ?></td>
		<td<?php echo $scholarship_package->status->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_status" id="z_status" value="="></span></td>
		<td<?php echo $scholarship_package->status->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $scholarship_package->status->FldTitle() ?>" value="{value}"<?php echo $scholarship_package->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $scholarship_package->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($scholarship_package->status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $scholarship_package->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $scholarship_package->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->annual_amount->FldCaption() ?></td>
		<td<?php echo $scholarship_package->annual_amount->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_annual_amount" id="z_annual_amount" value="="></span></td>
		<td<?php echo $scholarship_package->annual_amount->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_annual_amount" id="x_annual_amount" title="<?php echo $scholarship_package->annual_amount->FldTitle() ?>" size="30" value="<?php echo $scholarship_package->annual_amount->EditValue ?>"<?php echo $scholarship_package->annual_amount->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->grant_package_grant_package_id->FldCaption() ?></td>
		<td<?php echo $scholarship_package->grant_package_grant_package_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_grant_package_grant_package_id" id="z_grant_package_grant_package_id" value="="></span></td>
		<td<?php echo $scholarship_package->grant_package_grant_package_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_grant_package_grant_package_id" id="x_grant_package_grant_package_id" title="<?php echo $scholarship_package->grant_package_grant_package_id->FldTitle() ?>" size="30" value="<?php echo $scholarship_package->grant_package_grant_package_id->EditValue ?>"<?php echo $scholarship_package->grant_package_grant_package_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->sponsored_student_sponsored_student_id->FldCaption() ?></td>
		<td<?php echo $scholarship_package->sponsored_student_sponsored_student_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_sponsored_student_sponsored_student_id" id="z_sponsored_student_sponsored_student_id" value="="></span></td>
		<td<?php echo $scholarship_package->sponsored_student_sponsored_student_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_sponsored_student_sponsored_student_id" id="x_sponsored_student_sponsored_student_id" title="<?php echo $scholarship_package->sponsored_student_sponsored_student_id->FldTitle() ?>" size="30" value="<?php echo $scholarship_package->sponsored_student_sponsored_student_id->EditValue ?>"<?php echo $scholarship_package->sponsored_student_sponsored_student_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->scholarship_type->FldCaption() ?></td>
		<td<?php echo $scholarship_package->scholarship_type->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_scholarship_type" id="z_scholarship_type" value="="></span></td>
		<td<?php echo $scholarship_package->scholarship_type->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_scholarship_type" id="x_scholarship_type" title="<?php echo $scholarship_package->scholarship_type->FldTitle() ?>" size="30" value="<?php echo $scholarship_package->scholarship_type->EditValue ?>"<?php echo $scholarship_package->scholarship_type->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->scholarship_type_scholarship_type->FldCaption() ?></td>
		<td<?php echo $scholarship_package->scholarship_type_scholarship_type->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_scholarship_type_scholarship_type" id="z_scholarship_type_scholarship_type" value="="></span></td>
		<td<?php echo $scholarship_package->scholarship_type_scholarship_type->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_scholarship_type_scholarship_type" id="x_scholarship_type_scholarship_type" title="<?php echo $scholarship_package->scholarship_type_scholarship_type->FldTitle() ?>" size="30" value="<?php echo $scholarship_package->scholarship_type_scholarship_type->EditValue ?>"<?php echo $scholarship_package->scholarship_type_scholarship_type->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $scholarship_package->group_id->FldCaption() ?></td>
		<td<?php echo $scholarship_package->group_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_group_id" id="z_group_id" value="="></span></td>
		<td<?php echo $scholarship_package->group_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $scholarship_package->group_id->FldTitle() ?>"<?php echo $scholarship_package->group_id->EditAttributes() ?>>
<?php
if (is_array($scholarship_package->group_id->EditValue)) {
	$arwrk = $scholarship_package->group_id->EditValue;
	if ($arwrk[0][0] <> "") echo "<option value=\"\">" . $Language->Phrase("PleaseSelect") . "</option>";
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($scholarship_package->group_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="text" name="x_group_id" id="x_group_id" title="<?php echo $scholarship_package->group_id->FldTitle() ?>" size="30" value="<?php echo $scholarship_package->group_id->EditValue ?>"<?php echo $scholarship_package->group_id->EditAttributes() ?>>
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
$scholarship_package_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_package_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'scholarship_package';

	// Page object name
	var $PageObjName = 'scholarship_package_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $scholarship_package;
		if ($scholarship_package->UseTokenInUrl) $PageUrl .= "t=" . $scholarship_package->TableVar . "&"; // Add page token
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
		global $objForm, $scholarship_package;
		if ($scholarship_package->UseTokenInUrl) {
			if ($objForm)
				return ($scholarship_package->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($scholarship_package->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cscholarship_package_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (scholarship_package)
		$GLOBALS["scholarship_package"] = new cscholarship_package();

		// Table object (grant_package)
		$GLOBALS['grant_package'] = new cgrant_package();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'scholarship_package', TRUE);

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
		global $scholarship_package;

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
			$this->Page_Terminate("scholarship_packagelist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("scholarship_packagelist.php");
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
		global $objForm, $Language, $gsSearchError, $scholarship_package;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$scholarship_package->CurrentAction = $objForm->GetValue("a_search");
			switch ($scholarship_package->CurrentAction) {
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
						$sSrchStr = $scholarship_package->UrlParm($sSrchStr);
						$this->Page_Terminate("scholarship_packagelist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$scholarship_package->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $scholarship_package;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $scholarship_package->scholarship_package_id); // scholarship_package_id
	$this->BuildSearchUrl($sSrchUrl, $scholarship_package->start_date); // start_date
	$this->BuildSearchUrl($sSrchUrl, $scholarship_package->end_date); // end_date
	$this->BuildSearchUrl($sSrchUrl, $scholarship_package->status); // status
	$this->BuildSearchUrl($sSrchUrl, $scholarship_package->annual_amount); // annual_amount
	$this->BuildSearchUrl($sSrchUrl, $scholarship_package->grant_package_grant_package_id); // grant_package_grant_package_id
	$this->BuildSearchUrl($sSrchUrl, $scholarship_package->sponsored_student_sponsored_student_id); // sponsored_student_sponsored_student_id
	$this->BuildSearchUrl($sSrchUrl, $scholarship_package->scholarship_type); // scholarship_type
	$this->BuildSearchUrl($sSrchUrl, $scholarship_package->scholarship_type_scholarship_type); // scholarship_type_scholarship_type
	$this->BuildSearchUrl($sSrchUrl, $scholarship_package->group_id); // group_id
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
		global $objForm, $scholarship_package;

		// Load search values
		// scholarship_package_id

		$scholarship_package->scholarship_package_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_scholarship_package_id"));
		$scholarship_package->scholarship_package_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_scholarship_package_id");

		// start_date
		$scholarship_package->start_date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_start_date"));
		$scholarship_package->start_date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_start_date");

		// end_date
		$scholarship_package->end_date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_end_date"));
		$scholarship_package->end_date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_end_date");

		// status
		$scholarship_package->status->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_status"));
		$scholarship_package->status->AdvancedSearch->SearchOperator = $objForm->GetValue("z_status");

		// annual_amount
		$scholarship_package->annual_amount->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_annual_amount"));
		$scholarship_package->annual_amount->AdvancedSearch->SearchOperator = $objForm->GetValue("z_annual_amount");

		// grant_package_grant_package_id
		$scholarship_package->grant_package_grant_package_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_grant_package_grant_package_id"));
		$scholarship_package->grant_package_grant_package_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_grant_package_grant_package_id");

		// sponsored_student_sponsored_student_id
		$scholarship_package->sponsored_student_sponsored_student_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_sponsored_student_sponsored_student_id"));
		$scholarship_package->sponsored_student_sponsored_student_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_sponsored_student_sponsored_student_id");

		// scholarship_type
		$scholarship_package->scholarship_type->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_scholarship_type"));
		$scholarship_package->scholarship_type->AdvancedSearch->SearchOperator = $objForm->GetValue("z_scholarship_type");

		// scholarship_type_scholarship_type
		$scholarship_package->scholarship_type_scholarship_type->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_scholarship_type_scholarship_type"));
		$scholarship_package->scholarship_type_scholarship_type->AdvancedSearch->SearchOperator = $objForm->GetValue("z_scholarship_type_scholarship_type");

		// group_id
		$scholarship_package->group_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_group_id"));
		$scholarship_package->group_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_group_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $scholarship_package;

		// Initialize URLs
		// Call Row_Rendering event

		$scholarship_package->Row_Rendering();

		// Common render codes for all row types
		// scholarship_package_id

		$scholarship_package->scholarship_package_id->CellCssStyle = ""; $scholarship_package->scholarship_package_id->CellCssClass = "";
		$scholarship_package->scholarship_package_id->CellAttrs = array(); $scholarship_package->scholarship_package_id->ViewAttrs = array(); $scholarship_package->scholarship_package_id->EditAttrs = array();

		// start_date
		$scholarship_package->start_date->CellCssStyle = ""; $scholarship_package->start_date->CellCssClass = "";
		$scholarship_package->start_date->CellAttrs = array(); $scholarship_package->start_date->ViewAttrs = array(); $scholarship_package->start_date->EditAttrs = array();

		// end_date
		$scholarship_package->end_date->CellCssStyle = ""; $scholarship_package->end_date->CellCssClass = "";
		$scholarship_package->end_date->CellAttrs = array(); $scholarship_package->end_date->ViewAttrs = array(); $scholarship_package->end_date->EditAttrs = array();

		// status
		$scholarship_package->status->CellCssStyle = ""; $scholarship_package->status->CellCssClass = "";
		$scholarship_package->status->CellAttrs = array(); $scholarship_package->status->ViewAttrs = array(); $scholarship_package->status->EditAttrs = array();

		// annual_amount
		$scholarship_package->annual_amount->CellCssStyle = ""; $scholarship_package->annual_amount->CellCssClass = "";
		$scholarship_package->annual_amount->CellAttrs = array(); $scholarship_package->annual_amount->ViewAttrs = array(); $scholarship_package->annual_amount->EditAttrs = array();

		// grant_package_grant_package_id
		$scholarship_package->grant_package_grant_package_id->CellCssStyle = ""; $scholarship_package->grant_package_grant_package_id->CellCssClass = "";
		$scholarship_package->grant_package_grant_package_id->CellAttrs = array(); $scholarship_package->grant_package_grant_package_id->ViewAttrs = array(); $scholarship_package->grant_package_grant_package_id->EditAttrs = array();

		// sponsored_student_sponsored_student_id
		$scholarship_package->sponsored_student_sponsored_student_id->CellCssStyle = ""; $scholarship_package->sponsored_student_sponsored_student_id->CellCssClass = "";
		$scholarship_package->sponsored_student_sponsored_student_id->CellAttrs = array(); $scholarship_package->sponsored_student_sponsored_student_id->ViewAttrs = array(); $scholarship_package->sponsored_student_sponsored_student_id->EditAttrs = array();

		// scholarship_type
		$scholarship_package->scholarship_type->CellCssStyle = ""; $scholarship_package->scholarship_type->CellCssClass = "";
		$scholarship_package->scholarship_type->CellAttrs = array(); $scholarship_package->scholarship_type->ViewAttrs = array(); $scholarship_package->scholarship_type->EditAttrs = array();

		// scholarship_type_scholarship_type
		$scholarship_package->scholarship_type_scholarship_type->CellCssStyle = ""; $scholarship_package->scholarship_type_scholarship_type->CellCssClass = "";
		$scholarship_package->scholarship_type_scholarship_type->CellAttrs = array(); $scholarship_package->scholarship_type_scholarship_type->ViewAttrs = array(); $scholarship_package->scholarship_type_scholarship_type->EditAttrs = array();

		// group_id
		$scholarship_package->group_id->CellCssStyle = ""; $scholarship_package->group_id->CellCssClass = "";
		$scholarship_package->group_id->CellAttrs = array(); $scholarship_package->group_id->ViewAttrs = array(); $scholarship_package->group_id->EditAttrs = array();
		if ($scholarship_package->RowType == EW_ROWTYPE_VIEW) { // View row

			// scholarship_package_id
			$scholarship_package->scholarship_package_id->ViewValue = $scholarship_package->scholarship_package_id->CurrentValue;
			$scholarship_package->scholarship_package_id->CssStyle = "";
			$scholarship_package->scholarship_package_id->CssClass = "";
			$scholarship_package->scholarship_package_id->ViewCustomAttributes = "";

			// start_date
			$scholarship_package->start_date->ViewValue = $scholarship_package->start_date->CurrentValue;
			$scholarship_package->start_date->ViewValue = ew_FormatDateTime($scholarship_package->start_date->ViewValue, 7);
			$scholarship_package->start_date->CssStyle = "";
			$scholarship_package->start_date->CssClass = "";
			$scholarship_package->start_date->ViewCustomAttributes = "";

			// end_date
			$scholarship_package->end_date->ViewValue = $scholarship_package->end_date->CurrentValue;
			$scholarship_package->end_date->ViewValue = ew_FormatDateTime($scholarship_package->end_date->ViewValue, 7);
			$scholarship_package->end_date->CssStyle = "";
			$scholarship_package->end_date->CssClass = "";
			$scholarship_package->end_date->ViewCustomAttributes = "";

			// status
			if (strval($scholarship_package->status->CurrentValue) <> "") {
				switch ($scholarship_package->status->CurrentValue) {
					case "active":
						$scholarship_package->status->ViewValue = "Active";
						break;
					case "suspended":
						$scholarship_package->status->ViewValue = "Suspended";
						break;
					default:
						$scholarship_package->status->ViewValue = $scholarship_package->status->CurrentValue;
				}
			} else {
				$scholarship_package->status->ViewValue = NULL;
			}
			$scholarship_package->status->CssStyle = "";
			$scholarship_package->status->CssClass = "";
			$scholarship_package->status->ViewCustomAttributes = "";

			// annual_amount
			$scholarship_package->annual_amount->ViewValue = $scholarship_package->annual_amount->CurrentValue;
			$scholarship_package->annual_amount->CssStyle = "";
			$scholarship_package->annual_amount->CssClass = "";
			$scholarship_package->annual_amount->ViewCustomAttributes = "";

			// grant_package_grant_package_id
			$scholarship_package->grant_package_grant_package_id->ViewValue = $scholarship_package->grant_package_grant_package_id->CurrentValue;
			$scholarship_package->grant_package_grant_package_id->CssStyle = "";
			$scholarship_package->grant_package_grant_package_id->CssClass = "";
			$scholarship_package->grant_package_grant_package_id->ViewCustomAttributes = "";

			// sponsored_student_sponsored_student_id
			$scholarship_package->sponsored_student_sponsored_student_id->ViewValue = $scholarship_package->sponsored_student_sponsored_student_id->CurrentValue;
			$scholarship_package->sponsored_student_sponsored_student_id->CssStyle = "";
			$scholarship_package->sponsored_student_sponsored_student_id->CssClass = "";
			$scholarship_package->sponsored_student_sponsored_student_id->ViewCustomAttributes = "";

			// scholarship_type
			$scholarship_package->scholarship_type->ViewValue = $scholarship_package->scholarship_type->CurrentValue;
			$scholarship_package->scholarship_type->CssStyle = "";
			$scholarship_package->scholarship_type->CssClass = "";
			$scholarship_package->scholarship_type->ViewCustomAttributes = "";

			// scholarship_type_scholarship_type
			$scholarship_package->scholarship_type_scholarship_type->ViewValue = $scholarship_package->scholarship_type_scholarship_type->CurrentValue;
			$scholarship_package->scholarship_type_scholarship_type->CssStyle = "";
			$scholarship_package->scholarship_type_scholarship_type->CssClass = "";
			$scholarship_package->scholarship_type_scholarship_type->ViewCustomAttributes = "";

			// group_id
			$scholarship_package->group_id->ViewValue = $scholarship_package->group_id->CurrentValue;
			$scholarship_package->group_id->CssStyle = "";
			$scholarship_package->group_id->CssClass = "";
			$scholarship_package->group_id->ViewCustomAttributes = "";

			// scholarship_package_id
			$scholarship_package->scholarship_package_id->HrefValue = "";
			$scholarship_package->scholarship_package_id->TooltipValue = "";

			// start_date
			$scholarship_package->start_date->HrefValue = "";
			$scholarship_package->start_date->TooltipValue = "";

			// end_date
			$scholarship_package->end_date->HrefValue = "";
			$scholarship_package->end_date->TooltipValue = "";

			// status
			$scholarship_package->status->HrefValue = "";
			$scholarship_package->status->TooltipValue = "";

			// annual_amount
			$scholarship_package->annual_amount->HrefValue = "";
			$scholarship_package->annual_amount->TooltipValue = "";

			// grant_package_grant_package_id
			$scholarship_package->grant_package_grant_package_id->HrefValue = "";
			$scholarship_package->grant_package_grant_package_id->TooltipValue = "";

			// sponsored_student_sponsored_student_id
			$scholarship_package->sponsored_student_sponsored_student_id->HrefValue = "";
			$scholarship_package->sponsored_student_sponsored_student_id->TooltipValue = "";

			// scholarship_type
			$scholarship_package->scholarship_type->HrefValue = "";
			$scholarship_package->scholarship_type->TooltipValue = "";

			// scholarship_type_scholarship_type
			$scholarship_package->scholarship_type_scholarship_type->HrefValue = "";
			$scholarship_package->scholarship_type_scholarship_type->TooltipValue = "";

			// group_id
			$scholarship_package->group_id->HrefValue = "";
			$scholarship_package->group_id->TooltipValue = "";
		} elseif ($scholarship_package->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// scholarship_package_id
			$scholarship_package->scholarship_package_id->EditCustomAttributes = "";
			$scholarship_package->scholarship_package_id->EditValue = ew_HtmlEncode($scholarship_package->scholarship_package_id->AdvancedSearch->SearchValue);

			// start_date
			$scholarship_package->start_date->EditCustomAttributes = "";
			$scholarship_package->start_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($scholarship_package->start_date->AdvancedSearch->SearchValue, 7), 7));

			// end_date
			$scholarship_package->end_date->EditCustomAttributes = "";
			$scholarship_package->end_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($scholarship_package->end_date->AdvancedSearch->SearchValue, 7), 7));

			// status
			$scholarship_package->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("active", "Active");
			$arwrk[] = array("suspended", "Suspended");
			$scholarship_package->status->EditValue = $arwrk;

			// annual_amount
			$scholarship_package->annual_amount->EditCustomAttributes = "";
			$scholarship_package->annual_amount->EditValue = ew_HtmlEncode($scholarship_package->annual_amount->AdvancedSearch->SearchValue);

			// grant_package_grant_package_id
			$scholarship_package->grant_package_grant_package_id->EditCustomAttributes = "";
			$scholarship_package->grant_package_grant_package_id->EditValue = ew_HtmlEncode($scholarship_package->grant_package_grant_package_id->AdvancedSearch->SearchValue);

			// sponsored_student_sponsored_student_id
			$scholarship_package->sponsored_student_sponsored_student_id->EditCustomAttributes = "";
			$scholarship_package->sponsored_student_sponsored_student_id->EditValue = ew_HtmlEncode($scholarship_package->sponsored_student_sponsored_student_id->AdvancedSearch->SearchValue);

			// scholarship_type
			$scholarship_package->scholarship_type->EditCustomAttributes = "";
			$scholarship_package->scholarship_type->EditValue = ew_HtmlEncode($scholarship_package->scholarship_type->AdvancedSearch->SearchValue);

			// scholarship_type_scholarship_type
			$scholarship_package->scholarship_type_scholarship_type->EditCustomAttributes = "";
			$scholarship_package->scholarship_type_scholarship_type->EditValue = ew_HtmlEncode($scholarship_package->scholarship_type_scholarship_type->AdvancedSearch->SearchValue);

			// group_id
			$scholarship_package->group_id->EditCustomAttributes = "";
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
			$scholarship_package->group_id->EditValue = $arwrk;
			} else {
			$scholarship_package->group_id->EditValue = ew_HtmlEncode($scholarship_package->group_id->AdvancedSearch->SearchValue);
			}
		}

		// Call Row Rendered event
		if ($scholarship_package->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$scholarship_package->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $scholarship_package;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($scholarship_package->scholarship_package_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_package->scholarship_package_id->FldErrMsg();
		}
		if (!ew_CheckEuroDate($scholarship_package->start_date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_package->start_date->FldErrMsg();
		}
		if (!ew_CheckEuroDate($scholarship_package->end_date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_package->end_date->FldErrMsg();
		}
		if (!ew_CheckNumber($scholarship_package->annual_amount->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_package->annual_amount->FldErrMsg();
		}
		if (!ew_CheckInteger($scholarship_package->grant_package_grant_package_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_package->grant_package_grant_package_id->FldErrMsg();
		}
		if (!ew_CheckInteger($scholarship_package->sponsored_student_sponsored_student_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_package->sponsored_student_sponsored_student_id->FldErrMsg();
		}
		if (!ew_CheckInteger($scholarship_package->scholarship_type->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_package->scholarship_type->FldErrMsg();
		}
		if (!ew_CheckInteger($scholarship_package->scholarship_type_scholarship_type->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_package->scholarship_type_scholarship_type->FldErrMsg();
		}
		if (!ew_CheckInteger($scholarship_package->group_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $scholarship_package->group_id->FldErrMsg();
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
		global $scholarship_package;
		$scholarship_package->scholarship_package_id->AdvancedSearch->SearchValue = $scholarship_package->getAdvancedSearch("x_scholarship_package_id");
		$scholarship_package->start_date->AdvancedSearch->SearchValue = $scholarship_package->getAdvancedSearch("x_start_date");
		$scholarship_package->end_date->AdvancedSearch->SearchValue = $scholarship_package->getAdvancedSearch("x_end_date");
		$scholarship_package->status->AdvancedSearch->SearchValue = $scholarship_package->getAdvancedSearch("x_status");
		$scholarship_package->annual_amount->AdvancedSearch->SearchValue = $scholarship_package->getAdvancedSearch("x_annual_amount");
		$scholarship_package->grant_package_grant_package_id->AdvancedSearch->SearchValue = $scholarship_package->getAdvancedSearch("x_grant_package_grant_package_id");
		$scholarship_package->sponsored_student_sponsored_student_id->AdvancedSearch->SearchValue = $scholarship_package->getAdvancedSearch("x_sponsored_student_sponsored_student_id");
		$scholarship_package->scholarship_type->AdvancedSearch->SearchValue = $scholarship_package->getAdvancedSearch("x_scholarship_type");
		$scholarship_package->scholarship_type_scholarship_type->AdvancedSearch->SearchValue = $scholarship_package->getAdvancedSearch("x_scholarship_type_scholarship_type");
		$scholarship_package->group_id->AdvancedSearch->SearchValue = $scholarship_package->getAdvancedSearch("x_group_id");
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
