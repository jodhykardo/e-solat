<?php
require "conn.php";

$zone = $_GET['zone'];

$stmt = $db->prepare("SELECT prayerDate, prayerTime, prayerType FROM prayer WHERE prayerZone=:prayer_zone");
$stmt->bindParam(':prayer_zone', $zone);
$stmt->execute();
$prayers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convert date to day name
foreach ($prayers as &$prayer) {
    $prayer['dayName'] = date('l', strtotime($prayer['prayerDate']));
}

header('Content-Type: application/json');
echo json_encode($prayers);
?>
