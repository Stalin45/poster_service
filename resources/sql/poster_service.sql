CREATE TABLE IF NOT EXISTS event
(
  event_id SERIAL,
  name VARCHAR(100) NOT NULL,
  description VARCHAR(255),
  place VARCHAR(100) NOT NULL,
  date TIMESTAMP NOT NULL DEFAULT NOW(),
  img_ref VARCHAR(255),
  user_id BIGINT UNSIGNED NOT NULL,
  constraint pk_event_id primary key (event_id),
  constraint fk_event_user foreign key (user_id) references user (user_id)
    on delete cascade
    on update cascade
) ENGINE InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS user
(
  user_id SERIAL,
  login VARCHAR(20) NOT NULL,
  pass VARCHAR(30) NOT NULL,
  email VARCHAR(50) DEFAULT NULL,
  constraint pk_user_id primary key (user_id),
  constraint uc_login unique (login)
) ENGINE InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS role
(
  role_id SERIAL,
  role_name VARCHAR(20) NOT NULL,
  constraint pk_role_id primary key (role_id)
) ENGINE InnoDB CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS user_role
(
  role_id BIGINT UNSIGNED NOT NULL,
  user_id BIGINT UNSIGNED NOT NULL,
  constraint pk_user_id_role_id primary key (role_id, user_id),
  constraint fk_user_role_role foreign key (role_id) references role (role_id)
    on delete cascade
    on update cascade,
  constraint fk_user_role_user foreign key (user_id) references user (user_id)
    on delete cascade
    on update cascade
) ENGINE InnoDB CHARACTER SET utf8;

INSERT INTO role VALUES (1, 'user');
INSERT INTO role VALUES (1, 'guest');
