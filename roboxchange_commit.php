<?
include("include/config.php");
include("include/functions/import.php");
// регистрационная информация (пароль #2)
// registration info (password #2)
$mrh_pass2 = "bba4eb76461d2186f8eb4b4001aa07df";

//установка текущего времени
//current date
$tm=getdate(time()+9*3600);
$date="$tm[year]-$tm[mon]-$tm[mday] $tm[hours]:$tm[minutes]:$tm[seconds]";

// чтение параметров
// read parameters
$out_summ = $_REQUEST["OutSum"];
$inv_id = $_REQUEST["InvId"];
$shp_item = $_REQUEST["Shp_item"];
$crc = $_REQUEST["SignatureValue"];

$crc = strtoupper($crc);

$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2:Shp_item=$shp_item"));

// проверка корректности подписи
// check signature
if ($my_crc !=$crc)
{
  echo "bad sign\n";
  exit();
}

// признак успешно проведенной операции
// success

$select_query = "SELECT USER_ID,PENDING FROM roboxchange_payments WHERE ID = $inv_id";

global $conn;
$executequery=$conn->execute($select_query);
$user_id = $executequery->fields['USER_ID'];
$pending = $executequery->fields['PENDING'];
if (!$pending) {
    echo "OK$inv_id\n";
}


mysql_query("START TRANSACTION");
$date = date('Y-m-d H:i:s');
$query = "UPDATE roboxchange_payments SET PENDING = 0, DATE = '$date', HASH = '$crc' WHERE ID = $inv_id";
if (mysql_query($query)) 
{    
    $query = "UPDATE members SET funds = funds + $out_summ, afunds = afunds + $out_summ WHERE userid = $user_id";
    
    if (!mysql_query($query)) {
        mysql_query("ROLLBACK");
        echo "fail";
        echo mysql_error();
        die();
    }
    mysql_query("COMMIT");  
    echo "OK$inv_id\n";
} 
else 
{
    mysql_query("ROLLBACK");
    echo "Fail executing query";
    echo mysql_error();
}
?>
