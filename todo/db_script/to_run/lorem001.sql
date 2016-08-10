# 12/06/2016

insert into options (id, option, section, description, value, created_at, updated_at) VALUES (1, 'GLOBAL', 'PATH', 'Root URL to access the asset at public folder', 'http://loremispum.app:88/', NOW(), NOW());

insert into options (id, option, section, description, value, created_at, updated_at) VALUES (2, 'GLOBAL', 'PATH_AJAX', 'Root URL to access the asset at public folder', 'http://www.loremispum.app/', NOW(), NOW());

INSERT INTO users (role_id, first_name, last_name, email, address, phone, password, remember_token, created_at, updated_at) VALUES (1, 'Ardit', 'Azo', 'ardit@gmail.com', 'Street XXX', '123456789', '$2y$10$j8Vj1Yg9CfbVQZtjyXBjMOdSx35pDCQH9gEg7bJ..cm2GL86lK7wG', 'a1zkl1q0jHi2draDDoZQQ0Qp1rTBTyA6DzXiNQ172f7tHkBoq4124zvDrDYS', '2016-06-11 20:32:38', '2016-06-11 21:57:02');
INSERT INTO users (role_id, image_id, is_active, first_name, last_name, email, address, phone, password, user_update, remember_token, created_at, updated_at) VALUES (2, 3, 0, 'Beni', 'Even', 'beni@gmail.com', 'Street Broadway 21th, South York', '123456789', '', 0, 'a1zkl1q0jHi2draDDoZQQ0Qp1rTBTyA6DzXiNQ172f7tHkBoq4124zvDrDYS', '2016-06-11 20:32:38', '2016-06-18 23:24:43');

insert into domains(des_dom, description, value) VALUES ('cities', 'New York', 'NY');
insert into domains(des_dom, description, value) VALUES ('cities', 'Los Angeles', 'LA');
insert into domains(des_dom, description, value) VALUES ('cities', 'Las Vegas', 'LV');
insert into domains(des_dom, description, value) VALUES ('cities', 'Washington', 'WA');
insert into domains(des_dom, description, value) VALUES ('cities', 'Miami', 'MI');
insert into domains(des_dom, description, value) VALUES ('cities', 'Philadelphia', 'PH');

insert into domains(des_dom, description, value) VALUES ('countries', 'Brasil', 'BR');
insert into domains(des_dom, description, value) VALUES ('countries', 'Russia', 'RU');
insert into domains(des_dom, description, value) VALUES ('countries', 'Italy', 'IT');
insert into domains(des_dom, description, value) VALUES ('countries', 'Germany', 'GE');
insert into domains(des_dom, description, value) VALUES ('countries', 'France', 'FR');
insert into domains(des_dom, description, value) VALUES ('countries', 'USA', 'US');

insert into domains(des_dom, description, value) VALUES ('proffession', 'Doctor', 'DOCTOR');
insert into domains(des_dom, description, value) VALUES ('proffession', 'Norse', 'NORSE');
insert into domains(des_dom, description, value) VALUES ('proffession', 'Driver', 'DRIVER');
insert into domains(des_dom, description, value) VALUES ('proffession', 'Architect', 'ARCH');
insert into domains(des_dom, description, value) VALUES ('proffession', 'Worker', 'WORKER');
insert into domains(des_dom, description, value) VALUES ('proffession', 'Manager', 'MANAGER');

insert into domains(des_dom, description, value) VALUES ('marital_status', 'Single', 'SI');
insert into domains(des_dom, description, value) VALUES ('marital_status', 'Married', 'MA');
insert into domains(des_dom, description, value) VALUES ('marital_status', 'Widow', 'WI');
insert into domains(des_dom, description, value) VALUES ('marital_status', 'Separated', 'SE');
insert into domains(des_dom, description, value) VALUES ('marital_status', 'Divorced', 'DI');

insert into domains(des_dom, description, value) VALUES ('language', 'English', 'EN');
insert into domains(des_dom, description, value) VALUES ('language', 'Italian', 'IT');
insert into domains(des_dom, description, value) VALUES ('language', 'French', 'FR');
insert into domains(des_dom, description, value) VALUES ('language', 'German', 'DE');

insert into domains(des_dom, description, value) VALUES ('adult', 'Adult', 'AD');
insert into domains(des_dom, description, value) VALUES ('adult', 'Child', 'CH');

insert into domains(des_dom, description, value) VALUES ('gender', 'Male', 'MA');
insert into domains(des_dom, description, value) VALUES ('gender', 'Female', 'FE');

INSERT INTO roles(status, created_at, updated_at) VALUES ('Administrator', now(), now());
INSERT INTO roles(status, created_at, updated_at) VALUES ('Dentist', now(), now());

INSERT INTO categories(id, category, created_at, updated_at) VALUES (1, 'Surgery', NOW(), NOW());
INSERT INTO categories(id, category, created_at, updated_at) VALUES (2, 'Conservative', NOW(), NOW());
INSERT INTO categories(id, category, created_at, updated_at) VALUES (3, 'Radiology', NOW(), NOW());
INSERT INTO categories(id, category, created_at, updated_at) VALUES (4, 'Endodontic', NOW(), NOW());
INSERT INTO categories(id, category, created_at, updated_at) VALUES (5, 'Implantology', NOW(), NOW());
INSERT INTO categories(id, category, created_at, updated_at) VALUES (6, 'Periodontal', NOW(), NOW());
INSERT INTO categories(id, category, created_at, updated_at) VALUES (7, 'Hygiene', NOW(), NOW());
INSERT INTO categories(id, category, created_at, updated_at) VALUES (8, 'Prosthesis', NOW(), NOW());


# 10/08/2016

truncate table teeths_prizes;

INSERT INTO teeths_prizes(category_id, category, detail, date, currency1, price1, vat, position, note, created_at, updated_at) VALUES
  (1, 'Chirurgia', 'EST - estrazione chirurgica', now(), 1, 200, 0, '', '', now(), now() );
INSERT INTO teeths_prizes(category_id, category, detail, date, currency1, price1, vat, position, note, created_at, updated_at) VALUES
  (2, 'Conservativa', 'OTS - otturazione amalgama occlusale', now(), 1, 230, 0, '', '', now(), now() );
INSERT INTO teeths_prizes(category_id, category, detail, date, currency1, price1, vat, position, note, created_at, updated_at) VALUES
  (4, 'Endodonzia', 'DEV - devitalizzazione monocanalare', now(), 1, 150, 0, '', '', now(), now() );
INSERT INTO teeths_prizes(category_id, category, detail, date, currency1, price1, vat, position, note, created_at, updated_at) VALUES
  (4, 'Endodonzia', 'DEVP - devitalizzazione pluricanalare', now(), 1, 100, 0, '', '', now(), now() );
INSERT INTO teeths_prizes(category_id, category, detail, date, currency1, price1, vat, position, note, created_at, updated_at) VALUES
  (7, 'Igiene', 'ABL - ablazione del tartaro', now(), 1, 50, 0, '', '', now(), now() );