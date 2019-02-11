create table users (
    userId integer primary key,
    email varchar not null unique,
    password varchar not null,
    isActive tinyint default 0,
    createdAt datetime not null,
    lastActive datetime
) without rowid;

create table posts (
    postId integer primary key,
    userId integer not null,
    title varchar not null,
    content text,
    createdAt datetime not null,
    foreign key (userId) references users(userId)
) without rowid;

create table comments (
    commentId integer primary key,
    postId integer not null,
    userId integer not null,
    content text not null,
    createdAt datetime not null,
    foreign key (postId) references posts(postId),
    foreign key (userId) references users(userId)
) without rowid;
