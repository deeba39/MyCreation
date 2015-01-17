<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "sponsored_studentinfo.php" ?>
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
$sponsored_student_search = new csponsored_student_search();
$Page =& $sponsored_student_search;

// Page init
$sponsored_student_search->Page_Init();

// Page main
$sponsored_student_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var sponsored_student_search = new ew_Page("sponsored_student_search");

// page properties
sponsored_student_search.PageID = "search"; // page ID
sponsored_student_search.FormID = "fsponsored_studentsearch"; // form ID
var EW_PAGE_ID = sponsored_student_search.PageID; // for backward compatibility

// extend page with validate function for search
sponsored_student_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_sponsored_student_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sponsored_student->sponsored_student_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_group_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sponsored_student->group_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_community_community_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sponsored_student->community_community_id->FldErrMsg()) ?>");

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
sponsored_student_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
sponsored_student_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sponsored_student_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $sponsored_student->TableCaption() ?><br><br>
<a href="<?php echo $sponsored_student->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$sponsored_student_search->ShowMessage();
?>
<form name="fsponsored_studentsearch" id="fsponsored_studentsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return sponsored_student_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="sponsored_student">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->sponsored_student_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student->sponsored_student_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_sponsored_student_id" id="z_sponsored_student_id" value="="></span></td>
		<td<?php echo $sponsored_student->sponsored_student_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_sponsored_student_id" id="x_sponsored_student_id" title="<?php echo $sponsored_student->sponsored_student_id->FldTitle() ?>" value="<?php echo $sponsored_student->sponsored_student_id->EditValue ?>"<?php echo $sponsored_student->sponsored_student_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_firstname->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_firstname->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_student_firstname" id="z_student_firstname" onchange="ew_SrchOprChanged('z_student_firstname')"><option value="="<?php echo ($sponsored_student->student_firstname->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($sponsored_student->student_firstname->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($sponsored_student->student_firstname->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($sponsored_student->student_firstname->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($sponsored_student->student_firstname->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($sponsored_student->student_firstname->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($sponsored_student->student_firstname->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($sponsored_student->student_firstname->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($sponsored_student->student_firstname->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($sponsored_student->student_firstname->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $sponsored_student->student_firstname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_firstname" id="x_student_firstname" title="<?php echo $sponsored_student->student_firstname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student->student_firstname->EditValue ?>"<?php echo $sponsored_student->student_firstname->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_student_firstname" name="btw1_student_firstname">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_student_firstname" name="btw1_student_firstname">
<input type="text" name="y_student_firstname" id="y_student_firstname" title="<?php echo $sponsored_student->student_firstname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student->student_firstname->EditValue2 ?>"<?php echo $sponsored_student->student_firstname->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_middlename->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_middlename->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_student_middlename" id="z_student_middlename" onchange="ew_SrchOprChanged('z_student_middlename')"><option value="="<?php echo ($sponsored_student->student_middlename->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($sponsored_student->student_middlename->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($sponsored_student->student_middlename->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($sponsored_student->student_middlename->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($sponsored_student->student_middlename->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($sponsored_student->student_middlename->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($sponsored_student->student_middlename->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($sponsored_student->student_middlename->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($sponsored_student->student_middlename->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($sponsored_student->student_middlename->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $sponsored_student->student_middlename->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_middlename" id="x_student_middlename" title="<?php echo $sponsored_student->student_middlename->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student->student_middlename->EditValue ?>"<?php echo $sponsored_student->student_middlename->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_student_middlename" name="btw1_student_middlename">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_student_middlename" name="btw1_student_middlename">
<input type="text" name="y_student_middlename" id="y_student_middlename" title="<?php echo $sponsored_student->student_middlename->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student->student_middlename->EditValue2 ?>"<?php echo $sponsored_student->student_middlename->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_lastname->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_lastname->CellAttributes() ?>><span class="ewSearchOpr"><select name="z_student_lastname" id="z_student_lastname" onchange="ew_SrchOprChanged('z_student_lastname')"><option value="="<?php echo ($sponsored_student->student_lastname->AdvancedSearch->SearchOperator=="=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("=") ?></option><option value="<>"<?php echo ($sponsored_student->student_lastname->AdvancedSearch->SearchOperator=="<>") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<>") ?></option><option value="<"<?php echo ($sponsored_student->student_lastname->AdvancedSearch->SearchOperator=="<") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<") ?></option><option value="<="<?php echo ($sponsored_student->student_lastname->AdvancedSearch->SearchOperator=="<=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("<=") ?></option><option value=">"<?php echo ($sponsored_student->student_lastname->AdvancedSearch->SearchOperator==">") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">") ?></option><option value=">="<?php echo ($sponsored_student->student_lastname->AdvancedSearch->SearchOperator==">=") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase(">=") ?></option><option value="LIKE"<?php echo ($sponsored_student->student_lastname->AdvancedSearch->SearchOperator=="LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("LIKE") ?></option><option value="NOT LIKE"<?php echo ($sponsored_student->student_lastname->AdvancedSearch->SearchOperator=="NOT LIKE") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("NOT LIKE") ?></option><option value="STARTS WITH"<?php echo ($sponsored_student->student_lastname->AdvancedSearch->SearchOperator=="STARTS WITH") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("STARTS WITH") ?></option><option value="BETWEEN"<?php echo ($sponsored_student->student_lastname->AdvancedSearch->SearchOperator=="BETWEEN") ? " selected=\"selected\"" : "" ?> ><?php echo $Language->Phrase("BETWEEN") ?></option></select></span></td>
		<td<?php echo $sponsored_student->student_lastname->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_lastname" id="x_student_lastname" title="<?php echo $sponsored_student->student_lastname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student->student_lastname->EditValue ?>"<?php echo $sponsored_student->student_lastname->EditAttributes() ?>>
</span>
				<span class="ewSearchOpr" style="display: none" id="btw1_student_lastname" name="btw1_student_lastname">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" style="display: none" id="btw1_student_lastname" name="btw1_student_lastname">
<input type="text" name="y_student_lastname" id="y_student_lastname" title="<?php echo $sponsored_student->student_lastname->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student->student_lastname->EditValue2 ?>"<?php echo $sponsored_student->student_lastname->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_grades->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_grades->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_student_grades" id="z_student_grades" value="LIKE"></span></td>
		<td<?php echo $sponsored_student->student_grades->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_student_grades" id="x_student_grades" title="<?php echo $sponsored_student->student_grades->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sponsored_student->student_grades->EditValue ?>"<?php echo $sponsored_student->student_grades->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->student_resident_programarea_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student->student_resident_programarea_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_student_resident_programarea_id" id="z_student_resident_programarea_id" value="="></span></td>
		<td<?php echo $sponsored_student->student_resident_programarea_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_student_resident_programarea_id" name="x_student_resident_programarea_id" title="<?php echo $sponsored_student->student_resident_programarea_id->FldTitle() ?>"<?php echo $sponsored_student->student_resident_programarea_id->EditAttributes() ?>>
<?php
if (is_array($sponsored_student->student_resident_programarea_id->EditValue)) {
	$arwrk = $sponsored_student->student_resident_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sponsored_student->student_resident_programarea_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->group_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student->group_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_group_id" id="z_group_id" value="="></span></td>
		<td<?php echo $sponsored_student->group_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_group_id" name="x_group_id" title="<?php echo $sponsored_student->group_id->FldTitle() ?>"<?php echo $sponsored_student->group_id->EditAttributes() ?>>
<?php
if (is_array($sponsored_student->group_id->EditValue)) {
	$arwrk = $sponsored_student->group_id->EditValue;
	if ($arwrk[0][0] <> "") echo "<option value=\"\">" . $Language->Phrase("PleaseSelect") . "</option>";
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sponsored_student->group_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="text" name="x_group_id" id="x_group_id" title="<?php echo $sponsored_student->group_id->FldTitle() ?>" size="30" value="<?php echo $sponsored_student->group_id->EditValue ?>"<?php echo $sponsored_student->group_id->EditAttributes() ?>>
<?php } ?>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sponsored_student->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $sponsored_student->community_community_id->FldCaption() ?></td>
		<td<?php echo $sponsored_student->community_community_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_community_community_id" id="z_community_community_id" value="="></span></td>
		<td<?php echo $sponsored_student->community_community_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_community_community_id" id="x_community_community_id" title="<?php echo $sponsored_student->community_community_id->FldTitle() ?>" size="30" value="<?php echo $sponsored_student->community_community_id->EditValue ?>"<?php echo $sponsored_student->community_community_id->EditAttributes() ?>>
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
ew_SrchOprChanged('z_student_firstname');
ew_SrchOprChanged('z_student_middlename');
ew_SrchOprChanged('z_student_lastname');

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
$sponsored_student_search->Page_Terminate();
?>
<?php

//
// Page class
//
class csponsored_student_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'sponsored_student';

	// Page object name
	var $PageObjName = 'sponsored_student_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $sponsored_student;
		if ($sponsored_student->UseTokenInUrl) $PageUrl .= "t=" . $sponsored_student->TableVar . "&"; // Add page token
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
		global $objForm, $sponsored_student;
		if ($sponsored_student->UseTokenInUrl) {
			if ($objForm)
				return ($sponsored_student->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($sponsored_student->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csponsored_student_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (sponsored_student)
		$GLOBALS["sponsored_student"] = new csponsored_student();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sponsored_student', TRUE);

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
		global $sponsored_student;

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
			$this->Page_Terminate("sponsored_studentlist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();
		if ($Security->IsLoggedIn() && $Security->CurrentUserID() == "") {
			$_SESSION[EW_SESSION_MESSAGE] = $Language->Phrase("NoPermission");
			$this->Page_Terminate("sponsored_studentlist.php");
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
		global $objForm, $Language, $gsSearchError, $sponsored_student;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$sponsored_student->CurrentAction = $objForm->GetValue("a_search");
			switch ($sponsored_student->CurrentAction) {
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
						$sSrchStr = $sponsored_student->UrlParm($sSrchStr);
						$this->Page_Terminate("sponsored_studentlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$sponsored_student->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $sponsored_student;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student->sponsored_student_id); // sponsored_student_id
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student->student_firstname); // student_firstname
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student->student_middlename); // student_middlename
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student->student_lastname); // student_lastname
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student->student_grades); // student_grades
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student->student_resident_programarea_id); // student_resident_programarea_id
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student->group_id); // group_id
	$this->BuildSearchUrl($sSrchUrl, $sponsored_student->community_community_id); // community_community_id
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
		global $objForm, $sponsored_student;

		// Load search values
		// sponsored_student_id

		$sponsored_student->sponsored_student_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_sponsored_student_id"));
		$sponsored_student->sponsored_student_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_sponsored_student_id");

		// student_firstname
		$sponsored_student->student_firstname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_firstname"));
		$sponsored_student->student_firstname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_firstname");
		$sponsored_student->student_firstname->AdvancedSearch->SearchCondition = $objForm->GetValue("v_student_firstname");
		$sponsored_student->student_firstname->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_student_firstname"));
		$sponsored_student->student_firstname->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_student_firstname");

		// student_middlename
		$sponsored_student->student_middlename->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_middlename"));
		$sponsored_student->student_middlename->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_middlename");
		$sponsored_student->student_middlename->AdvancedSearch->SearchCondition = $objForm->GetValue("v_student_middlename");
		$sponsored_student->student_middlename->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_student_middlename"));
		$sponsored_student->student_middlename->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_student_middlename");

		// student_lastname
		$sponsored_student->student_lastname->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_lastname"));
		$sponsored_student->student_lastname->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_lastname");
		$sponsored_student->student_lastname->AdvancedSearch->SearchCondition = $objForm->GetValue("v_student_lastname");
		$sponsored_student->student_lastname->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_student_lastname"));
		$sponsored_student->student_lastname->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_student_lastname");

		// student_grades
		$sponsored_student->student_grades->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_grades"));
		$sponsored_student->student_grades->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_grades");

		// student_resident_programarea_id
		$sponsored_student->student_resident_programarea_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_student_resident_programarea_id"));
		$sponsored_student->student_resident_programarea_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_student_resident_programarea_id");

		// group_id
		$sponsored_student->group_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_group_id"));
		$sponsored_student->group_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_group_id");

		// community_community_id
		$sponsored_student->community_community_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_community_community_id"));
		$sponsored_student->community_community_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_community_community_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $sponsored_student;

		// Initialize URLs
		// Call Row_Rendering event

		$sponsored_student->Row_Rendering();

		// Common render codes for all row types
		// sponsored_student_id

		$sponsored_student->sponsored_student_id->CellCssStyle = ""; $sponsored_student->sponsored_student_id->CellCssClass = "";
		$sponsored_student->sponsored_student_id->CellAttrs = array(); $sponsored_student->sponsored_student_id->ViewAttrs = array(); $sponsored_student->sponsored_student_id->EditAttrs = array();

		// student_firstname
		$sponsored_student->student_firstname->CellCssStyle = ""; $sponsored_student->student_firstname->CellCssClass = "";
		$sponsored_student->student_firstname->CellAttrs = array(); $sponsored_student->student_firstname->ViewAttrs = array(); $sponsored_student->student_firstname->EditAttrs = array();

		// student_middlename
		$sponsored_student->student_middlename->CellCssStyle = ""; $sponsored_student->student_middlename->CellCssClass = "";
		$sponsored_student->student_middlename->CellAttrs = array(); $sponsored_student->student_middlename->ViewAttrs = array(); $sponsored_student->student_middlename->EditAttrs = array();

		// student_lastname
		$sponsored_student->student_lastname->CellCssStyle = ""; $sponsored_student->student_lastname->CellCssClass = "";
		$sponsored_student->student_lastname->CellAttrs = array(); $sponsored_student->student_lastname->ViewAttrs = array(); $sponsored_student->student_lastname->EditAttrs = array();

		// student_grades
		$sponsored_student->student_grades->CellCssStyle = ""; $sponsored_student->student_grades->CellCssClass = "";
		$sponsored_student->student_grades->CellAttrs = array(); $sponsored_student->student_grades->ViewAttrs = array(); $sponsored_student->student_grades->EditAttrs = array();

		// student_resident_programarea_id
		$sponsored_student->student_resident_programarea_id->CellCssStyle = ""; $sponsored_student->student_resident_programarea_id->CellCssClass = "";
		$sponsored_student->student_resident_programarea_id->CellAttrs = array(); $sponsored_student->student_resident_programarea_id->ViewAttrs = array(); $sponsored_student->student_resident_programarea_id->EditAttrs = array();

		// group_id
		$sponsored_student->group_id->CellCssStyle = ""; $sponsored_student->group_id->CellCssClass = "";
		$sponsored_student->group_id->CellAttrs = array(); $sponsored_student->group_id->ViewAttrs = array(); $sponsored_student->group_id->EditAttrs = array();

		// community_community_id
		$sponsored_student->community_community_id->CellCssStyle = ""; $sponsored_student->community_community_id->CellCssClass = "";
		$sponsored_student->community_community_id->CellAttrs = array(); $sponsored_student->community_community_id->ViewAttrs = array(); $sponsored_student->community_community_id->EditAttrs = array();
		if ($sponsored_student->RowType == EW_ROWTYPE_VIEW) { // View row

			// sponsored_student_id
			$sponsored_student->sponsored_student_id->ViewValue = $sponsored_student->sponsored_student_id->CurrentValue;
			$sponsored_student->sponsored_student_id->CssStyle = "";
			$sponsored_student->sponsored_student_id->CssClass = "";
			$sponsored_student->sponsored_student_id->ViewCustomAttributes = "";

			// student_firstname
			$sponsored_student->student_firstname->ViewValue = $sponsored_student->student_firstname->CurrentValue;
			$sponsored_student->student_firstname->CssStyle = "";
			$sponsored_student->student_firstname->CssClass = "";
			$sponsored_student->student_firstname->ViewCustomAttributes = "";

			// student_middlename
			$sponsored_student->student_middlename->ViewValue = $sponsored_student->student_middlename->CurrentValue;
			$sponsored_student->student_middlename->CssStyle = "";
			$sponsored_student->student_middlename->CssClass = "";
			$sponsored_student->student_middlename->ViewCustomAttributes = "";

			// student_lastname
			$sponsored_student->student_lastname->ViewValue = $sponsored_student->student_lastname->CurrentValue;
			$sponsored_student->student_lastname->CssStyle = "";
			$sponsored_student->student_lastname->CssClass = "";
			$sponsored_student->student_lastname->ViewCustomAttributes = "";

			// student_grades
			$sponsored_student->student_grades->ViewValue = $sponsored_student->student_grades->CurrentValue;
			$sponsored_student->student_grades->CssStyle = "";
			$sponsored_student->student_grades->CssClass = "";
			$sponsored_student->student_grades->ViewCustomAttributes = "";

			// student_applicant_student_applicant_id
			$sponsored_student->student_applicant_student_applicant_id->ViewValue = $sponsored_student->student_applicant_student_applicant_id->CurrentValue;
			if (strval($sponsored_student->student_applicant_student_applicant_id->CurrentValue) <> "") {
				$sFilterWrk = "`student_applicant_id` = " . ew_AdjustSql($sponsored_student->student_applicant_student_applicant_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `student_lastname`, `student_firstname` FROM `student_applicant`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sponsored_student->student_applicant_student_applicant_id->ViewValue = $rswrk->fields('student_lastname');
					$sponsored_student->student_applicant_student_applicant_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('student_firstname');
					$rswrk->Close();
				} else {
					$sponsored_student->student_applicant_student_applicant_id->ViewValue = $sponsored_student->student_applicant_student_applicant_id->CurrentValue;
				}
			} else {
				$sponsored_student->student_applicant_student_applicant_id->ViewValue = NULL;
			}
			$sponsored_student->student_applicant_student_applicant_id->CssStyle = "";
			$sponsored_student->student_applicant_student_applicant_id->CssClass = "";
			$sponsored_student->student_applicant_student_applicant_id->ViewCustomAttributes = "";

			// student_resident_programarea_id
			if (strval($sponsored_student->student_resident_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($sponsored_student->student_resident_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sponsored_student->student_resident_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$sponsored_student->student_resident_programarea_id->ViewValue = $sponsored_student->student_resident_programarea_id->CurrentValue;
				}
			} else {
				$sponsored_student->student_resident_programarea_id->ViewValue = NULL;
			}
			$sponsored_student->student_resident_programarea_id->CssStyle = "";
			$sponsored_student->student_resident_programarea_id->CssClass = "";
			$sponsored_student->student_resident_programarea_id->ViewCustomAttributes = "";

			// group_id
			$sponsored_student->group_id->ViewValue = $sponsored_student->group_id->CurrentValue;
			$sponsored_student->group_id->CssStyle = "";
			$sponsored_student->group_id->CssClass = "";
			$sponsored_student->group_id->ViewCustomAttributes = "";

			// community_community_id
			$sponsored_student->community_community_id->ViewValue = $sponsored_student->community_community_id->CurrentValue;
			$sponsored_student->community_community_id->CssStyle = "";
			$sponsored_student->community_community_id->CssClass = "";
			$sponsored_student->community_community_id->ViewCustomAttributes = "";

			// sponsored_student_id
			$sponsored_student->sponsored_student_id->HrefValue = "";
			$sponsored_student->sponsored_student_id->TooltipValue = "";

			// student_firstname
			$sponsored_student->student_firstname->HrefValue = "";
			$sponsored_student->student_firstname->TooltipValue = "";

			// student_middlename
			$sponsored_student->student_middlename->HrefValue = "";
			$sponsored_student->student_middlename->TooltipValue = "";

			// student_lastname
			$sponsored_student->student_lastname->HrefValue = "";
			$sponsored_student->student_lastname->TooltipValue = "";

			// student_grades
			$sponsored_student->student_grades->HrefValue = "";
			$sponsored_student->student_grades->TooltipValue = "";

			// student_resident_programarea_id
			$sponsored_student->student_resident_programarea_id->HrefValue = "";
			$sponsored_student->student_resident_programarea_id->TooltipValue = "";

			// group_id
			$sponsored_student->group_id->HrefValue = "";
			$sponsored_student->group_id->TooltipValue = "";

			// community_community_id
			$sponsored_student->community_community_id->HrefValue = "";
			$sponsored_student->community_community_id->TooltipValue = "";
		} elseif ($sponsored_student->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// sponsored_student_id
			$sponsored_student->sponsored_student_id->EditCustomAttributes = "";
			$sponsored_student->sponsored_student_id->EditValue = ew_HtmlEncode($sponsored_student->sponsored_student_id->AdvancedSearch->SearchValue);

			// student_firstname
			$sponsored_student->student_firstname->EditCustomAttributes = "";
			$sponsored_student->student_firstname->EditValue = ew_HtmlEncode($sponsored_student->student_firstname->AdvancedSearch->SearchValue);
			$sponsored_student->student_firstname->EditCustomAttributes = "";
			$sponsored_student->student_firstname->EditValue2 = ew_HtmlEncode($sponsored_student->student_firstname->AdvancedSearch->SearchValue2);

			// student_middlename
			$sponsored_student->student_middlename->EditCustomAttributes = "";
			$sponsored_student->student_middlename->EditValue = ew_HtmlEncode($sponsored_student->student_middlename->AdvancedSearch->SearchValue);
			$sponsored_student->student_middlename->EditCustomAttributes = "";
			$sponsored_student->student_middlename->EditValue2 = ew_HtmlEncode($sponsored_student->student_middlename->AdvancedSearch->SearchValue2);

			// student_lastname
			$sponsored_student->student_lastname->EditCustomAttributes = "";
			$sponsored_student->student_lastname->EditValue = ew_HtmlEncode($sponsored_student->student_lastname->AdvancedSearch->SearchValue);
			$sponsored_student->student_lastname->EditCustomAttributes = "";
			$sponsored_student->student_lastname->EditValue2 = ew_HtmlEncode($sponsored_student->student_lastname->AdvancedSearch->SearchValue2);

			// student_grades
			$sponsored_student->student_grades->EditCustomAttributes = "";
			$sponsored_student->student_grades->EditValue = ew_HtmlEncode($sponsored_student->student_grades->AdvancedSearch->SearchValue);

			// student_resident_programarea_id
			$sponsored_student->student_resident_programarea_id->EditCustomAttributes = "";
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
			$sponsored_student->student_resident_programarea_id->EditValue = $arwrk;

			// group_id
			$sponsored_student->group_id->EditCustomAttributes = "";
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
			$sponsored_student->group_id->EditValue = $arwrk;
			} else {
			$sponsored_student->group_id->EditValue = ew_HtmlEncode($sponsored_student->group_id->AdvancedSearch->SearchValue);
			}

			// community_community_id
			$sponsored_student->community_community_id->EditCustomAttributes = "";
			$sponsored_student->community_community_id->EditValue = ew_HtmlEncode($sponsored_student->community_community_id->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($sponsored_student->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$sponsored_student->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $sponsored_student;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($sponsored_student->sponsored_student_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sponsored_student->sponsored_student_id->FldErrMsg();
		}
		if (!ew_CheckInteger($sponsored_student->group_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sponsored_student->group_id->FldErrMsg();
		}
		if (!ew_CheckInteger($sponsored_student->community_community_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sponsored_student->community_community_id->FldErrMsg();
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
		global $sponsored_student;
		$sponsored_student->sponsored_student_id->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_sponsored_student_id");
		$sponsored_student->student_firstname->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_student_firstname");
		$sponsored_student->student_firstname->AdvancedSearch->SearchOperator = $sponsored_student->getAdvancedSearch("z_student_firstname");
		$sponsored_student->student_firstname->AdvancedSearch->SearchValue2 = $sponsored_student->getAdvancedSearch("y_student_firstname");
		$sponsored_student->student_middlename->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_student_middlename");
		$sponsored_student->student_middlename->AdvancedSearch->SearchOperator = $sponsored_student->getAdvancedSearch("z_student_middlename");
		$sponsored_student->student_middlename->AdvancedSearch->SearchValue2 = $sponsored_student->getAdvancedSearch("y_student_middlename");
		$sponsored_student->student_lastname->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_student_lastname");
		$sponsored_student->student_lastname->AdvancedSearch->SearchOperator = $sponsored_student->getAdvancedSearch("z_student_lastname");
		$sponsored_student->student_lastname->AdvancedSearch->SearchValue2 = $sponsored_student->getAdvancedSearch("y_student_lastname");
		$sponsored_student->student_grades->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_student_grades");
		$sponsored_student->student_resident_programarea_id->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_student_resident_programarea_id");
		$sponsored_student->group_id->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_group_id");
		$sponsored_student->community_community_id->AdvancedSearch->SearchValue = $sponsored_student->getAdvancedSearch("x_community_community_id");
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
