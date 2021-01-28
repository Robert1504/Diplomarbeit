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
		$data = json_decode($data);
		$type = $data->type;
		switch ($type) {
			case 'chat':
				$user_id = $data->user_id;
				$chat_msg = $data->chat_msg;
				//msg from sender
				$response_from = "<span style='color:#999'><b>".$user_id.":</b> ".$chat_msg."</span><br><br>";
				//msg from the other
				$response_to = "<b>".$user_id."</b>: ".$chat_msg."<br><br>";
				//Output
				$from->send(json_encode(array("type"=>$type,"msg"=>$response_from)));
				foreach($this->clients as $client)
				{
					if($from!=$client)
					{
						$client->send(json_encode(array("type"=>$type,"msg"=>$response_to)));
					}
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