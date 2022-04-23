/*  insert_more.sql
    Epiphany Chua
    echua@csu.fullerton.edu
*/
/* After that implement your schema in SQL. You should also include SQL statements to insert data into the tables. The data should have no table be empty and should include at least:
5 items
5 customers
2 expiration dates for a single item
3 employees
3 departments
2 orders
*/
INSERT INTO SUPPLIER
VALUES 
    ('SUP001', 'REP 1', '0001112222'), 
    ('SUP002', 'REP 2', '0001112223'),
    ('SUP003', 'REP 3', '0001112224'),
    ('SUP004', 'REP 4', '0001112225'), 
    ('SUP005', 'REP 5', '0001112226'),
    ('SUP006', 'REP 6', '0001112227');

INSERT INTO DEPARTMENT
VALUES 
    ('Fruit', 'Produce'),
    ('Vegetable', 'Produce'),
    ('Fish', 'Seafood'),
    ('Bread', 'Bakery'),
    ('Cake', 'Bakery');

INSERT INTO EMPLOYEE
VALUES 
    ('EMPF01', 'Amy', 'Apples', '1', 'Fruit'), 
    ('EMPB01', 'Bob', 'Baker', '1', 'Bread'), 
    ('EMPC01', 'Cat', 'Cupcake', '1', 'Cake'), 
    ('EMPFI1', 'Dylan', 'Daggartooth', '1', 'Fish'),
    ('EMPV01', 'Earl', 'Edamame', '1', 'Vegetable'),
    ('EMPF02', 'Flyn', 'Fuji', '0', 'Fruit'),
    ('EMPB02', 'Gal', 'Grain', '0', 'Bread'),
    ('EMPC02', 'Hal', 'Hershey', '0', 'Cake'),
    ('EMPFI2', 'Ide', 'Ivory', '0', 'Fish'),
    ('EMPV02', 'Jarl', 'Jalepeno', '0', 'Vegetable');

INSERT INTO SUPERVISES
VALUES 
    ('Fruit', 'EMPF01'),
    ('Vegetable', 'EMPV01'),
    ('Fish', 'EMPFI1'),
    ('Bread', 'EMPB01'),
    ('Cake', 'EMPC01');

INSERT INTO ITEM
VALUES 
    ('FUJIAPPLE', 50, 1.99, 1.29, 0.99, 25, 'Fruit', 'SUP001'), 
    ('GALAAPPLE', 40, 2.99, 1.99, 1.50, 20, 'Fruit', 'SUP001'),
    ('ORANGE', 30, 0.99, 0.50, 0.30, 15, 'Fruit', 'SUP001'),
    ('WHITEBREAD', 25, 2.99, 0.99, 0.50, 10, 'Bread', 'SUP002'),
    ('WHEATBREAD', 30, 3.99, 1.50, 1.99, 7, 'Bread', 'SUP002'),
    ('BAGEL', 10, 4.99, 2.50, 1.99, 20, 'Bread', 'SUP002'),
    ('SALMON', 10, 5.99, 3.99, 2.50, 4, 'Fish', 'SUP003'),
    ('TROUT', 5, 8.99, 5.99, 3.50, 3, 'Fish', 'SUP003'),
    ('CARROT', 50, 1.99, 1.00, 0.30, 20, 'Vegetable', 'SUP001'),
    ('BROCCOLI', 50, 2.99, 1.00, 0.30, 200, 'Vegetable', 'SUP001'),
    ('ASPARAGUS', 25, 0.99, 0.50, 0.30, 100, 'Vegetable', 'SUP001'),
    ('VANILLA', 5, 10.99, 5.99, 3.99, 2, 'Cake', 'SUP002'),
    ('CHOCOLATE', 5, 10.99, 5.99, 3.99, 2, 'Cake', 'SUP002'),
    ('MANGO', 5, 13.99, 5.99, 4.99, 10, 'Cake', 'SUP002');  

INSERT INTO LOCATION
VALUES 
    (1, 'right', 1, 1, 0, 'FUJIAPPLE'),
    (1, 'right', 1, 1, 1, 'GALAAPPLE'),
    (1, 'right', 1, 1, 2, 'ORANGE'),
    (1, 'left', 1, 1, 2, 'CARROT'),
    (1, 'left', 1, 1, 3, 'BROCCOLI'),
    (1, 'left', 1, 1, 4, 'ASPARAGUS'),
    (2, 'right', 1, 1, 0, 'WHITEBREAD'),
    (2, 'right', 1, 1, 1, 'WHEATBREAD'),
    (2, 'right', 1, 1, 3, 'WHITEBREAD'),
    (2, 'right', 1, 1, 5, 'BAGEL'),
    (2, 'left', 1, 1, 1, 'VANILLA'),
    (2, 'left', 1, 1, 2, 'CHOCOLATE'),
    (2, 'left', 1, 1, 3, 'MANGO'),
    (3, 'left', 3, 3, 2, 'SALMON'),
    (3, 'left', 3, 3, 3, 'SALMON');

INSERT INTO EXPIRATION
VALUES 
    ('FUJIAPPLE', "2022-04-29"),
    ('FUJIAPPLE', "2022-04-30"), 
    ('GALAAPPLE', "2022-04-25"),
    ('ORANGE', "2022-04-29"),
    ('WHITEBREAD', "2022-04-15"),
    ('WHEATBREAD', "2022-04-16"),
    ('BAGEL', "2022-04-20"),
    ('BAGEL', "2022-04-23"),
    ('SALMON', "2022-04-14"),
    ('CARROT', "2022-05-20"),
    ('BROCCOLI', "2022-05-01"),
    ('ASPARAGUS', "2022-05-10"),
    ('VANILLA', "2022-04-17"),
    ('CHOCOLATE', "2022-04-22"),
    ('MANGO', "2022-04-24");   

