INSERT INTO temp.korisniks (`id`, `email`, `email_verified_at`, `verification_token`, `password`, `isAdmin`, `isMod`, `remember_token`, `created_at`, `updated_at`)
VALUES (1, 'admin@admin', now(), null, '$2y$10$l4/4pWDtHHhkZBJslDvxjulCeiUWciyBcJbz40OQmxhtc8ZdZ98He', 1, 0, null, now(), now());

INSERT INTO temp.administrators (`id`, `created_at`, `updated_at`)
VALUES (1, now(), now());

SELECT * FROM temp.korisniks;
SELECT * FROM temp.administrators;