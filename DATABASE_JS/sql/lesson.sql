DROP TABLE IF EXISTS clients;

CREATE TABLE clients (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(200) NOT NULL UNIQUE,
    phone VARCHAR(20) NULL,
    address VARCHAR(200) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE clients ADD COLUMN profile_image VARCHAR(255) NULL AFTER address;


INSERT INTO clients (name, email, phone, address, profile_image)
VALUES
('Bill Gates', 'bill.gates@microsoft.com', '+123456789', 'New York, USA', 'path/to/image1.jpg'),
('Elon Musk', 'elon.musk@spacex.com', '+111222333', 'Florida, USA', 'path/to/image2.jpg'),
('Will Smith', 'will.smith@gmail.com', '+111333555', 'California, USA', 'path/to/image3.jpg'),
('Bob Marley', 'bob@gmail.com', '+111555999', 'Texas, USA', 'path/to/image4.jpg'),
('Cristiano Ronaldo', 'cristiano.ronaldo@gmail.com', '+32447788993', 'Manchester, England', 'path/to/image5.jpg'),
('Boris Johnson', 'boris.johnson@gmail.com', '+4499778855', 'London, England', 'path/to/image6.jpg');


