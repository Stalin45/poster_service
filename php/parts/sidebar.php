<div class="sidebar">
    <?php
    if (isset($_SESSION["authenticated"])) {
        if (in_array("user", $_SESSION["roles"])) {
            echo
            '<ul class="nav nav-sidebar">
                <li><h4><a href="' . BASE_URL . '/php/pages/poster/create_poster.php" class="list-group-item">Publish new poster</a></h4></li>
                <li><a href="' . BASE_URL . '/php/pages/poster/show_my_posters.php" class="list-group-item">See my posters</a></li>
            </ul>';
        }
    }
    ?>

    <ul class="nav nav-sidebar">
        <li><a href="<?php echo BASE_URL; ?>/php/pages/poster/show_all_posters.php">Show posters</a></li>

        <?php
        if (!isset($_SESSION["authenticated"])) {
            echo
                '
                <li>
                    <a href="' . BASE_URL . '/php/pages/user/sign_up.php">Sign Up</a>
                </li>
                <li>
                    <a href="' . BASE_URL . '/php/pages/user/sign_in.php">Sign In</a>
                </li>';
        }

        if (isset($_SESSION["authenticated"])) {
            echo
                '<li>
                    <a href="' . BASE_URL . '/php/pages/user/sign_out.php">Sign Out</a>
                </li>';
        }
        ?>
    </ul>
</div>