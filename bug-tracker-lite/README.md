# Bug Tracker Lite

A lightweight bug tracking system built with **PHP** and **MySQL**.  
Designed to help teams track, manage, and resolve software issues (bugs) in a simple, intuitive way.

---

## 🚩 Features

- Report bugs with title, description, severity, status  
- User authentication (login/logout)  
- Role-based users: Reporter, Developer, Admin  
- Change bug status (Open, In Progress, Resolved, Closed)  
- Comment on bug reports  
- Assign bugs to users  
- Track bug history (status changes, who changed what)  
- Simple dashboard to view all bugs / my bugs  

---

## 🧱 Project Structure

bug-tracker-lite/
├── public/
│ ├── index.php # List of bugs / dashboard
│ ├── bug.php # View a single bug
│ ├── new_bug.php # Report a new bug
│ ├── edit_bug.php # Edit bug (status / assignment)
│ ├── login.php
│ └── assets/ # CSS, JS, images
├── src/
│ ├── Controllers/ # BugController, UserController, etc.
│ ├── Models/ # Bug, User models
│ ├── Services/ # Business logic (assigning, updating)
│ └── Helpers/ # Utility functions (validation, sanitization)
├── config/
│ └── db.php # Database connection config
├── views/
│ ├── bugs/ # Bug list, bug detail
│ ├── auth/ # Login form
│ └── layout/ # Header, footer templates
├── tests/ # PHPUnit tests (if any)
├── composer.json # Composer config (if using Composer)
└── README.md

yaml
Copy code

---

## 🛠️ Requirements

- PHP **7.4** or higher (modify as per your version)  
- MySQL / MariaDB database  
- Web server (Apache, Nginx, etc.)  
- (Optional) Composer, if you are using it for autoloading or dependencies  

---

## ⚙️ Installation & Setup

1. Clone the repo:  
   ```bash
   git clone https://github.com/Anindita531/Php.git
   cd Php/bug-tracker-lite
Setup the database:

Create a new MySQL database, e.g. bugtracker

Import the SQL schema / table definitions (if you have a .sql file)

Configure the database connection:

Open config/db.php

Set your database host, username, password, and database name

(If using Composer) Install dependencies:

bash
Copy code
composer install
Run the app:

If using PHP built-in server:

bash
Copy code
php -S localhost:8000 -t public
Or place it in your local server’s web root and access via browser (e.g. http://localhost/bug-tracker-lite/public)

👥 Usage
Go to the login page (login.php)

Once logged in:

Report a new bug

View list of bugs (all / assigned to you)

Click on a bug to view details and comments

Change bug status or assign to someone (if you have correct role)

Comment on bugs

🔒 Security & Best Practices (What’s Implemented / What to Improve)
Input validation & sanitization for bug report forms

Prepared statements or parameterized queries for DB operations

Secure password handling (e.g., password_hash() / password_verify())

Session-based authentication (with session regeneration)

(Optional) CSRF protection for forms

🧪 Testing
Tests are located in the tests/ directory (if using PHPUnit)

To run tests (if configured):

bash
Copy code
./vendor/bin/phpunit
🗂️ Future Improvements / Roadmap
Bug categories / tags (e.g. UI bug, backend bug)

Email notifications for bug assignment or status changes

File attachments for bug reports (screenshots, logs)

Dashboard analytics (number of bugs by status, by user)

Multi-project support (track bugs for multiple projects)

REST API for bug operations

Role-based permissions: more roles (QA, Manager)

🤝 Contributing
Contributions are very welcome! Here’s how to help:

Fork the repo

Create a feature branch: git checkout -b feature/YourFeature

Make changes & add tests (if applicable)

Commit: git commit -m "Add some feature"

Push to the branch: git push origin feature/YourFeature

Open a Pull Request

📜 License
This project is licensed under the MIT License. See the LICENSE file for details.
