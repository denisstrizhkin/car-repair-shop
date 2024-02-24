create table roles (
  id   int unsigned auto_increment primary key,
  name varchar(20)  not null unique
);

create table users (
  id           int unsigned auto_increment primary key,
  username     varchar(10)  not null unique,
  email        varchar(50)  not null unique,
  password     varchar(20)  not null,
  phone_number varchar(12)  not null,
  role_id      int unsigned not null,

  foreign key (role_id) references roles (id) on delete cascade
);

insert into roles (name) values ('admin');
insert into roles (name) values ('employee');
insert into roles (name) values ('client');

insert into users (username, email, password, phone_number, role_id)
    values (
        'admin', 'admin@example.com', 'admin123', '9531231122',
        (select id from roles where name = 'admin')
    );
insert into users (username, email, password, phone_number, role_id)
    values (
        'rika', 'rika@example.com', 'rika456', '9531111111',
        (select id from roles where name = 'employee')
    );
insert into users (username, email, password, phone_number, role_id)
    values (
        'mion', 'mion@example.com', 'mion789', '9532222222',
        (select id from roles where name = 'client')
    );

create table manufacturer (
  id   int unsigned auto_increment primary key,
  name varchar(20)  not null unique
);

create table model (
  id   int unsigned auto_increment primary key,
  name varchar(20)  not null unique
);

create table cars (
  id              int unsigned auto_increment primary key,
  vin             varchar(17)  not null unique,
  name            varchar(30)  not null,
  model_id        int unsigned not null,
  manufacturer_id int unsigned not null,

  foreign key (manufacturer_id) references manufacturer (id) on delete cascade,
  foreign key (model_id) references model (id) on delete cascade
);

create view cars_view as (
  select cars.id, vin, cars.name, model.name as model, manufacturer.name as manufacturer
  from cars
    join model        on cars.model_id        = model.id
    join manufacturer on cars.manufacturer_id = manufacturer.id
);

create table job (
  id   int unsigned auto_increment primary key,
  name varchar(30)  not null unique,
  description text  not null
);

create table job_prices (
  job_id int unsigned not null,
  car_id int unsigned not null,
  price  int unsigned not null,

  unique(job_id, car_id),

  foreign key (job_id) references job  (id) on delete cascade,
  foreign key (car_id) references cars (id) on delete cascade
);

create view jobs_prices_view as (
  select job.name as job, cars.name as car, price
  from job_prices
    join job  on job_prices.job_id = job.id
    join cars on job_prices.car_id = cars.id
);

create table orders (
  id         int unsigned auto_increment primary key,
  user_id    int unsigned not null,
  car_id     int unsigned not null,
  job_id     int unsigned not null,
  price      int unsigned not null,
  commentary text,
  created    datetime not null default current_timestamp,

  unique(user_id, car_id, job_id, created),

  foreign key (job_id)  references job   (id) on delete cascade,
  foreign key (car_id)  references cars  (id) on delete cascade,
  foreign key (user_id) references users (id) on delete cascade
);
