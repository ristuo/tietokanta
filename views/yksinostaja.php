<div class="container">
    <h1><?php echo $data[nostaja]->getNimi(); ?></h1>
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
            <?php foreach($data[tempaukset] as $tempaus) {
                echo "<tr>";
                echo "<td>".$tempaus->getTulos()."</td>";
                echo "<td>".$tempaus->getPainoluokka()."</td>";
                echo "<td>".$tempaus->getKilpailunnimi()."</td>";
                echo "<td>".$tempaus->getJarjestysnumero()."</td>";
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
                    <?php foreach($data[tyonnot] as $tyonto){
                        echo "<tr>";
                        echo "<td>".$tyonto->getTulos()."</td>";
                        echo "<td>".$tyonto->getPainoluokka()."</td>";
                        echo "<td>".$tyonto->getKilpailunnimi()."</td>";
                        echo "<td>".$tyonto->getJarjestysnumero()."</td>";
                        echo "</tr>";    
                    }
                    ?>
                    
                </tbody>
        </table>        
                
        <?php endif; ?>
        
</div>