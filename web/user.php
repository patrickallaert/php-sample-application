<?php

$user = getUsersService()->getById($_GET["id"]);

if ($user === null) {
    http_response_code(404);
    return;
}

$tweetsService = getTweetsService();

$tweets = $tweetsService->getLastByUser($_GET["id"]);
$tweetsCount = $tweetsService->getTweetsCount($_GET["id"]);

switch (getNegotiatedFormat()) {
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
