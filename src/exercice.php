<?php

    require "Room.php";

    function createRoom(array &$rooms,
        string $id,
        string $name,
        int $capacity,
        float $width,
        float $length,
        string $status = 'active',
        string|null $description = null,
        string|null $photo = null,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null
    ): Room
    {
        $room = new Room($id, $name, $capacity, $width, $length, $status, $description, $photo, $createdAt, $updatedAt);
        $rooms[] = $room;
        return $room;
    }

    function showRoom(Room $room): void
    {
        echo '[' . $room->getId() . ':' . $room->getName() . ' (' . $room->getCapacity() . ')<br>';
    }

    function listRooms(array $rooms): void
    {
        /** @var Room $room */
        foreach ($rooms as $room) {
            showRoom($room);
        }
    }

    function getRoom(array $rooms, string $id): Room|null
    {
        /** @var Room $room */
        foreach ($rooms as $room) {
            if ($room->getId() === $id) {
                return $room;
            }
        }

        return null;
    }


    /**
     * @throws \Exception
     */
    function createReservation(
        array &$reservations,
        array &$rooms,
        string $id,
        string $userName,
        Room|string $roomOrId,
        ?DateTime $date = null,
        string $status = "confirmée"
    ): void {
        if ($status !== 'confirmée' && $status !== 'annulée') {
            throw new Exception('Status invalide');
        }

        if ($date === null) {
            $date = new DateTime();
        }

        if (is_string($roomOrId)) {
            $room = getRoom($rooms, $roomOrId);
        } else {
            $room = $roomOrId;
        }

        $reservations[] = [
            'id'       => $id,
            'userName' => $userName,
            'room'     => $room,
            'date'     => $date,
            'status'   => $status
        ];
    }

    /**
     * Afficher a l'ecran les informations d'une reservation
     *
     * @param array $reservation
     *
     * @return void
     * @throws \Exception
     */
    function showReservation(array $reservation): void
    {
        if (
            !array_key_exists('id', $reservation) ||
            !array_key_exists('userName', $reservation) ||
            !array_key_exists('room', $reservation) ||
            !array_key_exists('date', $reservation) ||
            !array_key_exists('status', $reservation)
        ) {
            throw new Exception('Reservation invalide');
        }

        if (!($reservation['date'] instanceof DateTime)) {
            throw new Exception('Date invalide');
        }

        echo 'ID: ' . $reservation['id'] . '<br>';
        echo 'Nom de l\'utilisateur: ' . $reservation['userName'] . '<br>';

        echo 'Salle: ' . $reservation['room']->getName() . '<br>';

        echo 'Date: ' . $reservation['date']->format('d/m/Y H:i') . '<br>';
        echo 'Status: ' . $reservation['status'] . '<br>';
    }

    /**
     * @throws \Exception
     */
    function listReservation(array $reservations, string|null $status = null, DateTime|null $date = null): void
    {
        foreach ($reservations as $reservation) {
            if ($date !== null) {
                $date = new DateTime($date->format('Y-m-d'));
            }

            if ($reservation['date'] !== null) {
                $reservationDate = new DateTime($reservation['date']->format('Y-m-d'));
            } else {
                $reservationDate = null;
            }

            if (
                ($status === null || $reservation['status'] === $status) &&
                ($date === null || $reservationDate == $date)
            ) {
                showReservation($reservation);
                echo '<br>';
            }
        }
    }

    /**
     * @throws \Exception
     */
    function deleteReservation(array &$reservations, string $id): void
    {
        $founded = false;
        foreach ($reservations as &$reservation) {
            if ($reservation['id'] === $id) {
                $founded = true;
                $reservation['status'] = 'annulée';
            }
        }

        if ($founded === false) {
            throw new Exception('Reservation non trouvée');
        }
    }

    /**
     * @throws \Exception
     */
    function findReservation(array $reservations, string $userName): void
    {
        foreach ($reservations as $reservation) {
            if ($reservation['userName'] === $userName) {
                showReservation($reservation);
                echo '<br>';
            }
        }
    }


    $reservations = [];
    $rooms = [];

    echo "<h1>Test 0 : Création de rooms</h1>";

    $salle1 = createRoom($rooms, '1', 'Salle 1', 10, 10, 20);
    $salle2 = createRoom($rooms, '2', 'Salle 2', 14, 23, 100);
    $salle3 = createRoom($rooms, '3', 'Salle 3', 18, 58, 78);

    listRooms($rooms);


    //test
    echo "<h1>Test 1 : Création de réservations</h1>";
    createReservation($reservations, $rooms,'1', 'Jean', $salle1, new DateTime('2021-01-01 08:00'));
    createReservation($reservations, $rooms, '2', 'Paul', $salle2);
    createReservation($reservations, $rooms, '3', 'Pierre', $salle3);
    createReservation($reservations, $rooms, '4', 'Paul', $salle1);

    echo "<h1>Test 2 : liste des réservations confirmée</h1>";
    listReservation($reservations, 'confirmée', null);

    echo "<h1>Test 3 : delete réservation</h1>";
    deleteReservation($reservations, '2');

    echo "<h1>Test 4 : liste des réservations confirmée</h1>";
    listReservation($reservations, 'confirmée', null);

    echo "<h1>Test 5 : liste des réservations annulée</h1>";
    listReservation($reservations, 'annulée', null);

    echo "<h1>Test 5 : liste des réservations d'aujourd'hui</h1>";
    listReservation($reservations, null, new DateTime());


    echo "<h1>Test 6 : findReservation Paul</h1>";
    findReservation($reservations, 'Paul');

