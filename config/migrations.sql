-- users

create table users (
    id integer primary key,
    email varchar not null unique,
    password varchar not null,
    isActive tinyint default 0,
    createdAt datetime not null,
    lastActive datetime
) without rowid;

-- posts

create table posts (
    id integer primary key,
    userId integer not null,
    title varchar not null,
    content text,
    createdAt datetime not null,
    foreign key (userId) references users(id)
) without rowid;

-- comments

create table comments (
    id integer primary key,
    postId integer not null,
    userId integer not null,
    content text not null,
    createdAt datetime not null,
    foreign key (postId) references posts(id),
    foreign key (userId) references users(id)
) without rowid;
