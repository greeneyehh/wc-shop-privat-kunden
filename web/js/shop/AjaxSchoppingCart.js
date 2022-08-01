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

function cartcount() {
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
}


if($('.confirm').length){
	document.getElementById('account-personal_customer_type').onchange = function () {
		if(document.getElementById('account-personal_customer_type').value == "ORGANIZATION") {
		     $('#collapseBusiness').collapse('show'); 
		}else{	
			 $('#collapseBusiness').collapse('hide'); 
		}
	}
}