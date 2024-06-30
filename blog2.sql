CREATE SCHEMA IF NOT EXISTS blog;
USE blog;

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(15) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    image VARCHAR(255),
    user_id INT,
    CONSTRAINT fk_user_id_users
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    post_id INT,
    user_id INT,
    CONSTRAINT fk_post_id_posts
        FOREIGN KEY (post_id)
        REFERENCES posts(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT fk_user_id_comments_users
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

use blog;

alter table users
add column role enum ('subscriber','admin') default 'subscriber' after phone;

alter table users
drop column role;

alter table users
add column password varchar(255) not null after email;

alter table users
drop column password;

alter table posts
add column created_at timestamp default current_timestamp;

alter table posts
add column updated_at timestamp default current_timestamp;


alter table users
add column password varchar(255);

INSERT INTO USERS (name,email,password,phone) value('taha','taha@gmail.com','123456','01270268734')


