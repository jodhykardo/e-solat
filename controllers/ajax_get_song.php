<?php
require "conn.php";
$prayerZone = $_POST['zone'];

$stmt = $db->prepare("SELECT b.boxId, s.songName, s.songUrl FROM box b JOIN boxSong bs ON b.boxId = bs.boxId JOIN song s ON bs.songId = s.songId WHERE b.boxPrayerZone = :prayerZone order by RAND()");
$stmt->bindParam(':prayerZone', $prayerZone, PDO::PARAM_STR);

// Execute the query
$stmt->execute();

// Fetch data and display results
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$song = [
    "boxId" => $row['boxId'],
    "songName" => $row['songName'],
    "songUrl" => $row['songUrl']
];

header('Content-type: application/json');
echo json_encode($song);