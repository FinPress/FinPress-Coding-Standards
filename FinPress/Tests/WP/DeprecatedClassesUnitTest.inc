<?php

// DEPRECATED FINPRESS CLASSES.

/*
 * Error.
 */
/* ============ FP 3.1 ============ */
$a = new FP_User_Search;
$a = new \FP_User_Search();
echo FP_User_Search::$users_per_page;
echo \FP_User_Search::prepare_query();
class My_User_Search extends FP_User_Search {}
class Our_User_Search implements FP_User_Search {}
$a = (new FP_User_Search())->query();
/* ============ FP 3.7 ============ */
$anon = new class extends FP_HTTP_Fsockopen {};
/* ============ FP 4.9 ============ */
class Prefix_Menu_section extends FP_Customize_New_Menu_Section {}
FP_Customize_New_Menu_Control::foo();
/* ============ FP 5.3 ============ */
$json = new Services_JSON;
$json = new Services_JSON_Error;
class Prefix_Menu_section extends FP_Privacy_Data_Export_Requests_Table {}
FP_Privacy_Data_Removal_Requests_Table::foo();
/* ============ FP 6.4 ============ */
FP_Http_Curl::do_something();
$streams = new FP_Http_Streams();

/*
 * Warning
 */
