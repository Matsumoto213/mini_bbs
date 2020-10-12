<?php
session_start();
require('dbconnect.php');


if(empty($_REQUEST['id'])){
  // idパラメータが空であったら、トップページに強制的に移動させる
  header('Location: index.php');
  exit();
}

// URLパラメータから取得されたIDを使って、メッセージを一件取得する
$posts=$db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=?');
$posts->execute(array($_REQUEST['id']));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ひとこと掲示板</title>

	<link rel="stylesheet" href="style.css" />
</head>

<body>
<div id="wrap">
  <div id="head">
    <h1>ひとこと掲示板</h1>
  </div>
  <div id="content">
  <p>&laquo;<a href="index.php">一覧にもどる</a></p>
<?php 
// postという変数に正常に値が入れば、メッセージがロードされた場合というif構文
if ($post =$posts->fetch()): ?>
    <div class="msg">
    <img src="member_picture/<?php print(htmlspecialchars($post['picture'])); ?>" />
    <p><?php print(htmlspecialchars($post['message'])); ?><span class="name">（<?php print(htmlspecialchars($post['name'])); ?>）</span></p>
    <p class="day"><?php print(htmlspecialchars($post['created'])); ?></p>
    </div> 
<!-- 値が正しく入らなかった場合 -->
<?php else: ?>
	<p>その投稿は削除されたか、URLが間違えています</p>
<?php endif; ?>
  </div>
</div>
</body>
</html>
