<?php
session_start(); //On fait appel à une fonction native et prédéfinis pour démarrer la session. Cela permet aussi d'enregistrer les ajouts sur le serveur.

function delete(){ //On crée la fonction delete qui permettra de vider la ligne d'un produit spécifique
    if(isset($_SESSION['products'])) unset($_SESSION['products'][$_GET['id']]); //SI le tableau a des variables déclarée et différent de null, ALORS on vide la ligne du produit avec l'ID correspondant
    $_SESSION['message'] = "Produit supprimé avec succès."; //On crée un message d'alerte qui sera sous forme de tableau dans la session, et qui affichera le message lorsque la fonction est utilisé
}

function clear() { //On crée la fonction clear qui permettra de vider le tableau  products entier de la session
    if(isset($_SESSION['products'])) unset($_SESSION['products']); //SI le tableau a des variables déclarée et différent de null, ALORS on vide le tableau products de la session
}

function qttUp() { //On crée la fonction qui permettra d'augmenter la quantité de la ligne correspondante
    if(isset($_SESSION['products'])) $_SESSION['products'][$_GET['id']]['qtt']++; //SI le tableau a des variables déclarée et différent de null, ALORS On va chercher la valeur quantité (qtt) du produit avec l'ID correspondant ($_GET ID) du tableau (products) de la session pour l'augmenter de 1 (++) 
    ($_SESSION['products'][$_GET['id']]['total'] = $_SESSION['products'][$_GET['id']]['price'] * $_SESSION['products'][$_GET['id']]['qtt']); //On veut que le prix total de la ligne du produit se met à jour avec la nouvelle quantité. Donc on récupère la valeur 'total' pour dire qu'elel sera égale à la valeur 'price' * la valeur 'quantité' mis à jour
}

function qttDown() { //On crée la fonction qui permettra de diminuer la quantité de la ligne correspondante
    if(isset($_SESSION['products'])) {  //SI le tableau a des variables déclarée et différent de null
        if($_SESSION['products'][$_GET['id']]['qtt'] >0) //SI la quantié du produit avec l'ID récupéré sur la page rêquette est supréieur ou égal à 1 
            $_SESSION['products'][$_GET['id']]['qtt']--; //ALORS On va chercher la valeur quantité (qtt) du produit avec l'ID correspondant ($_GET ID) du tableau (products) de la session pour la diminuer de 1 (--)
    }
    ($_SESSION['products'][$_GET['id']]['total'] = $_SESSION['products'][$_GET['id']]['price'] * $_SESSION['products'][$_GET['id']]['qtt']);
}


if(isset($_POST['submit'])){ //SI les données ajouté avec le bouton submit sont différents de null
    //ALORS elles sont filtré pour s'assurer que la variable soit pas faussée (malveillance, faute de frappe,...) avec filter_input
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //filter sanitize permet de "nettoyer" les données en retirant les balises html et d'encoder les charactères qui sont en dehors des normes ASCII (full special chars) 
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION); //Filter validate permet de traiter les données seulement si elles sont validé (ici FLOAT est le paramètre de validation, donc si la données est de type float seulement) et filter flag permet d'autoriser "," et "." pour la decimale.
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT); //filter validate ne valide que les valeurs de type INT (donc que les nombres entiers)

    if($name && $price && $qtt){  //SI on a les 3 variables (et seulement si on les a tous)
        $product = [ //ALORS on peut créer le tableau associatif contenant les données sous formes de variable  
            "name" => $name, 
            "price" => $price,
            "qtt" => $qtt,
            "total" => $price*$qtt, //On définit le calcul pour la clé total
        ];

        $_SESSION['products'][] = $product; //On va pouvoir stocker le tableau product vide dans la session, et quand des données sont envoyés et traité par les filtres, alors on remplira le teableau de la session ainsi les produits ajouté sont stocké dans la session
    }
}

//On va utiliser une fonction de switch pour faire appel aux fonctions à un moment définis dans la page recap
if(isset($_GET['action'])){ // SI la superglobale (GET) est une variable différente de null et déclarée ('action' ici)
    switch($_GET['action']){ //ALORS on utilise une fonction prédifinie de SWITCH qui va donc permettre d'ajouter dans le tableau action les situations suivante, qui seront analysé une par une jusqu'à ce qu'une condition correspond à la requêtte
        case "delete": //Lorsque l'on appelera l'action delete dans la page recap, GET va récupérer par l'URL
            delete(); // La fonction delete crée plus haut pour l'appliquer
            header("Location:recap.php"); // On va envoyer un nouveau en-tête (fonction native prédéfinie header) qui nous permettra de rester sur la page recap (LOCATION) après le changement
            exit(); //On utilise la fonction native exit pour mettre fin à l'execution du script si la condition correspond
        case "clear":
            clear();
            header("Location:recap.php");
            exit();
        case "qtt-up":
            qttUp();
            header("Location:recap.php");
            exit();
        case "qtt-down":
            qttDown();
            header("Location:recap.php");
            exit();
        case "default":
            header("Location:index.php");
            exit();
    }
}


header("Location:index.php"); //la fonction header va permettre de renvoyer vers un nouveau en-tête lorsque le client remplis et envoie les réponses de formulaire
