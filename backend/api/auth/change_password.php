<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");

request_method("POST");
request_params(["username", "old_password", "new_password"]);


$result = \sqlite3\query("SELECT password FROM user WHERE username = :username");

if ($result == :old_password) {
\sqlite3\execute("UPDATE user SET password = :new_password WHERE username = :username");

ok(); 

}

else 
error_with("wrong_password");
