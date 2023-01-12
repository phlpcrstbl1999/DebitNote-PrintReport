<?php
    include('db/db.php');
    session_start();
    $userid = $_SESSION['id'];
    if(!isset($_SESSION['id'])) {
        header('location:index.php');
    } else {
    $sql = "select username from user_tbl where user_id = '$userid'";
    $query = sqlsrv_query($con, $sql);
    if($query) {
        while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){     
            $username = $row['username']; 
        }
    }  
}
    ?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Completed DN</title>
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
    <style>
        /* From uiverse.io by @G4b413l */
            .buttonDownload {
            display: inline-block;
            position: relative;
            padding: 10px 25px;
            background-color: #4CC713;
            color: white;
            font-family: sans-serif;
            text-decoration: none;
            font-size: 0.9em;
            text-align: center;
            text-indent: 15px;
            border: none;
            }

            .buttonDownload:hover {
            background-color: #45a21a;
            color: white;
            }

            .buttonDownload:before, .buttonDownload:after {
            content: ' ';
            display: block;
            position: absolute;
            left: 15px;
            top: 52%;
            }

            .buttonDownload:before {
            width: 10px;
            height: 2px;
            border-style: solid;
            border-width: 0 2px 2px;
            }

            .buttonDownload:after {
            width: 0;
            height: 0;
            margin-left: 1px;
            margin-top: -7px;
            border-style: solid;
            border-width: 4px 4px 0 4px;
            border-color: transparent;
            border-top-color: inherit;
            animation: downloadArrow 1s linear infinite;
            animation-play-state: paused;
            }

            .buttonDownload:hover:before {
            border-color: #cdefbd;
            }

            .buttonDownload:hover:after {
            border-top-color: #cdefbd;
            animation-play-state: running;
            }

            @keyframes downloadArrow {
            0% {
            margin-top: -7px;
            opacity: 1;
            }

            0.001% {
            margin-top: -15px;
            opacity: 0.4;
            }

            50% {
            opacity: 1;
            }

            100% {
            margin-top: 0;
            opacity: 0.4;
            }
            }
                </style>
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
                        <a class="nav-link" href='resetPass.php?username=<?php echo $username?>'><i class="fa fa-user"></i> Profile</a>
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
                                <li class="breadcrumb-item"><a href="createMultipleDebitNote.php">Create Multiple Debit Note</a></li>
                                <li class="breadcrumb-item active1" aria-current="page">Pending Print</li>
                                <li class="breadcrumb-item"><a href="completedDebitNote.php">Printed Debit Note</a></li>
                            </ol>
                            </nav>
                           
                            </div>
                        </div>
                        <!-- <div class="page-header float-right">
                            <form action="backend/exportExcel.php" method="post">
                            <button class="buttonDownload" name="completeSubmit"><b>Export to Excel</b></button>
                            </form>
                                </div> -->
        
                            </div>
                            <div class="card-body">
                                
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered example">
                                    <thead>
                                        <tr style="background-color: black; color: white">
                                        <th class="sorting_desc" tabindex="0" aria-controls="bootstrap-data-table-export" rowspan="1" colspan="1" aria-label="Debit Number: activate to sort column ascending" style="width: 123px;" aria-sort="descending">Debit Number</th>                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Particulars</th>
                                            <th>Amount</th>
                                            <th><center>Edit</center></th>
                                            <!-- <th><center>Delete</center></th> -->
                                            <th><center>Print</center></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    
                                                $sql = "SELECT * from debit_tbl where forPrint = 'Y' AND user_id = $userid AND name is not null";
                                                $query = sqlsrv_query($con, $sql);
                                                if($query) {
                                                    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){ 
                                                $newDate = date("F d, Y", strtotime($row['date']));

                                        ?>
                                        <tr>
                                            <td><?php echo $row['dn_no'];?></td>
                                            <td><?php echo $newDate;?></td>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['particulars'];?></td>
                                            <td><?php echo $row['amount'];?></td>
                                            <td align="center">
                                            <!-- data-backdrop="false" -->
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editfilecategory<?php echo $row['dn_no'];?>"><i class="fa fa-pencil"></i></button> 

                                                </td>
                                            <form action="backend/print.php" method="post">
                                            <?php
                                                       
                                                       $newDate = date("F d, Y", strtotime($row['date']));
                                                ?>
                                            <td align="center">
                                            <input type="hidden" class="form-control" name="debitNote" value="<?php echo $row['dn_no'];?>">
                                            <input type="hidden" class="form-control" name="date" value="<?php echo $newDate?>">
                                            <input type="hidden" class="form-control" name="name" value="<?php echo $row['name'];?>">
                                            <input type="hidden" class="form-control" name="particular" value="<?php echo $row['particulars']?>">
                                            <input type="hidden" class="form-control" name="userid" value="<?php echo $userid?>">
                                            <input type="hidden" class="form-control" name="complete" value="complete">
                                            <input type="hidden" class="form-control" name="amount" value="<?php echo $row['amount']?>">
                                                <button type="submit" name="submit" value="pendingPrint" class="btn btn-sm" style="background-color:#b700b1; color: #fff;"><i class="fa fa-print"></i> Print</button>
                                            </td>
                                            </form>             
                                        </tr> 
        <!-- ########################################################EDITEDITEDITEDIT############################################################################################# -->
                                                        <div class="modal fade" id="editfilecategory<?php echo $row['dn_no'];?>" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                            <form action="backend/insertReport.php" method="post" class="needs-validation" novalidate>
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>

                                                        <div class="modal-body">
                                                    <div class="card-header"><strong>Edit Report</strong><small> Form</small></div>
                                                        <div class="card-body card-block">
                                                        <div class="form-group row">
                                                            <label for="staticEmail" class="col-sm-2 col-form-label"><b>Debit Note</b></label>
                                                            <div class="col-sm-10">
                                                            <input type="text" class="form-control" style="font-weight: bold; color: red;" name="debitNote" id="validationCustom02" value="<?php echo $row['dn_no'];?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="staticEmail" class="col-sm-2 col-form-label"><b>Name</b></label>
                                                            <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="name" id="suggestion" placeholder="Enter Name" value="<?php echo $row['name'];?>" required>
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
                                                            <div class="col-sm-3">
                                                            <input type="date" class="form-control" name="date" id="validationCustom02" value="<?php echo date('Y-m-d', strtotime($row['date'])); ?>" required>
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
                                                            <input type="text" class="form-control" name="amount" id="validationCustom02" value="<?php echo $row['amount'];?>" placeholder="Enter Amount" required>
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
                            
                                                            <textarea class="form-control" name="particular" id="exampleFormControlTextarea1" rows="7" required><?php echo $row['particulars'];?></textarea>

                                                                    <div class="valid-feedback">
                                                                        Looks good!
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        Enter a particular.
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" class="form-control" name="userid" value="<?php echo $userid?>">
                                                        </div>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" name="editReport" value="pendingEdit" class="btn btn-primary">Confirm</button>
                                                </div>
                                                    </form>
                                                    </div>

                                                    </div>
                                                        </div>
                                                            </div>
                                        <?php 
                                                }
                                            }    
                                            ?>                                       
                                     </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
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
                                        // $('#register').on('click', function() {
                                        <?php
                                            if(isset($_SESSION['edit_status']) && $_SESSION['edit_code'] != '' ) {
                                        ?>    
                                            swal.fire({
                                                icon: '<?php echo $_SESSION['edit_code']; ?>',
                                                title: '<?php echo $_SESSION['edit_status']; ?>',
                                                text: '<?php echo $_SESSION['edit_codetext']; ?>',
                                            })
                                        // })
                                        <?php 
                                            unset($_SESSION['edit_status']);
                                            unset($_SESSION['edit_code']);
                                            unset($_SESSION['edit_codetext']);
                                        }
                                        ?>
                                    </script>      

                                     <script>
                                        // $('#register').on('click', function() {
                                        <?php
                                            if(isset($_SESSION['add_status']) && $_SESSION['add_code'] != '' ) {
                                        ?>    
                                            swal.fire({
                                                icon: '<?php echo $_SESSION['add_code']; ?>',
                                                title: '<?php echo $_SESSION['add_status']; ?>',
                                                text: '<?php echo $_SESSION['add_codetext']; ?>',

                                            })
                                        // })
                                        <?php 
                                            unset($_SESSION['add_status']);
                                            unset($_SESSION['add_code']);
                                            unset($_SESSION['add_codetext']);
                                        }
                                        $_SESSION['empid'] = $empid;
                                        ?>
                                    </script>           
                                                            
                              
                                        <script>
                                            $(document).ready(function(e) {
                                                $("#suggestion").autocomplete({
                                                    sources:'backend/suggestion.php'
                                                });
                                            });
                                        </script>
                                        <script>
                                            <?php
                                                if(isset($_SESSION['status']) && $_SESSION['status_code'] != '' ) {
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
</body> 

</html>
