CREATE TABLE Users(
        user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(100),
        lname VARCHAR(100),
        MI VARCHAR(5) ,
        email VARCHAR(100) ,
        password VARCHAR(100) ,
        user_type ENUM('Receptionist', 'Admin')
    );


    CREATE TABLE Customers(
        customer_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(100) ,
        lname VARCHAR(100) ,
        MI VARCHAR(5) ,
        Address VARCHAR(100),
        email VARCHAR(100),
        phone VARCHAR(15)
    );


    CREATE TABLE Room_Type(
        roomtype_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        room_code VARCHAR(100) ,
        room_cost FLOAT(10,2) ,
        room_desc VARCHAR(100),
        room_cap INT 
    );

    CREATE TABLE Rooms(
        room_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        room_status ENUM('Available', 'Used by guest','Maintenance'),
        roomtype_id INT, 
        guest_id INT                                                      
    );

    CREATE TABLE Payments(
        payment_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        payment_amount FLOAT(10,2),
        payment_date DATE ,                                   
        payment_type ENUM('Cash', 'Credit Card')
    );

    CREATE TABLE Guests(
            guest_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            date_in DATE ,
            date_out DATE ,
            guests_count INT,
            guest_status ENUM ('COMPLETE','INCOMPLETE'),
            ID_type ENUM('passport','driver license','PhilHealth','SSS UMID','POSTAL','TIN','SENIOR CITIZEN','OFW','OTHERS'),
            ID_number VARCHAR(100),
            files VARCHAR(100),
            payment_id INT ,                               
            room_id INT ,   
            customer_id INT,    
            roomtype_id INT  
        );

    CREATE TABLE Records(
        record_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        record_type ENUM ('COMING','STAYING'),
        record_desc VARCHAR(100),
        record_date DATE ,
        record_time DATETIME,
        user_id INT , 
        guest_id INT , 
        room_id INT , 
        payment_id INT
    );

    CREATE TABLE schedule(
        sched_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        guest_id INT,   
        customer_id INT,   
        room_id INT,   
        roomtype_id INT   
    );

    CREATE TABLE checked_in_guests(
        checked_in_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        paid_amount FLOAT(10,2),  
        guest_id INT , 
        room_id INT,   
        roomtype_id INT,    
        payment_id INT
    );

    CREATE TABLE bill(
        bill_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        bill_date DATE,
        subtotal FLOAT(10,2), 
        payment_id INT, 
        guest_id INT
    );

    CREATE TABLE bill_items(
        billitem_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        quantity INT,
        bill_id INT,
        bill_date DATE,
        roomtype_id INT,   
        amenity_id INT
    );

    CREATE TABLE amenities(
        amenity_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        amenity_name VARCHAR(100),
        amenity_price FLOAT(10,2),
        amenity_type ENUM('Hygiene','Foods','Drinks','Extras'), 
        stock INT
            );

    CREATE TABLE task(
        task_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        task_desc VARCHAR(100),
        task_status  ENUM('COMPLETE','INCOMPLETE')
            );

ALTER TABLE `Rooms`
  ADD CONSTRAINT `rooms_roomtype_pk` FOREIGN KEY (`roomtype_id`) REFERENCES `Room_Type` (`roomtype_id`),
  ADD CONSTRAINT `rooms_guests_pk` FOREIGN KEY (`guest_id`) REFERENCES `Guests` (`guest_id`);


ALTER TABLE `Guests`
  ADD CONSTRAINT `guests_payments_pk` FOREIGN KEY (`payment_id`) REFERENCES `Payments` (`payment_id`),
  ADD CONSTRAINT `guests_rooms_pk` FOREIGN KEY (`room_id`) REFERENCES `Rooms` (`room_id`),
  ADD CONSTRAINT `rooms_customer_pk` FOREIGN KEY (`customer_id`) REFERENCES `Customers` (`customer_id`),
  ADD CONSTRAINT `guests_roomtype_pk` FOREIGN KEY (`roomtype_id`) REFERENCES `Room_Type` (`roomtype_id`);


ALTER TABLE `Records`
  ADD CONSTRAINT `records_users_pk` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `records_guests_pk` FOREIGN KEY (`guest_id`) REFERENCES `Guests` (`guest_id`),
  ADD CONSTRAINT `records_rooms_pk` FOREIGN KEY (`room_id`) REFERENCES `Rooms` (`room_id`),
  ADD CONSTRAINT `records_payments_pk` FOREIGN KEY (`payment_id`) REFERENCES `Payments` (`payment_id`);

ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_guests_pk` FOREIGN KEY (`guest_id`) REFERENCES `Guests` (`guest_id`),
  ADD CONSTRAINT `schedule_customer_pk` FOREIGN KEY (`customer_id`) REFERENCES `Customers` (`customer_id`),
  ADD CONSTRAINT `schedule_rooms_pk` FOREIGN KEY (`room_id`) REFERENCES `Rooms` (`room_id`),
  ADD CONSTRAINT `schedule_roomtype_pk` FOREIGN KEY (`roomtype_id`) REFERENCES `Room_Type` (`roomtype_id`);


ALTER TABLE `checked_in_guests`
  ADD CONSTRAINT `checkedinguests_guests_pk` FOREIGN KEY (`guest_id`) REFERENCES `Guests` (`guest_id`),
  ADD CONSTRAINT `checkedinguests_rooms_pk` FOREIGN KEY (`room_id`) REFERENCES `Rooms` (`room_id`),
  ADD CONSTRAINT `checkedinguests_roomtype_pk` FOREIGN KEY (`roomtype_id`) REFERENCES `Room_Type` (`roomtype_id`),
  ADD CONSTRAINT `checkedinguests_payments_pk` FOREIGN KEY (`payment_id`) REFERENCES `Payments` (`payment_id`);

ALTER TABLE `bill`
  ADD CONSTRAINT `bill_payments_pk` FOREIGN KEY (`payment_id`) REFERENCES `Payments` (`payment_id`),
  ADD CONSTRAINT `bill_guests_pk` FOREIGN KEY (`guest_id`) REFERENCES `Guests` (`guest_id`);


ALTER TABLE `bill_items`
ADD CONSTRAINT `billitems_bill_pk` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`),
 ADD CONSTRAINT `billitems_roomtype_pk` FOREIGN KEY (`roomtype_id`) REFERENCES `Room_Type` (`roomtype_id`),
  ADD CONSTRAINT `billitems_amenities_pk` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`amenity_id`);


ALTER TABLE task ADD task_name varchar(100);
