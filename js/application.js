var student_ID = 0;
$(document).ready(function() {

	$(document).on('click', 'a.student-edit', function(e) {
		$.get($(this).attr('href'), function(data) {
			$('#student-details').html(data);
		});
		return false;
	});

	function show_notes(href) {
		$.getJSON(href, function(json_data) {
			var html = '';
			html += "<p class='icon user_icon'>"+json_data.student.NAME+" "+json_data.student.FAM+"</p>";
			html += "<table class='grid'>";
			
			if(json_data.notes[0])
			{
			html += "<tr><th>ID</td><th>SBID</th><th>NOTE</th><th>NAME</th></tr>";
			$.each(json_data.notes, function(i, item) {
				html += 
					"<tr>"+
					"<td>"+item.ID+"</td>"+
					"<td>"+item.SBID+"</td>"+
					"<td>"+item.NOTE+"</td>"+
					"<td>"+item.NAME+"</td>"+
				"</tr>";
			});
			html += "</table>";
			}
			
			else
			{
			html += "<p class='icon user_icon'> The selected student doesn't have any notes!</p>";
			}
			
			$('#notes').html(html);
			student_ID = json_data.student.ID;
		});
	}

	$(document).on('click', 'a.student-show-notes', function(e) {
		show_notes($(this).attr('href'));
		$('#notes').html('');
		return false;
	});

	
	$(document).on('click', 'a.show-subjects', function(e) {
		$.get($(this).attr('href'), function(data) {
		$('#subjects').html(data);
		});
		return false;
	});

	
	$(document).on('submit', '#student-edit-form', function(e) {
		$.post($(this).attr('action'),$(this).serialize(),function(data){
			$('#student-details').html(data);
		});
		return false;
	});
	
});
