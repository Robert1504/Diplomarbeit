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
        console.log("Oof");
    }

    websocket_server.onmessage = function(e)
    {
        var json = JSON.parse(e.data);
        switch(json.type) {
            case 'sent_msg':
                //$('#input').append(json.msg);
                $('#output').append(json.msg);
                break;
        }
    }
    //Events
    /*$('#chat_input').on('keyup',function(e){
        if(e.keyCode==13 && !e.shiftKey) {
            //überprüft enter- und shifttaste 
            var chat_msg = $(this).val();
            //speichert nachricht zwischen
            websocket_server.send(			
            //und sendet dann an server
                JSON.stringify({			
                    //JSON-msg wird rüber gesendet
                    'type':'cmd',			
                    //sagt aus um welche nachricht es sich handelt, chat
                    //'user_id': <?php echo $session; ?>,	
                    //id von ganz oben
                    'chat_msg':chat_msg
                    //'chat_msg':'ping'
                    //eigentliche msg wird gesendet aus var chat_msg
                })
            );
            $(this).val('');
        }

    });*/

    $('#c_b1').on('click',function(e){
        var msg = 'ccmpr';
        //speichert nachricht zwischen
        websocket_server.send(			
        //und sendet dann an server
            JSON.stringify({			
                //JSON-msg wird rüber gesendet
                'type':'sent_msg',			
                //sagt aus um welche nachricht es sich handelt, chat
                //'user_id': <?php echo $session; ?>,	
                //id von ganz oben
                'msg':msg
                //'chat_msg':'ping'
                //eigentliche msg wird gesendet aus var chat_msg
            })
        );
        //$(this).val('');
    });

    $('#d_b2').on('click',function(e){
        var msg = 'dcmpr';
        //speichert nachricht zwischen
        websocket_server.send(			
        //und sendet dann an server
            JSON.stringify({			
                //JSON-msg wird rüber gesendet
                'type':'sent_msg',			
                //sagt aus um welche nachricht es sich handelt, chat
                //'user_id': <?php echo $session; ?>,	
                //id von ganz oben
                'msg':msg
                //'chat_msg':'ping'
                //eigentliche msg wird gesendet aus var chat_msg
            })
        );
        //$(this).val('');
    });

    $('#t_b3').on('click',function(e){
        var msg = 't_cmpr';
        //speichert nachricht zwischen
        websocket_server.send(			
        //und sendet dann an server
            JSON.stringify({			
                //JSON-msg wird rüber gesendet
                'type':'sent_msg',			
                //sagt aus um welche nachricht es sich handelt, chat
                //'user_id': <?php echo $session; ?>,	
                //id von ganz oben
                'msg':msg
                //'chat_msg':'ping'
                //eigentliche msg wird gesendet aus var chat_msg
            })
        );
        //$(this).val('');
    });
});