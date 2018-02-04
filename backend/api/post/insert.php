<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");
require_once("../../src/image.php");
require_once("../../src/util.php");

request_method("POST");
request_params(["title", "content", "tags"]);
\util\admin_only();

$params["id"] = \util\gen_uuidv4();
$params["created_at"] = time();
$params["updated_at"] = time();
$params["image"] = \image\try_put($params["image"]);

$sql = "INSERT INTO posts VALUES ( :id, :title, :content, :image, :created_at, :updated_at, :tags )";
\sqlite3\execute($sql, $params);
ok();
