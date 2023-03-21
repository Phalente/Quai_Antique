INSERT INTO
    meal (title, price, description)
VALUES ('La Croziflette', 25, 'Reblochon, pommes de terre, lardons, oignons, vin blanc de Savoie et pointe de créme
');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Plats'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('La Raclette', 25, 'Raclette de Savoie au lait cru');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Plats'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('La Raclette Fumée', 26, 'Raclette fermière fumée');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Plats'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('La Tartiflette', 24, 'Reblochon, pommes de terre, lardons, oignons, vin blanc de Savoie et pointe de créme');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Plats'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Burger montagnard à la raclette', 18, 'Sauce béarnaise, salade, jambon fumée, steak hachée, raclette');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Plats'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Min-Tartiflette Ou Min-Croziflette', 16, 'Reblochon, pommes de terre ou crozets, lardons, oignons, vin blanc de Savoie et pointe de crème');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Plats'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Truite bleu', 22, 'Poisson frais cuit dans un bouillon de vin blanc et d\'épices, servi avec des légumes verts et pommes de terre vapeur');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Plats'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Filet de perche', 22, 'Des filets de perches dorés à la poele au vin blanc / à la provençale ou à la crème échalotte');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Plats'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Gratins de crozets', 18, 'Crozets cuits avec de la crème fraîche, du fromage râpé et des lardons, gratinés au four');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Plats'
        )
    );

INSERT INTO
    meal (title, price, description)
VALUES ('Diots aux crozets', 22, 'Saucisses fumées cuites dans un bouillon de légumes et de vin blanc, accompagnées de crozets (des petites pâtes carrées)');

INSERT INTO
    meal_category (meal_id, category_id)
VALUES (
        LAST_INSERT_ID(), (
            SELECT id
            FROM category
            WHERE
                name = 'Les Plats'
        )
    );
