FilmStarsEvaluation
=====================

*A Symfony project created on December 8, 2015, 11:05 pm.*
********

## Objectif :

Créer un mini-site en Symfony2 contenant :

- un formulaire d'inscription,

- une liste de films notés par les utilisateurs

## Données :

Toutes les données doivent être enregistrées d'une façon ou d'une autre.

**Les utilisateurs** inscrits doivent avoir, en plus des données liées au formulaire, les données

suivantes :

- Date de création

- Date de modification

**Les films** doivent avoir les données suivantes :

- titre du film

- année

- réalisateur

#### Le formulaire d'inscription doit contenir les champs suivants :


| Nom du champs 										| Type						|
|:------------------------------------------------------|:--------------------------|
| Upload d'une image 									| fichier					|
| Nom 													| texte 					|
| Prénom 												| texte 					|
| Nom d'utilisateur 									| texte 					|
| Mot de passe avec vérification 						| mot de passe 				|
| Email 												| texte 					|
| Question à choix multiple – minimum 3 choix 			| libre 					|
| Question à choix unique – minimum 3 choix  			| libre 					|
| Un choix de films avec la possibilité de les noter 	| libre 					|


#### La liste des films :

Il s'agira de créer une liste paginée, triable et filtrable de films : titre, réalisateur, année, et note

moyenne

On doit pouvoir filtrer par titre, réalisateur, année ainsi que par utilisateurs.

On doit pouvoir trier sur chacun des champs.

L'image du/des utilisateurs filtrés doivent apparaître avec quelques informations : nom d'utilisateur,

date d'inscription, nombre de films notés.
