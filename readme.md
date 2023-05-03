<h1 align="center">
  <img alt="PPM" src="media/android-chrome-192x192.png">
</h1>
<p align="center">
    A password manager written in PHP, which uses MySQL on the backend.
</p>

## Prerequisites

- PHP 8.2.4
- PHP Composer
  - run `$ composer install`
- MySQL 8.0.32

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
10) `Done` After login, only the users data is displayed, after which they are able to be viewed,
    changed or deleted via clicking or otherwise selecting

## Deliverables

1) Program performance report (PDF) containing:
   1) Title page
   2) UML diagrams
   3) Images of response window(s):
      1) With data (Print Screens)
      2) Program fragments with comments
      3) MySql table windows
      4) Images - real-world connections (Print Screens)
2) PHP code
3) MySQL db export
