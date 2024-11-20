
-- -----------------------------------------------------
-- Data for table `WorkhiveProd`.`Users`
-- -----------------------------------------------------
START TRANSACTION;
USE `WorkhiveProd`;

-- Table Users
INSERT INTO `WorkhiveProd`.`Users` (`id`, `first_name`, `last_name`, `photo`, `user_role`, `phone`, `email`, `password`,
                                `status`, `created_at`, `updated_at`)
VALUES (1, 'Marc', 'Galoyer', NULL, 'admin', '0690684020', 'mgaloyer@uneak.fr', 'password', 'active', DEFAULT, DEFAULT),
       (2, 'Drucila', 'Larochelle', NULL, 'member', NULL, 'drucila@email.com', 'password', 'active', DEFAULT, DEFAULT),
       (3, 'Agnes', 'Mathey', NULL, 'user', NULL, 'mathey@email.com', 'password', 'active', DEFAULT, DEFAULT),
       (4, 'Gary', 'Meltou', NULL, 'member', NULL, 'gary@email.com', 'password', 'active', DEFAULT, DEFAULT),
       (5, 'Marie-Helene', 'Basse', NULL, 'admin', NULL, 'marie.helene@email.com', 'password', 'active', DEFAULT,
        DEFAULT),
       (6, 'John', 'Doe', NULL, 'member', NULL, 'john@email.com', 'password', 'inactive', DEFAULT, DEFAULT),
       (7, 'Jane', 'Doe', NULL, 'user', NULL, 'jane@email.com', 'password', 'inactive', DEFAULT, DEFAULT),
       (8, 'Leo', 'Dubois', NULL, 'member', '0690123456', 'leo.dubois@email.com', 'password', 'active', DEFAULT,
        DEFAULT),
       (9, 'Sophie', 'Martin', NULL, 'admin', '0690789123', 'sophie.martin@email.com', 'password', 'active', DEFAULT,
        DEFAULT);

-- Table Rooms
INSERT INTO `WorkhiveProd`.`Rooms` (`id`, `name`, `description`, `photo`, `capacity`, `width`, `length`, `status`,
                                `created_at`, `updated_at`)
VALUES (1, 'Salle A', 'Salle de réunion avec écran', NULL, 10, 5.50, 6.50, 'active', DEFAULT, DEFAULT),
       (2, 'Salle B', 'Salle de conférence avec projecteur', NULL, 20, 8.00, 10.00, 'active', DEFAULT, DEFAULT),
       (3, 'Salle C', 'Petite salle pour réunions', NULL, 6, 4.00, 5.00, 'inactive', DEFAULT, DEFAULT),
       (4, 'Salle D', 'Salle de formation avec ordinateurs', NULL, 15, 6.00, 8.00, 'active', DEFAULT, DEFAULT),
       (5, 'Salle E', 'Salle pour événements', NULL, 50, 12.00, 15.00, 'inactive', DEFAULT, DEFAULT);

-- Table Equipments
INSERT INTO `WorkhiveProd`.`Equipments` (`id`, `name`, `description`, `photo`, `total_stock`, `created_at`, `updated_at`)
VALUES (1, 'Projecteur', 'Projecteur 1080p', NULL, 5, DEFAULT, DEFAULT),
       (2, 'Tableau Blanc', 'Tableau effaçable', NULL, 10, DEFAULT, DEFAULT),
       (3, 'Ordinateur Portable', 'Ordinateur portable pour présentations', NULL, 3, DEFAULT, DEFAULT),
       (4, 'Télévision', 'Télévision 4K pour présentations', NULL, 2, DEFAULT, DEFAULT),
       (5, 'Microphone', 'Microphone sans fil', NULL, 7, DEFAULT, DEFAULT);

-- Table Equipment_Role_Rate
INSERT INTO `WorkhiveProd`.`Equipment_Role_Rate` (`id`, `equipment_id`, `user_role`, `hourly_rate`)
VALUES (1, 1, 'member', 15.00),
       (2, 2, 'user', 5.00),
       (3, 3, 'admin', 10.00),
       (4, 1, 'admin', 12.50),
       (5, 2, 'member', 8.00),
       (6, 4, 'member', 20.00),
       (7, 5, 'user', 7.50),
       (8, 3, 'user', 6.50),
       (9, 5, 'admin', 9.00);

-- Table Reservations
INSERT INTO `WorkhiveProd`.`Reservations` (`id`, `user_id`, `room_id`, `start_at`, `end_at`, `status`, `created_at`,
                                       `updated_at`)
VALUES (1, 1, 1, '2024-10-30 09:00:00', '2024-10-30 11:00:00', 'confirmed', DEFAULT, DEFAULT),
       (2, 2, 2, '2024-10-31 14:00:00', '2024-10-31 16:00:00', 'pending', DEFAULT, DEFAULT),
       (3, 3, 1, '2024-11-01 10:00:00', '2024-11-01 12:00:00', 'cancelled', DEFAULT, DEFAULT),
       (4, 4, 3, '2024-11-02 13:00:00', '2024-11-02 15:00:00', 'confirmed', DEFAULT, DEFAULT),
       (5, 5, 4, '2024-11-03 09:00:00', '2024-11-03 11:00:00', 'pending', DEFAULT, DEFAULT),
       (6, 6, 5, '2024-11-04 16:00:00', '2024-11-04 18:00:00', 'cancelled', DEFAULT, DEFAULT);

-- Table Room_Equipment
INSERT INTO `WorkhiveProd`.`Room_Equipment` (`id`, `room_id`, `equipment_id`, `quantity`, `assigned_at`)
VALUES (1, 1, 1, 1, DEFAULT),
       (2, 2, 2, 2, DEFAULT),
       (3, 3, 3, 1, DEFAULT),
       (4, 1, 2, 3, DEFAULT),
       (5, 4, 5, 2, DEFAULT),
       (6, 5, 4, 1, DEFAULT),
       (7, 3, 1, 2, DEFAULT),
       (8, 4, 3, 1, DEFAULT);

-- Table Room_Role_Rate
INSERT INTO `WorkhiveProd`.`Room_Role_Rate` (`id`, `room_id`, `user_role`, `hourly_rate`)
VALUES (1, 1, 'member', 50.00),
       (2, 2, 'user', 100.00),
       (3, 3, 'admin', 75.00),
       (4, 1, 'user', 60.00),
       (5, 2, 'admin', 90.00),
       (6, 4, 'member', 120.00),
       (7, 5, 'user', 200.00);

-- Table Reservation_Equipment
INSERT INTO `WorkhiveProd`.`Reservation_Equipment` (`id`, `reservation_id`, `equipment_id`, `quantity`, `created_at`,
                                                `updated_at`)
VALUES (1, 1, 1, 1, DEFAULT, DEFAULT),
       (2, 2, 2, 1, DEFAULT, DEFAULT),
       (3, 3, 3, 2, DEFAULT, DEFAULT),
       (4, 4, 5, 1, DEFAULT, DEFAULT),
       (5, 5, 4, 1, DEFAULT, DEFAULT),
       (6, 6, 2, 2, DEFAULT, DEFAULT),
       (7, 2, 5, 1, DEFAULT, DEFAULT),
       (8, 1, 3, 1, DEFAULT, DEFAULT);

COMMIT;