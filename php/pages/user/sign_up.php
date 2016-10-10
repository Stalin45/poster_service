<?php include("../../parts/header.php"); ?>
<?php
include("../../api/user.php");
extract($_POST);
if (isset($submit)) {
    echo "<b>Submitted</b>";
    try {
        UserCreateRegistered($i_login, $i_password, $i_email);
        echo "<b>User created</b>";
        $is_error = true;
        $error_text = "Successfully registered!";
    } catch (Exception $exception) {
        $is_error = true;
        $error_text = $exception;
    }
}
?>
    <script language="javascript">
        function check()
        {
            if(document.sign_up_form.i_login.value=="")
            {
                alert("Plese Enter Login Id");
                document.sign_up_form.lid.focus();
                return false;
            }

            if(document.sign_up_form.i_password.value=="")
            {
                alert("Plese Enter Your Password");
                document.sign_up_form.pass.focus();
                return false;
            }

            if(document.sign_up_form.i_cpassword.value=="")
            {
                alert("Plese Enter Confirm Password");
                document.sign_up_form.cpass.focus();
                return false;
            }

            if(document.sign_up_form.i_password.value!=document.sign_up_form.i_cpassword.value)
            {
                alert("Confirm Password does not matched");
                document.sign_up_form.cpass.focus();
                return false;
            }

            if(document.sign_up_form.email.value=="")
            {
                alert("Plese Enter your Email Address");
                document.sign_up_form.email.focus();
                return false;
            }

            e=document.sign_up_form.i_email.value;
            f1=e.indexOf('@');
            f2=e.indexOf('@',f1+1);
            e1=e.indexOf('.');
            e2=e.indexOf('.',e1+1);
            n=e.length;

            if(!(f1>0 && f2==-1 && e1>0 && e2==-1 && f1!=e1+1 && e1!=f1+1 && f1!=n-1 && e1!=n-1))
            {
                alert("Please Enter valid Email");
                document.sign_up_form.i_email.focus();
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
                        <td colspan="2" class="error">
                            <?php
                            if (isset($is_error)) {
                                echo $error_text;
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>