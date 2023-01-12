<?php
    include('../../db/db.php');

    $postDetails = array();

    $sql = "select particulars from debit_tbl";
    $result = sqlsrv_query($con, $sql);

        if($result) {
            while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                $postDetails[] = $row['particulars'];
            }
        }
        echo json_encode($postDetails);
?>