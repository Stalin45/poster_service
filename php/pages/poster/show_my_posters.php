<?php include("../../parts/header.php"); ?>

<?php

$errors = array();
$success = array();

if (!isset($_SESSION["authenticated"])) {
    $errors[] = "You are not logged in!";
    return;
}

if (!in_array("Registered", $_SESSION["roles"])) {
    $errors[] = "You don't have rights to creater your own posters!";
    return;
}

include("../../api/poster.php");

$login = $_SESSION['login'];

$result = PostersGetByCurrentUser($login);

?>

    <div class="container">

        <?php include("../../parts/sidebar.php"); ?>

        <div class="content">
            <div class="content-text">
                <?php
                if (isset($result)) {
                    echo '<p>You published ' . count($result) . ' poster(s) on our website</p>';

                    echo '<table width="240" border="0" align="center">
                                <tr>
                                    <th width="50">
                                        Name
                                    </th>
                                    <th width="50">
                                        Place
                                    </th>
                                    <th width="50">
                                        Date
                                    </th>
                                    <th width="50">
                                        Description
                                    </th>
                                    <th width="40">
                                        IMG
                                    </th>
                                </tr>';

                    foreach ($result as list($name, $place, $date, $descr, $img)) {
                        echo '<tr>
                                <td>' . $name . '</td>
                                <td>' . $place . '</td>
                                <td>' . $date . '</td>
                                <td>' . $descr . '</td>
                                <td>' . $img . '</td>
                              </tr>';
                    }

                    if (count($errors) > 0) {
                        echo '<tr><td id="error" colspan="2" class="error">';
                        implode("<br>", $errors);
                        echo '</td></tr>';
                    }

                    echo '</table>';
                }

                ?>
            </div>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>