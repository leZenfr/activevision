# Installation de l'application web

### Étape 1 : Installer le projet

Préparer tous les packages nécessaires
```
sudo apt update && sudo apt install apache2 php php-cli php-mbstring php-xml php-bcmath php-curl php-mysql unzip curl mariadb-server mariadb-client phpmyadmin composer git python3 python3-pip python3-venv -y
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
