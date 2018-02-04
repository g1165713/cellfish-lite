<?php
require_once("../../prelude.php");
require_once("../../src/sqlite3.php");
require_once("../../src/image.php");
require_once("../../src/util.php");

request_method("POST");
request_params(["id", "title", "content", "tags"]);
\util\admin_only();

$params["updated_at"] = time();
$params["image"] = \image\try_put($params["image"]);

$sql = "UPDATE posts
        SET title = :title, content = :content, image = :image, updated_at = :updated_at, tags = :tags
        WHERE id = :id";
\sqlite3\execute($sql, $params);
ok();
