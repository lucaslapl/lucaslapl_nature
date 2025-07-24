<html>
<head>
<meta name="robots" content="noindex">
</head>
<body>
<?php
include_once("../_inc/config.php");

$folder = "_photos/";
$name = htmlspecialchars($_POST["name"], ENT_QUOTES);
$namelatin = htmlspecialchars($_POST["namelatin"], ENT_QUOTES);
$famille = htmlspecialchars($_POST["famille"], ENT_QUOTES);
$rarete = $_POST["rarete"];
$repartition = htmlspecialchars($_POST["repartition"], ENT_QUOTES);
$description = htmlspecialchars($_POST["description"], ENT_QUOTES);
$first_obs = $_POST["first-obs"];
$ficheinpn = htmlspecialchars($_POST["lien-inpn"], ENT_QUOTES);
$datephoto = $_POST["date-photo"];
$lieuphoto = htmlspecialchars($_POST["lieu-photo"], ENT_QUOTES);

$image = $folder . time() . "_" . basename($_FILES["imgMain"]["name"]);
$imageMin = $folder . time() . "_" . basename($_FILES["imgMini"]["name"]);

// Vérifier si le formulaire a été soumis
if (isset($_POST["submit"])) {

    // Vérification des types de fichiers et taille des fichiers
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES["imgMini"]["type"], $allowed_types) || !in_array($_FILES["imgMain"]["type"], $allowed_types)) {
        echo "Type de fichier non autorisé. Seuls les fichiers JPEG, PNG, GIF sont acceptés.";
        exit;
    }

    if ($_FILES["imgMini"]["size"] > 2000000 || $_FILES["imgMain"]["size"] > 2000000) {
        echo "La taille de l'image ne doit pas dépasser 2 Mo.";
        exit;
    }

    // Upload des fichiers
    if (move_uploaded_file($_FILES["imgMini"]["tmp_name"], $imageMin) && move_uploaded_file($_FILES["imgMain"]["tmp_name"], $image)) {

        try {
            // Insertion des informations dans la base de données avec requête préparée
            $insert_query = "INSERT INTO oiseaux (
                nom, 
                nom_latin, 
                famille, 
                rarete, 
                repartition, 
                description, 
                premiere_obs, 
                lien_inpn, 
                image_path, 
                image_path_min,
                date_obs,
                lieu_obs) 
                VALUES (
                :name, 
                :namelatin, 
                :famille, 
                :rarete, 
                :repartition, 
                :description, 
                :first_obs,
                :ficheinpn, 
                :image, 
                :imageMin, 
                :datephoto,
            	:lieuphoto)";

            $stmt = $conn->prepare($insert_query);
            $stmt->execute([
                ':name' => $name,
                ':namelatin' => $namelatin,
                ':famille' => $famille,
                ':rarete' => $rarete,
                ':repartition' => $repartition,
                ':description' => $description,
                ':first_obs' => $first_obs,
                ':ficheinpn' => $ficheinpn,
                ':image' => $image,
                ':imageMin' => $imageMin,
                ':datephoto' => $datephoto,
                ':lieuphoto' => $lieuphoto
            ]);

            // Redirection après le succès
            header('Location: new_bird.php');
            exit;

        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion dans la base de données : " . $e->getMessage();
        }

    } else {
        echo "Désolé, une erreur est survenue lors du téléchargement des fichiers.";
    }
}

$stmt = null;
$conn = null;
?>
 </body></html>