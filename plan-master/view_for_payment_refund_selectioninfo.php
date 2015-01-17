<?php

// Global variable for table object
$view_for_payment_refund_selection = NULL;

//
// Table class for view_for_payment_refund_selection
//
class cview_for_payment_refund_selection {
	var $TableVar = 'view_for_payment_refund_selection';
	var $TableName = 'view_for_payment_refund_selection';
	var $TableType = 'CUSTOMVIEW';
	var $sponsored_student_sponsored_student_id;
	var $scholarship_type_scholarship_type;
	var $grant_package_grant_package_id;
	var $schools_school_id;
	var $programarea_payingarea_id;
	var $programarea_residentarea_id;
	var $payment_request_payment_request_id;
	var $scholarship_package_scholarship_package_id;
	var $scholarship_payment_id;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message

	//
	// Table class constructor
	//
	function cview_for_payment_refund_selection() {
		global $Language;

		// sponsored_student_sponsored_student_id
		$this->sponsored_student_sponsored_student_id = new cField('view_for_payment_refund_selection', 'view_for_payment_refund_selection', 'x_sponsored_student_sponsored_student_id', 'sponsored_student_sponsored_student_id', 'scholarship_package.sponsored_student_sponsored_student_id', 3, -1, FALSE, 'scholarship_package.sponsored_student_sponsored_student_id', FALSE);
		$this->sponsored_student_sponsored_student_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sponsored_student_sponsored_student_id'] =& $this->sponsored_student_sponsored_student_id;

		// scholarship_type_scholarship_type
		$this->scholarship_type_scholarship_type = new cField('view_for_payment_refund_selection', 'view_for_payment_refund_selection', 'x_scholarship_type_scholarship_type', 'scholarship_type_scholarship_type', 'scholarship_package.scholarship_type_scholarship_type', 3, -1, FALSE, 'scholarship_package.scholarship_type_scholarship_type', FALSE);
		$this->scholarship_type_scholarship_type->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['scholarship_type_scholarship_type'] =& $this->scholarship_type_scholarship_type;

		// grant_package_grant_package_id
		$this->grant_package_grant_package_id = new cField('view_for_payment_refund_selection', 'view_for_payment_refund_selection', 'x_grant_package_grant_package_id', 'grant_package_grant_package_id', 'scholarship_package.grant_package_grant_package_id', 3, -1, FALSE, 'scholarship_package.grant_package_grant_package_id', FALSE);
		$this->grant_package_grant_package_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['grant_package_grant_package_id'] =& $this->grant_package_grant_package_id;

		// schools_school_id
		$this->schools_school_id = new cField('view_for_payment_refund_selection', 'view_for_payment_refund_selection', 'x_schools_school_id', 'schools_school_id', 'scholarship_payment.schools_school_id', 3, -1, FALSE, 'scholarship_payment.schools_school_id', FALSE);
		$this->schools_school_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['schools_school_id'] =& $this->schools_school_id;

		// programarea_payingarea_id
		$this->programarea_payingarea_id = new cField('view_for_payment_refund_selection', 'view_for_payment_refund_selection', 'x_programarea_payingarea_id', 'programarea_payingarea_id', 'scholarship_payment.programarea_payingarea_id', 3, -1, FALSE, 'scholarship_payment.programarea_payingarea_id', FALSE);
		$this->programarea_payingarea_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['programarea_payingarea_id'] =& $this->programarea_payingarea_id;

		// programarea_residentarea_id
		$this->programarea_residentarea_id = new cField('view_for_payment_refund_selection', 'view_for_payment_refund_selection', 'x_programarea_residentarea_id', 'programarea_residentarea_id', 'scholarship_payment.programarea_residentarea_id', 3, -1, FALSE, 'scholarship_payment.programarea_residentarea_id', FALSE);
		$this->programarea_residentarea_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['programarea_residentarea_id'] =& $this->programarea_residentarea_id;

		// payment_request_payment_request_id
		$this->payment_request_payment_request_id = new cField('view_for_payment_refund_selection', 'view_for_payment_refund_selection', 'x_payment_request_payment_request_id', 'payment_request_payment_request_id', 'scholarship_payment.payment_request_payment_request_id', 3, -1, FALSE, 'scholarship_payment.payment_request_payment_request_id', FALSE);
		$this->payment_request_payment_request_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['payment_request_payment_request_id'] =& $this->payment_request_payment_request_id;

		// scholarship_package_scholarship_package_id
		$this->scholarship_package_scholarship_package_id = new cField('view_for_payment_refund_selection', 'view_for_payment_refund_selection', 'x_scholarship_package_scholarship_package_id', 'scholarship_package_scholarship_package_id', 'scholarship_payment.scholarship_package_scholarship_package_id', 3, -1, FALSE, 'scholarship_payment.scholarship_package_scholarship_package_id', FALSE);
		$this->scholarship_package_scholarship_package_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['scholarship_package_scholarship_package_id'] =& $this->scholarship_package_scholarship_package_id;

		// scholarship_payment_id
		$this->scholarship_payment_id = new cField('view_for_payment_refund_selection', 'view_for_payment_refund_selection', 'x_scholarship_payment_id', 'scholarship_payment_id', 'scholarship_payment.scholarship_payment_id', 3, -1, FALSE, 'scholarship_payment.scholarship_payment_id', FALSE);
		$this->scholarship_payment_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['scholarship_payment_id'] =& $this->scholarship_payment_id;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "view_for_payment_refund_selection_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "scholarship_package Inner Join scholarship_payment On scholarship_package.scholarship_package_id = scholarship_payment.scholarship_package_scholarship_package_id";
	}

