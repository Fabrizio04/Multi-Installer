<?php require_once 'menu.php'; ?>

<div style="padding: 0px;padding-top: 4.4rem;text-align:center;">

<form method="POST" id="formsetup" name="formsetup">

<h1>Impostazioni Setup</h1>

<table border align="center">
<tr onclick="seleziona_check('suac','uac')" title="Abilita il controllo account utente (opzione consigliata)">

<td>
<div class="container">
  Controllo UAC
  <input type="checkbox" id="suac">
  <span class="checkmark" id="uac"></span>
</div>
</td>
</tr>

<tr onclick="seleziona_check('scon','conn')" title="Abilita la connessione automatica al server repository">

<td>

<div class="container">
  Connessione Auto
  <input type="checkbox" id="scon">
  <span class="checkmark" id="conn"></span>
</div>

</td>

</tr>

</table>

<h2>Tipo di File</h2>

<table border align="center">
<tr>

<td title="File .exe" onclick="seleziona('exe')" id="2" style="background-color:<?php echo $style2; ?>"><img src="img/exe.png"></td>
<td title="File .bat" onclick="seleziona('bat')" id="1" style="background-color:<?php echo $style1; ?>"><img src="img/cmd.png"></td>

</tr>
</table>

<input type="radio" name="fil" id="bat" value="bat" <?php echo $check1; ?>>
<input type="radio" name="fil" id="exe" value="exe" <?php echo $check2; ?>>

<h2>Architettura</h2>

<table border align="center">
<tr>

<td title="Auto" onclick="seleziona('auto2')" id="4" style="background-color:<?php echo $styleS4; ?>"><img src="img/auto.png"></td>
<td title="32 bit" onclick="seleziona('32')" id="5" style="background-color:<?php echo $styleS5; ?>"><img src="img/32.png"></td>
<td title="64 bit" onclick="seleziona('64')" id="6" style="background-color:<?php echo $styleS6; ?>"><img src="img/64.png"></td>

</tr>
</table>

<input type="radio" name="arch" id="auto2" value="auto" required <?php echo $checkA1; ?>>
<input type="radio" name="arch" id="32" value="32" <?php echo $checkA2; ?>>
<input type="radio" name="arch" id="64" value="64" <?php echo $checkA3; ?>>

<br>
<button type="submit">Aggiorna</button>

</form>

<p style="color:green;" id="messaggio"></p>

<script src="./js/form_setup.js"></script>

</div>