<?php

require "conn.php";

// grab prayer zone from box table
$stmt = $db->prepare("SELECT boxPrayerZone FROM box");
$stmt->execute();

$prayerZone = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo count($prayerZone);
foreach ($prayerZone as $zone) {
    echo $zone['boxPrayerZone'];
    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, 'https://www.e-solat.gov.my/index.php?r=esolatApi/TakwimSolat&period=week&zone=' . $zone['boxPrayerZone']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL request and get the response
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    // Decode the JSON response
    $response_data = json_decode($response, true);

    // Change date format from "29-Apr-2024" to "2024-04-29"
    foreach ($response_data['prayerTime'] as &$prayer) {
        $prayer['date'] = date('Y-m-d', strtotime($prayer['date']));
    }

    // Begin the transaction
    $db->beginTransaction();

    try {
        // Loop through prayer time data and insert into database
        foreach ($response_data['prayerTime'] as $prayer) {
            $date = $prayer['date'];
            $imsak = $prayer['imsak'];
            $fajr = $prayer['fajr'];
            $syuruk = $prayer['syuruk'];
            $dhuhr = $prayer['dhuhr'];
            $asr = $prayer['asr'];
            $maghrib = $prayer['maghrib'];
            $isha = $prayer['isha'];

            // Prepare SQL statement
            $stmt = $db->prepare("INSERT INTO prayer (prayerZone, prayerDate, prayerTime, prayerType)
                            VALUES (:zone, :date, :time, :type)
                            ON DUPLICATE KEY UPDATE prayerTime = VALUES(prayerTime)");

            // Bind parameters
            $stmt->bindParam(':zone', $response_data['zone']);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':type', $type);

            // Execute the statement for each prayer time
            $prayerTimes = [
                ['time' => $imsak, 'type' => 'imsak'],
                ['time' => $fajr, 'type' => 'fajr'],
                ['time' => $syuruk, 'type' => 'syuruk'],
                ['time' => $dhuhr, 'type' => 'dhuhr'],
                ['time' => $asr, 'type' => 'asr'],
                ['time' => $maghrib, 'type' => 'maghrib'],
                ['time' => $isha, 'type' => 'isha']
            ];
            foreach ($prayerTimes as $prayerTime) {
                $time = $prayerTime['time'];
                $type = $prayerTime['type'];
                $stmt->execute();
            }
        }

        // Commit the transaction
        $db->commit();
        echo "Prayer time data inserted successfully.";
    } catch (PDOException $e) {
        // Rollback the transaction if something goes wrong
        $db->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

// Close db connection
$db = null;
