let chat = new WebSocket('ws://yii2-course-project:8088');
let username = $('.js-username').val();
let SHOW_HISTORY = 1;
let SEND_MESSAGE = 2;

chat.onmessage = function (e) {
    $('#response').text('');
    console.log(e);
    let response = JSON.parse(e.data);
    $('#chat').append('<div><b>' + response.username + '</b>: ' + response.message + '</div>');
    $('#chat').scrollTop = $('#chat').height;
};

chat.onopen = function (e) {
    console.log("Connection established!");
    console.log(e);
    chat.send(JSON.stringify({
            'username': username,
            'type': SHOW_HISTORY,
        })
    );
};


$('#send').click(function () {
    chat.send(JSON.stringify({
            'username': username,
            'message': $('#message').val(),
            'type': SEND_MESSAGE
        })
    );
    $('#message').val('');
});