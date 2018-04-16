//Mainpage
$(document).ready(function () {
	$("#deviceOverview").click(function () {
		$.ajax({
			type: "GET",
			url: "assets/php/peer/listPeer.php",
			cache: false,
			success: function (result) {
				$(".dynamicContent").remove();
				$(result).insertAfter("#dynamic");
			}
		});

		return false;
	});

	$("#log").click(function () {
		$.ajax({	
			type: "GET",
			url: "assets/php/log/log.php",
			cache: false,
			success: function (result) {
				$(".dynamicContent").remove();
				$(result).insertAfter("#dynamic");
			}
		});

		return false;
	});
});

//listPeer
$(document).ready(function () {
	$('input.submit').on('click', function (e) {
		e.preventDefault();

		var id = this.id; //Get the ID of the button wich was pressd

		//Get the Corresponding Informations for the new peer
		var room = $("#room" + id).val();
		var cat = $("#cat" + id).val();
		var name = $("#name" + id).val();
		var type = $("#type" + id).val();
		var uuid = $("#uuid" + id).val();

		var dataString = 'room=' + room + '&cat=' + cat + '&name=' + name + '&type=' + type + '&uuid=' + uuid + '&id=' + id;

		//Send the whole stuff to the addPeer.php
		$.ajax({
			type: "POST",
			url: "assets/php/peer/addPeer.php",
			data: dataString,
			cache: false,
			success: function (result) {
				//delete the submit button of the Peer wich was createt
				$(".submit" && "#" + id).remove();
				//set the new peer id
				$("#peer" + id).text(result);
			}
		});

		return false;
	});
});

//log
$(document).ready(function () {
	$('#select-datei').mouseup(function () {
		setInterval(function () {
			var file = $("#select-datei").val();
			var grep = $("#grep").val();
			var dataString = 'file=' + file + '&grep=' + grep;
			$.ajax({
				type: "POST",
				url: "assets/php/log/generateLog.php",
				data: dataString,
				cache: false,
				success: function (result) {
					$("#testdiv").empty();
					$("#testdiv").append(result);
				}
			});

			return false;

		}, 10000);
	});
});
