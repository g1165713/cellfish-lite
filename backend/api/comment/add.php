<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");
require_once("../../src/util.php");

request_method("POST");
request_params(["parent", "content"]);

function parent_exist($parent) {
    return sizeof(\sqlite3\query("SELECT id FROM posts WHERE id = :parent
        UNION SELECT id FROM comments WHERE id = :parent", ["parent" => $parent])) > 0;
}

if (parent_exist($params["parent"])) {
    $params["username"] = \util\login_as();
    $params["id"] = \util\gen_uuidv4();
    $params["created_at"] = time();

    \sqlite3\execute("INSERT INTO comments VALUES
        ( :id, :parent, :username, :content, :created_at )", $params);
    ok();
} else {
    error_with("no_parent");
}
