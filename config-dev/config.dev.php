<?php

function getDatabase()
{
    return new PDO("mysql:host=localhost;dbname=sample", "sampleuser", "samplepass", [PDO::ATTR_PERSISTENT => true]);
}
