<div class="sidebar">
    <?php
    if (isset($_SESSION["authenticated"])) {
        if (in_array("user", $_SESSION["roles"])) {
            echo
            '<div id="admin-panel">
            <ul class="nav nav-list bs-docs-sidenav">
                <li class="nav-header">
                    Author menu
                </li>
                <li>
                    <a href="'.$base_url.'/php/pages/poster/create_poster.php">Publish new poster</a>
                </li>
                <li>
                    <a href="'.$base_url.'/php/pages/poster/show_my_posters.php">See my posters</a>
                </li>
            </ul>
        </div>';
        }
    }
    ?>

    <div id="user-panel">
        <ul class="nav nav-list bs-docs-sidenav">
            <li class="nav-header">
                User menu
            </li>
            <li>
                <a href="<?php echo $base_url; ?>/php/pages/poster/show_all_posters.php">Show posters</a>
            </li>
            <li>
                <a href="<?php echo $base_url; ?>/php/pages/about.php">About</a>
            </li>

            <?php
            if ( ! isset($_SESSION["authenticated"])) {
                echo
                '
                <li>
                    <a href="'.$base_url.'/php/pages/user/sign_up.php">Sign Up</a>
                </li>
                <li>
                    <a href="'.$base_url.'/php/pages/user/sign_in.php">Sign In</a>
                </li>';
            }

            if (isset($_SESSION["authenticated"])) {
                echo
                '<li>
                    <a href="'.$base_url.'/php/pages/user/sign_out.php">Sign Out</a>
                </li>';
            }
            ?>
        </ul>
    </div>
</div>