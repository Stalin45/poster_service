<?php include("../../parts/header.php"); ?>

<?php
include("../../api/poster.php");

$errors= array();
$success = array();

// Check if image file is a actual image or fake image
if(isset($_FILES['i_img'])){
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

    $expensions= array("jpeg","jpg","png");

    if(in_array($file_ext, $expensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > 2097152){
        $errors[]='File size must be excately 2 MB';
    }

    if(empty($errors) == true){
        $i_img = "uploads/".$file_name;
        move_uploaded_file($file_tmp, $i_img);
    }else{
        $is_error = true;
        return;
    }
}

extract($_POST);
if (isset($submit) && !isset($is_error)) {
    //TODO: move try - catch into API
    try {
        PosterCreate($i_name, $i_descr, $i_place, $i_date, $i_img);
        $is_success = true;
        $success[] = "Successfully created!";
    } catch (Exception $exception) {
        $is_error = true;
        $errors[] = $exception;
    }
}
?>

    <script language="javascript">
        function check()
        {
//            if(document.sign_up_form.i_login.value=="")
//            {
//                alert("Plese Enter Login Id");
//                document.sign_up_form.lid.focus();
//                return false;
//            }
//
//            if(document.sign_up_form.i_password.value=="")
//            {
//                alert("Plese Enter Your Password");
//                document.sign_up_form.pass.focus();
//                return false;
//            }
//
//            if(document.sign_up_form.i_cpassword.value=="")
//            {
//                alert("Plese Enter Confirm Password");
//                document.sign_up_form.cpass.focus();
//                return false;
//            }
//
//            if(document.sign_up_form.i_password.value!=document.sign_up_form.i_cpassword.value)
//            {
//                alert("Confirm Password does not matched");
//                document.sign_up_form.cpass.focus();
//                return false;
//            }
//
//            if(document.sign_up_form.email.value=="")
//            {
//                alert("Plese Enter your Email Address");
//                document.sign_up_form.email.focus();
//                return false;
//            }
//
//            e=document.sign_up_form.i_email.value;
//            f1=e.indexOf('@');
//            f2=e.indexOf('@',f1+1);
//            e1=e.indexOf('.');
//            e2=e.indexOf('.',e1+1);
//            n=e.length;
//
//            if(!(f1>0 && f2==-1 && e1>0 && e2==-1 && f1!=e1+1 && e1!=f1+1 && f1!=n-1 && e1!=n-1))
//            {
//                alert("Please Enter valid Email");
//                document.sign_up_form.i_email.focus();
//                return false;
//            }
            return true;
        }
    </script>

    <div class="container">

        <?php include("../../parts/sidebar.php"); ?>

        <div class="content">

            <div class="content-text">
                <p>Here you can create your own poster!</p>
            </div>

            <form name="create_poster_form" method="post" action="" onSubmit="return check();">
                <table width="240" border="0" align="center">
                    <tr>
                        <td width="100">
                            <div align="center">
                                <label for="i_name">Name of event: </label>
                            </div>
                        </td>
                        <td width="140">
                            <input name="i_name" type="text" id="i_name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <label for="i_descr">Description: </label>
                            </div>
                        </td>
                        <td>
                            <input name="i_descr" type="text" id="i_descr">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <label for="i_place">Place: </label>
                            </div>
                        </td>
                        <td>
                            <input name="i_place" type="text" id="i_place">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <label for="i_date">Date: </label>
                            </div>
                        </td>
                        <td>
                            <input name="i_date" type="text" id="i_date">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <label for="i_img">Image: </label>
                            </div>
                        </td>
                        <td>
                            <input name="i_img" type="file" id="i_img" >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label>
                                <br>
                                <center>
                                    <input name="submit" type="submit" id="submit" value="Create Poster">
                                </center>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="error">
                            <?php
                            if (isset($is_error)) {
                                echo $errors;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="success">
                            <?php
                            if (isset($is_error)) {
                                echo $errors;
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>