<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");
require_once("../../src/util.php");

request_method("POST");
request_params(["id"]);
\util\admin_only();

\sqlite3\execute("DELETE FROM posts WHERE id = :id", $params);
ok();
