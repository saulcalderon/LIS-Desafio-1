CREATE TABLE transactions (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    transaction_type ENUM('entrada', 'salida') NOT NULL,
    type VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    transaction_date DATE NOT NULL,
    receipt_photo_path VARCHAR(255)
);

ALTER TABLE
    transactions
ADD
    FOREIGN KEY (user_id) REFERENCES users(id);

INSERT INTO transaction (user_id, transaction_type, type, amount, transaction_date, receipt_photo_path)
VALUES
(1, 'entrada', 'Ingreso mensual', 2500.00, '2022-03-01', '/path/to/receipt1.jpg'),
(1, 'salida', 'Alquiler', -800.00, '2022-03-05', '/path/to/receipt2.jpg'),
(2, 'entrada', 'Venta de producto', 125.00, '2022-03-10', '/path/to/receipt3.jpg'),
(3, 'salida', 'Factura de electricidad', -75.00, '2022-03-15', '/path/to/receipt4.jpg'),
(2, 'salida', 'Compra de materiales', -35.00, '2022-03-20', '/path/to/receipt5.jpg');