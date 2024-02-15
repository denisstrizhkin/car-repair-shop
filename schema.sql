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
        'admin', 'admin@example.com', 'admin123', '79531231122',
        (select id from roles where name = 'admin')
    );

create table manufacturer (
  id   int unsigned auto_increment primary key,
  name varchar(20)  not null unique
);

create table model (
  id   int unsigned auto_increment primary key,
  name varchar(20)  not null unique
);

create table car (
  id              int unsigned auto_increment primary key,
  vin             varchar(17)  not null unique,
  name            varchar(30)  not null,
  model_id        int unsigned not null,
  manufacturer_id int unsigned not null,

  foreign key (manufacturer_id) references manufacturer (id) on delete cascade,
  foreign key (model_id) references model (id) on delete cascade
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

  foreign key (job_id) references job (id) on delete cascade,
  foreign key (car_id) references car (id) on delete cascade
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
  foreign key (car_id)  references car   (id) on delete cascade,
  foreign key (user_id) references users (id) on delete cascade
);
