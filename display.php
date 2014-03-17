<?php

require("data.php");

function table($items, $list, $cart) {
	$table = "<form id='select-book' method='post' action='index.php'>\n\t<table border='1' class='table'>\n\t\t<tr><th></th><th>Title</th><th>Author</th><th>Price</th></tr>\n"; 
	for($i=0;$i<count($items);$i++){
		$table .="\t\t<tr><td><input type='checkbox' name='book[]' value='" . $items[$i]['key'] . "'></td><td>" . $items[$i]['title'] . "</td><td>" . $items[$i]['author'] . "</td><td>$" . $items[$i]['price'] . "</td></tr>\n";
	}
	$table .="\t</table>\n\t<input type='submit' value='Add To Cart'>\n\t<input type='hidden' name='selected-books' value='$list'>\n</form>\n<form id='show-cart' method='post' action='cart.php'>\n\t<input type='submit' value='View Cart' class='$cart' name='view-cart'>\n</form>\n";
	return $table;
}	

function getBooks($submitted) {
if(isset($submitted)) {
	return implode("," , $submitted);
} else {
	print "Please select at least one book\n";
}
}

if(isset($_POST['book'])){
    $bookList = getbooks($_POST['book']);
	$cart = "cart-button";
} else {
   $bookList = getbooks(null); 
   $cart = "hidden-button";
}
echo table($books, $bookList, $cart);

function displayCart($listValue, $array) {
	$inCart = explode (',', $listValue);
	$cartList = "<ol>";
	for ($i=0;$i<count($inCart);$i++) {
		$cartList .= "<li>" . $array[$inCart[$i]['title']] . " " . $array[$inCart[$i]['price']] . "</li>";
		}
	$cartList .= "</ol>";
	return $cartList;
}

/*if (isset($_POST('view-cart'))) {
	$cartView = displayCart($bookList, $books);
} else {
		$cartView = displayCart(null);
}*/
?>