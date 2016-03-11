GestionAgenda
=============

A Symfony project created on February 29, 2016, 4:40 pm.

Commandes:
=============
Télécharger le vendor et mettre à jour l'application et composer : $ composer update

Créer la base données : $ php bin/console doctrine:database:create

Créer les tables : $ php bin/console doctrine:generate:entities AppBundle

Mettre à jour la base de données : $ php bin/console doctrine:schema:update --force

Lancer les fixtures : $ php bin/console doctrine:fixtures:load

Vider le cache : $ php bin/console cache:clear


Commandes git :
===============
Démarrer Git dans le fichier ciblé : $ git init (que la premiere fois)

Ajoute les fichiers modifiés : $ git add .

Ajout le message associé au commit : $ git commit -m "Ton message"

Paramétrer l'adresse : $ git remote add gestionagenda https://github.com/GestionAgenda/GestionAgenda.git (que une fois)

Créer la branche Pierre-Louis : $ git branch Pierre-Louis (qu'une fois)

Changer de branche vers Pierre-Louis : $ git checkout Pierre-Louis

Envoyer sur l'adresse ciblée les fichiers : $ git push gestionagenda Pierre-Louis
