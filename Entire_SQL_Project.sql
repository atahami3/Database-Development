/* =================================================== */
CREATE TABLE Suppliers(
    uID VARCHAR(20) NOT NULL,
    rep VARCHAR(20), 
    repPhNum VARCHAR(10),
    PRIMARY KEY(uID)
);
/* =================================================== */
CREATE TABLE Orders(
    orderID INT(12) NOT NULL,
    addedToDelivery BOOLEAN NOT NULL, 
    amount INT,
    orderDate DATE NOT NULL,
    PRIMARY KEY(orderID)
);
/* =================================================== */
CREATE TABLE Department(
    dName VARCHAR(20) NOT NULL,
    dSection INT(5),
    superID VARCHAR(20),
    PRIMARY KEY(dName)
);
/* =================================================== */
/*ALTER TABLE Department
ADD FOREIGN KEY(superID) REFERENCES Employees(idNum);*/
/* =================================================== */
CREATE TABLE Delivery(
    dID VARCHAR(20) NOT NULL,
    arrivalDate DATE, 
    truckNum VARCHAR(20) NOT NULL,
    numPallets INT,
    oID INT (12) NOT NULL,
    PRIMARY KEY(dID),
    FOREIGN KEY(oID) REFERENCES Orders(orderID)
);
/* =================================================== */
CREATE TABLE Employees(
    idNum VARCHAR(20) NOT NULL,
    fName VARCHAR(20),
    lName VARCHAR(20),
    empDName VARCHAR(20) NOT NULL,
    permissionLVL BOOLEAN NOT NULL,
    PRIMARY KEY(idNum)
);
/* =================================================== */
/*ALTER TABLE Employees
ADD FOREIGN KEY(empDName) REFERENCES Department(dName);*/
/* =================================================== */
CREATE TABLE Customers(
    custID VARCHAR(20) NOT NULL,
    purchasedItems INT NOT NULL,
    fName VARCHAR(20),
    lNAme VARCHAR(20),
    PRIMARY KEY(custID)
);
/* =================================================== */
CREATE TABLE Transactions(
    tID VARCHAR(20) NOT NULL,
    tDate DATE NOT NULL,
    tTime TIME NOT NULL,
    cuID VARCHAR(20) NOT NULL,
    PRIMARY KEY(tID, cuID),
    FOREIGN KEY(cuID) REFERENCES Customers(custID)
);
/* =================================================== */
CREATE TABLE Items(
    upc CHAR(12) NOT NULL, 
    salePrice float(4) NOT NULL, 
    price float(4) NOT NULL, 
    wholeSalePrice float(4) NOT NULL, 
    currentStock INT, 
    restockAmt INT, 
    tID VARCHAR(20) NOT NULL,
    PRIMARY KEY(upc)    
);
/* =================================================== */
/*FOREIGN KEY(tID) REFERENCES Transactions(tID)*/
CREATE TABLE Coupons(
    unqID VARCHAR(20) NOT NULL,
    discountPercentage float(3) NOT NULL,
    minPurchaseAmt float(4) NOT NULL,
    upc CHAR(12) NOT NULL,
    PRIMARY KEY(unqID),
    FOREIGN KEY(upc) REFERENCES Items(upc)
);
/* =================================================== */
CREATE TABLE Supplied(
    upc CHAR(12) NOT NULL, 
    supID VARCHAR(20) NOT NULL,
    PRIMARY KEY(upc,supID),
    FOREIGN KEY(upc) REFERENCES Items(upc),
    FOREIGN KEY(supID) REFERENCES Suppliers(uID)
);
/* =================================================== */
CREATE TABLE forOrder(
    upc CHAR(12) NOT NULL, 
    oID INT(12) NOT NULL,
    PRIMARY KEY(upc,oID),
    FOREIGN KEY(upc) REFERENCES Items(upc), 
    FOREIGN KEY(oID) REFERENCES Orders(orderID)
);
/* =================================================== */
CREATE TABLE inDpt(
    upc CHAR(12) NOT NULL,
    name VARCHAR(20) NOT NULL,
    PRIMARY KEY(upc,name),
    FOREIGN KEY(upc) REFERENCES Items(upc)
);
/* =================================================== */
/*ALTER TABLE inDpt
ADD FOREIGN KEY(name) REFERENCES Department(dName);*/
/* =================================================== */
CREATE TABLE PurchasedBy(
    upc CHAR(12) NOT NULL,
    uID VARCHAR(20) NOT NULL,
    PRIMARY KEY(upc,uID),
    FOREIGN KEY(upc) REFERENCES Items(upc), 
    FOREIGN KEY(uID) REFERENCES Customers(custID)
);
/* =================================================== */
CREATE TABLE canDownload(
    cuID VARCHAR(20) NOT NULL,
    couponID VARCHAR(12) NOT NULL,
    PRIMARY KEY(cuID, couponID),
    FOREIGN KEY(cuID) REFERENCES Customers(custID),
    FOREIGN KEY(couponID) REFERENCES Coupons(unqID)
);
/* =================================================== */
CREATE TABLE TransactWith(
    tID VARCHAR(20) NOT NULL,
    upc CHAR(12) NOT NULL,
    perchasedItems VARCHAR(20),
    numberOfItems INT,
    cuID VARCHAR(20) NOT NULL,
    PRIMARY KEY(upc,tID,cuID),
    FOREIGN KEY(upc) REFERENCES Items(upc),
    FOREIGN KEY(tID) REFERENCES Transactions(tID),
    FOREIGN KEY(cuID) REFERENCES Transactions(cuID)
    
);
/* =================================================== */
CREATE TABLE Location(
    asileNum INT,
    asileSlide VARCHAR(2),
    asileSecNum INT,
    shelfNum INT,
    itemDistance VARCHAR(20),
    upc CHAR(12) NOT NULL,
    PRIMARY KEY(asileNum,asileSlide,asileSecNum,shelfNum,itemDistance),
    FOREIGN KEY(upc) REFERENCES Items(upc)
);
/* =================================================== */
CREATE TABLE ExpirationDate(
    upc CHAR(12) NOT NULL,
    expirationDate DATE,
    PRIMARY KEY(upc, expirationDate),
    FOREIGN KEY(upc) REFERENCES Items(upc)
);
/* =================================================== */

