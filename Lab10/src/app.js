console.log("app.js is running.");

var template2 = (
  <div>
    <h1>Hello Emilio!</h1>
    <p>Age: 21</p>
    <p>You must be from Irapuato, Gto.!</p>
  </div>
);
var appRoot = document.getElementById("app");
ReactDOM.render(template2, appRoot);
