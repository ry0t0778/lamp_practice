<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

if (is_logined() === false) {
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);
$token = get_csrf_token();

$total_page = get_total_page($db);
$pages = ceil($total_page['count'] / MAX_VIEW);
$now = get_now_page();
$sorting = get_get('sorting');
$items = get_open_items($db, $sorting, $now);


$popular_item = get_popular_items($db);
// ランキング初期値
$rank_count = 1;
include_once VIEW_PATH . 'index_view.php';
