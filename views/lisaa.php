
<div class="container">
<h1>Lisää uusi nostaja tietokantaan</h1>
<form class="form-horizontal" role="form" action="lisaa.php" method="POST">
    <div class="form-group">
        <label for="inputname" class="col-md-2 control-label">Nimi</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputname" name="nimi" placeholder='Erkki Esimerkki'>
        </div>

       
        
        <label for="inputseura" class="col-md-2 control-label">Seura</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputseura" name="seura" placeholder='Joku seura'>
        </div>
        
        <label for="inputsyntymapaiva" class="col-md-2 control-label">Syntymäpäivä</label>
        <div class="col-md-10">
            <input type="date" class="form-control" id="inputsyntymapaiva" name="syntymapaiva" placeholder='YYYY-MM-DD, esim. 1989-11-25'>
        </div>
        
        <label for="inputkansalaisuus" class="col-md-2 control-label">Kansalaisuus</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputkanlaisuus" name="kansallisuus" placeholder='Suomi'>
        </div>    
        
        <label for="inputsukupuoli" class="col-md-2 control-label">Sukupuoli</label>
        <div class="col-md-10">    
        <select name="sukupuoli" id="inputsukupuoli">
            <option value="mies">Mies</option>
            <option value="nainen">Nainen</option>
        </select>
        </div>
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default">Lisää</button>
        </div>        
    </div>
</form>