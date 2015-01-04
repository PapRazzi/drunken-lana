<?
include("include/config.php");
include("include/functions/import.php");  
?>
<html>
<head></head>
<body>
<div>
<script src="http://vkontakte.ru/js/api/openapi.js" type="text/javascript"></script>
<?


function authOpenAPIMember() {
  $session = array();
  $member = FALSE;
  $valid_keys = array('expire', 'mid', 'secret', 'sid', 'sig');
  $app_cookie = $_COOKIE['vk_app_'.VK_APPID];
  if ($app_cookie) {
    $session_data = explode ('&', $app_cookie, 10);
    foreach ($session_data as $pair) {
      list($key, $value) = explode('=', $pair, 2);
      if (empty($key) || empty($value) || !in_array($key, $valid_keys)) {
        continue;
      }
      $session[$key] = $value;
    }
    foreach ($valid_keys as $key) {
      if (!isset($session[$key])) return $member;
    }
    ksort($session);

    $sign = '';
    foreach ($session as $key => $value) {
      if ($key != 'sig') {
        $sign .= ($key.'='.$value);
      }
    }
    $sign .= VK_APP_PASS;
    $sign = md5($sign);
    if ($session['sig'] == $sign && $session['expire'] > time()) {
      $member = array(
        'id' => intval($session['mid']),
        'secret' => $session['secret'],
        'sid' => $session['sid']
      );
    }
  }
  return $member;
}

$member = authOpenAPIMember();

if($member !== FALSE) {
  print_r($member);
} else {
  echo "Not authorized";
  echo VK_APPID;
}
    
    
?>
<div id="login_button" onclick="VK.Auth.login(authInfo);"></div>

<script language="javascript">
VK.init({
  apiId: 2258301
});
function authInfo(response) {
  if (response.session) {
    alert('user: '+response.session.mid);
  } else {
    alert('not auth');
  }
}
VK.Auth.getLoginStatus(authInfo);
VK.UI.button('login_button');
</script>
</div>
</body>
</html>