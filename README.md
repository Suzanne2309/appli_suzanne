----------------------- Projet Application Web – Panier en PHP -----------------------
📌 Contexte

Ce projet a été réalisé dans le cadre de ma formation en développement web, pour approfondir mes connaissances en PHP et découvrir la gestion des sessions et des superglobales.
L’objectif était de créer une application web simple de panier permettant de gérer des produits ajoutés par l’utilisateur.


🖥️ Description du projet

Le projet consiste en une application web en PHP composée de trois pages principales :
- index.php → contient le formulaire pour ajouter un produit dans le panier stocké en session.
- traitement.php → gère le traitement des données envoyées par le formulaire.
- recap.php → affiche le panier dans un tableau en récupérant les données depuis la session.

Pour gérer les interactions avec le panier, nous avons utilisé :
- La superglobale $_SESSION pour stocker et manipuler les produits.
- La fonction switch pour implémenter les actions : supprimer un produit, vider le panier, augmenter ou diminuer la quantité d’un produit,
  tout en recalculant le prix total en fonction de la quantité.


🎯 Objectifs pédagogiques

- Découvrir et utiliser les sessions PHP pour stocker des données côté serveur.
- Manipuler les superglobales pour récupérer et gérer les informations envoyées par l’utilisateur.
- Appliquer la logique conditionnelle avec switch pour gérer différentes actions sur le panier.
- Approfondir la structuration d’un projet PHP multi-pages et l’interaction entre formulaires et stockage de données.


🚀 Compétences acquises

- Gestion de sessions pour conserver les données utilisateur.
- Utilisation de superglobales PHP ($_SESSION, $_POST).
- Création d’une logique interactive avec switch et gestion des actions utilisateur.
- Manipulation des tableaux pour stocker et modifier les produits du panier.
- Mise en place d’une application PHP multi-pages fonctionnelle.
