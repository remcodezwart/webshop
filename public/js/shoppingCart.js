$( document ).ready(function() {
	$('#error').hide();
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    dataType: "json"
	});

	getCartContents();

	var totalPrice = $('span[id="total"]');
	var shoppingCartOverviewElement = $('tbody[id="orders"]');

    $('.cart').on('click', function(e){

    	$('#error').hide();
    	$('#error-list').empty();

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
    	if ( $('tr[data-name=' + name + ']') ) {
    		$('tr[data-name=' + name + ']').remove();
    	}

    	shoppingCartOverviewElement.append(generateHtml(name, price, amount));
    	totalPrice.text(currentTotal);

     	$.ajax({
		    url: "/api/cart",
		    method: "POST",
		    data: {id, amount},
		    success: function(data) {
		      
		    },  
		    error: function (err) {
	       		displayError(err);
	    	}
		});

    })

    $(document).on("click", ".delete", function(event){

    	var name = $(this).data('name');
    	var price = $(this).data('price');
    	
    	$.ajax({
		  url: "/api/cart/delete",
		  method: "POST",
		  data: {name},
		  success: function(data){
		    if (data.succes == true) {
		    	$('tr[data-name=' + name + ']').remove();
		    	var currentTotal = parseInt(totalPrice.text());	
		    	currentTotal -= price;
		    	totalPrice.text(currentTotal);
		    }
		  }
		});
    })

    $(document).on("click", ".edit", function(event){

    	$('#error').hide();
    	$('#error-list').empty();

    	var name = $(this).data('name');
    	var amount = $('input[data-name_shopping='+name+']').val();
    	var price = $(this).data('price'); 
    	var amountToDecrease = $(this).data('total');
   
    	$.ajax({
		  url: "/api/cart/edit",
		  method: "POST",
		  data: {name, amount},
		  success: function(data){
		    if (data.succes == true) {
		    	$('tr[data-name=' + name + ']').remove();
		    	
		    	var currentTotal = parseInt(totalPrice.text());	
		    	currentTotal -= amountToDecrease;

		    	if (amount != 0) {
		    		shoppingCartOverviewElement.append(generateHtml(name, price, amount));
		    		currentTotal += (amount*price);
		    	}

		    	totalPrice.text(currentTotal);
	
		    }
		  },
		  error: function (err) {
	       	displayError(err);
	      }
		});

    })

    function generateHtml(name, price, amount)
    {
    	return "\
    	<tr data-name=\""+name+"\">\
			<td>"+name+"</td>\
			<td>&#8364;"+price+"</td>\
			<td><input data-name_shopping=\""+name+"\" type=\"number\" class=\"width\" value=\""+amount+"\"></td>\
			<td>&#8364;"+(price*amount)+"</td>\
			<td>\
				<button data-price="+(price*amount)+" data-name=\""+name+"\" type=\"button\" class=\"delete btn btn-danger\">Verwijderen</button>	\
				<button data-total=\""+(price*amount)+"\" data-price=\""+price+"\" data-name=\""+name+"\" type=\"button\" class=\"edit btn btn-primary\">Bewerken</button>	\
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

    function displayError(err)
    {
    	if (err.status == 422) {
    		$('#error').hide();
    		$('#error-list').empty();
    		$.each([err.responseJSON.errors], function( index, value ) {
    			for(i = 0; i < value.amount.length; i++) {
    				$('#error-list').append(value.amount[i]+' <br />');
    			}
			});    
			$('#error').show();
    	}
    }



});