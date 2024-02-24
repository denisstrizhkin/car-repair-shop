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

insert into manufacturer (name) values ('Mitsubishi');
insert into manufacturer (name) values ('KIA');
insert into manufacturer (name) values ('Hyundai');

create table model (
  id              int unsigned auto_increment primary key,
  name            varchar(20)  not null,
  manufacturer_id int unsigned not null,

  unique(name, manufacturer_id),

  foreign key (manufacturer_id) references manufacturer (id) on delete cascade
);

insert into model (name, manufacturer_id) values (
  'Sorento', (select id from manufacturer where name = 'KIA')
);
insert into model (name, manufacturer_id) values (
  'Sportage', (select id from manufacturer where name = 'KIA')
);
insert into model (name, manufacturer_id) values (
  'ASX', (select id from manufacturer where name = 'Mitsubishi')
);
insert into model (name, manufacturer_id) values (
  'L200', (select id from manufacturer where name = 'Mitsubishi')
);
insert into model (name, manufacturer_id) values (
  'Pajero III', (select id from manufacturer where name = 'Mitsubishi')
);
insert into model (name, manufacturer_id) values (
  'Creta', (select id from manufacturer where name = 'Hyundai')
);

create table job (
  id   int unsigned auto_increment primary key,
  name varchar(30)  not null unique,
  description text  not null
);

create table job_prices (
  job_id   int unsigned not null,
  model_id int unsigned not null,
  price    int unsigned not null,

  unique(job_id, model_id),

  foreign key (job_id)   references job   (id) on delete cascade,
  foreign key (model_id) references model (id) on delete cascade
);

-- create view jobs_prices_view as (
--   select job.name as job, cars.name as car, price
--   from job_prices
--     join job  on job_prices.job_id = job.id
--     join cars on job_prices.car_id = cars.id
-- );

create table orders (
  id         int unsigned auto_increment primary key,
  user_id    int unsigned not null,
  model_id   int unsigned not null,
  job_id     int unsigned not null,
  price      int unsigned not null,
  commentary text,
  created    datetime not null default current_timestamp,

  unique(user_id, created),

  foreign key (job_id)   references job   (id) on delete cascade,
  foreign key (model_id) references model (id) on delete cascade,
  foreign key (user_id)  references users (id) on delete cascade
);
