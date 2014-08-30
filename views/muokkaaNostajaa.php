
<?php $muokattavanostaja = $data['nostaja']; ?>
<div class="container">
<h1>Muokkaa nostajan <?php echo $muokattavanostaja->getNimi(); ?> tietoja</h1>
<form class="form-horizontal" role="form" action="muokkaaNostajaa.php" method="POST">
    <div class="form-group">
        <label for="inputname" class="col-md-2 control-label">Nimi</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputname" name="nimi" value="<?php echo $muokattavanostaja->getNimi() ?>">
        </div>
        
        <input type="hidden" name="hnro" value='<?php echo $muokattavanostaja->getHnro() ?>'>
        
        <label for="inputseura" class="col-md-2 control-label">Seura</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputseura" name="seura" value='<?php echo $muokattavanostaja->getSeura() ?>'>
        </div>
        
        <label for="inputsyntymavuosi" class="col-md-2 control-label">Syntymävuosi</label>
        <div class="col-md-10">
            <input type="date" class="form-control" id="inputsyntymavuosi" name="syntymavuosi" value='<?php echo $muokattavanostaja->getSvuosi() ?>'>
        </div>
        
        <label for="inputkansalaisuus" class="col-md-2 control-label">Kansalaisuus</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputkanlaisuus" name="kansallisuus" value="<?php echo $muokattavanostaja->getKansallisuus() ?>">
        </div>    
        
        <label for="inputsukupuoli" class="col-md-2 control-label">Sukupuoli</label>
        <div class="col-md-10">    
        <select name="sukupuoli" id="inputsukupuoli">
            <option value="mies" <?php if ($muokattavanostaja->getSukupuoli()==='mies') {echo "select="."'"."selected"."'";}; ?>>Mies</option>
            <option value="nainen" <?php if ($muokattavanostaja->getSukupuoli()==='nainen') { 
                echo "selected="."'"."selected"."'";
                } ;?>>Nainen</option>
           
        </select>
        </div>
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default">Muokkaa</button>
        </div>        
    </div>
</form>