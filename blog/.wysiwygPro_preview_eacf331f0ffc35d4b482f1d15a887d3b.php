<?php
if ($_GET['randomId'] != "6QgQUAjZw6Fa74H5faVxWh3gRrLKu9otpviGkoDQ8AHD0MQzE1smNieRXDZnWJb1") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
