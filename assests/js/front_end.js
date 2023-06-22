jQuery(document).ready(function($) { 
//	$(".preorder-blue-hide").on('click',function(e){	
  //     e.preventDefault();	
	//	$(".preorder-notice").hide();
		// });
	
// 	
// Get the "Add to cart" button element
var $addToCartBtn = $('.single_add_to_cart_button');
// // Store the original button text
var originalBtnText = $addToCartBtn.text();

// // Add a click event handler to the button
$addToCartBtn.on('click', function() {
$addToCartBtn.text('Adding');
$(document).ajaxComplete(function(){
$addToCartBtn.text('Added');

setTimeout(function() {
$addToCartBtn.text('Add to cart');
}, 2000);

});
});
 
// 	
	
	
	$(".click-user").on('click',function(e){	
       e.preventDefault();
        if($('.language-text:visible').length)
			{
        $('.language-text').hide();
// 		$('div#language-wrapper').css('border', 'none');
		$('div#language-wrapper').css('padding-left', 'unset');
		$('div#language-wrapper').css('box-shadow', '0');
		$('div#language-wrapper').css('padding-top', 'unset');
		$('div#language-wrapper').css('background', 'unset');		
			}
        else
			{
        $('.language-text').show();
// 		$('div#language-wrapper').css('border', '1px solid black');
// 		$('div#language-wrapper').css('padding-left', '10px');
		$('div#language-wrapper').css('padding-top', '10px');
		$('div#language-wrapper').css('background', 'white');
		$('div#language-wrapper').css('box-shadow', 'rgba(99, 99, 99, 0.2) 0px 2px 8px 0px');		
			}

    });
    
// 	$("ul#shipping_method").hide();
// 	// cart page
// 	 $(".shipping-calculator-button").on('click',function(e){
// 		 e.preventDefault();
// 		 if($('.shipping-calculator-form').is(':visible')) {
// 			$("ul#shipping_method").hide();
// 			}
// 		else
// 			{
// 				$("ul#shipping_method").show();
// 			}
		
// 		});
// 	

	 if ($(".berocket_lgv_button_grid").hasClass("selected")) {
		 $('ul.products.columns-3 li, ul.products.columns-5 li').addClass('product_grid_width');
		 $('ul.products.columns-3, ul.products.columns-5').addClass('product_mobile_grid_width');
		 $(".formated_price_latets").show();
         $("p.my-custom-field").show();
		 $("a.button.custom-button-class").show();
		 $('span.price_from').css('display', 'unset');
		 $('span.min').css('display', 'unset');
		 $('span.price_to').css('display', 'unset');
		 $('span.max').css('margin-left', 'unset');
		 $('.formated_price_latets').css('margin-top', '0px');
		 $('.formated_price_latets').css('display', 'flex');
		 $('.formated_price_latets').css('justify-content', 'center');
		 $('.formated_price_latets').css('flex-wrap', 'nowrap');
		 $('.formated_price_latets').css('align-items', 'baseline');
		 $('span.price_to').css('margin-left', '10px');
		 $('p.pre-order').css('display', 'block');
		 $('.preorder').css('display', 'block');
		 

// 		 $("span.woocommerce-Price-amount.amount").hide();
		 	
		 }
	if ($(".berocket_lgv_button_list").hasClass("selected")) {
        $("p.my-custom-field").hide();
		$('.my_add_to_cart_button .formated_price_latets').css('display', 'none');
		$('span.price_from').css('display', 'none');
		$('span.min').css('display', 'none');
		$('span.price_to').css('display', 'none');
		$('span.max').css('margin-left', '95px');
		$('.formated_price_latets').css('margin-top', '-38px');
		$("a.button.custom-button-class").hide();
		$('ul.products.columns-3 li, ul.products.columns-5 li').removeClass('product_grid_width');
		$('ul.products.columns-3, ul.products.columns-5').removeClass('product_mobile_grid_width');
		$('span.price_to').css('margin-left', '0px');
		$('p.pre-order').css('display', 'none');
		$('.preorder').css('display', 'none');
		$(".my_add_to_cart_button .formated_price_latets .max").hide();
// 		$("span.woocommerce-Price-amount.amount").show();
// 		 if ($(window).width() < 640) {
// 		 $('.formated_price_latets').css('margin-top', '-38px');
// 		 }
		 }
	
// 	 $(".attributes").hide();
// 		$("p.my-custom-field").hide();
// 		$("a.button.custom-button-class").hide();
       $(".berocket_lgv_button_grid").on('click',function(e){
        e.preventDefault();
		   $("p.my-custom-field").show();
			$("a.button.custom-button-class").show();
		   $('ul.products.columns-3 li, ul.products.columns-5 li').addClass('product_grid_width');
		   $('ul.products.columns-3, ul.products.columns-5').addClass('product_mobile_grid_width');
		   $(".formated_price_latets").show();
		
		 $('.formated_price_latets').css('display', 'flex');
		 $('.formated_price_latets').css('justify-content', 'center');
		 $('.formated_price_latets').css('flex-wrap', 'nowrap');
		 $('.formated_price_latets').css('align-items', 'baseline');
// 		   $("span.woocommerce-Price-amount.amount").hide();
// 		   alert("close");
		$('.my_add_to_cart_button .formated_price_latets').css('display', 'none');
		$('span.price_from').css('display', 'unset');
		$('span.min').css('display', 'unset');
		$('span.price_to').css('display', 'unset');
		$('span.max').css('margin-left', 'unset');
		$('.formated_price_latets').css('margin-top', '0px');
		$('span.price_to').css('margin-left', '10px');
		    $('p.pre-order').css('display', 'block');
		$('.preorder').css('display', 'block');
		   
		    $(".attributes").hide();
		 });
	
	$(".berocket_lgv_button_list").on('click',function(e){
        e.preventDefault();
		$("p.my-custom-field").hide();
		$('.my_add_to_cart_button span.woocommerce-Price-amount.amount').css('display', 'none');
		$('span.price_from').css('display', 'none');
		$('span.min').css('display', 'none');
		$('span.price_to').css('display', 'none');
		$('span.max').css('margin-left', '95px');
		$('.formated_price_latets').css('margin-top', '-38px');
		$("a.button.custom-button-class").hide();
		$('ul.products.columns-3 li, ul.products.columns-5 li').removeClass('product_grid_width');
		$('ul.products.columns-3, ul.products.columns-5').removeClass('product_mobile_grid_width');
		$('span.price_to').css('margin-left', '0px');
		 $('.formated_price_latets').css('display', '');
		 $('.formated_price_latets').css('justify-content', '');
		 $('.formated_price_latets').css('flex-wrap', '');
		 $('.formated_price_latets').css('align-items', '');
		$('p.pre-order').css('display', 'none');
		$('.preorder').css('display', 'none');
		    $(".attributes").show();
	});
	
	$(".product-subscription-price").hide();
	$(".show_subscription_popup").hide();
	
	
$(".subscription-content input").click(function() {
  if($(this).is(":checked")) {
    $(this).parent().parent().siblings(".product-subscription-price").show();
	  $("button.single_add_to_cart_button.action.primary").attr("disabled", true);
    $("button.single_add_to_cart_button.button.alt.wp-element-button").hide();
	$(this).parent().parent().siblings(".my_add_to_cart_button").find("a.button.product_type_variable.add_to_cart_button").hide();
    $(this).parent().parent().siblings(".my_add_to_cart_button").find(".show_subscription_popup").show();
	$(this).parent().parent().siblings(".woocommerce-variation-add-to-cart.variations_button.woocommerce-variation-add-to-cart-enabled").find("button.single_add_to_cart_button.button.alt.wp-element-button").hide();
    $(this).parent().parent().siblings(".woocommerce-variation-add-to-cart.variations_button.woocommerce-variation-add-to-cart-enabled").find(".show_subscription_popup").show();	  
//	  $(".modal-footer button.single_add_to_cart_button.button.alt.wp-element-button").show();
	  $(".modal-footer a.button.product_type_variable.add_to_cart_button").show();
	 $(".action.primary").show();
    
    // Get the selected variation ID
    var variation_id = $("input.variation_id").val();
    var price;
	var new_price;
    // Calculate and update the price of the selected variation
    $(".woocommerce-variation-price .woocommerce-Price-amount").each(function() {
      price = parseFloat($(this).text().replace(/[^0-9\.]+/g,"")) * 0.95;
   	$(this).text("$" + price.toFixed(2));
    });
	//
//		$.ajax({
//	      type: "POST",
//	      url: myAjax.ajaxurl,
//	      data: {
//	        action: "update_product_price",
//	        product_id: variation_id,
//	        price: price
//	      },
//	      success: function(response) {
        // The product price has been updated in the database
//	        console.log('if');
//	      }
//	    });
	// 	 	
  } else {
    $(this).parent().parent().siblings(".product-subscription-price").hide();
    $(this).parent().parent().siblings(".my_add_to_cart_button").find("a.button.product_type_variable.add_to_cart_button").show();
	$(this).parent().parent().siblings(".my_add_to_cart_button").find(".show_subscription_popup").hide();
	  	$(this).parent().parent().siblings(".woocommerce-variation-add-to-cart.variations_button.woocommerce-variation-add-to-cart-enabled").find("button.single_add_to_cart_button.button.alt.wp-element-button").show();
    $(this).parent().parent().siblings(".woocommerce-variation-add-to-cart.variations_button.woocommerce-variation-add-to-cart-enabled").find(".show_subscription_popup").hide();
	  
	  $(".modal-footer a.button.product_type_variable.add_to_cart_button").show();
	  $(".modal-footer a.button.product_type_variable.add_to_cart_button").attr("disabled", false);
	$("button.single_add_to_cart_button.action.primary").attr("disabled", false);
    
    // Get the selected variation ID
    var variation_id = $("input.variation_id").val();
	var price;
	var new_price;
    
    // Calculate and update the price of the selected variation
    $(".woocommerce-variation-price .woocommerce-Price-amount").each(function() {
      price = parseFloat($(this).text().replace(/[^0-9\.]+/g,""));
    $(this).text("$" + (price / 0.95).toFixed(2));
    });
	//
//	$.ajax({
  //    type: "POST",
    //  url: myAjax.ajaxurl,
//	      data: {
//	        action: "update_product_price",
//	        product_id: variation_id,
//	        price: price
//	      },
//	      success: function(response) {
        // The product price has been updated in the database
//	        console.log('else');
//	      }
//	    });
	// 	   	   	  
  }
	$(".modal-footer button.single_add_to_cart_button.button.alt.wp-element-button").show();
});

// 
$("button.show_subscription_popup").click(function(){
    $(this).parent().siblings(".modals-wrapper").show();
});
// 
$(".modal-footer a.button.product_type_variable.add_to_cart_button").attr("disabled", true);
$("input#new-subscription-modal-check").click(function(){              
if($(this).is(":checked")){ 
	$("button.single_add_to_cart_button.action.primary").attr("disabled", false);
	$(".modal-footer a.button.product_type_variable.add_to_cart_button").attr("disabled", false);
     }
	else{
    $("button.single_add_to_cart_button.action.primary").attr("disabled", true);
		$(".modal-footer a.button.product_type_variable.add_to_cart_button").attr("disabled", true);
}
});
// 
$("button.cancel_button, button.action-close").click(function(){
    $(".modals-wrapper").hide();
});
	$(".action.primary").click(function(){
		setTimeout(function() {
    		location.reload();
		}, 2000);
	});
	
	
	$(".subscription_chkbox").click(function(){
		if(jQuery(this).is(":checked")){
			var url = jQuery(this).parent().parent().siblings(".modals-wrapper").find(".add_to_cart_button").attr("href");
			url += "&subscription=true";
			jQuery(this).parent().parent().siblings(".modals-wrapper").find(".add_to_cart_button").attr("href", url);
		}
	});
	
// 

// 
});