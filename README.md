# Plateforme de Mise en Relation – Laravel

Plateforme web développée avec **Laravel** permettant de mettre en relation des **candidats** et des **recruteurs**, avec authentification sécurisée, profils avancés, recherche intelligente et un **système d’amitié en AJAX**.

---

## Stack technique

- **Backend** : Laravel
- **Auth** : Laravel Breeze
- **Frontend** : Blade + Tailwind CSS
- **AJAX** : Fetch API (JavaScript)
- **Base de données** : MySQL
- **Stockage** : Laravel Storage (photos, CV)
- **Sécurité** : CSRF, validation via FormRequest

---

## Fonctionnalités principales

### Authentification
- Inscription / Connexion (Laravel Breeze)
- Vérification email
- Gestion des rôles (`candidat`, `recruteur`)

---

### Profils utilisateurs
Chaque utilisateur possède :
- Nom
- Email
- Photo (ou avatar anonyme)
- Biographie
- Rôle (Candidat / Recruteur)

#### Profil Candidat
- Spécialité
- Années d’expérience
- Compétences
- CV téléchargeable

#### Profil Recruteur
- Nom de l’entreprise
- Localisation
- Description de l’entreprise
- Site web

---

### Recherche d’utilisateurs
- Recherche par **nom** ou **spécialité**
- Affichage dynamique des résultats
- Affichage conditionnel selon le rôle
- Photo réelle ou avatar anonyme automatique

---

### Système d’amitié (AJAX)

- ➕ Envoyer une invitation d’ami
- ⏳ Invitation en attente
- ✅ Accepter une invitation
- ❌ Refuser une invitation
- 👥 Détection automatique :
  - Déjà amis
  - Invitation envoyée
  - Invitation reçue
- ⚡ Sans rechargement de page (AJAX)

---

## Base de données

### Table `users`
Champs principaux :
- nom
- email
- role
- photo
- biographie

### Table `profil_candidats`
- user_id
- specialite
- annees_experience
- competences
- cv

### Table `profil_recruteurs`
- user_id
- nom_entreprise
- localisation
- description_entreprise
- site_web

### Table `amities`

```php
Schema::create('amities', function (Blueprint $table) {
    $table->id();
    $table->foreignId('id_expediteur')->constrained('users')->onDelete('cascade');
    $table->foreignId('id_destinataire')->constrained('users')->onDelete('cascade');
    $table->enum('statut', ['pending', 'accepted', 'rejected']);
    $table->timestamps();
});
### Installation

```
git clone https://github.com/votre-repo/projet.git
cd projet
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve