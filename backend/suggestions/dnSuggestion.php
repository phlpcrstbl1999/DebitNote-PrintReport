<?php
    include('../../db/db.php');

    $postDetails = array();

    $sql = "select dn_no from debit_tbl";
    $result = sqlsrv_query($con, $sql);

        if($result) {
            while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                $postDetails[] = $row['dn_no'];
            }
        }
        echo json_encode($postDetails);
?>