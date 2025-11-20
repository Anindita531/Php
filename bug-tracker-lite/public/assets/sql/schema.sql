CREATE DATABASE bugtracker;
USE bugtracker;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(120) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin', 'developer', 'reporter') DEFAULT 'reporter',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bugs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    priority ENUM('low', 'medium', 'high'),
    status ENUM('todo', 'in_progress', 'resolved', 'archived') DEFAULT 'todo',
    reporter_id INT,
    assignee_id INT,
    attachment VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (reporter_id) REFERENCES users(id),
    FOREIGN KEY (assignee_id) REFERENCES users(id)
);
