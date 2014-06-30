<?php
include('config/boot.php');

$SID = $_GET['id']+0;

$result = mysql_query("
	SELECT 
		n.ID,
		n.NOTE,
		sbj.ID as SBID,
		sbj.NAME
	FROM
		NOTES_TBL n
		JOIN SUBJECTS_TBL sbj on(n.SBID = sbj.ID)
	WHERE
		n.STID = ".($SID)."
	ORDER BY sbj.ID
	");
$notes = array();
while($t = mysql_fetch_object($result)) {
	$notes[] = $t;
}

$result = mysql_query("
	SELECT *
	FROM STUDENTS_TBL
	WHERE ID = ".($SID)."
	");
$student = mysql_fetch_object($result);

$response = new stdClass();
$response->notes = $notes;
$response->STID = $SID;
$response->student = $student;
echo json_encode($response);
