<?php

// Global variable for table object
$SelectionView = NULL;

//
// Table class for SelectionView
//
class cSelectionView {
	var $TableVar = 'SelectionView';
	var $TableName = 'SelectionView';
	var $TableType = 'CUSTOMVIEW';
	var $student_applicant_id;
	var $programarea_name;
	var $community;
	var $student_lastname;
	var $student_firstname;
	var $student_middlename;
	var $student_gender;
	var $student_dob;
	var $AGE;
	var $app_mother_occupation;
	var $app_father_occupation;
	var $app_guardian_occupation;
	var $app_points;
	var $applicant_school_name;
	var $student_grades;
	var $app_grant_id;
	var $app_amount;
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
	function cSelectionView() {
		global $Language;

		// student_applicant_id
		$this->student_applicant_id = new cField('SelectionView', 'SelectionView', 'x_student_applicant_id', 'student_applicant_id', 'student_applicant.student_applicant_id', 3, -1, FALSE, 'student_applicant.student_applicant_id', FALSE);
		$this->student_applicant_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['student_applicant_id'] =& $this->student_applicant_id;

		// programarea_name
		$this->programarea_name = new cField('SelectionView', 'SelectionView', 'x_programarea_name', 'programarea_name', 'programarea.programarea_name', 200, -1, FALSE, 'programarea.programarea_name', FALSE);
		$this->fields['programarea_name'] =& $this->programarea_name;

		// community
		$this->community = new cField('SelectionView', 'SelectionView', 'x_community', 'community', 'community.community', 200, -1, FALSE, 'community.community', FALSE);
		$this->fields['community'] =& $this->community;

		// student_lastname
		$this->student_lastname = new cField('SelectionView', 'SelectionView', 'x_student_lastname', 'student_lastname', 'student_applicant.student_lastname', 200, -1, FALSE, 'student_applicant.student_lastname', FALSE);
		$this->fields['student_lastname'] =& $this->student_lastname;

		// student_firstname
		$this->student_firstname = new cField('SelectionView', 'SelectionView', 'x_student_firstname', 'student_firstname', 'student_applicant.student_firstname', 200, -1, FALSE, 'student_applicant.student_firstname', FALSE);
		$this->fields['student_firstname'] =& $this->student_firstname;

		// student_middlename
		$this->student_middlename = new cField('SelectionView', 'SelectionView', 'x_student_middlename', 'student_middlename', 'student_applicant.student_middlename', 200, -1, FALSE, 'student_applicant.student_middlename', FALSE);
		$this->fields['student_middlename'] =& $this->student_middlename;

		// student_gender
		$this->student_gender = new cField('SelectionView', 'SelectionView', 'x_student_gender', 'student_gender', 'student_applicant.student_gender', 200, -1, FALSE, 'student_applicant.student_gender', FALSE);
		$this->fields['student_gender'] =& $this->student_gender;

		// student_dob
		$this->student_dob = new cField('SelectionView', 'SelectionView', 'x_student_dob', 'student_dob', 'student_applicant.student_dob', 135, 5, FALSE, 'student_applicant.student_dob', FALSE);
		$this->student_dob->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['student_dob'] =& $this->student_dob;

		// AGE
		$this->AGE = new cField('SelectionView', 'SelectionView', 'x_AGE', 'AGE', 'Year(Date_Sub(CurDate(), Interval \'1995-10\' Year_Month))', 20, -1, FALSE, 'Year(Date_Sub(CurDate(), Interval \'1995-10\' Year_Month))', FALSE);
		$this->AGE->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['AGE'] =& $this->AGE;

		// app_mother_occupation
		$this->app_mother_occupation = new cField('SelectionView', 'SelectionView', 'x_app_mother_occupation', 'app_mother_occupation', 'student_applicant.app_mother_occupation', 3, -1, FALSE, 'student_applicant.app_mother_occupation', FALSE);
		$this->app_mother_occupation->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_mother_occupation'] =& $this->app_mother_occupation;

		// app_father_occupation
		$this->app_father_occupation = new cField('SelectionView', 'SelectionView', 'x_app_father_occupation', 'app_father_occupation', 'student_applicant.app_father_occupation', 3, -1, FALSE, 'student_applicant.app_father_occupation', FALSE);
		$this->app_father_occupation->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_father_occupation'] =& $this->app_father_occupation;

		// app_guardian_occupation
		$this->app_guardian_occupation = new cField('SelectionView', 'SelectionView', 'x_app_guardian_occupation', 'app_guardian_occupation', 'student_applicant.app_guardian_occupation', 3, -1, FALSE, 'student_applicant.app_guardian_occupation', FALSE);
		$this->app_guardian_occupation->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_guardian_occupation'] =& $this->app_guardian_occupation;

		// app_points
		$this->app_points = new cField('SelectionView', 'SelectionView', 'x_app_points', 'app_points', 'student_applicant.app_points', 3, -1, FALSE, 'student_applicant.app_points', FALSE);
		$this->app_points->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_points'] =& $this->app_points;

		// applicant_school_name
		$this->applicant_school_name = new cField('SelectionView', 'SelectionView', 'x_applicant_school_name', 'applicant_school_name', 'applicant_school.applicant_school_name', 200, -1, FALSE, 'applicant_school.applicant_school_name', FALSE);
		$this->fields['applicant_school_name'] =& $this->applicant_school_name;

		// student_grades
		$this->student_grades = new cField('SelectionView', 'SelectionView', 'x_student_grades', 'student_grades', 'student_applicant.student_grades', 200, -1, FALSE, 'student_applicant.student_grades', FALSE);
		$this->fields['student_grades'] =& $this->student_grades;

		// app_grant_id
		$this->app_grant_id = new cField('SelectionView', 'SelectionView', 'x_app_grant_id', 'app_grant_id', 'student_applicant.app_grant_id', 3, -1, FALSE, 'student_applicant.app_grant_id', FALSE);
		$this->app_grant_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['app_grant_id'] =& $this->app_grant_id;

		// app_amount
		$this->app_amount = new cField('SelectionView', 'SelectionView', 'x_app_amount', 'app_amount', 'student_applicant.app_amount', 131, -1, FALSE, 'student_applicant.app_amount', FALSE);
		$this->app_amount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['app_amount'] =& $this->app_amount;
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
		return "SelectionView_Highlight";
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
		return "student_applicant Left Join programarea On programarea.programarea_id = student_applicant.student_resident_programarea_id Left Join community On student_applicant.community_community_id = community.community_id Left Join grant_package On student_applicant.app_grant_id = grant_package.grant_package_id Left Join applicant_school On applicant_school.applicant_school_id = student_applicant.app_junior_secondary_id";
	}

