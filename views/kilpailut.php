<div class="container">
    <h1>Kaikki tietokannassa olevat kilpailut</h1>
    <?php if ($data[kilpailut]==null) {
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
                echo '<td>'.$kilpailu->getNimi().'</td>';
                echo "<td>".$kilpailu->getTaso()."</td>";
                echo "<td>".$kilpailu->getPaivamaara()."</td>";
                echo "<td>".$kilpailu->getPaikka()."</td>";
                echo '</tr>';
            } ?>
        </tbody>
    </table>
    
    
</div>