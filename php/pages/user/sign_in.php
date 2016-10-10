<?php include("../../parts/header.php"); ?>
<div class="container">

    <?php include("../../parts/sidebar.php"); ?>

    <div class="content">
        <div class="content-text">
            <form name="form1" method="post" action="">
                <table width="200" border="0">
                    <tr>
                        <td><span class="style2">Login</span></td>
                        <td><input name="loginid" type="text" id="loginid2"></td>
                    </tr>
                    <tr>
                        <td><span class="style2">Password</span></td>
                        <td><input name="pass" type="password" id="pass2"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="errors">
                                <?php
                                    if (isset($sign_in_error)) {
                                        echo "Invalid Username or Password";
                                    }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2 align=center class="errors">
                            <input name="submit" type="submit" id="submit" value="Login"></td>
                    </tr>
                    <tr>
                        <td colspan="2" bgcolor="#CC3300">
                            <div align="center">
                                <span class="style4">New User ?
                                    <a href="sign_up.php">Signup Free</a>
                                </span>
                            </div>
                        </td>
                    </tr>
                </table>
                <div align="center">
                    <p class="style5"><img src="images/topleft.jpg" width="134" height="128"></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("../../parts/footer.php"); ?>

<!--<p class="head1">Adminstrative Login </p>-->
<!--<form name="form1" method="post" action="login.php">-->
<!--    <table width="490" border="0">-->
<!--        <tr>-->
<!--            <td width="106"><span class="style2"></span></td>-->
<!--            <td width="132"><span class="style2"><span class="head1"><img src="login.jpg" width="131" height="155"></span></span></td>-->
<!--            <td width="238"><table width="219" border="0" align="center">-->
<!--                    <tr>-->
<!--                        <td width="163" class="style2">Login ID </td>-->
<!--                        <td width="149"><input name="loginid" type="text" id="loginid"></td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td class="style2">Password</td>-->
<!--                        <td><input name="pass" type="password" id="pass"></td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td class="style2">&nbsp;</td>-->
<!--                        <td>&nbsp;</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td class="style2">&nbsp;</td>-->
<!--                        <td><input name="submit" type="submit" id="submit" value="Login"></td>-->
<!--                    </tr>-->
<!--                </table></td>-->
<!--        </tr>-->
<!--    </table>-->
<!---->
<!--</form>-->