
-- Create database
CREATE DATABASE IF NOT EXISTS job_portal;
USE job_portal;

-- Admin table
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert default admin
INSERT INTO admin (username, password) VALUES ('admin', MD5('admin123'));

-- Jobs table
CREATE TABLE IF NOT EXISTS jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    company VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    salary INT NOT NULL,
    type VARCHAR(50) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample jobs
INSERT INTO jobs (title, company, location, salary, type, description) VALUES
('Web Developer', 'ABC Technologies', 'Pune', 35000, 'Full Time', 'Develop and maintain web apps.'),
('Graphic Designer', 'XYZ Studios', 'Mumbai', 25000, 'Part Time', 'Design logos and social media posts.'),
('Data Analyst', 'DataCorp', 'Bangalore', 45000, 'Full Time', 'Analyze data and generate reports.');

-- Applications table
CREATE TABLE IF NOT EXISTS applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15),
    resume TEXT,
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE
);
