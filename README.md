CPSC 332 Database Project
Professor A. Shirley
May 8, 20222

Group Names and Emails:

    Kanwaljeet Ahluwalia:   Kanahluwalia@csu.fullerton.edu
    Ali Tahami: 		atahami3@csu.fullerton.edu
    Saad Ansari:		saadansari@csu.fullerton.edu

Contributions:

Each member of this group contributed to designing, building and testing the website HTML forms, PHP files, and SQL queries.

REQUIREMENTS PART 2:

(0) Homepage: http://ecs.fullerton.edu/~cs332u30/index.php

1) Add new item to inventory: (Add Items)
    Add a new inventory item to the and all its necessary information to the database

2) Create list of items to check for past date: (Expired Items)
    Should take a department number
    Should return a list of items associated with that department that are to expire within the next 2 days(today’s date +2)

3) Create list of items to order: (Items to order)
    Should take a department number
    Should print a list of items that are associated with that department, that the stock is less than or equal to the restock amount
    Should also include any orders that were placed for each item in returned information

4) Buy item: (Buy items)
    Should take an item id, customer id, and transaction id and add the item to the transaction.
    If no transaction id is given then a new transaction is started for the customer.
    After a transaction is started the transaction id should be printed out so that the transaction can be continued.

5) Total Transactions: (Total Transactions)
    Takes a transaction and a customer id
    Should calculate the total for the transaction given
    Returns 0 if the transaction does not exist

6) Place order by an employee: (Order placed by employees)
    Should take an employee id, item id, and amount of the item to order
    If the employee’s permission level is 0 return a message saying they do not have permission and reject the order
    If the employee does have permission then add the order to the database with the order not having been added to a delivery yet

7) Digital ReadME:
