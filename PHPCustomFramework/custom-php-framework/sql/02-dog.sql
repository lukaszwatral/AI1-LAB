create table dog
(
    id      integer not null
        constraint dog_pk
            primary key autoincrement,
    name    text not null,
    breed   text not null,
    gender  text not null
);