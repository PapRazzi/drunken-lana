<?
header('Content-Type: text/html; charset=utf-8');
include("include/config.php");
include("include/functions/import.php");
// сумма заказа
// sum of order
$out_summ = $_REQUEST["OutSum"];
if (!is_numeric($out_summ))
{
    die();
}


if ($_SESSION['USERID'] != "" && $_SESSION['USERID'] >= 0 && is_numeric($_SESSION['USERID']))
{
    // 1.
    // Оплата заданной суммы с выбором валюты на сайте мерчанта
    // Payment of the set sum with a choice of currency on merchant site 

    // регистрационная информация (логин, пароль #1)
    // registration info (login, password #1)
    $mrh_login = $config['RK_LOGIN'];
    $mrh_pass1 = $config['RK_PASS1'];

    // описание заказа
    // order description
    $inv_desc = "Пополнение баланса на сайте cheerick.ru";

    // тип товара
    // code of goods
    $shp_item = 1;

    // язык
    // language
    $culture = "ru";

    // кодировка
    // encoding
    $encoding = "utf-8";

    $user_id = $_SESSION['USERID'];

    //Trying to find appropriate query
    $query_select = "SELECT ID FROM roboxchange_payments WHERE USER_ID = $user_id AND SUMM = $out_summ AND PENDING = 1";
    global $conn;
    $executequery=$conn->execute($query_select);
    $inv_id = $executequery->fields['ID'];
    if (!$inv_id) {
        $query = "INSERT INTO roboxchange_payments VALUES('0', '$user_id', '$out_summ', '$my_crc', '$date', '1')";
        if (!mysql_query($query)) 
        {
            die();
        }
        // номер заказа
        // number of order
        $inv_id = mysql_insert_id();    
    }

    //Insert into payment table
    $date = date('Y-m-d H:i:s');

    // формирование подписи
    // generate signature
    $crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item");
    // HTML-страница с кассой
    // ROBOKASSA HTML-page
    header("Location: https://merchant.roboxchange.com/Index.aspx?".
          "MrchLogin=$mrh_login&OutSum=$out_summ&InvId=$inv_id".
          "&Desc=$inv_desc&SignatureValue=$crc&Shp_item=$shp_item".
          "&Culture=$culture&Encoding=$encoding");
}        


?>