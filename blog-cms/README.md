📚 Blog CMS

A lightweight, fast, and customizable Content Management System (CMS) built using PHP and MySQL. This project provides complete CRUD functionality for blog posts, user authentication, categories, and an admin dashboard to manage content easily.

🚀 Features
✅ Core Features

Create, Read, Update, Delete (CRUD) blog posts

User authentication (login/logout)

Role-based access (Admin / Author)

Category management

Comment system (optional or implemented)

SEO-friendly post URLs (slugs)

Responsive front-end UI

Secure form handling

🔐 Security

Password hashing using password_hash()

Prepared statements (SQL injection protected)

Input sanitization

Session-based authentication

CSRF protection for forms (optional / addable)

🧱 Project Structure
blog-cms/
├── config/
│   └── db.php          # Database connection
├── public/
│   ├── index.php       # Homepage (list of posts)
│   ├── post.php        # Single post page
│   ├── login.php
│   ├── logout.php
│   ├── admin/          # Admin dashboard
│   └── assets/         # CSS, JS, Images
├── src/
│   ├── Controllers/    # Business logic
│   ├── Models/         # DB models
│   └── Helpers/        # Utility functions
├── views/
│   ├── layouts/
│   ├── posts/
│   ├── admin/
│   └── auth/
└── README.md


(Adjust this according to your actual structure. I can rewrite it after checking your file tree.)

🛠️ Tech Stack

PHP 8+

MySQL / MariaDB

HTML5, CSS3, Bootstrap

JavaScript

Composer (optional)

📥 Installation & Setup
1️⃣ Clone the repository
git clone https://github.com/Anindita531/Php.git
cd Php/blog-cms

2️⃣ Configure the database

Create a new MySQL database

blogcms


Import the SQL file (if available)

blogcms.sql

3️⃣ Update DB configuration in config/db.php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "blogcms";

▶️ Run the Project

If using XAMPP or WAMP:

Place folder inside htdocs/

Start Apache + MySQL

Visit:

http://localhost/blog-cms/public/

🗂️ Admin Dashboard

Login at:

/public/login.php


Default credentials (optional):

Email: admin@example.com
Password: admin123

📸 Screenshots (Optional)

(Add after updating your repo)

Homepage

Admin dashboard

Create post form

Post view page

📌 Future Enhancements

REST API for posts & users

WYSIWYG editor (TinyMCE / CKEditor)

Scheduled posts

User profile page

Tags and filtering

Image uploader with validation

Dark mode UI

🤝 Contributing

Pull requests are welcome!
If you'd like to improve features, documentation, or code quality, feel free to contribute.

📜 License

This project is released under the MIT License.
