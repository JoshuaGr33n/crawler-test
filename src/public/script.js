
$(document).ready(function() {
    $(".button").on("click", function() {
        sendAjaxRequest();
    });

function sendAjaxRequest() {
    $.ajax({
        url: '/scrape',
        type: 'GET',
        success: function(data) {
            $('#wrapper').html(data);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
setInterval(sendAjaxRequest, 3600000);
});
