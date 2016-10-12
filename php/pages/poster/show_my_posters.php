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

$result = PostersGetByCurrentUser($login);

?>

    <div class="container">

        <?php include("../../parts/sidebar.php"); ?>

        <div class="content">
            <div class="content-text">
                <?php
                echo '<p>You published ' . count($result) . ' poster(s) on our website</p>';

                if (count($result) > 0) {
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

                    foreach ($result as $row) {
                        echo '<tr>
                                <td>' . $row['name'] . '</td>
                                <td>' . $row['place'] . '</td>
                                <td>' . $row['date'] . '</td>
                                <td>' . $row['description'] . '</td>
                                <td><img src="/poster_service/upload/' . $row['img_ref'] . '" width="100" height="100"  ></td>
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