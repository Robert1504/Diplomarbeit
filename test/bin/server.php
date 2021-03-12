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
		$from_id = $from->resourceId;	
		//ID des Senders, des Clients
		$data = json_decode($data);		
		//gesendete Daten (Nachricht), hier sind Daten aus chat_msg (client)
		$type = $data->type;
		//type ist type aus .onopen vom client
		//Ab hier wird zurückgesendet, um am Client auszugeben
		switch ($type) {
			case 'sent_msg':
				//$user_id = $data->user_id;
				$msg = trim($data->msg);	
				//nachricht aus chat_msg (client) wird hier gespeichert
				$connectcmpr = "ccmpr";
				$disconnectcmpr = "dcmpr";
				$test_conncmpr = "t_cmpr";
				//msg from sender, wird ausgegeben
				$response_from = "<span style='color: #9E9E9E; font-weight: 500; font-style: italic;'>$msg</span><br>";
				$from->send(json_encode(array("type"=>$type,"msg"=>$response_from)));
				//msg from the other, wird ausgegeben, kann eigentlich an response_from dazu getan werden

				if(strcmp($msg, $connectcmpr) == 0) {
					$old_path = getcwd();
					chdir('C:\Diplomarbeit\test');
					$output = shell_exec('wsl ./test_connect.sh');
					$connectcmpr_out = shell_exec('wsl ./test_connect.sh');
					chdir($old_path);
					echo "<pre>$output</pre>";
					setlocale(LC_ALL, 'de_DE');
					$connectcmpr_out = iconv('UTF-8', 'ASCII//IGNORE', $connectcmpr_out);
					echo $connectcmpr_out;
					$response_to = "<span style='color: #FFFFFF; font-weight: 200; font-style: italic;'><pre>$connectcmpr_out</pre></span><br>";
					$from->send(json_encode(array("type"=>$type,"msg"=>$response_to)));
				}
				elseif(strcmp($msg, $disconnectcmpr) == 0) {
					$old_path = getcwd();
					chdir('C:\Diplomarbeit\test');
					$output = shell_exec('wsl ./test_disconnect.sh');
					$disconnectcmpr_out = shell_exec('wsl ./test_disconnect.sh');
					chdir($old_path);
					echo "<pre>$output</pre>";
					setlocale(LC_ALL, 'de_DE');
					$disconnectcmpr_out = iconv('UTF-8', 'ASCII//IGNORE', $disconnectcmpr_out);
					echo $disconnectcmpr_out;
					$response_to = "<span style='color: #FFFFFF; font-weight: 200; font-style: italic;'><pre>$disconnectcmpr_out</pre></span><br>";
					$from->send(json_encode(array("type"=>$type,"msg"=>$response_to)));
				}
				elseif(strcmp($msg, $test_conncmpr) == 0) {
					$old_path = getcwd();
					chdir('C:\Diplomarbeit\test');
					$output = shell_exec('wsl ./test_t_connection.sh');
					$test_conncmpr_out = shell_exec('wsl ./test_t_connection.sh');
					chdir($old_path);
					echo "<pre>$output</pre>";
					setlocale(LC_ALL, 'de_DE');
					$test_conncmpr_out = iconv('UTF-8', 'ASCII//IGNORE', $test_conncmpr_out);
					echo $test_conncmpr_out;
					$response_to = "<span style='color: #FFFFFF; font-weight: 200; font-style: italic;'><pre>$test_conncmpr_out</pre></span><br>";
					$from->send(json_encode(array("type"=>$type,"msg"=>$response_to)));
				}		
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