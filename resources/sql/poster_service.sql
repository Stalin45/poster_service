CREATE TABLE IF NOT EXISTS event
(
  event_id SERIAL,
  name VARCHAR(100) NOT NULL,
  description VARCHAR(255),
  place VARCHAR(255) NOT NULL,
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
  pass VARCHAR(6) NOT NULL,
  email VARCHAR(50) DEFAULT NULL,
  constraint pk_user_id primary key (user_id)
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
--
--
-- CREATE TABLE IF NOT EXISTS `mst_user` (
--   `user_id` int(5) NOT NULL AUTO_INCREMENT,
--   `login` varchar(20) DEFAULT NULL,
--   `pass` varchar(20) DEFAULT NULL,
--   `username` varchar(30) DEFAULT NULL,
--   `address` varchar(50) DEFAULT NULL,
--   `city` varchar(15) DEFAULT NULL,
--   `phone` int(10) DEFAULT NULL,
--   `email` varchar(30) DEFAULT NULL,
--   PRIMARY KEY (`user_id`)
-- ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;
--
-- CREATE TABLE roomStatusCalendar
-- (
--   noteId SERIAL,
--   roomNumber BIGINT UNSIGNED NOT NULL,
--   calendarDate DATE NOT NULL,
--   status VARCHAR(255) NOT NULL DEFAULT "booked",
--   modDate TIMESTAMP,
--   constraint pk_noteId primary key (noteId),
--   constraint fk_roomStatus_room foreign key (roomNumber) references room (roomNumber)
--   on delete cascade
--   on update cascade,
--   constraint uc_roomNumber_calendarDate UNIQUE (roomNumber, calendarDate)
-- )
--   ENGINE InnoDB CHARACTER SET utf8;
--
-- CREATE TABLE booking
-- (
--   orderId SERIAL,
--   userId BIGINT UNSIGNED,
--   roomNumber BIGINT UNSIGNED,
--   days SMALLINT(3) NOT NULL,
--   totalPrice BIGINT NOT NULL,
--   bonusPoints BIGINT,
--   orderDate DATE NOT NULL,
--   status VARCHAR(255),
--   modDate TIMESTAMP,
--   constraint pk_orderId primary key (orderId),
--   constraint fk_booking_user foreign key (userId) references user (userId)
--     on delete cascade
--     on update cascade,
--   constraint fk_order_room foreign key (roomNumber) references room (roomNumber)
--     on delete set null
--     on update cascade
-- ) ENGINE InnoDB CHARACTER SET utf8;
