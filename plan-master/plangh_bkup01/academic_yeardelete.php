<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "academic_yearinfo.php" ?>
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
$academic_year_delete = new cacademic_year_delete();
$Page =& $academic_year_delete;

// Page init
$academic_year_delete->Page_Init();

// Page main
$academic_year_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var academic_year_delete = new ew_Page("academic_year_delete");

// page properties
academic_year_delete.PageID = "delete"; // page ID
academic_year_delete.FormID = "facademic_yeardelete"; // form ID
var EW_PAGE_ID = academic_year_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
academic_year_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
academic_year_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
academic_year_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $academic_year_delete->LoadRecordset())
	$academic_year_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($academic_year_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$academic_year_delete->Page_Terminate("academic_yearlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $academic_year->TableCaption() ?><br><br>
<a href="<?php echo $academic_year->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$academic_year_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="academic_year">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($academic_year_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $academic_year->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $academic_year->app_year->FldCaption() ?></td>
		<td valign="top"><?php echo $academic_year->active->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$academic_year_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$academic_year_delete->lRecCnt++;

	// Set row properties
	$academic_year->CssClass = "";
	$academic_year->CssStyle = "";
	$academic_year->RowAttrs = array();
	$academic_year->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$academic_year_delete->LoadRowValues($rs);

	// Render row
	$academic_year_delete->RenderRow();
?>
	<tr<?php echo $academic_year->RowAttributes() ?>>
		<td<?php echo $academic_year->app_year->CellAttributes() ?>>
<div<?php echo $academic_year->app_year->ViewAttributes() ?>><?php echo $academic_year->app_year->ListViewValue() ?></div></td>
		<td<?php echo $academic_year->active->CellAttributes() ?>>
<div<?php echo $academic_year->active->ViewAttributes() ?>><?php echo $academic_year->active->ListViewValue() ?></div></td>
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
$academic_year_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cacademic_year_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'academic_year';

	// Page object name
	var $PageObjName = 'academic_year_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $academic_year;
		if ($academic_year->UseTokenInUrl) $PageUrl .= "t=" . $academic_year->TableVar . "&"; // Add page token
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
		global $objForm, $academic_year;
		if ($academic_year->UseTokenInUrl) {
			if ($objForm)
				return ($academic_year->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($academic_year->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cacademic_year_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (academic_year)
		$GLOBALS["academic_year"] = new cacademic_year();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'academic_year', TRUE);

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
		global $academic_year;

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
			$this->Page_Terminate("academic_yearlist.php");
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
		global $Language, $academic_year;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["app_year"] <> "") {
			$academic_year->app_year->setQueryStringValue($_GET["app_year"]);
			if (!is_numeric($academic_year->app_year->QueryStringValue))
				$this->Page_Terminate("academic_yearlist.php"); // Prevent SQL injection, exit
			$sKey .= $academic_year->app_year->QueryStringValue;
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
			$this->Page_Terminate("academic_yearlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("academic_yearlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`app_year`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in academic_year class, academic_yearinfo.php

		$academic_year->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$academic_year->CurrentAction = $_POST["a_delete"];
		} else {
			$academic_year->CurrentAction = "I"; // Display record
		}
		switch ($academic_year->CurrentAction) {
			case "D": // Delete
				$academic_year->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($academic_year->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $academic_year;
		$DeleteRows = TRUE;
		$sWrkFilter = $academic_year->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in academic_year class, academic_yearinfo.php

		$academic_year->CurrentFilter = $sWrkFilter;
		$sSql = $academic_year->SQL();
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
				$DeleteRows = $academic_year->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['app_year'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($academic_year->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($academic_year->CancelMessage <> "") {
				$this->setMessage($academic_year->CancelMessage);
				$academic_year->CancelMessage = "";
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
				$academic_year->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $academic_year;

		// Call Recordset Selecting event
		$academic_year->Recordset_Selecting($academic_year->CurrentFilter);

		// Load List page SQL
		$sSql = $academic_year->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$academic_year->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $academic_year;
		$sFilter = $academic_year->KeyFilter();

		// Call Row Selecting event
		$academic_year->Row_Selecting($sFilter);

		// Load SQL based on filter
		$academic_year->CurrentFilter = $sFilter;
		$sSql = $academic_year->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$academic_year->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $academic_year;
		$academic_year->app_year->setDbValue($rs->fields('app_year'));
		$academic_year->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $academic_year;

		// Initialize URLs
		// Call Row_Rendering event

		$academic_year->Row_Rendering();

		// Common render codes for all row types
		// app_year

		$academic_year->app_year->CellCssStyle = ""; $academic_year->app_year->CellCssClass = "";
		$academic_year->app_year->CellAttrs = array(); $academic_year->app_year->ViewAttrs = array(); $academic_year->app_year->EditAttrs = array();

		// active
		$academic_year->active->CellCssStyle = ""; $academic_year->active->CellCssClass = "";
		$academic_year->active->CellAttrs = array(); $academic_year->active->ViewAttrs = array(); $academic_year->active->EditAttrs = array();
		if ($academic_year->RowType == EW_ROWTYPE_VIEW) { // View row

			// app_year
			$academic_year->app_year->ViewValue = $academic_year->app_year->CurrentValue;
			$academic_year->app_year->CssStyle = "";
			$academic_year->app_year->CssClass = "";
			$academic_year->app_year->ViewCustomAttributes = "";

			// active
			if (strval($academic_year->active->CurrentValue) <> "") {
				switch ($academic_year->active->CurrentValue) {
					case "ADMISSION":
						$academic_year->active->ViewValue = "ADMISSION";
						break;
					case "GRADE_RECORDING":
						$academic_year->active->ViewValue = "GRADE_RECORDING";
						break;
					case "INACTIVE":
						$academic_year->active->ViewValue = "INACTIVE";
						break;
					default:
						$academic_year->active->ViewValue = $academic_year->active->CurrentValue;
				}
			} else {
				$academic_year->active->ViewValue = NULL;
			}
			$academic_year->active->CssStyle = "";
			$academic_year->active->CssClass = "";
			$academic_year->active->ViewCustomAttributes = "";

			// app_year
			$academic_year->app_year->HrefValue = "";
			$academic_year->app_year->TooltipValue = "";

			// active
			$academic_year->active->HrefValue = "";
			$academic_year->active->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($academic_year->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$academic_year->Row_Rendered();
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
