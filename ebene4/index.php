<?php
$session = mt_rand(1,999);  //user_id
?>
<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<h3>Configuration for your Emergency-Wristband:</h3>
	<h4>Sim Card Details:</h4>
	<style type="text/css">
		* {margin:0;padding:0;box-sizing:border-box;font-family:arial,sans-serif;resize:none;}
		html,body {width:100%;height:100%;}
		#wrapper {position:relative;margin:auto;max-width:1000px;height:100%;}
		#chat_output {position:absolute;top:0;left:0;padding:20px;width:100%;height:calc(100% - 100px);}
		#chat_input {position:absolute;bottom:0;left:0;padding:10px;width:100%;height:100px;border:1px solid #ccc;}
	</style>
</head>
<body>
	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(function() {
				$('#connection').load("connection_a_f.php");
			},100);
		});
	</script>
	<div id="wrapper">	<!-- begrenzt das feld mit css -->
	<div id="connection"></div></br>	<!-- schaut ob eine Verbindung zum Internet möglich ist -->
	<div id="chat_output"></div>	<!-- cmd wird ausgegeben -->
		<textarea id="chat_input" placeholder="Write your cmd here!"></textarea>
		<script type="text/javascript">
			jQuery(function($){
				//Websocket
				var websocket_server = new WebSocket("ws://127.0.0.1:8080/");	//socketserver wird gestartet
																				//unterstützung von meisten browsern
				websocket_server.onopen = function(e) {
					websocket_server.send(
						JSON.stringify({
							'type':'socket',
							'user_id':<?php echo $session; ?>
						})
					);
				};

				websocket_server.onerror = function(e) {
					//Errorhandling
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
								'user_id': <?php echo $session; ?>,	//id von ganz oben
								'chat_msg':chat_msg		//eigentliche msg wird gesendet aus var chat_msg
							})
						);
						$(this).val('');
					}
				});
			});
		</script>
	</div>
</body>
</html>