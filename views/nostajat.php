<div class="container">
    <h1>Tietokannassa olevat nostajat</h1>
    <form class="form-search" role="form" action="nostajat.php" method="POST">
        <input type="text" class="input-medium search-query" placeholder="Hae nimellä" name="hakunimi">
        <button type="submit" class="btn">Hae</button>
    </form>
    
    <?php if (onkoKirjauduttu()) : ?>
    <form class="btn" action="lisaa.php" method="POST">
        <input type="submit" value="Lisää uusi nostaja">
    </form>
    <?php endif; ?>
    <?php if (!$data['hakutehty']) : ?>
    <h2>Miehet</h2>
    <?php if (!empty($data['miehet'])) : ?>
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
            <?php if (empty($data['miehet'])) {
                echo 'Tietokannassa ei ole yhtään miesten sarjassa kilpailevaa nostajaa';
            }
            else { foreach($data['miehet'] as $nostaja) {
            
                echo '<tr>';                
                echo '<td><a href=yksinostaja.php?hnro='.$nostaja->getHnro().'>'.$nostaja->getNimi().'</a></td>';
                echo '<td>'.$nostaja->getKansallisuus().'</td>';
                echo '<td>'.$nostaja->getSvuosi().'</td>';
                echo '<td>'.$nostaja->getSeura().'</td>';
                if (onkoKirjauduttu()) {
                    echo '<form class="btn" action="muokkaaNostajaa.php" method="POST">';
                    echo '<input type="hidden" name="hnro" value='.$nostaja->getHnro().'>';
                    echo '<td><button type="submit" class="btn btn-default">Muokkaa</button></td>';
                    echo '</form>';
                }
                
                if (onkoKirjauduttu()) {
                    echo '<form class="btn" action="poistaNostaja.php" method="POST">';
                    echo '<input type="hidden" name="hnro" value='.$nostaja->getHnro().'>';
                    echo '<td><button type="submit" class="btn btn-default">Poista</button></td>';
                    echo '</form>';
                }
                
                echo '</tr>';
                
                }
            }?>
               
         
        </tbody>
    </table>
    <h2>Naiset</h2>
   <?php if ($data['naiset']!= null) : ?> 
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
            <?php if ($data['naiset'] == null){
                    echo 'Tietokannassa ei ole yhtään naisten sarjassa kilpailevaa nostajaa';
            }
            else { foreach($data['naiset'] as $nostaja) {
                echo '<tr>';
                    echo '<td><a href=yksinostaja.php?hnro='.$nostaja->getHnro().'>'.$nostaja->getNimi().'</a></td>';
                    echo '<td>'.$nostaja->getKansallisuus().'</td>';
                    echo '<td>'.$nostaja->getSvuosi().'</td>';
                    echo '<td>'.$nostaja->getSeura().'</td>';
                    if (onkoKirjauduttu()) {
                        echo '<form class="btn" action="muokkaaNostajaa.php" method="POST">';
                        echo '<input type="hidden" name="hnro" value='.$nostaja->getHnro().'>';
                        echo '<td><button type="submit" class="btn btn-default">Muokkaa</button></td>';
                        echo '</form>';
                    }
                if (onkoKirjauduttu()) {
                    echo '<form class="btn" action="poistaNostaja.php" method="POST">';
                    echo '<input type="hidden" name="hnro" value='.$nostaja->getHnro().'>';
                    echo '<td><button type="submit" class="btn btn-default">Poista</button></td>';
                    echo '</form>';
                }                    
                    
                    
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
        
        
    </table>
    <?php endif; ?>
    <?php if ($data['hakutehty']) : ?>
        <?php if ($data['haetut']==null) : ?>
            <h2>Ei löytynyt yhtään nostajaa<h2>
        <?php exit(); endif; ?>
        
   <?php if ($data['haetut']!=null) ?>
    <table class="table table-striped">                
        <thead>
            <tr>
                <th>Nimi</th>
                <th>Sukupuoli</th>
                <th>Kansallisuus</th>
                <th>Syntymävuosi</th>
                <th>Seura</th>
            </tr>
        </thead>
        <?php foreach ($data[haetut] as $haettu) : ?>
        <tbody>
            <tr>
                <td><a href=yksinostaja.php?hnro=<?php echo $haettu->getHnro()?>><?php echo $haettu->getNimi()?> </a></td>
                <td><?php echo $haettu->getSukupuoli() ?></td>
                <td><?php echo $haettu->getKansallisuus() ?></td>
                <td><?php echo $haettu->getSvuosi() ?></td>
                <td><?php echo $haettu->getSeura() ?></td>
            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
   </div>