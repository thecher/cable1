$(function() {

	var info = ["name", "rep", "acct", "system", "zone", "status", "address", "contactName", "phone"];
	var status = "none";
	var $noResults = $("<div />").attr('id','note').html('No results found.');
	var $notes = "<p><span class='date'>{date}</span><span class='notes'>{notes}</span></p>";

	$.ajax({
		type:'POST',
		url: './php/loadinfo.php',
		data: {
			salesRep: localStorage["salesRep"],
			status: "none"
		}
	}).done( function(data) {
		$("#salesName").html(localStorage["salesRep"]);
		$("#statusSpan").html(status);
		console.log(status, localStorage["salesRep"]);
		fillData(data);
	}); 

	$(".salesName").click( function() {
		$(".salesName").removeClass('active');
		localStorage["salesRep"] = $(this).attr('id');
		$("#salesName").html(localStorage["salesRep"]);
		if ($("#status").val() == "none") {
			status = "none";
		}else {
			status = $("#status").val();
		}
		console.log(status);
		$.ajax({
			type:'POST',
			url: './php/loadinfo.php',
			data: {
				salesRep: localStorage["salesRep"],
				status: status
			}
		}).done( function(data) {
			fillData(data);
		}); 
		$(this).addClass('active');
	});

	$("#filters").submit( function() {
		status = $("#status").val();
		salesRep = localStorage["salesRep"];
		$.ajax ({
			type: 'POST',
			url: './php/loadinfo.php',
			data: {
				status: status,
				salesRep: salesRep
			}
		}).done( function(data) {
			fillData(data);
			$("#statusSpan").html(status);
			console.log(status, salesRep)
		});
		return false;
	});

	function fillData(data) {
		$("#clients .client").remove();
		$("#note").remove();
		if (data.length == 0) {
			$noResults.clone().appendTo($("#clients"));
		} else {
			for (i = 0; i < data.length; i++) {
				$("#clientPrototype").clone().
					appendTo($("#clients")).
					show().
					attr('id',data[i].acct).
					addClass("client");
				var $thisDiv = $("#" + data[i].acct);
				for (p = 0; p < info.length; p++) {
					var thisItem = info[p];
					$thisDiv.find("." + thisItem).html(data[i][thisItem]);
				}
			}
		}
		$(".collapsible").hide();
		$(".collapseClick").each ( function() {
			$(this).click( function() {
				$(this).siblings(".collapsible").slideToggle();
			});
		});
		console.log(data.length);
	}

});

