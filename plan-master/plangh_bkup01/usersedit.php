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
$users_edit = new cusers_edit();
$Page =& $users_edit;

// Page init
$users_edit->Page_Init();

// Page main
$users_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var users_edit = new ew_Page("users_edit");

// page properties
users_edit.PageID = "edit"; // page ID
users_edit.FormID = "fusersedit"; // form ID
var EW_PAGE_ID = users_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
users_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_username"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($users->username->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_password"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($users->password->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
users_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
users_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
users_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $users->TableCaption() ?><br><br>
<a href="<?php echo $users->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$users_edit->ShowMessage();
?>
<form name="fusersedit" id="fusersedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return users_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="users">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($users->zuserid->Visible) { // userid ?>
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->zuserid->FldCaption() ?></td>
		<td<?php echo $users->zuserid->CellAttributes() ?>><span id="el_zuserid">
<div<?php echo $users->zuserid->ViewAttributes() ?>><?php echo $users->zuserid->EditValue ?></div><input type="hidden" name="x_zuserid" id="x_zuserid" value="<?php echo ew_HtmlEncode($users->zuserid->CurrentValue) ?>">
</span><?php echo $users->zuserid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($users->username->Visible) { // username ?>
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->username->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $users->username->CellAttributes() ?>><span id="el_username">
<input type="text" name="x_username" id="x_username" title="<?php echo $users->username->FldTitle() ?>" size="30" maxlength="30" value="<?php echo $users->username->EditValue ?>"<?php echo $users->username->EditAttributes() ?>>
</span><?php echo $users->username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($users->password->Visible) { // password ?>
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $users->password->CellAttributes() ?>><span id="el_password">
<input type="password" name="x_password" id="x_password" title="<?php echo $users->password->FldTitle() ?>" value="<?php echo $users->password->EditValue ?>" size="30" maxlength="30"<?php echo $users->password->EditAttributes() ?>>
</span><?php echo $users->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($users->userlevelid->Visible) { // userlevelid ?>
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->userlevelid->FldCaption() ?></td>
		<td<?php echo $users->userlevelid->CellAttributes() ?>><span id="el_userlevelid">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<select id="x_userlevelid" name="x_userlevelid" title="<?php echo $users->userlevelid->FldTitle() ?>"<?php echo $users->userlevelid->EditAttributes() ?>>
<?php
if (is_array($users->userlevelid->EditValue)) {
	$arwrk = $users->userlevelid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($users->userlevelid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($users->userlevelid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $users->userlevelid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($users->groupid->Visible) { // groupid ?>
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->groupid->FldCaption() ?></td>
		<td<?php echo $users->groupid->CellAttributes() ?>><span id="el_groupid">
<select id="x_groupid" name="x_groupid" title="<?php echo $users->groupid->FldTitle() ?>"<?php echo $users->groupid->EditAttributes() ?>>
<?php
if (is_array($users->groupid->EditValue)) {
	$arwrk = $users->groupid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($users->groupid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $users->groupid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($users->parentid->Visible) { // parentid ?>
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->parentid->FldCaption() ?></td>
		<td<?php echo $users->parentid->CellAttributes() ?>><span id="el_parentid">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<?php if (strval($users->userlevelid->CurrentValue) == strval(CurrentUserID())) { ?>
<div<?php echo $users->parentid->ViewAttributes() ?>><?php echo $users->parentid->EditValue ?></div>
<input type="hidden" name="x_parentid" id="x_parentid" value="<?php echo ew_HtmlEncode($users->parentid->CurrentValue) ?>">
<?php } else { ?>
<select id="x_parentid" name="x_parentid" title="<?php echo $users->parentid->FldTitle() ?>"<?php echo $users->parentid->EditAttributes() ?>>
<?php
if (is_array($users->parentid->EditValue)) {
	$arwrk = $users->parentid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($users->parentid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } else { ?>
<select id="x_parentid" name="x_parentid" title="<?php echo $users->parentid->FldTitle() ?>"<?php echo $users->parentid->EditAttributes() ?>>
<?php
if (is_array($users->parentid->EditValue)) {
	$arwrk = $users->parentid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($users->parentid->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $users->parentid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($users->programarea_programarea_id->Visible) { // programarea_programarea_id ?>
	<tr<?php echo $users->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $users->programarea_programarea_id->FldCaption() ?></td>
		<td<?php echo $users->programarea_programarea_id->CellAttributes() ?>><span id="el_programarea_programarea_id">
<select id="x_programarea_programarea_id" name="x_programarea_programarea_id" title="<?php echo $users->programarea_programarea_id->FldTitle() ?>"<?php echo $users->programarea_programarea_id->EditAttributes() ?>>
<?php
if (is_array($users->programarea_programarea_id->EditValue)) {
	$arwrk = $users->programarea_programarea_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($users->programarea_programarea_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $users->programarea_programarea_id->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$users_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cusers_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'users';

	// Page object name
	var $PageObjName = 'users_edit';

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
	function cusers_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (users)
		$GLOBALS["users"] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
		if (!$Security->CanEdit()) {
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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $users;

		// Load key from QueryString
		if (@$_GET["zuserid"] <> "")
			$users->zuserid->setQueryStringValue($_GET["zuserid"]);
		if (@$_POST["a_edit"] <> "") {
			$users->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$users->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$users->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$users->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($users->zuserid->CurrentValue == "")
			$this->Page_Terminate("userslist.php"); // Invalid key, return to list
		switch ($users->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("userslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$users->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $users->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$users->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$users->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $users;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $users;
		$users->zuserid->setFormValue($objForm->GetValue("x_zuserid"));
		$users->username->setFormValue($objForm->GetValue("x_username"));
		$users->password->setFormValue($objForm->GetValue("x_password"));
		$users->userlevelid->setFormValue($objForm->GetValue("x_userlevelid"));
		$users->groupid->setFormValue($objForm->GetValue("x_groupid"));
		$users->parentid->setFormValue($objForm->GetValue("x_parentid"));
		$users->programarea_programarea_id->setFormValue($objForm->GetValue("x_programarea_programarea_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $users;
		$this->LoadRow();
		$users->zuserid->CurrentValue = $users->zuserid->FormValue;
		$users->username->CurrentValue = $users->username->FormValue;
		$users->password->CurrentValue = $users->password->FormValue;
		$users->userlevelid->CurrentValue = $users->userlevelid->FormValue;
		$users->groupid->CurrentValue = $users->groupid->FormValue;
		$users->parentid->CurrentValue = $users->parentid->FormValue;
		$users->programarea_programarea_id->CurrentValue = $users->programarea_programarea_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $users;
		$sFilter = $users->KeyFilter();

		// Call Row Selecting event
		$users->Row_Selecting($sFilter);

		// Load SQL based on filter
		$users->CurrentFilter = $sFilter;
		$sSql = $users->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$users->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $users;
		$users->zuserid->setDbValue($rs->fields('userid'));
		$users->username->setDbValue($rs->fields('username'));
		$users->password->setDbValue($rs->fields('password'));
		$users->userlevelid->setDbValue($rs->fields('userlevelid'));
		$users->groupid->setDbValue($rs->fields('groupid'));
		$users->parentid->setDbValue($rs->fields('parentid'));
		$users->programarea_programarea_id->setDbValue($rs->fields('programarea_programarea_id'));
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
		} elseif ($users->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// userid
			$users->zuserid->EditCustomAttributes = "";
			$users->zuserid->EditValue = $users->zuserid->CurrentValue;
			$users->zuserid->CssStyle = "";
			$users->zuserid->CssClass = "";
			$users->zuserid->ViewCustomAttributes = "";

			// username
			$users->username->EditCustomAttributes = "";
			$users->username->EditValue = ew_HtmlEncode($users->username->CurrentValue);

			// password
			$users->password->EditCustomAttributes = "";
			$users->password->EditValue = ew_HtmlEncode($users->password->CurrentValue);

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
				if (strval($users->userlevelid->CurrentValue) == strval(CurrentUserID())) {
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
					$users->parentid->EditValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$users->parentid->EditValue = $users->parentid->CurrentValue;
				}
			} else {
				$users->parentid->EditValue = NULL;
			}
			$users->parentid->CssStyle = "";
			$users->parentid->CssClass = "";
			$users->parentid->ViewCustomAttributes = "";
				} else {
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
				}
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

			// Edit refer script
			// userid

			$users->zuserid->HrefValue = "";

			// username
			$users->username->HrefValue = "";

			// password
			$users->password->HrefValue = "";

			// userlevelid
			$users->userlevelid->HrefValue = "";

			// groupid
			$users->groupid->HrefValue = "";

			// parentid
			$users->parentid->HrefValue = "";

			// programarea_programarea_id
			$users->programarea_programarea_id->HrefValue = "";
		}

		// Call Row Rendered event
		if ($users->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$users->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $users;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($users->username->FormValue) && $users->username->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $users->username->FldCaption();
		}
		if (!is_null($users->password->FormValue) && $users->password->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $users->password->FldCaption();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $users;
		$sFilter = $users->KeyFilter();
		$users->CurrentFilter = $sFilter;
		$sSql = $users->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// username
			$users->username->SetDbValueDef($rsnew, $users->username->CurrentValue, "", FALSE);

			// password
			$users->password->SetDbValueDef($rsnew, $users->password->CurrentValue, "", FALSE);

			// userlevelid
						if ($Security->CanAdmin()) { // System admin
			$users->userlevelid->SetDbValueDef($rsnew, $users->userlevelid->CurrentValue, NULL, FALSE);
			}

			// groupid
			$users->groupid->SetDbValueDef($rsnew, $users->groupid->CurrentValue, NULL, FALSE);

			// parentid
			$users->parentid->SetDbValueDef($rsnew, $users->parentid->CurrentValue, NULL, FALSE);

			// programarea_programarea_id
			$users->programarea_programarea_id->SetDbValueDef($rsnew, $users->programarea_programarea_id->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $users->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($users->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($users->CancelMessage <> "") {
					$this->setMessage($users->CancelMessage);
					$users->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$users->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
