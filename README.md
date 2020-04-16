# TYPO3 Docker Vorlage

## Inhalt

- **Site Package (typo3conf/ext/site_package)**: Enhält Basis Setup und Templates
- **Example Extension (typo3conf/ext/example)**: Enthält Beispiele zum Anlegen neuer Elemente
- **Docker Files (docker, docker-compose.yml)**: Umgebung für Docker mit Services für Templates, TYPO3 und Datenbank

## Site Package

### Site Package einrichten

- Site Package Extension in Projektnamen umbenennen und alle Vorkommnisse von _site_package_ und _Site Package_ durch den neuen Namen ersetzen
- **ext_emconf.php**: Name, Description etc. anpassen
- Extension Icon als **Resources/Public/Icons/Extension.png** oder **Resources/Public/Icons/Extension.svg** ablegen
- **constants.typoscript**: baseURL anpassen
- **gulpfile.js**: Alle Vorkommnisse von _site_package_ durch den neuen Namen ersetzen

#### Backend

- Site Package Extension unter _Extensions_ aktivierten
- Startseite anlegen
  - bei _Behaviour_ das Feld _Use as Root Page_ aktivieren.
  - TSConfig für das Site Package unter _Resources_ hinzufügen
- Template auf der Startseite anlegen
  - bei _Access_ das Feld _Rootlevel_ aktivieren
  - Unter _Includes_ folgende Typoscript Konfigurationen hinzufügen
    - Fluid Content Elements
    - Grid Elements, wenn benötigt
    - Site Package

### Configuration: TCA

- **pages.php**: Neue Felder, Palettes etc. für Seiten hinzufügen
- **tt_content.php**: Neue Inhaltselemente, Felder, Palettes etc. hinzufügen

### Configuration: TS Config

- **config.typoscript**: Content Element Wizard, Content Element Felder und Linkhandler konfigurieren
- **BackendLayout/**: Pro Backend Layout eine Datei anlegen
- **GridElement/**: Pro Grid Element eine Datei anlegen
- **Extension/**: Pro Grid Element eine Datei anlegen

### Configuration: TypoScript

- **constants.typoscript**: Base Url, Default Header Type, Max Bildbreite, Sprache, Staging und Development Settings konfigurieren
- **setup.typoscript**: Linkhandler konfigurieren
- **ContentElement/**: Pro Backend Layout eine Datei anlegen
- **Extension/**: Pro Grid Element eine Datei anlegen
- **Page/**: Pro Template eine neue Datei anlegen
- **Page/page.typoscript**: CSS und JS hinzufügen, Backend Layouts hinterlegen, Template Settings, Variables und Data Processors hinzufügen

### Resources: Private

- **Language/locallang.xlf**: Übersetzungen für Frontend anlegen
- **Language/locallang_be.xlf**: Übersetzungen für Backend anlegen
- **Language/locallang_db.xlf**: Übersetzungen für Datenbank anlegen

## Example Extensions

### Inhalt

Die Extension enhält Beispiele für

- Backend Layouts
- Content Elemente
- Grid Elements
- Menüs
- Header Layouts
- Frame Classes
- Templates
- Übersetzungen
- Linkhandler

### Einrichtung

Analog zu Site Package.

## Docker

### Docker einrichten

- **docker-composer.yml**: Domains anpassen

### Docker Files

- **Makefile**: Enhält nütztliche Shortcuts
- **docker-compose.yml**: Konfiguration für Services, Volumes etc. (Alle Vorkommnisse von _example_ durch den neuen Namen ersetzen)
- **docker/typo3/Dockerfile**: Build File für das Typo3-Image, installiert TYPO3 und konfiguriert Volumes (basiert auf https://hub.docker.com/r/martinhelmich/typo3/)

### TYPO3 Installation

- Um die Typo3-Installation beim ersten Aufruf anzustoßen muss die Datei FIRST_INSTALL im Container erzeugt werden. Dafür muss nach dem Starten des Containers der Befehl `docker exec -i CONTAINER_ID touch /var/www/html/FIRST_INSTALL` ausgeführt werden. Die CONTAINER_ID kann man mit `docker container ls` herausfinden.
- Die Zugangsdaten für die Datenbank stehen in der **docker-compose.yml**, als Host muss _database_ angegeben werden. Bei der Datenbankauswahl wird die existierende leere Datenbank _typo3_ ausgewählt.

### Weitere Infos für Docker

- Traefik muss eingerichtet sein, damit die Seite aufrufbar ist (https://bitbucket.org/bitbucket-mokom01/docker-traefik/). Der Aufruf über _localhost_ ist deaktiviert, um Port-Kollisionen zwischen Projekten zu verhindern.
- Die zu verwendenden Domains werden in **docker-compose.yml** mit dem Label `traefik.frontend.rule` definiert. Für einen Container können mehrere mit Kommas getrennte Domains angegeben werden.
- Standardmäßig ist der Datenbank-Container nicht von außen erreichbar, um zu verhindern, dass beim Starten des Container ein Fehler wegen Port-Kollisionen entsteht. Falls nötig, kann der externe Port zeitweise aktiviert werden. Dafür müssen die entsprechenden Zeilen in **docker-compose.yml** einkommentiert werden und der Container neu gestartet werden. **Bitte die Zeilen direkt nach dem Neustart wieder auskommentieren, damit die Änderung nicht aus Versehen gepusht wird.**

## Nützliche Links

- **Icons**: https://typo3.github.io/TYPO3.Icons/
