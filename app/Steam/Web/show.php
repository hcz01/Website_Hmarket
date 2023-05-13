<?php
$sessionID = "3851471936708689457d5238";
$steamLoginSecure = "76561199125042505%7C%7CeyAidHlwIjogIkpXVCIsICJhbGciOiAiRWREU0EiIH0.eyAiaXNzIjogInI6MTRCQ18yMjg1Q0JENV84RkI5MCIsICJzdWIiOiAiNzY1NjExOTkxMjUwNDI1MDUiLCAiYXVkIjogWyAid2ViIiBdLCAiZXhwIjogMTY4MzkxNTEzNiwgIm5iZiI6IDE2NzUxODgzNjcsICJpYXQiOiAxNjgzODI4MzY3LCAianRpIjogIjE4QTRfMjI4NUQzNzFfQ0U3M0QiLCAib2F0IjogMTY4MzgyODM2NywgInJ0X2V4cCI6IDE3MDE5MDg3ODUsICJwZXIiOiAwLCAiaXBfc3ViamVjdCI6ICIxNTEuNTUuNzEuNDgiLCAiaXBfY29uZmlybWVyIjogIjE1MS41NS43MS40OCIgfQ.bwlIb6QGnM86fIj_8e_-BSC3jzyp_TG2QytiFlvBhOr7rFApCyclSJoJ516IjA_UVNrO0aFV82aqiN-YjPwxDg";
$steamMachineAuth = "E0A6D24FBF2A882DC2A61C27104D3906135EC082";

$apiUrl = 'https://steamcommunity.com/inventory/76561199125042505/730/2?l=en&count=1000'; // Replace with the actual API endpoint URL

// Create the request headers
$headers = [
    'Content-Type: application/json',
    'Cookie: sessionid=' . $sessionID . '; steamLoginSecure=' . $steamLoginSecure . '; steamMachineAuth=' . $steamMachineAuth,
];

// Set the stream context options
$contextOptions = [
    'http' => [
        'header' => implode("\r\n", $headers),
        'ignore_errors' => true,
    ],
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
];

// Create the stream context
$context = stream_context_create($contextOptions);

// Make the API request and get the response
$response = file_get_contents($apiUrl, false, $context);

if ($response === false) {
    // Request failed
    $error = error_get_last();
    // Handle the error
} else {
    // Request successful
    // Process the response
}

// Print the response
echo $response;
?>
