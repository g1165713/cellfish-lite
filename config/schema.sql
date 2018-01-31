
CREATE TABLE messages (
    id TEXT PRIMARY KEY,
    name TEXT,
    email TEXT,
    subject TEXT,
    message TEXT,
    created_at INTEGER
);

CREATE TABLE users (
    username TEXT PRIMARY KEY,
    password TEXT
);

CREATE TABLE images (
    hash TEXT PRIMARY KEY,
    dataurl TEXT
);

CREATE TABLE posts (
    id TEXT PRIMARY KEY,
    title TEXT,
    content TEXT,
    image TEXT,
    created_at INTEGER,
    updated_at INTEGER
);

CREATE TABLE likes (
    post TEXT,
    username TEXT,
    PRIMARY KEY (post, username)
);

CREATE TABLE comments (
    id TEXT PRIMARY KEY,
    parent TEXT,
    username TEXT,
    content TEXT,
    created_at INTEGER
);

INSERT INTO users VALUES ( 'admin', 'admin' );
