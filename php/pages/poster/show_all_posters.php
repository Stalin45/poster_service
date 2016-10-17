<?php include("../../parts/header.php"); ?>

    <script type="application/javascript">
        function changePage(page) {
            if (check()) {
                var datefilter = document.getElementById("chosen_datefilter").value;
                var datetime = document.getElementById("chosen_datetime").value;
                sendAJAX("PosterGetByDate", [datetime, page, datefilter]);
            }
        }

        function showPosters() {
            if (check()) {
                var datefilter = document.getElementById("date_filter").value;
                var date = document.getElementById("i_date").value;
                var time = document.getElementById("i_time").value;
                var datetime = date + ' ' + time;
                var page = 0;
                sendAJAX("PosterGetByDate", [datetime, page, datefilter]);
            }
        }

        function sendAJAX(method, args) {
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
            var error_div = document.getElementById("error");
            ajax_request.onreadystatechange = function () {
                if (ajax_request.readyState == 4) {
                    status_div.innerHTML = "";
                    if (ajax_request.status === 200) {
                        var result = JSON.parse(ajax_request.responseText);
                        if (result.error) {
                            error_div.innerHTML = result.error;
                        } else {
                            if (result.content) {
                                var rows = $result["content"];
                                var total_rows = $result["count"];
                                var poster_table = document.getElementById("poster_table");
                                rows.forEach(function(row) {
                                    poster_table.append(String.format(
                                        "<div>{0}</div>" +
                                        "<div>{1}</div>" +
                                        "<div>{2}</div>" +
                                        "<div>{3}</div>" +
                                        "<div>{4}</div>" +
                                        "<img src='/upload/' width='100' height='100'>",
                                        row['name'], row['place'], row['date'], row['description'], row['img_ref']
                                    ));
                                });
                            } else {
                                error_div.innerHTML = "Error occured";
                            }
                        }
                    } else {
                        status_div.innerHTML = "";
                        error_div.innerHTML = "Error occured";
                    }

                } else {
                    status_div.innerHTML = status_div.innerHTML + '.';
                }
            };

            ajax_request.open("POST", "/php/api/prc_server.php", true);
            ajax_request.setRequestHeader('Content-Type', 'Content-type: application/json');
            status_div = "Waiting for the server";
            ajax_request.send(content);
        }

        function check() {
            return true;
        }
    </script>

    <div class="container">

        <?php include("../../parts/sidebar.php"); ?>

        <div class="content">
            <div class="content-text">
                <div class="filter">
                    <form name="find_poster_form" method="post" action="">
                        <div>
                            <input type="date" id="i_date" name="i_date" value="<?php echo date("Y-m-d"); ?>">
                            <input type="time" id="i_time" name="i_time" value="<?php echo date("H:s"); ?>">
                        </div>
                        <div>
                            <input id="date_filter" name="date_filter" type="radio" value="day"
                                   checked>day</input>
                            <input id="date_filter" name="date_filter" type="radio" value="month">month</input>
                        </div>
                        <div>
                            <input name="submit" type="submit" id="submit" value="Find events">
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

<?php include("../../parts/footer.php"); ?>