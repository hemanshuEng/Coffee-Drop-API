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

## postman file
[Json File](https://github.com/hemanshuEng/Coffee-Drop-API/blob/master/CoffeeDrop.postman_collection.json) 
   
## Laravel packages 
1. CSV.thephpleague [Documentation](https://csv.thephpleague.com/)   
   used to import location data into database 
2. jabranr/postcodes-io [Documentaion](https://packagist.org/packages/jabranr/postcodes-io)   
    used to get geolocation information from postcodes.io

## Future improvement 
1. Authentication 
2. web app using this api and leaflet.js to locate postcode on map
   

## Responsive website for CoffeDrop Startup
This website is built using laravel restfulAPI ,leaflet js is used to display shop location on map , bootstap framework is used for styling
1. find nearest coffeshop's address and opening hours and display on to map
2. recieve cashback according to quantity of used coffee pods
3. add new shop location
4. display all shop location 
   
   ![alt](https://github.com/hemanshuEng/Coffee-Drop-API/blob/master/image/Capture.JPG) 
   ![alt](https://github.com/hemanshuEng/Coffee-Drop-API/blob/master/image/Capture1.JPG) 
   ![alt](https://github.com/hemanshuEng/Coffee-Drop-API/blob/master/image/Capture2.JPG) 
   ![alt](https://github.com/hemanshuEng/Coffee-Drop-API/blob/master/image/Capture3.JPG) 

 
