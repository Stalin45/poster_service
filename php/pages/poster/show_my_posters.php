<?php include("../../parts/header.php"); ?>

<?php
include("../../api/poster.php");
extract($_POST);
$user_id = $_SESSION['login'];
if (isset($submit)) {
    echo "<b>Submitted</b>";
    try {
        $result = PostersGetByCurrentUser($user_id);
        $is_error = true;
        $error_text = "Successfully created!";
    } catch (Exception $exception) {
        $is_error = true;
        $error_text = $exception;
    }
}
?>

    <div class="container">

        <?php include("../../parts/sidebar.php"); ?>

        <div class="content">
            <div class="content-text">
                <p>Show my posers</p>
                <?php
                if (isset($result)) {
                    echo $result;
                }
                ?>
            </div>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>