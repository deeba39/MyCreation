<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "application_statusinfo.php" ?>
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
$application_status_delete = new capplication_status_delete();
$Page =& $application_status_delete;

// Page init
$application_status_delete->Page_Init();

// Page main
$application_status_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var application_status_delete = new ew_Page("application_status_delete");

// page properties
application_status_delete.PageID = "delete"; // page ID
application_status_delete.FormID = "fapplication_statusdelete"; // form ID
var EW_PAGE_ID = application_status_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
application_status_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
application_status_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
application_status_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $application_status_delete->LoadRecordset())
	$application_status_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($application_status_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$application_status_delete->Page_Terminate("application_statuslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $application_status->TableCaption() ?><br><br>
<a href="<?php echo $application_status->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$application_status_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="application_status">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($application_status_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $application_status->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $application_status->application_status_id->FldCaption() ?></td>
		<td valign="top"><?php echo $application_status->application_status_1->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$application_status_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$application_status_delete->lRecCnt++;

	// Set row properties
	$application_status->CssClass = "";
	$application_status->CssStyle = "";
	$application_status->RowAttrs = array();
	$application_status->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$application_status_delete->LoadRowValues($rs);

	// Render row
	$application_status_delete->RenderRow();
?>
	<tr<?php echo $application_status->RowAttributes() ?>>
		<td<?php echo $application_status->application_status_id->CellAttributes() ?>>
<div<?php echo $application_status->application_status_id->ViewAttributes() ?>><?php echo $application_status->application_status_id->ListViewValue() ?></div></td>
		<td<?php echo $application_status->application_status_1->CellAttributes() ?>>
<div<?php echo $application_status->application_status_1->ViewAttributes() ?>><?php echo $application_status->application_status_1->ListViewValue() ?></div></td>
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
$application_status_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class capplication_status_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'application_status';

	// Page object name
	var $PageObjName = 'application_status_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $application_status;
		if ($application_status->UseTokenInUrl) $PageUrl .= "t=" . $application_status->TableVar . "&"; // Add page token
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
		global $objForm, $application_status;
		if ($application_status->UseTokenInUrl) {
			if ($objForm)
				return ($application_status->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($application_status->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function capplication_status_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (application_status)
		$GLOBALS["application_status"] = new capplication_status();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'application_status', TRUE);

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
		global $application_status;

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
			$this->Page_Terminate("application_statuslist.php");
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
		global $Language, $application_status;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["application_status_id"] <> "") {
			$application_status->application_status_id->setQueryStringValue($_GET["application_status_id"]);
			if (!is_numeric($application_status->application_status_id->QueryStringValue))
				$this->Page_Terminate("application_statuslist.php"); // Prevent SQL injection, exit
			$sKey .= $application_status->application_status_id->QueryStringValue;
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
			$this->Page_Terminate("application_statuslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("application_statuslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`application_status_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in application_status class, application_statusinfo.php

		$application_status->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$application_status->CurrentAction = $_POST["a_delete"];
		} else {
			$application_status->CurrentAction = "I"; // Display record
		}
		switch ($application_status->CurrentAction) {
			case "D": // Delete
				$application_status->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($application_status->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $application_status;
		$DeleteRows = TRUE;
		$sWrkFilter = $application_status->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in application_status class, application_statusinfo.php

		$application_status->CurrentFilter = $sWrkFilter;
		$sSql = $application_status->SQL();
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
				$DeleteRows = $application_status->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['application_status_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($application_status->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($application_status->CancelMessage <> "") {
				$this->setMessage($application_status->CancelMessage);
				$application_status->CancelMessage = "";
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
				$application_status->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $application_status;

		// Call Recordset Selecting event
		$application_status->Recordset_Selecting($application_status->CurrentFilter);

		// Load List page SQL
		$sSql = $application_status->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$application_status->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $application_status;
		$sFilter = $application_status->KeyFilter();

		// Call Row Selecting event
		$application_status->Row_Selecting($sFilter);

		// Load SQL based on filter
		$application_status->CurrentFilter = $sFilter;
		$sSql = $application_status->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$application_status->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $application_status;
		$application_status->application_status_id->setDbValue($rs->fields('application_status_id'));
		$application_status->application_status_1->setDbValue($rs->fields('application_status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $application_status;

		// Initialize URLs
		// Call Row_Rendering event

		$application_status->Row_Rendering();

		// Common render codes for all row types
		// application_status_id

		$application_status->application_status_id->CellCssStyle = ""; $application_status->application_status_id->CellCssClass = "";
		$application_status->application_status_id->CellAttrs = array(); $application_status->application_status_id->ViewAttrs = array(); $application_status->application_status_id->EditAttrs = array();

		// application_status
		$application_status->application_status_1->CellCssStyle = ""; $application_status->application_status_1->CellCssClass = "";
		$application_status->application_status_1->CellAttrs = array(); $application_status->application_status_1->ViewAttrs = array(); $application_status->application_status_1->EditAttrs = array();
		if ($application_status->RowType == EW_ROWTYPE_VIEW) { // View row

			// application_status_id
			$application_status->application_status_id->ViewValue = $application_status->application_status_id->CurrentValue;
			$application_status->application_status_id->CssStyle = "";
			$application_status->application_status_id->CssClass = "";
			$application_status->application_status_id->ViewCustomAttributes = "";

			// application_status
			$application_status->application_status_1->ViewValue = $application_status->application_status_1->CurrentValue;
			$application_status->application_status_1->CssStyle = "";
			$application_status->application_status_1->CssClass = "";
			$application_status->application_status_1->ViewCustomAttributes = "";

			// application_status_id
			$application_status->application_status_id->HrefValue = "";
			$application_status->application_status_id->TooltipValue = "";

			// application_status
			$application_status->application_status_1->HrefValue = "";
			$application_status->application_status_1->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($application_status->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$application_status->Row_Rendered();
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
