
CREATE TABLE CATEGORY( 
		c_id INT PRIMARY KEY AUTO_INCREMENT,
        c_name VARCHAR(100)
        );
CREATE TABLE PRODUCT (
		p_id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        purchaseprice INT NOT NULL,
        saleprice INT NOT NULL,
        category INT NOT NULL,
        FOREIGN KEY (category) REFERENCES CATEGORY (c_id) 
        );

INSERT INTO CATEGORY(c_name) VALUES ("Cable");
INSERT INTO CATEGORY(c_name) VALUES ("Laptop");
INSERT INTO CATEGORY(c_name) VALUES ("Hard Drives");
INSERT INTO CATEGORY(c_name) VALUES ("Laptop Charger");
INSERT INTO CATEGORY(c_name) VALUES ("Router");
INSERT INTO CATEGORY(c_name) VALUES ("Keyboard & Mouse");
INSERT INTO CATEGORY(c_name) VALUES ("Dongles");
INSERT INTO CATEGORY(c_name) VALUES ("RAM");
INSERT INTO CATEGORY(c_name) VALUES ("HDD Case");
INSERT INTO CATEGORY(c_name) VALUES ("Converter");
INSERT INTO CATEGORY(c_name) VALUES ("Android Box");
INSERT INTO CATEGORY(c_name) VALUES ("Bluetooth Handsfree");
INSERT INTO CATEGORY(c_name) VALUES ("USB & Memory Card");
INSERT INTO CATEGORY(c_name) VALUES ("Other Items");




