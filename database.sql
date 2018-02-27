/*categories*/
CREATE TABLE categories (id INT(2) AUTO_INCREMENT PRIMARY KEY, name VARCHAR(20)
NOT NULL) Engine=InnoDB;

/*sub_categories*/
CREATE TABLE sub_categories (id INT(2) AUTO_INCREMENT PRIMARY KEY, name
VARCHAR(20) NOT NULL, category_id INT(2) NOT NULL, FOREIGN KEY (category_id)
REFERENCES categories(id)) Engine=InnoDB;

/*users*/
CREATE TABLE users (id INT(7) AUTO_INCREMENT PRIMARY KEY, full_name VARCHAR(30)
NOT NULL, username VARCHAR(20) NOT NULL UNIQUE, email VARCHAR(40) NOT NULL
UNIQUE, password TEXT NOT NULL, phone VARCHAR(11) UNIQUE NOT NULL) Engine=InnoDB;

/*ads*/
CREATE TABLE ads (id INT(7) AUTO_INCREMENT PRIMARY KEY, title VARCHAR(40) NOT
NULL, location VARCHAR(50) NOT NULL, lat_long TEXT, user_id INT(7) NOT NULL)
Engine=InnoDB;

/*videos*/
CREATE TABLE videos (id INT(7) AUTO_INCREMENT PRIMARY KEY, name VARCHAR(10) NOT
NULL, ad_id INT(7) NOT NULL, FOREIGN KEY (ad_id) REFERENCES ads(id))
Engine=InnoDB;

/*pictures*/
CREATE TABLE pictures (id INT(7) AUTO_INCREMENT PRIMARY KEY, name VARCHAR(10) NOT
NULL, ad_id INT(7) NOT NULL, FOREIGN KEY (ad_id) REFERENCES ads(id))
Engine=InnoDB;
