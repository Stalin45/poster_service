<?php include("php/parts/header.php"); ?>
    <div class="container-fluid">
        <div class="row">

            <?php include("php/parts/sidebar.php"); ?>

            <div class="col-sm-10 col-sm-offset-2 main">
                <h1 class="page-header">Dashboard</h1>

                <div class="row placeholders">
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                             width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                        <h4>Label</h4>
                        <span class="text-muted">Something else</span>
                    </div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                             width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                        <h4>Label</h4>
                        <span class="text-muted">Something else</span>
                    </div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                             width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                        <h4>Label</h4>
                        <span class="text-muted">Something else</span>
                    </div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                             width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                        <h4>Label</h4>
                        <span class="text-muted">Something else</span>
                    </div>
                </div>

                <h2 class="sub-header">Section title</h2>
                <div class="table-responsive">

                </div>
            </div>
        </div>
    </div>

<?php include("php/parts/footer.php"); ?>

<font size='1'>
    <table class='xdebug-error xe-fatal-error' dir='ltr' border='1' cellspacing='0' cellpadding='1'>
        <tr>
            <th align='left' bgcolor='#f57900' colspan="5"><span
                    style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> Fatal error:
                Call to undefined function is_date() in C:\wamp64\www\poster_service\php\api\poster.php on line
                <i>164</i></th>
        </tr>
        <tr>
            <th align='left' bgcolor='#e9b96e' colspan='5'>Call Stack</th>
        </tr>
        <tr>
            <th align='center' bgcolor='#eeeeec'>#</th>
            <th align='left' bgcolor='#eeeeec'>Time</th>
            <th align='left' bgcolor='#eeeeec'>Memory</th>
            <th align='left' bgcolor='#eeeeec'>Function</th>
            <th align='left' bgcolor='#eeeeec'>Location</th>
        </tr>
        <tr>
            <td bgcolor='#eeeeec' align='center'>1</td>
            <td bgcolor='#eeeeec' align='center'>0.0008</td>
            <td bgcolor='#eeeeec' align='right'>242824</td>
            <td bgcolor='#eeeeec'>{main}( )</td>
            <td title='C:\wamp64\www\poster_service\php\api\rpc_server.php' bgcolor='#eeeeec'>...\rpc_server.php<b>:</b>0
            </td>
        </tr>
        <tr>
            <td bgcolor='#eeeeec' align='center'>2</td>
            <td bgcolor='#eeeeec' align='center'>0.0060</td>
            <td bgcolor='#eeeeec' align='right'>327712</td>
            <td bgcolor='#eeeeec'><a
                    href='http://www.php.net/function.call-user-func-array:{C:\wamp64\www\poster-service\php\api\rpc-server.php:21}'
                    target='_new'>call_user_func_array:{C:\wamp64\www\poster_service\php\api\rpc_server.php:21}</a>
                ( )
            </td>
            <td title='C:\wamp64\www\poster_service\php\api\rpc_server.php' bgcolor='#eeeeec'>...\rpc_server.php<b>:</b>21
            </td>
        </tr>
        <tr>
            <td bgcolor='#eeeeec' align='center'>3</td>
            <td bgcolor='#eeeeec' align='center'>0.0060</td>
            <td bgcolor='#eeeeec' align='right'>328264</td>
            <td bgcolor='#eeeeec'>PosterGetByDate( )</td>
            <td title='C:\wamp64\www\poster_service\php\api\rpc_server.php' bgcolor='#eeeeec'>...\rpc_server.php<b>:</b>21
            </td>
        </tr>
    </table>
</font>
