<?php include("../../parts/header.php"); ?>

    <script type="application/javascript">
        window.onload = function() {
            showPosters();
        };

        function changePage(page) {
            console.log("Changing page to " + page);
            if (check()) {
                var datefilter = document.getElementById("chosen_datefilter").value;
                var datetime = document.getElementById("chosen_datetime").value;
                sendAJAX("PosterGetByDate", [datetime, page, datefilter]);
            }

            return false;
        }

        function showPosters() {
            console.log("Show posters");
            if (check()) {
                var datefilter;
                if (document.getElementById("date_filter_day").checked) {
                    datefilter = document.getElementById("date_filter_day").value;
                } else {
                    datefilter = document.getElementById("date_filter_month").value;
                }
                var date = document.getElementById("i_date").value;
                var time = document.getElementById("i_time").value;
                var datetime = date + ' ' + time;
                var page = 0;
                sendAJAX("PosterGetByDate", [datetime, page, datefilter]);
                document.getElementById("chosen_datefilter").value = datefilter;
                document.getElementById("chosen_datetime").value = datetime;
            }

            return false;
        }

        function sendAJAX(method, args) {
            console.log("Sending AJAX method: " + method + " params: " + args);
            var content = JSON.stringify({"method": method, "params": args});
            var ajax_request;
            try {
                // Opera 8.0+, Firefox, Chrome, Safari
                ajax_request = new XMLHttpRequest();
            } catch (e) {
                // Internet Explorer Browsers
                try {
                    ajax_request = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        return false;
                    }

                }
            }

            var status_div = document.getElementById("status");
            status_div.innerHTML = "";
            var error_div = document.getElementById("error");
            error_div.innerHTML = "";
            ajax_request.onreadystatechange = function () {
                if (ajax_request.readyState == 4) {
                    if (ajax_request.status === 200) {
                        console.log("Result code " + ajax_request.status + ". Response: " + ajax_request.responseText);
                        var result = JSON.parse(ajax_request.responseText);
                        console.log("Success. Result: " + result);
                        if (result.error) {
                            error_div.innerHTML = result.error;
                        } else {
                            if (result.content) {
                                var rows = result.content;
                                var total_rows = result.count;
                                var poster_table = document.getElementById("poster_table");
                                poster_table.innerHTML = "";
                                rows.forEach(function (row) {
                                    poster_table.innerHTML = poster_table.innerHTML +
                                        "<div>" + row['name'] + "</div>" +
                                        "<div>" + row['place'] + "</div>" +
                                        "<div>" + row['date'] + "</div>" +
                                        "<div>" + row['description'] + "</div>" +
                                        "<div><img src='/poster_service/upload/" + row['img_ref'] + "'></div>";
                                });
                            } else {
                                error_div.innerHTML = "Error occured";
                            }
                        }
                    } else {
                        console.log("Error. Result code " + ajax_request.status + ". Received ");
                        error_div.innerHTML = "Error occured";
                    }
                } else {
                    status_div.innerHTML = status_div.innerHTML + '.';
                }
            };

            ajax_request.open("POST", "http://localhost/poster_service/php/api/rpc_server.php", true);
            ajax_request.setRequestHeader('Content-Type', 'Content-type: application/json');
            status_div = "Waiting for the server";
            ajax_request.send(content);
        }

        function check() {
            console.log("Checking params");
            return true;
        }
    </script>

    <div class="container-fluid">
        <div class="row">

            <?php include("../../parts/sidebar.php"); ?>

            <div class="col-sm-10 col-sm-offset-2 main">
                <h1 class="page-header">Dashboard</h1>

                <div class="row placeholders">
                    <div class="filter">
                        <form name="find_poster_form" method="post" action="">
                            <div>
                                <input type="date" id="i_date" name="i_date" value="<?php echo date("Y-m-d"); ?>">
                                <input type="time" id="i_time" name="i_time" value="<?php echo date("H:s"); ?>">
                            </div>
                            <div>
                                <input id="date_filter_day" name="date_filter" type="radio" value="day"
                                       checked>day</input>
                                <input id="date_filter_month" name="date_filter" type="radio" value="month">month</input>
                            </div>
                            <div>
                                <button name="submit" type="submit" onclick="return showPosters()">Find events</button>
                                <input type=hidden id="chosen_datetime" name="chosen_datetime"/>
                                <input type=hidden id="chosen_datefilter" name="chosen_datefilter"/>
                            </div>
                        </form>
                    </div>
                    <p>Found total_rows poster(s) on our website</p>';
                    <p>Date filter: datetime + 1 date_filter</p>

                    <div class="poster_list">
                        <div>Name</div>
                        <div>Place</div>
                        <div>Date</div>
                        <div>Description</div>
                        <div>IMG</div>
                        <div id="poster_table"></div>
                    </div>
                    <?php
                    include("../../parts/paging.php");
                    ?>
                    <div id="error" class="error"></div>
                    <div id="status" class="status"></div>
                </div>
            </div>
        </div>
    </div>

<?php include("../../parts/footer.php"); ?>