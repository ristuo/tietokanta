
<div class="container">
<h1>Muokkaa nostajan <?php echo $data['nimi']; ?> tietoja</h1>
<form class="form-horizontal" role="form" action="muokkaaNostajaa.php" method="POST">
    <div class="form-group">
        <label for="inputname" class="col-md-2 control-label">Nimi</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputname" name="nimi" value="<?php echo $data['nimi']; ?>">
        </div>
        
        <input type="hidden" name="hnro" value='<?php echo $data['hnro'] ?>'>
        
        <label for="inputseura" class="col-md-2 control-label">Seura</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputseura" name="seura" value='<?php echo $data['seura']; ?>'>
        </div>
        
        <label for="inputsyntymavuosi" class="col-md-2 control-label">Syntymävuosi</label>
        <div class="col-md-10">
            <input type="date" class="form-control" id="inputsyntymavuosi" name="syntymavuosi" value='<?php echo $data['svuosi']; ?>'>
        </div>
        
        <label for="inputkansalaisuus" class="col-md-2 control-label">Kansalaisuus</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputkanlaisuus" name="kansallisuus" value="<?php echo $data['kansallisuus']; ?>">
        </div>    
        
        <label for="inputsukupuoli" class="col-md-2 control-label">Sukupuoli</label>
        <div class="col-md-10">    
        <select name="sukupuoli" id="inputsukupuoli">
            <option value="mies" <?php if ($data['sukupuoli']==='mies') {echo "select="."'"."selected"."'";}; ?>>Mies</option>
            <option value="nainen" <?php if ($data['sukupuoli']==='nainen') { 
                echo "selected="."'"."selected"."'";
                } ;?>>Nainen</option>
           
        </select>
        </div>
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default">Muokkaa</button>
        </div>        
    </div>
</form>