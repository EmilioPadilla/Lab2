"use strict";

console.log("app.js is running.");

var form = React.createElement(
  "div",
  { "class": "row" },
  React.createElement(
    "form",
    { "class": "col s12", method: "POST", action: "index.php" },
    React.createElement(
      "div",
      { "class": "row" },
      React.createElement(
        "div",
        { "class": "input-field col s4" },
        React.createElement(
          "i",
          { "class": "material-icons prefix" },
          "account_circle"
        ),
        React.createElement("input", { id: "first_name", type: "text", "class": "validate", name: "first_name", required: true }),
        React.createElement(
          "label",
          { "for": "first_name" },
          "First Name"
        )
      ),
      React.createElement(
        "div",
        { "class": "input-field col s5" },
        React.createElement("input", { id: "last_name", type: "text", "class": "validate", name: "last_name", required: true }),
        React.createElement(
          "label",
          { "for": "last_name" },
          "Last Name"
        )
      ),
      React.createElement(
        "div",
        { "class": "input-field col s3" },
        React.createElement(
          "i",
          { "class": "material-icons prefix" },
          "phone"
        ),
        React.createElement("input", { id: "icon_telephone", type: "tel", "class": "validate", name: "telephone", required: true }),
        React.createElement(
          "label",
          { "for": "icon_telephone" },
          "Telephone"
        )
      )
    ),
    React.createElement(
      "div",
      { "class": "row" },
      React.createElement(
        "div",
        { "class": "input_field col s4 offset-s2" },
        React.createElement("input", { id: "kg", type: "number", "class": "validate", name: "kg", required: true }),
        React.createElement(
          "label",
          { "for": "kg" },
          "Peso en Kilogramos"
        )
      ),
      React.createElement(
        "div",
        { "class": "input_field col s4" },
        React.createElement("input", { id: "cm", type: "number", "class": "validate", name: "cm", required: true }),
        React.createElement(
          "label",
          { "for": "cm" },
          "Altura en centimetros"
        )
      )
    ),
    React.createElement(
      "div",
      { "class": "row" },
      React.createElement(
        "div",
        { "class": "col s3 offset-s9" },
        React.createElement("input", { "class": "btn", type: "submit", value: "Calcular!" })
      )
    )
  )
);
var appRoot = document.getElementById("app");
ReactDOM.render(form, appRoot);
