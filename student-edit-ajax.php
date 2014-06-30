<?php
include('config/boot.php');
$errors = array();
$infos = array();


$form = $_POST['student'];
if(isset($form['ID'])) {
	$PID = $form['ID']+0;
}
else {
	$PID = $_GET['id']+0;
}

if($PID == 0) { // new student, no data
	$title = "Add New student";
	$student = array();
}
else if(isset($form)) { // save/update student
	$title = "Edit student";
}
else { // edit student
	$title = "Edit student";
	$result = mysql_query("
		SELECT *
		FROM STUDENTS_TBL
		WHERE ID = ".($PID)."
	");
	$student = mysql_fetch_assoc($result);
}


if(isset($_POST['student'])) { // if any data posted -> validate and update data
	$form = $_POST['student'];
	if($form['FAKNO']<=100000) $errors[] = "Faculty number should be more than 100000.";
	if(strlen(trim($form['NAME']))<=1) $errors[] = "NAME should be more than 1 character.";
	if(strlen(trim($form['FAM']))<=1) $errors[] = "FAM should be more than 1 character.";
	if(strlen(trim($form['ADDRESS']))<=5) $errors[] = "ADDRESS should be more than 5 characters.";

	if(count($errors) == 0) {
		$infos[] = "student successfully saved.";

		if($PID == 0) { // no ID -> insert
			mysql_query(sprintf(
				"INSERT INTO studentS_TBL(NAME, FAM, ADDRESS) VALUES('%d','%s','%s','%s')",
				$form['FAKNO'],
				mysql_real_escape_string(trim($form['NAME'])),
				mysql_real_escape_string(trim($form['FAM'])),
				mysql_real_escape_string(trim($form['ADDRESS']))
			));
		}
		else { // update
			mysql_query(sprintf(
				"UPDATE studentS_TBL SET FAKNO='%d', NAME='%s', FAM='%s', ADDRESS='%s' WHERE ID=%d",
				$form['FAKNO'],
				mysql_real_escape_string(trim($form['NAME'])),
				mysql_real_escape_string(trim($form['FAM'])),
				mysql_real_escape_string(trim($form['ADDRESS'])),
				$PID
			));
		}
	}
}
else { // if no data submitted -> fill the form with data from the DB
	$form = $student; 
}

echo "<h1>$title</h1>";

if(count($errors)>0) {
	foreach($errors as $e) {
		echo "<p class='icon error_icon msg_err'>".$e."</p>";
	}
}
if(count($infos)>0) {
	foreach($infos as $i) {
		echo "<p class='icon ok_icon msg_ok'>".$i."</p>";
	}
}

echo "<form id='student-edit-form' action='student-edit-ajax.php' enctype='multipart/form-data' method='post'>";
echo "<input type='hidden' name='student[ID]' value='".htmlspecialchars($form['ID'])."'/>";
echo "<p><label>FAKNO</label><input name='student[FAKNO]' class='txt medium' value='".htmlspecialchars($form['FAKNO'])."'/></p>";
echo "<p><label>NAME</label><input name='student[NAME]' class='txt medium' value='".htmlspecialchars($form['NAME'])."'/></p>";
echo "<p><label>FAM</label><input name='student[FAM]' class='txt medium' value='".htmlspecialchars($form['FAM'])."'/></p>";
echo "<p><label>ADDRESS</label><input name='student[ADDRESS]' class='txt medium' value='".htmlspecialchars($form['ADDRESS'])."'/></p>";
echo "<p><input type='submit' value='Save'/></p>";
echo "</form>";

?>
