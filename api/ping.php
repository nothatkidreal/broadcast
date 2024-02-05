<?php
    // This isnt really a ping command for testing ping to the webhooks, but who cares lmao
    // (C) NHK Creative
    // Get the user's IP address
    $url = $_SERVER['REMOTE_ADDR'];

    // Get the time before the request
    $start_time = microtime(true);

    // Make the request
    $result = file_get_contents($url);

    // Get the time after the request
    $end_time = microtime(true);

    // Calculate the difference in milliseconds
    $time_taken = ($end_time - $start_time) * 1000;

    echo $time_taken . " ms";
?>
