<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>

  <title>商品一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
</head>

<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>


  <div class="container">
    <h1>商品一覧</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <form action="index.php" class="text-right">
      <select name=sorting>
        <?php if ($sorting === '' || $sorting === 'new_arrival_order') { ?>
          <option value="new_arrival_order">新着順</option>
          <option value="cheaper_price">価格の安い順</option>
          <option value="higher_price">価格の高い順</option>
        <?php } else if ($sorting === 'cheaper_price') { ?>
          <option value="cheaper_price">価格の安い順</option>
          <option value="higher_price">価格の高い順</option>
          <option value="new_arrival_order">新着順</option>
        <?php } else if ($sorting === 'higher_price') { ?>
          <option value="higher_price">価格の高い順</option>
          <option value="new_arrival_order">新着順</option>
          <option value="cheaper_price">価格の安い順</option>
        <?php } ?>
      </select>
      <input type="submit" value="並べ替え" class="btn btn-primary">
    </form>
    <div class="card-deck">
      <div class="row w-100">
        <?php foreach ($items as $item) { ?>
          <div class="col-6 item">
            <div class="card h-100 text-center w-100">
              <div class="card-header">
                <?php print(h($item['name'])); ?>
              </div>
              <figure class="card-body">
                <img class="card-img" src="<?php print(IMAGE_PATH . h($item['image'])); ?>">
                <figcaption>
                  <?php print(number_format(h($item['price']))); ?>円
                  <?php if ($item['stock'] > 0) { ?>
                    <form action="index_add_cart.php" method="post">
                      <input type="submit" value="カートに追加" class="btn btn-primary btn-block">
                      <input type="hidden" name="item_id" value="<?php print(h($item['item_id'])); ?>">
                      <input type="hidden" value="<?php print $token; ?>" name="token">
                    </form>
                  <?php } else { ?>
                    <p class="text-danger">現在売り切れです。</p>
                  <?php } ?>
                </figcaption>
              </figure>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <div class=text-center>
      <span>
        <?php
        if ($now == $pages) {
          print $total_page['count'] . '件中' . ((($now - 1) * MAX_VIEW) + 1) . '-' . $total_page['count'] . '件目の商品';
        } else {
          print $total_page['count'] . '件中' . ((($now - 1) * MAX_VIEW) + 1) . '-' . $now * MAX_VIEW . '件目の商品';
        }
        ?>
      </span>
      <?php
      if($now>1){
        echo "<a href='?page=".($now-1)."&sorting=$sorting'>前へ</a>";
      }else{
        echo '前へ';
      }
      for ($n = 1; $n <= $pages; $n++) {
        if ($now == $n) {
          echo $now;
        } else {
          echo "<a href='?page=$n&sorting=$sorting'>$n</a>";
        }
      }
      if($now<$pages){
        echo "<a href='?page=".($now+1)."&sorting=$sorting'>次へ</a>";
      }else{
        echo '次へ';
      }
      ?>
    </div>
    <h1>人気ランキング</h1>
    <div class="card-deck">
      <div class="row">
        <?php foreach ($popular_item as $item) { ?>
          <div class="col-6 item">
            <div class="card h-100 text-center">
              <div class="card-header">
                <?php print(h($rank_count));
                $rank_count++; ?>位
                <?php print(h($item['name'])); ?>
              </div>
              <figure class="card-body">
                <img class="card-img" src="<?php print(IMAGE_PATH . h($item['image'])); ?>">
                <figcaption>
                  <?php print(number_format(h($item['price']))); ?>円
                  <?php if ($item['stock'] > 0) { ?>
                    <form action="index_add_cart.php" method="post">
                      <input type="submit" value="カートに追加" class="btn btn-primary btn-block">
                      <input type="hidden" name="item_id" value="<?php print(h($item['item_id'])); ?>">
                      <input type="hidden" value="<?php print $token; ?>" name="token">
                    </form>
                  <?php } else { ?>
                    <p class="text-danger">現在売り切れです。</p>
                  <?php } ?>
                </figcaption>
              </figure>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</body>

</html>