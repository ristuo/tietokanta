<div class="container">
    <h1><?php echo $data[nostaja]->getNimi(); ?></h1>
    <p>Syntymäpäivä: <?php echo $data['nostaja']->getSvuosi() ?></p>
    <p>Seura: <?php echo $data['nostaja']->getSeura() ?></p>
    <p>Kansallisuus: <?php echo $data['nostaja']->getKansallisuus() ?></p>
    <h2>Kilpailijan kaikki nostot</h2>
    
    
    <?php if ($data[tempaukset] == null) : ?>
        <p> Kilpailija ei ole osallistunut yhteenkään kilpailuun </p>
    <?php endif; ?>
        
    <?php if ($data[tempaukset] != null) : ?>
        <h3>Tempaus</h3>
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tulos</th>
                        <th>Painoluokka</th>
                        <th>Kilpailu</th>
                        <th>Noston järjestysnumero</th>
                    </tr>
                </thead>
           
                <tbody>
            <?php foreach($data[tempaukset] as $tempausTulokset) {
                echo "<tr>";
                echo "<td>".$tempausTulokset->getTulos()."</td>";
                echo "<td>".$tempausTulokset->getPainoluokka()."</td>";
                echo "<td>".$tempausTulokset->getKilpailunnimi()."</td>";
                echo "<td>".$tempausTulokset->getJarjestysnumero()."</td>";
                echo "</tr>";
            } ?>
                </tbody>
            </table>
        
    <?php endif; ?>
            
    
    
        <?php if ($data[tyonnot] != null) : ?>
        <h3>Työntö</h3>    
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tulos</th>
                        <th>Painoluokka</th>
                        <th>Kilpailu</th>
                        <th>Noston järjestysnumero</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data[tyonnot] as $tyontoTulokset){
                        echo "<tr>";
                        echo "<td>".$tyontoTulokset->getTulos()."</td>";
                        echo "<td>".$tyontoTulokset->getPainoluokka()."</td>";
                        echo "<td>".$tyontoTulokset->getKilpailunnimi()."</td>";
                        echo "<td>".$tyontoTulokset->getJarjestysnumero()."</td>";
                        echo "</tr>";    
                    }
                    ?>
                    
                </tbody>
        </table>        
                
        <?php endif; ?>
        
</div>