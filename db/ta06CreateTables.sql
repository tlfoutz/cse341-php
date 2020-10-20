-- Create a table for our topics
CREATE TABLE topics (
  id SERIAL PRIMARY KEY NOT NULL,
  name VARCHAR(40) NOT NULL
  );

-- Insert data into the topic table
INSERT INTO topics (name) VALUES ('Faith');
INSERT INTO topics (name) VALUES ('Sacrifice');
INSERT INTO topics (name) VALUES ('Charity');

-- Now create a cross-reference table to link scriptures and topics
-- We have to have a separate table for this, because it is a many-to-many
-- relationship.

-- Some people like to put an additional "id" on a table like this, but it is
-- not strictly necessary.
CREATE TABLE scriptures_topics (
  scriptureId int NOT NULL REFERENCES scriptures(id),
  topicId int NOT NULL REFERENCES topics(id)
  );