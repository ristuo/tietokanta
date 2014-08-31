    <h2>Lisää tuloksia</h2>
    <p>Huomaa, että tuloksia voi lisätä vain olemassaoleviin kilpailuihin ja jo kantaan lisätyille nostajille. Jos et löydä etsimääsi valikosta, lisää ensin kilpailun tai henkilön tiedot kilpailu tai nostaja -sivulla. </p>
    
    <form action="lisaaTuloksia.php" method="POST">
    <label>Kilpailu</label>
    <select name="kilnro">
    <?php foreach(Kilpailu::haeKaikkiNimet() as $kilpailu): ?>
        <option value="<?php echo $kilpailu->kilnro; ?>"><?php echo $kilpailu->nimi; ?></option>
    <?php endforeach; ?>
    </select>    
    
    <label>Nostaja</label>
    <select name="hnro">
    <?php foreach(Nostaja::haeKaikkiNimet() as $nostaja): ?>
        <option value="<?php echo $nostaja->hnro; ?>"><?php echo $nostaja->nimi; ?></option>
    <?php endforeach; ?>
    </select>

    <label>Painoluokka</label>
    <select name="painoluokka">
    <?php foreach(getPainoluokat() as $painoluokka): ?>
        <option value="<?php echo $painoluokka->painoluokka; ?>"><?php echo $painoluokka->painoluokka; ?></option>
    <?php endforeach; ?>    
    </select>
        
    <table class="table-hover">
        <tbody>
            <tr>
                <th>Tempaus</th>
                <?php $tulokset1 = $data['tempaukset']; $tulokset2 = $data['tyonnot']; ?>
                <td><input type="text" class="form-inline" id="input1tempaus"
                           name="1tempaus" placeholder="1. Nosto" <?php if (!empty($tulokset1[1])) {
                           echo "value='".$tulokset1[1]."'"; }; ?> ></td>
                <td><input type="text" class="form-inline" id="input2tempaus" name="2tempaus" placeholder="2. Nosto"
                           <?php if (!empty($tulokset1[2])) {
                           echo "value='".$tulokset1[2]."'"; }; ?>></td>
                <td><input type="text" class="form-inline" id="input3tempaus" name="3tempaus" placeholder="3. Nosto"
                           <?php if (!empty($tulokset1[3])) {
                           echo "value='".$tulokset1[3]."'"; }; ?>></td>
                
            </tr>
            <tr>
                <th>Työntö</th>
                <td><input type="text" class="form-inline" id="input1tyonto" name="1tyonto" placeholder="1. Nosto"
                           <?php if (!empty($tulokset2[1])) {
                           echo "value='".$tulokset2[1]."'"; }; ?>></td>
                <td><input type="text" class="form-inline" id="input2tyonto" name="2tyonto" placeholder="2. Nosto"
                           <?php if (!empty($tulokset2[2])) {
                           echo "value='".$tulokset2[2]."'"; }; ?>></td>
                <td><input type="text" class="form-inline" id="input3tyonto" name="3tyonto" placeholder="3. Nosto"
                           <?php if (!empty($tulokset2[3])) {
                           echo "value='".$tulokset2[3]."'"; }; ?>></td>
                
            </tr>            
        </tbody>

    </table>
    <button type="submit" class="btn btn-default">Lisää</button>
    </form>
    