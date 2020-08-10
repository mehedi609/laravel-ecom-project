
$(document).ready(function(){
	$('#password').click(function () {
		const current_password = $('#current_password').val()
		$.ajax({
			type: 'get',
			url: '/admin/check-password',
			data: {
				'current_password': current_password
			},
			success: function (res) {
				if (res === 'true') {
					$('#check-password').html(`<small class="text-success pl-2">Password is Correct</small>`)
				} else {
					$('#check-password').html(`<small style="color: green">Password is Incorrect</small>`)
				}
			},
			error: function (error) {
				alert(error)
			}
		})
	})
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	// Change password validation
	$("#password_validate").validate({
		rules:{
			current_password:{
				required: true,
				minlength:6,
				maxlength:20
			},
			password:{
				required: true,
				minlength:6,
				maxlength:20
			},
			password_confirmation:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#password"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#add_category").validate({
		rules:{
			name:{
				required:true,
				minlength: 4,
				maxlength: 150,
			},
			description:{
				required:true
			},
			url:{
				required:true
			},
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
});
