<?php include("../../parts/header.php"); ?>

<?php

$errors = array();
$success = array();

include("../../api/poster.php");

$result = PosterGetAll();

//$json_resp = "$request()";
//$resp_array = json_decode($url_resp, true);

?>

    <div class="container">

        <?php include("../../parts/sidebar.php"); ?>

        <div class="content">
            <div class="content-text">
                <?php
                if (count($result) > 0) {
                    echo '<p>Found ' . count($result) . ' poster(s) on our website</p>';

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

                    foreach ($result as $row) {
                        echo '<tr>
                                <td>' . $row['name'] . '</td>
                                <td>' . $row['place'] . '</td>
                                <td>' . $row['date'] . '</td>
                                <td>' . $row['description'] . '</td>
                                <td><img src="/poster_service/upload/' . $row['img_ref'] . '" width="100" height="100"  ></td>
                              </tr>';
                    }

                    echo '</table>';
                } else {
                    echo '<p>Posters not found</p>';
                }
                ?>
            </div>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>