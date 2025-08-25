<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/routes/api.php';

$db = new Database(__DIR__ . './../config/rev.db');
