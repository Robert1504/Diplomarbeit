$(document).ready(function() {
    setInterval(function() {
        $('#connection').load("connection_a_f.php");
    },100);
});

jQuery(function($){
    //Websocket
    var websocket_server = new WebSocket("ws://127.0.0.1:8080/");	//socketserver wird gestartet
                                                                    //unterstützung von meisten browsern
    websocket_server.onopen = function(e) {
        websocket_server.send(
            JSON.stringify({
                'type':'socket',
                //'user_id':<?php echo $session; ?>
            })
        );
    };

    websocket_server.onerror = function(e) {
        console.log("shit hit the fan m8");
    }

    websocket_server.onmessage = function(e)
    {
        var json = JSON.parse(e.data);
        switch(json.type) {
            case 'cmd':
                $('#chat_output').append(json.msg);
                break;
        }
    }
    //Events
    $('#chat_input').on('keyup',function(e){
        if(e.keyCode==13 && !e.shiftKey)	//überprüft enter- und shifttaste 
        {
            var chat_msg = $(this).val();	//speichert nachricht zwischen
            websocket_server.send(			//und sendet dann an server
                JSON.stringify({			//JSON-msg wird rüber gesendet
                    'type':'cmd',			//sagt aus um welche nachricht es sich handelt, chat
                    //'user_id': <?php echo $session; ?>,	//id von ganz oben
                    'chat_msg':chat_msg		//eigentliche msg wird gesendet aus var chat_msg
                })
            );
            $(this).val('');
        }
    });
});