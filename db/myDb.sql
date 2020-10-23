-- table of users
-- locations and foods will be tied to users
CREATE TABLE users (
    id                  SERIAL          PRIMARY KEY    NOT NULL,
    user_name           VARCHAR(16)                    NOT NULL,
    user_password       VARCHAR(16)                    NOT NULL,
    UNIQUE(user_name)
);

-- pre-seeded table of foodtypes
-- either 'standalone', 'ingredient', or 'condiment'
-- CREATE TABLE foodtypes (
--     id	        SERIAL		PRIMARY KEY     NOT NULL,
--     type_name   VARCHAR(32)	                NOT NULL
-- );

-- INSERT INTO foodtypes(id,type_name) VALUES (DEFAULT, 'Standalone');
-- INSERT INTO foodtypes(id,type_name) VALUES (DEFAULT, 'Ingredient');
-- INSERT INTO foodtypes(id,type_name) VALUES (DEFAULT, 'Condiment');

-- table of locations
-- optional details help user clarify location
CREATE TABLE locations (
    id	            SERIAL          PRIMARY KEY                 NOT NULL,
    location_name   VARCHAR(32)                                 NOT NULL,
    details         VARCHAR(160),
    -- date_added      DATE                                        NOT NULL,
    added_by        INT             REFERENCES users(id)        NOT NULL,
    -- date_modified   DATE                                        NOT NULL
);

-- will be a pre-seeded table of units
-- servings, cups, ounces, etc.
-- specifies unit (name or abbreviation) for user to assign food quantity
CREATE TABLE units (
    id          SERIAL      PRIMARY KEY     NOT NULL,
    unit_name   VARCHAR(16)                 NOT NULL,
    unit_abbr   VARCHAR(6),
    UNIQUE(unit_name),
    UNIQUE(unit_abbr)
);

-- table of foods
-- user enters food item (name, quantity, etc.)
CREATE TABLE foods (
    id              SERIAL          PRIMARY KEY                 NOT NULL,
    food_name       VARCHAR(32)                                 NOT NULL,
    details         VARCHAR(160),
    location_id     INT             REFERENCES locations(id)    NOT NULL,
    -- foodtype_id     INT             REFERENCES foodtypes(id)    NOT NULL,
    quantity        INT                                         NOT NULL,
    unit            VARCHAR(16)     REFERENCES units(unit_name),        
    -- date_added      DATE                                        NOT NULL,
    added_by        INT             REFERENCES users(id)        NOT NULL,
    -- date_modified   DATE                                        NOT NULL
);

-- table of changes in quantity
-- lists each instance where a food item's amount (and possibly units) is modified, with the before and after values
-- CREATE TABLE changes_quantities (
--     id              SERIAL  PRIMARY KEY             NOT NULL,
--     food_id         INT     REFERENCES foods(id)    NOT NULL,
--     prev_amount     INT                             NOT NULL,
--     prev_units      INT     REFERENCES units(id),
--     new_amount      INT                             NOT NULL,
--     new_units       INT     REFERENCES units(id),
--     date_modified   DATE                            NOT NULL,
--     modified_by     INT     REFERENCES users(id)    NOT NULL
-- );

-- table of changes of food location
-- lists each instance where a food item's location is modified
-- CREATE TABLE changes_locations (
--     id                  SERIAL  PRIMARY KEY                 NOT NULL,
--     food_id             INT     REFERENCES foods(id)        NOT NULL,
--     prev_location_id    INT     REFERENCES locations(id)    NOT NULL,
--     new_location_id     INT     REFERENCES locations(id)    NOT NULL,
--     date_modified       DATE                                NOT NULL,
--     modified_by         INT     REFERENCES users(id)        NOT NULL
-- );