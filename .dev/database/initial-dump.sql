CREATE DATABASE movyn;

\c movyn;

CREATE TABLE "country" (
    "id" SERIAL PRIMARY KEY,
    "uid" VARCHAR(50) NOT NULL UNIQUE,
    "name" VARCHAR(255) NOT NULL,
    "acronym" VARCHAR(50) NOT NULL,
    "flag" VARCHAR(255) NOT NULL,
    "created_at" timestamp(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "updated_at" timestamp(3) NOT NULL
);

CREATE TABLE "language" (
    "id" SERIAL PRIMARY KEY,
    "uid" VARCHAR(50) NOT NULL UNIQUE,
    "name" VARCHAR(255) NOT NULL,
    "acronym" VARCHAR(50) NOT NULL,
    "flag" VARCHAR(255) NOT NULL,
    "created_at" timestamp(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "updated_at" timestamp(3) NOT NULL
);

CREATE TABLE "country_speaks" (
    "id" SERIAL PRIMARY KEY,
    "fk_country" INT NOT NULL,
    "fk_language" INT NOT NULL,
    CONSTRAINT "fk_country_speaks_country" FOREIGN KEY ("fk_country") REFERENCES "country" ("id"),
    CONSTRAINT "fk_country_speaks_language" FOREIGN KEY ("fk_language") REFERENCES "language" ("id")
);

CREATE TABLE "feature" (
    "id" SERIAL PRIMARY KEY,
    "uid" VARCHAR(50) NOT NULL UNIQUE,
    "slug" VARCHAR(255) NOT NULL,
    "name" VARCHAR(255) NOT NULL,
    "description" VARCHAR(255) NOT NULL,
    "created_at" timestamp(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "updated_at" timestamp(3) NOT NULL
);

CREATE TABLE "location_feature" (
    "id" SERIAL PRIMARY KEY,
    "entity" VARCHAR(100) NOT NULL,
    "entity_id" INT NOT NULL,
    "value" VARCHAR(255) NOT NULL,
    "created_at" timestamp(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "updated_at" timestamp(3) NOT NULL
);
