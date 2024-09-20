<?php
require_once __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateToken($user_id)
{
    $key = 'secret_key';
    $payload = array(
        'iss' => 'localhost',
        'sub' => $user_id,
        'iat' => time(),
        'exp' => time() + (60 * 60 * 24) // 1 día
    );

    return JWT::encode($payload, $key, 'HS256');
}

function verifyToken($token)
{
    $key = 'secret_key';
    try {
        $decoded = JWT::decode($token, new Key($key, 'HS256'));
        return array('success' => true, 'user_id' => $decoded->sub);
    } catch (Exception $e) {
        return array('success' => false, 'error' => $e->getMessage());
    }
}

