create table user (
  id integer primary key auto_increment,
  username varchar(10) not null unique,
  email varchar(50) not null unique,
  password varchar(20) not null,
  phone_number varchar(12) not null,
  role_id integer not null
);

create table role (
  id integer primary key auto_increment,
  name varchar(20) not null
);

create table car (
  id integer primary key auto_increment,
  vin varchar(17) not null unique,
  name varchar(30) not null,
  model_id integer not null,
  manufacturer_id integer not null
);

create table manufacturer (
  id integer primary key auto_increment,
  name varchar(20) not null unique
);

create table model (
  id integer primary key auto_increment,
  name varchar(20) not null unique
);

create table job (
  id integer primary key auto_increment,
  name varchar(30) not null unique,
  description text not null
);

create table job_prices (
  job_id integer not null,
  car_id integer not null,
  price integer not null,

  unique(job_id, car_id)
);

create table order (
  id integer primary key auto_increment,
  user_id integer not null,
  car_id integer not null,
  job_id integer not null,
  price integer not null,
  commentary text,
  created_date date not null,

  unique(user_id, car_id, job_id, created_date)
);

alter table user add foreign key (role_id) references role (id) on delete cascade;

alter table car add foreign key (manufacturer_id) references manufacturer (id) on delete cascade;

alter table car add foreign key (model_id) references model (id) on delete cascade;

alter table job_prices add foreign key (job_id) references job (id) on delete cascade;

alter table order add foreign key (job_id) references job (id) on delete cascade;

alter table job_prices add foreign key (car_id) references car (id) on delete cascade;

alter table order add foreign key (car_id) references car (id) on delete cascade;

alter table order add foreign key (user_id) references user (id) on delete cascade;

