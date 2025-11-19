1️⃣ Create the file on your computer

Open any text editor (Notepad, VS Code, Sublime, etc.).

Copy the following content:

# Recipe Sharing Website

A simple PHP-based recipe sharing platform where users can create, view, like, comment, and share recipes. Users can also upload images of their cooked recipes.

## Features

- User authentication (login/register)
- Add, edit, and delete recipes
- Display recipe details including:
  - Title, description, cook time, difficulty, category
  - Main image
  - Author info
- Like system with real-time like count
- Comments system for each recipe
- Upload cooked images for each recipe
- Share recipes via:
  - Universal Share button (mobile & desktop)
  - Facebook, Twitter, WhatsApp links
- Responsive layout

## Technologies Used

- **Backend:** PHP, MySQL
- **Frontend:** HTML, CSS, JavaScript
- **Libraries:** None (vanilla JS)
- **Server:** Apache or any PHP-enabled web server

## Folder Structure



project/
│
├── assets/
│ ├── images/
│ └── js/
│
├── includes/
│ ├── db.php
│ ├── header.php
│ └── footer.php
│
├── add_comment.php
├── like_recipe.php
├── upload_cooked.php
├── edit_recipe.php
├── delete_recipe.php
├── recipe.php
└── index.php


## Installation

1. Clone the repository:

```bash
git clone https://github.com/username/recipe-website.git


Import the database.sql file to create the database and tables.

Update includes/db.php with your MySQL credentials.

Place the project in your web server directory (e.g., htdocs for XAMPP).

Open in your browser: http://localhost/recipe-website/

Usage

Register or login as a user.

Add a new recipe or browse existing ones.

Like, comment, or upload your cooked recipe images.

Share your favorite recipes using the share buttons.

Future Enhancements

Track the number of shares per recipe

Add user profile pages

Improve styling and mobile responsiveness

Add search and filter options
