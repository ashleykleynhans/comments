CREATE DATABASE IF NOT EXISTS comments; 
GRANT UPDATE,DELETE,SELECT,INSERT,CREATE ON comments.* TO comments@'localhost' IDENTIFIED BY '(0mM3Nt$EnG!n3';

USE comments;

CREATE TABLE IF NOT EXISTS categories(
  category_id int(10) unsigned NOT NULL auto_increment,
  category_name varchar(100) NOT NULL,
  category_prefix char(2) NOT NULL,
  created datetime NOT NULL,
  updated timestamp NOT NULL,
  PRIMARY KEY(category_id),
  KEY (created),
  KEY (updated)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO categories (`category_id`, `category_name`, `category_prefix`, `created`) VALUES(1, 'Abercrombie Fitch', 'AE', NOW());
INSERT INTO categories (`category_id`, `category_name`, `category_prefix`, `created`) VALUES(2, 'Hollister', 'HO', NOW());
INSERT INTO categories (`category_id`, `category_name`, `category_prefix`, `created`) VALUES(3, 'Ralph Lauren', 'RA', NOW());

CREATE TABLE IF NOT EXISTS products(
  product_id int(10) unsigned NOT NULL auto_increment,
  category_id int(10) unsigned NOT NULL,
  product_code char(5) NOT NULL,
  product_price decimal(3,2) NOT NULL,
  product_stock tinyint(3) unsigned NOT NULL,
  created datetime NOT NULL,
  updated timestamp NOT NULL,
  PRIMARY KEY(product_id),
  KEY(category_id),
  UNIQUE KEY(product_code),
  KEY (product_price),
  KEY (product_stock),
  KEY (created),
  KEY (updated)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO products (`product_id`, `category_id`, `product_code`, `product_price`, `product_stock`, `created`) VALUES(1, 1, 'AE001', 65.00, 10, NOW());
INSERT INTO products (`product_id`, `category_id`, `product_code`, `product_price`, `product_stock`, `created`) VALUES(2, 1, 'AE002', 65.00, 10, NOW());
INSERT INTO products (`product_id`, `category_id`, `product_code`, `product_price`, `product_stock`, `created`) VALUES(3, 2, 'HO001', 65.00, 10, NOW());
INSERT INTO products (`product_id`, `category_id`, `product_code`, `product_price`, `product_stock`, `created`) VALUES(4, 2, 'HO002', 65.00, 10, NOW());
INSERT INTO products (`product_id`, `category_id`, `product_code`, `product_price`, `product_stock`, `created`) VALUES(5, 3, 'RA001', 65.00, 10, NOW());
INSERT INTO products (`product_id`, `category_id`, `product_code`, `product_price`, `product_stock`, `created`) VALUES(6, 3, 'RA002', 65.00, 10, NOW());

CREATE TABLE IF NOT EXISTS comments(
  comment_id int(10) unsigned NOT NULL auto_increment,
  parent_id int(10) unsigned NOT NULL DEFAULT 0,
  product_id int(10) unsigned NOT NULL,
  name varchar(30) NOT NULL,
  email varchar(155) NOT NULL,
  comment_text text NOT NULL,
  approved tinyint(1) unsigned NOT NULL DEFAULT 1,
  created datetime NOT NULL,
  updated timestamp NOT NULL,
  PRIMARY KEY(comment_id),
  KEY (parent_id),
  KEY (product_id),
  KEY (approved),
  KEY (created),
  KEY (updated)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS users(
  user_id int(10) unsigned NOT NULL auto_increment,
  username varchar(20) NOT NULL,
  password varchar(100) NOT NULL,
  fullname varchar(30) NOT NULL,
  created datetime NOT NULL,
  updated timestamp NOT NULL,
  PRIMARY KEY(user_id),
  KEY (created),
  KEY (updated)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO users (`user_id`, `username`, `password`, `fullname`, `created`) VALUES(1, 'admin', '$2y$12$D3ENl6K8iJelQRwwxZ5CxeBvk5S59lC05UhCA8My5n4083SNjoVC.', 'Admin User', NOW());
