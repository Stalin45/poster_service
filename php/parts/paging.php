<div class = paging>
<?php
if (isset($page) && isset($total_rows)) {
    $total_pages = ceil($total_rows / 1);
    $previous_shown_page = $page;
    $previous_page_link = $previous_shown_page - 1;
    $shown_page = $page + 1;
    $next_shown_page = $page + 2;

    if ($shown_page > 1) {
        echo "<a href = \"$_PHP_SELF?page=$previous_page_link\">$previous_shown_page</a> | ";
    }

    echo "<b>$shown_page</b>";

    if ($shown_page < $total_pages) {
        echo " | <a href = \"$_PHP_SELF?page=$shown_page\">$next_shown_page</a>";
    }

    echo " ($total_pages page(s) total)";
}
?>
</div>
