<?php
include('config/boot.php');

$BID = $_GET['id']+0;

$result = mysql_query(
	"SELECT * FROM subjects_tbl"
);
echo "<p>Subjects</p>";
echo "<table class='grid'>
	<tr>
		<th>ID</th>
		<th>NAME</th>
	</tr>";
	
while($ap = mysql_fetch_object($result)) {
	echo "<tr>
		<td>".$ap->ID."</td>
		<td>".$ap->NAME."</td>
	</tr>";
}
echo "</table>";