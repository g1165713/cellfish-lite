<?php
session_start();

$params = [];
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $params = $_GET;
} else {
    $params = json_decode(file_get_contents("php://input"), true);
}

function ok() {
    header("Content-Type: application/json");
    echo json_encode("ok");
    die();
}

function ok_with($data) {
    header("Content-Type: application/json");
    echo json_encode(["ok", $data]);
    die();
}

function error() {
    header("Content-Type: application/json");
    echo json_encode("error");
    die();
}

function error_with($data) {
    header("Content-Type: application/json");
    echo json_encode(["error", $data]);
    die();
}

function request_method($type) {
    if ($_SERVER["REQUEST_METHOD"] !== $type) {
        error_with("invalid_method");
    }
}

function request_params($names) {
    global $params;
    foreach ($names as $i => $name) {
        if (!isset($params[$name])) {
            error_with(["missing_param", $name]);
        }
    }
}
