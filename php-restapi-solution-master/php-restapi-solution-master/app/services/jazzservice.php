<?php
require_once __DIR__ . '/../repositories/jazzrepository.php';
require_once __DIR__ . '/utilityservice.php';


class JazzService
{
    private $jazzRepository;
    private $eventRepository;
    private $utilityService;
    private $allowed_extensions = ['png', 'jpg', 'jpeg', 'gif'];

    function __construct()
    {
        $this->jazzRepository = new JazzRepository();
        $this->eventRepository = new EventRepository();
        $this->utilityService = new UtilityService();
    }
    public function getAllArtists()
    {
        $artists = $this->jazzRepository->getAllArtists();
        foreach ($artists as $artist) {
            $artist->setTimeSlots($this->jazzRepository->getAllTimeSlots($artist));
        }
        return $artists;
    }
    public function getAllTimeSlots()
    {
        try {
            $timeSlots = $this->jazzRepository->getAllJazzTimeSlots();
            return $timeSlots;
        } catch (error $e) {
            throw $e;
        }
    }
    public function getAllDayTicketsTimeSlots()
    {
        try {
            $timeSlots = $this->jazzRepository->getAllDayTimeSlots();
            return $timeSlots;
        } catch (error $e) {
            throw $e;
        }
    }
    public function getAllLocations()
    {
        try {
            $locations = $this->jazzRepository->getAllLocations();
            return $locations;
        } catch (error $e) {
            throw $e;
        }
    }
    public function getAllHalls()
    {
        try {
            $halls = $this->jazzRepository->getAllHalls();
            return $halls;
        } catch (error $e) {
            throw $e;
        }
    }
    public function updateArtist($artist)
    {
        try {
            $this->validateArtistData($artist);
            $this->checkArtistIDExists($artist);
            $this->jazzRepository->updateArtist($artist);
        } catch (error $e) {
            throw $e;
        }
    }
    public function deleteArtist($artist)
    {
        try {
            $this->checkArtistIDExists($artist);
            $this->jazzRepository->deleteArtist($artist);
        } catch (error $e) {
            throw $e;
        }
    }
    public function deleteLocation($location)
    {
        try {
            $this->checkLocationIDExists($location);
            $this->jazzRepository->deleteLocation($location);
        } catch (error $e) {
            throw $e;
        }
    }
    public function createArtist($artist)
    {
        try {
            $this->validateArtistData($artist);
            return $this->jazzRepository->createArtist($artist);
        } catch (error $e) {
            throw $e;
        }
    }
    public function updateLocation($location)
    {
        try {
            $this->validateLocationData($location);
            $this->checkLocationIDExists($location);
            return $this->jazzRepository->updateLocation($location);
        } catch (error $e) {
            throw $e;
        }
    }
    public function createLocation($location)
    {
        try {
            $this->validateLocationData($location);
            return $this->jazzRepository->createLocation($location);
        } catch (error $e) {
            throw $e;
        }
    }

    public function updateTimeslotJazz($timeSlotJazz)
    {
        try {
            $this->validateTimeSlotData($timeSlotJazz);
            $this->checkTimeSlotIDExists($timeSlotJazz);
            return $this->jazzRepository->updateTimeSlotJazz($timeSlotJazz);
        } catch (error $e) {
            throw $e;
        }
    }
    public function createTimeSlotJazz($timeSlotJazz)
    {
        try {
            $this->validateTimeSlotData($timeSlotJazz);
            return $this->jazzRepository->createAndPopulateTimeSlotJazz($timeSlotJazz);
        } catch (error $e) {
            throw $e;
        }
    }
    public function deleteTimeslotJazz($timeslot)
    {
        try {
            $this->checkTimeSlotIDExists($timeslot);
            $this->jazzRepository->deleteTimeslotJazz($timeslot);
        } catch (error $e) {
            throw $e;
        }
    }