/* ==================================== Insert Statments ==================================== */
INSERT INTO Suppliers
VALUES("0987654321","Rep Holder","7147460902");
INSERT INTO Orders
VALUES(808, 0, 20, '2021-11-11');
INSERT INTO Orders
VALUES(809, 1, 15, '2021-1-10');
INSERT INTO Department
Values("Sales", 1, "191123");
INSERT INTO Department
Values("Trade", 2, "191093" );
INSERT INTO Department
Values("Rings", 3, "881188");
INSERT INTO Delivery
VALUES("01928", '2022-05-10',"5", 6, 808);
INSERT INTO Employees
Values("191123", "Bilbo", "Baggins", "Sales", 0);
INSERT INTO Employees
Values("191093", "Sam", "Baggins","Trade", 0);
INSERT INTO Employees
Values("881188", "Gandalf", "Grey","Rings", 1);
INSERT INTO Customers
Values("11111", 2, "Saad", "Ansari");
INSERT INTO Customers
Values("22222", 54, "Ken", "LastimusNamimus");
INSERT INTO Customers
Values("33333", 19, "Ali", "LastoNamo");
INSERT INTO Customers
Values("44444", 5, "Sam", "Samison");
INSERT INTO Customers
Values("55555", 15, "Gupta", "Guptanson");
INSERT INTO Transactions
VALUES("531", '2020-01-01', '19:30:10', "33333");
INSERT INTO Items
VALUES("123456789012", 20.00, 15.00, 10.00, 50,30, "531");
INSERT INTO Items
VALUES("000000000000", 20.00, 15.00, 10.00, 50,30, "531");
INSERT INTO Items
VALUES("111111111111", 20.00, 15.00, 10.00, 50,30, "531");
INSERT INTO Items
VALUES("222222222222", 20.00, 15.00, 10.00, 50,30, "531");
INSERT INTO Items
VALUES("333333333333", 20.00, 15.00, 10.00, 50,30, "531");
INSERT INTO Coupons
VALUES("6969", 4.5, 20.00,"123456789012" );
INSERT INTO Coupons
VALUES("4200", .565, 20.00,"000000000000" );
INSERT INTO Supplied
VALUES("123456789012","0987654321");
INSERT INTO forOrder
VALUES("000000000000", 808);
INSERT INTO inDpt
VALUES("000000000000", "Rings");
INSERT INTO PurchasedBy
VALUES("000000000000","22222");
INSERT INTO canDownload
VALUES("22222","6969");
//=======================================
INSERT INTO TransactWith
VALUES("531","000000000000", "5", "10", "11111");
//=======================================
INSERT INTO Location 
VALUES(1,"A",2, 4, "5", "000000000000");
INSERT INTO ExpirationDate
VALUES("123456789012", '2022-12-12');
INSERT INTO ExpirationDate
VALUES("123456789012", '2022-12-16');
// ================================ New Additions ============================ 
INSERT INTO ExpirationDate
VALUES("000000000000", '2022-04-25');
INSERT INTO ExpirationDate
VALUES("000000000001", '2022-04-30');
INSERT INTO ExpirationDate
VALUES("000000000002", '2022-05-28');
INSERT INTO ExpirationDate
VALUES("123456789013", '2021-12-10');
INSERT INTO ExpirationDate
VALUES("123456789014", '2020-12-12');

