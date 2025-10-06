<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ajout produit</title>
</head>
<body>
<!--La page index va être la première page qui sera affiché et qui aura le formulaire pour ajouter un produit-->
    
    <h1>Ajouter un produit</h1>
    <form action="traitement.php" method="post"> <!--action permet d'indiquer le chemin à prendre lorsque l'on interagit avec le formulaire (method = post)-->
        <p>
            <label>
                Nom du produit :
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit :
                <input type="number" step="any" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantité désirée :
                <input type="number" name="qtt" value="1">
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="Ajouter le produit"> <!--Le bouton submit va permettre de d'envoyer les réponses des champs pour être traité ensuite-->
        </p>
    </form>

</body>
</html>