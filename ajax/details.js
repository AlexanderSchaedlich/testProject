$(".myButton").click(function() {
	let data = new FormData();
	data.append("product", JSON.stringify(product));
	const request = new XMLHttpRequest();
	request.open("POST", myPath + "ajax/details.php");
	request.onload = function() { // when the request transaction completes successfully
		$(".totalItems").empty();
		$(".totalItems").append(this.responseText);
	};
	request.send(data);
});