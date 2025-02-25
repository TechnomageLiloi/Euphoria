create table euphoria_failures
(
    key_failure bigint unsigned auto_increment,
    title varchar(100) not null,
    dt timestamp not null,
    summary text not null,
    data json not null,
    price smallint unsigned default 0 not null,
    constraint euphoria_failures_pk
        primary key (key_failure)
);

