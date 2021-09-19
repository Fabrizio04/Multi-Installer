<?php
if(!file_exists('./core/config.inc.php')) header("Location: ./websetup");
require_once './core/config.inc.php';
?>
<!DOCTYPE html>
<html lang="it" class="nav-no-js">

<head>

<title>Multi-Installer</title>

<?php
$c  = new mysqli($host,$usDB,$passDB,$database);
$q = $c->query("SELECT * FROM pacchetti ORDER BY nome");
require_once './core/header.php';
require_once './core/header_home.php';
?>

</head>

<body>

<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<?php require_once './core/menu.php'; ?>

<div style="padding: 0px;padding-top: 4.4rem;text-align:center;">

	<form method="POST" action="execute.php" id="spunta" name="spunta" onsubmit="return controlla()">
	
		<!-- Menù -->
		<div id="mainmenu">

			<h1>Multi-Installer</h1>
			<?php echo '<h3 class="sistema">'.$sistema.' '.$bit.' &#8211; '.$estensione.'</h3>'; ?>
			
			<?php
			if($q->num_rows == 0) $disabled = " disabled";
			else $disabled = "";
			?>
			
			 <div class="row">
			  <input type="submit" value="Download" id="sub"<?php echo $disabled; ?>>
			  <input type="reset" onclick="cleanALL(),resetSearch()" id="res" value="Reset"<?php echo $disabled; ?>>
			  <?php
			  if (isset($_SESSION['filename'])) {
				$nomefile = calcolaNome($_SESSION['filename']);
				if (file_exists('./setup/'.$nomefile)) {
					echo '<button id="last_selected" onclick="return ultimo()">Ultimo</button>';
				} else {
					$_SESSION['filename'] = NULL;
				}
			  }
			  ?>
			</div>
			
			<div class="row">
				<input type="search" id="myInput"<?php echo $disabled; ?> onkeypress="return stop(event);" onkeyup="myFunction()" onmousemove="myFunction()" ontouchmove="myFunction()" placeholder="Ricerca pacchetti . . ." title="Ricerca pacchetti . . ." autocomplete="off">
			</div>
			
		</div>
		<!-- Fine menù -->
		
		<!-- Lista -->
		<div class="main" align="center">
			
			<div class="lds-spinner" id="load_gif" style="margin-top:50px;display:none;">
			<div></div><div></div><div></div><div></div><div></div><div></div>
			<div></div><div></div><div></div><div></div><div></div><div></div>
			</div>
			
			<?php
			
			if($q->num_rows > 0){
			
				echo '<ul id="myUL">';
			
				while($d = $q->fetch_array()){
					
					echo '<li title="'.utf8_encode($d['desc']).'">
						<a id="scelta'.$d['id'].'" onclick=\'cecca("'.$d['id'].'")\'>
							<table style="text-align:center;">
								<tbody>
								<tr>		
									<td width="400"><strong>'.$d['nome'].'</strong><input type="checkbox" style="display:none;cursor:pointer;" id="'.$d['id'].'" name="nomeVar[]" value="'.$d['id'].'"></td>
								</tr>
								</tbody>
							</table>
						</a>    
					</li>';
				
				}
				
				echo "</ul>";
			
			} else {
				echo '<h3 class="sistema">Nessun pacchetto</h3>';
			}
			
			
			?>

		</div>
		<!-- Fine lista -->
		
	</form>

</div>

<?php
require_once './core/footer.php';
require_once './core/footer_home.php';
$c->close();
?>
</body>

</html>