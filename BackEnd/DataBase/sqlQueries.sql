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
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
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
    FOREIGN KEY (room_id) REFERENCES rooms(id),
    INDEX idx_users_email (email)
);

CREATE TABLE orders
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    total_price FLOAT NOT NULL,
    tax FLOAT NOT NULL DEFAULT 0.1,
    total_price_after_tax FLOAT NOT NULL,
    status ENUM('Processing', 'Out For Delivery', 'Done', 'Cancelled') DEFAULT 'Processing',
    notes TEXT NULL,
    room_id INT UNSIGNED NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
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
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id),
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
    FOREIGN KEY (notifiable_id) REFERENCES orders(id),
    INDEX (notifiable_id, notifiable_type)
);

-- Insert data into the 'users' table
INSERT INTO users (username, email, password, extra_data, profile_picture)
VALUES
    ('john_doe', 'user1@gmail.com', '123456', 'Some extra data', 'user.png'),
    ('jane_smith', 'user2@gmail.com', '123456', 'Additional info', 'user.png');

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
    ('Cola', 'Refreshing soda', 2.5, 'default.png', 1, 'Available'),
    ('Chips', 'Crunchy potato chips', 1.5, 'default.png', 2, 'Available'),
    ('Chocolate Cake', 'Rich and moist cake', 5.0, 'default.png', 3, 'Available');

-- Insert data into the 'rooms' table
INSERT INTO rooms (id, room_number, ext)
VALUES
    (1, 'Room One', 'info room1'),
    (2, 'Room Two', 'info room2'),
    (3, 'Room Three', 'info room3'),
    (4, 'Room Four', 'info room4');

-- Insert data into the 'orders' table
INSERT INTO orders (user_id, total_price, total_price_after_tax, status, notes, room_id)
VALUES
    (1, 8.0, 8.8, 'Done', 'Special instructions for the order', 1),
    (2, 8.0, 8.8, 'Cancelled', 'Special instructions for the order', 2),
    (2, 3.5, 3.85, 'Processing', NULL, 3);

-- Insert data into the 'order_items' table
INSERT INTO order_items (order_id, product_id, product_price, quantity, total_price)
VALUES
    (1, 1, 2.5, 2, 5.0),
    (1, 2, 1.5, 1, 1.5),
    (2, 3, 5.0, 1, 5.0);

-- Insert data into the 'notifications' table
INSERT INTO notifications (type, notifiable_id, notifiable_type, data, read_at)
VALUES
    ('OrderStatus', 1, 'orders', '{"status": "Done"}', '2024-03-08 12:00:00'),
    ('OrderStatus', 2, 'orders', '{"status": "Processing"}', NULL);