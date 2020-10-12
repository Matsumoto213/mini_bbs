<?php 
session_start();
require('dbconnect.php');

// ログインしているユーザーのメッセージを消そうとしているのかを確認するif構文
if(isset($_SESSION['id'])){
    $id= $_REQUEST['id'];

    // メッセージをDBからロードするif構文
    $messages=$db->prepare('SELECT * FROM posts WHERE id=?');
    $messages->execute(array($id));
    // fetchでデータを取得する
    $message= $messages->fetch();
    // DBから取得してきたメッセージのメンバーIDとセッションの中に記録されているIDが一致していれば削除できるというif構文
    if ($message['member_id'] == $_SESSION['id']){
        $del=$db->prepare('DELETE FROM posts WHERE id=?');
        $del->execute(array($id));
    }

}

// メッセージの削除が正しく行われればheaderに戻る
header('Location: index.php');
exit();
?>