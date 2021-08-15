INSERT INTO categories -- Добавляю категории
  ( title, code )
VALUES
  ( 'Доски и лыжи', 'boards' ),
  ( 'Крепления', 'attachment' ),
  ( 'Ботинки', 'boots' ),
  ( 'Одежда', 'clothing' ),
  ( 'Инструменты', 'tools' ),
  ( 'Разное', 'other' );

INSERT INTO users -- Добавляю пользователей
  ( email, name, password, contact )
VALUES
  ( 'example@mail.ru', 'Василий', '123344', 'Ул. Мира, д.9' ),
  ( 'example2@mail.ru', 'Сигизмунд', '123344', 'Ул. Мира, д.12' ),
  ( 'example3@mail.ru', 'Василий', '123344', 'Ул. Мира, д.14' ),
  ( 'example4@mail.ru', 'Саня', '123344', 'Ул. Мира, д.16' ),
  ( 'example5@mail.ru', 'Маргарита', '123344', 'Ул. Мира, д.22' ),
  ( 'example6@mail.ru', 'Альберт', '123344', 'Ул. Мира, д.34' );


INSERT INTO lots -- Добавляю лоты
  ( user_id, category_id, completed_at, title, description, img, price, start_price, bet_step, created_at )
VALUES
  ( 1, 1, '2021-08-15 21:00:00', '2014 Rossignol District Snowboard', 'Супер сноуборд для самых лучших сноубордистов', 'img/lot-1.jpg', 10999, 11500, 500, '2021-08-11 12:00:00' ),
  ( 2, 1, '2021-08-16 23:00:00', 'DC Ply  Mens 2016/2017 Snowboard', 'Сноуборд такой крутой, что даже ездить жалко', 'img/lot-2.jpg', 159990, 160600, 600, '2021-08-11 18:00:00' ),
  ( 3, 2, '2021-08-17 16:00:00', 'Крепления Union Contact Pro 2015 года размер L/XL', 'Благодаря им вы станете чемпионом', 'img/lot-3.jpg', 8000, 8700, 700, '2021-08-05 12:00:00' ),
  ( 4, 3, '2021-08-15 21:23:30', 'Ботинки для сноуборда DC Mutiny Charocal', 'Классные ботинки', 'img/lot-4.jpg', 10999, 11999, 900, '2021-08-10 14:00:00' ),
  ( 4, 4, '2021-08-16 13:20:00', 'Куртка для сноуборда DC Mutiny Charocal', 'Вы будете самый модный на склоне', 'img/lot-5.jpg', 7500, 8400, 900, '2021-08-10 18:00:00' ),
  ( 6, 4, '2021-08-16 23:40:00', 'Маска Oakley Canopy', 'Даже банк ограбить в такой не стыдно', 'img/lot-6.jpg', 5400, 6400, 1000, '2021-08-10 19:00:00' );


INSERT INTO bids -- Добавляю ставки
  ( user_id, lot_id, total )
VALUES
  ( 2, 1, 12000 ),
  ( 2, 1, 12500 ),
  ( 3, 2, 161200 ),
  ( 5, 6, 9400 );

SELECT title, code -- Выбираю все категории
FROM categories;


SELECT l.title, -- Получаю лоты вместе с названием категории из таблицы категорий.
       l.price,
       l.start_price,
       l.img,
       l.created_at,
       l.completed_at,
       c.title
FROM lots AS l
       INNER JOIN categories AS c ON l.category_id = c.id
WHERE l.completed_at > NOW() -- Проверяю "открыты" ли лоты
ORDER BY l.created_at DESC -- Сортирую лоты по дате, выбираю самые новые
LIMIT 6; -- Ограничиваю выборку до 6 записей


SELECT l.title,
       l.description,
       l.img,
       l.price,
       c.title -- Получаю лот с id = 2, также получаю название категории, к которой он принадлежит
FROM lots AS l
       INNER JOIN categories AS c ON l.category_id = c.id
WHERE l.id = 2;


UPDATE lots -- Обновляю название лота с id = 2
SET title = 'Сноуборд Joint Snowboards Evenly (19-20)'
WHERE id = 2;


SELECT b.id, b.total, b.created_at -- Получаю список ставок лота с id = 1, c сортировкой по дате
FROM lots AS l
       INNER JOIN bids AS b ON l.id = b.lot_id
WHERE l.id = 1
ORDER BY b.created_at DESC;
