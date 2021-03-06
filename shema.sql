#CREATE DATABASE YETICAVE DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

CREATE TABLE categories (
                            id         INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            title      CHAR(128)    NOT NULL UNIQUE,
                            code       CHAR(60)     NOT NULL UNIQUE,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                        );

CREATE TABLE users (
                       id         INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       email      CHAR(128)    NOT NULL UNIQUE,
                       name       CHAR(128)    NOT NULL,
                       password   CHAR(225)    NOT NULL,
                       contact    CHAR(225)    NOT NULL,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                   );

CREATE TABLE lots (
                      id           INT UNSIGNED                        NOT NULL AUTO_INCREMENT PRIMARY KEY,
                      user_id      INT UNSIGNED                        NOT NULL,
                      category_id  INT UNSIGNED                        NOT NULL,
                      title        CHAR(128)                           NOT NULL,
                      description  TEXT,
                      img          CHAR(228)                           NOT NULL,
                      price        DECIMAL,
                      start_price  DECIMAL                             NOT NULL,
                      completed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                      bet_step     INT UNSIGNED                        NOT NULL,
                      created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                      updated_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                      FOREIGN KEY (user_id) REFERENCES users (id),
                      FOREIGN KEY (category_id) REFERENCES categories (id)
                  );

CREATE TABLE bids (
                      id         INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                      user_id    INT UNSIGNED NOT NULL,
                      lot_id     INT UNSIGNED NOT NULL,
                      total      DECIMAL,
                      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                      FOREIGN KEY (user_id) REFERENCES users (id),
                      FOREIGN KEY (lot_id) REFERENCES lots (id)
                  );

CREATE INDEX index_category_name ON categories (title);
CREATE UNIQUE INDEX index_user_email ON users (email);
CREATE INDEX index_lot_name ON lots (title);
CREATE FULLTEXT INDEX index_lot_text ON lots (description);
