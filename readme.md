# Password manager in PHP

## TODO

- [X] Show active page in navbar
    - Check if the page we are on matches the navbar tab, if so highlight it
- [X] Add a sign-out button
    - Check if there is a valid token present, if so remove `login` and `sign up`
    - Then create a button called `sign out`
    - Remove stored token then refresh the page
- [X] Home page
  - ~~Add new passwords as forms through a function~~
- [X] Change Password page
  - Change master password on new password change
- [X] New password page
  - Copy things from registration page essentially 

## Prerequisites

- PHP 8.2.4
    - Edit PHP.ini
        - Enable the open-ssl flag
        - Enable PDO-MySQL flag
- PHP Composer
  - run `$ composer install`
- MySQL Latest

## Requirements

1) `Done` Use a MySQL database
2) `Done` User registration via username and password
3) `Done` Password is hashed (salted?) then stored in the db
4) `Done` On registration a new 256-bit aes key is created and stored for the user it is also used
   to encrypt / decrypt the passwords
5) `Done` If the user password is changed then a new master key is created
6) `Done` On log in a user session is created and user id is stored in the
   session
7) `Done` A generated password or manually inputted one is encrypted using the master key
8) `Done` A separate class for the password generation
9) `Done` Password protected fields: Website or Program name, password write time and date
10) `Done` After login, only the users data is displayed, after which they are able to be viewed, changed
    or deleted via clicking or otherwise selecting

## Deliverables

1) Program performance report (PDF) containing: title page, UML diagrams, images of response window(
   s) with various data (Print Screens), program fragments with comments, My Sql tables window
   images - real-world connections (Print Screens );
2) PHP code
3) MySQL db export