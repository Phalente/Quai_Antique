INSERT INTO
    meal (title, price, description)
VALUES ('Coca-cola', 4, ' ');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Boissons'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Fanta', 4, ' ');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Boissons'
        )
    );

    INSERT INTO
    meal (title, price, description)
VALUES ('Sprite', 4, ' ');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Boissons'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Jus d\'orange', 3, ' ');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Boissons'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Jus de pommes', 3, ' ');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Boissons'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Domaine Etienne Sauzet', 20, 'Bourgogne, Chardonnay - 2014');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Boissons'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Château de Beaucastel', 18, 'Bordeaux, Saint-Estèphe - 2017');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Boissons'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Château Cos D \’ Estournel', 17, 'Bordeaux, Médoc - 2014');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Boissons'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Château de la Mar - Le Golliat', 16, 'Savoie – 2012');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Boissons'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Domaine Dupraz - Montracul', 16, 'Savoie – 2012');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Boissons'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Terres de Berne', 24, 'Rosé, AOP Côtes de Provence - 2021');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Boissons'
        )
    );
