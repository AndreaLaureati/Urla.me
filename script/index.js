$(document).ready(function () {
    $('button[type="submit"]').click(function (e) {
        e.preventDefault();
        $('.errors').html('');

        var url = $('input[name="url"]').val();
        if (invalidUrl(url) && invalidIpAddress(url)) {
            $('.errors').html('Please enter a valid URL');
            return;
        }

        $.ajax({
            url: 'includes/shorten.php',
            type: 'POST',
            data: {
                url: url
            },
            success: function (data) {
                if (data.status == 'success') {
                    $('.errors').html('Your shortened URL is: <a href="' + data.shortened_url + '">' + data.shortened_url + '</a>');
                } else {
                    $('.errors').html('<a href="' + data + '" target="_blank">' + data + '</a>');
                }
            }
        });
    });
});

function invalidUrl(url) {
    var urlRegex = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
    return !urlRegex.test(url);
}

function invalidIpAddress(url) {
    var ipRegex = /^(https?:\/\/)?((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
    return !ipRegex.test(url);
}