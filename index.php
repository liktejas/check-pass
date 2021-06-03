<?php
    include 'connection.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="assets/dist/img/id-card128.png" type="image/x-icon">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <title>Check Pass</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mt-3"><img src="assets/dist/img/id-card128.png" alt="check_pass" width="75"> CHECK PASS</h1>
                </div>
            </div>
        </div>
        <hr>
        <center>
        <canvas></canvas>
        </center>
        
        <hr>
        <h4 class="text-center text-danger">Please Scan QR present on Check Pass to Continue...</h4>
        <ul></ul>
		<script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/qrcodelib.js"></script>
        <script type="text/javascript" src="js/webcodecamjquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var arg = {
                    resultFunction: function(result) {
                        // $('body').append($('<li>' + result.format + ': ' + result.code + '</li>'));
                        var result_qr_code = result.code
                        $.post('datatodb.php', {code: result_qr_code}, function(data, status) {
                            alert(data);
                        });
                    }
                };
                $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery.play();
            });
            
        </script>
    </body>
</html>