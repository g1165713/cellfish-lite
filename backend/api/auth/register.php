<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");

request_method("POST");
request_params(["username", "password"]);

function user_exist($username) {
    $sql = "SELECT * FROM users WHERE username = :username";
    $res = \sqlite3\query($sql, ["username" => $username]);
    return sizeof($res) > 0;
}

if (user_exist($params["username"])) {
    error_with("user_exist");
} else {
    \sqlite3\execute("INSERT INTO users VALUES ( :username, :password )", $params);
    ok();
}
