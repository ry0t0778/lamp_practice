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
$order_id = get_get('code');

if (is_admin($user) === TRUE) {
  $purchase_details = get_admin_purchase_details($db, $order_id);
} else {
  $purchase_details = get_purchase_details($db, $user['user_id'], $order_id);
}
$total_price = sum_details($purchase_details);

include_once VIEW_PATH . 'purchase_details_view.php';
