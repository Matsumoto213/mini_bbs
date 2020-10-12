<!-- セッションの情報を削除するといった作業が必要になる -->
<?php
session_start();


$_SESSION = array();
if(ini_set('session.use_cookies')){
    $params =session_get_cokkie_params();
    setcooki(session_name(). '', time() - 42000,
    $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
session_destroy();

setcookie('email', '', time()-3600);
header('Location: login.php');
exit();
?>