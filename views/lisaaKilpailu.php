
<div class="container">
<h1>Lisää uusi kilpailu tietokantaan</h1>
<h2>Kilpailun tiedot</h2>
<form class="form-horizontal" role="form" action="lisaaKilpailu.php" method="POST">
    <div class="form-group">
        <label for="inputname" class="col-md-2 control-label">Nimi</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputname" name="nimi"
                   <?php if (empty($data['nimi'])) {
                       echo "placeholder='Kilpailun nimi'";
                   }
                   else {
                       echo "value='".$data['nimi']."'";
                   } ?>>
        </div>


        
        
        
        <label for="inputpaiva" class="col-md-2 control-label">Päivämäärä</label>
        <div class="col-md-10">
            <input type="date" class="form-control" id="inputpaiva" name="paivamaara" 
                   <?php if (empty($data['paivamaara'])) {
                       echo "placeholder='YYYY-MM-DD, esim. 1989-11-25'";
                   }
                   else {
                       echo "value='".$data['paivamaara']."'";
                   }
                   ?> >
        </div>
        
        <label for="inputpaikka" class="col-md-2 control-label">Paikka</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputpaikka" name="paikka"
                   
                   <?php if (empty($data['paikka'])) {
                       echo "placeholder='Kilpailun paikka'";
                   }
                   
                   else {
                       echo "value='".$data['paikka']."'";
                       
                   }?> >
        </div>    
        
        
        
        
                <label for="inputtaso" class="col-md-2 control-label">Taso</label>
        <div class="col-md-10">    
        <select name="taso" id="inputtaso">
            <option value="Olympialaiset">Olympialaiset</option>
            <option value="Piirikunnallinen">Piirikunnallinen</option>
            <option value="SM">SM</option>
            <option value="Epävirallinen">Epävirallinen</option>

        </select>
        </div>  
        
        
        
        
        
        </div>
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default">Lisää</button>
        </div>        
    
        </form>

</div>
