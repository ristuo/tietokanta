    
<!DOCTYPE = html>

<html>
    <?php require 'libs/head.php'; ?>

    <body>
        <?php require 'libs/ylavalikko.php'; ?>
        <div class="container">
            <h1>Tervetuloa painonnostotietokantaan</h1>        
            <h2>Hakutesti, tietokannan nostajat</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nimi</th>
                        <th>Syntymäpäivä</th>
                        <th>Kansallisuus</th>
                        <th>Seura</th>
                    </tr>
                </thead>
                <tbody>
        <?php
            require 'libs/tietokantayhteys.php';
            $yhteys = getTietokantayhteys();
            $sql = "SELECT * FROM nostaja";
            $kysely = $yhteys->prepare($sql);
            $kysely->execute();
            $rivit = $kysely->fetchAll(PDO::FETCH_OBJ);
            
            foreach ($rivit as $rivi) {
                echo '<tr>';
                echo '<td>' . $rivi->nimi . '</td>';
                echo '<td>' . $rivi->syntymapaiva . '</td>'; 
                echo '<td>' . $rivi->kansallisuus . '</td>';
                echo '<td>' . $rivi->seura . '</td>';
                echo '</tr>';
            }
            
            
        ?>                    
                </tbody>
            </table>

            
        </div>
    </body>
</html>

  