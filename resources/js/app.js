require("./bootstrap");
const axios = require("axios");

const mymap = L.map("mapid").setView([54.3781, -2.436], 6);
const attribution =
    '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors';
const tileUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
const tiles = L.tileLayer(tileUrl, {
    attribution,
    maxZoom: 19
});

tiles.addTo(mymap);
const mymap2 = L.map("mapid-2").setView([54.3781, -2.436], 4);
const tiles2 = L.tileLayer(tileUrl, {
    attribution,
    maxZoom: 19
});
tiles2.addTo(mymap2);

const postcodeForm = document.getElementById("postcode-form");
postcodeForm.addEventListener("submit", event => {
    event.preventDefault();
    const postcode = document.querySelector("#postcode").value;

    const headers = {
        "Content-Type": "application/json",
        Accept: "application/json"
    };
    const data = {
        postcode: postcode
    };
    axios
        .post("/api/getnearestlocation", data, headers)
        .then(function(response) {
            const items = response.data.closestlocation;
            mymap2.setView(
                [items.geolocation.latitude, items.geolocation.longitude],
                13
            );
            const marker = L.marker([
                items.geolocation.latitude,
                items.geolocation.longitude
            ]).addTo(mymap2);
            let text = `<strong>${items.address.distrist}</strong><br><strong>${
                items.address.county
            }</strong><br><strong>${items.postcode}</strong><br>`;
            const hours = items.hours;
            hours.forEach(hour => {
                text += `${hour.day.toUpperCase()} : ${hour.open} - ${
                    hour.closed != "CLOSED" ? hour.closed : ""
                } <br>`;
            });
            marker.bindPopup(text);
            document.querySelector("#address").innerHTML = text;
        })
        .catch(function(error) {
            console.log(error);
        });

    document.querySelector("#postcode").value = "";
});

axios
    .get("/api/locations")
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
        .post("/api/cashback", data, headers)
        .then(function(response) {
            const amount = response.data.data.Cashback;
            document.querySelector(
                "#cashback-amount"
            ).innerHTML = `You will receive  £ ${amount}`;
            document.querySelector("#cashback-alert").classList.add("show");
        })
        .catch(function(error) {
            console.log(error);
        });

    document.querySelector("#ristretto").value = "";
    document.querySelector("#espresso").value = "";
    document.querySelector("#lungo").value = "";
});

const newshopForm = document.getElementById("newshop-form");
newshopForm.addEventListener("submit", event => {
    event.preventDefault();
    const postcode = document.querySelector("#postcode-1").value;
    const days = [
        "sunday",
        "monday",
        "tuesday",
        "wednesday",
        "thursday",
        "friday",
        "saturday"
    ];
    const opening_time = {};
    const closing_time = {};
    days.forEach((e, index) => {
        const open_time = document.getElementById(`day-open-${index}`).value;
        const close_time = document.getElementById(`day-close-${index}`).value;
        if (open_time !== null && open_time !== "") {
            opening_time[e] = open_time;
            closing_time[e] = close_time;
        }
    });
    const headers = {
        "Content-Type": "application/json",
        Accept: "application/json"
    };
    const data = {
        postcode: postcode,
        opening_times: opening_time,
        closing_times: closing_time
    };
    axios
        .post("/api/locations", data, headers)
        .then(function(response) {
            console.log(response);
        })
        .catch(function(error) {
            console.log(error);
        });

    document.querySelector("#postcode-1").value = "";
});
