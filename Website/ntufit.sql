/*
  Wei Lai; Zeng Xinyi; Zhang Bo
  NTU Fitness Factory
*/

use f33s28;

CREATE TABLE member 
(
  matric_number char(50) NOT NULL primary key,
  name char(50) NOT NULL,
  password char(50) NOT NULL,
  islogin int NOT NULL DEFAULT 0,
  gender char(2) NOT NULL,
  birth_date date NOT NULL,
  school char(99) NOT NULL,
  address char(99) NOT NULL,
  email char(99) NOT NULL,
  phone int(10) unsigned NOT NULL,
  c_count int NOT NULL DEFAULT 0,
  p_count int NOT NULL DEFAULT 0
);

CREATE TABLE courses 
(
  course_id char(50) NOT NULL primary key,
  course_name char(50) NOT NULL,
  course_duration int(10) unsigned NOT NULL,
  course_time datetime NOT NULL,
  course_venue char(50) NOT NULL,
  vacancy int(11) NOT NULL
);

CREATE TABLE private_trainer 
(
  private_trainer_id char(50) NOT NULL primary key,
  trainer_name char(50) NOT NULL,
  training_duration int(10) unsigned NOT NULL,
  available_training_time datetime NOT NULL,
  price int(10) unsigned NOT NULL,
  vacancy int(11) NOT NULL
);

CREATE TABLE course_registration
(
  registration_number int(10) unsigned NOT NULL auto_increment primary key,
  matric_number char(50) NOT NULL,
  course_id char(50) NOT NULL,
  course_time datetime NOT NULL,
  registration_time datetime NOT NULL
);

CREATE TABLE private_coach_appointment (
  appointment_number int(11) NOT NULL auto_increment primary key,
  matric_number char(50) NOT NULL,
  private_trainer_id char(50) NOT NULL,
  available_training_time datetime NOT NULL,
  registration_time datetime NOT NULL,
  selected_hours int(10) unsigned NOT NULL,
  total_price float(10,2) NOT NULL,
  comments char(100)
); 