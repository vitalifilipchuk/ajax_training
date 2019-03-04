$(document).ready(function() {
	getMessages();
	$('form').submit(function(event) {
		var formData = {
			'name' : $('input[name=user_name').val(),
			'message' : $('textarea[name=message_text').val()
		}
		$.post('ajax/add.php', formData, function(data, status) {
			var parseData = JSON.parse(data);
			if (parseData.success === false) {
				var errorBox = document.getElementById('errors');
				errorBox.innerHTML = parseData.errors.name + "\n" + parseData.errors.message + "\n" + parseData.errors.db;
				errorBox.innerHTML = errorBox.innerHTML.replace("undefined","");
				var successBox = document.getElementById('success');
				successBox.innerHTML = "";
			}
			
			if (parseData.success === true) {
				var errorBox = document.getElementById('errors');
				errorBox.innerHTML = "";
				var successBox = document.getElementById('success');
				successBox.innerHTML = "Successfully added!";
				getMessages();
			}
		});
		event.preventDefault();
	})
})
function getMessages() {
	$.post('ajax/select.php', function(data, status) {
		var messageData = JSON.parse(data);
		if (messageData.success === true) {
			document.getElementById('messages').innerHTML = ''; //делаем ресет контейнера с сообщениями
			for (var i = 0; i < 3; i++) { 
			  $( "#messages" ).append( "<div class='message'><div><span class='username'>" + messageData.messages[i].username + "</span> <span class='date'>"
			  + messageData.messages[i].date + "</span></div> <div class='message_text'>" + messageData.messages[i].message + "</div></div>");
			}
		}
		
	});
}