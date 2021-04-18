"use strict";
// {index : { name : { color : time, ...}}}
var shiftObj = {
    "1" : {
        "Sân số 1": [
            {"1" : "10:00-12:30"},
            {"1" : "13:00-14:00"},
            {"1" : "17:00-20:00"},
        ]
    },
    "2" : {
        "Sân số 2": [
            {"3" : "11:00-12:45"},
            {"5" : "14:00-19:30"},
        ]
    },
    "3" : {
        "Sân số 3": [
            {"8" : "13:00-19:00"}
        ]
    },
    "4" : {
        "Sân số 4": [
            {"1" : "10:00-12:00"},
            {"2" : "13:00-14:00"},
            {"9" : "17:00-20:00"},
        ]
    },
    "5" : {
        "Sân số 5": [
            {"8" : "10:00-13:30"},
            {"7" : "14:00-17:30"},
        ]
    },
    "6" : {
        "Sân số 6": [
            {"1" : "12:00-15:30"}
        ]
    },
    "7" : {
        "Sân số 7": [
            {"0" : "15:00-22:30"}
        ]
    },
    "8" : {
        "Sân số 8": [
            {"9" : "15:00-18:30"}
        ]
    }
};
var obj = {
    // Beginning Time
    startTime: "05:00",
    // Ending Time
    endTime: "20:00",
    // Time to divide(minute)
    divTime: "15",
    // Time Table
    shift: shiftObj,
    // Other options
    option: {
        // workTime include time not displaying
        workTime: true,
        bgcolor: ["#00FFFF"],
        // {index :  name, : index: name,,..}
        // selectBox index and shift index should be same
        // Give randome if shift index was not in selectBox index
        // selectBox: {
            // "35" : "Jason Paige",
            // "18" : "Mr.Jason",
            // "25" : "Mrs.Jason",
            // "38" : "A",
            // "39" : "B",
            // "40" : "C"
        // },
        // Set true when using TimeTable inside of BootStrap class row
        useBootstrap: false,
    }
};
// Call Time Table
var instance = new TimeTable(obj);
console.time("time"); // eslint-disable-line
instance.init("#test");
console.timeEnd("time");// eslint-disable-line

// Only works if selectBox option exist
$(document).on("click", "#addRow",()=>{instance.addRow();});

// Change theme color sample
$(document).on("click","#colorChange", ()=>{
    let color = `${getColor()},${getColor()},${getColor()}`;
    document.documentElement.style.setProperty("--rgbTheme", color);
});
function getColor(){
    return Math.floor(Math.random() * Math.floor(255));
}
// Getting Data Sample
$(document).on("click","#getData", ()=>{
    let data = instance.data();
    console.log(data);
});
