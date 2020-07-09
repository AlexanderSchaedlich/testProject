function writeCart(currentProducts) {
	if (currentProducts !== undefined) {
		products = currentProducts;
	}
	$("#cart").empty();
	if (products.length) // if the length of the array is defined and not equal to 0
	{
		let sum = 0;
		let rows = ``;
		for (key in products) {
			let total = products[key]["new_price"] * products[key]["amount_requested"];
			sum += total;
			let CategoryAndId = products[key]["category"] + " " +  products[key]["id"];
			rows += `
				<tr>
					<td>${products[key]["name"]}</td>
					<td>${products[key]["amount_requested"]}</td>
					<td>${createCurrencyFormat(products[key]["new_price"])}</td>
					<td class="text-right">${createCurrencyFormat(total)}</td>
					<td class="text-right">
						<button onclick="sendRequest('increase ${CategoryAndId}')">+</button>
						<button onclick="sendRequest('decrease ${CategoryAndId}')">-</button>
						<button onclick="sendRequest('delete ${CategoryAndId}')">
							<i class="fas fa-trash-alt"></i>
						</button>
					</td>
				</tr>
			`;
		}
		$("#cart").append(`
			<table class="w-100">
				<tbody>
					<tr>
						<th><p>Product</p></th>
						<th><p>Quantity</p></th>
						<th><p>Price</p></th>
						<th class="text-right"><p>Total</p></th>
						<th></th>
					</tr>
					${rows}
				</tbody>
			</table>
			<br>
			<h5 class="mb-3 text-success">Sum: ${createCurrencyFormat(sum)}</h5>
			<form action="${myPath}sessions/user/actions/confirm_order.php" method="post" class="d-inline mr-2">
				<input type="submit" value="Buy" class="btn btn-success">
			</form>
			<button class="myButton btn btn-warning" onclick="sendRequest('clear')">Clear All</button>
		`);
	} else {
		$("#cart").append(`
			<h3 class="text-info">Your cart is empty.</h3>
		`);
	}
}
writeCart();