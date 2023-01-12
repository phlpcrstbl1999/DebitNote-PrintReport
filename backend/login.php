<?php
include('../db/db.php');
session_start();
$user = $_POST['username'];
$pass = $_POST['password'];
$encryptPass = md5($pass);

if(isset($_POST['submit'])) {

    $sql = "select user_id from user_tbl where username ='$user' and password = '$encryptPass'";
    // It is because sqlsrv_query() uses SQLSRV_CURSOR_FORWARD cursor type by default. 
    // However, in order to get a result from sqlsrv_num_rows(), 
    // you should choose one of these cursor types below:
    //     SQLSRV_CURSOR_STATIC
    //     SQLSRV_CURSOR_KEYSET
    //     SQLSRV_CURSOR_CLIENT_BUFFERED

    $result = sqlsrv_query($con, $sql, array(), array( "Scrollable" => 'static' ));
    $id = sqlsrv_fetch_array($result);
    $user_id = $id['user_id'];
    $row_count = sqlsrv_num_rows($result);
    if($row_count == 1) {
        $_SESSION['id'] = $user_id;
      header("location:../createDebitNote.php");
       
    }

else {
    $_SESSION['statusLogin'] = "The username or password is incorrect";
    $_SESSION['status_codeLogin'] = "error";  
    $_SESSION['status_textLogin'] = "Please try again";
    header("location:../index.php");
}
}
?>