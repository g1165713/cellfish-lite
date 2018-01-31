<?php
require_once("../../prelude.php");
require_once("../../src/util.php");

request_method("GET");
request_params([]);

ok_with(\util\login_as());
