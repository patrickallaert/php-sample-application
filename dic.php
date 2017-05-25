<?php

/**
 * Returns the best negotiated format according to RFC 7231.
 */
function getNegotiatedFormat()
{
    return (new \Negotiation\Negotiator())
        ->getBest($_SERVER["HTTP_ACCEPT"], ['text/html', 'application/json'])
        ->getValue();
}

function getTweetsService()
{
    return new Service\TweetsService(
        getDatabase()
    );
}

function getUsersService()
{
    return new Service\UsersService(
        getDatabase()
    );
}
