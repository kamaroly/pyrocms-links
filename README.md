## Construire un module avec l'API Stream ##

	- L'API Stream, c'est quoi?
	- Pourquoi c'est mieux?
	- Comment ca marche?


# L'API Stream, c'est quoi? #

L'API Stream est, comme beaucoup d'API, une abstraction d'une logique metier (souvent) longue et repetitive.
Elle s'applique aux manipulations de la base de donnee et vise a les rendres plus simple et plus courte.

Avec cette API, il devient tres simple de manipuler des informations percistantes dans un language TOUT PHP!
Il ne sera plus nescessaire (presque dans la majorite des cas) d'effectuer des requettes a votre base de donnees
au format SQL.

L'API se compose de plusieurs outils nommer par l'appelation "drivers" qui regissent chacun des ensembles d'actions. On en trouve 5 :
	- Streams, le gestionnaire des tables de votre base de donnees,
	- Fields, l'outils des champs de donnees pour vos tables,
	- Entries, le dispositif de manipulation des donnees (creation, lecture, mise a jour et suppression - CRUD),
	- CP (control panel routines), une mecanique de generation de formulaire dans le panel administratif,
	- Utilities, le driver pour les manipulations d'integration de tables SQL au format Stream.

Il faut savoir egalement que pour completer et s'etandre a un maximum de cas d'utilisation, l'API integre ses propres types de champs, les "fields types", qui sont de petites bibliotheques (de fonctionnalites). Elles ont pour role de manipuler les donnees au cours de leurs utilisations et verifient ainsi a leurs bon et du forme.
Ainsi, cela assure aux applications web leurs bon fonctionnement sans accro.

Note: Les field types sont eux meme des abstration de champs de base de donnees (VARCHAR, TEXT, INT, BOOL etc..). Et permettent de rester concret dans un ensemble tout PHP.


# Pourquoi c'est mieux? #

Comme presente par John Corry (http://vimeo.com/42722025), PyroCMS est un tres bon manager de contenu web qui va a l'essentiel en reduissant toujours plus le code a produire, et donc les erreurs humaines, et donc les longues heures de recherche pour reparer ces erreurs, et donc optenir toujours plus de satisfaction.

Une fois de plus, cette API herite de tout ce fastidieux travail de reflection que realise pour nous l'equipe PyroCMS. Nous allons bientot passer a la pratique, mais imaginez vous deja a l'instant de la conception de votre prochainne application. Vous allez produire moins de code que d'habitude, vous preocupez de moins de bugs que d'habitude et vous obtiendrais une application fiable et facile a maintenir, que demandais de plus?


# Comment ca marche? #

Je suis partisant du fait que seul la pratique apprend vraiment, avec biensur les explications adequates. Nous allons donc nous mettre en situation pour realiser un module simple, un petit gestionnaire de liens, simple et rapide qui vous permettra de mettre en ligne vos liens ou videos Youtube.

Pour ce faire, vous devrais dors et deja un peu familiariser avec PyroCMS ou CodeIgniter
