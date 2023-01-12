<?php
include('../db/db.php');
session_start();

if(isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $conPass = $_POST['confirmpassword'];

    $encryptPass = md5($pass);
            if($pass == $conPass) {
                $sql = "UPDATE user_tbl set password = '$encryptPass' where username = '$user'";
                $result = sqlsrv_query($con,$sql);
                     if($result) {
                        if($_POST['profile'] == 'true'){
                            $_SESSION['status'] = "Password Reset";
                            $_SESSION['status_code'] = "success";  
                            $_SESSION['status_text'] = "";
                            header("location:../createDebitNote.php");
                        }else {
                            $_SESSION['status'] = "Password Reset";
                            $_SESSION['status_code'] = "success";  
                            $_SESSION['status_text'] = "";
                            header("location:../completedDebitNote.php");
                        }
                    }
                    else {
                        die(print_r( sqlsrv_errors(), true));
                    }
            }
            else {
                $_SESSION['status'] = "Password Doesn\'t Match!";
                $_SESSION['status_code'] = "error";  
                $_SESSION['status_text'] = "Please try again";
                header("location:http://192.20.4.92/dms/resetpass.php?username=".$user."&pass=".$encryptPass."");                

            }
    }  
    if(isset($_POST['submit1'])) {
        header("location:../fileinformation.php");
    }

?>