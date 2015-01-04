<?php
if ($_GET['randomId'] != "yLDfStEJ0HRTFFJjkOZY33tSL_T_ctYwTuMlRE8PwS8mkf2MRTOinks65z5_fJW8") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
