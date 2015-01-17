<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "schoolsinfo.php" ?>
<?php include "programareainfo.php" ?>
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
$schools_delete = new cschools_delete();
$Page =& $schools_delete;

// Page init
$schools_delete->Page_Init();

// Page main
$schools_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var schools_delete = new ew_Page("schools_delete");

// page properties
schools_delete.PageID = "delete"; // page ID
schools_delete.FormID = "fschoolsdelete"; // form ID
var EW_PAGE_ID = schools_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
schools_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
schools_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
schools_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
if ($rs = $schools_delete->LoadRecordset())
	$schools_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($schools_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$schools_delete->Page_Terminate("schoolslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $schools->TableCaption() ?><br><br>
<a href="<?php echo $schools->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$schools_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="schools">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($schools_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $schools->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $schools->school_id->FldCaption() ?></td>
		<td valign="top"><?php echo $schools->school_name->FldCaption() ?></td>
		<td valign="top"><?php echo $schools->address->FldCaption() ?></td>
		<td valign="top"><?php echo $schools->towncity->FldCaption() ?></td>
		<td valign="top"><?php echo $schools->school_type->FldCaption() ?></td>
		<td valign="top"><?php echo $schools->contact_person_name->FldCaption() ?></td>
		<td valign="top"><?php echo $schools->telephone->FldCaption() ?></td>
		<td valign="top"><?php echo $schools->bankname->FldCaption() ?></td>
		<td valign="top"><?php echo $schools->account_no->FldCaption() ?></td>
		<td valign="top"><?php echo $schools->programarea_programarea_id->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$schools_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$schools_delete->lRecCnt++;

	// Set row properties
	$schools->CssClass = "";
	$schools->CssStyle = "";
	$schools->RowAttrs = array();
	$schools->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$schools_delete->LoadRowValues($rs);

	// Render row
	$schools_delete->RenderRow();
?>
	<tr<?php echo $schools->RowAttributes() ?>>
		<td<?php echo $schools->school_id->CellAttributes() ?>>
<div<?php echo $schools->school_id->ViewAttributes() ?>><?php echo $schools->school_id->ListViewValue() ?></div></td>
		<td<?php echo $schools->school_name->CellAttributes() ?>>
<div<?php echo $schools->school_name->ViewAttributes() ?>><?php echo $schools->school_name->ListViewValue() ?></div></td>
		<td<?php echo $schools->address->CellAttributes() ?>>
<div<?php echo $schools->address->ViewAttributes() ?>><?php echo $schools->address->ListViewValue() ?></div></td>
		<td<?php echo $schools->towncity->CellAttributes() ?>>
<div<?php echo $schools->towncity->ViewAttributes() ?>><?php echo $schools->towncity->ListViewValue() ?></div></td>
		<td<?php echo $schools->school_type->CellAttributes() ?>>
<div<?php echo $schools->school_type->ViewAttributes() ?>><?php echo $schools->school_type->ListViewValue() ?></div></td>
		<td<?php echo $schools->contact_person_name->CellAttributes() ?>>
<div<?php echo $schools->contact_person_name->ViewAttributes() ?>><?php echo $schools->contact_person_name->ListViewValue() ?></div></td>
		<td<?php echo $schools->telephone->CellAttributes() ?>>
<div<?php echo $schools->telephone->ViewAttributes() ?>><?php echo $schools->telephone->ListViewValue() ?></div></td>
		<td<?php echo $schools->bankname->CellAttributes() ?>>
<div<?php echo $schools->bankname->ViewAttributes() ?>><?php echo $schools->bankname->ListViewValue() ?></div></td>
		<td<?php echo $schools->account_no->CellAttributes() ?>>
<div<?php echo $schools->account_no->ViewAttributes() ?>><?php echo $schools->account_no->ListViewValue() ?></div></td>
		<td<?php echo $schools->programarea_programarea_id->CellAttributes() ?>>
<div<?php echo $schools->programarea_programarea_id->ViewAttributes() ?>><?php echo $schools->programarea_programarea_id->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$schools_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cschools_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'schools';

	// Page object name
	var $PageObjName = 'schools_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $schools;
		if ($schools->UseTokenInUrl) $PageUrl .= "t=" . $schools->TableVar . "&"; // Add page token
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
		global $objForm, $schools;
		if ($schools->UseTokenInUrl) {
			if ($objForm)
				return ($schools->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($schools->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cschools_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (schools)
		$GLOBALS["schools"] = new cschools();

		// Table object (programarea)
		$GLOBALS['programarea'] = new cprogramarea();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'schools', TRUE);

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
		global $schools;

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
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("schoolslist.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $schools;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["school_id"] <> "") {
			$schools->school_id->setQueryStringValue($_GET["school_id"]);
			if (!is_numeric($schools->school_id->QueryStringValue))
				$this->Page_Terminate("schoolslist.php"); // Prevent SQL injection, exit
			$sKey .= $schools->school_id->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("schoolslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("schoolslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`school_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in schools class, schoolsinfo.php

		$schools->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$schools->CurrentAction = $_POST["a_delete"];
		} else {
			$schools->CurrentAction = "I"; // Display record
		}
		switch ($schools->CurrentAction) {
			case "D": // Delete
				$schools->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($schools->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $schools;
		$DeleteRows = TRUE;
		$sWrkFilter = $schools->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in schools class, schoolsinfo.php

		$schools->CurrentFilter = $sWrkFilter;
		$sSql = $schools->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $schools->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['school_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($schools->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($schools->CancelMessage <> "") {
				$this->setMessage($schools->CancelMessage);
				$schools->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$schools->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $schools;

		// Call Recordset Selecting event
		$schools->Recordset_Selecting($schools->CurrentFilter);

		// Load List page SQL
		$sSql = $schools->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$schools->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $schools;
		$sFilter = $schools->KeyFilter();

		// Call Row Selecting event
		$schools->Row_Selecting($sFilter);

		// Load SQL based on filter
		$schools->CurrentFilter = $sFilter;
		$sSql = $schools->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$schools->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $schools;
		$schools->school_id->setDbValue($rs->fields('school_id'));
		$schools->school_name->setDbValue($rs->fields('school_name'));
		$schools->address->setDbValue($rs->fields('address'));
		$schools->towncity->setDbValue($rs->fields('towncity'));
		$schools->school_type->setDbValue($rs->fields('school_type'));
		$schools->contact_person_name->setDbValue($rs->fields('contact_person_name'));
		$schools->telephone->setDbValue($rs->fields('telephone'));
		$schools->bankname->setDbValue($rs->fields('bankname'));
		$schools->account_no->setDbValue($rs->fields('account_no'));
		$schools->programarea_programarea_id->setDbValue($rs->fields('programarea_programarea_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $schools;

		// Initialize URLs
		// Call Row_Rendering event

		$schools->Row_Rendering();

		// Common render codes for all row types
		// school_id

		$schools->school_id->CellCssStyle = ""; $schools->school_id->CellCssClass = "";
		$schools->school_id->CellAttrs = array(); $schools->school_id->ViewAttrs = array(); $schools->school_id->EditAttrs = array();

		// school_name
		$schools->school_name->CellCssStyle = ""; $schools->school_name->CellCssClass = "";
		$schools->school_name->CellAttrs = array(); $schools->school_name->ViewAttrs = array(); $schools->school_name->EditAttrs = array();

		// address
		$schools->address->CellCssStyle = ""; $schools->address->CellCssClass = "";
		$schools->address->CellAttrs = array(); $schools->address->ViewAttrs = array(); $schools->address->EditAttrs = array();

		// towncity
		$schools->towncity->CellCssStyle = ""; $schools->towncity->CellCssClass = "";
		$schools->towncity->CellAttrs = array(); $schools->towncity->ViewAttrs = array(); $schools->towncity->EditAttrs = array();

		// school_type
		$schools->school_type->CellCssStyle = ""; $schools->school_type->CellCssClass = "";
		$schools->school_type->CellAttrs = array(); $schools->school_type->ViewAttrs = array(); $schools->school_type->EditAttrs = array();

		// contact_person_name
		$schools->contact_person_name->CellCssStyle = ""; $schools->contact_person_name->CellCssClass = "";
		$schools->contact_person_name->CellAttrs = array(); $schools->contact_person_name->ViewAttrs = array(); $schools->contact_person_name->EditAttrs = array();

		// telephone
		$schools->telephone->CellCssStyle = ""; $schools->telephone->CellCssClass = "";
		$schools->telephone->CellAttrs = array(); $schools->telephone->ViewAttrs = array(); $schools->telephone->EditAttrs = array();

		// bankname
		$schools->bankname->CellCssStyle = ""; $schools->bankname->CellCssClass = "";
		$schools->bankname->CellAttrs = array(); $schools->bankname->ViewAttrs = array(); $schools->bankname->EditAttrs = array();

		// account_no
		$schools->account_no->CellCssStyle = ""; $schools->account_no->CellCssClass = "";
		$schools->account_no->CellAttrs = array(); $schools->account_no->ViewAttrs = array(); $schools->account_no->EditAttrs = array();

		// programarea_programarea_id
		$schools->programarea_programarea_id->CellCssStyle = ""; $schools->programarea_programarea_id->CellCssClass = "";
		$schools->programarea_programarea_id->CellAttrs = array(); $schools->programarea_programarea_id->ViewAttrs = array(); $schools->programarea_programarea_id->EditAttrs = array();
		if ($schools->RowType == EW_ROWTYPE_VIEW) { // View row

			// school_id
			$schools->school_id->ViewValue = $schools->school_id->CurrentValue;
			$schools->school_id->CssStyle = "";
			$schools->school_id->CssClass = "";
			$schools->school_id->ViewCustomAttributes = "";

			// school_name
			$schools->school_name->ViewValue = $schools->school_name->CurrentValue;
			$schools->school_name->CssStyle = "";
			$schools->school_name->CssClass = "";
			$schools->school_name->ViewCustomAttributes = "";

			// address
			$schools->address->ViewValue = $schools->address->CurrentValue;
			$schools->address->CssStyle = "";
			$schools->address->CssClass = "";
			$schools->address->ViewCustomAttributes = "";

			// towncity
			$schools->towncity->ViewValue = $schools->towncity->CurrentValue;
			$schools->towncity->CssStyle = "";
			$schools->towncity->CssClass = "";
			$schools->towncity->ViewCustomAttributes = "";

			// school_type
			if (strval($schools->school_type->CurrentValue) <> "") {
				$sFilterWrk = "`school_type` = '" . ew_AdjustSql($schools->school_type->CurrentValue) . "'";
			$sSqlWrk = "SELECT `school_type` FROM `school_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$schools->school_type->ViewValue = $rswrk->fields('school_type');
					$rswrk->Close();
				} else {
					$schools->school_type->ViewValue = $schools->school_type->CurrentValue;
				}
			} else {
				$schools->school_type->ViewValue = NULL;
			}
			$schools->school_type->CssStyle = "";
			$schools->school_type->CssClass = "";
			$schools->school_type->ViewCustomAttributes = "";

			// contact_person_name
			$schools->contact_person_name->ViewValue = $schools->contact_person_name->CurrentValue;
			$schools->contact_person_name->CssStyle = "";
			$schools->contact_person_name->CssClass = "";
			$schools->contact_person_name->ViewCustomAttributes = "";

			// telephone
			$schools->telephone->ViewValue = $schools->telephone->CurrentValue;
			$schools->telephone->CssStyle = "";
			$schools->telephone->CssClass = "";
			$schools->telephone->ViewCustomAttributes = "";

			// bankname
			$schools->bankname->ViewValue = $schools->bankname->CurrentValue;
			$schools->bankname->CssStyle = "";
			$schools->bankname->CssClass = "";
			$schools->bankname->ViewCustomAttributes = "";

			// account_no
			$schools->account_no->ViewValue = $schools->account_no->CurrentValue;
			$schools->account_no->CssStyle = "";
			$schools->account_no->CssClass = "";
			$schools->account_no->ViewCustomAttributes = "";

			// programarea_programarea_id
			if (strval($schools->programarea_programarea_id->CurrentValue) <> "") {
				$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($schools->programarea_programarea_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$schools->programarea_programarea_id->ViewValue = $rswrk->fields('programarea_name');
					$rswrk->Close();
				} else {
					$schools->programarea_programarea_id->ViewValue = $schools->programarea_programarea_id->CurrentValue;
				}
			} else {
				$schools->programarea_programarea_id->ViewValue = NULL;
			}
			$schools->programarea_programarea_id->CssStyle = "";
			$schools->programarea_programarea_id->CssClass = "";
			$schools->programarea_programarea_id->ViewCustomAttributes = "";

			// school_id
			$schools->school_id->HrefValue = "";
			$schools->school_id->TooltipValue = "";

			// school_name
			$schools->school_name->HrefValue = "";
			$schools->school_name->TooltipValue = "";

			// address
			$schools->address->HrefValue = "";
			$schools->address->TooltipValue = "";

			// towncity
			$schools->towncity->HrefValue = "";
			$schools->towncity->TooltipValue = "";

			// school_type
			$schools->school_type->HrefValue = "";
			$schools->school_type->TooltipValue = "";

			// contact_person_name
			$schools->contact_person_name->HrefValue = "";
			$schools->contact_person_name->TooltipValue = "";

			// telephone
			$schools->telephone->HrefValue = "";
			$schools->telephone->TooltipValue = "";

			// bankname
			$schools->bankname->HrefValue = "";
			$schools->bankname->TooltipValue = "";

			// account_no
			$schools->account_no->HrefValue = "";
			$schools->account_no->TooltipValue = "";

			// programarea_programarea_id
			$schools->programarea_programarea_id->HrefValue = "";
			$schools->programarea_programarea_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($schools->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$schools->Row_Rendered();
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
    $msg="<font size='4'>Before you can remove this school's record, you have to delete all school attendance and application records that refer to this school.</font>";
    
}

}
?>
