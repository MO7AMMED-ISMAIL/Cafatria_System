CREATE DATABASE cafeteria;
USE cafeteria;

CREATE TABLE admins
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    profile_picture VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_admins_email (email)
);

CREATE TABLE categories
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL,
    category_description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    price FLOAT NOT NULL,
    picture VARCHAR(255) NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    status ENUM('Available', 'Not Available') DEFAULT 'Available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `rooms`
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    room_number varchar(255) NOT NULL,
    ext text NOT NULL
);

CREATE TABLE users
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    room_id INT UNSIGNED NULL,
    extra_data VARCHAR(255) NULL,
    profile_picture VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE SET NULL ON UPDATE CASCADE,
    INDEX idx_users_email (email)
);

CREATE TABLE orders
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    total_price FLOAT NOT NULL,
    tax FLOAT NOT NULL DEFAULT 0.1,
    status ENUM('Processing', 'Out For Delivery', 'Done', 'Cancelled') DEFAULT 'Processing',
    notes TEXT NULL,
    room_id INT UNSIGNED NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE order_items
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    product_price FLOAT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    total_price FLOAT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE (order_id, product_id)
);

CREATE TABLE `notifications`
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(255) NOT NULL,
    notifiable_id INT UNSIGNED NOT NULL,
    notifiable_type VARCHAR(255) NOT NULL,
    data TEXT NOT NULL,
    read_at TIMESTAMP NULL DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (notifiable_id) REFERENCES orders(id) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX (notifiable_id, notifiable_type)
);

-- Insert data into the 'rooms' table
INSERT INTO rooms (id, room_number, ext)
VALUES
    (1, 'Room One', 'info room1'),
    (2, 'Room Two', 'info room2'),
    (3, 'Room Three', 'info room3'),
    (4, 'Room Four', 'info room4');

-- Insert data into the 'users' table
INSERT INTO users (username, email, password, room_id, extra_data, profile_picture)
VALUES
    ('User one', 'user1@gmail.com', '123456', 1, 'Some extra data', 'user.png'),
    ('User Two', 'user2@gmail.com', '123456', 2, 'Additional info', 'user.png'),
    ('User Three', 'user3@gmail.com', '123456', 1, 'Additional info', 'user.png'),
    ('User Four', 'user4@gmail.com', '123456', 4, 'Additional info', 'user.png'),
    ('User Five', 'user5@gmail.com', '123456', 3, 'Additional info', 'user.png');

-- Insert data into the 'admins' table
INSERT INTO admins (username, email, password, profile_picture)
VALUES
    ('admin1', 'admin1@gmail.com', '123456', 'user.png'),
    ('admin2', 'admin2@gmail.com', '123456', 'user.png');

-- Insert data into the 'categories' table
INSERT INTO categories (category_name, category_description)
VALUES
    ('Drinks', 'Various beverages'),
    ('Snacks', 'Quick bites'),
    ('Desserts', 'Sweet treats');

-- Insert data into the 'products' table
INSERT INTO products (name, description, price, picture, category_id, status)
VALUES
    ('Cola', 'Refreshing soda', 10, 'default.png', 1, 'Available'),
    ('Chips', 'Crunchy potato chips', 20, 'default.png', 2, 'Available'),
    ('Coffee', 'Coffee cup', 20, 'default.png', 1, 'Available'),
    ('Watter', 'Watter Bottle', 10, 'default.png', 2, 'Available'),
    ('Chocolate Cake', 'Rich and moist cake', 30, 'default.png', 3, 'Available');

-- Insert data into the 'orders' table
INSERT INTO orders (user_id, total_price, status, notes, room_id, order_date)
VALUES
    (1, 30, 'Done', 'Special instructions for the order', 1, '2024-03-08 12:00:00'),
    (1, 30, 'Cancelled', 'Special instructions for the order', 2,'2024-03-07 12:00:00'),
    (2, 20, 'Out For Delivery', 'Special instructions for the order', 2, '2024-03-11 12:00:00'),
    (2, 20, 'Processing', 'Special instructions for the order', 2, '2024-03-04 12:00:00'),
    (3, 10, 'Processing', 'Special instructions for the order', 2, '2024-03-12 12:00:00'),
    (3, 10, 'Processing', NULL, 3, '2024-03-10 12:00:00');

-- Insert data into the 'order_items' table
INSERT INTO order_items (order_id, product_id, product_price, quantity, total_price, created_at)
VALUES
    (1, 1, 10, 2, 10, '2024-03-08 12:00:00'),
    (1, 2, 20, 1, 20, '2024-03-08 12:00:00'),
    (2, 5, 30, 1, 30,'2024-03-07 12:00:00'),
    (3, 2, 20, 1, 20, '2024-03-11 12:00:00'),
    (4, 3, 20, 1, 20, '2024-03-04 12:00:00'),
    (5, 4, 10, 1, 20, '2024-03-12 12:00:00'),
    (6, 1, 10, 1, 20, '2024-03-10 12:00:00');

-- Insert data into the 'notifications' table
INSERT INTO notifications (type, notifiable_id, notifiable_type, data, read_at)
VALUES
    ('OrderStatus', 1, 'orders', '{"status": "Done"}', '2024-03-08 12:00:00'),
    ('OrderStatus', 2, 'orders', '{"status": "Processing"}', NULL);