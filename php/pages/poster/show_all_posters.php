<?php include("../../parts/header.php"); ?>

<?php

$errors = array();
$success = array();

include("../../api/poster.php");

extract($_POST);
if (isset($submit)) {
    $datetime = $i_date . ' ' . $i_time;
    $page = 0;
    $result = PosterGetByDate($datetime, $page, $date_filter);

    if ( ! isset($result["error"])) {
        $_SESSION["datetime"] = $datetime;
        $_SESSION["date_filter"] = $date_filter;
    }
} else {
    $page = $_GET["page"];
    if ( ! isset($page)) {
        $page = 0;
    }

    if (isset($_SESSION["datetime"]) && isset($_SESSION["date_filter"])) {
        $datetime = $_SESSION["datetime"];
        $date_filter = $_SESSION["date_filter"];
        $result = PosterGetByDate($datetime, $page, $date_filter);
    } else {
        $result = PosterGetAll($page);
    }
}

if (isset($result["error"])) {
    $errors[] = $result["error"];
}

$rows = $result["content"];
$total_rows = $result["count"];
//$json_resp = "$request()";
//$resp_array = json_decode($url_resp, true);

?>

    <div class="container">

        <?php include("../../parts/sidebar.php"); ?>

        <div class="content">
            <div class="content-text">
                <div class="filter">
                    <form name="find_poster_form" method="post" action="">
                        <table border="1" width="500">
                            <tr>
                                <td align="center">
                                    <input type="date" id="i_date" name="i_date" value="<?php echo date("Y-m-d"); ?>">
                                    <input type="time" id="i_time" name="i_time" value="<?php echo date("H:s"); ?>">
                                </td>
                                <td align="center">
                                    <p>Period to find:</p><br/>
                                    <input id="date_filter" name="date_filter" type="radio" value="day"
                                           checked>day</input>
                                    <input id="date_filter" name="date_filter" type="radio" value="month">month</input>
                                </td>
                                <td>
                                    <input name="submit" type="submit" id="submit" value="Find events">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <?php
                if (isset($rows)) {
                    echo '<p>Found ' . $total_rows . ' poster(s) on our website</p>';
                    if (isset($_SESSION["datetime"]) && isset($_SESSION["date_filter"])) {
                        echo '<p>Date filter: '.$datetime.' + 1 '.$date_filter;
                    }
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

                    echo '</table>';
                } else {
                    if (count($errors) > 0) {
                        echo '<table width="500" border="0" align="center">
                                <tr><td id="error" colspan="2" class="error">
                                    '.implode("<br>", $errors).'
                                </td></tr>
                              </table>';
                    }
                }

                include("../../parts/paging.php");
                ?>
            </div>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>