	function SqlSelect() { // Select
		return "SELECT programarea.programarea_name, community.community, student_applicant.student_lastname, student_applicant.student_firstname, student_applicant.student_middlename, student_applicant.student_gender, student_applicant.student_dob, Year(Date_Sub(CurDate(), Interval '1995-10' Year_Month)) As AGE, student_applicant.app_mother_occupation, student_applicant.app_father_occupation, student_applicant.app_guardian_occupation, student_applicant.app_points, applicant_school.applicant_school_name, student_applicant.student_grades, student_applicant.app_grant_id, student_applicant.app_amount, student_applicant.student_applicant_id FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "student_applicant.app_status <= 1";
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
		return "student_applicant.app_points Desc";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return ;
			case "edit":
			case "update":
				return ;
			case "delete":
				return ;
			case "view":
				return ;
			case "search":
				return ;
			default:
				return ;
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
		$str=ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
		//echo $str;
		return $str;
		
		
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
		return "INSERT INTO student_applicant Left Join programarea On programarea.programarea_id = student_applicant.student_resident_programarea_id Left Join community On student_applicant.community_community_id = community.community_id Left Join grant_package On student_applicant.app_grant_id = grant_package.grant_package_id Left Join applicant_school On applicant_school.applicant_school_id = student_applicant.app_junior_secondary_id ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE student_applicant Left Join programarea On programarea.programarea_id = student_applicant.student_resident_programarea_id Left Join community On student_applicant.community_community_id = community.community_id Left Join grant_package On student_applicant.app_grant_id = grant_package.grant_package_id Left Join applicant_school On applicant_school.applicant_school_id = student_applicant.app_junior_secondary_id SET ";
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
		$SQL = "DELETE FROM student_applicant Left Join programarea On programarea.programarea_id = student_applicant.student_resident_programarea_id Left Join community On student_applicant.community_community_id = community.community_id Left Join grant_package On student_applicant.app_grant_id = grant_package.grant_package_id Left Join applicant_school On applicant_school.applicant_school_id = student_applicant.app_junior_secondary_id WHERE ";
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
			return "SelectionViewlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "SelectionViewlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("SelectionViewview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "SelectionViewadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("SelectionViewedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("SelectionViewadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("SelectionViewdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=SelectionView" : "";
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
		$this->student_applicant_id->setDbValue($rs->fields('student_applicant_id'));
		$this->programarea_name->setDbValue($rs->fields('programarea_name'));
		$this->community->setDbValue($rs->fields('community'));
		$this->student_lastname->setDbValue($rs->fields('student_lastname'));
		$this->student_firstname->setDbValue($rs->fields('student_firstname'));
		$this->student_middlename->setDbValue($rs->fields('student_middlename'));
		$this->student_gender->setDbValue($rs->fields('student_gender'));
		$this->student_dob->setDbValue($rs->fields('student_dob'));
		$this->AGE->setDbValue($rs->fields('AGE'));
		$this->app_mother_occupation->setDbValue($rs->fields('app_mother_occupation'));
		$this->app_father_occupation->setDbValue($rs->fields('app_father_occupation'));
		$this->app_guardian_occupation->setDbValue($rs->fields('app_guardian_occupation'));
		$this->app_points->setDbValue($rs->fields('app_points'));
		$this->applicant_school_name->setDbValue($rs->fields('applicant_school_name'));
		$this->student_grades->setDbValue($rs->fields('student_grades'));
		$this->app_grant_id->setDbValue($rs->fields('app_grant_id'));
		$this->app_amount->setDbValue($rs->fields('app_amount'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// programarea_name

		$this->programarea_name->CellCssStyle = ""; $this->programarea_name->CellCssClass = "";
		$this->programarea_name->CellAttrs = array(); $this->programarea_name->ViewAttrs = array(); $this->programarea_name->EditAttrs = array();

		// community
		$this->community->CellCssStyle = ""; $this->community->CellCssClass = "";
		$this->community->CellAttrs = array(); $this->community->ViewAttrs = array(); $this->community->EditAttrs = array();

		// student_lastname
		$this->student_lastname->CellCssStyle = ""; $this->student_lastname->CellCssClass = "";
		$this->student_lastname->CellAttrs = array(); $this->student_lastname->ViewAttrs = array(); $this->student_lastname->EditAttrs = array();

		// student_firstname
		$this->student_firstname->CellCssStyle = ""; $this->student_firstname->CellCssClass = "";
		$this->student_firstname->CellAttrs = array(); $this->student_firstname->ViewAttrs = array(); $this->student_firstname->EditAttrs = array();

		// student_middlename
		$this->student_middlename->CellCssStyle = ""; $this->student_middlename->CellCssClass = "";
		$this->student_middlename->CellAttrs = array(); $this->student_middlename->ViewAttrs = array(); $this->student_middlename->EditAttrs = array();

		// student_gender
		$this->student_gender->CellCssStyle = ""; $this->student_gender->CellCssClass = "";
		$this->student_gender->CellAttrs = array(); $this->student_gender->ViewAttrs = array(); $this->student_gender->EditAttrs = array();

		// student_dob
		$this->student_dob->CellCssStyle = ""; $this->student_dob->CellCssClass = "";
		$this->student_dob->CellAttrs = array(); $this->student_dob->ViewAttrs = array(); $this->student_dob->EditAttrs = array();

		// app_mother_occupation
		$this->app_mother_occupation->CellCssStyle = ""; $this->app_mother_occupation->CellCssClass = "";
		$this->app_mother_occupation->CellAttrs = array(); $this->app_mother_occupation->ViewAttrs = array(); $this->app_mother_occupation->EditAttrs = array();

		// app_father_occupation
		$this->app_father_occupation->CellCssStyle = ""; $this->app_father_occupation->CellCssClass = "";
		$this->app_father_occupation->CellAttrs = array(); $this->app_father_occupation->ViewAttrs = array(); $this->app_father_occupation->EditAttrs = array();

		// app_guardian_occupation
		$this->app_guardian_occupation->CellCssStyle = ""; $this->app_guardian_occupation->CellCssClass = "";
		$this->app_guardian_occupation->CellAttrs = array(); $this->app_guardian_occupation->ViewAttrs = array(); $this->app_guardian_occupation->EditAttrs = array();

		// app_points
		$this->app_points->CellCssStyle = ""; $this->app_points->CellCssClass = "";
		$this->app_points->CellAttrs = array(); $this->app_points->ViewAttrs = array(); $this->app_points->EditAttrs = array();

		// applicant_school_name
		$this->applicant_school_name->CellCssStyle = ""; $this->applicant_school_name->CellCssClass = "";
		$this->applicant_school_name->CellAttrs = array(); $this->applicant_school_name->ViewAttrs = array(); $this->applicant_school_name->EditAttrs = array();

		// student_grades
		$this->student_grades->CellCssStyle = ""; $this->student_grades->CellCssClass = "";
		$this->student_grades->CellAttrs = array(); $this->student_grades->ViewAttrs = array(); $this->student_grades->EditAttrs = array();

		// programarea_name
		$this->programarea_name->ViewValue = $this->programarea_name->CurrentValue;
		$this->programarea_name->CssStyle = "";
		$this->programarea_name->CssClass = "";
		$this->programarea_name->ViewCustomAttributes = "";

		// community
		$this->community->ViewValue = $this->community->CurrentValue;
		$this->community->CssStyle = "";
		$this->community->CssClass = "";
		$this->community->ViewCustomAttributes = "";

		// student_lastname
		$this->student_lastname->ViewValue = $this->student_lastname->CurrentValue;
		$this->student_lastname->CssStyle = "font-weight:bold;";
		$this->student_lastname->CssClass = "";
		$this->student_lastname->ViewCustomAttributes = "";

		// student_firstname
		$this->student_firstname->ViewValue = $this->student_firstname->CurrentValue;
		$this->student_firstname->CssStyle = "";
		$this->student_firstname->CssClass = "";
		$this->student_firstname->ViewCustomAttributes = "";

		// student_middlename
		$this->student_middlename->ViewValue = $this->student_middlename->CurrentValue;
		$this->student_middlename->CssStyle = "";
		$this->student_middlename->CssClass = "";
		$this->student_middlename->ViewCustomAttributes = "";

		// student_gender
		if (strval($this->student_gender->CurrentValue) <> "") {
			switch ($this->student_gender->CurrentValue) {
				case "m":
					$this->student_gender->ViewValue = "male";
					break;
				case "f":
					$this->student_gender->ViewValue = "female";
					break;
				default:
					$this->student_gender->ViewValue = $this->student_gender->CurrentValue;
			}
		} else {
			$this->student_gender->ViewValue = NULL;
		}
		$this->student_gender->CssStyle = "";
		$this->student_gender->CssClass = "";
		$this->student_gender->ViewCustomAttributes = "";

		// student_dob
		$this->student_dob->ViewValue = $this->student_dob->CurrentValue;
		$this->student_dob->ViewValue = ew_FormatDateTime($this->student_dob->ViewValue, 5);
		$this->student_dob->CssStyle = "";
		$this->student_dob->CssClass = "";
		$this->student_dob->ViewCustomAttributes = "";

		// app_mother_occupation
		if (strval($this->app_mother_occupation->CurrentValue) <> "") {
			$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($this->app_mother_occupation->CurrentValue) . "";
		$sSqlWrk = "SELECT `name` FROM `application_occupation`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->app_mother_occupation->ViewValue = $rswrk->fields('name');
				$rswrk->Close();
			} else {
				$this->app_mother_occupation->ViewValue = $this->app_mother_occupation->CurrentValue;
			}
		} else {
			$this->app_mother_occupation->ViewValue = NULL;
		}
		$this->app_mother_occupation->CssStyle = "";
		$this->app_mother_occupation->CssClass = "";
		$this->app_mother_occupation->ViewCustomAttributes = "";

		// app_father_occupation
		if (strval($this->app_father_occupation->CurrentValue) <> "") {
			$sFilterWrk = "`application_occupation_id` = " . ew_AdjustSql($this->app_father_occupation->CurrentValue) . "";
		$sSqlWrk = "SELECT `name` FROM `application_occupation`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->app_father_occupation->ViewValue = $rswrk->fields('name');
				$rswrk->Close();
			} else {
				$this->app_father_occupation->ViewValue = $this->app_father_occupation->CurrentValue;
			}
		} else {
			$this->app_father_occupation->ViewValue = NULL;
		}
		$this->app_father_occupation->CssStyle = "";
		$this->app_father_occupation->CssClass = "";
		$this->app_father_occupation->ViewCustomAttributes = "";

		// app_guardian_occupation
		$this->app_guardian_occupation->CssStyle = "";
		$this->app_guardian_occupation->CssClass = "";
		$this->app_guardian_occupation->ViewCustomAttributes = "";

		// app_points
		$this->app_points->ViewValue = $this->app_points->CurrentValue;
		$this->app_points->CssStyle = "";
		$this->app_points->CssClass = "";
		$this->app_points->ViewCustomAttributes = "";

		// applicant_school_name
		$this->applicant_school_name->ViewValue = $this->applicant_school_name->CurrentValue;
		$this->applicant_school_name->CssStyle = "";
		$this->applicant_school_name->CssClass = "";
		$this->applicant_school_name->ViewCustomAttributes = "";

		// student_grades
		$this->student_grades->ViewValue = $this->student_grades->CurrentValue;
		$this->student_grades->CssStyle = "";
		$this->student_grades->CssClass = "";
		$this->student_grades->ViewCustomAttributes = "";

		// programarea_name
		if (!ew_Empty($this->programarea_name->CurrentValue)) {
			$this->programarea_name->HrefValue = ((!empty($this->programarea_name->ViewValue)) ? $this->programarea_name->ViewValue : $this->programarea_name->CurrentValue);
			if ($this->Export <> "") $SelectionView->programarea_name->HrefValue = ew_ConvertFullUrl($this->programarea_name->HrefValue);
		} else {
			$this->programarea_name->HrefValue = "";
		}
		$this->programarea_name->TooltipValue = "";

		// community
		$this->community->HrefValue = "";
		$this->community->TooltipValue = "";

		// student_lastname
		$this->student_lastname->HrefValue = "";
		$this->student_lastname->TooltipValue = "";

		// student_firstname
		$this->student_firstname->HrefValue = "";
		$this->student_firstname->TooltipValue = "";

		// student_middlename
		$this->student_middlename->HrefValue = "";
		$this->student_middlename->TooltipValue = "";

		// student_gender
		$this->student_gender->HrefValue = "";
		$this->student_gender->TooltipValue = "";

		// student_dob
		$this->student_dob->HrefValue = "";
		$this->student_dob->TooltipValue = "";

		// app_mother_occupation
		$this->app_mother_occupation->HrefValue = "";
		$this->app_mother_occupation->TooltipValue = "";

		// app_father_occupation
		$this->app_father_occupation->HrefValue = "";
		$this->app_father_occupation->TooltipValue = "";

		// app_guardian_occupation
		$this->app_guardian_occupation->HrefValue = "";
		$this->app_guardian_occupation->TooltipValue = "";

		// app_points
		$this->app_points->HrefValue = "";
		$this->app_points->TooltipValue = "";

		// applicant_school_name
		$this->applicant_school_name->HrefValue = "";
		$this->applicant_school_name->TooltipValue = "";

		// student_grades
		$this->student_grades->HrefValue = "";
		$this->student_grades->TooltipValue = "";

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
		// Enter your code here	
		global $app_year;
		if($app_year==false){
			$filter="0";	//dont select any record if active year is unknown
			return;
		}
        
        if($_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"]==0){	//user can select the programarea
            if(!isset($_REQUEST['programarea_id'])){
                $porgramarea_id=0;                       //if user has not selected
            }else{
                $porgramarea_id=$_REQUEST['programarea_id'];              //user has selcted 
            }                    
           
        }else{
           $porgramarea_id=$_SESSION[EW_PROJECT_NAME]["PROGRAM_AREA"];           //user cannot select a programarea
        }
		
        $filter="student_applicant.app_submission_year=$app_year AND student_applicant.student_resident_programarea_id=$porgramarea_id"; 

		
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
