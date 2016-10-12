<?php include("../../parts/header.php"); ?>

<?php
include("../../api/poster.php");

$login = $_SESSION['login'];
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
        PosterCreate($login, $i_name, $i_descr, $i_place, $i_date, $i_img);
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
            if(document.create_poster_form.i_login.value=="")
            {
                alert("Plese Enter Login Id");
                document.create_poster_form.lid.focus();
                return false;
            }

            if(document.create_poster_form.i_descr.value=="")
            {
                alert("Plese enter the description");
                document.create_poster_form.i_descr.focus();
                return false;
            }

            if(document.create_poster_form.i_place.value=="")
            {
                alert("Plese enter the place");
                document.create_poster_form.i_place.focus();
                return false;
            }

            if(document.create_poster_form.i_date.value=="")
            {
                alert("Plese choose the date");
                document.create_poster_form.i_date.focus();
                return false;
            }

            if(document.create_poster_form.i_img.value=="")
            {
                alert("Plese choose the image");
                document.create_poster_form.i_img.focus();
                return false;
            }

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
                                <label for="i_login">Name of event: </label>
                            </div>
                        </td>
                        <td width="140">
                            <input name="i_login" type="text" id="i_login">
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