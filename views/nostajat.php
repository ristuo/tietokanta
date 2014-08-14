<div class="container">
    <h1>Tietokannassa olevat nostajat</h1>
    <h2>Miehet</h2>
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
            <?php if (empty($data[miehet])) {
                echo 'Tietokannassa ei ole yhtään miesten sarjassa kilpailevaa nostajaa';
            }
            else { foreach($data[miehet] as $nostaja) {
            
                echo '<tr>';                
                echo '<td><a href=yksinostaja.php?hnro='.$nostaja->hnro.'>'.$nostaja->nimi.'</a></td>';
                echo '<td>'.$nostaja->kansallisuus.'</td>';
                echo '<td>'.$nostaja->syntymavuosi.'</td>';
                echo '<td>'.$nostaja->seura.'</td>';
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
            <?php if (empty($data[naiset])){
                    echo 'Tietokannassa ei ole yhtään naisten sarjassa kilpailevaa nostajaa';
            }
            else foreach($data[naiset] as $nostaja) {
                echo '<tr>';
                    echo '<td>'.$nostaja->nimi.'</td>';
                    echo '<td>'.$nostaja->kansalaisuus.'</td>';
                    echo '<td>'.$nostaja->syntymavuosi.'</td>';
                    echo '<td>'.$nostaja->seura.'</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
        
        
    </table>
</div>