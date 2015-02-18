USE board;

CREATE TABLE IF NOT EXISTS user(
     id INT NOT NULL AUTO_INCREMENT,
     PRIMARY KEY(id),
     username VARCHAR(20),
     first_name VARCHAR(254),
     last_name VARCHAR(254),
     email VARCHAR(254), 
     password VARCHAR(20),
     confirm_password VARCHAR(20)
    )