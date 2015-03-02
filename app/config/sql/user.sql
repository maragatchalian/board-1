USE board;

CREATE TABLE IF NOT EXISTS user(
     id INT NOT NULL AUTO_INCREMENT,
     PRIMARY KEY(id),
     username VARCHAR(255),
     first_name VARCHAR(255),
     last_name VARCHAR(255),
     email VARCHAR(255), 
     password VARCHAR(255)
    )