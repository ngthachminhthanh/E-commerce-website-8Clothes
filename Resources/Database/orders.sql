-- CREATE TABLE orders (
--   id INT PRIMARY KEY AUTO_INCREMENT,
--   user_id INT,
--   order_number INT,
--   total_amount DECIMAL(10, 2),
--   order_date DATETIME,
--   FOREIGN KEY (user_id) REFERENCES users(id)
-- );
CREATE TABLE orders (
  id INT PRIMARY KEY AUTO_INCREMENT,
  order_number INT,
  user_id INT,
  total_amount DECIMAL(10, 2),
  order_date DATE,
  payment_status VARCHAR(20),
  shipping_status VARCHAR(20),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_items (
  id INT PRIMARY KEY AUTO_INCREMENT,
  order_id INT,
  product_id INT,
  quantity INT,
  price DECIMAL(10, 2),
  FOREIGN KEY (order_id) REFERENCES orders(id),
  FOREIGN KEY (product_id) REFERENCES product(id)
);

CREATE TABLE order_details (
  id INT PRIMARY KEY AUTO_INCREMENT,
  order_id INT,
  name VARCHAR(255),
  address VARCHAR(255),
  phone VARCHAR(20),
  order_notes TEXT,
  FOREIGN KEY (order_id) REFERENCES orders(id)
);