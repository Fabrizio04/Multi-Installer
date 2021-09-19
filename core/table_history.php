<div class="main" align="center">

<!-- Tabella -->

<table align="center">
  <thead>
    <tr>
      <td class="tab_tit" scope="col">DATA</td>
      <td class="tab_tit" scope="col">FILE</td>
	  <td class="tab_tit" scope="col">SISTEMA</td>
      <td class="tab_tit" scope="col">PROGRAMMI</td>
    </tr>
  </thead>
  <tbody>
  
	<?php
	
	$lll = substr($_SESSION['history'], 0, -1) . '';
	
	$pieces = explode(";", $lll);
	
	
	foreach ($pieces as $key => $value){
		
		$pieces2 = explode("=", $value);
		
		$id = $pieces2[1];
		$pieces2[1] = calcolaNome($pieces2[1]);
		
		if (file_exists('./setup/'.$pieces2[1])) {
			$pieces2[1] = '<a href="./download.php?id='.$id.'">'.$pieces2[1].'</a>';
		}
		
		echo '<tr class="linea">
<td data-label="DATA" id="datafile"><i class="fa fa-trash" aria-hidden="true" onclick="deleteHistory(\''.$id.'\');"></i> '.date('d/m/Y',$pieces2[0]).'</td>
<td data-label="FILE" id="nomefile">'.$pieces2[1].'</td>
<td data-label="SISTEMA" id="architettura">'.$pieces2[3].' bit</td>
<td data-label="PROGRAMMI"><font id="resp" face="Verdana" size="1" style="font-style: italic;"word-wrap: break-word;">'.str_replace("_"," ",(str_replace(",",", ",$pieces2[2]))).'</font></td>
</tr>';
		
	}
	?>

  </tbody>
</table>

</div>