<?php

return new PDO("mysql:host=mysql-clouxter;dbname=sample", "sampleuser", "samplepass", [PDO::ATTR_PERSISTENT => true]);
