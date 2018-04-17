$( document ).ready(function() {
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	getCartContents();

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

     	$.ajax({
		  url: "/api/cart",
		  method: "POST",
		  data: {id, amount},
		  success: function(data){
		    console.log(data)
		  }
		});

    })

    $(document).on("click", ".delete", function(event){

    	var name = $(this).data('name');
    	
    	$.ajax({
		  url: "/api/cart/delete",
		  method: "POST",
		  data: {name},
		  success: function(data){
		    console.log(data)
		  }
		});
    })

    function generateHtml(name, price, amount)
    {
    	return "\
    	<tr>\
			<td>"+name+"</td>\
			<td>&#8364;"+price+"</td>\
			<td>"+amount+"</td>\
			<td>&#8364;"+(price*amount)+"</td>\
			<td>\
				<button data-name=\""+name+"\" type=\"button\" class=\"delete btn btn-danger\">Verwijderen</button>	\
				<button type=\"button\" class=\"btn btn-primary\">Bewerken</button>	\
			</td>\
		\
    	</tr>"
    }

    function getCartContents()
    {
    	var html = "";
    	var total = 0

    	$.ajax({
		  url: "/api/cart",
		  method: "GET",
		  dataType: "json",
		  success: function(data){
		  	data.forEach(function(object){
		  		html += generateHtml(object.name, object.price, object.ShopingAmount)
		  		total += (object.price * object.ShopingAmount)
		  	})

		  	shoppingCartOverviewElement.append(html);
		  	totalPrice.text(total);
		  }
		});
    }



});