<?php

$envFile = __DIR__ . '/.env';
$result = is_file($envFile) ? (parse_ini_file($envFile, false, INI_SCANNER_RAW) ?: []) : [];

$dadosEmail = [
    'host' => $result['EMAIL_HOST'] ?? '',
    'username' => $result['EMAIL_USERNAME'] ?? '',
    'password' => $result['EMAIL_PASSWORD'] ?? '',
    'email' => $result['EMAIL_USERNAME'] ?? '',
];
