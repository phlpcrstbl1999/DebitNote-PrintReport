<?php
    include('db/db.php');
    session_start();
    if(!isset($_SESSION['id'])) {
        header('location:index.php');
    } else {
        $userid = $_SESSION['id'];
        $sql = "select username from user_tbl where user_id = '$userid'";
        $query = sqlsrv_query($con, $sql);
        if($query) {
            while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){     
                $username = $row['username']; 
            }
        }    
    }
    $sql = "Select max(dn_no) as max from debit_tbl";
    $query = sqlsrv_query($con, $sql);
    if($query) {
        while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){     
            $debitNote = $row['max'] + 1; 
        }
    }    
    $sql = "Select min(dn_no) as min from debit_tbl where name is NULL and user_id = '$userid'";
    $query = sqlsrv_query($con, $sql);
    if($query) {
        while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){     
            $minDebitNote = $row['min']; 
        }
    }   
    $sql = "Select count(dn_no) as count from debit_tbl where name is NULL and user_id = '$userid'";
    $query = sqlsrv_query($con, $sql);
    if($query) {
        while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){     
            $count = $row['count']; 
        }
    }  
    if($count != 0) {
        if(isset($_SESSION['name'])) {
            $particular = $_SESSION['particular'];
            $name = $_SESSION['name'];
            $date = $_SESSION['date'];
            $amount = $_SESSION['amount'];
            // echo "<script type='text/javascript' language='Javascript'>window.open('ePrintDebitNote.php');</script>";

        }
    } else {
            $name = "";
            $particular = "";
            $amount = "";
    }
    
    ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create Multiple DN</title>
    <link rel="shortcut icon" href="images/logo-1.svg" type="image/x-icon">

    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <script src="backend/mainjs.js"></script>

</head>

<body>
    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a class="navbar-brand" href="#">
                <img src="images/logo.jpg" width="250" height="50" alt="">
                    </a>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a class="navbar-brand" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/account.png" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                        <a class="nav-link" href='resetPass.php?username=<?php echo $username?>&profile=true'><i class="fa fa-user"></i> Profile</a>
                            <form action="backend/logout.php" method="POST">
                                <a class="nav-link" href="backend/logout.php"><i class="fa fa-power-off"></i> Logout</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>   
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                            <div class="page-header float-left">
                            <div class="page-title">
                            
                            <style>
                                .active1 {
                                    color: #2356b5;
                                    cursor: pointer;
                                }
                            </style>    
                            <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="createDebitNote.php">Create Debit Note</a></li>
                                <li class="breadcrumb-item active1" aria-current="page">Create Multiple Debit Note</li>
                                <li class="breadcrumb-item"><a href="pendingPrint.php">Pending Print</a></li>
                                <li class="breadcrumb-item"><a href="completedDebitNote.php">Printed Debit Note</a></li>
                            </ol>
                            </nav>
                           
                            </div>
                        </div>
                            </div>
                            <div class="card-body">
                            <div class="jumbotron">
                            <form action="backend/insertReport.php" method="post">
                            <div class="form-group row">
                                    <?php
                                        if($count != 0) {
                                    ?>
                                    <label for="staticEmail" class="col-sm-2 col-form-label"><b>DN Remaining</b></label>
                                    <div class="col-sm-3">
                                    <input type="number" min="2" class="form-control" name="DNcount" id="DNcount" value="<?php echo $count?>" readonly>
                                    </div>

                                    <?php
                                        }else {
                                    ?>
                                    <label for="staticEmail" class="col-sm-2 col-form-label"><b>No. of Debit Note</b></label>
                                    <div class="col-sm-3">
                                    <input type="number" min="2" class="form-control" name="DNcount" id="DNcount" placeholder="Enter Number of Debit Note" required>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                <input type="hidden" class="form-control" name="userid" value="<?php echo $userid?>">

                                    <input type="hidden" class="form-control" name="debitNote" value="<?php echo $debitNote ?>">
                                    <?php
                                        if($count == 0) {
                                    ?>
                                    <button class="btn btn-success float-right" name="submitDNCount" type="submit">&nbsp&nbspCreate&nbsp&nbsp</button>
                                    <?php
                                        }   
                                    ?>
                                </div>
                            </form>
                                <form action="backend/insertReport.php" method="post" class="needs-validation" novalidate>
                                
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label"><b>Debit Note</b></label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" style="font-weight: bold; color: red;" name="debitNote" id="validationCustom02" value="<?php echo $minDebitNote ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label"><b>Name</b></label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $name;?>" name="name" id="suggestion" placeholder="Enter Name" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Enter a name.
                                            </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label"><b>Date</b></label>
                                    <div class="col-sm-2">
                                    <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d', strtotime($date)); ?>" id="validationCustom02" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Choose a date.
                                            </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label"><b>Amount</b></label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" name="amount" id="validationCustom02" value="<?php echo $amount;?>" placeholder="Enter Amount" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Enter an amount.
                                            </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label"><b>Particular</b></label>
                                    <div class="col-sm-10">
                                    <textarea class="form-control" name="particular" id="exampleFormControlTextarea1" rows="7" required><?php echo $particular;?></textarea>
 
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Enter a particular.
                                            </div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" name="userid" value="<?php echo $userid?>">
                                <?php
                                        if($count != 0) {
                                    ?>
                                <button class="btn btn-primary float-right" name="submitMultiple" type="submit">&nbsp&nbspSave&nbsp&nbsp</button>
                                <?php
                                        }
                                ?>
                                </form>
                                
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                            
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>

    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
    <script src="assets/sweetalert/jquery-3.6.0.min.js"></script>
    <script src="assets/sweetalert/sweetalert2.all.min.js"></script>
    <script src="backend/mainjs.js"></script>

                                     
                                    <script>
                                            // Example starter JavaScript for disabling form submissions if there are invalid fields
                                            (function() {
                                            'use strict';
                                            window.addEventListener('load', function() {
                                                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                                var forms = document.getElementsByClassName('needs-validation');
                                                // Loop over them and prevent submission
                                                var validation = Array.prototype.filter.call(forms, function(form) {
                                                form.addEventListener('submit', function(event) {
                                                    if (form.checkValidity() === false) {
                                                    event.preventDefault();
                                                    event.stopPropagation();
                                                    }
                                                    form.classList.add('was-validated');
                                                }, false);
                                                });
                                            }, false);
                                            })();
                                    </script>                       
                                        <script>
                                            <?php
                                                if($_SESSION['status'] && $_SESSION['status_code'] != '' ) {
                                            ?>    
                                                swal.fire({
                                                    icon: '<?php echo $_SESSION['status_code']; ?>',
                                                    title: '<?php echo $_SESSION['status']; ?>',
                                                    text: '<?php echo $_SESSION['status_text']; ?>',
                                                })
                                            <?php 
                                                unset($_SESSION['status']);
                                                unset($_SESSION['status_code']);
                                            }
                                            ?>
                                        </script> 
                                        <script>
                                            $(document).ready(function(e) {
                                                $("#suggestion").autocomplete({
                                                    sources:'backend/suggestions/nameSuggestion.php'
                                                });
                                            });
                                        </script>
                                   
                                                                
      
</body> 

</html>
