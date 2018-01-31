<?php
require_once("../../prelude.php");

request_method("POST");
request_params([]);

unset($_SESSION["identity"]);
ok();
