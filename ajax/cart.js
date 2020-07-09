function sendRequest(string) {
	let array = string.split(" ");
	let action = array[0];
	let category = array[1];
	let id = array[2];
	let data = new FormData();
	data.append("action", action);
	data.append("category", category);
	data.append("id", id);
	const request = new XMLHttpRequest();
	request.open("POST", myPath + "ajax/cart.php");
	request.onload = function() { // when the request transaction completes successfully
		// console.log(this.responseText)
		let myResponse = JSON.parse(this.responseText);
		let products = myResponse[0];
		let totalItems = myResponse[1];
		let message = myResponse[2];
		writeCart(products);
		$(".totalItems").empty();
		$(".totalItems").append(totalItems);
		if (message != "") {
			alert(message);
		}
	};
	request.send(data);
}