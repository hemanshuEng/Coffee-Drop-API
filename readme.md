#  Coffee Drop API

## How to use App  

`git clone https://github.com/hemanshuEng/Coffee-Drop-API.git`  

1. install xampp and composer 
2. create database (coffeedrop)
3. create .env file and add database credentials and without APP_KEY
`DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=coffeedrop
DB_USERNAME=root
DB_PASSWORD= 
   `
4. run `php artisan key:generate`
5. create table `php artisan migrate`
6. run `php artisan DB:seed`
7. open postman and import this link https://www.getpostman.com/collections/163a2331d34d9c49f7c5
   
## Laravel packages 
1. CSV.thephpleague [Documentation](https://csv.thephpleague.com/)   
   used to import location data into database 
2. jabranr/postcodes-io [Documentaion](https://packagist.org/packages/jabranr/postcodes-io)   
    used to get geolocation information from postcodes.io

## Future improvement 
1. Authentication 
2. web app using this api and leaflet.js to locate postcode on map




 
