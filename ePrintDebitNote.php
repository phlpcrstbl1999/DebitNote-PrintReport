<?php
    include('db/db.php');
    session_start();
    if(isset($_SESSION['debitNote'])) {   
    $debitNote = $_SESSION['debitNote'];
    $date = $_SESSION['date'];
    $name =  strtoupper($_SESSION['name']);
    $particulars = $_SESSION['particular'];
    $amount = $_SESSION['amount'];
    $userid = $_SESSION['userid'];
    $sql = "select * from user_tbl where user_id = '$userid'";
    $query = sqlsrv_query($con, $sql);
    $row = sqlsrv_fetch_array($query);
        $empName = $row['fname'] . ' ' . $row['mid'] . ' ' . $row['lname'];
    }
    else {
        header("location:createDebitNote.php");
    }
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
<title>Print DN</title>
<link rel="shortcut icon" href="images/logo-1.svg" type="image/x-icon">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'> -->



</head>
<style>
    @media print {
        @page {
            margin-left: 0.31in;
        margin-right: 0.8in;
        margin-top: 0;
        margin-bottom: 0;
    }
   
  
    #confirmButton {
    display: none;
  }
    }

body {
    font-family: calibri;
    margin: 0;
    padding-left: 0.8em;
 }
.flex {
    display: flex; 
    justify-content: space-between; 
}
.flex-items {
    position: relative;
    text-align: center;
}
.fixed {
    position: fixed;
}
.row1 {
    top:0;
    padding-top: 10.4rem;
    width: 94%;
    height: 110px;
    position: fixed;
}
.row2 {
    top:18.5rem;
    width: 94%;
    height: 280px;
    /* border: 1px solid black; */
    position: fixed;
}

.row3 {
    top:35.2rem;
    width: 94%;
    height: 200px;
    position: relative;
}

.part {
    text-align: left;
}
a {
    text-align: center;
    position: absolute;
    padding: 10px; 
    background: blue; 
    color: white; 
    text-decoration: none; 
    border-radius: 5px; 
    font-weight: bold;
    line-height: 25px; 
    width: 90px; 
    height: 25px;
    right: 10px;
}

</style>
<body>
    <br>
    <br>
<?php
        if(isset($_SESSION['complete'])) {
            if($_SESSION['complete'] == 'complete') {
    ?>
    <a href="completedDebitNote.php" id="confirmButton">Confirm</a>
    <?php
        } else {
    ?>
    <a href="pendingPrint.php" id="confirmButton">Confirm</a>
    <?php        
        }
            } else {
    ?>
    <a href="createDebitNote.php" id="confirmButton">Confirm</a>
    <?php
            }
    ?>
    <div class="row1">
    <div class="flex">
        <div class="flex-items"><?php echo $name ?></div>
        <div class="flex-items"><?php echo $date ?></div>
    </div>
    </div>

    <div class="row2">
    <div class="flex">
    <div class="flex-items part">
        <?php
        foreach($particulars as $key=>$value)
        {
        ?>
        <?php echo $value ?><br>
        <?php   
        }
        ?>
    </div>
        <div class="flex-items" style="padding-left: 5rem"><?php echo $amount ?></div>
    </div>
    </div>
    <style>
        .dn {
            padding-top: 8px;
            font-size: 18px;
            position: fixed;
            left: 11rem;
        }
        .staff {
            position: fixed;
            text-align: center;
            right: 15rem;
        }
        .manager {
            position: fixed;
            right: 2rem;
            text-align: center;
        }
    </style>
    <div class="row3">
        <div class="dn"><b><?php echo $debitNote?></b></div>
        <?php 
            if($userid == 1) {
        ?>
            <div class="staff"><?php echo $empName?><br></div>
        <?php       
            } else {
        ?>
        <div class="staff"><?php echo $empName?><br><div style="font-size: 12px">Accounting Staff</div></div>
        <div class="manager">Josefina DG Rasdas<br><div style="font-size: 12px">Accounting Manager</div></div>
        <?php 
            }
        ?>
    </div>

    <!-- <script type="text/javascript">
            window.onload = function() { 
                window.print(); 
            }

    </script> -->
    <?php
            //   unset($_SESSION['debitNote']);
            //   unset($_SESSION['date']);
            //   unset($_SESSION['name']);
            //   unset($_SESSION['particular']);
            //   unset($_SESSION['amount']);
            //   unset($_SESSION['complete']);
    ?> 
</body>

</html>
