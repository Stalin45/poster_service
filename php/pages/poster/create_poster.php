<?php include("../../parts/header.php"); ?>

<?php
$errors = array();
$success = array();

if (!isset($_SESSION["authenticated"])) {
    $errors[] = "You are not logged in!";
    return;
}

if (!in_array("user", $_SESSION["roles"])) {
    $errors[] = "You don't have rights to creater your own posters!";
    return;
}

include("../../api/poster.php");

$login = $_SESSION['login'];

if (isset($_FILES['i_img'])) {
    $file_name = $_FILES['i_img']['name'];
    $file_size = $_FILES['i_img']['size'];
    $file_tmp = $_FILES['i_img']['tmp_name'];
    $file_type = $_FILES['i_img']['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));

    $expensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (count($errors) == 0) {
        $destFileName = microtime(true).$file_name;
        $moveResult = move_uploaded_file($file_tmp, "../../../upload/".$destFileName);
        if (!$moveResult) {
            $erros[] = "File not uploaded. Try again.";
        }
    }
}

extract($_POST);
if (isset($submit) && empty($errors)) {
    $result = PosterCreate($login, $i_name, $i_descr, $i_place, $i_date, $destFileName);
    if ($result) {
        $success[] = "Successfully created!";
    } else {
        $errors[] = "Error occured while creating poster";
    }
}
?>

    <script language="javascript">

        function check() {
            var errors = [];
            if (document.create_poster_form.i_name.value == "") {
                errors.push("Plese enter name of event");
                document.create_poster_form.i_name.focus();
            }

            if (document.create_poster_form.i_descr.value == "") {
                errors.push("Plese enter the description");
                document.create_poster_form.i_descr.focus();
            }

            if (document.create_poster_form.i_place.value == "") {
                errors.push("Plese enter the place");
                document.create_poster_form.i_place.focus();
            }

            if (document.create_poster_form.i_date.value == "") {
                errors.push("Plese choose the date");
                document.create_poster_form.i_date.focus();
            }

            if (document.create_poster_form.i_img.value == "") {
                errors.push("Plese choose the image");
                document.create_poster_form.i_img.focus();
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
                <p>Here you can create your own poster!</p>
            </div>

            <form name="create_poster_form" method="post" enctype="multipart/form-data" action="" onSubmit="return check();">
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
                            <input name="i_img" type="file" id="i_img">
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
                        <td id="error" colspan="2" class="error">
                            <?php
                            if (count($errors) > 0) {
                                echo implode("<br>", $errors);
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td id="success" colspan="2" class="success">
                            <?php
                            if (count($success) > 0) {
                                echo $success;
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>