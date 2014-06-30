<?php
include('config/boot.php');
$ID = $_GET['id']+0; 
$sql = sprintf("DELETE FROM TELS_TBL WHERE ID=%d", $ID);
mysql_query($sql);

$infos[] = "Telephone deleted.";
$infos[] = "sql: $sql";

if(count($infos)>0) {
	foreach($infos as $i) {
		echo "<p class='icon ok_icon msg_ok'>".$i."</p>";
	}
}
