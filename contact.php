<?php
/**************************************************************************************************
| Fiverr Script
| http://www.fiverrscript.com
| webmaster@fiverrscript.com
|
|**************************************************************************************************
|
| By using this software you agree that you have read and acknowledged our End-User License 
| Agreement available at http://www.fiverrscript.com/eula.html and to be bound by it.
|
| Copyright (c) 2011 FiverrScript.com. All rights reserved.
|**************************************************************************************************/

include("include/config.php");
include("include/functions/import.php");
$thebaseurl = $config['baseurl'];

$templateselect = "contact.tpl";
$pagetitle = "$lang[417]";
STemplate::assign('pagetitle',$pagetitle);

//resolving message params
$name = isset($_POST["user_name"]) ? $_POST["user_name"] : "";
$email = isset($_POST["user_email"]) ? $_POST["user_email"] : "";
$message = isset($_POST["MESSAGE"]) ? $_POST["MESSAGE"] : "";
$nameError = false;
$emailError = false;
$messageError = false;
$success = false;
if (isset($_POST["user_name"]) && $name === "") {
    $nameError = true;
}
if (isset($_POST["user_email"]) && ($email === "" || !verify_valid_email($email))) {
    $emailError = true;
}
if (isset($_POST["MESSAGE"]) && $message === "") {
    $messageError = true;
}
if (isset($_POST["user_name"]) && !($nameError || $emailError || $messageError)) {
    mail("contact@cheerick.ru", utf8_to_cp1251("Сообщение из формы обратной связи"), 
    utf8_to_cp1251("Вы получили вопрос из формы обратной связи:\n
    \t От: $name\n
    \t Почтовый адрес: $email\n
    \t Сообщение: $message
    "));
    $success = true;
    $name = "";
    $email = "";
    $message = "";
}


//TEMPLATES BEGIN
STemplate::assign('nameError',$nameError);
STemplate::assign('emailError',$emailError);
STemplate::assign('messageError',$messageError);
STemplate::assign('name',$name);
STemplate::assign('email',$email);
STemplate::assign('message',$message);
STemplate::assign('error',$error);
STemplate::assign('success',$success);
STemplate::display('header.tpl');
STemplate::display($templateselect);
STemplate::display('footer.tpl');
//TEMPLATES END
?>