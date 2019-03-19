$(document).on("DOMContentLoaded", () => {
	function validate_registration_form(){
		let name = /^[a-zA-Z ]+$/;
		let email = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
		//Password should contain uppercase, lowercase AND numbers and should be at least 8 characters in length.
		let username = /^[A-Za-z0-9]+(?:[. _-][A-Za-z0-9]+)*$/;
		let password = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
		let address = /^[A-Za-z0-9]+(?:[. _-][A-Za-z0-9]+)*$/;

		let errors = 0;
		//username
		if(!$("#username").val().match(username)){
			//uses regex to match to the value of the username field.
			$("#username").next().text("Please provide a valid username");
			errors++;			
		} else {
			$('#username').next().text('');
		}
		//password
		if(!$("#password").val().match(password)){
			//uses regex to match to the value of the username field.
			$("#password").next().text("Please provide a valid password");
			errors++;			
		} else {
			$('#password').next().text('');
		}
		//email
		if(!$("#email").val().match(email)){
			//uses regex to match to the value of the username field.
			$("#email").next().text("Please provide a valid email");
			errors++;			
		} else {
			$('#email').next().text('');
		}
		//address
		if(!$("#address").val().match(address)){
			//uses regex to match to the value of the username field.
			$("#address").next().text("Please provide a valid address");
			errors++;			
		} else {
			$('#address').next().text('');
		}
		//firstname
		if(!$("#firstname").val().match(name)){
			//uses regex to match to the value of the username field.
			$("#firstname").next().text("Please provide a valid first name");
			errors++;			
		} else {
			$('#firstname').next().text('');
		}
		//last name
		if(!$("#lastname").val().match(name)){
			//uses regex to match to the value of the username field.
			$("#lastname").next().text("Please provide a valid last name");
			errors++;			
		} else {
			$('#lastname').next().text('');
		}
		//confirm password
		if($("#password").val() !== $("#confirm_password").val()){
			$('#confirm_password').next().text("Passwords should match");
			errors++;
		} else {
			$("#confirm_password").next().text();
		}

		if(errors > 0){
			return false; //this means there are errors in validation
		} else {
			return true; //this means you're good to register.
		}
	}

	//actual registration
	$("#add_user").click((e) => {
		if(validate_registration_form()){
			let username = $("#username").val();
			let password = $("#password").val();
			let firstname = $("#firstname").val();
			let lastname = $("#lastname").val();
			let email = $("#email").val();
			let address = $("#address").val();

			$.ajax({
				"url":'../controllers/create_user.php',
				"type": "POST",
				"data":{
					'username':username,
					'password':password,
					'firstname':firstname,
					'lastname':lastname,
					'email':email,
					'address':address
				},
				"success":(data) => {
					if (data == "user_exist"){
						$("#validation_register").html("Username already exists");
					} else {
						window.location.href = "../views/catalog.php";
					}
				}
			});
		}
	});

	//login and session
	$("#login").click((e) => {
		let username = $("#username").val();
		let password = $("#password").val();
		
		$.ajax({
			"url": "../controllers/authenticate.php",
			"type":"POST",
			"data": {
				'username': username,
				'password': password
			},
			"success":(data) => {
				if(data == "login_failed"){
					$("#validation_login").html("Please provide correct credentials");
				} else {
					window.location.replace("../index.php");
				}
			}
		});
	});

	//search

	$("#searchButton").click((e) => {
		let search = $("#search").val();
		
		$.ajax({
			"url": "../controllers/search.php",
			"type":"POST",
			"data": {
				'search': search
			},
			"success":(data) => {
				$("#products").html(data);
				}
		})

	});	



	//prep for add to cart: turning off the default behavior and overriding with our own
	$(document).off('click', '.add-to-cart').on('click', '.add-to-cart', (e)=>{
		e.stopPropagation(); //prevents parent elements to be triggered.
		let item_id = $(e.target).attr('data-id');
		let item_quantity = parseInt($(e.target).prev().val());

		$.ajax({
			"url":"../controllers/update_cart.php",
			"data":{
				'item_id':item_id,
				'item_quantity': item_quantity,
				'update_flag': false
			},
			"type":"POST",
			"success": (dataFromController) => {
				$("#cart-count").text(dataFromController);
				$(e.target).prev().val(0);
			}
		});
	});
	function getTotal(){
		let total = 0;
		$('.item_subtotal').each(function(e){
			total += parseFloat($(this).text());
		});
		$("#total_price").text(total.toFixed(2));
	}
	//edit cart
	$(".item_quantity>input").on("input", (e) => {
		let item_id = $(e.target).data('id');
		let quantity = parseInt($(e.target).val());
		let price = parseFloat($(e.target).parents('tr').find(".item_price").text());

		subTotal = quantity * price;
		$(e.target).parents('tr').find('.item_subtotal').text(subTotal.toFixed(2));
		getTotal();
		$.ajax({
			"type": "POST",
			"url": "../controllers/update_cart.php",
			"data":{
				'item_id':item_id,
				'item_quantity':quantity,
				'update_flag':true
			},
			"success": (data) => {
				$("#cart-count").text(data);
			} 
		});
	});

	//delete_cart
	$(document).off('click', ".item-remove").on('click', '.item-remove', (e) => {
		e.stopPropagation();
		let item_id = $(e.target).data('id');

		$.ajax({
			"type":"POST",
			"url":"../controllers/update_cart.php",
			"data":{
				'item_id':item_id,
				'item_quantity': 0
			},
			"success": (data) =>{
				$(e.target).parents('tr').remove();
				$("#cart-count").text(data);
				getTotal();
			}
		});
	});
	/*Scroll to top when arrow up clicked BEGIN*/
	$(document).ready(function(){ 
    	$(window).scroll(function(){ 
        	if ($(this).scrollTop() > 100) { 
            	$('#scroll').fadeIn(); 
        	} else { 
            	$('#scroll').fadeOut(); 
        	} 
    	}); 
    	$('#scroll').click(function(){ 
        	$("html, body").animate({ scrollTop: 0 }, 600); 
        	return false; 
    	}); 
	});
 /*Scroll to top when arrow up clicked END*/
});


  /* Demo purposes only */
  $(".hover").mouseleave(
    function () {
      $(this).removeClass("hover");
    }
  );