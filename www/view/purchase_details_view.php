<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入履歴</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'cart.css'); ?>">
</head>

<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>購入明細</h1>
  <div class="container">

    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <p>注文番号：<?php print(h($order_id)); ?></p>
    <p>購入日時：<?php print(h($purchase_details[0]['purchase_date'])); ?></p>
    <p>合計金額：<?php print(h($total_price)); ?></p>
    <table class="table table-bordered">
      <thead class="thead-light">
        <th>商品名</th>
        <th>値段</th>
        <th>購入数</th>
        <th>小計</th>
      </thead>
      <tbody>
        <?php foreach ($purchase_details as $value) { ?>
          <tr>
            <td><?php print(h($value['name'])); ?></td>
            <td><?php print(h($value['purchase_price'])); ?>円</td>
            <td><?php print(h($value['amount'])); ?>個</td>
            <td><?php print(h($value['purchase_price'] * $value['amount'])); ?>円</td>
          </tr>
        <? } ?>
      </tbody>
    </table>
    　
  </div>
</body>

</html>