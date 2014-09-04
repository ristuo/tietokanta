<?php $kilpailuntiedot = $data['kilpailuntiedot']; $tuloksetmiehet = $data['tuloksetmiehet'];
$painoluokat = $data['painoluokat']; $tuloksetnaiset=$data['tuloksetnaiset']; ?>

<div class="container">
    <h1><?php echo $kilpailuntiedot->getNimi()." ".$kilpailuntiedot->getPaivamaara(); ?></h1>
    <?php $i = 0; ?>
    <?php foreach ($painoluokat as $painoluokka) : ?>
    <h2>Miehet, <?php echo $painoluokka->painoluokka; ?></h2>
    <?php if (empty($tuloksetmiehet[$i])) { echo "Painoluokassa ei ollut yhtään kilpailijaa"; } ?>
    <?php if (!empty($tuloksetmiehet[$i])) : ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nimi</th>
                <th>Yhteistulos</th>
                <th>Sija</th>
            </tr>
        </thead>
        <tbody>
    <?php $sija=1; ?>
    <?php foreach ($tuloksetmiehet[$i] as $tulos) : ?>
            <tr>
                <td><a href=yksinostaja.php?hnro=<?php echo $tulos->hnro; ?>> <?php echo $tulos->nimi; ?></a></td>   
                <td><?php echo $tulos->yt ?> kg</td>
                <td><?php echo $sija ?></td>
            </tr>
    <?php $sija++; ?>

    <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    <?php $i++; ?>
    <?php endforeach; ?>

    
    
    
    <?php $i = 0; ?>
    <?php foreach ($painoluokat as $painoluokka) : ?>
    <h2>Naiset, <?php echo $painoluokka->painoluokka; ?></h2>
    <?php if (empty($tuloksetnaiset[$i])) { echo "Painoluokassa ei ollut yhtään kilpailijaa"; } ?>
    <?php if (!empty($tuloksetnaiset[$i])) : ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nimi</th>
                <th>Yhteistulos</th>
                <th>Sija</th>
            </tr>
        </thead>
        <tbody>
    <?php $sija=1; ?>
    <?php foreach ($tuloksetnaiset[$i] as $tulos) : ?>
            <tr>
                <td><a href=yksinostaja.php?hnro=<?php echo $tulos->hnro; ?>> <?php echo $tulos->nimi; ?></a></td>   
                <td><?php echo $tulos->yt ?> kg</td>
                <td><?php echo $sija ?></td>
            </tr>
    <?php $sija++; ?>

    <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    <?php $i++; ?>
    <?php endforeach; ?>
    
</div>