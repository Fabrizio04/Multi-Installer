<?php require_once 'menu.php'; ?>

<div style="padding: 0px;padding-top: 4.4rem;text-align:center;">

<form method="POST" id="formsetup" name="formsetup">

<h1>Firma Digitale</h1>

<table border align="center">
<tr onclick="seleziona_check('ssign','sign')" title="Abilita il controllo account utente (opzione consigliata)">

<td>
<div class="container">
  Firma file .EXE
  <input type="checkbox" id="ssign"<?php echo $checked; ?>>
  <span class="checkmark" id="sign"></span>
</div>
</td>
</tr>

</table>

<br>
<button type="submit">Aggiorna</button>

</form>
<br>
<h2>Genera un certificato</h2>

<form method="POST" id="genera" name="genera">

<input type="text" id="paese" title="Paese" name="paese" placeholder="Paese - Esempio: IT" maxlength="2" onkeyup="this.value = this.value.toUpperCase();" required>
<br>

<input type="text" id="stato" title="Stato" name="stato" placeholder="Stato - Esempio: Italy" required>
<br>

<input type="text" id="luogo" title="Luogo" name="luogo" placeholder="Luogo - Esempio: Bologna" required>
<br>

<input type="text" id="org" title="Organizzazione" name="org" placeholder="Organizzazione - Esempio: Multi-Installer" required>
<br>

<input type="text" id="uni" title="Unità organizzativa" name="uni" placeholder="Unità organizzativa - Esempio: Information Technology" required>
<br>

<input type="text" id="cname" title="Common name" name="cname" placeholder="Common name - Esempio: dominio.ext" required>
<br>

<input type="email" id="mail" title="E-Mail" name="mail" placeholder="Indirizzo E-Mail" required>
<br>

<input type="password" id="pass" title="Password" name="pass" placeholder="Password" required>

<br><br>
<button type="submit">Genera</button>

</form>
<br>
<h2>Carica un certificato</h2>

<form method="POST" id="carica" name="carica">

<input type="file" id="cert" name="inpFile" style="display:none;" accept=".pfx" onchange="showname()">
<button id="bt_up" style="min-width: 25%;" onclick="document.getElementById('cert').click();return false;"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
<br>
<input type="password" id="pass2" title="Password" name="pass2" placeholder="Password" required>

<br><br>
<button type="submit" id="up_cert">Carica</button>

</form>

<p style="color:green;" id="messaggio"></p>
<p id="filename"></p>

<script src="./js/form_firma.js"></script>

</div>