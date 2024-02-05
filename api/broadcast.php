<?php
// (C) NHK Creative, 2024
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$logFile = 'response_log.txt';
$logHandle = fopen($logFile, 'w') or die("Unable to open file.");
fclose($logHandle);

$authKey = isset($_GET['auth_key']) ? $_GET['auth_key'] : '';

if ($authKey !== 'secret_key') {
    echo "Authentication failed. Access denied.";
    exit;
}

$urls = isset($_GET['urls']) ? explode(',', $_GET['urls']) : ['da_urlz'];
$username = isset($_GET['username']) ? $_GET['username'] : 'default_username';
$avatar_url = isset($_GET['avatar_url']) ? $_GET['avatar_url'] : 'default_avatar_url';
$content = isset($_GET['content']) ? $_GET['content'] : 'default_content';

$logHandle = fopen($logFile, 'a') or die("Unable to open file.");

$multiHandle = curl_multi_init();
$curlHandles = [];

foreach ($urls as $url) {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => trim($url),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => json_encode([
            'username' => $username,
            'avatar_url' => $avatar_url,
            'content' => $content,
        ]),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
        ],
    ]);

    curl_multi_add_handle($multiHandle, $ch);
    $curlHandles[] = $ch;
}

$active = null;
do {
    $mrc = curl_multi_exec($multiHandle, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);

while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($multiHandle) == -1) {
        usleep(100);
    }
    do {
        $mrc = curl_multi_exec($multiHandle, $active);
    } while ($mrc == CURLM_CALL_MULTI_PERFORM);
}

foreach ($curlHandles as $key => $ch) {
    $discordResponse = curl_multi_getcontent($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    $comma = $key === count($urls) - 1 ? '' : ',';

    if ($httpCode === 0) {
        if (strpos($discordResponse, 'discord') !== false || empty($discordResponse)) {
            fwrite($logHandle, "Request was successful. Discord response: $discordResponse$comma\n");
        } else {
            fwrite($logHandle, "Request was successful, but Discord's response did not contain the expected content. Discord response: $discordResponse$comma\n");
        }
    } else {
        fwrite($logHandle, "Request failed. HTTP code: $httpCode. Error: $error. Discord response: $discordResponse$comma\n");
    }

    curl_multi_remove_handle($multiHandle, $ch);
    curl_close($ch);
}

curl_multi_close($multiHandle);
fclose($logHandle);
echo "Responses have been logged to $logFile";
?>
