<?php
    include('../db/db.php');
    session_start();
   if(isset($_POST['submit'])) {
    $debitNote = $_POST['debitNote'];
    $date = $_POST['date'];
    $name =  strtoupper($_POST['name']);
    $particulars = $_POST['particular'];
    $amount = $_POST['amount'];
    $userid = $_POST['userid'];
    $complete = $_POST['complete'];
    $newDate = date("F d, Y", strtotime($date));
    date_default_timezone_set('Asia/Taipei');
    $date = date("m/d/Y") . ' ' . date("h:ia");
    if($_POST['submit'] == 'pendingPrint') {
      $sql = "update debit_tbl set forPrint = 'N', date_printed = '$date' where dn_no = '$debitNote'";
      $query = sqlsrv_query($con, $sql);
      $complete = 'pending';
    } else {
      $complete = 'complete';
    }
        $trimParticular = trim($particulars);
        $trimParticularArr = explode("\n", $trimParticular);
        $trimParticularArr = array_filter($trimParticularArr, 'trim'); // remove any extra \r characters left behind

        $_SESSION['debitNote'] = $debitNote;
        $_SESSION['date'] = $newDate;
        $_SESSION['name'] = $name;
        $_SESSION['particular'] = $trimParticularArr;
        $_SESSION['amount'] = $amount;  
        $_SESSION['userid'] = $userid;   
        $_SESSION['complete'] = $complete;  
        header("location:../ePrintDebitNote.php");
}
?>