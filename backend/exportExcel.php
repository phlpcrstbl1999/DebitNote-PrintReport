<?php

if(isset($_POST['exportExcel'])) {
$exportBy = $_POST['exportBy'];
	include('../db/db.php');
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=debit_file.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
 
	$output = "";
 
	$output .="
		<table>
			<thead>
				<tr>
					<th>DN No.</th>
					<th>DATE</th>
					<th>NAME</th>
					<th>PARTICULARS</th>
					<th>AMOUNT</th>
					<th>STATUS</th>
				</tr>
			<tbody>
	";
	if($exportBy == 'date') {
		$fromDate = "'" . $_POST['fromDate'] . "'";
		$toDate = "'" . $_POST['toDate'] . "'";
		$sql = "select * from debit_tbl where date BETWEEN $fromDate AND $toDate";
		$query = sqlsrv_query($con, $sql);
	}else if($exportBy == 'dnNumber'){
		$fromDN = $_POST['fromDN'];
		$toDN = $_POST['toDN'];
		$sql = "Select * from debit_tbl where dn_no BETWEEN $fromDN AND $toDN";
		$query = sqlsrv_query($con, $sql);

	}else if($exportBy == 'name'){
		$nameReport = strtoupper($_POST['nameReport']);
		$sql = "Select * from debit_tbl where name = '%$nameReport%'";
		$query = sqlsrv_query($con, $sql);

	}else {
		$particularsReport = $_POST['particularsReport'];
		$sql = "Select * from debit_tbl where particulars = '%$particularsReport%'";
		$query = sqlsrv_query($con, $sql);
	}

	if($query) {
		while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){     
		$newDate = date("F d, Y", strtotime($row['date']));
		$output .= "
				<tr>
					<td>".$row['dn_no']."</td>
					<td>".$newDate."</td>
					<td>".$row['name']."</td>
					<td>".$row['particulars']."</td>
					<td>".$row['amount']."</td>
					<td>".$row['status']."</td>
				</tr>
	";
	}
} else {
	die( print_r( sqlsrv_errors(), true));
}
	$output .="
			</tbody>
 
		</table>
	";
 
	echo $output;
}

?>