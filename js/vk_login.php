<?
include("../include/config.php");
include("../include/functions/import.php");
include("../include/vkapi.class.php");


 
function authOpenAPIMember() {
  global $config;
  $session = array();
  $member = FALSE;
  $valid_keys = array('expire', 'mid', 'secret', 'sid', 'sig');
  $app_cookie = $_COOKIE['vk_app_'. $config['VK_APPID']];
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
    $sign .= $config['VK_APP_PASSWORD'];
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
    //Here comes autorised member
    $email = cleanit($_REQUEST['email']);
    $query="SELECT USERID,vk_id,email,username,verified from members WHERE vk_id='".mysql_real_escape_string($member['id'])."' and status='1'";
    $result=$conn->execute($query);
    $prerequest = isset($_REQUEST["prerequest"]) & $_REQUEST['prerequest'] == 1; 
    if($result->recordcount()>0) {
        //User is already registered
        $query="update members set lastlogin='".time()."', lip='".$_SERVER['REMOTE_ADDR']."' WHERE USERID='".mysql_real_escape_string($result->fields['USERID'])."'";
        $conn->execute($query);
        $_SESSION['USERID']=$result->fields['USERID'];
        $_SESSION['EMAIL']=$result->fields['email'];
        $_SESSION['USERNAME']=$result->fields['username'];
        $_SESSION['VERIFIED']=$result->fields['verified'];
        $_SESSION['VK']="1";           
        //header("Location:$config[baseurl]/");
    } else {
        //Not registered user
        if ($prerequest) {
            echo 0;
            exit;
        }
        $VK = new vkapi($config['VK_APPID'], $config['VK_APP_PASSWORD']);
        $result = $VK->api('getProfiles', array('uids' => $member['id']));
        $username = $result['response'][0]['first_name'].' '.$result['response'][0]['last_name'];
        $md5pass = md5(generateCode(5).time());   
        $query="INSERT INTO members SET vk_id='".mysql_real_escape_string($member['id'])."',email='".mysql_real_escape_string($email)."',username='".mysql_real_escape_string($username)."', password='".mysql_real_escape_string($md5pass)."', addtime='".time()."', lastlogin='".time()."', ip='".$_SERVER['REMOTE_ADDR']."', lip='".$_SERVER['REMOTE_ADDR']."', verified='1'";
        $result=$conn->execute($query);
        $userid = mysql_insert_id();
        if($userid != "" && is_numeric($userid) && $userid > 0)
        {
            $query="SELECT USERID,email,username,verified from members WHERE USERID='".mysql_real_escape_string($userid)."'";
            $result=$conn->execute($query);
            
            $SUSERID = $result->fields['USERID'];
            $SEMAIL = $result->fields['email'];
            $SUSERNAME = $result->fields['username'];
            $SVERIFIED = $result->fields['verified'];
            $_SESSION['USERID']=$SUSERID;
            $_SESSION['EMAIL']=$SEMAIL;
            $_SESSION['USERNAME']=$SUSERNAME;
            $_SESSION['VERIFIED']=$SVERIFIED;
            $_SESSION['VK']="1";                
            //header("Location:$config[baseurl]/");exit;
        }
    }
    echo 1;      
} else {
    $error = "Not autorised session";
}
                                 
echo $error;    
  
?>
