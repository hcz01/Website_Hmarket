<?php
namespace App\Steam\web;

class SteamLogin
{
    private $steamLoginUrl = 'https://steamcommunity.com/openid/login';
    private $steamApiKey = 'YOUR_STEAM_API_KEY';

    public function redirectToSteamLogin()
    {
        $params = array(
            'openid.ns'         => 'http://specs.openid.net/auth/2.0',
            'openid.mode'       => 'checkid_setup',
            'openid.return_to'  => $this->getReturnUrl(),
            'openid.realm'      => $this->getRealm(),
            'openid.identity'   => 'http://specs.openid.net/auth/2.0/identifier_select',
            'openid.claimed_id' => 'http://specs.openid.net/auth/2.0/identifier_select',
        );

        $loginUrl = $this->steamLoginUrl . '?' . http_build_query($params);
        header('Location: ' . $loginUrl);
        exit();
    }

    public function getSteamId()
    {
        if (isset($_GET['openid_identity'])) {
            $steamId = str_replace('https://steamcommunity.com/openid/id/', '', $_GET['openid_identity']);
            return $steamId;
        }

        return null;
    }

    public function getAuthCookie()
    {
        $steamId = $this->getSteamId();

        if ($steamId) {
            $cookieName = 'steamMachineAuth' . $steamId;
            if (isset($_COOKIE[$cookieName])) {
                return $_COOKIE[$cookieName];
            }
        }

        return null;
    }

    private function getReturnUrl()
    {
        // Set the return URL of your application where the user will be redirected after login
        return './show.php';
    }

    private function getRealm()
    {
        // Set the realm of your application
        return 'https://your-website.com/';
    }
}

// Usage example
$steamLogin = new SteamLogin();


if ($steamLogin->getSteamId()) {
    // User is logged in, get the authentication cookie
    $authCookie = $steamLogin->getAuthCookie();

    // Use the authentication cookie in your API requests
    if ($authCookie) {
        // Perform your API requests here using the $authCookie
        echo "Authentication Cookie: " . $authCookie;
    } else {
        echo "Failed to retrieve authentication cookie.";
    }
} else {
    // User is not logged in, redirect to Steam login
    $steamLogin->redirectToSteamLogin();
}
?>