-- table of users
-- locations and foods will be tied to users
CREATE TABLE users (
    id                  SERIAL          PRIMARY KEY    NOT NULL,
    user_name           VARCHAR(16)                    NOT NULL,
    user_password       VARCHAR(16)                    NOT NULL,
    UNIQUE(user_name)
);

-- table of locations
-- optional details help user clarify location
CREATE TABLE locations (
    id	            SERIAL          PRIMARY KEY                 NOT NULL,
    location_name   VARCHAR(64)                                 NOT NULL,
    details         VARCHAR(255),
    added_by        INT             REFERENCES users(id)        NOT NULL
);

-- table of foods
-- user enters food item (name, quantity, etc.)
CREATE TABLE foods (
    id              SERIAL          PRIMARY KEY                 NOT NULL,
    food_name       VARCHAR(64)                                 NOT NULL,
    details         VARCHAR(255),
    location_id     INT             REFERENCES locations(id)    NOT NULL,
    quantity        INT                                         NOT NULL,
    added_by        INT             REFERENCES users(id)        NOT NULL
);