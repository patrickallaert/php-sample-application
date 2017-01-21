<?php

$tweet = (require "dic/tweets.php")->getById($_GET["id"]);

if ($tweet === null) {
    http_response_code(404);
    return;
}

if ($tweet->userId !== $_GET["user"]) {
    // Redirect to the correct URL, this is the case if the user has been manually modified
    http_response_code(301);
    header("Location: /$tweet->userId/status/$_GET[id]");
    exit;
}

switch (require "dic/negotiated_format.php") {
    case "text/html":
        (new Views\Layout(
            "@$_GET[user] - \"$tweet->message\"",
            new Views\Tweets\Page(
                (require "dic/users.php")->getById($_GET["user"]),
                $tweet
            )
        ))();

        exit;

    case "application/json":
        header("Content-Type: application/json");
        echo json_encode($tweet);
        exit;
}

http_response_code(406);
