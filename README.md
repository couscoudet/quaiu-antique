# Evaluation Développeur Web/Mobile
## Site internet du restaurant Le Quai Antique
--- 
Ce projet est un site internet responsive pour un restaurant fictif.
L'objectif du site internet est de présenter le restaurant, sa carte, ses menus et de permettre de réserver en ligne.
Un système d'administration permet à un administrateur du restaurant de gérer le contenu.
Cette application a été développée avec les langages, frameworks et bibliothèques suivantes : 
- PHP (MVC-POO)
- Composer
- Doctrine ORM - MySQL
- Bootstrap
- JQuery, JQuery UI
- Sortable js
- Swiper js
- PHP Mailer
---
### Mise en place de l'application
#### Prérequis
Afin de déployer cette application, vous devez posséder les outils suivants :
- PHP, une base de données MariaDB/MySQL, un serveur comme Apache (en local, un outil de type XAMPP)
- Le gestionnaire de packages Composer ( https://getcomposer.org/download/)
- Service Cloud AWS S3
#### Instructions
1. Cloner le répertoire en local
```
    git clone https://github.com/couscoudet/quaiu-antique.git
```
2. Installer les dépendances (Doctrine, PHP Mailer, dotenv, etc...) à partir du fichier composer.json à l'intérieur du dossier 
```
    composer install
```

3. Variables d'environnement
L'utilisation de l'application nécessite la configuration de vos propres variables d'environnement
* Pour la gestion des images : Vous devez avoir au préalable des accès aux service cloud S3 AWS afin de créer vos clés d'accès :
AWS_ACCESS_KEY, AWS_SECRET_ACCESS_KEY
* Pour la connexion à la base de données (base de développement ou de production) :
Nom d'utilisateur -> DB_USER_DEV ou DB_USER
Password -> DB_PASSWORD_DEV ou DB_PASSWORD
Nom de la base de données -> DB_NAME_DEV ou DB_NAME
Domaine -> DB_HOST_DEV DB_HOST

* Pour la connexion au serveur mail smtp :
Email du compte sortant -> MAIL_SENDER
Password -> MAIL_PASS
Port -> MAIL_PORT
Domaine -> MAIL_HOST

4. Création des tables de la base de données
Doctrine utilise des instructions spécifiques afin de créer et mapper la base de données, ainsi que des classes Proxy.
Créer un dossier "Migrations" dans /lib/MyProject.
Saisir ces 2 instructions dans le terminal afin de générer les tables correspondantes au schéma de données:
```
    ./vendor/bin/doctrine-migrations diff
    ./vendor/bin/doctrine-migrations migrate
```
Au besoin, vous pouvez supprimer l'ensemble des tables avec l'instruction suivante :
```
    php bin/doctrine orm:schema-tool:drop -f
```

En savoir plus sur Doctrine : https://www.doctrine-project.org/projects/doctrine-orm/en/2.14/tutorials/getting-started.html 
 
5. L'application utilise plusieurs bibliothèques via un lien CDN, une connexion active à Internet est donc nécessaire pour son fonctionnement
---
Vous pouvez créer un administrateur en accédant à l'URL :shipit: **'/creer-administrateur'** :shipit:
L'accès a été volontairement laissé ouvert dans une démarche de test.
---
Version disponible en ligne sur Heroku : https://le-quai-antique.herokuapp.com/
