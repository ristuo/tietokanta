
<div class="container">
<h1>Muokkaa kilpailua <?php echo $data['nimi']; ?></h1>
<form class="form-horizontal" role="form" action="muokkaaKilpailua.php" method="POST">
    <div class="form-group">
        <label for="inputname" class="col-md-2 control-label">Nimi</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputname" name="nimi"
                  value="<?php echo $data['nimi']; ?>">
        </div>

       
        
        
        <input type="hidden" name="kilnro" value='<?php echo $data['kilnro']; ?>'>

        <label for="inputpaivamaara" class="col-md-2 control-label">Päivämäärä</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputpaivamaara" name="paivamaara" value="<?php echo $data['paivamaara'];?>">
        </div>
        
        <label for="inputpaikka" class="col-md-2 control-label">Paikka</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputpaikka" name="paikka" value="<?php echo $data['paikka']; ?>">
        </div>    

        

        <label for="inputtaso" class="col-md-2 control-label">Taso</label>
        <div class="col-md-10">    
        <select name="taso" id="inputtaso">
            <option value="Olympialaiset"<?php if ($data['taso']==='Olympialaiset') {echo "select="."'"."selected"."'";}; ?>>Olympialaiset</option>
            <option value="Piirikunnallinen"<?php if ($data['taso']==='Piirikunnallinen') {echo "select="."'"."selected"."'";}; ?>>Piirikunnallinen</option>
            <option value="SM"<?php if ($data['taso']==='SM') {echo "select="."'"."selected"."'";}; ?>>SM</option>
            <option value="Epävirallinen"<?php if ($data['taso']==='Epävirallinen') {echo "select="."'"."selected"."'";}; ?>>Epävirallinen</option>

        </select>        
        
        
        
        </div>
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default">Muokkaa</button>
        </div>        
    
        </form>

</div>

