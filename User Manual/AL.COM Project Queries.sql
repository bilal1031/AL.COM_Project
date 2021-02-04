CREATE DATABASE al_com_dealer;
USE al_com_dealer;
CREATE TABLE CATEGORY( 
		c_id INT PRIMARY KEY AUTO_INCREMENT,
        c_name VARCHAR(100)
        );
CREATE TABLE PRODUCT (
		p_id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        price INT NOT NULL,
        category INT NOT NULL,
        FOREIGN KEY (category) REFERENCES CATEGORY (c_id)
        );
        
        
/* Dummy Data */
INSERT INTO CATEGORY(c_name) VALUES ("Cable");
INSERT INTO CATEGORY(c_name) VALUES ("Laptop");
INSERT INTO CATEGORY(c_name) VALUES ("Hard Drives");

INSERT INTO PRODUCT(name,price,category) VALUES("VGA Cable",150,1);
INSERT INTO PRODUCT(name,price,category) VALUES("Sata Cable",150,1);
INSERT INTO PRODUCT(name,price,category) VALUES("Dell G7",150000,2);

