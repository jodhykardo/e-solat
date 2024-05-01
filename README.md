# e-Solat by Jodi Kardo

This repository's purpose is for USEA recruit test.

## Setup File
If you're using XAMPP as your local web server, you can copy create new folder in htdocs in XAMPP directory and then copy all files in this repository to the new folders you just created

## Setup Database
This project use MySQL, so you need to import 'praytime.sql' to your local database server. Create database named 'praytime' and then import the database.
Then go to /controllers/conn.php, change the username and password of MySQL at your local machine.

## Login
You can login by using this account:
email: admin@admin.id
password: 123456

or you can create new account by click 'Register' button

## Getting Prayer Time Data
You need to run /controllers/grab_data.php on cron to automatically get next 1 weeks pray time data from API

## Features
You can do this features in this mini projects:
1. Register new user
2. Login and log out
3. Subscribe/unsubscribe to the box
4. Autoplay the song that user has been subscribed
5. Next time to solat text
6. Countdown to next solat time

## Notes
1. Autoplay can only activated when you have interacted with the website (like click button). This is the newest policy from the modern browser. 
[![i-Screen-Shoter-Google-Chrome-240501101208-PM.jpg](https://i.postimg.cc/N0vqSygK/i-Screen-Shoter-Google-Chrome-240501101208-PM.jpg)](https://postimg.cc/dh6xTVZF)
2. You need to subscribe to a box first to show the next solat time and countdown to next solat time