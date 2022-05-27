# Praktikum Software Engineering

## Was ist das?
Hier ist das git repository für unsere Unterlagen (Code, Formulare, usw.) für unser Modul Praktikum Software Engineering.

## Ordnerstruktur
Hier wird die jeweilige Ordnerstruktur erklärt.

### /code
Hier werden alle Dateien bzgl. dem Code des Programmes gespeichert.

Welche Anwendung wir entwickeln, steht noch nicht fest. 

### /Protokolle
Hier werden alle Dateien, in dem die Protokolle festgehalten wurden, abgespeichert.

### /Ideen
Anregungen und Ideen bzgl. des Projektes.

## Installation

### Requirements
Wir brauchen die Packages:
- composer
- nodejs
- mysql
- docker

In den Projektordner wechseln:
```
cd code/praktikum_project
```
Alle weiteren Dependencies installieren:
```
composer install && npm install
```

### Authentifizierung durch Laravel-dependeny Passport
Um einen private- sowie public Key zu generieren, welcher für die Authentifizierung unerlässlich ist, muss vor dem Start
```
php artisan passport:install
```
ausgeführt werden. Falls das nicht ausgeführt wird die Authentifizierung nicht funktionieren.

### Datenbank
Bei mysql mit dem root-Nutzer anmelden (hat standardmäßig kein Passwort):
```
mysql -u root -p
```
Eine neue Datenbank erstellen, einen Nutzer hinzufügen und dem Nutzer die Berechtigungen für die Datenbank geben:
```
create database <DATABASE_NAME>;
create user '<USERNAME>'@'localhost' identified by '<PASSWORD>';
grant all privileges on <DATABASE_NAME>.* to '<USERNAME>'@'localhost';
```
Die .env Datei erstellen:
```
cp .env.example .env
```
Und die Datenbankverbindung einstellen:
```
DB_DATABASE=<DATABASE_NAME>
DB_USERNAME=<USERNAME>
DB_PASSWORD=<PASSWORD>
```
Die Tabellen in der Datenbank erzeugen:
```
php artisan migrate
```
Es kann sein, dass folgender Fehler kommt:<br>
`could not find driver (SQL: select * from information_schema.tables where table_schema = code_academy and table_name = migrations and table_type = 'BASE TABLE')`<br>
Sollte das passieren, muss man in der php.ini Datei bei einer Zeile den Kommentar entfernen (den ; am Anfang der Zeile entfernen):
```
;extension=pdo_mysql
```
Testdatensätze in die Datenbank spielen:
```
php artisan db:seed
```

### Docker
Der eigene Nutzer muss sich in der docker-Gruppe befinden. Für den Java Container:
```
cd code/docker_containers/java_docker
docker build -t java_run .
```
Für den Python Container:<br>
```
cd ../python_docker
docker build -t python_run .
```
Für den Javascript Container:<br>
Coming soon™