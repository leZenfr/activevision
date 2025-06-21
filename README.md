# Installation de l'application web

### Étape 1 : Installer le projet

Préparer tous les packages nécessaires
```
sudo apt update && sudo apt install apache2 php php-cli php-mbstring php-xml php-bcmath php-curl php-mysql unzip curl mariadb-server mariadb-client phpmyadmin composer git python3 python3-pip python3-venv nodejs -y
```
Installer le projet dans le répertoire `/var/www/`
```
cd /var/www/
git clone https://github.com/leZenfr/activevision.git
```
Il faut ensuite installer les dépendances 
```
cd activevision/

composer install
npm install
```
### Étape 2 : Configurer l'application et la base de données

IMPORTANT : Il faut rester dans le répertoire `/var/www/activevision`

Créer la base de données
```
mysql -u root -p -e "CREATE DATABASE ads;"
```

Créer l'utilisateur pour la base de données
```
mysql -u root -p

CREATE USER 'webmaster'@'localhost' IDENTIFIED BY 'webmaster';

GRANT ALL PRIVILEGES ON ads.* TO 'webmaster'@'localhost';

FLUSH PRIVILEGES;
```

Sauvegarder et configurer le fichier d'environnement
```
cp .env.example .env
```
Mettre les informations de la base de données
```
nano .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ads
DB_USERNAME=root
DB_PASSWORD=
```

Paramétrer mysql pour rendre la base compatible
```
nano /etc/mysql/my.cnf
```

Rajouter cette ligne à la fin
```
[mysqld]
sql_mode=""
```

Build l'application
```
npm run build
```

Faire les migrations
```
php artisan migrate
```

Créer la clé 
```
php artisan key:generate
```

### Étape 3 : Démarrer l'application 
```
php artisan serve --host=0.0.0.0 --port=8000
```
