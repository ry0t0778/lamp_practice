<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_purchase_history($db, $user)
{
  $sql = '
    SELECT
      purchase_history.order_id,
      user_id,
      purchase_date,
      sum(purchase_price*amount) as total
    FROM
      purchase_history
    JOIN
      purchase_details
    ON
      purchase_history.order_id = purchase_details.order_id
    WHERE
      user_id = ? 
    GROUP BY
      purchase_history.order_id
    ORDER BY
      purchase_date desc   
      ';
  return fetch_all_query($db, $sql, [$user]);
}

function get_admin_purchase_history($db)
{
  $sql = '
  SELECT
    purchase_history.order_id,
    user_id,
    purchase_date,
    sum(purchase_price*amount) as total
  FROM
    purchase_history
  JOIN
    purchase_details
  ON
    purchase_history.order_id = purchase_details.order_id
  GROUP BY
    purchase_history.order_id
  ORDER BY
    purchase_date desc   
    ';
  return fetch_all_query($db, $sql);
}
function get_purchase_details($db, $user, $order_id)
{
  $sql = '
  SELECT
    purchase_details.order_id,
    purchase_details.item_id,
    purchase_price,
    amount,
    purchase_date,
    name
  FROM
    purchase_details
  JOIN
    items
  ON
    purchase_details.item_id = items.item_id
  JOIN
    purchase_history
  ON
    purchase_details.order_id = purchase_history.order_id
  WHERE
    user_id = ?
  AND
    purchase_details.order_id = ?
  ';
  return fetch_all_query($db, $sql, [$user, $order_id]);
}

function get_admin_purchase_details($db, $order_id)
{
  $sql = '
  SELECT
    purchase_details.order_id,
    purchase_details.item_id,
    purchase_price,
    amount,
    purchase_date,
    name
  FROM
    purchase_details
  JOIN
    items
  ON
    purchase_details.item_id = items.item_id
  JOIN
    purchase_history
  ON
    purchase_details.order_id = purchase_history.order_id
  WHERE
    purchase_details.order_id = ?
  ';
  return fetch_all_query($db, $sql, [$order_id]);
}

function sum_details($result)
{
  $total_price = 0;
  foreach ($result as $value) {
    $total_price += $value['purchase_price'] * $value['amount'];
  }
  return $total_price;
}
