<?php include("../../parts/header.php");
include("../../api/user.php");

$errors = array();
$success = array();

extract($_POST);
if (isset($submit)) {
    if (UserIsRegistered($i_login, $i_password)) {
        $_SESSION['authenticated'] = "true";
        $_SESSION['login'] = $i_login;
        $_SESSION['roles'] = UserGetRolesByName($i_login);
        header("location: ../../../index.php");
    } else {
        $errors[] = "Invalid User Name or Password";
    }
}
//} else if (!isset($_SESSION[alogin])) {
//    echo "<BR><BR><BR><BR><div class=head1> Your are not logged in<br> Please <a href=index.php>Login</a><div>";
//    exit;
//}
?>

    <script language="javascript">
        function check() {
            var errors = [];
            if (document.sign_in_form.i_login.value == "") {
                errors.push("Login is empty");
                document.sign_in_form.i_login.focus();
            }

            if (document.sign_in_form.i_password.value == "") {
                errors.push("Password is empty");
                document.sign_in_form.i_password.focus();
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
                <form name="sign_in_form" method="post" action="" onSubmit="return check();">
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
                                    <label for="i_password">Password: </label>
                                </div>
                            </td>
                            <td>
                                <input name="i_password" type="password" id="i_password">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label>
                                    <br>
                                    <center>
                                        <input name="submit" type="submit" id="submit" value="Sign in">
                                    </center>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" bgcolor="#CC3300">
                                <div align="center">
                                <span>New User ? <a href="sign_up.php">Signup Free</a>
                                </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td id="error" colspan="2" class="error">
                                <?php
                                if (count($errors) > 0) {
                                    echo implode("<br>", $errors);
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>