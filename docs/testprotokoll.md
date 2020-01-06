---
title: "Testprotokoll Music shuffle"
author: [Tatyana Vogel, Malte Dahlheim]
date: "2020-01-06"
titlepage: true
keywords: [GIBM, M151]
---

+--------------------------+---------------------------------------------------+
| **ID / Bezeichnung**     | **M151-1** / **Register**                         |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Beschreibung**         | Der/Die Nutzer\*In kann sich registrieren         |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Testvoraussetzung**    | - Der/Die Nutzer\*In ist nicht registriert        |
|                          | - Der/Die Nutzer\*In ist nicht angemeldet         |
+--------------------------+---------------------------------------------------+
| **Testschritte**         |  - Visit `/register`                              |
|                          |  - Fill out form                                  |
|                          |  - Submit                                         |
+--------------------------+---------------------------------------------------+
| **Erwartetes Ergebnis**  | - Der/Die Nutzer\*In ist registriert                |
|                          | - Das Registrieren schlägt fehl wenn der Username oder die E-Mail bereits existiert |
|                          | - Das Registrieren schlägt fehl die Passwörter nicht übereinstimmen                 |
+--------------------------+---------------------------------------------------+

+--------------------------+---------------------------------------------------+
| **ID / Bezeichnung**     | **M151-2** / **Login**                            |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Beschreibung**         | Der/Die Nutzer\*In kann sich anmelden             |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Testvoraussetzung**    | - Der/Die Nutzer\*In ist registriert              |
|                          | - Der/Die Nutzer\*In ist nicht angemeldet         |
+--------------------------+---------------------------------------------------+
| **Testschritte**         |  - Visit `/login`                                 |
|                          |  - Fill out form                                  |
|                          |  - Submit                                         |
+--------------------------+---------------------------------------------------+
| **Erwartetes Ergebnis**  | Der/Die Nutzer\*In ist angemeldet                 |
|                          | Das Login schlägt fehl die Passwörter nicht übereinstimmen |
|                          | Das Login schlägt fehl der/die Nutzer\*in nicht existiert  |
+--------------------------+---------------------------------------------------+

+--------------------------+---------------------------------------------------+
| **ID / Bezeichnung**     | **M151-3** / **Logout**                           |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Beschreibung**         | Der/Die Nutzer\*In kann sich abmelden             |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Testvoraussetzung**    | Der/Die Nutzer\*In ist angemeldet                 |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Testschritte**         |  - Visit `/logout`                                |
+--------------------------+---------------------------------------------------+
| **Erwartetes Ergebnis**  | - Der/Die Nutzer\*In ist abgemeldet               |
|                          |                                                   |
+--------------------------+---------------------------------------------------+

+--------------------------+---------------------------------------------------+
| **ID / Bezeichnung**     | **M151-4** / **Change Password**                  |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Beschreibung**         | Der/Die Nutzer\*In kann das Passwort ändern       |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Testvoraussetzung**    | - Der/Die Nutzer\*In ist registriert              |
|                          | - Der/Die Nutzer\*In ist angemeldet               |
+--------------------------+---------------------------------------------------+
| **Testschritte**         |  - Visit `/user/{id}/edit`                        |
|                          |  - Fill out form                                  |
|                          |  - Submit                                         |
+--------------------------+---------------------------------------------------+
| **Erwartetes Ergebnis**  | - Das Nutzer\*Innen Password wurde geändert         |
|                          | - Das Passwort Ändern schlägt fehl die Passwörter nicht übereinstimmen  |
+--------------------------+---------------------------------------------------+

+--------------------------+---------------------------------------------------+
| **ID / Bezeichnung**     | **M151-1** / **Create Playlist**                  |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Beschreibung**         | Der/Die Nutzer\*In kann eine Playlist erstellen   |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Testvoraussetzung**    | - Der/Die Nutzer\*In ist registriert              |
|                          | - Der/Die Nutzer\*In ist angemeldet               |
+--------------------------+---------------------------------------------------+
| **Testschritte**         |  - Visit `/playlists/create`                      |
|                          |  - Fill out form                                  |
|                          |  - Submit                                         |
+--------------------------+---------------------------------------------------+
| **Erwartetes Ergebnis**  | Eine neue Playlist wurde erstellt                 |
|                          |                                                   |
+--------------------------+---------------------------------------------------+

