function increase(key) {
// 	// if the product is not yet added to the cart
//     if (!(key in cart)) {
//         // get it from product array
//         for ($i = 0; $i < count($visible); $i++) {
//             if ($visible[$i]['id'] == $key) {
//                 $product = $visible[$i];
//             }
//         }
//         // add it to the cart
//         $cart['products'][$key] = $product;
//         // increase the amount requested
//         $cart['products'][$key]['amount_requested']++;
//         // and the total items counter
//         $cart["total_items"]++;

//     // if the product is already in the cart
//     } else {
//         // check the product availability
//         if ($cart['products'][$key]['amount_available'] > $cart['products'][$key]['amount_requested']) {
//             // increase the amount requested
//             $cart['products'][$key]['amount_requested']++;
//             // and the total items counter
//             $cart["total_items"]++;
//         // or write a notification for the user
//         } else {
//             if ($cart['products'][$key]['amount_available'] == 1) {
//                 $notification = "There is only 1 " .$cart['products'][$key]['name']. " available";
//             } else {
//                 $notification = "There are only " .$cart['products'][$key]['amount_available']. " " .$cart['products'][$key]['name']. " available";
//             }
//             // echo $notification;
//         }
//     }
}

$(document).ready(function() {
    $(".increase").click(function(event) {
	    // event.preventDefault();
	    let key = this.value.toString();
		cart.products.push("new item");
		console.log(cart);
	    increase(key);
	    cart = JSON.stringify(cart);
	    document.cookie = "cart=" + cart;
	});
});