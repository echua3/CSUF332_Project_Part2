/*  tables.sql
    Epiphany Chua
    echua@csu.fullerton.edu
*/
-- DROPS ALL TABLES WITH THE SAME NAME
SET foreign_key_checks = 0;
DROP TABLE IF EXISTS SUPPLIER, DEPARTMENT, EMPLOYEE, SUPERVISES, ITEM,
    LOCATION, EXPIRATION, DELIVERY, `ORDER`, CUSTOMER, TRANSACTION, PURCHASE,
    COUPON, BOUGHT, DOWNLOADS;
SET foreign_key_checks = 1;

CREATE TABLE SUPPLIER(
    ID                  VARCHAR(30)     NOT NULL UNIQUE,
    Representative      VARCHAR(30),
    Phone_Number        VARCHAR(10),  
    PRIMARY KEY(ID)
);

CREATE TABLE DEPARTMENT(
    Name                VARCHAR(30)     NOT NULL UNIQUE,
    Section             VARCHAR(30),
    PRIMARY KEY(Name)
);


CREATE TABLE EMPLOYEE(
    ID                  VARCHAR(30)     NOT NULL UNIQUE,
    First_Name          VARCHAR(30),
    Last_Name           VARCHAR(30),
    Permission_Level    ENUM('0', '1'),
    Department_Name     VARCHAR(30),
    PRIMARY KEY(ID), 
    FOREIGN KEY(Department_Name) REFERENCES DEPARTMENT(Name)
        ON UPDATE CASCADE
        ON DELETE SET NULL
);

CREATE TABLE SUPERVISES(
    Department_Name     VARCHAR(30)     NOT NULL,
    Employee_ID         VARCHAR(30)     NOT NULL,
    PRIMARY KEY(Department_Name, Employee_ID),
    FOREIGN KEY(Department_Name) REFERENCES DEPARTMENT(Name)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY(Employee_ID) REFERENCES EMPLOYEE(ID)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE ITEM(
    UPC                 VARCHAR(30)     NOT NULL UNIQUE,
    Restock_Amount      INT,
    Price               DECIMAL(10, 2),
    Interim_Price       DECIMAL(10, 2),
    Wholesale_Price     DECIMAL(10, 2),
    Current_Stock       INT,
    Department_Name     VARCHAR(30),
    Supplier_ID         VARCHAR(30),
    PRIMARY KEY(UPC), 
    FOREIGN KEY(Department_Name) REFERENCES DEPARTMENT(Name)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(Supplier_ID) REFERENCES SUPPLIER(ID)
        ON UPDATE CASCADE
        ON DELETE SET NULL
);

CREATE TABLE LOCATION(
    Aisle_Number            INT         NOT NULL,
    Aisle_Side              ENUM('right', 'left')         NOT NULL,
    Section_Number          INT         NOT NULL,
    Shelf_Number            INT         NOT NULL,
    Number_of_Items_Down    INT         NOT NULL,
    Item_UPC                VARCHAR(30),
    PRIMARY KEY(Aisle_Number, Aisle_Side, Section_Number, Shelf_Number, Number_of_Items_Down), 
    FOREIGN KEY(Item_UPC) REFERENCES ITEM(UPC)
        ON UPDATE CASCADE
        ON DELETE SET NULL
);

CREATE TABLE EXPIRATION(
    Item_UPC            VARCHAR(30)     NOT NULL,
    Expiration_Date     DATE            NOT NULL,
    PRIMARY KEY(Item_UPC, Expiration_Date),
    FOREIGN KEY(Item_UPC) REFERENCES ITEM(UPC)
        ON UPDATE CASCADE
        ON DELETE CASCADE -- deletes expiration relation if item deleted
);

CREATE TABLE DELIVERY(
    ID                  VARCHAR(30)     NOT NULL UNIQUE,
    Arrival_Date        DATE,
    Pallet_Amount       INT, 
    Truck_Number        INT, 
    PRIMARY KEY(ID)
);

CREATE TABLE `ORDER`(
    Item_UPC            VARCHAR(30)     NOT NULL,
    Amount_of_Item      INT             NOT NULL,
    Order_Date          DATE            NOT NULL, 
    Delivery_Status     ENUM('yes', 'no')   NOT NULL, 
    Delivery_ID         VARCHAR(30),
    PRIMARY KEY(Item_UPC, Amount_of_Item, Order_Date, Delivery_Status),
    FOREIGN KEY(Item_UPC) REFERENCES ITEM(UPC)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(Delivery_ID) REFERENCES DELIVERY(ID)
        ON UPDATE CASCADE
        ON DELETE SET NULL
);

CREATE TABLE CUSTOMER(
    Phone_Number        VARCHAR(10)     NOT NULL UNIQUE,
    Name                VARCHAR(30),
    PRIMARY KEY(Phone_Number)
);

CREATE TABLE TRANSACTION(
    ID                      VARCHAR(30)     NOT NULL,
    Customer_Phone_Number   VARCHAR(10)     NOT NULL,
    Transaction_Date        DATE,
    Transaction_Time        TIME, 
    PRIMARY KEY(ID, Customer_Phone_Number),
    FOREIGN KEY(Customer_Phone_Number) REFERENCES CUSTOMER(Phone_Number)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE PURCHASE(
    Item_UPC                VARCHAR(30)     NOT NULL,
    Transaction_ID          VARCHAR(30)     NOT NULL,
    Customer_Phone_Number   VARCHAR(10)     NOT NULL, 
    Number_Bought           INT, 
    Price_Paid              DECIMAL(10, 2),
    PRIMARY KEY(Item_UPC, Transaction_ID, Customer_Phone_Number),
    FOREIGN KEY(Item_UPC) REFERENCES ITEM(UPC)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(Transaction_ID, Customer_Phone_Number) REFERENCES TRANSACTION(ID, Customer_Phone_Number)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE COUPON(
    ID                      VARCHAR(30)     NOT NULL UNIQUE,
    Discount_Amount         DECIMAL(10, 2),
    Required_Item_Amount    INT,
    Item_UPC                VARCHAR(30)     NOT NULL, 
    PRIMARY KEY(ID),
    FOREIGN KEY(Item_UPC) REFERENCES ITEM(UPC)
        ON UPDATE CASCADE
        ON DELETE CASCADE -- deletes COUPON relation if ITEM deleted
);

CREATE TABLE BOUGHT(
    Item_UPC                VARCHAR(30)     NOT NULL,
    Customer_Phone_Number   VARCHAR(10)     NOT NULL,
    PRIMARY KEY(Item_UPC, Customer_Phone_Number),
    FOREIGN KEY(Item_UPC) REFERENCES ITEM(UPC)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY(Customer_Phone_Number) REFERENCES CUSTOMER(Phone_Number)
        ON UPDATE CASCADE
        ON DELETE CASCADE  -- deletes bought relation if CUSTOMER deleted
);

CREATE TABLE DOWNLOADS (
    Coupon_ID               VARCHAR(30)     NOT NULL,
    Customer_Phone_Number   VARCHAR(10)     NOT NULL,
    PRIMARY KEY(Coupon_ID, Customer_Phone_Number),
    FOREIGN KEY(Coupon_ID) REFERENCES COUPON(ID)
        ON UPDATE CASCADE
        ON DELETE CASCADE,  -- deletes download relation if COUPON deleted
    FOREIGN KEY(Customer_Phone_Number) REFERENCES CUSTOMER(Phone_Number)
        ON UPDATE CASCADE
        ON DELETE CASCADE  -- deletes download relation if CUSTOMER deleted
);