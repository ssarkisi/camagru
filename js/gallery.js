function setRating(v) {
	$(function(){
		$.ajax({
			type: "POST",
			url: "rating.php",
			data: "v="+v,
			success: function(html){
				$("#content1").html(html);
			}
		});
	return false;

	});
}

function setComment() {
	var newP = document.createElement("p");
	var id = "new";
	var comment = $("#comment").val();

	if (comment == null || comment == "") {
		return false;
	}

	newP.className = "com2-p";
	newP.id = id;

	$("#com2").prepend(newP);
	$(function(){
		$.ajax({
			type: "POST",
			url: "comment.php",
			data: "v="+$("#comment").val(),
			success: function(html){
				$("#"+id).html(html);
				$("#comment").val("");
			}
		});
	return false;

	});
}

$(document).ready(function() {

$('#like').click(function() {
	var count = $("#like-count").val();
	

	if ($('#like').css("color") == 'rgb(27, 101, 119)') {
		$('#like').css('color', '#fa5457');
		$("#like").val("del");
		$('#like-count').val(count*1 + 1);
	}
	else if ($('#like').css("color") == 'rgb(250, 84, 87)') {
		$('#like').css('color', '#1b6577');
		$("#like").val("add");
		$('#like-count').val(count*1 - 1);
	}
	$.ajax({
		type: "POST",
		url: "like.php",
		data: "action="+$("#like").val()+"&hidden-id="+$("#hidden-id").val(),
		success: function(html){
			$("#content").html(html);
		}
	});
	return false;
});

});