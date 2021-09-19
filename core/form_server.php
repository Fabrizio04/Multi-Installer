<?php require_once 'menu.php'; ?>

<div style="padding: 0px;padding-top: 4.4rem;text-align:center;">

<form method="POST" id="formsetup" name="formsetup">

<h1>Impostazioni Server</h1>

<input type="url" id="percorsoWeb" title="URL Web App" name="percorsoWeb" placeholder="URL Web App - Esempio: http://192.168.1.75/installer/" size="30" value="<?php echo $percorsoWeb; ?>" required>
<br>
<input type="text" id="percorsoRep" title="Share File Path" name="percorsoRep" placeholder="Share File Path - Esempio: \\192.168.1.75\files" size="30" pattern="[\\]+[\\]+[a-z0-9\.]+\\[a-z0-9.-]+" value="<?php echo $repository; ?>" required><br>

<br>

<select name="lettera" id="lettera" required title="Assegna lettera">
  <option value disabled>Assegna lettera</option>
  <?php
  $ar = array("A","B","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y");
  
  for($i = 22; $i >= 0; $i--){
	  
	  if($lettera == $ar[$i]) $selected = ' selected="selected"';
	  else $selected = '';
		  
	  echo '<option value="'.$ar[$i].'"'.$selected.'>'.$ar[$i].':</option>';
  }
  
  ?>
</select>

<br>

<?php
if($username != "") $password = "psw";
?>

<input title="Username Share" type="text" id="userServer" name="userServer" placeholder="Username Share" size="30" value="<?php echo $username; ?>">

<br>

<input title="Password Share" type="password" id="passServer" name="passServer" placeholder="Password Share" size="30" value="<?php echo $password; ?>">

<br><br>

<table border align="center">

<tr onclick="seleziona_check('slog','log')" title="Abilita log sulle richieste dei setup">
<td>
<div class="container">
  Log Richieste Setup
  <input type="checkbox" id="slog"<?php echo $check1; ?>>
  <span class="checkmark" id="log" style="background-color:<?php echo $color1; ?>;"></span>
</div>
</td>
</tr>

<tr onclick="seleziona_check('spul','pul')" title="Abilita pulizia automatica dei file setup dopo tot gg">
<td>
<div class="container">
  Pulizia Auto Setup
  <input type="checkbox" id="spul"<?php echo $check2; ?>>
  <span class="checkmark" id="pul" style="background-color:<?php echo $color2; ?>;"></span>
</div>
</td>
</tr>

<tr id="ggdel" onclick="document.getElementById('gg').focus();" title="Numero gg" style="display:<?php echo $display; ?>;">
<td>
<input type="number" id="gg" value="<?php echo $del; ?>" title="Numero gg">
</td>
</tr>

</table>

<br>

<button type="submit" id="sendForm">Aggiorna</button>

</form>

<p style="color:green;" id="messaggio"></p>

<script src="./js/form_server.js"></script>

</div>