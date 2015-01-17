<?php

/**
  author: Aelaf T Dafla
  date:
  description: Parent class for all report classes. This class is used in genrating reports. This class communicates with DB
 */
include_once("adb.php");

class rep extends adb{


    var $rec;
    var $num_recs;
    var $offset;
    var $limit;
    var $cur_query;
    var $style_title;
    var $style_line1;
    var $style_line2;
    var $style_line;
    var $type;
    var $counter;
    var $page;
    var $tb;
    var $object_id;

    function rep($id="REP") {
        adb::adb();
        $this->offset = 0;
        $this->limit = 2;
        $this->counter = 0;

        $this->style_title = "default_report_title";
        $this->style_line1 = "default_report_line1";
        $this->style_line2 = "default_report_line2";
        $this->object_id=$id;
    }

    function set_result($result) {
        $this->result = $result;
    }

    function fetch() {
        if ($this->counter % 2) {
            $this->style_line = $this->style_line1;
        } else {
            $this->style_line = $this->style_line2;
        }

        $this->counter++;

        return mysql_fetch_assoc($this->result);
    }

    
    function save_query($query, $of, $lm, $page=1) {
        $_SESSION[$this->object_id]['QUERY'] = $query;
        $_SESSION[$this->object_id]['OFFSET'] = $of;
        $_SESSION[$this->object_id]['LIMIT'] = $lm;
        $_SESSION[$this->object_id]['PAGE'] = $page;
    }

    function get_saved_query() {
        return $_SESSION[$this->object_id]['QUERY'];
    }

    function next() {
        return $this->re_query(1);
    }

    function prev() {
        return $this->re_query(2);
    }

    function init_query($str_query) {
        $this->save_query($str_query, $this->offset, $this->limit);
        $query_result = $this->sql_query($str_query . " LIMIT {$this->offset} , {$this->limit} ");
        if ($query_result) {
            $n = $this->get_num_rows();
            if ($n < $this->limit) {
                //you have one page
                $this->page = 4;
            } else {
                $this->page = 1; //you are in first page
            }
        }

        $_SESSION[$this->object_id]['PAGE'] = $this->page;
        return $query_result;
    }

    function re_query($dir) {

        $query = $_SESSION[$this->object_id]['QUERY'];
        $of = $_SESSION[$this->object_id]['OFFSET'];
        $lm = $_SESSION[$this->object_id]['LIMIT'];
        $page = $_SESSION[$this->object_id]['PAGE'];

        //echo "off=$of,limit=$lm, page=$page|";
        if ($dir == 1) { //next
            //if you are not in the last page
            if ($page != 3) {
                $of = $of + $lm;
                $page = 2;
            }
        } elseif ($dir == 2) { //prev

            if ($page != 1) { //if you are not in the first page
                $of = $of - $lm;
                $page = 2;
            }

            if ($of <= 0) { //if you have reached the first page
                $of = 0;
                $page = 1; //you are in first page
            }
        }

        //echo "off=$of,limit=$lm, page=$page |";
        $str_query = $query . " LIMIT $of, $lm ";
        $rs = $this->sql_query($str_query);

        //echo $str_query;
        if ($rs) {
            $n = $this->get_num_rows();
            if ($n < $lm) {
                //you are in last page
                $page = 3;
            }
        }
        //echo "off=$of,limit=$lm, page=$page ";
        $_SESSION[$this->object_id]['OFFSET'] = $of;
        $_SESSION[$this->object_id]['LIMIT'] = $lm;
        $_SESSION[$this->object_id]['PAGE'] = $page;
        $this->page = $page;
        return $rs;
    }
}

?>
