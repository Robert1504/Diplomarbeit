<?php
//Robert Radu
//HTL Hollabrunn, 5BHEL
//server application
set_time_limit(0);

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
require dirname(__DIR__) . '/vendor/autoload.php';

class Chat implements MessageComponentInterface {
	protected $clients;

	public function __construct() {
		$this->clients = new \SplObjectStorage;
	}

	public function onOpen(ConnectionInterface $conn) {
		//Store the new connection to send messages to later
		$this->clients->attach($conn);
		echo "{$conn->resourceId} joined!\n";
	}

	public function onClose(ConnectionInterface $conn) {
		$this->clients->detach($conn);
		echo "{$conn->resourceId} left!\n";
	}

	public function onMessage(ConnectionInterface $from,  $data) {
		$from_id = $from->resourceId;	//ID des Senders, des Clients
		$data = json_decode($data);		//gesendete Daten (Nachricht), hier sind Daten aus chat_msg (client)
		$type = $data->type;			//type ist type aus .onopen vom client
		//Ab hier wird zurückgesendet, um am Client auszugeben
		switch ($type) {
			case 'cmd':
				//$user_id = $data->user_id;
				$chat_msg = trim($data->chat_msg);	//nachricht aus chat_msg (client) wird hier gespeichert
				$ping = "ping";
				//msg from sender, wird ausgegeben
				$response_from = "<span style='color:black'><b>".$chat_msg."</span><br><br>";
				$from->send(json_encode(array("type"=>$type,"msg"=>$response_from)));
				//msg from the other, wird ausgegeben, kann eigentlich an response_from dazu getan werden
				//logik für cmd
				
				//echo "----";
				//echo $chat_msg;
				//echo "----";
				//echo $ping;
				//echo "----";

				if(strcmp($chat_msg, $ping) !== 0)
				{
					echo "not";
				}
				else
				{
					echo "equal";
					//$response_to = "<span style='color:grey'><b>ping funktioniert</b></span><br><br>";
					//$from->send(json_encode(array("type"=>$type,"msg"=>$response_to)));
					$ping_out = shell_exec('ping 127.0.0.1');

					//$ping_out = str_replace('Ü', "Ue", $ping_out);
					//$ping_out = str_replace('Ö', "Oe", $ping_out);
					//$ping_out = str_replace('Ä', "Ae", $ping_out);
					//$ping_out = str_replace('ü', "ue", $ping_out);
					//$ping_out = str_replace('ö', "oa", $ping_out);
					//$ping_out = str_replace('ä', "ae", $ping_out);

					//$ping_out = shell_exec('ssh 127.0.0.1');
					//$ping_out = shell_exec('dir');
					//$ping_out = urlencode($ping_out);
					//$ping_out = substr($ping_out, 0, 20);
					setlocale(LC_ALL, 'de_DE');
					$ping_out = iconv('UTF-8', 'ASCII//IGNORE', $ping_out);
					echo $ping_out;
					$response_to = "<span style='color:grey'><b><pre>$ping_out</pre></b></span><br><br>";
					//$response_to = $ping_out;
					//$from->send(json_encode(array("type"=>$type,"msg"=>$ping_out)));
					$from->send(json_encode(array("type"=>$type,"msg"=>$response_to)));
				}

				//$response_to = "<span style='color:grey'><b>".$chat_msg."</span><br><br>";
				//Output, from hat Objekt des senders
				//$from->send(json_encode(array("type"=>$type,"msg"=>$response_to)));
				//$client->send(json_encode(array("type"=>$type,"msg"=>$response_to)));
				
				/*	für chat wichtig, sendet an alle clients
				foreach($this->clients as $client)	//geht durch alle clients durch
				{
					if($from!=$client)	//prüft ob sender =/= client
					{
						$client->send(json_encode(array("type"=>$type,"msg"=>$response_to)));
					}
				}
				*/
				break;
		}
	}

	public function onError(ConnectionInterface $conn, \Exception $e) {
		echo "An error has occurred: {$e->getMessage()}\n";
		$conn->close();
	}
}
$server = IoServer::factory(
	new HttpServer(
		new WsServer(
			new Chat()
		)
	),
	8080
);
$server->run();

?>