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
    ('john_doe', 'John', 'Doe', 1234),
    ('jane_smith', 'Jane', 'Smith', 5678),
    ('bob_johnson', 'Bob', 'Johnson', 9876),
    ('amy_wang', 'Amy', 'Wang', 2468),
    ('michael_chen', 'Michael', 'Chen', 1357);