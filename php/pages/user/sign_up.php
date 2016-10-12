<?php
include("../../parts/header.php");
include("../../api/user.php");

$errors = array();
$success = array();

extract($_POST);
if (isset($submit)) {
    $result = UserCreateRegistered($i_login, $i_password, $i_email);
    if ($result) {
        $is_success = true;
        $success[] = "Successfully registered!";
    } else {
        $is_error = true;
        $errors[] = $result;
    }
}
?>
    <script language="javascript">
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

            <form name="sign_up_form" method="post" action="" onSubmit="return check();">
                <table width="240" border="0" align="center">
                    <tr>
                        <td width="100">
                            <div align="center">
                                <label for="i_login">Login: </label>
                            </div>
                        </td>
                        <td width="140">
                            <input name="i_login" type="text" id="i_login">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <label for="i_email">Email: </label>
                            </div>
                        </td>
                        <td>
                            <input name="i_email" type="text" id="i_email">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <label for="i_password">Password: </label>
                            </div>
                        </td>
                        <td>
                            <input name="i_password" type="password" id="i_password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <label for="i_cpassword">Confirm Password: </label>
                            </div>
                        </td>
                        <td>
                            <input name="i_cpassword" type="password" id="i_cpassword">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>
                                <br>
                                <center>
                                    <input name="submit" type="submit" id="submit" value="Create Account">
                                </center>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td id="error" colspan="2" class="error">
                            <?php
                            if (isset($is_error)) {
                                echo implode("<br>", $errors);
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td id="success" colspan="2" class="success">
                            <?php
                            if (isset($is_success)) {
                                echo implode("<br>", $success);
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>