<p align="center"><a href="https://github.com/SkyyInfinity/roomly-api" target="_blank"><img src="./public/images/logo.svg" width="400" alt="Roomly Logo"></a></p>

# Roomly API

Ce repository contient le code source de l'API Roomly, une API Laravel utilisée pour la gestion des salles et des réservations dans notre application.

## Installation

Pour installer et exécuter l'API localement, suivez les étapes ci-dessous :

1. Assurez-vous d'avoir installé PHP (version 8.1 ou supérieure), Composer et MySQL sur votre machine.

2. Clonez ce repository sur votre machine :

   ```shell
   git clone https://github.com/SkyyInfinity/roomly-api.git
   ```

3. Accédez au répertoire du projet :

   ```shell
   cd roomly-api
   ```

4. Installez les dépendances en exécutant la commande suivante :

   ```shell
   composer install
   ```

5. Créez une copie du fichier `.env.example` et renommez-le en `.env`. Configurez les paramètres de votre base de données dans ce fichier.

6. Générez une clé d'application en exécutant la commande suivante :

   ```shell
   php artisan key:generate
   ```

7. Exécutez les migrations pour créer les tables de la base de données :

   ```shell
   php artisan migrate
   ```

8. Démarrez le serveur de développement :

   ```shell
   php artisan serve
   ```

   L'API sera accessible à l'adresse `http://localhost:8000`.

9. Félicitations ! L'API Roomly est maintenant installée et prête à être utilisée.

## Documentation de l'API

Pour comprendre les différentes routes et fonctionnalités de l'API, consultez la documentation fournie dans le fichier `API_Documentation.md`.

## Contribuer

Nous sommes ouverts aux contributions et aux améliorations de l'API Roomly. Si vous souhaitez apporter des modifications, veuillez suivre le processus suivant :

1. Fork ce repository.

2. Créez une nouvelle branche pour vos modifications :

   ```shell
   git checkout -b modification-nom
   ```

3. Effectuez vos modifications et testez-les.

4. Soumettez vos modifications en effectuant un pull request vers la branche principale.

Nous examinerons attentivement votre contribution et fusionnerons les modifications appropriées dans le projet.

## Problèmes

Si vous rencontrez des problèmes lors de l'installation ou de l'utilisation de l'API Roomly, veuillez créer un ticket dans la section "Issues" de ce repository. Nous ferons de notre mieux pour résoudre les problèmes rapidement.

---

Nous espérons que vous trouverez cette API Roomly utile et fonctionnelle pour votre projet de gestion des salles et des réservations. N'hésitez pas à nous contacter si vous avez des questions ou des commentaires. Bon développement !