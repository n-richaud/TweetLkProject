Di Malta Tony (uapv1301073), Richaud Nicolas (uapv1604281)

TP4 réalisé sur la session de l'utilisateur Di Malta Tony.
Url pour tester : https://pedago02a.univ-avignon.fr/~uapv1301073/TP4/Application/ApiTest.php

1. Nom de l'application modifié en ApiTest.
2. Bon fonctionnement du hello world.
3. Ajout de la fonction "superTest" dans "mainController.php".

Inscription :
Adaptation du TP2 pour l'utilisation de la table 'jabaianb.utilisateur'.
Mot de passe crypté en sha1 et compatible avec la méthode getUserByLoginAndPass() de la classe "utilisateurTable.class.php" du modèle.

Update (TP5) :
1. Affichage d'une photo de profil, des infos de l'utilisateur, de son statut, et du formulaire d'envoi de tweets (informations factices pour tester).
2. Zone de menu ajoutée. Elle contient le lien vers la liste des utilisateurs. Chaque utilisateur est un lien vers son profil.
3. Affichage du profil d'un utilisateur. Ajout d'un context "ACCESS" pour accéder à l'un des profils sans pouvoir le modifier.

Update (TP5-Part2) :
Url pour tester : https://pedago02a.univ-avignon.fr/~uapv1604281/Application/ApiTest.php

1. Ajout vue TweetView
2. Ajout tweet de l'utilisateur sur leur profil (vue utilisateur).
3. Ajout tweet de l'utilisateur sur leur profil (vue étrangère).
4. Ajout lien de partage et de vote avec id du tweet (passage d'une nouvelle page à un popup in-page pour informer de la réussite ou du partage à prévoir).
5. Ajout loginAccess avec le formulaire et loginSuccess vide pour l'instant.

Update (TP6-Part1) :
Url pour tester : https://pedago02a.univ-avignon.fr/~uapv1604281/Application/ApiTest.php

1. Ajout de tous les modèles
2. Utilisation de getUserByLoginAndPass pour le formulaire de connexion
