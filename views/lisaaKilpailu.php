
<div class="container">
<h1>Lisää uusi kilpailu tietokantaan</h1>
<h2>Kilpailun tiedot</h2>
<form class="form-horizontal" role="form" action="lisaaKilpailu.php" method="POST">
    <div class="form-group">
        <label for="inputname" class="col-md-2 control-label">Nimi</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputname" name="nimi" placeholder='Kilpailun nimi'>
        </div>

       
        
        <label for="inputtaso" class="col-md-2 control-label">Taso</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputtaso" name="taso" placeholder='Kilpailun taso'>
        </div>
        
        <label for="inputpaiva" class="col-md-2 control-label">Päivämäärä</label>
        <div class="col-md-10">
            <input type="date" class="form-control" id="inputpaiva" name="paivamaara" placeholder='YYYY-MM-DD, esim. 1989-11-25'>
        </div>
        
        <label for="inputpaikka" class="col-md-2 control-label">Paikka</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputpaikka" name="paikka" placeholder='Kilpailun paikka'>
        </div>    
        
        </div>
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default">Lisää</button>
        </div>        
    
        </form>

</div>
