<?php
include("../../parts/header.php");
//
//$errors = array();
//$success = array();
//
//extract($_POST);
//if (isset($submit)) {
//    $result = SendRPCQuery("UserCreateRegistered", [$i_login, $i_password, $i_email]);
//
//    if (isset($result["error"])) {
//        $errors[] = $result["error"];
//    } else {
//        if ($result["content"]) {
//            $success[] = "Successfully registered!";
//        } else {
//            $errors[] = "Error occured while registering";
//        }
//    }
//}
?>

    <script type="application/javascript">
        function submitSignUpForm() {
            if (check()) {
                var login = document.getElementById("i_login").value;
                var password = document.getElementById("i_password").value;
                var email = document.getElementById("i_email").value;
                sendAJAX("UserCreateRegistered", [login, password, email]);
            }
        }

        function sendAJAX(method, args) {
            var content = JSON.stringify({"method" : method, "params" : args});
            var ajax_request;
            try {
                // Opera 8.0+, Firefox, Chrome, Safari
                ajax_request = new XMLHttpRequest();
            } catch (e) {
                // Internet Explorer Browsers
                try {
                    ajax_request = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        return false;
                    }

                }
            }

            var status_div = document.getElementById("status");
            var error_div = document.getElementById("error");
            ajax_request.onreadystatechange = function () {
                if (ajax_request.readyState == 4) {
                    if (ajax_request.status === 200) {
                        var result = JSON.parse(ajax_request.responseText);
                        if (result.error) {
                            error_div.innerHTML = result.error;
                        } else {
                            if (result.content) {
                                status_div.innerHTML = result.content;
                            } else {
                                status_div.innerHTML = "";
                                error_div.innerHTML = "Error occured";
                            }
                        }
                    } else {
                        status_div.innerHTML = "";
                        error_div.innerHTML = "Error occured";
                    }

                } else {
                    status_div.innerHTML = status_div.innerHTML + '.';
                }
            };

            ajax_request.open("POST", "/php/api/rpc_server.php", true);
            ajax_request.setRequestHeader('Content-Type', 'Content-type: application/json');
            status_div = "Waiting for the server";
            ajax_request.send(content);
        }

        function check() {
            var errors = [];
            if (document.sign_up_form.i_login.value == "") {
                errors.push("Login is empty");
                document.sign_up_form.i_login.focus();
            }

            if (document.sign_up_form.i_password.value == "") {
                errors.push("Password is empty");
                document.sign_up_form.i_password.focus();
            }

            if (document.sign_up_form.i_cpassword.value == "") {
                errors.push("Confirm Password is empty");
                document.sign_up_form.i_cpassword.focus();
            } else {
                if (document.sign_up_form.i_password.value != document.sign_up_form.i_cpassword.value) {
                    errors.push("Confirm password does not match");
                    document.sign_up_form.i_cpassword.focus();
                }
            }

            //TODO: make RegEx checking
            if (document.sign_up_form.i_email.value == "") {
                errors.push("Email address is empty");
                document.sign_up_form.i_email.focus();
            } else {
                e = document.sign_up_form.i_email.value;
                f1 = e.indexOf('@');
                f2 = e.indexOf('@', f1 + 1);
                e1 = e.indexOf('.');
                e2 = e.indexOf('.', e1 + 1);
                n = e.length;

                if (!(f1 > 0 && f2 == -1 && e1 > 0 && e2 == -1 && f1 != e1 + 1 && e1 != f1 + 1 && f1 != n - 1 && e1 != n - 1)) {
                    errors.push("Please enter valid email");
                    document.sign_up_form.i_email.focus();
                }
            }

            if (errors.length > 0) {
                document.getElementById("error").innerHTML = errors.join("<br/>");
                return false;
            }

            return true;
        }
    </script>

    <div class="container">

        <?php include("../../parts/sidebar.php"); ?>

        <div class="content">

            <div class="content-text">
                <p>As registered user you will be able to publish your own posters!</p>
            </div>

            <form name="sign_up_form">
                <div>
                    <label for="i_login">Login: </label>
                    <input name="i_login" type="text" id="i_login">
                </div>
                <div>
                    <label for="i_email">Email: </label>
                    <input name="i_email" type="text" id="i_email">
                </div>
                <div>
                    <label for="i_password">Password: </label>
                    <input name="i_password" type="password" id="i_password">
                </div>
                <div>
                    <label for="i_cpassword">Confirm Password: </label>
                    <input name="i_cpassword" type="password" id="i_cpassword">
                </div>
                <div>
                    <button name="submit" type="submit" onclick="submitSignUpForm()">Create Account</button>
                </div>
                <div id="error" class="error"></div>
                <div id="status" class="status"></div>
            </form>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>