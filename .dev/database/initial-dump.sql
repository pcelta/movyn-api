CREATE DATABASE movyn;

\c movyn;

CREATE TABLE "currency" (
    "id" SERIAL PRIMARY KEY,
    "uid" VARCHAR(40) NOT NULL UNIQUE,
    "name" VARCHAR(255) NOT NULL,
    "code" VARCHAR(3) NOT NULL,
    "symbol" VARCHAR(10) NOT NULL,
    "native_symbol" VARCHAR(10) NOT NULL,
    "created_at" timestamp(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "updated_at" timestamp(3) NOT NULL
);

CREATE TABLE "country" (
    "id" SERIAL PRIMARY KEY,
    "uid" VARCHAR(40) NOT NULL UNIQUE,
    "name" VARCHAR(255) NOT NULL,
    "abbreviation" VARCHAR(3) NOT NULL,
    "flag" VARCHAR(255) NOT NULL,
    "fk_currency" INT NOT NULL,
    "created_at" timestamp(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "updated_at" timestamp(3) NOT NULL,
    CONSTRAINT "fk_country_currency" FOREIGN KEY ("fk_currency") REFERENCES "currency" ("id")
);

CREATE TABLE "language" (
    "id" SERIAL PRIMARY KEY,
    "uid" VARCHAR(40) NOT NULL UNIQUE,
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
    "uid" VARCHAR(40) NOT NULL UNIQUE,
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

INSERT INTO "roles"("uid", "name", "slug", "description", "created_at", "updated_at")
VALUES('rl-baf99b5b-b749-4cc8-b822-77ed1e64fa40', 'Pastor', 'pastor', 'Líder espiritual da igreja', NOW(), NOW());
