INSERT INTO esrbija.korisniks (`id`, `email`, `email_verified_at`, `verification_token`, `password`, `isAdmin`, `isMod`, `remember_token`, `created_at`, `updated_at`)
VALUES (1, 'admin@admin', now(), null, '$2y$10$l4/4pWDtHHhkZBJslDvxjulCeiUWciyBcJbz40OQmxhtc8ZdZ98He', 1, 1, null, now(), now());

INSERT INTO esrbija.administrators (`id`,`ime`,`prezime`, `created_at`, `updated_at`)
VALUES (1,'Drazen',`Draskovic`, now(), now());

SELECT * FROM esrbija.korisniks;
SELECT * FROM esrbija.administrators;