CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    pin INT(4) NOT NULL CHECK (
        pin BETWEEN 0
        AND 9999
    )
);

INSERT INTO
    users (username, first_name, last_name, pin)
VALUES
    ('johndoe', 'John', 'Doe', 1234),
    ('janesmith', 'Jane', 'Smith', 5678),
    ('bobjohnson', 'Bob', 'Johnson', 9876),
    ('amywang', 'Amy', 'Wang', 2468),
    ('michaelchen', 'Michael', 'Chen', 1357);