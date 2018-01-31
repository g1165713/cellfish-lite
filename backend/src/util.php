<?php namespace util;
require_once(__DIR__ . "/../prelude.php");

function login_as() {
    if (isset($_SESSION["identity"])) {
        return $_SESSION["identity"];
    } else {
        return "guest";
    }
}

function member_only() {
    if (login_as() === "guest") {
        error_with("not_member");
    }
}

function admin_only() {
    if (login_as() !== "admin") {
        error_with("not_admin");
    }
}

function gen_uuidv4() {
    // copied from https://stackoverflow.com/a/15875555
    $data = openssl_random_pseudo_bytes(16);
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
