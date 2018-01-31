<?php namespace image;
require_once(__DIR__ . "/../prelude.php");
require_once("sqlite3.php");

function exist($hash) {
    $sql = "SELECT * FROM images WHERE hash = :hash";
    return sizeof(\sqlite3\query($sql, ["hash" => $hash])) > 0;
}

function put($dataurl) {
    $hash = sha1($dataurl);

    if (!exist($hash)) {
        $sql = "INSERT INTO images VALUES ( :hash, :dataurl )";
        $params["hash"] = $hash;
        \sqlite3\execute($sql, ["hash" => $hash, "dataurl" => $dataurl]);
    }
    return $hash;
}

function try_put($dataurl) {
    if ($dataurl === null) {
        return null;
    } else {
        return put($dataurl);
    }
}
