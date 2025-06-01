<?php

$host = 'mail.pharmainvest.dz';
$port = 465;

$streamContext = stream_context_create([
    'ssl' => [
        'allow_self_signed' => true,
        'verify_peer' => false,
        'verify_peer_name' => false,
    ]
]);

$connection = @stream_socket_client(
    "ssl://$host:$port",
    $errno,
    $errstr,
    30,
    STREAM_CLIENT_CONNECT,
    $streamContext
);

if (!$connection) {
    echo "Connection failed: $errstr ($errno)\n";
} else {
    echo "Connection successful!\n";
    fclose($connection);
}
