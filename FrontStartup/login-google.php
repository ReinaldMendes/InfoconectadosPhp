<?php
session_start();

require_once 'vendor/autoload.php'; // Carregar a biblioteca do Google API Client

// Configurações do cliente
$client = new Google_Client();
$client->setClientId('SEU_CLIENT_ID'); // Coloque seu Client ID aqui
$client->setClientSecret('SEU_CLIENT_SECRET'); // Coloque seu Client Secret aqui
$client->setRedirectUri('http://seusite.com/login-google.php'); // Sua URL de redirecionamento
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['logout'])) {
    // Logout do Google
    unset($_SESSION['access_token']);
    header('Location: login-google.php');
    exit();
}

if (isset($_GET['code'])) {
    // Autenticar o usuário
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $token['access_token'];
    $client->setAccessToken($token['access_token']);

    // Obter dados do perfil do usuário
    $oauth = new Google_Service_Oauth2($client);
    $userInfo = $oauth->userinfo->get();

    // Aqui você pode fazer login ou criar um novo usuário no seu sistema
    echo 'Nome: ' . $userInfo->name . '<br>';
    echo 'Email: ' . $userInfo->email . '<br>';
    echo '<a href="?logout">Logout</a>';
} else {
    // Se não houver um token, redirecione para a página de autenticação do Google
    $authUrl = $client->createAuthUrl();
    echo '<a href="' . $authUrl . '">Login com Google</a>';
}
?>