	function SqlSelect() { // Select
		return "SELECT scholarship_package.sponsored_student_sponsored_student_id, scholarship_package.scholarship_type_scholarship_type, scholarship_package.grant_package_grant_package_id, scholarship_payment.schools_school_id, scholarship_payment.programarea_payingarea_id, scholarship_payment.programarea_residentarea_id, scholarship_payment.payment_request_payment_request_id, scholarship_payment.scholarship_package_scholarship_package_id, scholarship_payment.scholarship_payment_id FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		if ($this->TableFilter <> "") {
			if ($sWhere <> "") $sWhere = "(" . $sWhere . ") AND (";
			$sWhere .= "(" . $this->TableFilter . ")";
		}
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "(" . $sFilter . ") AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO scholarship_package Inner Join scholarship_payment On scholarship_package.scholarship_package_id = scholarship_payment.scholarship_package_scholarship_package_id ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE scholarship_package Inner Join scholarship_payment On scholarship_package.scholarship_package_id = scholarship_payment.scholarship_package_scholarship_package_id SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM scholarship_package Inner Join scholarship_payment On scholarship_package.scholarship_package_id = scholarship_payment.scholarship_package_scholarship_package_id WHERE ";
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "view_for_payment_refund_selectionlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "view_for_payment_refund_selectionlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("view_for_payment_refund_selectionview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "view_for_payment_refund_selectionadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("view_for_payment_refund_selectionedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("view_for_payment_refund_selectionadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("view_for_payment_refund_selectiondelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=view_for_payment_refund_selection" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->sponsored_student_sponsored_student_id->setDbValue($rs->fields('sponsored_student_sponsored_student_id'));
		$this->scholarship_type_scholarship_type->setDbValue($rs->fields('scholarship_type_scholarship_type'));
		$this->grant_package_grant_package_id->setDbValue($rs->fields('grant_package_grant_package_id'));
		$this->schools_school_id->setDbValue($rs->fields('schools_school_id'));
		$this->programarea_payingarea_id->setDbValue($rs->fields('programarea_payingarea_id'));
		$this->programarea_residentarea_id->setDbValue($rs->fields('programarea_residentarea_id'));
		$this->payment_request_payment_request_id->setDbValue($rs->fields('payment_request_payment_request_id'));
		$this->scholarship_package_scholarship_package_id->setDbValue($rs->fields('scholarship_package_scholarship_package_id'));
		$this->scholarship_payment_id->setDbValue($rs->fields('scholarship_payment_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// sponsored_student_sponsored_student_id

		$this->sponsored_student_sponsored_student_id->CellCssStyle = ""; $this->sponsored_student_sponsored_student_id->CellCssClass = "";
		$this->sponsored_student_sponsored_student_id->CellAttrs = array(); $this->sponsored_student_sponsored_student_id->ViewAttrs = array(); $this->sponsored_student_sponsored_student_id->EditAttrs = array();

		// scholarship_type_scholarship_type
		$this->scholarship_type_scholarship_type->CellCssStyle = ""; $this->scholarship_type_scholarship_type->CellCssClass = "";
		$this->scholarship_type_scholarship_type->CellAttrs = array(); $this->scholarship_type_scholarship_type->ViewAttrs = array(); $this->scholarship_type_scholarship_type->EditAttrs = array();

		// grant_package_grant_package_id
		$this->grant_package_grant_package_id->CellCssStyle = ""; $this->grant_package_grant_package_id->CellCssClass = "";
		$this->grant_package_grant_package_id->CellAttrs = array(); $this->grant_package_grant_package_id->ViewAttrs = array(); $this->grant_package_grant_package_id->EditAttrs = array();

		// schools_school_id
		$this->schools_school_id->CellCssStyle = ""; $this->schools_school_id->CellCssClass = "";
		$this->schools_school_id->CellAttrs = array(); $this->schools_school_id->ViewAttrs = array(); $this->schools_school_id->EditAttrs = array();

		// programarea_payingarea_id
		$this->programarea_payingarea_id->CellCssStyle = ""; $this->programarea_payingarea_id->CellCssClass = "";
		$this->programarea_payingarea_id->CellAttrs = array(); $this->programarea_payingarea_id->ViewAttrs = array(); $this->programarea_payingarea_id->EditAttrs = array();

		// programarea_residentarea_id
		$this->programarea_residentarea_id->CellCssStyle = ""; $this->programarea_residentarea_id->CellCssClass = "";
		$this->programarea_residentarea_id->CellAttrs = array(); $this->programarea_residentarea_id->ViewAttrs = array(); $this->programarea_residentarea_id->EditAttrs = array();

		// payment_request_payment_request_id
		$this->payment_request_payment_request_id->CellCssStyle = ""; $this->payment_request_payment_request_id->CellCssClass = "";
		$this->payment_request_payment_request_id->CellAttrs = array(); $this->payment_request_payment_request_id->ViewAttrs = array(); $this->payment_request_payment_request_id->EditAttrs = array();

		// scholarship_package_scholarship_package_id
		$this->scholarship_package_scholarship_package_id->CellCssStyle = ""; $this->scholarship_package_scholarship_package_id->CellCssClass = "";
		$this->scholarship_package_scholarship_package_id->CellAttrs = array(); $this->scholarship_package_scholarship_package_id->ViewAttrs = array(); $this->scholarship_package_scholarship_package_id->EditAttrs = array();

		// scholarship_payment_id
		$this->scholarship_payment_id->CellCssStyle = ""; $this->scholarship_payment_id->CellCssClass = "";
		$this->scholarship_payment_id->CellAttrs = array(); $this->scholarship_payment_id->ViewAttrs = array(); $this->scholarship_payment_id->EditAttrs = array();

		// sponsored_student_sponsored_student_id
		if (strval($this->sponsored_student_sponsored_student_id->CurrentValue) <> "") {
			$sFilterWrk = "`sponsored_student_id` = " . ew_AdjustSql($this->sponsored_student_sponsored_student_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `student_lastname`, `student_firstname` FROM `sponsored_student`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->sponsored_student_sponsored_student_id->ViewValue = $rswrk->fields('student_lastname');
				$this->sponsored_student_sponsored_student_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('student_firstname');
				$rswrk->Close();
			} else {
				$this->sponsored_student_sponsored_student_id->ViewValue = $this->sponsored_student_sponsored_student_id->CurrentValue;
			}
		} else {
			$this->sponsored_student_sponsored_student_id->ViewValue = NULL;
		}
		$this->sponsored_student_sponsored_student_id->CssStyle = "";
		$this->sponsored_student_sponsored_student_id->CssClass = "";
		$this->sponsored_student_sponsored_student_id->ViewCustomAttributes = "";

		// scholarship_type_scholarship_type
		if (strval($this->scholarship_type_scholarship_type->CurrentValue) <> "") {
			$sFilterWrk = "`scholarship_type_id` = " . ew_AdjustSql($this->scholarship_type_scholarship_type->CurrentValue) . "";
		$sSqlWrk = "SELECT `scholarship_type_name` FROM `scholarship_type`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->scholarship_type_scholarship_type->ViewValue = $rswrk->fields('scholarship_type_name');
				$rswrk->Close();
			} else {
				$this->scholarship_type_scholarship_type->ViewValue = $this->scholarship_type_scholarship_type->CurrentValue;
			}
		} else {
			$this->scholarship_type_scholarship_type->ViewValue = NULL;
		}
		$this->scholarship_type_scholarship_type->CssStyle = "";
		$this->scholarship_type_scholarship_type->CssClass = "";
		$this->scholarship_type_scholarship_type->ViewCustomAttributes = "";

		// grant_package_grant_package_id
		if (strval($this->grant_package_grant_package_id->CurrentValue) <> "") {
			$sFilterWrk = "`grant_package_id` = " . ew_AdjustSql($this->grant_package_grant_package_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `name` FROM `grant_package`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->grant_package_grant_package_id->ViewValue = $rswrk->fields('name');
				$rswrk->Close();
			} else {
				$this->grant_package_grant_package_id->ViewValue = $this->grant_package_grant_package_id->CurrentValue;
			}
		} else {
			$this->grant_package_grant_package_id->ViewValue = NULL;
		}
		$this->grant_package_grant_package_id->CssStyle = "";
		$this->grant_package_grant_package_id->CssClass = "";
		$this->grant_package_grant_package_id->ViewCustomAttributes = "";

		// schools_school_id
		if (strval($this->schools_school_id->CurrentValue) <> "") {
			$sFilterWrk = "`school_id` = " . ew_AdjustSql($this->schools_school_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `school_name` FROM `schools`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->schools_school_id->ViewValue = $rswrk->fields('school_name');
				$rswrk->Close();
			} else {
				$this->schools_school_id->ViewValue = $this->schools_school_id->CurrentValue;
			}
		} else {
			$this->schools_school_id->ViewValue = NULL;
		}
		$this->schools_school_id->CssStyle = "";
		$this->schools_school_id->CssClass = "";
		$this->schools_school_id->ViewCustomAttributes = "";

		// programarea_payingarea_id
		if (strval($this->programarea_payingarea_id->CurrentValue) <> "") {
			$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($this->programarea_payingarea_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->programarea_payingarea_id->ViewValue = $rswrk->fields('programarea_name');
				$rswrk->Close();
			} else {
				$this->programarea_payingarea_id->ViewValue = $this->programarea_payingarea_id->CurrentValue;
			}
		} else {
			$this->programarea_payingarea_id->ViewValue = NULL;
		}
		$this->programarea_payingarea_id->CssStyle = "";
		$this->programarea_payingarea_id->CssClass = "";
		$this->programarea_payingarea_id->ViewCustomAttributes = "";

		// programarea_residentarea_id
		if (strval($this->programarea_residentarea_id->CurrentValue) <> "") {
			$sFilterWrk = "`programarea_id` = " . ew_AdjustSql($this->programarea_residentarea_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `programarea_name` FROM `programarea`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->programarea_residentarea_id->ViewValue = $rswrk->fields('programarea_name');
				$rswrk->Close();
			} else {
				$this->programarea_residentarea_id->ViewValue = $this->programarea_residentarea_id->CurrentValue;
			}
		} else {
			$this->programarea_residentarea_id->ViewValue = NULL;
		}
		$this->programarea_residentarea_id->CssStyle = "";
		$this->programarea_residentarea_id->CssClass = "";
		$this->programarea_residentarea_id->ViewCustomAttributes = "";

		// payment_request_payment_request_id
		if (strval($this->payment_request_payment_request_id->CurrentValue) <> "") {
			$sFilterWrk = "`payment_request_id` = " . ew_AdjustSql($this->payment_request_payment_request_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `code` FROM `payment_request`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->payment_request_payment_request_id->ViewValue = $rswrk->fields('code');
				$rswrk->Close();
			} else {
				$this->payment_request_payment_request_id->ViewValue = $this->payment_request_payment_request_id->CurrentValue;
			}
		} else {
			$this->payment_request_payment_request_id->ViewValue = NULL;
		}
		$this->payment_request_payment_request_id->CssStyle = "";
		$this->payment_request_payment_request_id->CssClass = "";
		$this->payment_request_payment_request_id->ViewCustomAttributes = "";

		// scholarship_package_scholarship_package_id
		if (strval($this->scholarship_package_scholarship_package_id->CurrentValue) <> "") {
			$sFilterWrk = "`scholarship_package_id` = " . ew_AdjustSql($this->scholarship_package_scholarship_package_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `group_id` FROM `scholarship_package`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->scholarship_package_scholarship_package_id->ViewValue = $rswrk->fields('group_id');
				$rswrk->Close();
			} else {
				$this->scholarship_package_scholarship_package_id->ViewValue = $this->scholarship_package_scholarship_package_id->CurrentValue;
			}
		} else {
			$this->scholarship_package_scholarship_package_id->ViewValue = NULL;
		}
		$this->scholarship_package_scholarship_package_id->CssStyle = "";
		$this->scholarship_package_scholarship_package_id->CssClass = "";
		$this->scholarship_package_scholarship_package_id->ViewCustomAttributes = "";

		// scholarship_payment_id
		$this->scholarship_payment_id->ViewValue = $this->scholarship_payment_id->CurrentValue;
		$this->scholarship_payment_id->CssStyle = "";
		$this->scholarship_payment_id->CssClass = "";
		$this->scholarship_payment_id->ViewCustomAttributes = "";

		// sponsored_student_sponsored_student_id
		$this->sponsored_student_sponsored_student_id->HrefValue = "";
		$this->sponsored_student_sponsored_student_id->TooltipValue = "";

		// scholarship_type_scholarship_type
		$this->scholarship_type_scholarship_type->HrefValue = "";
		$this->scholarship_type_scholarship_type->TooltipValue = "";

		// grant_package_grant_package_id
		$this->grant_package_grant_package_id->HrefValue = "";
		$this->grant_package_grant_package_id->TooltipValue = "";

		// schools_school_id
		$this->schools_school_id->HrefValue = "";
		$this->schools_school_id->TooltipValue = "";

		// programarea_payingarea_id
		$this->programarea_payingarea_id->HrefValue = "";
		$this->programarea_payingarea_id->TooltipValue = "";

		// programarea_residentarea_id
		$this->programarea_residentarea_id->HrefValue = "";
		$this->programarea_residentarea_id->TooltipValue = "";

		// payment_request_payment_request_id
		$this->payment_request_payment_request_id->HrefValue = "";
		$this->payment_request_payment_request_id->TooltipValue = "";

		// scholarship_package_scholarship_package_id
		$this->scholarship_package_scholarship_package_id->HrefValue = "";
		$this->scholarship_package_scholarship_package_id->TooltipValue = "";

		// scholarship_payment_id
		$this->scholarship_payment_id->HrefValue = "";
		$this->scholarship_payment_id->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict(&$rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
