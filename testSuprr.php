<html>
<head>
<script type="text/javascript">
<!--

function ajoutLigne()
{
  //num = 0;
  var Cell;
  var nom = document.forms["formulaire"].nom.value;
  var prenom = document.forms["formulaire"].prenom.value;
  var tableau = document.getElementById('tableau');
  var ligne = tableau.insertRow(-1);


  Cell = ligne.insertCell(0);
  //Cell.innerHTML = num + 1;
  Cell.innerHTML = ligne.rowIndex;

  Cell = ligne.insertCell(1);
  Cell.innerHTML = nom;
  Cell = ligne.insertCell(2);
  Cell.innerHTML = prenom;
  Cell = ligne.insertCell(3);

  //Cell.innerHTML = ("<input type=button name=supprimer value=Supprimer onclick=suppression()>");
  var bouton = document.createElement("input");
  bouton.type = "button";
  bouton.value = "Supprimer";
  bouton.onclick = function(){suppression(ligne)};
  Cell.appendChild(bouton);


  document.forms["formulaire"].nom.value = "";
  document.forms["formulaire"].prenom.value = "";

}

function suppression(ligne)
{

  //var nb = document.getElementById('tableau').rows.length;
  //document.getElementById('tableau').deleteRow(-1);

  document.getElementById('tableau').deleteRow(ligne.rowIndex);

  //Recomptage des lignes...
  var tableau = document.getElementById('tableau');
  var trs = tableau.rows;
  var n = trs.length;
  var i;

  for (i=1; i<n; i++) //on commence à 1 et non à 0 ;)
  {
    trs[i].cells[0].innerHTML = trs[i].rowIndex;
  }

}


//-->
</script>

</script>
</head>
<body>

<form name="formulaire">
Nom <input type="text" name="nom"><br>
Prenom <input type="text" name="prenom"><br>
<table name= "tableau" id="tableau" border="1">
<tr>
<td>Numéro de ligne</td>
<td>Nom</td>
<td>Prenom</td>
<td>Supprimer la ligne</td>
</tr>
</table>
</form>
<div><input type="button" value="Ajouter une ligne" onclick="ajoutLigne()" ></div> <br>
</body>


</html>
