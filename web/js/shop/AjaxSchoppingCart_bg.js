$.ajax({
	url: "/cart/count/",
	type: 'GET',
	success: function(res) {
		if(res >= 0){
			$('.total-count').html('<span class="fa fa-shopping-basket"></span><span class="cartcount">'+ res+'</span>');
		}
		if(res == 0){
			$('.total-count').html('<span class="fa fa-shopping-basket"></span>');
		}
	}
});
$('.add-to-cart').click(function(event) {
	var produktdata ={} ;
	var array= $(this).data();
	for (var prop in array) {
		produktdata[prop]= array[prop];

	}
	var produktId = $(this).data('id');
 	var button = document.getElementById("button-"+produktId);
 	button.innerText = 'Wird Hinzugefügt...';
 	$(button).attr('disabled','disabled');
 	$.ajax({
		url: "/cart/add",
		type: "POST",
		dataType:"json",
		data:  produktdata
		}).done(function(msg) {
		   button.innerText = 'In den Warenkorb';
		   $(button).removeAttr('disabled','disabled');
		   $('.total-count').html('<span class="fa fa-shopping-basket"></span><span class="cartcount">'+msg+'</span>');
		});
});







if($('.confirm').length){
	document.getElementById('account-personal_customer_type').onchange = function () {
		if(document.getElementById('account-personal_customer_type').value == "ORGANIZATION") {
		     $('#collapseBusiness').collapse('show'); 
		}else{	
			 $('#collapseBusiness').collapse('hide'); 
		}
	}
}