INSERT INTO Items
VALUES("123456789013", 20.00, 15.00, 30.00, 50,80, "531");
INSERT INTO Items
VALUES("000000000001", 20.00, 15.00, 20.00, 30,70, "531");
INSERT INTO Items
VALUES("123456789014", 20.00, 15.00, 40.00, 70,100, "531");
INSERT INTO Items
VALUES("000000000002", 20.00, 15.00, 10.00, 20,90, "531");

INSERT INTO inDpt
VALUES("000000000001", "Rings");
INSERT INTO inDpt
VALUES("000000000002", "Rings");
INSERT INTO inDpt
VALUES("123456789013", "Sales");
INSERT INTO inDpt
VALUES("123456789014", "Trade");

INSERT INTO forOrder
VALUES("000000000001", 808);
INSERT INTO forOrder
VALUES("000000000002", 808);
INSERT INTO forOrder
VALUES("123456789014", 808);
INSERT INTO forOrder
VALUES("000000000002", 809);
INSERT INTO forOrder
VALUES("000000000001", 809);

INSERT INTO Transactions
VALUES("511", '2020-01-01', '19:30:10', "11111");
INSERT INTO Transactions
VALUES("521", '2020-01-05', '19:30:10', "22222");
INSERT INTO Transactions
VALUES("531", '2020-01-10', '19:30:10', "33333");
INSERT INTO Transactions
VALUES("531", '2020-01-10', '19:30:10', "11111");

INSERT INTO TransactWith
VALUES("531","000000000000", "5", "10", "11111");
INSERT INTO TransactWith
VALUES("511","000000000001", "5", "10", "22222");
INSERT INTO TransactWith
VALUES("521","000000000002", "5", "10", "33333");

INSERT INTO TransactWith
VALUES("511","000000000001", "5", "10", "11111");
INSERT INTO TransactWith
VALUES("521","000000000002", "5", "10", "22222");
INSERT INTO TransactWith
VALUES("531","000000000002", "5", "10", "33333");



// ===========================================================================
/* ==================================== End of Insert  ==================================== */


/* =======================================================================================================
We added the alter tables at the end becasue the DB threw a foreign key contraint error upon insertion
of values becasue the Employees and Departments table's foreign keys were referencing one another.
So, we added tables, then values and finally after all tables and values were added, we added the foreign 
keys. 
========================================================================================================== */ 
ALTER TABLE Employees
ADD FOREIGN KEY(empDName) REFERENCES Department(dName);

