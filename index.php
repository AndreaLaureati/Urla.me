<?php
require_once(__DIR__ . "/includes/functions.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $url = getUrlLocation($id);
    header("Location: https://" . $url);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>Urla.me URL Shortener</title>
</head>

<body>
    <input type="text" name="url">
    <button type="submit">Shorten !</button>
    <p class="errors"></p>

    <script type="text/javascript">
        $(document).ready(function() {
            $('button[type="submit"]').click(function(e) {
                e.preventDefault();
                $('.errors').html('');

                var url = $('input[name="url"]').val();
                if (url.length == 0) {
                    $('.errors').html('Please enter a URL');
                    return false;
                }

                $.ajax({
                    url: 'includes/shorten.php',
                    type: 'POST',
                    data: {
                        url: url
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            $('.errors').html('Your shortened URL is: <a href="' + data.shortened_url + '">' + data.shortened_url + '</a>');
                        } else {
                            $('.errors').html('<a href="' + data + '" target="_blank">' + data + '</a>');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>