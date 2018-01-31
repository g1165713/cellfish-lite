<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");
require_once("../../src/util.php");

request_method("POST");
request_params(["id"]);
\util\member_only();

$params["username"] = \util\login_as();
$has_liked = sizeof(\sqlite3\query("SELECT * FROM likes
    WHERE post = :id AND username = :username", $params)) > 0;

if ($has_liked) {
    \sqlite3\execute("DELETE FROM likes WHERE post = :id AND username = :username", $params);
} else {
    \sqlite3\execute("INSERT INTO likes VALUES ( :id, :username )", $params);
}

ok_with(!$has_liked);
