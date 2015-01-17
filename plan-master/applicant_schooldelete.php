<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "applicant_schoolinfo.php" ?>
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
$applicant_school_delete = new capplicant_school_delete();
$Page =& $applicant_school_delete;

// Page init
$applicant_school_delete->Page_Init();

// Page main
$applicant_school_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var applicant_school_delete = new ew_Page("applicant_school_delete");

// page properties
applicant_school_delete.PageID = "delete"; // page ID
applicant_school_delete.FormID = "fapplicant_schooldelete"; // form ID
var EW_PAGE_ID = applicant_school_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
applicant_school_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
applicant_school_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
applicant_school_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $applicant_school_delete->LoadRecordset())
	$applicant_school_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($applicant_school_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$applicant_school_delete->Page_Terminate("applicant_schoollist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $applicant_school->TableCaption() ?><br><br>
<a href="<?php echo $applicant_school->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$applicant_school_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="applicant_school">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($applicant_school_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $applicant_school->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $applicant_school->applicant_school_name->FldCaption() ?></td>
		<td valign="top"><?php echo $applicant_school->applicant_school_type->FldCaption() ?></td>
		<td valign="top"><?php echo $applicant_school->applicant_school_category_applicant_school_category_id->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$applicant_school_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$applicant_school_delete->lRecCnt++;

	// Set row properties
	$applicant_school->CssClass = "";
	$applicant_school->CssStyle = "";
	$applicant_school->RowAttrs = array();
	$applicant_school->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$applicant_school_delete->LoadRowValues($rs);

	// Render row
	$applicant_school_delete->RenderRow();
?>
	<tr<?php echo $applicant_school->RowAttributes() ?>>
		<td<?php echo $applicant_school->applicant_school_name->CellAttributes() ?>>
<div<?php echo $applicant_school->applicant_school_name->ViewAttributes() ?>><?php echo $applicant_school->applicant_school_name->ListViewValue() ?></div></td>
		<td<?php echo $applicant_school->applicant_school_type->CellAttributes() ?>>
<div<?php echo $applicant_school->applicant_school_type->ViewAttributes() ?>><?php echo $applicant_school->applicant_school_type->ListViewValue() ?></div></td>
		<td<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->CellAttributes() ?>>
<div<?php echo $applicant_school->applicant_school_category_applicant_school_category_id->ViewAttributes() ?>><?php echo $applicant_school->applicant_school_category_applicant_school_category_id->ListViewValue() ?></div></td>
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
$applicant_school_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class capplicant_school_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'applicant_school';

	// Page object name
	var $PageObjName = 'applicant_school_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $applicant_school;
		if ($applicant_school->UseTokenInUrl) $PageUrl .= "t=" . $applicant_school->TableVar . "&"; // Add page token
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
		global $objForm, $applicant_school;
		if ($applicant_school->UseTokenInUrl) {
			if ($objForm)
				return ($applicant_school->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($applicant_school->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function capplicant_school_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (applicant_school)
		$GLOBALS["applicant_school"] = new capplicant_school();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'applicant_school', TRUE);

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
		global $applicant_school;

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
			$this->Page_Terminate("applicant_schoollist.php");
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
		global $Language, $applicant_school;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["applicant_school_id"] <> "") {
			$applicant_school->applicant_school_id->setQueryStringValue($_GET["applicant_school_id"]);
			if (!is_numeric($applicant_school->applicant_school_id->QueryStringValue))
				$this->Page_Terminate("applicant_schoollist.php"); // Prevent SQL injection, exit
			$sKey .= $applicant_school->applicant_school_id->QueryStringValue;
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
			$this->Page_Terminate("applicant_schoollist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("applicant_schoollist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`applicant_school_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in applicant_school class, applicant_schoolinfo.php

		$applicant_school->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$applicant_school->CurrentAction = $_POST["a_delete"];
		} else {
			$applicant_school->CurrentAction = "I"; // Display record
		}
		switch ($applicant_school->CurrentAction) {
			case "D": // Delete
				$applicant_school->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($applicant_school->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $applicant_school;
		$DeleteRows = TRUE;
		$sWrkFilter = $applicant_school->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in applicant_school class, applicant_schoolinfo.php

		$applicant_school->CurrentFilter = $sWrkFilter;
		$sSql = $applicant_school->SQL();
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
				$DeleteRows = $applicant_school->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['applicant_school_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($applicant_school->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($applicant_school->CancelMessage <> "") {
				$this->setMessage($applicant_school->CancelMessage);
				$applicant_school->CancelMessage = "";
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
				$applicant_school->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $applicant_school;

		// Call Recordset Selecting event
		$applicant_school->Recordset_Selecting($applicant_school->CurrentFilter);

		// Load List page SQL
		$sSql = $applicant_school->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$applicant_school->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $applicant_school;
		$sFilter = $applicant_school->KeyFilter();

		// Call Row Selecting event
		$applicant_school->Row_Selecting($sFilter);

		// Load SQL based on filter
		$applicant_school->CurrentFilter = $sFilter;
		$sSql = $applicant_school->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$applicant_school->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $applicant_school;
		$applicant_school->applicant_school_id->setDbValue($rs->fields('applicant_school_id'));
		$applicant_school->applicant_school_name->setDbValue($rs->fields('applicant_school_name'));
		$applicant_school->applicant_school_type->setDbValue($rs->fields('applicant_school_type'));
		$applicant_school->applicant_school_category_applicant_school_category_id->setDbValue($rs->fields('applicant_school_category_applicant_school_category_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $applicant_school;

		// Initialize URLs
		// Call Row_Rendering event

		$applicant_school->Row_Rendering();

		// Common render codes for all row types
		// applicant_school_name

		$applicant_school->applicant_school_name->CellCssStyle = ""; $applicant_school->applicant_school_name->CellCssClass = "";
		$applicant_school->applicant_school_name->CellAttrs = array(); $applicant_school->applicant_school_name->ViewAttrs = array(); $applicant_school->applicant_school_name->EditAttrs = array();

		// applicant_school_type
		$applicant_school->applicant_school_type->CellCssStyle = ""; $applicant_school->applicant_school_type->CellCssClass = "";
		$applicant_school->applicant_school_type->CellAttrs = array(); $applicant_school->applicant_school_type->ViewAttrs = array(); $applicant_school->applicant_school_type->EditAttrs = array();

		// applicant_school_category_applicant_school_category_id
		$applicant_school->applicant_school_category_applicant_school_category_id->CellCssStyle = ""; $applicant_school->applicant_school_category_applicant_school_category_id->CellCssClass = "";
		$applicant_school->applicant_school_category_applicant_school_category_id->CellAttrs = array(); $applicant_school->applicant_school_category_applicant_school_category_id->ViewAttrs = array(); $applicant_school->applicant_school_category_applicant_school_category_id->EditAttrs = array();
		if ($applicant_school->RowType == EW_ROWTYPE_VIEW) { // View row

			// applicant_school_id
			$applicant_school->applicant_school_id->ViewValue = $applicant_school->applicant_school_id->CurrentValue;
			if (strval($applicant_school->applicant_school_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_category_id` = " . ew_AdjustSql($applicant_school->applicant_school_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_category_name` FROM `applicant_school_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_id->ViewValue = $rswrk->fields('applicant_school_category_name');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_id->ViewValue = $applicant_school->applicant_school_id->CurrentValue;
				}
			} else {
				$applicant_school->applicant_school_id->ViewValue = NULL;
			}
			$applicant_school->applicant_school_id->CssStyle = "";
			$applicant_school->applicant_school_id->CssClass = "";
			$applicant_school->applicant_school_id->ViewCustomAttributes = "";

			// applicant_school_name
			$applicant_school->applicant_school_name->ViewValue = $applicant_school->applicant_school_name->CurrentValue;
			$applicant_school->applicant_school_name->CssStyle = "";
			$applicant_school->applicant_school_name->CssClass = "";
			$applicant_school->applicant_school_name->ViewCustomAttributes = "";

			// applicant_school_type
			if (strval($applicant_school->applicant_school_type->CurrentValue) <> "") {
				$sFilterWrk = "`school_type_id` = " . ew_AdjustSql($applicant_school->applicant_school_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `school_type` FROM `school_type`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_type->ViewValue = $rswrk->fields('school_type');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_type->ViewValue = $applicant_school->applicant_school_type->CurrentValue;
				}
			} else {
				$applicant_school->applicant_school_type->ViewValue = NULL;
			}
			$applicant_school->applicant_school_type->CssStyle = "";
			$applicant_school->applicant_school_type->CssClass = "";
			$applicant_school->applicant_school_type->ViewCustomAttributes = "";

			// applicant_school_category_applicant_school_category_id
			$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = $applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue;
			if (strval($applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue) <> "") {
				$sFilterWrk = "`applicant_school_category_id` = " . ew_AdjustSql($applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `applicant_school_category_name` FROM `applicant_school_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = $rswrk->fields('applicant_school_category_name');
					$rswrk->Close();
				} else {
					$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = $applicant_school->applicant_school_category_applicant_school_category_id->CurrentValue;
				}
			} else {
				$applicant_school->applicant_school_category_applicant_school_category_id->ViewValue = NULL;
			}
			$applicant_school->applicant_school_category_applicant_school_category_id->CssStyle = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->CssClass = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->ViewCustomAttributes = "";

			// applicant_school_name
			$applicant_school->applicant_school_name->HrefValue = "";
			$applicant_school->applicant_school_name->TooltipValue = "";

			// applicant_school_type
			$applicant_school->applicant_school_type->HrefValue = "";
			$applicant_school->applicant_school_type->TooltipValue = "";

			// applicant_school_category_applicant_school_category_id
			$applicant_school->applicant_school_category_applicant_school_category_id->HrefValue = "";
			$applicant_school->applicant_school_category_applicant_school_category_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($applicant_school->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$applicant_school->Row_Rendered();
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
