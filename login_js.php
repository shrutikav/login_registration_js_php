<script>
$(document).ready(function() {
	$('#login').on('click', function() {
		$("#login_form").show();
		$("#register_form").hide();
		$("#error").hide();
		$("#success").hide();
	});
	$('#register').on('click', function() {
		$("#register_form").show();
		$("#login_form").hide();
		$("#error").hide();
		$("#success").hide();
	});
	$('#butsave').on('click', function() {
		//$("#butsave").attr("disabled", "disabled");
		$("#success").html("");
		$("#error").html("");
		var name = $('#name').val();
		var email = $('#email').val();
		var phone = $('#phone').val();
		var password = $('#password').val();
		var formData = new FormData($("#register_form")[0]);
		var confirm_password = $("#confirm_password").val();
		formData.append("type",1);
		if(password != confirm_password)
	    {
	        alert("Password and Confirm Password are mismatched...");
	        return false;
	    }
		if(name!="" && email!="" && phone!="" && password!=""){
			$.ajax({
				url: "save.php",
				type: "POST",
				data : formData,
				 cache: false,
				 contentType: false,
				 processData: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					$('#register_form')[0].reset();
					if(dataResult.statusCode==200){
						//$("#butsave").removeAttr("disabled");
						$("#success").show();
						$("#error").hide();
						$('#success').html('Registration successful !'); 						
					}
					else if(dataResult.statusCode==201){
						$("#error").show();
						$('#error').html('Email ID already exists !');
					}
					else if(dataResult.statusCode==202){
						$("#error").show();
						$('#error').html(dataResult.message);
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
	$('#butlogin').on('click', function() {
		var email = $('#email_log').val();
		var password = $('#password_log').val();
		if(email!="" && password!="" ){
			$.ajax({
				url: "save.php",
				type: "POST",
				data: {
					type:2,
					email: email,
					password: password						
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						location.href = "welcome.php";						
					}
					else if(dataResult.statusCode==201){
						$("#error").show();
						$('#error').html('Invalid EmailId or Password !');
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
	
});
</script> 