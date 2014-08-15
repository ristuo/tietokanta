<div class="container">
    <h1>Tietokannassa olevat nostajat</h1>
    <h2>Miehet</h2>
    <?php if ($data[miehet] != null) : ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nimi</th>
                <th>Kansallisuus</th>
                <th>Syntymävuosi</th>
                <th>Seura</th>
            </tr>
        </thead>
        <tbody>
            
    <?php endif; ?>       
            <?php if ($data[miehet] == null) {
                echo 'Tietokannassa ei ole yhtään miesten sarjassa kilpailevaa nostajaa';
            }
            else { foreach($data[miehet] as $nostaja) {
            
                echo '<tr>';                
                echo '<td><a href=yksinostaja.php?hnro='.$nostaja->getHnro().'>'.$nostaja->getNimi().'</a></td>';
                echo '<td>'.$nostaja->getKansallisuus().'</td>';
                echo '<td>'.$nostaja->getSvuosi().'</td>';
                echo '<td>'.$nostaja->getSeura().'</td>';
                echo '</tr>';
                
                }
            }?>
               
         
        </tbody>
    </table>
    <h2>Naiset</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nimi</th>
                <th>Kansallisuus</th>
                <th>Syntymävuosi</th>
                <th>Seura</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data[naiset] == null){
                    echo 'Tietokannassa ei ole yhtään naisten sarjassa kilpailevaa nostajaa';
            }
            else { foreach($data[naiset] as $nostaja) {
                echo '<tr>';
                    echo '<td><a href=yksinostaja.php?hnro='.$nostaja->getHnro().'>'.$nostaja->getNimi().'</a></td>';
                    echo '<td>'.$nostaja->getKansalaisuus().'</td>';
                    echo '<td>'.$nostaja->getSvuosi().'</td>';
                    echo '<td>'.$nostaja->getSeura().'</td>';
                echo '</tr>';
                }
            }
            ?>
        </tbody>
        
        
    </table>
</div>