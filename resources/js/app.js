/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
const axios = require("axios");

//window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });
const mymap = L.map("mapid").setView([54.3781, -2.436], 6);
const attribution =
    '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors';
const tileUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
const tiles = L.tileLayer(tileUrl, {
    attribution,
    maxZoom: 19
});
tiles.addTo(mymap);

axios
    .get("http://coffeedrop.test/api/locations")
    .then(function(response) {
        const items = response.data.data;
        items.forEach(item => {
            const marker = L.marker([
                item.geolocation.latitude,
                item.geolocation.longitude
            ]).addTo(mymap);
            const hours = item.hours;
            let text = `<strong>${item.address.distrist}</strong><hr>`;
            hours.forEach(hour => {
                text += `${hour.day.toUpperCase()} : ${hour.open} - ${
                    hour.closed != "CLOSED" ? hour.closed : ""
                } <br>`;
            });
            marker.bindPopup(text);
        });
    })
    .catch(function(error) {
        // handle error
        console.log(error);
    })
    .finally(function() {
        // always executed
    });

const form = document.getElementById("cashback-form");

form.addEventListener("submit", event => {
    event.preventDefault();
    const ristretto = document.querySelector("#ristretto").value;
    const espresso = document.querySelector("#espresso").value;
    const lungo = document.querySelector("#lungo").value;
    const headers = {
        "Content-Type": "application/json",
        Accept: "application/json"
    };
    const data = {
        Ristretto: ristretto,
        Espresso: espresso,
        Lungo: lungo
    };
    axios
        .post("http://coffeedrop.test/api/cashback", data, headers)
        .then(function(response) {
            console.log(response);
        })
        .catch(function(error) {
            console.log(error);
        });

    document.querySelector("#ristretto").value = "";
    document.querySelector("#espresso").value = "";
    document.querySelector("#lungo").value = "";
});
