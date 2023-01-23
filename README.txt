PREREQUIS :

Pour mettre en place la base de donnée :
	- Dans xampp -> phpmyadmin créer une nouvelle base de donnée "web4shop"
	- Remplir la base de donnée à l'aide du fichier "web4shop2022.sql"
	- username : "root"
	  password : ""
	  host : localhost

FONCTIONALITES :

Ce projet réponds aux attendus à savoir :
	- Les listes des produits par catégories
	- Les fiches produits avec leurs commentaires avec le bouton ajouter au panier
	- Un systéme de connexion/création de compte
	- Un panier qui mémorise les articles indépendament du fait d'être connecté
	- Un Bouton X pour supprimer un article du panier
	- Un formulaire d'adresse avec choix si connecté
	- Un formulaire de paiment (non relié à un réel moyen de paiment)
	- Génération d'une facture pdf qui récapitule la commande 
	- Un coté admin qui permet de voir toutes les commandes ainsi que de confirmer la livraison

Fonctionalités supplémentaires :
	- Ajouter des catégories/produits dans la base de donée créera automatiquement les pages associées
	- Commenter un produit (Limite : 1 par Prénom par produit)
	- Bouton modifier quantité dans le panier
	- Onglet profil permettant de modifier ses informations
	- Onglet Historique des commandes (factures + récap commandes)
	
	
Points à dévelloper :
	- Pour l'admin il pourrait être utile de lui permettre d'imprimer directement les informations de livraison
	- Il faudrait vérifier que l'utilisateur, après avoir rentrer ses infos de livraison, effectue bien le paiement. Dans le cas
contraire le status de l'oder reviendrait à 0.
	- Ajouter des sécurités pour pas que l'utilisateur puisse rentrer des urls valides qui ne serait pas disponible à son stade.
	- Erreur 500 causer par sql apparement pas corrigeable lors de la suppression d'élément dans la base de données.
 	- L'admin devrait pouvoir ajouter de nouveau articles ou du stock directement sur le site internet et non pas sur mysql.