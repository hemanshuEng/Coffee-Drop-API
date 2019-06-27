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
8.  get (path:url/api/locations) ,all locations data
9.  post(path:url/api/locations) 
    header
    `content-Type :application/json`
     `accept :application/json`
     `{
"postcode": "LE46NY",
"opening_times": {"monday" : "09:00", "tuesday" :"09:00", "saturday" : "08:30"},
"closing_times": {"monday" : "19:00", "tuesday" : "19:00", "saturday" : "18:30"}
}`
10. post (path:url/api/cashback)  
    `content-Type :application/json`
     `accept :application/json`  
     `{
	"Ristretto":0,
	"Espresso":1000,
	"Lungo":0
}`
response  
` {
    "data": {
        "coffepod": {
            "Ristretto": 0,
            "Espresso": 1000,
            "Lungo": 0
        },
        "Cashback_pound": 100
    }
}`
11.post (path:url/api/getnearestlocation)
  `content-Type :application/json`
     `accept :application/json`  
    `{
	"postcode":"LA177UY"
}`

   
## Laravel packages 
1. CSV.thephpleague [Documentation](https://csv.thephpleague.com/)   
   used to import location data into database 
2. jabranr/postcodes-io [Documentaion](https://packagist.org/packages/jabranr/postcodes-io)   
    used to get geolocation information from postcodes.io

## Future improvement 
1. Authentication 
2. web app using this api and leaflet.js to locate postcode on map
   
## project build process
1. `composer create-project laravel/laravel CoffeeDrop`
2. create .env file and add database credentials
3. create migrations location,timetable,Coffeepod,price
4. create model location,timetable,coffeecup,price
5. Eloquent (relation between location and timetable,relation between coffeecup and price)
6. seeder for location and price and coffecup ,using csv package and poscode package all data are imported into database
7. create resource for location api
8. controllers for location and coffeecup 




 
