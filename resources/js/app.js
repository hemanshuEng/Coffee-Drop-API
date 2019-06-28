require("./bootstrap"); // bootstrap added
const axios = require("axios"); // axios for api call

/**
 * bottom map for all location
 * leaflet js for map creation and openstreet map
 */
const mymap = L.map("mapid").setView([54.3781, -2.436], 6);
const attribution =
    '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors';
const tileUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
const tiles = L.tileLayer(tileUrl, {
    attribution,
    maxZoom: 19
});

tiles.addTo(mymap);

/**
 * postcode  for nearest location
 * leaflet js for map creation and openstreet map
 */
const mymap2 = L.map("mapid-2").setView([54.3781, -2.436], 4);
const tiles2 = L.tileLayer(tileUrl, {
    attribution,
    maxZoom: 19
});
tiles2.addTo(mymap2);
/**
 * postcode  for nearest location
 *
 */
// get postcode
const postcodeForm = document.getElementById("postcode-form");

// form event listener
postcodeForm.addEventListener("submit", event => {
    event.preventDefault();
    //postcode
    const postcode = document.querySelector("#postcode").value;
    // header for post method
    const headers = {
        "Content-Type": "application/json",
        Accept: "application/json"
    };
    // data for api call
    const data = {
        postcode: postcode
    };
    /**
     * axios call for /api/getnearestlocation
     *
     */
    axios
        .post("/api/getnearestlocation", data, headers)
        .then(function(response) {
            const items = response.data.closestlocation;
            // set map in center
            mymap2.setView(
                [items.geolocation.latitude, items.geolocation.longitude],
                13
            );

            // add marker in map
            const marker = L.marker([
                items.geolocation.latitude,
                items.geolocation.longitude
            ]).addTo(mymap2);

            // get time table information and add in text var
            let text = `<strong>${items.address.distrist}</strong><br><strong>${
                items.address.county
            }</strong><br><strong>${items.postcode}</strong><br>`;
            // formating hour for display
            const hours = items.hours;
            hours.forEach(hour => {
                text += `${hour.day.toUpperCase()} : ${hour.open} - ${
                    hour.closed != "CLOSED" ? hour.closed : ""
                } <br>`;
            });
            // added information on tooltip for marker
            marker.bindPopup(text);
            // displaying information to webpage
            document.querySelector("#address").innerHTML = text;
        })
        .catch(function(error) {
            //error display on console
            console.log(error);
        });
    // clear field
    document.querySelector("#postcode").value = "";
});
/**
 * axios call for all location and dispaly in map
 *
 */

axios
    .get("/api/locations")
    .then(function(response) {
        // data from api call
        const items = response.data.data;
        // multiple marker added in map
        items.forEach(item => {
            //marker on geolocation
            const marker = L.marker([
                item.geolocation.latitude,
                item.geolocation.longitude
            ]).addTo(mymap);

            // added information on tooltip for marker
            const hours = item.hours;
            let text = `<strong>${item.address.distrist}</strong><hr>`;
            hours.forEach(hour => {
                text += `${hour.day.toUpperCase()} : ${hour.open} - ${
                    hour.closed != "CLOSED" ? hour.closed : ""
                } <br>`;
            });
            // added information on tooltip for marker
            marker.bindPopup(text);
        });
    })
    .catch(function(error) {
        // handle error
        console.log(error);
    });

/**
 * axios call for cashback
 *
 */

const form = document.getElementById("cashback-form");

form.addEventListener("submit", event => {
    event.preventDefault();
    // data for coffee cup quantity
    const ristretto = document.querySelector("#ristretto").value;
    const espresso = document.querySelector("#espresso").value;
    const lungo = document.querySelector("#lungo").value;
    //header for post method
    const headers = {
        "Content-Type": "application/json",
        Accept: "application/json"
    };
    // data for api call
    const data = {
        Ristretto: ristretto,
        Espresso: espresso,
        Lungo: lungo
    };

    axios
        .post("/api/cashback", data, headers)
        .then(function(response) {
            // responce for casback
            const amount = response.data.data.Cashback;
            //displaying cashback on webpage and alert
            document.querySelector(
                "#cashback-amount"
            ).innerHTML = `You will receive  £ ${amount}`;
            document.querySelector("#cashback-alert").classList.add("show");
        })
        .catch(function(error) {
            console.log(error);
        });
    //clear field
    document.querySelector("#ristretto").value = "";
    document.querySelector("#espresso").value = "";
    document.querySelector("#lungo").value = "";
});

/**
 * axios call for adding new shop
 *
 */

const newshopForm = document.getElementById("newshop-form");
//form eventlister
newshopForm.addEventListener("submit", event => {
    event.preventDefault();
    //postcode data
    const postcode = document.querySelector("#postcode-1").value;
    // week name
    const days = [
        "sunday",
        "monday",
        "tuesday",
        "wednesday",
        "thursday",
        "friday",
        "saturday"
    ];
    // empty object for hours
    const opening_time = {};
    const closing_time = {};
    //method to get all 14 time and adding into object
    days.forEach((e, index) => {
        const open_time = document.getElementById(`day-open-${index}`).value;
        const close_time = document.getElementById(`day-close-${index}`).value;
        if (open_time !== null && open_time !== "") {
            opening_time[e] = open_time;
            closing_time[e] = close_time;
        }
    });
    // header for post method
    const headers = {
        "Content-Type": "application/json",
        Accept: "application/json"
    };
    // all data in this object
    const data = {
        postcode: postcode,
        opening_times: opening_time,
        closing_times: closing_time
    };

    // postmethod to added new shop
    axios
        .post("/api/locations", data, headers)
        .then(function(response) {
            const message = response.data.message;
            //responce for server and alert message
            document.querySelector("#newshop-msg").innerHTML = ` ${message}`;
            document.querySelector("#newshop-alert").classList.add("show");
        })
        .catch(function(error) {
            console.log(error);
        });

    //clear fields
    document.querySelector("#postcode-1").value = "";
    for (let index = 0; index < 7; index++) {
        document.getElementById(`day-open-${index}`).value = "";
        document.getElementById(`day-close-${index}`).value = "";
    }
});