+--------------------------+---------------------------------------------------+
| **ID / Bezeichnung**     | **M151-2** / **Delete Playlist**                  |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Beschreibung**         | Der/Die Nutzer\*In kann eine seiner Playlisten    |
|                          | löschen                                           |
+--------------------------+---------------------------------------------------+
| **Testvoraussetzung**    | - Der/Die Nutzer\*In ist registriert              |
|                          | - Der/Die Nutzer\*In ist angemeldet               |
|                          | - Der/Die Nutzer\*In hat eine Playlist angemeldet |
+--------------------------+---------------------------------------------------+
| **Testschritte**         |  - Visit `/playlist/{id}/edit`                    |
|                          |  - Click Delete                                   |
|                          |  - Submit                                         |
+--------------------------+---------------------------------------------------+
| **Erwartetes Ergebnis**  | - Die Playlist wurde gelöscht                       |
|                          | - Request schlägt fehl wenn die Playlist nicht dem user gehört      |
+--------------------------+---------------------------------------------------+

+--------------------------+---------------------------------------------------+
| **ID / Bezeichnung**     | **M151-3** / **Can add song to playlist**         |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Beschreibung**         | Der/Die Nutzer\*In kann eine Song zur Playlist    |
|                          | hinzufügen                                        |
+--------------------------+---------------------------------------------------+
| **Testvoraussetzung**    | - Der/Die Nutzer\*In ist registriert              |
|                          | - Der/Die Nutzer\*In ist Angemeldet               |
|                          | - Es gibt eine Playlist                           |
+--------------------------+---------------------------------------------------+
| **Testschritte**         |  - Visit `/playlist`                              |
|                          |  - Click add Song                                 |
|                          |  - Fill out form                                  |
|                          |  - Submit                                         |
+--------------------------+---------------------------------------------------+
| **Erwartetes Ergebnis**  | - Der Song wurde zur Playlist hinzugefügt           |
|                          | - Request schlägt fehl der song in der Playlist ist   |
+--------------------------+---------------------------------------------------+

+--------------------------+---------------------------------------------------+
| **ID / Bezeichnung**     | **M151-4** / **No XSS**                           |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Beschreibung**         | Nutzereingaben werden escaped                     |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Testvoraussetzung**    | - Formular Feld                                   |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Testschritte**         |  - Fill out form with script tag                  |
|                          |  - Submit                                         |
|                          |  - Visit output                                   |
+--------------------------+---------------------------------------------------+
| **Erwartetes Ergebnis**  | Kein XSS möglich                                  |
|                          |                                                   |
+--------------------------+---------------------------------------------------+

+--------------------------+---------------------------------------------------+
| **ID / Bezeichnung**     | **M151-5** / **No SQL Injection**                 |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Beschreibung**         | Verhindert SQL Injections                          |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Testvoraussetzung**    | - Formular Feld or query                          |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Testschritte**         | - Fill out form with sql Statement                |
|                          | - Submit                                          |
+--------------------------+---------------------------------------------------+
| **Erwartetes Ergebnis**  | Keine SQL injection möglich                       |
|                          |                                                   |
+--------------------------+---------------------------------------------------+

+--------------------------+---------------------------------------------------+
| **ID / Bezeichnung**     | **M151-6** / **NO CSRF**                          |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Beschreibung**         | Verhindert CSRF angriffe                          |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Testvoraussetzung**    | - Der/Die Nutzer\*In ist  angemeldet              |
|                          |                                                   |
+--------------------------+---------------------------------------------------+
| **Testschritte**         | - Submit POST without CSRF token                  |
|                          | - Submit POST with forged token                   |
+--------------------------+---------------------------------------------------+
| **Erwartetes Ergebnis**  | Request schlägt fehl                              |
|                          |                                                   |
+--------------------------+---------------------------------------------------+

+----------------------------------+---------------------------------------------------+
| **Tester**                       | Malte Dahlheim                                    |
|                                  |                                                   |
+-----------------------------------+---------------------------------------------------+
| **Datum Testdurchführung**       | 2020-01-06 19:18:05                               |
|                                  |                                                   |
+----------------------------------+----------------------------------------------------+
| **Fehlerklasse (Testergebnis)**  | OK                                                |
|                                  |                                                   |
+----------------------------------+---------------------------------------------------+
| **Fehlerbeschreibung**           | Keine                                             |
+----------------------------------+---------------------------------------------------+