    private function validateArtistData($artist)
    {
        if (!$this->validateImage($artist->getImage(), $this->allowed_extensions)) {
            $extensions = implode(', ', $this->allowed_extensions);
            throw new ErrorException("Image path is not in the correct format. It must be one of the following types: {$extensions}");
        }
        if (strlen($artist->getDescription()) > 1200) {
            throw new ErrorException("Description must be under 1200 characters.");
        }

        if (strlen($artist->getName()) > 90) {
            throw new ErrorException("Artist name must be under 90 characters.");
        }
    }
    private function checkArtistIDExists($artist)
    {
        if (!$this->jazzRepository->checkArtistIDExists($artist->getArtistID())) {
            throw new ErrorException("The provided artistID does not exist.");
        }
    }
    private function checkLocationIDExists($location)
    {
        if (!$this->jazzRepository->checkLocationIDExists($location->getLocationID())) {
            throw new ErrorException("The provided artistID does not exist.");
        }
    }
    private function checkTimeSlotIDExists($timeslot)
    {
        if (!$this->jazzRepository->checkTimeSlotIDExists($timeslot->getTimeSlotID())) {
            throw new ErrorException("The provided timeslot does not exist.");
        }
    }


    private function validateImage($path, $allowed_extensions)
    {

        $path_info = pathinfo($path);
        if (isset($path_info['extension']) && in_array(strtolower($path_info['extension']), $allowed_extensions)) {
            return true;
        }
        return false;
    }
    private function validateLocationData($location)
    {
        if (!$this->validateImage($location->getLocationImage(), $this->allowed_extensions)) {
            $extensions = implode(', ', $this->allowed_extensions);
            throw new ErrorException("Image path is not in the correct format. It must be one of the following types: {$extensions}");
        }
        if (strlen($location->getToAndFromText()) > 1500) {
            throw new ErrorException("To and from text must be under 1500 characters.");
        }
        if (strlen($location->getAccesibillityText()) > 1500) {
            throw new ErrorException("Accesibillity Text must be under 1500 characters.");
        }
        if (strlen($location->getLocationName()) > 45) {
            throw new ErrorException("Location name must be under 45 characters.");
        }
        if (strlen($location->getAddress()) > 90) {
            throw new ErrorException("Address name must be under 90 characters.");
        }
    }
    private function checkHallIDExists($hall)
    {
        if (!$this->jazzRepository->checkHallIDExists($hall->getHallID())) {
            throw new ErrorException("The provided hallID does not exist.");
        }
    }
    private function checkForValidHallAndLocationCombi($hall, $location)
    {
        if (!$this->jazzRepository->checkHallAndLocationCombiExists($hall->getHallID(), $location->getLocationID())) {
            throw new ErrorException("The given hall does not belong with the given location.");
        }
    }
    private function validateTimeslotData($timeslot)
    {
        $this->checkArtistIDExists($timeslot->getArtist());
        $this->checkLocationIDExists($timeslot->getJazzLocation());
        $this->checkHallIDExists($timeslot->getHall());
        $this->checkForValidHallAndLocationCombi($timeslot->getHall(), $timeslot->getJazzLocation());
        $this->validateStartAndEndTimes($timeslot->getStartTime(), $timeslot->getEndTime());
        if (floatval($timeslot->getPrice()) > 150) {
            throw new ErrorException("Price cannot be higher than 150!");
        }
    }

    private function validateStartAndEndTimes(dateTime $start, dateTime $end)
    {
        $festivalInformation = $this->eventRepository->getFestivalInformation();
        $festivalStart = $festivalInformation->getStartTime();
        $festivalEnd = $festivalInformation->getEndTime();
        if ($start >= $end) {
            throw new ErrorException("Start time must be earlier than end time.");
        }
        if ($start < $festivalStart) {
            throw new ErrorException("Start time must be later than atleast the {$festivalStart->format('jS \o\f F')}");
        }
        if ($end > $festivalEnd) {
            throw new ErrorException("End time must be earlier than or equal to the {$festivalEnd->format('jS \o\f F')}");
        }
        // if ($start->format('Y-m-d') != $end->format('Y-m-d')) {
        //     throw new ErrorException("Start time and end time must be on the same day!");
        // }
    }
    public function updateArtistService($data)
    {
        $artist = $this->utilityService->createAndValidateObject(
            $data,
            'JazzArtist',
            [
                $data["artistID"],
                $data["name"],
                $data["description"],
                $data["image"],
                $data["imageSmall"]
            ],
            ['integer', 'string', 'string', 'string', 'string']
        );

        if ($artist) {
            $this->updateArtist($artist);
            return 'Artist is successfully updated!';
        }
    }
    public function deleteArtistService($data)
    {
        $artist = $this->utilityService->createAndValidateObject(
            $data,
            'JazzArtist',
            [$data["artistID"]],
            ['integer']
        );

        if ($artist) {
            $this->deleteArtist($artist);
            return 'Artist is successfully deleted!';
        }
    }

    public function createArtistService($data)
    {
        $artist = $this->utilityService->createAndValidateObject(
            $data,
            'JazzArtist',
            [
                0,
                $data["name"],
                $data["description"],
                $data["image"],
                $data["imageSmall"]
            ],
            ['integer', 'string', 'string', 'string', 'string']
        );

        if ($artist) {
            return ['message' => 'Artist is successfully created!', 'artist' => $this->createArtist($artist)];
        }
    }

    public function updateLocationService($data)
    {
        $location = $this->utilityService->createAndValidateObject(
            $data,
            'JazzLocation',
            [$data["locationID"], $data["locationName"], $data["address"], $data["locationImage"], $data["toAndFromText"], $data["accesibillityText"]],
            ['integer', 'string', 'string', 'string', 'string', 'string']
        );

        if ($location) {
            $this->updateLocation($location);
            return 'Location is successfully updated!';
        }
    }

    public function deleteLocationService($data)
    {
        $location = $this->utilityService->createAndValidateObject(
            $data,
            'JazzLocation',
            [$data["locationID"]],
            ['integer']
        );

        if ($location) {
            $this->deleteLocation($location);
            return 'Location is successfully deleted!';
        }
    }
    public function createLocationService($data)
    {
        $location = $this->utilityService->createAndValidateObject(
            $data,
            'JazzLocation',
            [0, $data["locationName"], $data["address"], $data["locationImage"], $data["toAndFromText"], $data["accesibillityText"]],
            ['integer', 'string', 'string', 'string', 'string', 'string']
        );

        if ($location) {
            return ["message"=> 'Location is successfully created!', "location"=> $this->createLocation($location)];
        }
    }

    public function updateTimeslotService($data)
    {
        $timeslot = $this->utilityService->createAndValidateObject(
            $data,
            'timeSlotsJazz',
            [
                $data["timeslotID"],
                new JazzArtist($data["artist"]),
                1,
                new JazzLocation($data["location"]),
                new Hall($data["hall"]),
                $data["price"],
                $data["startTime"],
                $data["endTime"],
                $data["maximumAmountTickets"],
            ],
            ['integer', 'object', 'integer', 'object', 'object', 'double', 'string', 'string', 'integer']
        );

        if ($timeslot) {
            $this->updateTimeslotJazz($timeslot);
            return 'Timeslot is successfully updated!';
        }
    }
    public function createTimeSlotService($data)
    {
        $timeslot = $this->utilityService->createAndValidateObject(
            $data,
            'timeSlotsJazz',
            [
                0,
                new JazzArtist($data["artist"]),
                1,
                new JazzLocation($data["location"]),
                new Hall($data["hall"]),
                $data["price"],
                $data["startTime"],
                $data["endTime"],
                $data["maximumAmountTickets"],
            ],
            ['integer', 'object', 'integer', 'object', 'object', 'double', 'string', 'string', 'integer']
        );

        if ($timeslot) {
            return ["message"=> 'Timeslot is successfully created!', "timeslot"=> $this->createTimeSlotJazz($timeslot)];
        }
    }

    public function deleteTimeslotService($data)
    {
        $timeslot = $this->utilityService->createAndValidateObject(
            $data,
            'timeSlot',
            [$data["timeSlotID"]],
            ['integer']
        );

        if ($timeslot) {
            $this->deleteTimeslotJazz($timeslot);
            return 'Timeslot is successfully deleted!';
        }
    }
}
