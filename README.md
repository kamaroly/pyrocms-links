# Construire un module avec l'API Stream #

	- L'API Stream, c'est quoi?
	- Pourquoi c'est mieux?
	- Comment ca marche?


## L'API Stream, c'est quoi? ##

L'API Stream est, comme beaucoup d'API, une abstraction d'une logique métier (souvent) longue et répétitive.
Elle s'applique aux manipulations de la base de données et vise à les rendre plus simples et plus courtes.

Avec cette API, il devient très simple de manipuler des informations persistantes dans un langage TOUT PHP!
Il ne sera plus nécessaire (presque dans la majorité des cas) d'effectuer des requêtes à votre base de données au format SQL.

L'API se compose de plusieurs outils nommés par l'appellation "drivers" qui régissent chacun des ensembles d'actions. On en trouve 5 :

* Streams, le gestionnaire des tables de votre base de données,
* Fields, l’outil des champs de données pour vos tables,
* Entries, le dispositif de manipulation des données (création, lecture, mise à jour et suppression - CRUD),
* CP (control panel routines), une mécanique de génération de formulaire dans le panel administratif,
* Utilities, le driver pour les manipulations d'intégration de tables SQL au format Stream.

Il faut savoir également que pour compléter et s'étendre à un maximum de cas d'utilisation, l'API intègre ses propres types de champs, les "fields types", qui sont de petites bibliothèques (de fonctionnalités). Elles ont pour rôle de manipuler les données au cours de leurs utilisations et vérifient que c'est en bonne et due forme.
Ainsi, cela assure aux applications web leurs bons fonctionnements sans accro.

Note: Les field types sont eux même des abstractions de champs de base de données (VARCHAR, TEXT, INT, BOOL etc..). Et permettent de rester concret dans un ensemble tout PHP.


## Pourquoi c'est mieux? ##

Comme présente par John Corry (http://vimeo.com/42722025), PyroCMS est un très bon manager de contenu web qui va à l'essentiel en réduisant toujours plus le code à produire, et donc les erreurs humaines, et donc les longues heures de recherche pour réparer ses erreurs, et donc obtenir toujours plus de satisfaction.

Une fois de plus, cette API hérite de tout ce fastidieux travail de réflexion que réalise pour nous l'équipe PyroCMS. Nous allons bientôt passer à la pratique, mais imaginez-vous déjà à l'instant de la conception de votre prochaine application. Vous allez produire moins de code que d'habitude, vous préoccuper de moins de bugs que d'habitude et vous obtiendrez une application fiable et facile à maintenir, que demandais de plus?


## Comment ça marche? ##

Nous allons donc nous mettre en situation pour réaliser un module simple, un petit gestionnaire de liens, simple et rapide qui vous permettra de mettre en ligne vos liens ou vidéos Youtube.

Pour ce faire, vous devrez dors et déjà être un peu familiariser avec PyroCMS.

