# Instructions pour GitHub Copilot — NiceAssoSport

## Contexte du projet

**NiceAssoSport** est une application web de gestion d'une association sportive de la ville de Nice, développée en **Laravel (PHP)**.

Elle permet de gérer :
- Les **clubs** sportifs
- Les **adhérents** (membres des clubs)
- Les **disciplines** pratiquées
- Les **compétitions** organisées par les clubs
- Les **inscriptions** des adhérents aux compétitions
- Les **rôles** des adhérents (relation many-to-many)

## Stack technique

- **Backend** : Laravel 11, PHP, Eloquent ORM
- **Routing** : Spatie Route Attributes (attributs directement dans les controllers)
- **Frontend** : Blade templates, CSS custom (pas de framework CSS externe)
- **Base de données** : MySQL, tables en MAJUSCULES (`CLUB`, `ADHERENT`, `COMPETITION`, `DISCIPLINE`, `INSCRIPTION`)
- **Tests** : PHPUnit

## Conventions de code existantes

- Les noms de tables sont en **MAJUSCULES** (ex: `ADHERENT`, `CLUB`)
- Les clés primaires suivent le pattern `NOM_ID` (ex: `ADH_ID`, `CLU_ID`, `DIS_ID`)
- Les colonnes suivent le pattern `PREFIXE_NOMCOLONNE` (ex: `ADH_NOM`, `CLU_MAIL`)
- `public $timestamps = false;` sur tous les modèles
- Les relations Eloquent sont définies dans les modèles (`belongsTo`, `hasMany`, `belongsToMany`)
- Les routes sont déclarées via attributs Spatie dans les controllers, sauf la route `/` dans `routes/web.php`
- Les vues sont organisées par entité dans `resources/views/` (`club/`, `adherents/`, `competitions/`, etc.)
- Les layouts partagés sont dans `resources/views/layouts/`

## Règles pour l'agent

1. **Travailler uniquement dans ce workspace** (`/home/evan/niceassosport`). Ne jamais créer, lire ou modifier de fichiers en dehors de ce dossier. En particulier, **ne jamais utiliser `/tmp`** ou tout autre répertoire système extérieur au workspace.

2. **Respecter l'architecture existante** — ne pas inventer de nouveaux patterns, nouvelles structures de dossiers ou nouvelles conventions. Suivre ce qui existe déjà.

3. **Respecter la charte graphique existante** — utiliser les CSS déjà présents (`public/css/auth.css`, `public/css/dashboard.css`, `resources/css/app.css`). Ne pas introduire de nouveaux frameworks CSS (pas de Bootstrap, pas de Tailwind).

4. **Respecter les conventions de nommage** des tables et colonnes décrites ci-dessus.

5. **Ne pas surcharger** : ne pas ajouter de logique, de fonctionnalités ou de fichiers non demandés. Rester strictement dans le périmètre de la demande.

6. **Blade** pour toutes les vues. Pas de JavaScript framework (pas de Vue, pas de React).
