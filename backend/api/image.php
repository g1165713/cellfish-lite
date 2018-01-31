<?php
require_once("../prelude.php");
require_once("../src/sqlite3.php");
require_once("../src/util.php");

request_method("GET");
request_params(["hash"]);

function unpack_dataurl($dataurl) {
    list($type, $rest) = explode(';', $dataurl);
    list(, $b64_data) = explode(',', $rest);
    $data = base64_decode($b64_data);
    $type = substr($type, 5);
    return [$type, $data];
}

$result = sqlite3\query("SELECT dataurl FROM images WHERE hash = :hash", $params);
if (sizeof($result) > 0) {
    list($type, $data) = unpack_dataurl($result[0]["dataurl"]);
    header("Content-Type: $type");
    echo $data;
} else {
    http_response_code(404);
    die();
}
