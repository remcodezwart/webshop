$( document ).ready(function() {
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	var totalPrice = $('span[id="total"]');
	var shoppingCartOverviewElement = $('tbody[id="orders"]');

    $('.cart').on('click', function(e){
    	var id = $(this).data('id');
    	var name = $('input[data-id=' + id + ']').data('name');
    	var amount = $('input[data-id=' + id + ']').val();
    	var price = $('input[data-id=' + id + ']').data('price');

    	var priceForOrder = price*amount
    	var currentTotal = parseInt(totalPrice.text());
    	if (currentTotal === 0) {
    		currentTotal = priceForOrder;
    	} else {
    		currentTotal += priceForOrder 
    	}
    	shoppingCartOverviewElement.append(generateHtml(name, price, amount));
    	totalPrice.text(currentTotal);

     	//$.ajax({
		 // url: "/api/cart",
		 // method: "POST",
		 // data: {id, amount},
		 // success: function(data){
		 //   console.log(data)
		 // }
		//});

    })

    function generateHtml(name, price, amount)
    {
    	return "\
    	<tr>\
			<td>"+name+"</td>\
			<td>&#8364;"+price+"</td>\
			<td>"+amount+"</td>\
			<td>&#8364;"+(price*amount)+"</td>\
		\
    	</tr>"
    }


});