INSERT INTO DELIVERY
VALUES 
    ('DELV01', "2022-04-29", 50, 1),
    ('DELV02', "2022-04-22", 45, 2), 
    ('DELV03', "2022-04-25", 50, 1),
    ('DELV04', "2022-04-16", 30, 3),
    ('DELV05', "2022-04-25", 45, 2),
    ('DELV06', "2022-04-20", 30, 3);

INSERT INTO `ORDER`
VALUES 
    ('FUJIAPPLE', 99, "2022-04-10", 'yes', 'DELV01'),
    ('WHITEBREAD', 40, "2022-04-10", 'yes', 'DELV01'),
    ('BAGEL', 50, "2022-04-10", 'yes', 'DELV01'),
    ('FUJIAPPLE', 10, "2022-04-11", 'no', NULL),
    ('VANILLA', 10, "2022-04-10", 'yes', 'DELV02'),
    ('CHOCOLATE', 10, "2022-04-10", 'yes', 'DELV02'),
    ('BROCCOLI', 100, "2022-04-20", 'yes', 'DELV03'),
    ('ASPARAGUS', 100, "2022-04-22", 'yes', 'DELV03'),
    ('CARROT', 200, "2022-04-18", 'yes', 'DELV03'),
    ('SALMON', 10, "2022-04-15", 'yes', 'DELV04');

INSERT INTO CUSTOMER
VALUES 
    ('0000000000', 'JOHN CUSTOMER'),
    ('1111111111', 'JAMES CUSTOMER'),
    ('2222222222', 'JACK CUSTOMER'),
    ('3333333333', 'JULIA CUSTOMER'),
    ('4444444444', 'JOANE CUSTOMER'),
    ('5555555555', 'JAMIE CUSTOMER'),
    ('6666666666', 'Johnny Depp'),
    ('7777777777', 'Jim Carrey'),
    ('8888888888', 'Jackie Chan'),
    ('9999999999', 'Jessica Alba');

INSERT INTO TRANSACTION
VALUES 
    ('TRANS01','0000000000', "2022-04-10", '09:10:11'),
    ('TRANS01','1111111111', "2022-04-10", '10:10:10'),
    ('TRANS02','1111111111', "2022-04-11", '11:11:11'),
    ('TRANS01','2222222222', "2022-04-10", '12:12:12'),
    ('TRANS01','3333333333', "2022-04-07", '13:13:33'),
    ('TRANS02','3333333333', "2022-04-08", '13:12:11'),
    ('TRANS01','4444444444', "2022-04-17", '14:14:14'),
    ('TRANS01','5555555555', "2022-04-01", '15:15:15'),
    ('TRANS01','6666666666', "2022-04-15", '15:15:16'),
    ('TRANS01','7777777777', "2022-04-16", '15:15:17'),
    ('TRANS01','8888888888', "2022-04-17", '15:15:18'),
    ('TRANS01','9999999999', "2022-04-18", '15:15:19');

INSERT INTO PURCHASE
VALUES 
    ('FUJIAPPLE', 'TRANS01', '0000000000', 4, 1.29),
    ('WHITEBREAD', 'TRANS01','1111111111', 2, 2.99),
    ('FUJIAPPLE', 'TRANS02','1111111111', 5, 1.29),
    ('VANILLA', 'TRANS01','2222222222', 1, 10.99),
    ('WHEATBREAD', 'TRANS01','3333333333', 2, 2.99),
    ('CARROT', 'TRANS02','3333333333', 5, 1.99),
    ('BROCCOLI', 'TRANS02','3333333333', 1, 2.99),
    ('SALMON', 'TRANS01','4444444444', 2, 5.99),
    ('GALAAPPLE', 'TRANS01','5555555555', 4, 2.99),
    ('CARROT', 'TRANS01','6666666666', 5, 1.99),
    ('BROCCOLI', 'TRANS01','7777777777', 4, 0.99),
    ('ASPARAGUS', 'TRANS01','8888888888', 10, 2.99),
    ('CHOCOLATE', 'TRANS01','9999999999', 1, 10.99);

INSERT INTO COUPON
VALUES 
    ('COUP01', 0.50, 2, 'FUJIAPPLE'),
    ('COUP02', 0.60, 5, 'FUJIAPPLE'),
    ('COUP03', 3.99, 1, 'VANILLA'),
    ('COUP04', 0.99, 3, 'WHITEBREAD'),
    ('COUP05', 5.00, 1, 'MANGO'),
    ('COUP06', 2.00, 3, 'BAGEL');

INSERT INTO BOUGHT
VALUES 
    ('FUJIAPPLE', '0000000000'),
    ('WHITEBREAD', '1111111111'),
    ('FUJIAPPLE', '1111111111'),
    ('VANILLA', '2222222222'),
    ('WHEATBREAD', '3333333333'),
    ('CARROT', '3333333333'),
    ('SALMON', '4444444444'),
    ('GALAAPPLE', '5555555555'),
    ('CARROT', '6666666666'),
    ('BROCCOLI', '7777777777'),
    ('ASPARAGUS', '8888888888'),
    ('CHOCOLATE', '9999999999');

INSERT INTO DOWNLOADS
VALUES 
    ('COUP01', '0000000000'),
    ('COUP02', '0000000000'),
    ('COUP03', '2222222222'),
    ('COUP02', '5555555555'),
    ('COUP04', '8888888888'),
    ('COUP05', '9999999999');
    
    
    
