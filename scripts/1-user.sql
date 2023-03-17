CREATE TABLE user (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    pin INT(4) NOT NULL CHECK (
        pin BETWEEN 0
        AND 9999
    )
);

INSERT INTO
    user (name, pin)
VALUES
    ('Alice', 1234),
    ('Bob', 5678),
    ('Charlie', 2468),
    ('David', 1357),
    ('Eve', 9876);