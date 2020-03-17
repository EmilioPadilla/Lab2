"use strict";

console.log("app.js is running.");

var template2 = React.createElement(
  "div",
  null,
  React.createElement(
    "h1",
    null,
    "Hello Emilio!"
  ),
  React.createElement(
    "p",
    null,
    "Age: 21"
  ),
  React.createElement(
    "p",
    null,
    "You must be from Irapuato, Gto.!"
  )
);
var appRoot = document.getElementById("app");
ReactDOM.render(template2, appRoot);
