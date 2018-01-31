<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");
require_once("../../src/util.php");

request_method("GET");
request_params([]);
\util\admin_only();

ok_with(sqlite3\query("SELECT * FROM messages ORDER BY created_at DESC"));
