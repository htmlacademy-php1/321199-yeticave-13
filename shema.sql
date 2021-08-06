CREATE
DATABASE YETICAVE DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

CREATE TABLE category (
                        id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        category_name CHAR(128)    NOT NULL UNIQUE,
                        category_code CHAR(60)     NOT NULL UNIQUE
                      );

CREATE TABLE user (
                    id                     INT UNSIGNED                        NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    lot_id                 INT                                 NOT NULL,
                    bet_id                 INT                                 NOT NULL,
                    user_registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                    user_email             CHAR(128)                           NOT NULL UNIQUE,
                    user_name              CHAR(128)                           NOT NULL,
                    user_password          CHAR(225)                           NOT NULL,
                    user_contact           CHAR(225)

                  );

CREATE TABLE lot (
                   id                INT UNSIGNED                        NOT NULL AUTO_INCREMENT PRIMARY KEY,
                   user_id           INT                                 NOT NULL,
                   category_id       INT                                 NOT NULL,
                   lot_create_date   TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                   lot_name          CHAR(128)                           NOT NULL,
                   lot_description   TEXT,
                   lot_img           CHAR(128)                           NOT NULL,
                   lot_start_price   DECIMAL                             NOT NULL,
                   lot_complete_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                   lot_bet_step      INT UNSIGNED                        NOT NULL
                 );

CREATE TABLE bet (
                   id        INT UNSIGNED                        NOT NULL AUTO_INCREMENT PRIMARY KEY,
                   user_id   INT                                 NOT NULL,
                   lot_id    INT                                 NOT NULL,
                   bet_date  TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                   bet_total DECIMAL
                 );

CREATE INDEX index_category_name ON category (category_name);
CREATE INDEX index_user_email ON user (user_email);
CREATE INDEX index_lot_name ON lot (lot_name);



