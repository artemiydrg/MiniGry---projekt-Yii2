# 🎮 MiniGry – Projekt Zaliczeniowy

Dzień dobry, z tej strony student **Artem Semenko**, kierunek Informatyka, 5 semestr.

Przygotowałem dla Pana krótką i prostą instrukcję, jak poprawnie uruchomić mój projekt **„MiniGry"** – serwis z grami przeglądarkow wykonany w frameworku **Yii2** (PHP) z bazą danych **MySQL**.

Z wyrazami szacunku – proszę przejść do poniższych kroków.

---

## 📋 WYMAGANIA

- Program **XAMPP** (Apache + MySQL + PHP 8.x)
- **Composer** (menedżer pakietów PHP)
- Przeglądarka internetowa (Chrome, Firefox, Edge)

---

## 🚀 KROK 1: INSTALACJA PLIKÓW

1. Zainstalować program **XAMPP** (jeśli nie jest zainstalowany): https://www.apachefriends.org
2. Pobrać projekt z GitHub i skopiować folder `yii2minigry` do lokalizacji:
```
C:\xampp\htdocs\yii2minigry\
```
3. Otworzyć terminal (CMD lub PowerShell) w folderze projektu i wykonać:
```bash
cd C:\xampp\htdocs\yii2minigry
composer install
```
> ⏳ Poczekać na zakończenie instalacji (2–5 minut)

---

## 🗄️ KROK 2: KONFIGURACJA BAZY DANYCH

1. Otworzyć **XAMPP Control Panel**
2. Włączyć moduły **Apache** oraz **MySQL** (przycisk `Start`)
3. W przeglądarce wejść na stronę:
```
http://localhost/phpmyadmin
```
4. Po lewej stronie kliknąć **„Nowa"** i utworzyć bazę danych o nazwie:
```
minigryver2
```
5. Wybrać zakładkę **„Importuj"**
6. Kliknąć **„Wybierz plik"** i wskazać plik:
```
C:\xampp\htdocs\yii2minigry\minigryver2.sql
```
7. Na dole strony kliknąć **„Wykonaj"**

---

## ⚙️ KROK 3: KONFIGURACJA POŁĄCZENIA Z BAZĄ

Otworzyć plik `config/db.php` i upewnić się, że dane są poprawne:

```php
<?php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=minigryver2',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
];
```

---

## 🌐 KROK 4: URUCHOMIENIE STRONY

1. Otworzyć przeglądarkę
2. Wpisać w pasek adresu:
```
http://localhost/yii2minigry/web/
```

---

## 🔐 DANE TESTOWE DO LOGOWANIA

| Login | Hasło |
|-------|-------|
| `TestPlayer` | `test123` |
| `123` | `123456` |
| `ArtemSemenko` | `artem123` |

> Można również utworzyć nowe konto za pomocą opcji **„Zarejestruj się"**

---

## 🎮 DOSTĘPNE GRY

| Gra | Opis | Punkty |
|-----|------|--------|
| ❌⭕ Kółko i Krzyżyk | Graj przeciwko komputerowi | +10 za wygraną |
| 🎯 Kliknij Cele | Klikaj cele jak najszybciej | Punkty za celność |
| 🐍 Wąż | Klasyczna gra Snake | Punkty za wynik |
| 🖱️ Clicker | Klikaj jak najszybciej przez 10 sekund | Punkty za kliknięcia |
| 🃏 Memory | Znajdź pary kart | Punkty za pamięć |
| 🧱 Breakout | Rozbij wszystkie bloki | Punkty za bloki |

---

## 📁 STRUKTURA PROJEKTU (Yii2)

```
yii2minigry/
├── config/
│   ├── db.php              ← konfiguracja bazy danych
│   └── web.php             ← główna konfiguracja
├── controllers/
│   ├── SiteController.php  ← logowanie, rejestracja, strona główna
│   ├── GameController.php  ← wszystkie gry + zapis wyników
│   ├── ProfileController.php ← profil użytkownika
│   └── RankingController.php ← ranking graczy
├── models/
│   ├── User.php            ← model użytkownika
│   ├── Games_results.php   ← model wyników gier
│   ├── LoginForm.php       ← formularz logowania
│   └── RegisterForm.php    ← formularz rejestracji
├── views/
│   ├── layouts/main.php    ← główny szablon (navbar, footer)
│   ├── site/               ← strona główna, logowanie, rejestracja
│   ├── game/               ← widoki gier (6 gier)
│   ├── profile/            ← profil i statystyki
│   └── ranking/            ← ranking graczy
├── web/
│   ├── index.php           ← punkt wejścia aplikacji
│   └── .htaccess           ← konfiguracja URL
└── minigryver2.sql         ← baza danych
```

---

## 🛠️ TECHNOLOGIE

- **Backend:** PHP 8.x, Yii2 Framework
- **Frontend:** HTML5, CSS3, Bootstrap 5, JavaScript
- **Baza danych:** MySQL (phpMyAdmin)
- **Serwer lokalny:** XAMPP (Apache)

---

W razie potrzeby chętnie udzielę dodatkowych wyjaśnień.

Dziękuję za czas poświęcony na ocenę mojego projektu. 🙏🙂

**Artem Semenko** | Informatyka | 6 semestr
