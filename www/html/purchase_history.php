<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'purchase_result.php';

session_start();

if (is_logined() === false) {
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

if (is_admin($user) === TRUE) {
  $purchase_history = get_admin_purchase_history($db);
} else {
  $purchase_history = get_purchase_history($db, $user['user_id']);
}

include_once VIEW_PATH . 'purchase_history_view.php';
