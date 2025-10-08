<?php
session_start(); //On fait appel à une fonction précise et prédéfinis pour démarrer la session. Cela permet aussi d'enregistrer les ajouts sur le serveur.

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
            //"ttQtt" => 
        ];

        $_SESSION['products'][] = $product; //On va pouvoir stocker le tableau product vide dans la session, et quand des données sont envoyés et traité par les filtres, alors on remplira le teableau de la session ainsi les produits ajouté sont stocké dans la session
    }
}

/*
        $product['name'][$name] = $product['name'][$name] + $qtt;

        function totalQtt() {
            $ttQtt = 0
            $totalQtt+= $product['ttQtt'];
        }
*/

if(isset($_GET['action'])){
    switch($_GET['action']){
        case "delete":
            if(isset($_SESSION['products'])){
            unset($_SESSION['products'][$_GET['id']]);};
            echo '<script>alert("Article supprimé")</script>';
            header("Location:recap.php");
            exit();
            break;
        case "clear":
            unset($_SESSION['products']);
            echo '<script>alert("Liste supprimé")</script>';
            break;
        case "qtt-up":
            
            break;
        case "qtt-down":

            break;
    }
}


header("Location:index.php"); //la fonction header va permettre de renvoyer vers un nouveau en-tête lorsque le client remplis et envoie les réponses de formulaire
