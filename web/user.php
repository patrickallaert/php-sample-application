<?php

$user = (require __DIR__ . "/../dic/users.php")->getById($_GET["id"]);

if ($user === null) {
    http_response_code(404);
    return;
}

$tweetsService = (require __DIR__ . "/../dic/tweets.php");

$tweets = $tweetsService->getLastByUser($_GET["id"]);
$tweetsCount = $tweetsService->getTweetsCount($_GET["id"]);

switch (require __DIR__ . "/../dic/negotiated_format.php") {
    case "text/html":
        (new Views\Layout(
            "Tweets from @$_GET[id]",
            new Views\Tweets\Listing($user, $tweets, $tweetsCount)
        ))();
        exit;

    case "application/json":
        header("Content-Type: application/json");
        echo json_encode(["count" => $tweetsCount, "last20" => $tweets]);
        exit;
}

http_response_code(406);
