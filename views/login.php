<div class="container">
    <h1>Kirjautuminen</h1>
    <form class="form-horizontal" role="form" action="login.php" method="POST">
      <div class="form-group">
        <label for="inputEmail1" class="col-md-2 control-label">Sähköposti</label>
        <div class="col-md-10">
          <input type="email" class="form-control" id="inputEmail1" name="email" placeholder= 
              <?php if (!empty($data['kayttaja'])) {
                  echo $data['kayttaja'];
              }
                else  echo 'Sähköposti';  ?> >
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword1" class="col-md-2 control-label">Salasana</label>
        <div class="col-md-10">
          <input type="password" class="form-control" id="inputPassword1" name="password" placeholder="Password">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <div class="checkbox">
            <label>
              <input type="checkbox"> Muista kirjautuminen
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default">Kirjaudu sisään</button>
        </div>
      </div>
    </form>
  </div>