
<div class="container">
<?php $kilpailu = $data['kilpailu']; ?>
<h1>Muokaa kilpailua <?php echo $kilpailu->getNimi(); ?></h1>
<form class="form-horizontal" role="form" action="muokkaaKilpailua.php" method="POST">
    <div class="form-group">
        <label for="inputname" class="col-md-2 control-label">Nimi</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputname" name="nimi"
                  value="<?php echo $kilpailu->getNimi(); ?>">
        </div>

       
        
        <label for="inputtaso" class="col-md-2 control-label">Taso</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputtaso" name="taso" value="<?php echo $kilpailu->getTaso();?>">
        </div>

        
        <input type="hidden" name="kilnro" value='<?php echo $kilpailu->getKilnro(); ?>'>

        <label for="inputpaiva" class="col-md-2 control-label">Päivämäärä</label>
        <div class="col-md-10">
            <input type="date" class="form-control" id="inputpaiva" name="paivamaara" value="<?php echo $kilpailu->getPaivamaara();?>">
        </div>
        
        <label for="inputpaikka" class="col-md-2 control-label">Paikka</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputpaikka" name="paikka" value="<?php echo $kilpailu->getPaikka(); ?>">
        </div>    
        
        </div>
        <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-default">Muokkaa</button>
        </div>        
    
        </form>

</div>

