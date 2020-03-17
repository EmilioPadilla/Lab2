console.log("app.js is running.");

var template2 = (
  <div>
    <h1>Hello Emilio!</h1>
    <p>Age: 21</p>
    <p>You must be from Irapuato, Gto.!</p>
  </div>
);

var form = (
  <div class="row">
    <form class="col s12" method="POST" action="index.php">
      <div class="row">
        <div class="input-field col s4">
          <i class="material-icons prefix">account_circle</i>
          <input id="first_name" type="text" class="validate" name="first_name" required></input>
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s5">
          <input id="last_name" type="text" class="validate" name="last_name" required></input>
          <label for="last_name">Last Name</label>
        </div>
        <div class="input-field col s3">
          <i class="material-icons prefix">phone</i>
          <input id="icon_telephone" type="tel" class="validate" name="telephone" required></input>
          <label for="icon_telephone">Telephone</label>
        </div>
      </div>
      <div class="row">
        <div class="col s3 offset-s9">
          <input class="btn" type="submit" value="Match!"></input>
        </div>
      </div>
    </form>
  </div>

);
var appRoot = document.getElementById("app");
ReactDOM.render(form, appRoot);
