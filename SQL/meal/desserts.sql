INSERT INTO
    meal (title, price, description)
VALUES ('Assortiment de glaces & sorbets', 9, 'Un assortiment de Glaces et Sorbets au choix, tous plus gourmands et rafraichissants les uns que les autres');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Desserts'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Tiramisu aux fruits rouges', 9, 'Un dessert à base de crème de mascarpone, fraises et biscuit imbibés dans du café');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Desserts'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Mousse au chocolat au daim', 9, 'La mousse au chocolat au daim est un dessert crémeux et léger à base de chocolat et de morceaux de barres de daim');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Desserts'
        )
    );


INSERT INTO
    meal (title, price, description)
VALUES ('Salade de fruits', 10, 'Baies, Oranges, Pommes, Bananes, Kiwis, Mangues, Ananas');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Desserts'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Tarte aux myrtilles', 10, 'Une tarte qui met en valeur les myrtilles sauvages des montagnes');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Desserts'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Gâteau de Savoie', 10, 'Un gâteau aérien et moelleux à base de farine, de sucre, d\'œufs et de vanille');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Desserts'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Farçon', 10, 'Un dessert savoyard à base de pommes de terre râpées, de lardons, de pruneaux et de sucre, cuit à la vapeur');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Desserts'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Croûte aux pommes', 10, 'Un dessert savoyard traditionnel à base de pommes cuit au four jusqu\'à ce que la pâte soit dorée et croustillante');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Desserts'
        )
    );
