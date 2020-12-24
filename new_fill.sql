
INSERT INTO room_type(roomtype_id, room_cost, room_desc,room_cap) 
VALUES (1,'2000', 'Single bed, Aircon, 1-2 people', '2'), 
(2,'2000', 'Single bed, Fan only, 1-2 people', '2'),
(3,'4500', 'Two beds, Aircon, 2-4 people', '4'),
(4,'9000', 'Three beds, Aircon, 3-5 people', '5');


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


INSERT INTO payments(payment_id, payment_amount, payment_date, payment_type, bill_id)
VALUES (1,5000,'2020-10-12','Cash', '1'),
(2,5000,'2020-10-12','Cash', '2'),
(3,6000,'2020-11-12','Credit Card', '3'),
(4,5000,'2020-11-14','Cash', '4'),
(5,5000,'2020-11-15','Credit Card', '5'),
(6,5000,'2020-12-16','Cash', '6'),
(7,5000,'2020-12-26','Cash', '7'),
(8,5000,'2020-12-28','Credit Card', '8');



INSERT INTO guests(date_in, date_out, guests_count, customer_id, payment_id,room_id)
VALUES ('2020-10-11', '2020-10-12', '1', '1','1',101), 
('2020-10-11', '2020-10-12', '1', '2', '2',102),
('2020-11-11', '2020-11-12', '3', '3', '3',103),
('2020-11-13', '2020-11-14', '2', '4', '4',202),
('2020-11-14', '2020-11-15', '6', '5', '5',301),
('2020-12-15', '2020-12-16', '4', '6', '6',202),
('2020-12-24', '2020-12-26', '5', '7', '7',303),
('2020-12-26', '2020-12-28', '1', '8', '8',206);

INSERT INTO `records` (record_type, record_desc, record_date, record_time, record_paid, guest_id) VALUES
('COMING','coming','2020-10-11','14:00:00', 150, 1),
('STAYING','staying','2020-10-11','15:00:00', 150, 102),
('CHECKED OUT','','2020-10-12','09:00:00', 150, 1),
('COMING','coming','2020-10-11','14:00:00', 150, 2),
('STAYING','staying','2020-10-11','16:00:00', 150, 2),
('CHECKED OUT','','2020-10-12','10:00:00', 150, 2),
('COMING','coming','2020-11-11','14:00:00', 150, 3),
('STAYING','staying','2020-11-11','15:00:00', 150, 3),
('CHECKED OUT','','2020-11-12','08:00:00', 150, 3),
('COMING','coming','2020-11-13','14:00:00', 150, 4),
('STAYING','staying','2020-11-13','16:00:00', 150, 4),
('CHECKED OUT','','2020-11-14','16:00:00', 150, 4),
('COMING','coming','2020-11-14','14:00:00', 150, 5),
('STAYING','staying','2020-11-14','16:00:00', 150, 5),
('CHECKED OUT','','2020-11-15','16:00:00', 150, 5),
('COMING','coming','2020-12-15','14:00:00', 150, 6),
('STAYING','staying','2020-12-15','13:00:00', 150, 6),
('CHECKED OUT','','2020-12-16','10:00:00', 150, 6),
('COMING','coming','2020-12-24','14:00:00', 150, 7),
('COMING','coming','2020-12-26','14:00:00', 150, 8);

INSERT INTO `schedule` (`sched_id`, `guest_id`, `room_id`) VALUES
(1, 1, 101),
(2, 2, 102),
(3, 3, 103),
(4, 4, 202),
(5, 5, 301),
(6, 6, 202),
(7, 7, 303),
(8, 8, 206);


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



INSERT INTO Bill (guest_id, bill_date)
VALUES 	(1,'2020-10-11'),
	(2,'2020-10-11'),
	(3,'2020-11-11'),
	(4,'2020-11-13'),
	(5,'2020-11-14'),
	(6,'2020-12-15'),
	(7,'2020-12-24'),
	(8,'2020-12-26');



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
	(7, 15, 2),
	(7, 16, 2),
	(7, 19, 2),
	(7, 22, 2),
	(7, 10, 2),
	(7, 4, 2),
	(7, 9, 2),
	(8, 15, 6),
	(8, 16, 3),
	(8, 19, 5),
	(8, 22, 1),
	(8, 10, 3),
	(6, 5, 1),
	(6, 8, 1),
	(6, 11, 1),
	(6, 29, 2);



INSERT INTO `users` (`fname`,`lname`,`MI`, `email`, `password`, `user_type`) VALUES
('Ash', 'Ketchum', 'P', 'admin@email.com', 'admin', 'Admin'),
('Luffy', 'Monkey', 'D', 'rec@email.com', 'receptionist', 'Receptionist')
;



INSERT INTO `task` (`task_name`,`task_desc`,task_status) VALUES
('clean room','a customer spilled juice on the bed.','INCOMPLETE'),('Order equipmemts','check the storage, and order them.','INCOMPLETE')
;
