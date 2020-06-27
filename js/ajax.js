$(".myButton").click(function() {
	console.log("click");
	let data = new FormData();
	data.append("category", product["category"]);
	data.append("id", product["id"]);

	const request = new XMLHttpRequest();
	request.open("POST", "http://localhost/FullStackProject/fs01-project5-common/alex1/parts/test.php");
	request.onload = function() { // when the request transaction completes successfully
		console.log(this.responseText);
	};
	// if I want an option for uncompleted and unsuccessful requests I need to use this:
	// request.onreadystatechange = function() {
	// 	if (request.readyState == 4) { // if the request was completed
	// 		if (request.status == 200) { // if the request was successful
	// 			console.log(this.responseText);
	// 		} else {
	// 			console.log("The request transaction wasn`t successful.");
	// 		}
	// 	} else {
	// 		console.log("The request transaction wasn`t completed.");
	// 	}
	// };
	request.send(data);
});