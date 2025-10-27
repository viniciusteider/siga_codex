<?
class WebSocketHandler
{

	function maskData($data)
	{
		$length = strlen($data);
		$maskedData = '';
		$mask = pack('N', rand(0, 0xFFFFFFFF)); // Gera uma máscara de 4 bytes aleatórios

		// Envia a máscara junto com o payload
		for ($i = 0; $i < $length; $i++) {
			$maskedData .= $data[$i] ^ $mask[$i % 4]; // Aplica a máscara (XOR byte a byte)
		}

		return [$mask, $maskedData];
	}

	function buildFrame($message)
	{
		$b1 = 0x81; // Frame de texto, FIN flag setada
		$length = strlen($message);
		$header = '';

		if ($length <= 125) {
			$b2 = 0x80 | $length; // Máscara flag setada, payload curto
			$header = pack('CC', $b1, $b2);
		} elseif ($length <= 65535) {
			$b2 = 0x80 | 126; // Máscara flag setada, payload com 16 bits para o comprimento
			$header = pack('CCn', $b1, $b2, $length);
		} else {
			$b2 = 0x80 | 127; // Máscara flag setada, payload com 64 bits para o comprimento
			$header = pack('CCNN', $b1, $b2, 0, $length);
		}

		// Máscara e payload
		list($mask, $maskedMessage) = $this->maskData($message);

		// Monta o frame completo (header + máscara + mensagem mascarada)
		return $header . $mask . $maskedMessage;
	}

	public function enviarMensagem($type, $groupId, $userId, $data)
	{
		// Verificar se a extensão socket está habilitada
		if (!extension_loaded('sockets')) {
			error_log("A extensão 'sockets' não está habilitada. Por favor, habilite-a no php.ini.");
			return;
		}

		// Configuração do socket
		$host = 'localhost';
		$port = 8181;
		$path = "/?groupId=$groupId";

		// Criando um socket TCP/IP
		$socket = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if ($socket === false) {
			error_log("Falha ao criar o socket: " . socket_strerror(socket_last_error()));
			return;
		}

		// Conectando ao servidor WebSocket
		$result = @socket_connect($socket, $host, $port);
		if ($result === false) {
			error_log("Falha ao conectar ao servidor: " . socket_strerror(socket_last_error($socket)));
			return;
		}

		// Realizando o handshake WebSocket
		$key = base64_encode(openssl_random_pseudo_bytes(16));
		$headers = "GET $path HTTP/1.1\r\n";
		$headers .= "Host: $host:$port\r\n";
		$headers .= "Upgrade: websocket\r\n";
		$headers .= "Connection: Upgrade\r\n";
		$headers .= "Sec-WebSocket-Key: $key\r\n";
		$headers .= "Sec-WebSocket-Version: 13\r\n\r\n";

		socket_write($socket, $headers, strlen($headers));

		// Lendo a resposta do handshake (não utilizada neste exemplo)
		$response = socket_read($socket, 1024);

		// Preparando a mensagem JSON
		$message = json_encode([
			"type" => $type,
			"userId" => $userId,
			"data" => $data
		]);

		// Construindo o frame correto para envio da mensagem WebSocket
		$frame = $this->buildFrame($message);

		// Enviando a mensagem através do socket
		$bytesSent = socket_write($socket, $frame, strlen($frame));

		// Verificando se a mensagem foi enviada completamente
		if ($bytesSent === false || $bytesSent !== strlen($frame)) {
			error_log("Falha ao enviar a mensagem WebSocket: " . socket_strerror(socket_last_error($socket)));
		} else {
			error_log("Mensagem WebSocket enviada com sucesso: $message");
		}

		// Fechando o socket
		socket_close($socket);
	}
}