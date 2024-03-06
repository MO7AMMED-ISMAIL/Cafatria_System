# PHP_Project_ITI
Welcome to Cafeteria Management System, A Systme to manage the basic operations of a cafeteria . This Project was supervised by Eng: Hend Samir as part of Intake44.


## Table of Content
- [Description](#Description)
- [Features](#Features)
- [File-Structure](#File-Strucutre)
- [How-To-Use](#How-To-Use)


## Description
A Cafeteria System has two main modes in order to manage the full system of a cafeteria 
**User Mode** to manage the main operations of user on the system 
and **Home Mode** to manage the main operations of user on the system

## Features
Features Are Divided to 
- [User-Mode](#User-Mode)
- [Admin-Mode](#Admin-Mode)


### User Mode
User Main Features
- [Login-Page](#Login-Page)
- [Home-Page](#Home-Page)
- [My-Order](#My-Order)



#### Login Page
1. Login to the site with username and password
2. When click forget password &rarr; redirect to new page to enter password
3. confirm password.

#### Home Page
1. user select his order, images of the products are clickable, when you click on it, item added.
2. \+ or \- to add or remove the count of the product you need in the notes; you can specify any comment.
3. Rooms are displayed in combo box.
4. The money you should pay is displayed.
5. when you click confirm the order is sent.
6. Latest order is displayed on the top.
7. Drink price should be specified.
 
#### My Order
1. User can view his/ her order with total price according to
date range specified.
2. Order status should in (Processing, out for delivery and done)
3. Only the orders with processing status can be canceled
when you click on the order, its content is displayed

### Admin Mode

- [Login](#Login)
- [Users](#Users)
- [Product](#Product)
- [Orders](#Orders)
- [Ckecks](#Checks)


#### Login
1. Login to the site with username and password
2. When click forget password &rarr; redirect to new page to enter password
3. confirm password.

#### Users
1. Admin can *Add User*,*View the users* , *Edit*, *Delete the users*

#### Product
1. Admin can add product,List All Products, Update Product , Remove Product
2. Product have categories
3. Admin clicks on add category-> redirect to a new page that
4. accept the name of the category

#### Orders
Admin can check the current orders he have to finish as
described above.


#### Checks
1. Admin can check all the checks he has, according to the
specified date
2. Admin can select specific user.
3. if admin doesn’t choose specific users, all users should be displayed
4. When admin clicks on the username his order’s info during the
specified time period should be displayed.


## File Structure





## How to Get Started

Thank you for choosing to use our PHP native project! To get started with the project, please follow the steps outlined below:

### Prerequisites

Before proceeding, ensure you have the following software installed on your system:

- **XAMPP**: Our project runs on XAMPP, which provides an easy-to-install Apache distribution containing MariaDB, PHP, and Perl. If you haven't installed XAMPP yet, you can download it from the [official website](https://www.apachefriends.org/index.html).

### Installation

Follow these steps to set up and run the project on your local machine:

1. **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/your-project.git
    ```

2. **Move the project files:**

    Move the cloned project files to the `htdocs` directory in your XAMPP installation directory. This directory is typically located at `C:\xampp\htdocs` on Windows or `/Applications/XAMPP/htdocs` on macOS.

3. **Start XAMPP:**

    Launch the XAMPP Control Panel and start the Apache server.

4. **Import the Database (if necessary):**

    If your project includes a database, you may need to import it into your local database management system (e.g., phpMyAdmin). Refer to the project documentation for specific instructions on importing the database.

### Usage

Once the project is set up and running, you can access it in your web browser by navigating to [http://localhost/your-project](http://localhost/PHP_Project_ITI/BackEnd).
