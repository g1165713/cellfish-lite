<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");
require_once("../../src/util.php");

request_method("GET");
request_params(["id"]);

ok_with(\sqlite3\query("SELECT * FROM comments WHERE parent = :id", $params));
