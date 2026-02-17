CREATE DATABASE IF NOT EXISTS student_management;
USE student_management;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);

-- Sample Data for Students
INSERT INTO students (name, email) VALUES 
('John Doe', 'john@example.com'),
('Jane Smith', 'jane@example.com'),
('Bob Johnson', 'bob@example.com'),
('Alice Williams', 'alice@example.com'),
('Charlie Brown', 'charlie@example.com'),
('Diana Prince', 'diana@example.com'),
('Ethan Hunt', 'ethan@example.com'),
('Fiona Green', 'fiona@example.com'),
('Grace Lee', 'grace@example.com'),
('Henry Davis', 'henry@example.com'),
('Ivy Chen', 'ivy@example.com'),
('Jack Wilson', 'jack@example.com'),
('Kevin White', 'kevin@example.com'),
('Lily Black', 'lily@example.com'),
('Michael Scott', 'michael@dundermifflin.com'),
('Pam Beesly', 'pam@dundermifflin.com'),
('Jim Halpert', 'jim@dundermifflin.com'),
('Dwight Schrute', 'dwight@schrutefarms.com'),
('Angela Martin', 'angela@accountant.com'),
('Oscar Martinez', 'oscar@accountant.com'),
('Kevin Malone', 'kevin@cookies.com'),
('Stanley Hudson', 'stanley@pretzelday.com'),
('Phyllis Vance', 'phyllis@vancerefrigeration.com'),
('Toby Flenderson', 'toby@hr.com');
