<?php
include("../_inc/config.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
	<meta property="og:url" content="https://nature.lucaslaplanche.fr/lepido/lepido.php">
    <meta property="og:title" content="Lucas LAPLANCHE - Lépidoptères">
    <meta property="og:description" content="Découvrez mes différentes observations et photographies de lépidoptères en France.">
    <meta property="og:image" content="https://nature.lucaslaplanche.fr/_imgs/avatar.jpg">
	<meta property="og:type" content="website">

	<meta name="author" content="Lucas Laplanche">
	<meta name="description" content="Projets personnels, professionnels, réalisations et portfolio numérique de Lucas LAPLANCHE. Venez jeter un œil et contactez moi sur mes réseaux !">
	<meta name="keywords" content="Lucas LAPLANCHE, portfolio, projets, réalisations, numérique, web, environnement, naturaliste, ornithologie, lépidoptère, oiseaux">
	
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">

	<title>Lucas LAPLANCHE - Lépidoptères 🦋</title>

	<link rel="icon" type="image/png" href=".._imgs/favicon2857.png">
    <link rel="stylesheet" type="text/css" href="../_css/simple-lightbox.css">
	<link rel="stylesheet" href="../_css/main.css">
	<link rel="stylesheet" href="_css/lepido.css">
</head>
<body>

<nav>
    <div class="flex">
        <img class="nav-avatar" src="../_imgs/favicon2857.png">
        <a href="https://nature.lucaslaplanche.fr/">Lucas LAPLANCHE</a>
        <span style="margin: 7px 10px;">/</span>
        <a href="https://nature.lucaslaplanche.fr/lepido/lepido.php">Lépidoptères 🦋</a>
    </div>
</nav>

<section id="lepido-head">
    <h1>Lépidoptères 🦋</h1>
</section>

<section id="lepido-list">
	<div class="filters">

	</div>

	<ul>
		<?php 

			$sthandler = $conn->prepare("SELECT * FROM lepido ORDER BY nom");
			$sthandler->execute();
			$resultats = $sthandler->fetchAll();

			// Affichage des résultats
			foreach ($resultats as $row) {
				$id = $row["id"];
				$name = $row["nom"];
				$name_latin = $row["nom_latin"];
				$famille = $row["famille"];
				$rarete = $row["rarete"];
				$repartition = $row["repartition"];
				$description = $row["description"];
				$first_obs = $row["premiere_obs"];
				$ficheinpn = $row["lien_inpn"];
				$datephoto = $row["date_obs"];
				$lieuphoto = $row["lieu_obs"];
				$image = $row["image_path"];
				$imageMin = $row["image_path_min"];

				$timestampFirstobs = strtotime($first_obs);
				$timestampDatephoto = strtotime($datephoto);
				$formattedFirstobs = date('d/m/Y', $timestampFirstobs);
				$formattedDatephoto = date('d/m/Y', $timestampDatephoto); 
		?>
			<li id="<?= $id ?>">
				<div class="flex justify-between">
					<div class="lepidoname"><b><?= $name ?></b> - <i><?= $name_latin ?></i></div>
					<div class="famille"><span><?= $famille ?></span></div>
				</div>
				<div class="lepidocontent">
					<i class="fa-solid fa-angles-right fa-2x" title="Fermer"></i>
					<div class="lepidoinfo">
						<h1><?= $name ?></h1>
						<p><i class="fa-regular fa-eye"></i> <b>Rareté de l'espèce :</b> <span><?= $rarete ?></span></p>
						<br>
						<div class="lepido-desc">
							<p><i class="fa-solid fa-globe"></i> <b>Répartition :</b> <?= $repartition ?></p>
							<p><i class="fa-solid fa-align-justify"></i> <b>Description :</b> <?= $description ?></p>
							<p><i class="fa-regular fa-file-lines"></i> Fiche <a href="<?= $ficheinpn ?>">INPN<i class="fa-solid fa-up-right-from-square"></i></a></p>
						</div>
						<br>
						<p><i class="fa-solid fa-calendar-days"></i> <b>Première observation :</b> <?= $formattedFirstobs ?></p>
						<hr>
						<div class="img-status">
							<a href="<?= $image ?>">
								<img src="<?= $imageMin ?>" alt="<?= $name ?>" title="<?= $name ?>, <?= $lieuphoto ?>, <?= $formattedDatephoto ?>">
							</a>
							<p><?= $lieuphoto ?>, <?= $formattedDatephoto ?></p>
						</div>
					</div>
				</div>
            </li>

        <?php
			}
		?>
	</ul>
</section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/2f306d349c.js" crossorigin="anonymous"></script>
    <!-- <script src="_js/jquery-3.3.1.min.js"></script> -->
	<script src="../_js/simple-lightbox.jquery.js"></script>
	<script>
		$(document).ready(function() {
			var lightbox = $('.lepidocontent a').simpleLightbox({
				captions: true,
				showCounter: false,
				nav: false,
				enableKeyboard: false,
				scrollZoom: false
			});
		});
	</script>
	<script src="../_js/main.js"></script>
	
</body>
</html>