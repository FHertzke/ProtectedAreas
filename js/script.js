// script tags for validation contact
function ValidateName() {
            var name = document.getElementById("name").value;
            var lblname = document.getElementById("error_name");
            lblname.innerHTML = "";
            if (name.length < 5) {
                lblname.innerHTML = "Name must be more than 5 characters.";
                $('#name').addClass('is-invalid');
                $('#name').removeClass('is-valid');
                $('#error_name').removeClass('text-success');
                $('#error_name').addClass('text-danger');
            }
            else {
                $('#name').addClass('is-valid');
                $('#name').removeClass('is-invalid');
                $('#error_name').removeClass('text-danger');
                $('#error_name').addClass('text-success');
                lblname.innerHTML = "looks good !";
            }
        }
        function ValidateEmail() {
            var email = document.getElementById("email").value;
            var lblError = document.getElementById("error_email");
            lblError.innerHTML = "";
            var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if (!expr.test(email)) {
                lblError.innerHTML = "Invalid email address.";
                $('#email').addClass('is-invalid');
                $('#email').removeClass('is-valid');
                $('#error_email').removeClass('text-success');
                $('#error_email').addClass('text-danger');
            }
            else {
                $('#email').addClass('is-valid');
                $('#email').removeClass('is-invalid');
                $('#error_email').removeClass('text-danger');
                $('#error_email').addClass('text-success');
                lblError.innerHTML = "looks good !";
            }
        }
        function ValidateMobile() {
            var mobile = document.getElementById("mobile").value;
            var lblmobile = document.getElementById("error_mobile");
            lblmobile.innerHTML = "";
            if (mobile.length == 10) {
                $('#mobile').addClass('is-valid');
                $('#mobile').removeClass('is-invalid');
                $('#error_mobile').removeClass('text-danger');
                $('#error_mobile').addClass('text-success');
                lblmobile.innerHTML = "looks good !";
            }
            else {
                lblmobile.innerHTML = "Mobile number must be of 10 digits";
                $('#mobile').addClass('is-invalid');
                $('#mobile').removeClass('is-valid');
                $('#error_mobile').removeClass('text-success');
                $('#error_mobile').addClass('text-danger');
            }
        }
        function ValidatePassword() {
            var password = document.getElementById("password").value;
            var lblErrorp = document.getElementById("error_password");
            lblErrorp.innerHTML = "";
            if (password.length < 5) {
                lblErrorp.innerHTML = "Message must be more than 5 characters";
                $('#password').addClass('is-invalid');
                $('#password').removeClass('is-valid');
                $('#error_password').removeClass('text-success');
                $('#error_password').addClass('text-danger');

            }
            else {
                $('#password').addClass('is-valid');
                $('#password').removeClass('is-invalid');
                $('#error_password').removeClass('text-danger');
                $('#error_password').addClass('text-success');
                lblErrorp.innerHTML = "looks good !";
            }
        }

        function form_login() {

            var name = jQuery('#name').val();
            var email = jQuery('#email').val();
            var mobile = jQuery('#mobile').val();
            var password = jQuery('#password').val();
            var confirm_password = jQuery('#confirm_password').val();
            // var frm_error = '';
            var lblname = document.getElementById("error_name");
            lblname.innerHTML = "";
            jQuery('.error_fields').html('');
            if (name.length < 5) {
                lblname.innerHTML = "Name must be more than 5 characters.";
                $('#name').addClass('is-invalid');
                $('#name').removeClass('is-valid');
                $('#error_name').removeClass('text-success');
                $('#error_name').addClass('text-danger');
                frm_error = 'yes';
            }
            if (name.length > 5) {
                $('#name').addClass('is-valid');
                $('#name').removeClass('is-invalid');
                $('#error_name').removeClass('text-danger');
                $('#error_name').addClass('text-success');
                lblname.innerHTML = "looks good !";
                frm_error = '';
            }
            var lblmobile = document.getElementById("error_mobile");
            lblmobile.innerHTML = "";
            if (mobile.length == 10) {
                $('#mobile').addClass('is-valid');
                $('#mobile').removeClass('is-invalid');
                $('#error_mobile').removeClass('text-danger');
                $('#error_mobile').addClass('text-success');
                lblmobile.innerHTML = "looks good !";
                frm_error = '';
            }
            if (mobile.length != 10) {
                lblmobile.innerHTML = "Mobile number must be of 10 digits";
                $('#mobile').addClass('is-invalid');
                $('#mobile').removeClass('is-valid');
                $('#error_mobile').removeClass('text-success');
                $('#error_mobile').addClass('text-danger');
                frm_error = 'yes';
            }


            if (email.length <= 5) {
                jQuery('#email').addClass('is-invalid');
                jQuery('#error_email').html('Email must be more than 5 character');
                frm_error = 'yes';
            }
            if (email.length >= 6) {
                jQuery('#email').removeClass('is-invalid');
                jQuery('#email').addClass('is-valid');
                frm_error = '';
            }
            if (password.length <= 4) {
                jQuery('#password').addClass('is-invalid');
                jQuery('#error_password').html('Message must be more than 4 character');
                frm_error = 'yes';
            }
            if (password.length >= 5) {
                jQuery('#password').addClass('is-valid');
                jQuery('#password').removeClass('is-invalid');
                frm_error = '';
            }
            var lblcp = document.getElementById("error_confirm_password");
            lblcp.innerHTML = "";
            if (confirm_password == '') {
                lblcp.innerHTML = "Password did not match !";
                $('#confirm_password').addClass('is-invalid');
                $('#confirm_password').removeClass('is-valid');
                $('#error_confirm_password').removeClass('text-success');
                $('#error_confirm_password').addClass('text-danger');
                frm_error = 'yes';
            }

            if (frm_error == '') {
                $('#submit').html('connecting..');
                alert("submitted");
            }

        }