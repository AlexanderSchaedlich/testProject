<?php
    include_once 'handle_products.php';

	if ($_POST) {
        $dataArray = json_decode($_POST['data_array'], true);// convert json object to associative array
        $cart = $dataArray['cart'];
        if (isset($dataArray['id'])) {
            $key = $dataArray['id'];
        }
        if ($_POST['do'] == 'increase') {
            // if the product is not yet added to the cart
            if (!array_key_exists($key, $cart['products'])) {
                // get it from product array
                for ($i = 0; $i < count($visible); $i++) {
                    if ($visible[$i]['id'] == $key) {
                        $product = $visible[$i];
                    }
                }
                // add it to the cart
                $cart['products'][$key] = $product;
                // increase the amount requested
                $cart['products'][$key]['amount_requested']++;
                // and the total items counter
                $cart["total_items"]++;

            // if the product is already in the cart
            } else {
                // check the product availability
                if ($cart['products'][$key]['amount_available'] > $cart['products'][$key]['amount_requested']) {
                    // increase the amount requested
                    $cart['products'][$key]['amount_requested']++;
                    // and the total items counter
                    $cart["total_items"]++;
                // or write a notification for the user
                } else {
                    if ($cart['products'][$key]['amount_available'] == 1) {
                        $notification = "There is only 1 " .$cart['products'][$key]['name']. " available";
                    } else {
                        $notification = "There are only " .$cart['products'][$key]['amount_available']. " " .$cart['products'][$key]['name']. " available";
                    }
                    // echo $notification;
                }
            }
        } elseif ($_POST['do'] == 'decrease') {
            $cart['products'][$key]['amount_requested']--;
            $cart["total_items"]--;
            if ($cart['products'][$key]['amount_requested'] == 0) {
                unset($cart['products'][$key]);
            }
        } elseif ($_POST['do'] == 'delete') {
            $deletedAmount = $cart['products'][$key]['amount_requested'];
            unset($cart['products'][$key]);
            $cart["total_items"] -= $deletedAmount;
        } elseif ($_POST['do'] == 'clear') {
            $cart['products'] = [];
            $cart["total_items"] = 0;
        }
	}
    // $cookie_name = "get_cart";
    // $cookie_value = json_encode($cart);
    // $boolean = setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    $get_cart = json_encode($cart);
    echo $get_cart;
?>