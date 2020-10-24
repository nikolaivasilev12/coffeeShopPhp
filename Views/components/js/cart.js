function cartAction(action, product_code, productTitle, productPrice, inStock) {
	var queryString = "";
	if (action != "") {
		switch (action) {
		case "add":
			queryString = 'action=' + action + '&code=' + product_code
					 + '&productTitle=' + productTitle
					+ '&productPrice=' + productPrice
					+ '&inStock=' + inStock;
			break;
		case "remove":
			queryString = 'action=' + action + '&code=' + product_code;
			break;
		case "empty":
			queryString = 'action=' + action;
			break;
		}
	}
	jQuery.ajax({
		url : "handle-cart-ep",
		data : queryString,
		type : "POST",
		success : function(data) {
			$("#cart-item").html(data);
			$("#count").text($("#cart-item-count").val());
		},
		error : function() {
		}
	});
}

function updatePrice(obj) {
	var quantity = $(obj).val();
	var code = $(obj).data('code');
	queryString = 'action=edit&code=' + code + '&quantity=' + quantity;
	$.ajax({
		type : 'post',
		url : "handle-cart-ep",
		data : queryString,
		success : function(data) {
			$("#total").text(data);
		}
	});
}