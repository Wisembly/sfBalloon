Préambule
=========

Salut à toi ! Repreneur du sfBalloon :) Ici tu trouvera la procédure d'installation de sfBalloon ! Bon code :)


Pre-requis:
-----------

* Apache
* Mysql
* PHP 5.3 (CLI + Apache) (Je conseille d'installer a la main avec macport)
* Avoir accès à PHP depuis la ligne de commande pour faire "php command" 
* La même version de PHP pour CLI et Apache 

Installation
============

Etape 0 - Créer un vhost
------------------------

Dans le fichiers /etc/hosts (sous mac) (sous windows je ne sais pas), ajouter la ligne :

    127.0.0.1  balloon.local

Et dans les fichiers vhosts de ton serveur local, ajouter :

    <Virtualhost *:80>
      ServerName balloon.local

      DocumentRoot "/le/repertoire/dinstallation/balloon/web"
      DirectoryIndex index.php

      <Directory "/le/repertoire/dinstallation/balloon/web">
        AllowOverride All
        Allow from all
      </Directory>

      Alias /sf "/le/repertoire/dinstallation/balloon/lib/vendor/symfony/data/web/sf"
      <Directory "/le/repertoire/dinstallation/balloon/lib/vendor/symfony/data/web/sf">
        AllowOverride All
        Allow from All
      </Directory>
    </Virtualhost>

Etape 1 - Cloner le dépo
------------------------

    cd /le/repertoire/dinstallation 
    git clone git@github.com:Balloon/sfBalloon.git balloon
    
Etape 2 - Installer les sous-modules
------------------------------------

    git submodule update --init
    
Etape 3 - Installer la base de données
--------------------------------------

./symfony doctrine:build --all --and-load


Etape 4 - Vérifier que tout marche 
----------------------------------

Avec firefox/chrome/safari/!ie, balloon.local/frontend_dev.php 

La page frontend_dev.php est le front controller de l'application. _dev est l'environnement (développement)


A savoir
========

* Importer les tweets des walls en cours : php symfony balloon:import-tweets
* Endpoint SMS => balloon.local/frontend_dev.php/aggregator/sms
* Endpoint SMS => balloon.local/frontend_dev.php/aggregator/email
* Accéder à la petite administration : balloon.local/backend_dev.php (non sécurisé)
