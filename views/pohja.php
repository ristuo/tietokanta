<!DOCTYPE html>
<html>
    <head>
        <title> Painonnostotietokanta</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
    
    
    </head>
    <body>
        <ul class="nav nav-tabs">
            <li class="active"> <a href="index.php"> etusivu </a></li>
            <li class="active"> <a href="kilpailut.php"> kilpailut </a></li>
            <li class="active"> <a href="nostajat.php"> nostajat </a></li>
            <?php if (!onkoKirjauduttu()) { echo '<li class="active"> <a href="login.php"> kirjaudu </a></li>';} ?>
            <?php if (onkoKirjauduttu()) { echo '<li class="active"> <a href="lisaaTuloksia.php"> Päivitä kisatuloksia </a></li>';} ?>
            <?php if (onkoKirjauduttu()) { echo '<li class="active"> <a href="logout.php"> Kirjaudu ulos </a></li>';} ?>
        
        </ul>
        <?php if (!empty($data['virhe'])): ?>
            <?php foreach($data['virhe'] as $virhe) : ?>
            <div class="alert alert-danger"><?php echo $virhe; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if (!empty($data['onnistuminen'])) : ?>
            <div class="alert alert-success"><?php echo $data['onnistuminen'] ?></div>    
        <?php endif; ?>
        <?php if (!empty($_SESSION['ilmoitus'])) : ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['ilmoitus']; unset($_SESSION['ilmoitus']); ?>
            </div>
        <?php endif; ?>    
        <?php require 'views/'.$sivu.'.php'; ?>
            
    </body>
    </head>
</html>