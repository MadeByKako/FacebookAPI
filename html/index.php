<?php  
/*
 *Facebook Graph APIを使用して、名前、IDの出力
 * 
 * フェイスブックへログイン後、アクセストークンを取得し、
 * 名前とIDを取得する。
*/

session_start();
header("Content-type: text/html; charset=utf-8");

require_once __DIR__ . '/facebook_sdk/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => '[設定してください]',
  'app_secret' => '[設定してください]',
  'graph_api_version' => 'v5.0',
]);

$helper = $fb->getRedirectLoginHelper();
$callcak_url = 'http://localhost:8000/';

if(isset($_SESSION["token"])){
  $access_token = $helper->getAccessToken($callcak_url);
}


if(isset($access_token)){
  try {
    $response = $fb->get('/me', $access_token);
  } catch(\Facebook\Exceptions\FacebookResponseException $e){
    echo 'グラフAPIエラー: ' . $e->getMessage();
    exit;
  } catch(\Facebook\Exceptions\FacebookSDKException $e){
    echo 'Facebook SDKエラー: ' . $e->getMessage();
    exit;
  }

  $me = $response->getGraphUser();

  $_SESSION = array();
}
else{
  //オプション
  //$permissions = ['email', 'user_likes','user_posts']; //あなたの公開プロフィール、メールアドレス、タイムライン投稿、いいね！。
  //$permissions = ['email', 'user_likes']; //あなたの公開プロフィール、メールアドレス、いいね！。
  //$permissions = ['email', 'user_posts'];//あなたのタイムライン投稿。
  //$permissions = ['email','user_friends'];//あなたの公開プロフィール、友達リスト、メールアドレス。
  //$permissions = ['email'];//あなたの公開プロフィール、メールアドレス。
  $permissions = [];
  $loginUrl = $helper->getLoginUrl($callcak_url, $permissions);

  //リダイレクトのエラー回避のため
  $_SESSION["token"] = create_token();
}

/**
 * ランダムなトークンを作成
 * 
 * @return string
 */
function create_token(){
  $token = uniqid('', true);
  return $token;
}
?>


<!DOCTYPE html>
<html>
<head>
<title>フェイスブック　グラフAPI</title>
<meta charset="UTF-8">

<link href="/default.css" rel="stylesheet" type="text/css">

</head>
<body>

<div id="login">
  <div id="in">
    <h3>フェイスブック　グラフAPI　サンプル</h3>
    <span class="fontawesome-user">USER</span>
      <input type="text" id="user" placeholder="ユーザー名が表示される" value="<?php if(isset($me)){echo $me->getName();} ?>" disabled>
    <span class="fontawesome-lock">ID</span>
      <input type="text" id="pass" placeholder="IDが表示される" value="<?php if(isset($me)){echo $me->getId();} ?>" disabled>
    <?php if(!isset($me)){ 
    echo ('<input type="button" value="フェイスブックへログイン" onclick="location.href=' ."'". $loginUrl ."'".'">');
    }?>
  </div>
</div>

</body>
</html>
