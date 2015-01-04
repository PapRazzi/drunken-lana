<?
include("include/config.php");
$host = $DBHOST;
$ln = $DBUSER;
$pw = $DBPASSWORD;
$db = $DBNAME;
$paypal_email = $config['paypal_email'];
$error_email = $config['notify_email'];
$site_email = $config['site_email'];
$site_name = $config['site_name'];
$em_headers  = "From: ".$site_name." <".$site_email.">\n";        
$em_headers .= "Reply-To: ".$site_email."\n";
$em_headers .= "Return-Path: ".$site_email."\n";
$em_headers .= "Organization: ".$site_name."\n";
$em_headers .= "X-Priority: 3\n";


$commitVerifyString = "";

//95333bde5ddd13e483966f1fef56cbcf
//http://cheerick.ru/payment_success.php
//http://cheerick.ru/payment_failed.php
//Concat all required for verify strings
$commitVerifyString .= 
    $_REQUEST["LMI_PAYEE_PURSE"] . $_REQUEST["LMI_PAYMENT_AMOUNT"] . $_REQUEST["LMI_PAYMENT_NO"].
    $_REQUEST["LMI_MODE"] . $_REQUEST["LMI_SYS_INVS_NO"] . $_REQUEST["LMI_SYS_TRANS_NO"] . $_REQUEST["LMI_SYS_TRANS_DATE"].
    "95333bde5ddd13e483966f1fef56cbcf". $_REQUEST["LMI_PAYER_PURSE"] . $_REQUEST["LMI_PAYER_WM"];

$commitVerifyHash = md5($commitVerifyString);
if ($_REQUEST["LMI_HASH"] !== "" && $_REQUEST["LMI_HASH"] === strtoupper($commitVerifyHash)) {
    if ($_REQUEST["LMI_PREREQUEST"]) {
        echo "YES";
        die();
    }  
    $user_id = $_REQUEST["USER_ID"];
    $payee_purse = $_REQUEST["LMI_PAYEE_PURSE"];
    $payment_amounth = $_REQUEST["LMI_PAYMENT_AMOUNT"];
    $payment_no = $_REQUEST["LMI_PAYMENT_NO"];
    $mode = $_REQUEST["LMI_MODE"];
    $sys_invs_no = $_REQUEST["LMI_HASH"];
    $sys_trans_no = $_REQUEST["LMI_SYS_TRANS_NO"];
    $payer_purse = $_REQUEST["LMI_PAYER_PURSE"];
    $payer_wm = $_REQUEST["LMI_PAYER_WM"];
    $capitaller_wmid = $_REQUEST["LMI_CAPITALLER_WMID"];
    $paymer_number = $_REQUEST["LMI_PAYMER_NUMBER"];
    $paymer_email = $_REQUEST["LMI_PAYMER_EMAIL"];
    $euronote_number = $_REQUEST["LMI_EURONOTE_NUMBER"];
    $euronote_email = $_REQUEST["LMI_EURONOTE_EMAIL"];
    $wmcheck_number = $_REQUEST["LMI_WMCHECK_NUMBER"];
    $telepat_phone = $_REQUEST["LMI_TELEPAT_PHONENUMBER"];
    $telepat_orderid = $_REQUEST["LMI_TELEPAT_ORDERID"];
    $payment_creditdays = $_REQUEST["LMI_PAYMENT_CREDITDAYS"] ? $_REQUEST["LMI_PAYMENT_CREDITDAYS"] : 1;
    $date = date('Y-m-d H:i:s'); 
    $qry="INSERT INTO wm_payments (ID, USER_ID, LMI_PAYEE_PURSE, LMI_PAYMENT_AMOUNT, LMI_PAYMENT_NO,
    LMI_MODE, LMI_SYS_INVS_NO, LMI_SYS_TRANS_NO, LMI_PAYER_PURSE, LMI_PAYER_WM, LMI_CAPITALLER_WMID,
    LMI_PAYMER_NUMBER, LMI_PAYMER_EMAIL, LMI_EURONOTE_NUMBER, LMI_EURONOTE_EMAIL, LMI_WMCHECK_NUMBER,
    LMI_TELEPAT_PHONENUMBER, LMI_TELEPAT_ORDERID, LMI_PAYMENT_CREDITDAYS, LMI_SYS_TRANS_DATE) 
    VALUES (0, '$user_id', '$payee_purse', '$payment_amounth', '$payment_no', '$mode', '$sys_invs_no', '$sys_trans_no',
    '$payee_purse', '$payer_wm', '$capitaller_wmid', '$paymer_number', '$paymer_email', '$euronote_number', '$euronote_email',
    '$wmcheck_number', '$telepat_phone', '$telepat_orderid', '$payment_creditdays', '$date')";
    
    
    mysql_query("START TRANSACTION");
    if (mysql_query($qry)) 
    {
        echo "Success";
        $query = "UPDATE members SET funds = funds + $payment_amounth, afunds = afunds + $payment_amounth WHERE userid = $user_id";
        
        if (!mysql_query($query)) {
            mysql_query("ROLLBACK");
            echo "fail";
            echo mysql_error();
            die();
        }
        mysql_query("COMMIT");
    } 
    else 
    {
        mysql_query("ROLLBACK");
        echo "fail";
    }      

} else {
    echo "fail";
}  
?>
