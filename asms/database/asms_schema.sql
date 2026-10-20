-- ASMS Database Schema
CREATE DATABASE IF NOT EXISTS `asms_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `asms_db`;

CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE permissions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role_id INT NOT NULL,
  full_name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  status ENUM('active','inactive') DEFAULT 'active',
  last_login DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE RESTRICT
);

CREATE TABLE user_roles (
  user_id INT NOT NULL,
  role_id INT NOT NULL,
  PRIMARY KEY (user_id, role_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE aircraft (
  id INT AUTO_INCREMENT PRIMARY KEY,
  aircraft_code VARCHAR(50) NOT NULL,
  aircraft_type VARCHAR(100),
  manufacturer VARCHAR(100),
  model VARCHAR(100),
  serial_number VARCHAR(100),
  registration_number VARCHAR(100),
  status VARCHAR(50) DEFAULT 'active',
  created_by INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE aircraft_components (
  id INT AUTO_INCREMENT PRIMARY KEY,
  aircraft_id INT NOT NULL,
  component_name VARCHAR(150) NOT NULL,
  serial_number VARCHAR(150),
  health_score INT DEFAULT 100,
  risk_level VARCHAR(50),
  operating_hours INT DEFAULT 0,
  cycles INT DEFAULT 0,
  condition_status VARCHAR(50) DEFAULT 'Good',
  next_maintenance DATE NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  FOREIGN KEY (aircraft_id) REFERENCES aircraft(id) ON DELETE CASCADE
);

CREATE TABLE incidents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  incident_number VARCHAR(100) NOT NULL UNIQUE,
  aircraft_id INT,
  reported_by INT,
  incident_type VARCHAR(100),
  severity ENUM('Minor','Serious','Critical') DEFAULT 'Minor',
  location VARCHAR(255),
  latitude DECIMAL(10,7) NULL,
  longitude DECIMAL(10,7) NULL,
  date_occurred DATE,
  description TEXT,
  fatalities INT DEFAULT 0,
  injuries INT DEFAULT 0,
  status ENUM('Open','In Progress','Closed') DEFAULT 'Open',
  investigation_notes TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  FOREIGN KEY (aircraft_id) REFERENCES aircraft(id) ON DELETE SET NULL,
  FOREIGN KEY (reported_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE hazards (
  id INT AUTO_INCREMENT PRIMARY KEY,
  hazard_number VARCHAR(100) NOT NULL UNIQUE,
  title VARCHAR(200) NOT NULL,
  description TEXT,
  location VARCHAR(255),
  reported_by INT,
  assigned_to INT,
  severity VARCHAR(50),
  status VARCHAR(50) DEFAULT 'Open',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (reported_by) REFERENCES users(id) ON DELETE SET NULL,
  FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE risks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  description TEXT,
  category VARCHAR(100),
  likelihood INT DEFAULT 1,
  impact INT DEFAULT 1,
  risk_score INT GENERATED ALWAYS AS (likelihood * impact) VIRTUAL,
  level VARCHAR(50),
  mitigation_plan TEXT,
  owner INT,
  status VARCHAR(50) DEFAULT 'Open',
  due_date DATE NULL,
  created_by INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  FOREIGN KEY (owner) REFERENCES users(id) ON DELETE SET NULL,
  FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE maintenance_records (
  id INT AUTO_INCREMENT PRIMARY KEY,
  aircraft_id INT,
  component_id INT,
  maintenance_type VARCHAR(100),
  maintenance_date DATE,
  next_due_date DATE NULL,
  technician INT,
  condition_before TEXT,
  condition_after TEXT,
  notes TEXT,
  status VARCHAR(50) DEFAULT 'Completed',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (aircraft_id) REFERENCES aircraft(id) ON DELETE SET NULL,
  FOREIGN KEY (component_id) REFERENCES aircraft_components(id) ON DELETE SET NULL,
  FOREIGN KEY (technician) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE alerts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200),
  message TEXT,
  severity VARCHAR(50),
  status VARCHAR(50) DEFAULT 'active',
  created_by INT,
  acknowledged_by INT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
  FOREIGN KEY (acknowledged_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE notifications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  title VARCHAR(200),
  message TEXT,
  type VARCHAR(50),
  is_read TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE audit_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  action VARCHAR(100),
  entity_type VARCHAR(100),
  entity_id INT NULL,
  old_value TEXT,
  new_value TEXT,
  ip_address VARCHAR(45),
  user_agent VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE reports (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200),
  type VARCHAR(50),
  generated_by INT,
  file_path VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (generated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE compliance_checklists (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200),
  category VARCHAR(100),
  description TEXT,
  status VARCHAR(50) DEFAULT 'open',
  assigned_to INT,
  due_date DATE NULL,
  completed_at TIMESTAMP NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE corrective_actions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  compliance_id INT,
  incident_id INT,
  description TEXT,
  assigned_to INT,
  due_date DATE NULL,
  status VARCHAR(50) DEFAULT 'open',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (compliance_id) REFERENCES compliance_checklists(id) ON DELETE CASCADE,
  FOREIGN KEY (incident_id) REFERENCES incidents(id) ON DELETE SET NULL,
  FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
);

-- Indexes
CREATE INDEX idx_incidents_date ON incidents(date_occurred);
CREATE INDEX idx_aircraft_reg ON aircraft(registration_number);
