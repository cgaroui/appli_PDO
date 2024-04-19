<?php
require_once "index.html";
// var_dump('ok');
try
{
	$mysqlrecette = new PDO('mysql:host=localhost;dbname=recettes_chaima;charset=utf8', 'root', '');
    var_dump($mysqlrecette);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
//je recupere les noms de categories dans ma bdd
$nomCategorie = 'SELECT categorie.nom FROM categorie INNER JOIN recette ON recette.id_categorie = categorie.id_categorie WHERE recette.id_recette = :id_recette';

// je récupère tout le contenu de la table recettes
$sqlQuery = 'SELECT * FROM recette'; 
// var_dump("okiii");
$declarationRecettes = $mysqlrecette->prepare($sqlQuery);
$declarationRecettes->execute();

$recettes = $declarationRecettes->fetchAll();       //fetchAll(), qui retourne un tableau contenant toutes les recettes.

// On affiche chaque recette une par une
foreach ($recettes as $recette) {
    // var_dump("okiii");
$declarationcategorie = $mysqlrecette->prepare($nomCategorie);
$declarationcategorie->bindParam(':id_recette', $recette['id_recette']);

$declarationcategorie->execute();
$categorie = $declarationcategorie->fetch(PDO::FETCH_ASSOC); // Récupérer le nom de la catégorie


?>
    <!-- affichage des données d'une recette  -->
    <tr>
                <td><?php echo $recette['nom']; ?></td>
                <td><?php echo $recette['duree']; ?></td>
                <td><?php echo $categorie['nom'] . '<br>'; ?></td>

            </tr>

<?php
}

?>































?>