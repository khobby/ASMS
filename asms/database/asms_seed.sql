USE `asms_db`;

-- Roles
INSERT INTO roles (name, description) VALUES
('Administrator','Full system access'),
('Safety Officer','Manages safety operations'),
('Maintenance Engineer','Manages maintenance tasks'),
('Auditor','Auditing and compliance'),
('Pilot','Flight crew');

-- Users (password = password123 hashed)
INSERT INTO users (role_id, full_name, email, password_hash, status) VALUES
(1,'System Admin','admin@asms.aero','$2y$10$wH1Fz1QjYkRZs7u5wQ0qrujzB8o6e4uQ2L8uQWg5s8ZQHnY2bY2q6','active'),
(2,'Safety Officer','safety@asms.aero','$2y$10$wH1Fz1QjYkRZs7u5wQ0qrujzB8o6e4uQ2L8uQWg5s8ZQHnY2bY2q6','active'),
(3,'Maintenance Engineer','maintenance@asms.aero','$2y$10$wH1Fz1QjYkRZs7u5wQ0qrujzB8o6e4uQ2L8uQWg5s8ZQHnY2bY2q6','active'),
(4,'Auditor','auditor@asms.aero','$2y$10$wH1Fz1QjYkRZs7u5wQ0qrujzB8o6e4uQ2L8uQWg5s8ZQHnY2bY2q6','active'),
(5,'Pilot','pilot@asms.aero','$2y$10$wH1Fz1QjYkRZs7u5wQ0qrujzB8o6e4uQ2L8uQWg5s8ZQHnY2bY2q6','active');

-- Assign user_roles
INSERT INTO user_roles (user_id, role_id) VALUES
(1,1),(2,2),(3,3),(4,4),(5,5);

-- Aircraft
INSERT INTO aircraft (aircraft_code, aircraft_type, manufacturer, model, serial_number, registration_number, status, created_by) VALUES
('ASMS-B737','Commercial','Boeing','737-800','SN-B737-001','N123AS','active',1),
('ASMS-A320','Commercial','Airbus','A320','SN-A320-001','N124AS','active',1),
('ASMS-B777','Commercial','Boeing','777','SN-B777-001','N125AS','active',1),
('ASMS-E175','Regional','Embraer','E175','SN-E175-001','N126AS','active',1);

-- Components
INSERT INTO aircraft_components (aircraft_id, component_name, serial_number, health_score, risk_level, operating_hours, cycles, condition_status, next_maintenance) VALUES
(1,'Engine A','ENG-B737-001',85,'Medium',1200,800,'Fair','2026-12-01'),
(2,'Landing Gear','LG-A320-001',90,'Low',800,400,'Good','2026-08-15'),
(3,'Hydraulics','HYD-B777-001',60,'High',2200,1600,'Poor','2026-06-20'),
(4,'Avionics','AV-E175-001',95,'Low',400,200,'Good','2027-01-10');

-- Incidents
INSERT INTO incidents (incident_number, aircraft_id, reported_by, incident_type, severity, location, date_occurred, description, fatalities, injuries, status) VALUES
('INC-2026-001',1,5,'Bird Strike','Minor','JFK Airport','2026-05-02','Bird strike on left engine, no injuries',0,0,'Closed'),
('INC-2026-002',2,5,'Hard Landing','Serious','LAX Airport','2026-04-18','Hard landing, minor injuries',0,2,'In Progress'),
('INC-2026-003',3,2,'Fuel Leak','Critical','Heathrow','2026-03-10','Fuel system leak discovered, immediate action taken',0,0,'Open'),
('INC-2026-004',4,3,'Door Malfunction','Minor','Gatwick','2026-02-25','Passenger door sensor fault',0,0,'Closed'),
('INC-2026-005',1,2,'Runway Excursion','Serious','Sydney','2026-01-12','Runway excursion on wet runway',0,1,'Closed');

-- Risks
INSERT INTO risks (title, description, category, likelihood, impact, level, mitigation_plan, owner, status, due_date, created_by) VALUES
('Runway Incursion','Unauthorized entry onto runway','Operational',3,4,'High','Improve signage and procedures',2,'Open','2026-09-01',2),
('Bird Strike','Bird ingestion risk near airport','Environmental',2,3,'Medium','Wildlife management program',2,'Open','2026-07-15',2),
('Fuel System Leak','Potential leak in fuel lines','Technical',4,5,'Critical','Inspect fuel systems and replace seals',3,'Open','2026-06-01',3),
('Crew Fatigue','Extended duty periods increasing human error','Human Factors',3,3,'High','Review rostering and rest policies',2,'Open','2026-08-01',2);

-- Alerts
INSERT INTO alerts (title, message, severity, status, created_by) VALUES
('Immediate Fuel Check','Inspect fuel seals on Boeing 777','High','active',1),
('Wildlife Patrol','Increase bird patrols at dawn','Medium','active',2),
('Component Recall','Hydraulics actuator recall','High','active',1);

-- Audit logs
INSERT INTO audit_logs (user_id, action, entity_type, entity_id, old_value, new_value, ip_address, user_agent) VALUES
(1,'create','aircraft',1,NULL,'created aircraft ASMS-B737','127.0.0.1','Seeder'),
(1,'create','aircraft',2,NULL,'created aircraft ASMS-A320','127.0.0.1','Seeder'),
(2,'create','incident',3,NULL,'reported fuel leak','127.0.0.1','Seeder'),
(3,'update','component',3,'health_score=70','health_score=60','127.0.0.1','Seeder'),
(4,'login','users',4,NULL,NULL,'127.0.0.1','Seeder');
