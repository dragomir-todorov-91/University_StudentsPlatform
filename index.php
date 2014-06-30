<?php
include('config/boot.php');

$result = mysql_query("
	SELECT * 
	FROM STUDENTS_TBL 
	ORDER BY ID
	");

$students = array();
while($p = mysql_fetch_object($result)) {
	$students[] = $p;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Platform</title>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<link rel="stylesheet" type="text/css" href="css/default.css">
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/application.js"></script>
</head>
<body>
	<table class='layout'>
		<tr>
			<td class='panel'>
			<h1>Students</h1>
			<table class='grid'>
				<tr>
					<th>ID</th>
					<th>FAK. NUMBER</th>
					<th>NAME</th>
					<th>FAM</th>
					<th>ADDRESS</th>
					<th> </th>
				<tr>
				<?php
					foreach($students as $p) {
						echo "<tr>
							<td>".$p->ID."</td>
							<td>".$p->FAKNO."</td>
							<td>".$p->NAME."</td>
							<td>".$p->FAM."</td>
							<td>".$p->ADDRESS."</td>
							<td>
								<a href='notes-list-ajax.php?id=".$p->ID."' class='icon view_icon student-show-notes'>Show notes</a>
								<a href='student-edit-ajax.php?id=$p->ID' class='icon edit_icon student-edit'>Edit</a>
							</td>
						</tr>";
					}
				?>
			</table>
			<p>
				<a href='show-subjects.php' class='icon add_icon show-subjects'>Show Subjects</a>
				<a href='' class='icon refresh_icon'>Refresh</a>
			</p>
			</td>
			<td class='panel'>
				<div id='student-details'>
				</div>
			</td>
		</tr>
		<tr>
			<td class='panel'>
				<h1>Notes</h1>
				<div id='notes'>
					<p class='icon info_icon'>Select a student to view his telephones.</p>
				</div>
			</td>
			<td class='panel'>
				<div id='subjects'>
				</div>
			</td>
		</tr>
	</table>
	<div id='placeholder'>
	</div>
	<script>
		var e = document.getElementById('placeholder');
		if(e != undefined) {
			e.innerHTML = "<i class='icon app_icon'>TU Plovdiv, Student's Platform, 2014.</i>";
		}
	</script>
</body>
</html>
