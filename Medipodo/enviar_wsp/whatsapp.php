<?php
require_once "vendor/autoload.php";

$client = new Vonage\Client(new Vonage\Client\Credentials\Basic("e8496e87", "0vXNNpYWJtL0f3fi"));  

// $basic  = new \Vonage\Client\Credentials\Basic("e8496e87", "0vXNNpYWJtL0f3fi");
// $client = new \Vonage\Client($basic);
$number = $_GET['number'];
$nombre = $_GET['nombre'];
$number = '56'.$number;

$response = $client->sms()->send(
  new \Vonage\SMS\Message\SMS($number, $nombre, 'hola')
);

$message = $response->current();

if ($message->getStatus() == 0) {
  echo "The message was sent successfully\n";
} else {
  echo "The message failed with status: " . $message->getStatus() . "\n";
}
?>