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

$login = $_SESSION['login'];

if (isset($_FILES['i_img'])) {
    $file_name = $_FILES['i_img']['name'];
    $file_size = $_FILES['i_img']['size'];
    $file_tmp = $_FILES['i_img']['tmp_name'];
    $file_type = $_FILES['i_img']['type'];
    $tmp = explode('.', $file_name);
    $file_ext = strtolower(end($tmp));

    $expensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (count($errors) == 0) {
        $destFileName = microtime(true) . $file_name;
        $moveResult = move_uploaded_file($file_tmp, "../../../upload/" . $destFileName);
        if (!$moveResult) {
            $erros[] = "File not uploaded. Try again.";
        }
    }
}

extract($_POST);
if (isset($submit) && empty($errors)) {
    $datetime = $i_date . ' ' . $i_time;
    $result = SendRPCQuery("PosterCreate", [$login, $i_name, $i_descr, $i_place, $datetime, $destFileName]);

//    if (isset($result["error"])) {
//        $errors[] = $result["error"];
//        return;
//    } else {
//        $success[] = "Successfully created!";
//    }
}
?>

    <script type="application/javascript">
        function submitCreatePosterForm() {
            if (check()) {
                var name = document.getElementById("i_name").value;
                var descr = document.getElementById("i_descr").value;
                var place = document.getElementById("i_place").value;
                var date = document.getElementById("i_date").value;
                var time = document.getElementById("i_time").value;
                var datetime = date + ' ' + time;
                var image = document.getElementById("i_img").;
                sendAJAX("UserCreateRegistered", [$login, $i_name, $i_descr, $i_place, $datetime, $destFileName]);
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

            ajax_request.open("POST", "/php/api/prc_server.php", true);
            ajax_request.setRequestHeader('Content-Type', 'Content-type: application/json');
            status_div = "Waiting for the server";
            ajax_request.send(content);
        }

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

            //TODO: date in past checking
            if (document.create_poster_form.i_date.value == "") {
                errors.push("Plese choose the date");
                document.create_poster_form.i_date.focus();
            }

            if (document.create_poster_form.i_time.value == "") {
                errors.push("Plese choose the time");
                document.create_poster_form.i_time.focus();
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

            <form name="create_poster_form" enctype="multipart/form-data"
                  onSubmit="return check();">
                <div>
                    <label for="i_name">Name of event: </label>
                    <input name="i_name" type="text" id="i_name">
                </div>
                <div>
                    <label for="i_descr">Description: </label>
                    <input name="i_descr" type="text" id="i_descr">
                </div>
                <div>
                    <label for="i_place">Place: </label>
                    <input name="i_place" type="text" id="i_place">
                </div>
                <div>
                    <label for="i_date">Date: </label>
                    <input type="date" id="i_date" name="i_date" value="<?php echo date("Y-m-d"); ?>">
                    <input type="time" id="i_time" name="i_time" value="<?php echo date("H:s"); ?>">
                </div>
                <div>
                    <input name="i_img" type="file" id="i_img">
                </div>
                <div>
                    <button name="submit" type="submit" onclick="submitSignUpForm()">Create Poster</button>
                </div>
                <div id="error" colspan="2" class="error">
                    <!--                            --><?php
                    //                            if (count($errors) > 0) {
                    //                                echo implode("<br>", $errors);
                    //                            }
                    //                            ?>
                </div>
                <div id="success" colspan="2" class="success">
                    <!--                            --><?php
                    //                            if (count($success) > 0) {
                    //                                echo implode("<br>", $success);
                    //                            }
                    //                            ?>
                </div>
            </form>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>