$(document).ready(function () {
    $('button[type="submit"]').click(function (e) {
        e.preventDefault();
        $('.errors').html('');
        $('.result').html('');
        $('.stats').html('');

        var url = $('input[name="url"]').val();
        // if (invalidUrl(url) && invalidIpAddress(url)) {
        //     $('.errors').html('Please enter a valid URL');
        //     return;
        // }

        $.ajax({
            url: 'php/shorten.php',
            type: 'POST',
            data: {
                url: url
            },
            success: function (data) {
                var response = JSON.parse(data);
                if (response.status == 'success') {
                    $('.result').html('Your shortened URL is: <a target="_blank" href="' + response.shortened_url + '" class="shortened-url-link">' + response.shortened_url + '</a>');
                    $('.stats').html('This URL has been shortened ' + response.times_shortened + ' times using Urla.me');
                } else {
                    $('.errors').html('Qualcosa è andato storto. Riprova più tardi. Errore: ' + response.message);
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
