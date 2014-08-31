<div class="container">

    <h1>Kaikki tietokannassa olevat kilpailut</h1>
    <?php if (onkoKirjauduttu()) : ?>
    <form class="btn" action="lisaaKilpailu.php" method="POST">
        <input type="submit" value="Lisää uusi kilpailu">
    </form> 
    <?php endif; ?>
    <?php if (empty($data[kilpailut])) {
        echo "Tietokannassa ei ole yhtään kilpailua";
        exit();
    } ?>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nimi</th>
                <th>Taso</th>
                <th>Päivämäärä</th>
                <th>Paikka</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data[kilpailut] as $kilpailu) {
                
                echo '<tr>';
                echo '<td><a href= yksikilpailu.php?kilnro='.$kilpailu->getKilnro().'>'.$kilpailu->getNimi().'</a></td>';
                echo "<td>".$kilpailu->getTaso()."</td>";
                echo "<td>".$kilpailu->getPaivamaara()."</td>";
                echo "<td>".$kilpailu->getPaikka()."</td>";
                
                if (onkoKirjauduttu()) {
                    echo '<form class="btn" action="muokkaaKilpailua.php" method="POST">';
                    echo '<input type="hidden" name="kilnro" value='.$kilpailu->getKilnro().'>';
                    echo '<td><button type="submit" class="btn btn-default">Muokkaa</button></td>';
                    echo '</form>';
                }
                
                
                
                if (onkoKirjauduttu()) {
                    echo '<form class="btn" action="poistaKilpailu.php" method="POST">';
                    echo '<input type="hidden" name="kilnro" value='.$kilpailu->getKilnro().'>';
                    echo '<td><button type="submit" class="btn btn-default">Poista</button></td>';
                    echo '</form>';
                }
                

                
             
                
                echo '</tr>';
            } ?>
        </tbody>
    </table>
    
    
</div>