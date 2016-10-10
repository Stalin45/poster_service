<?php
include("../../parts/header.php");

$json_resp = "$request()";
$resp_array = json_decode($url_resp, true);

?>
    <div class="container">

        <?php include("../../parts/sidebar.php"); ?>

        <div class="content">
            <div class="content-text">
                <p>Show all posers</p>
            </div>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>