<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="robots" content="noindex">
	<title>Lucas Laplanche - Ajout de lépido</title>
	<link rel="stylesheet" type="text/css" href="../_css/main.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<script src="https://kit.fontawesome.com/2f306d349c.js" crossorigin="anonymous"></script>
    <style>
        form {
            margin: 64px 150px;
        }
    </style>
</head>
<body>

        <form action="lepido_sent.php" method="post" enctype="multipart/form-data">
			<p>Nom du papillon :</p>
			<input type="text" name="name" style="width: 300px;padding: 10px 0;">
			<br>
			<p>Nom latin du papillon :</p>
			<input type="text" name="namelatin" style="width: 300px;padding: 10px 0;">
			<br>
			<p>Famille :</p>
			<input type="text" name="famille" style="width: 300px;padding: 10px 0;">
			<br>
			<p>Rareté :</p>
			<select id="rarete" name="rarete">
				<option value="Commune">Commune</option>
				<option value="Peu commune">Peu commune</option>
                <option value="Rare">Rare</option>
                <option value="Très rare">Très rare</option>
			</select>
			<br>
			<p>Répartition :</p>
			<textarea id="repartition" name="repartition" rows="5" cols="33"></textarea>
			<button id="fillRepartition" type="button" data-value="Observable sur tout le territoire métropolitain.">Tout le territoire</button>
			<br>
			<p>Description :</p>
			<textarea id="description" name="description" rows="5" cols="33"></textarea>
			<br>
			<p>Première observation :</p>
			<input type="date" id="first-obs" name="first-obs">
			<br>
            <p>Fiche INPN :</p>
			<input type="url" name="lien-inpn" style="width: 300px;padding: 10px 0;">
			<br>
			<p>Photo :</p>
			<input type="file" name="imgMain" id="imgMain">
			<br>
			<p>Photo miniature :</p>
			<input type="file" name="imgMini" id="imgMini">
			<br>
            <p>Date photo :</p>
			<input type="date" id="date-photo" name="date-photo">
			<br>
			<p>Lieu photo :</p>
			<input type="text" name="lieu-photo" style="width: 300px;padding: 10px 0;">
			<br>
			<br>
			<input type="submit" value="Envoyer" name="submit">
		</form>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../_js/main.js"></script>
 <script>
        $(document).ready(function () {
            $('#fillRepartition').click(function () {
                const valeur = $(this).data('value');
                $('#repartition').val(valeur);
            });
        });
    </script>
</body>
</html>