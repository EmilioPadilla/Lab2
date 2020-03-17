console.log("app.js is running.");

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
        <div class="input_field col s4 offset-s2">
          <input id="kg" type="number" class="validate" name="kg" required></input>
          <label for="kg">Peso en Kilogramos</label>
        </div>
        <div class="input_field col s4">
          <input id="cm" type="number" class="validate" name="cm" required></input>
          <label for="cm">Altura en centimetros</label>
        </div>
      </div>
      <div class="row">
        <div class="col s3 offset-s9">
          <input class="btn" type="submit" value="Calcular!"></input>
        </div>
      </div>
    </form>
  </div>

);
var appRoot = document.getElementById("app");
ReactDOM.render(form, appRoot);
