<?php
require_once "index.html";

try
{
	$mySqlRecette = new PDO('mysql:host=localhost;dbname=recettes;charset=utf8', 'root', '');
  
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
//je recupere les noms de categories dans ma bdd
$nomCategorie = 'SELECT c.nom_categorie FROM categorie c INNER JOIN recette r ON r.id_categorie = c.id_categorie WHERE r.id_recette = :id_recette'; // le ":" ici => marqueur nommés 

// je récupère tout le contenu de la table recettes
$sqlQuery = 'SELECT * FROM recette'; 

$declarationRecettes = $mySqlRecette->prepare($sqlQuery);
$declarationRecettes->execute();

$recettes = $declarationRecettes->fetchAll();       //fetchAll(), qui retourne un tableau contenant toutes les recettes.
?>

<!-- premiere ligne du tableau contenant le nom de chacune de mes colonnes  -->
<table>
<tr>
    <th>Nom recette </th>
    <th>Temps de préparation</th>
    <th>Type de recette</th>
</tr>



<?php




// On affiche chaque recette une par une
  foreach ($recettes as $recette) {

/* definition injection sql : est une vulnérabilité de sécurité Web qui permet à un attaquant d'interférer avec les requêtes qu'une application effectue sur sa base de données.
preparation : utiliser des requettes préparés pour prevenir l'injection SQL (définir des requêtes SQL avec des paramètres qui sont ensuite remplacés par des valeurs sécurisées lors de l'exécution.)
compilation : transformation en format exécutable
exécution : une fois compilé la requete est exécuté pour renvoyer le resultat voulu 
*/
$declarationCategorie = $mySqlRecette->prepare($nomCategorie);
$declarationCategorie->bindParam(':id_recette', $recette['id_recette']);

$declarationCategorie->execute();
$categorie = $declarationCategorie->fetch(PDO::FETCH_ASSOC); // Récupérer le nom de la catégorie 
?>
<!-- chacune de ces 3 ligne va remplire mes colonnes avec les infos des recette corespondante  -->
            <tr>
                <td><?php echo $recette['nom']; ?></td>   <!-- rempie la colonne nom recette pour chaque nvl recette  -->
                <td><?php echo $recette['duree']." min "; ?></td>
                <td><?php echo $categorie['nom_categorie'] . '<br>'; ?></td>
            </tr>
 
<?php
}

?>
</table>






























?>