<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");

request_method("POST");
request_params(["email","username"]);


\sqlite3\execute("UPDATE user SET email = :email WHERE username = :username",$params);
ok();
