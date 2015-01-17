<?php

// Global variable for table object
$scholarship_package = NULL;

//
// Table class for scholarship_package
//
class cscholarship_package {
	var $TableVar = 'scholarship_package';
	var $TableName = 'scholarship_package';
	var $TableType = 'TABLE';
	var $scholarship_package_id;
	var $start_date;
	var $end_date;
	var $status;
	var $annual_amount;
	var $grant_package_grant_package_id;
	var $sponsored_student_sponsored_student_id;
	var $scholarship_type;
	var $scholarship_type_scholarship_type;
	var $group_id;
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
	function cscholarship_package() {
		global $Language;

		// scholarship_package_id
		$this->scholarship_package_id = new cField('scholarship_package', 'scholarship_package', 'x_scholarship_package_id', 'scholarship_package_id', '`scholarship_package_id`', 3, -1, FALSE, '`scholarship_package_id`', FALSE);
		$this->scholarship_package_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['scholarship_package_id'] =& $this->scholarship_package_id;

		// start_date
		$this->start_date = new cField('scholarship_package', 'scholarship_package', 'x_start_date', 'start_date', '`start_date`', 135, -1, FALSE, '`start_date`', FALSE);
		$this->start_date->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['start_date'] =& $this->start_date;

		// end_date
		$this->end_date = new cField('scholarship_package', 'scholarship_package', 'x_end_date', 'end_date', '`end_date`', 135, -1, FALSE, '`end_date`', FALSE);
		$this->end_date->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['end_date'] =& $this->end_date;

		// status
		$this->status = new cField('scholarship_package', 'scholarship_package', 'x_status', 'status', '`status`', 3, -1, FALSE, '`status`', FALSE);
		$this->status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status'] =& $this->status;

		// annual_amount
		$this->annual_amount = new cField('scholarship_package', 'scholarship_package', 'x_annual_amount', 'annual_amount', '`annual_amount`', 131, -1, FALSE, '`annual_amount`', FALSE);
		$this->annual_amount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['annual_amount'] =& $this->annual_amount;

		// grant_package_grant_package_id
		$this->grant_package_grant_package_id = new cField('scholarship_package', 'scholarship_package', 'x_grant_package_grant_package_id', 'grant_package_grant_package_id', '`grant_package_grant_package_id`', 3, -1, FALSE, '`grant_package_grant_package_id`', FALSE);
		$this->grant_package_grant_package_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['grant_package_grant_package_id'] =& $this->grant_package_grant_package_id;

		// sponsored_student_sponsored_student_id
		$this->sponsored_student_sponsored_student_id = new cField('scholarship_package', 'scholarship_package', 'x_sponsored_student_sponsored_student_id', 'sponsored_student_sponsored_student_id', '`sponsored_student_sponsored_student_id`', 3, -1, FALSE, '`sponsored_student_sponsored_student_id`', FALSE);
		$this->sponsored_student_sponsored_student_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sponsored_student_sponsored_student_id'] =& $this->sponsored_student_sponsored_student_id;

		// scholarship_type
		$this->scholarship_type = new cField('scholarship_package', 'scholarship_package', 'x_scholarship_type', 'scholarship_type', '`scholarship_type`', 3, -1, FALSE, '`scholarship_type`', FALSE);
		$this->scholarship_type->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['scholarship_type'] =& $this->scholarship_type;

		// scholarship_type_scholarship_type
		$this->scholarship_type_scholarship_type = new cField('scholarship_package', 'scholarship_package', 'x_scholarship_type_scholarship_type', 'scholarship_type_scholarship_type', '`scholarship_type_scholarship_type`', 3, -1, FALSE, '`scholarship_type_scholarship_type`', FALSE);
		$this->scholarship_type_scholarship_type->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['scholarship_type_scholarship_type'] =& $this->scholarship_type_scholarship_type;

		// group_id
		$this->group_id = new cField('scholarship_package', 'scholarship_package', 'x_group_id', 'group_id', '`group_id`', 3, -1, FALSE, '`group_id`', FALSE);
		$this->group_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['group_id'] =& $this->group_id;
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
		return "scholarship_package_Highlight";
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

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function getMasterFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER];
	}

	function setMasterFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER] = $v;
	}

	// Session detail WHERE clause
	function getDetailFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER];
	}

	function setDetailFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER] = $v;
	}

	// Master filter
	function SqlMasterFilter_sponsored_student() {
		return "`sponsored_student_id`=@sponsored_student_id@";
	}

	// Detail filter
	function SqlDetailFilter_sponsored_student() {
		return "`sponsored_student_sponsored_student_id`=@sponsored_student_sponsored_student_id@";
	}

	// Master filter
	function SqlMasterFilter_sponsored_student_detail() {
		return "sponsored_student.sponsored_student_id=@sponsored_student_id@";
	}

	// Detail filter
	function SqlDetailFilter_sponsored_student_detail() {
		return "`sponsored_student_sponsored_student_id`=@sponsored_student_sponsored_student_id@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`scholarship_package`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
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
		global $Security;

		// Add User ID filter
		if (!$this->AllowAnonymousUser() && $Security->CurrentUserID() <> "" && !$Security->IsAdmin()) { // Non system admin
			$sFilter = $this->AddUserIDFilter($sFilter);
			if ($this->getCurrentMasterTable() == "sponsored_student")
				$sFilter = $this->AddDetailUserIDFilter($sFilter, "sponsored_student"); // Add detail User ID filter
			if ($this->getCurrentMasterTable() == "sponsored_student_detail")
				$sFilter = $this->AddDetailUserIDFilter($sFilter, "sponsored_student_detail"); // Add detail User ID filter
		}
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
		return "INSERT INTO `scholarship_package` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `scholarship_package` SET ";
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
		$SQL = "DELETE FROM `scholarship_package` WHERE ";
		$SQL .= ew_QuotedName('scholarship_package_id') . '=' . ew_QuotedValue($rs['scholarship_package_id'], $this->scholarship_package_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`scholarship_package_id` = @scholarship_package_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->scholarship_package_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@scholarship_package_id@", ew_AdjustSql($this->scholarship_package_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "scholarship_packagelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "scholarship_packagelist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("scholarship_packageview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "scholarship_packageadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("scholarship_packageedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("scholarship_packageadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("scholarship_packagedelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->scholarship_package_id->CurrentValue)) {
			$sUrl .= "scholarship_package_id=" . urlencode($this->scholarship_package_id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=scholarship_package" : "";
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
		$this->scholarship_package_id->setDbValue($rs->fields('scholarship_package_id'));
		$this->start_date->setDbValue($rs->fields('start_date'));
		$this->end_date->setDbValue($rs->fields('end_date'));
		$this->status->setDbValue($rs->fields('status'));
		$this->annual_amount->setDbValue($rs->fields('annual_amount'));
		$this->grant_package_grant_package_id->setDbValue($rs->fields('grant_package_grant_package_id'));
		$this->sponsored_student_sponsored_student_id->setDbValue($rs->fields('sponsored_student_sponsored_student_id'));
		$this->scholarship_type->setDbValue($rs->fields('scholarship_type'));
		$this->scholarship_type_scholarship_type->setDbValue($rs->fields('scholarship_type_scholarship_type'));
		$this->group_id->setDbValue($rs->fields('group_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// scholarship_package_id

		$this->scholarship_package_id->CellCssStyle = ""; $this->scholarship_package_id->CellCssClass = "";
		$this->scholarship_package_id->CellAttrs = array(); $this->scholarship_package_id->ViewAttrs = array(); $this->scholarship_package_id->EditAttrs = array();

		// start_date
		$this->start_date->CellCssStyle = ""; $this->start_date->CellCssClass = "";
		$this->start_date->CellAttrs = array(); $this->start_date->ViewAttrs = array(); $this->start_date->EditAttrs = array();

		// end_date
		$this->end_date->CellCssStyle = ""; $this->end_date->CellCssClass = "";
		$this->end_date->CellAttrs = array(); $this->end_date->ViewAttrs = array(); $this->end_date->EditAttrs = array();

		// status
		$this->status->CellCssStyle = ""; $this->status->CellCssClass = "";
		$this->status->CellAttrs = array(); $this->status->ViewAttrs = array(); $this->status->EditAttrs = array();

		// annual_amount
		$this->annual_amount->CellCssStyle = ""; $this->annual_amount->CellCssClass = "";
		$this->annual_amount->CellAttrs = array(); $this->annual_amount->ViewAttrs = array(); $this->annual_amount->EditAttrs = array();

		// grant_package_grant_package_id
		$this->grant_package_grant_package_id->CellCssStyle = ""; $this->grant_package_grant_package_id->CellCssClass = "";
		$this->grant_package_grant_package_id->CellAttrs = array(); $this->grant_package_grant_package_id->ViewAttrs = array(); $this->grant_package_grant_package_id->EditAttrs = array();

		// sponsored_student_sponsored_student_id
		$this->sponsored_student_sponsored_student_id->CellCssStyle = ""; $this->sponsored_student_sponsored_student_id->CellCssClass = "";
		$this->sponsored_student_sponsored_student_id->CellAttrs = array(); $this->sponsored_student_sponsored_student_id->ViewAttrs = array(); $this->sponsored_student_sponsored_student_id->EditAttrs = array();

		// scholarship_type
		$this->scholarship_type->CellCssStyle = ""; $this->scholarship_type->CellCssClass = "";
		$this->scholarship_type->CellAttrs = array(); $this->scholarship_type->ViewAttrs = array(); $this->scholarship_type->EditAttrs = array();

		// scholarship_type_scholarship_type
		$this->scholarship_type_scholarship_type->CellCssStyle = ""; $this->scholarship_type_scholarship_type->CellCssClass = "";
		$this->scholarship_type_scholarship_type->CellAttrs = array(); $this->scholarship_type_scholarship_type->ViewAttrs = array(); $this->scholarship_type_scholarship_type->EditAttrs = array();

		// scholarship_package_id
		$this->scholarship_package_id->ViewValue = $this->scholarship_package_id->CurrentValue;
		$this->scholarship_package_id->CssStyle = "";
		$this->scholarship_package_id->CssClass = "";
		$this->scholarship_package_id->ViewCustomAttributes = "";

		// start_date
		$this->start_date->ViewValue = $this->start_date->CurrentValue;
		$this->start_date->ViewValue = ew_FormatNumber($this->start_date->ViewValue, 0, 0, 0, 0);
		$this->start_date->CssStyle = "";
		$this->start_date->CssClass = "";
		$this->start_date->ViewCustomAttributes = "";

		// end_date
		$this->end_date->ViewValue = $this->end_date->CurrentValue;
		$this->end_date->ViewValue = ew_FormatNumber($this->end_date->ViewValue, 0, 0, 0, 0);
		$this->end_date->CssStyle = "";
		$this->end_date->CssClass = "";
		$this->end_date->ViewCustomAttributes = "";

		// status
		if (strval($this->status->CurrentValue) <> "") {
			switch ($this->status->CurrentValue) {
				case "active":
					$this->status->ViewValue = "Active";
					break;
				case "suspended":
					$this->status->ViewValue = "Suspended";
					break;
				default:
					$this->status->ViewValue = $this->status->CurrentValue;
			}
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->CssStyle = "";
		$this->status->CssClass = "";
		$this->status->ViewCustomAttributes = "";

		// annual_amount
		$this->annual_amount->ViewValue = $this->annual_amount->CurrentValue;
		$this->annual_amount->CssStyle = "";
		$this->annual_amount->CssClass = "";
		$this->annual_amount->ViewCustomAttributes = "";

		// grant_package_grant_package_id
		$this->grant_package_grant_package_id->ViewValue = $this->grant_package_grant_package_id->CurrentValue;
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

		// sponsored_student_sponsored_student_id
		$this->sponsored_student_sponsored_student_id->ViewValue = $this->sponsored_student_sponsored_student_id->CurrentValue;
		$this->sponsored_student_sponsored_student_id->CssStyle = "";
		$this->sponsored_student_sponsored_student_id->CssClass = "";
		$this->sponsored_student_sponsored_student_id->ViewCustomAttributes = "";

		// scholarship_type
		$this->scholarship_type->ViewValue = $this->scholarship_type->CurrentValue;
		if (strval($this->scholarship_type->CurrentValue) <> "") {
			$sFilterWrk = "`scholarship_type_id` = " . ew_AdjustSql($this->scholarship_type->CurrentValue) . "";
		$sSqlWrk = "SELECT `scholarship_type_name` FROM `scholarship_type`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->scholarship_type->ViewValue = $rswrk->fields('scholarship_type_name');
				$rswrk->Close();
			} else {
				$this->scholarship_type->ViewValue = $this->scholarship_type->CurrentValue;
			}
		} else {
			$this->scholarship_type->ViewValue = NULL;
		}
		$this->scholarship_type->CssStyle = "";
		$this->scholarship_type->CssClass = "";
		$this->scholarship_type->ViewCustomAttributes = "";

		// scholarship_type_scholarship_type
		$this->scholarship_type_scholarship_type->ViewValue = $this->scholarship_type_scholarship_type->CurrentValue;
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

		// scholarship_package_id
		$this->scholarship_package_id->HrefValue = "";
		$this->scholarship_package_id->TooltipValue = "";

		// start_date
		$this->start_date->HrefValue = "";
		$this->start_date->TooltipValue = "";

		// end_date
		$this->end_date->HrefValue = "";
		$this->end_date->TooltipValue = "";

		// status
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// annual_amount
		$this->annual_amount->HrefValue = "";
		$this->annual_amount->TooltipValue = "";

		// grant_package_grant_package_id
		$this->grant_package_grant_package_id->HrefValue = "";
		$this->grant_package_grant_package_id->TooltipValue = "";

		// sponsored_student_sponsored_student_id
		$this->sponsored_student_sponsored_student_id->HrefValue = "";
		$this->sponsored_student_sponsored_student_id->TooltipValue = "";

		// scholarship_type
		$this->scholarship_type->HrefValue = "";
		$this->scholarship_type->TooltipValue = "";

		// scholarship_type_scholarship_type
		$this->scholarship_type_scholarship_type->HrefValue = "";
		$this->scholarship_type_scholarship_type->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Add User ID filter
	function AddUserIDFilter($sFilter) {
		global $Security;
		$sFilterWrk = $Security->UserIDList();
		if (!$Security->IsAdmin() && $sFilterWrk <> "") {
			$sFilterWrk = '`group_id` IN (' . $sFilterWrk . ')';
			if ($sFilter <> "")
				$sFilterWrk = "(" . $sFilter . ") AND (" . $sFilterWrk . ")";
		} else {
			$sFilterWrk = $sFilter;
		}
		return $sFilterWrk;
	}

	// User ID subquery
	function GetUserIDSubquery(&$fld, &$masterfld) {
		global $conn;
		$sWrk = "";
		$sSql = "SELECT " . $masterfld->FldExpression . " FROM `scholarship_package` WHERE " . $this->AddUserIDFilter("");

		// List all values
		if ($rs = $conn->Execute($sSql)) {
			while (!$rs->EOF) {
				if ($sWrk <> "") $sWrk .= ",";
				$sWrk .= ew_QuotedValue($rs->fields[0], $masterfld->FldDataType);
				$rs->MoveNext();
			}
			$rs->Close();
		}
		if ($sWrk <> "") {
			$sWrk = $fld->FldExpression . " IN (" . $sWrk . ")";
		}
		return $sWrk;
	}

	// Add master User ID filter
	function AddMasterUserIDFilter($sFilter, $sCurrentMasterTable) {
		$sFilterWrk = $sFilter;
		if ($sCurrentMasterTable == "sponsored_student") {
			$sFilterWrk = $GLOBALS["sponsored_student"]->AddUserIDFilter($sFilterWrk);
		}
		return $sFilterWrk;
	}

	// Add detail User ID filter
	function AddDetailUserIDFilter($sFilter, $sCurrentMasterTable) {
		$sFilterWrk = $sFilter;
		if ($sCurrentMasterTable == "sponsored_student") {
			$sSubqueryWrk = $GLOBALS["sponsored_student"]->GetUserIDSubquery($this->sponsored_student_sponsored_student_id, $GLOBALS["sponsored_student"]->sponsored_student_id);
			if ($sSubqueryWrk <> "") {
				if ($sFilterWrk <> "") {
					$sFilterWrk = "($sFilterWrk) AND ($sSubqueryWrk)";
				} else {
					$sFilterWrk = $sSubqueryWrk;
				}
			}
		}
		return $sFilterWrk;
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
