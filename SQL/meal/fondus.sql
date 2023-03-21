INSERT INTO
    meal (title, price, description)
VALUES ('La Fondue Savoyarde', 25, 'Comté, Abondance, Beaufort & Emmental');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Fondus'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('La Fondue Au Cidre', 26, 'Comté, Abondance, Cidre doux, Beaufort & Emmental');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Fondus'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('La Fondue Aux Cépes', 28, 'Comté, Abondance, Beaufort & Emmental avec des cépes');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Fondus'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('La Fondue Du Beaufortain', 31, 'Beaufort longuement affiné et Beaufort fruité');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Fondus'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('La Fondue Bourguignonne', 28, 'Dés de boeuf à plonger dans un caquelon d\'huile chaude, 3 sauces: mayonnaise, tartare & curry');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Fondus'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('La Fondue Bourguignonne Royale', 32, 'Dés de boeuf, volaille & magret de canard à plonger dans un caquelon d\'huile chaude, 3 sauces : mayonnaise, tartare & curry');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Fondus'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Salade De Chèvre', 18, 'Salade verte, croûtons, fromage de chèvre, cébettes, cerneaux de noix, jambon cru');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Fondus'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Salade Mixte', 15, 'Salade verte, tomates, concombres, cébettes, croutons');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Fondus'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Salade De Savoie', 19, 'Salade verte, croûtons, lardons, tomme de savoie, pommes de terre');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Fondus'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Salade de Montagnard', 19, 'Pommes de terre, batavia, chèvre, lardons fumées, fromage Beaufort, jambon fumé, speck');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Fondus'
        )
    );