ALTER TABLE Department
ADD FOREIGN KEY(superID) REFERENCES Employees(idNum);

ALTER TABLE inDpt
ADD FOREIGN KEY(name) REFERENCES Department(dName);

 To Delete row:
Delete from Items where upc='0';
Delete from ExpirationDate where upc='000000000000';
/* ============================================================================= Project Queries ================================================================
---- SQL in MariaDB ----
select distinct ExpirationDate.upc, expirationDate 
from Department, inDpt, Items, ExpirationDate 
where expirationDate < curdate() + 2 and (Department.dName = 'Rings' or Department.dName = 'Sales' or Department.dName = 'Trade');
---- MariaDB SQL OUTPUT ----
+--------------+----------------+
| upc          | expirationDate |
+--------------+----------------+
| 123456789013 | 2021-12-10     |
| 123456789014 | 2020-12-12     |
+--------------+----------------+
2 rows in set (0.00 sec) 
-----------------------------------

select distinct ExpirationDate.upc, expirationDate from Department, inDpt, Items, ExpirationDate where expirationDate > curdate() + 2 and Department.dName = \"" .$danme . "\");

---- SQL in MariaDB ----
SELECT upc FROM Items where currentStock < restockAmt AND Items.upc IN (SELECT inDpt.upc FROM inDpt WHERE inDpt.name = 'Rings' OR inDpt.name = 'Sales' OR inDpt.name = 'Trade');
---- MariaDB SQL OUTPUT ----
+--------------+
| upc          |
+--------------+
| 000000000001 |
| 000000000002 |
| 123456789013 |
| 123456789014 |
+--------------+
4 rows in set (0.00 sec)
----------------------------

SELECT forOrder.upc, forOrder.oID FROM forOrder WHERE forOrder.upc IN (SELECT upc FROM  Items WHERE currentStock < restockAmt AND Items.upc IN (SELECT inDpt.upc FROM inDpt WHERE inDpt.name = 'Rings'));

SELECT forOrder.upc, forOrder.oID FROM forOrder WHERE forOrder.upc IN (SELECT upc FROM  Items WHERE currentStock < restockAmt AND Items.upc IN (SELECT inDpt.upc FROM inDpt WHERE inDpt.name =  \"" .$danme . "\"));

SELECT SUM(Item.Price), Items.upc, inDpt.name, forOrder.upc
From forOrder.upc AND 
--------------------------------------------------------------- In MariaDB -----------------------------
SELECT (SUM(Items.Price)*SUM(TransactWith.perchasedItems)) AS Total
FROM Items, TransactWith, Transactions
WHERE Items.upc=TransactWith.upc AND TransactWith.tID=Transactions.tID AND TransactWith.cuID=Transactions.cuID AND Transactions.tID = '531' AND Transactions.cuID = '11111';

+---------------------------------------------------+
| SUM(Items.Price)*SUM(TransactWith.perchasedItems) |
+---------------------------------------------------+
|                                                75 |
+---------------------------------------------------+
1 row in set (0.00 sec)
-------------------------------------------------------------------------------------------------------


/* =============================================================================== END Queries ==================================================================
/* =============================================================================
***If Foreign key constraints interfere with dropping tables use this code. *** 
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS Coupons;
DROP TABLE IF EXISTS Customers;
DROP TABLE IF EXISTS  Delivery;
DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Employees;
DROP TABLE IF EXISTS ExpirationDate;
DROP TABLE IF EXISTS Items;
DROP TABLE IF EXISTS Location;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS PurchasedBy;
DROP TABLE IF EXISTS Supplied;
DROP TABLE IF EXISTS Suppliers;
DROP TABLE IF EXISTS TransactWith;
DROP TABLE IF EXISTS Transactions;
DROP TABLE IF EXISTS canDownload;
DROP TABLE IF EXISTS forOrder;
DROP TABLE IF EXISTS inDpt;
SET FOREIGN_KEY_CHECKS = 1;
================================================================================ */