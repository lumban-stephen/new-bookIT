
INSERT INTO room_type(room_cost, room_desc,room_cap) 
VALUES ('2000', 'Single bed, Aircon, 1-2 people', '2'), 
('2000', 'Single bed, Fan only, 1-2 people', '2'),
('4500', 'Two beds, Aircon, 2-4 people', '4'),
('9000', 'Three beds, Aircon, 3-5 people', '5');


INSERT INTO rooms(room_id, room_status, roomtype_id) 
VALUES (101, 'Available', '1'), (102,'Available', '1'), (103,'Available', '1'), (104,'Available', '1'),
(105,'Available', '2'), (106,'Maintenance', '2'), (201,'Available', '2'), (202,'Maintenance', '2'),
(203,'Available', '3'), (204,'Available', '3'), (205,'Available', '3'), (206,'Available', '3'),
(301,'Available', '4'), (302,'Maintenance', '4'), (303,'Available', '4'), (304,'Available', '4'),(305,'Maintenance', '4'),(306,'Available', '4');


INSERT INTO customers(fname, lname, MI, address, email, phone)
VALUES ('Ana', 'Manalastas', 'Z', 'Philippines', 'dummyemail@gmail.com', '12345678999'), ('Ana', 'Manalastas', 'Z', 'Philippines', 'dummyemail@gmail.com', '12345678999'),
('Joey', 'De Leon', 'Z', 'Philippines', 'dummyemail@gmail.com', '12345678999'),
('Cardo', 'Dalisay', 'Z', 'Philippines', '', ''),
('Ador', 'Dalisay', 'Z', 'Philippines', '', ''),
('John', 'Doe', 'Z', 'America', 'dummyemail@gmail.com', '12345678999'),
('Naruto', 'Uzumaki', 'Z', 'Japan', '', ''),
('Yami', 'Sukihiro', 'Z', 'Japan', '', '');


INSERT INTO payments(payment_amount, payment_date, payment_type)
VALUES ('5000', '2008-10-11', 'Cash'), ('5000', '2008-09-12', 'Cash'),
('5000', '2009-11-12', 'Cash'),
('5000', '2008-11-14', 'Cash'),
('5000', '2008-11-15', 'Credit Card'),
('5000', '2008-11-16', 'Credit Card'),
('5000', '2008-11-17', 'Credit Card'),
('5000', '2008-11-18', 'Cash');



INSERT INTO guests(date_in, date_out, guests_count, customer_id, payment_id)
VALUES ('2008-10-11', '2008-10-12', '1', '1','1'), 
('2008-09-11', '2008-09-12', '1', '2', '2'),
('2009-11-11', '2009-11-12', '3', '3', '3'),
('2008-11-13', '2008-11-14', '2', '4', '4'),
('2008-11-14', '2008-11-15', '6', '5', '5'),
('2008-11-15', '2008-11-16', '4', '6', '6'),
('2008-11-16', '2008-11-17', '5', '7', '7'),
('2008-11-17', '2008-11-18', '1', '8', '8');



INSERT INTO amenities (amenity_name, amenity_price, stock,amenity_type)
VALUES	('Dove Shampoo', 8, 100,'Hygiene'),
	('Dove Conditioner', 8, 100,'Hygiene'),
	('Sunsilk Shampoo', 8, 100,'Hygiene'),
	('Sunsilk Conditioner', 8, 100,'Hygiene'),
	('Nature Spring 350ml', 10, 100,'Drinks'),
	('Nature Spring 500ml', 15, 100,'Drinks'),
	('Pepsi 8oz', 10, 100,'Drinks'),
	('Mirinda 8oz', 10, 100,'Drinks'),
	('Mountain Dew 8oz', 10, 100,'Drinks'),
	('Pepsi 12oz', 15, 100,'Drinks'),
	('Mirinda 12oz', 15, 100,'Drinks'),
	('Mountain Dew 12oz', 15, 100,'Drinks'),
	('Pepsi 1L', 30, 100,'Drinks'),
	('San Miguel Light 330ml', 50, 100,'Drinks'),
	('San Miguel Pale Pilsen 320ml', 35, 100,'Drinks'),
	('Piattos', 15, 100,'Foods'),
	('Nova', 15, 100,'Foods'),
	('Taquitos', 15, 100,'Foods'),
	('Vcut', 15, 100,'Foods'),
	('Clover', 15, 100,'Foods'),
	('Dingdong', 12, 100,'Foods'),	
	('Kirie', 10, 100,'Foods'),
	('Oishi', 10, 100,'Foods'),
	('Cheese and Chips', 10, 100,'Foods'),
	('Chippy', 10, 100,'Foods'),
	('Patata', 10, 100,'Foods'),
	('Baby Powder', 20, 100,'Foods'),
	('Candy', 1, 100,'Foods'),
	('Longsilog', 70, 9999999,'Foods'),
	('Hotsilog', 70, 9999999,'Foods'),
	('Cornsilog', 70, 9999999,'Foods'),
	('Tunasilog', 70, 9999999,'Foods'),
	('Pillows', 70, 10,'Extras'),
	('Lights', 70, 5,'Extras')
	;



INSERT INTO Bill (guest_id, bill_date,payment_id)
VALUES 	(1,'2008-11-12',1),
	(2,'2008-11-13',2),
	(3,'2008-11-14',3),
	(4,'2008-11-15',4),
	(5,'2008-11-16',5),
	(6,'2008-11-17',6);



INSERT INTO Bill_Items (bill_id, amenity_id, quantity)
VALUES 	(1, 5, 1),
	(1, 8, 1),
	(1, 11, 1),
	(1, 29, 2),
	(2, 1, 1),
	(2, 3, 1),
	(2, 17, 3),
	(2, 25, 2),
	(3, 5, 1),
	(3, 8, 1),
	(3, 11, 1),
	(3, 29, 2),
	(4, 5, 1),
	(4, 8, 1),
	(4, 11, 1),
	(4, 29, 2),
	(5, 5, 1),
	(5, 8, 1),
	(5, 11, 1),
	(5, 29, 2),
	(6, 5, 1),
	(6, 8, 1),
	(6, 11, 1),
	(6, 29, 2);


INSERT INTO `schedule` (`sched_id`, `guest_id`, `customer_id`, `room_id`, `roomtype_id`) VALUES
(1, 1, 1, 1, 1),
(3, 3, 3, 3, 1),
(4, 4, 4, 2, 1),
(5, 5, 5, 6, 2),
(6, 6, 6, 4, 1),
(7, 7, 7, 5, 2);


INSERT INTO `checked_in_guests` (`checked_in_id`, `guest_id`, `room_id`, `roomtype_id`, `payment_id`, `paid_amount`) VALUES
(1, 1, 1, 1, 1, 2000),
(2, 2,  1, 1, 2, 2000),
(3, 3,  3, 1, 3, 0),
(4, 4, 2, 1, 4, 0);


INSERT INTO `users` (`fname`,`lname`,`MI`, `email`, `password`, `user_type`) VALUES
('Ash', 'Ketchum', 'P', 'admin@email.com', 'admin', 'Admin'),
('Luffy', 'Monkey', 'D', 'rec@email.com', 'receptionist', 'Receptionist')
;



INSERT INTO `task` (`task_name`,`task_desc`,task_status) VALUES
('clean room','a customer spilled juice on the bed.','INCOMPLETE'),('Order equipmemts','check the storage, and order them.','INCOMPLETE')
;

ALTER TABLE users ADD COLUMN salary FLOAT(10,2);
