-- users

create table users (
    id integer primary key autoincrement,
    email varchar not null unique,
    password varchar not null,
    isActive tinyint default 0,
    createdAt datetime not null,
    lastActive datetime
);

-- followers

create table followers (
    id integer primary key autoincrement,
    subjectId integer,
    userId integer,
    foreign key (userId) references users(id),
    foreign key (subjectId) references users(id)
);

-- posts

create table posts (
    id integer primary key autoincrement,
    userId integer not null,
    content text,
    createdAt datetime not null,
    foreign key (userId) references users(id)
);

-- comments

create table comments (
    id integer primary key autoincrement,
    postId integer not null,
    userId integer not null,
    content text not null,
    createdAt datetime not null,
    foreign key (postId) references posts(id),
    foreign key (userId) references users(id)
);
