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

$page = 0;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}

$result = SendRPCQuery("PostersGetByCurrentUser", [$login, $page]);

if (isset($result["error"])) {
    $errors[] = $result["error"];
    return;
}

$rows = $result["content"];
$total_rows = $result["count"];

?>

    <div class="container">

        <?php include("../../parts/sidebar.php"); ?>

        <div class="content">
            <div class="content-text">
                <?php
                echo '<p>You published ' . $total_rows . ' poster(s) on our website</p>';

                if (isset($rows)) {
                    echo '<table width="500" border="0" align="center">
                                <tr>
                                    <th width="100">
                                        Name
                                    </th>
                                    <th width="100">
                                        Place
                                    </th>
                                    <th width="100">
                                        Date
                                    </th>
                                    <th width="100">
                                        Description
                                    </th>
                                    <th width="100">
                                        IMG
                                    </th>
                                </tr>';

                    foreach ($rows as $row) {
                        echo '<tr>
                                <td>' . $row['name'] . '</td>
                                <td>' . $row['place'] . '</td>
                                <td>' . $row['date'] . '</td>
                                <td>' . $row['description'] . '</td>
                                <td><img src="/poster_service/upload/' . $row['img_ref'] . '" width="100" height="100"  ></td>
                              </tr>';
                    }

                    if (count($errors) > 0) {
                        echo '<tr><td id="error" colspan="2" class="error">
                                '.implode("<br>", $errors).'
                              </td></tr>';
                    }

                    echo '</table>';
                }

                include("../../parts/paging.php");
                ?>
            </div>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>