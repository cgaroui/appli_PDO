<?php
require_once "index.html";
var_dump('ok');
try
{
	$mysqlrecette = new PDO('mysql:host=localhost;dbname=recettes_chaima;charset=utf8', 'root', '');
    var_dump($mysqlrecette);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage('erreur'));
}

// On récupère tout le contenu de la table recettes
$sqlQuery = 'SELECT * FROM recette'; 
var_dump("okiii");
$declarationRecettes = $mysqlrecette->prepare($sqlQuery);
$declarationRecettes->execute();
$recettes = $declarationRecettes->fetchAll();       //fetchAll(), qui retourne un tableau contenant toutes les lignes résultantes de la requête.

// On affiche chaque recette une à une
foreach ($recettes as $recette) {
?>
<?php
$nomCategorie= 'SELECT * FROM categorie';
?>
    <tr>
                <td><?php echo $recette['nom']; ?></td>
                <td><?php echo $recette['duree']; ?></td>
                <td><?php echo $recette[$nomCategorie]; ?></td>
            </tr>

<?php
}

?>































?>