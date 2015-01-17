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
$scholarship_package_delete = new cscholarship_package_delete();
$Page =& $scholarship_package_delete;

// Page init
$scholarship_package_delete->Page_Init();

// Page main
$scholarship_package_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var scholarship_package_delete = new ew_Page("scholarship_package_delete");

// page properties
scholarship_package_delete.PageID = "delete"; // page ID
scholarship_package_delete.FormID = "fscholarship_packagedelete"; // form ID
var EW_PAGE_ID = scholarship_package_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
scholarship_package_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
scholarship_package_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
scholarship_package_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $scholarship_package_delete->LoadRecordset())
	$scholarship_package_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($scholarship_package_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$scholarship_package_delete->Page_Terminate("scholarship_packagelist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $scholarship_package->TableCaption() ?><br><br>
<a href="<?php echo $scholarship_package->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$scholarship_package_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="scholarship_package">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($scholarship_package_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $scholarship_package->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $scholarship_package->scholarship_package_id->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_package->start_date->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_package->end_date->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_package->status->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_package->annual_amount->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_package->grant_package_grant_package_id->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_package->sponsored_student_sponsored_student_id->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_package->scholarship_type->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_package->scholarship_type_scholarship_type->FldCaption() ?></td>
		<td valign="top"><?php echo $scholarship_package->group_id->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$scholarship_package_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$scholarship_package_delete->lRecCnt++;

	// Set row properties
	$scholarship_package->CssClass = "";
	$scholarship_package->CssStyle = "";
	$scholarship_package->RowAttrs = array();
	$scholarship_package->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$scholarship_package_delete->LoadRowValues($rs);

	// Render row
	$scholarship_package_delete->RenderRow();
?>
	<tr<?php echo $scholarship_package->RowAttributes() ?>>
		<td<?php echo $scholarship_package->scholarship_package_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->scholarship_package_id->ViewAttributes() ?>><?php echo $scholarship_package->scholarship_package_id->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_package->start_date->CellAttributes() ?>>
<div<?php echo $scholarship_package->start_date->ViewAttributes() ?>><?php echo $scholarship_package->start_date->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_package->end_date->CellAttributes() ?>>
<div<?php echo $scholarship_package->end_date->ViewAttributes() ?>><?php echo $scholarship_package->end_date->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_package->status->CellAttributes() ?>>
<div<?php echo $scholarship_package->status->ViewAttributes() ?>><?php echo $scholarship_package->status->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_package->annual_amount->CellAttributes() ?>>
<div<?php echo $scholarship_package->annual_amount->ViewAttributes() ?>><?php echo $scholarship_package->annual_amount->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_package->grant_package_grant_package_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->grant_package_grant_package_id->ViewAttributes() ?>><?php echo $scholarship_package->grant_package_grant_package_id->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_package->sponsored_student_sponsored_student_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->sponsored_student_sponsored_student_id->ViewAttributes() ?>><?php echo $scholarship_package->sponsored_student_sponsored_student_id->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_package->scholarship_type->CellAttributes() ?>>
<div<?php echo $scholarship_package->scholarship_type->ViewAttributes() ?>><?php echo $scholarship_package->scholarship_type->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_package->scholarship_type_scholarship_type->CellAttributes() ?>>
<div<?php echo $scholarship_package->scholarship_type_scholarship_type->ViewAttributes() ?>><?php echo $scholarship_package->scholarship_type_scholarship_type->ListViewValue() ?></div></td>
		<td<?php echo $scholarship_package->group_id->CellAttributes() ?>>
<div<?php echo $scholarship_package->group_id->ViewAttributes() ?>><?php echo $scholarship_package->group_id->ListViewValue() ?></div></td>
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
$scholarship_package_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cscholarship_package_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'scholarship_package';

	// Page object name
	var $PageObjName = 'scholarship_package_delete';

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
	function cscholarship_package_delete() {
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
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
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
		global $Language, $scholarship_package;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["scholarship_package_id"] <> "") {
			$scholarship_package->scholarship_package_id->setQueryStringValue($_GET["scholarship_package_id"]);
			if (!is_numeric($scholarship_package->scholarship_package_id->QueryStringValue))
				$this->Page_Terminate("scholarship_packagelist.php"); // Prevent SQL injection, exit
			$sKey .= $scholarship_package->scholarship_package_id->QueryStringValue;
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
			$this->Page_Terminate("scholarship_packagelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("scholarship_packagelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`scholarship_package_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in scholarship_package class, scholarship_packageinfo.php

		$scholarship_package->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$scholarship_package->CurrentAction = $_POST["a_delete"];
		} else {
			$scholarship_package->CurrentAction = "I"; // Display record
		}
		switch ($scholarship_package->CurrentAction) {
			case "D": // Delete
				$scholarship_package->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($scholarship_package->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $scholarship_package;
		$DeleteRows = TRUE;
		$sWrkFilter = $scholarship_package->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in scholarship_package class, scholarship_packageinfo.php

		$scholarship_package->CurrentFilter = $sWrkFilter;
		$sSql = $scholarship_package->SQL();
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
		$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $scholarship_package->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['scholarship_package_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($scholarship_package->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($scholarship_package->CancelMessage <> "") {
				$this->setMessage($scholarship_package->CancelMessage);
				$scholarship_package->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
			if ($DeleteRows) {
				foreach ($rsold as $row)
					$this->WriteAuditTrailOnDelete($row);
			}
			$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->RollbackTrans(); // Rollback changes
			$this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteRollback")); // Batch delete rollback
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$scholarship_package->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $scholarship_package;

		// Call Recordset Selecting event
		$scholarship_package->Recordset_Selecting($scholarship_package->CurrentFilter);

		// Load List page SQL
		$sSql = $scholarship_package->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$scholarship_package->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $scholarship_package;
		$sFilter = $scholarship_package->KeyFilter();

		// Call Row Selecting event
		$scholarship_package->Row_Selecting($sFilter);

		// Load SQL based on filter
		$scholarship_package->CurrentFilter = $sFilter;
		$sSql = $scholarship_package->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$scholarship_package->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $scholarship_package;
		$scholarship_package->scholarship_package_id->setDbValue($rs->fields('scholarship_package_id'));
		$scholarship_package->start_date->setDbValue($rs->fields('start_date'));
		$scholarship_package->end_date->setDbValue($rs->fields('end_date'));
		$scholarship_package->status->setDbValue($rs->fields('status'));
		$scholarship_package->annual_amount->setDbValue($rs->fields('annual_amount'));
		$scholarship_package->grant_package_grant_package_id->setDbValue($rs->fields('grant_package_grant_package_id'));
		$scholarship_package->sponsored_student_sponsored_student_id->setDbValue($rs->fields('sponsored_student_sponsored_student_id'));
		$scholarship_package->scholarship_type->setDbValue($rs->fields('scholarship_type'));
		$scholarship_package->scholarship_type_scholarship_type->setDbValue($rs->fields('scholarship_type_scholarship_type'));
		$scholarship_package->group_id->setDbValue($rs->fields('group_id'));
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
		}

		// Call Row Rendered event
		if ($scholarship_package->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$scholarship_package->Row_Rendered();
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'scholarship_package';
	  $usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $scholarship_package;
		$table = 'scholarship_package';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['scholarship_package_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $scholarship_package->fields) && $scholarship_package->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($scholarship_package->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					$oldvalue = "<MEMO>"; // Memo field
				} elseif ($scholarship_package->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$oldvalue = "<XML>"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
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
}
?>
