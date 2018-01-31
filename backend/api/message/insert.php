<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");
require_once("../../src/util.php");

request_method("POST");
request_params(["name", "email", "subject", "message"]);

$sql = "INSERT INTO messages VALUES (:id, :name, :email, :subject, :message, :created_at)";
$params["id"] = \util\gen_uuidv4();
$params["created_at"] = time();
\sqlite3\execute($sql, $params);
ok();
