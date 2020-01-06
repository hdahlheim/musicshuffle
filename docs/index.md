# Dokumentation Music shuffle
- [Dokumentation Music shuffle](#dokumentation-music-shuffle)
  - [Glossar](#glossar)
  - [Projekt Planung](#projekt-planung)
  - [Projekt Aufbau](#projekt-aufbau)
    - [Framework](#framework)
    - [Templating und CSS](#templating-und-css)
    - [Eigene Logik](#eigene-logik)
  - [Überprüfung der Nutzereingaben](#%c3%9cberpr%c3%bcfung-der-nutzereingaben)
  - [Script Injection](#script-injection)
  - [CSRF Protection](#csrf-protection)
  - [Testing](#testing)

## Glossar

| Begriff | Bedeutung                                                                                                          |
| ------- | ------------------------------------------------------------------------------------------------------------------ |
| Wir     | Wenn der Begriff `Wir` in dieser Dokumentation verwendet wird ist immer von Frau Vogel und Herr Dahlheim die Rede. |
| CSRF    | Cross Site Request Forgery                                                                                         |
|         |                                                                                                                    |
|         |                                                                                                                    |

## Projekt Planung

## Projekt Aufbau

In diesem Kapitel wir der Aufbau es Projektes Beschrieben

### Framework

Die ursprüngliche version des Projekts war als mit dem SLIM Framework geplant.
Nach langem hin und er stellte sich aber heraus, dass das Projekt Skelett,
welches wir verwendet hatte etwas zu viel Magie beinhaltet.

Nach kurzer Recherche entschieden wir uns das Projekt neu aufzusetzen, dieses
mal auf mithilfe der PHP Library [Siler](https://siler.leocavalcante.dev/) von
[Leo Cavalcante](https://leocavalcante.dev). Siler ist ein PHP Library die Stark
von Prinzipien der funktionalen Programmierung inspiriert ist. Etwas was besonders
für Siler sprach, war das die Library aus relativ wenigen leicht verständlichen
Funktionen besteht. Siler macht keine Annahmen darüber wie die Funktionen
eingesetzt werden.

Wir verwenden Siler hauptsächlich für das URL Routing aber hier und da nutzen
Wir ein paar der Helferfunktionen z. B. für den sichern zugriff auf die PHP
Superglobalen Variablen wie `$_SESSION`, `$_GET`, `$_POST`.

### Templating und CSS

Für Templates des Projektes verwenden wir Twig. Diese entscheid wurde getroffen,
weil Wir uns als Team einig waren, das PHP keine schöne Templating Sprache ist.
Auch half uns diese Entscheidung Logik und Views deutlicher von einander zu
trennen.

Als CSS Framework verwenden wir das Utility Framework
[Tailwindcss](https://tailwindcss.com). Tailwindcss erlaubt es uns, das wir uns
beim erstellen der Templates verstärkt auf den Markup code fokussieren können
und uns nicht über vermeintlich nützliche CSS Klassen Namen den Kopf zerbrechen
müssen. Auch zwingt und Tailwindcss nicht in vorgegebene Markup Strukturen hinein
wie es bei manchen anderen General-purpose CSS Frameworks der fall ist.

### Eigene Logik

Dem Vorbild von Siler folgend verwenden wir in unserem gesamten Projekt in
Namespaces unterteilte Funktionen. Dies mag auf den ersten Blick ungewöhnlich
erschienen, erwies sich in der Praxis aber genauso geeignet zum organisieren des
Programmcodes wie ein standard OOP PHP Projekt, einzig composer hat mit dem
Autoimport von Funktionen in Namespaces noch Probleme.

Alle Businesslogik Funktionen befinden sich im Verzeichnis `funktions`

Insgesamt unterteilt sich unsere Anwendung in fünf Namespaces.

| Namespace  | Anwendungsbereich                                |
| ---------- | ------------------------------------------------ |
| Auth       | Funktionen für die Authentifizierung des Nutzers |
| Database   | Funktionen für das Arbeiten mit der Datenbank    |
| Errors     | Funktionen für das Verarbeiten von Fehlern       |
| Validators | Funktionen für das Validieren von Eingaben       |
| YouTubeAPI | Funktionen für das Arbeiten mit der YouTube API  |

## Überprüfung der Nutzereingaben

In dem Project Musicshuffle werden alle Nutzereingaben Überprüft, die dafür
verwendeten Funktionen befinden sich im Verzeichnis

## Script Injection

## CSRF Protection

## Testing
