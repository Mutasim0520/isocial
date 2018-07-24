$(document).ready(function () {
    $.validator.setDefaults({
        errorClass: 'help-block',
        highlight:function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight:function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        }
    });

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');

    $("#registration_form").validate({
        rules: {
            name:{
                required:true,
                maxlength: 200,
            },
            email:{
              required:true,
                remote:'/isocial/controllers/emailCheck.php',
            },
            password:{
                rangelength: [6, 200],
            },
            re_password:{
                required:true,
                equalTo: "#password"
            }
        },
        messages:{
            title:{
                required:"Please provide a name of your book.",
                maxlength:"Please proveide a name less than 200 character",
            },
            phone:{
                number:"Please enter a valid phone number",
            },
            email:{
                remote:"This email already exist. Please try with another",
            },
            re_password:{
                equalTo:"Password did not match",
            },
            password:{
                rangelength:"Please enter a password between 6-200 characters",
            }
        }
    });

});