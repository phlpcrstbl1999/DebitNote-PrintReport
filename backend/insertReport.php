<?php
    include('../db/db.php');
    // ALTER TABLE tableName AUTO_INCREMENT = 1;
   
    session_start();
    if(isset($_POST['printReport'])) {
        $debitNote = $_POST['debitNote'];
        $date = $_POST['date'];
        $name =  strtoupper($_POST['name']);
        $particulars = $_POST['particular'];
        $amount = number_format($_POST['amount'], 2);
        $userid = $_POST['userid'];
        $newDate = date("F d, Y", strtotime($date));
        $sql = "select * from debit_tbl where dn_no = '$debitNote'";
        $query = sqlsrv_query($con, $sql);
        $row_count = sqlsrv_num_rows($query);
        date_default_timezone_set('Asia/Taipei');
        $printDate = date("m/d/Y") . ' ' . date("h:ia");


        if($row_count == 1) {
            $_SESSION['status'] = "Debit Already Exist";
            $_SESSION['status_code'] = "warning";  
            $_SESSION['status_text'] = "Please try again";
            header("location:../printReport.php");
        } else {          
            if($_POST['printReport'] == 'Print') {
            $sql = "insert into debit_tbl(dn_no, date, name, particulars, amount, forPrint, user_id, date_printed)values('$debitNote', '$date', '$name', '$particulars', '$amount', 'N', '$userid', '$printDate')";
            $query = sqlsrv_query($con, $sql);
            if($query) {
                $trimParticular = trim($particulars);
                $trimParticularArr = explode("\n", $trimParticular);
                $trimParticularArr = array_filter($trimParticularArr, 'trim'); // remove any extra \r characters left behind
                $_SESSION['debitNote'] = $debitNote;
                $_SESSION['date'] = $newDate;
                $_SESSION['name'] = $name;
                $_SESSION['particular'] = $trimParticularArr;
                $_SESSION['amount'] = $amount;  
                $_SESSION['userid'] = $userid;     
                header("location:../ePrintDebitNote.php");
            } else {
                $_SESSION['status'] = "Oops";
                $_SESSION['status_code'] = "error";  
                $_SESSION['status_text'] = "Please try again";
                header("location:../printReport.php");
                die( print_r( sqlsrv_errors(), true));
            }
        } else {
            $sql = "insert into debit_tbl(dn_no, date, name, particulars, amount, forPrint, user_id)values('$debitNote', '$date', '$name', '$particulars', '$amount', 'Y', '$userid')";
            $query = sqlsrv_query($con, $sql);
            if($query) {
                $_SESSION['status'] = "Sucess";
                $_SESSION['status_code'] = "success";  
                header("location:../createDebitNote.php");
            } else {
                $_SESSION['status'] = "Oops";
                $_SESSION['status_code'] = "error";  
                $_SESSION['status_text'] = "Please try again";
                header("location:../printReport.php");
                die( print_r( sqlsrv_errors(), true));
            }
        }
        }
    }
    if(isset($_POST['editReport'])) {
        $debitNote = $_POST['debitNote'];
        $date = $_POST['date'];
        $name =  strtoupper($_POST['name']);
        $particulars = $_POST['particular'];
        $userid = $_POST['userid'];
        $newDate = date("F d, Y", strtotime($date));
        $amountRep = str_replace(',', '', $_POST['amount']);
        $amount = number_format($amountRep, 2);;
        date_default_timezone_set('Asia/Taipei');
        $printDate = date("m/d/Y") . ' ' . date("h:ia");
            // $sql = "insert into debit_tbl(dn_no, date, name, particulars, amount)values('$debitNote', '$newDate', '$name', '$particulars', '$amount')";
            $sql = "update debit_tbl set date = '$date', name = '$name', particulars = '$particulars', amount = '$amount', forPrint = 'N', date_printed = '$printDate' where dn_no = '$debitNote'";
            $query = sqlsrv_query($con, $sql);
            if($query) {
                $trimParticular = trim($particulars);
                $trimParticularArr = explode("\n", $trimParticular);
                $trimParticularArr = array_filter($trimParticularArr, 'trim'); // remove any extra \r characters left behind

                $_SESSION['debitNote'] = $debitNote;
                $_SESSION['date'] = $newDate;
                $_SESSION['name'] = $name;
                $_SESSION['particular'] = $trimParticularArr;
                $_SESSION['amount'] = $amount;  
                $_SESSION['userid'] = $userid; 
            if($_POST['editReport'] != 'pendingEdit') {
                $_SESSION['complete'] = 'complete';
            } else {
                $_SESSION['complete'] = 'pending';
            }
                header("location:../ePrintDebitNote.php");

                // echo"<script language='javascript'>
                //     window.open('../printReport.php');
                //     window.open('../ePrintDebitNote.php', '_blank');

                // </script>
                // ";
            } else {
                $_SESSION['status'] = "Oops";
                $_SESSION['status_code'] = "error";  
                $_SESSION['status_text'] = "Please try again";
                header("location:../printReport.php");
                die( print_r( sqlsrv_errors(), true));
            }
        }
        if(isset($_POST['cancelReport'])) {
            $debitNote = $_POST['debitNote'];
            date_default_timezone_set('Asia/Taipei');
            $cancelDate = date("m/d/Y") . ' ' . date("h:ia");
                // $sql = "insert into debit_tbl(dn_no, date, name, particulars, amount)values('$debitNote', '$newDate', '$name', '$particulars', '$amount')";
                $sql = "update debit_tbl set status = 'Cancelled', date_cancelled = '$cancelDate' where dn_no = '$debitNote'";
                $query = sqlsrv_query($con, $sql);
                if($query) {
                    $_SESSION['status'] = "Success";
                    $_SESSION['status_code'] = "success";  
                    // $_SESSION['status_text'] = "Please try again";
                    header("location:../completedDebitNote.php");

                    // echo"<script language='javascript'>
                    //     window.open('../printReport.php');
                    //     window.open('../ePrintDebitNote.php', '_blank');
                    // </script>
                    // ";
                    
                } else {
                    $_SESSION['status'] = "Oops";
                    $_SESSION['status_code'] = "error";  
                    $_SESSION['status_text'] = "Please try again";
                    header("location:../printReport.php");
                    die( print_r( sqlsrv_errors(), true));
                }
            }
        if(isset($_POST['submitDNCount'])) {
            $sql = "Select max(dn_no) as max from debit_tbl";
            $query = sqlsrv_query($con, $sql);
            if($query) {
                while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){     
                    $debitNote = $row['max']; 
                }
            }   
            $DNcount = $_POST['DNcount'];
            $userid = $_POST['userid'];

            for($i = 0; $i < $DNcount; $i++) {
                $debitNote++;
                $sql = "insert into debit_tbl(dn_no, user_id, forPrint) values ('$debitNote', '$userid', 'Y')";
                $query = sqlsrv_query($con, $sql);
                $_SESSION['name'] = "";
                $_SESSION['amount'] = "";
                $_SESSION['particular'] = "";
                $_SESSION['date'] = date("Y-m-d");
                header("location:../createMultipleDebitNote.php");
            }
        }
        if(isset($_POST['submitMultiple'])) {
            $debitNote = $_POST['debitNote'];
            $date = $_POST['date'];
            $am = $_POST['amount'];
            $name =  strtoupper($_POST['name']);
            $particulars = $_POST['particular'];
            $userid = $_POST['userid'];
            $newDate = date("F d, Y", strtotime($date));
            $amountRep = str_replace(',', '', $am);
            $amount = number_format($amountRep, 2);
             
                // $sql = "insert into debit_tbl(dn_no, date, name, particulars, amount)values('$debitNote', '$newDate', '$name', '$particulars', '$amount')";
                $sql = "update debit_tbl set date = '$date', name = '$name', particulars = '$particulars', amount = '$amount', user_id = '$userid' where dn_no = '$debitNote'";
                $query = sqlsrv_query($con, $sql);
                if($query) {
                    $_SESSION['name'] = $name;
                    $_SESSION['date'] = date('Y-m-d', strtotime("+1 months", strtotime($date)));
                    $_SESSION['amount'] = $am;
                    $_SESSION['particular'] = $particulars;
                    header("location:../createMultipleDebitNote.php");
                } else {
                    die( print_r( sqlsrv_errors(), true));
                }
            }
?>