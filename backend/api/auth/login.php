<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");

request_method("POST");
request_params(["username", "password"]);

$result = \sqlite3\query("SELECT * FROM users
                          WHERE username = :username AND
                                password = :password", $params);
if (sizeof($result) > 0) {
    $_SESSION["identity"] = $params["username"];
    ok();
} else {
    error();
}
