<?php
require "conn.php";
$currentTime = $_POST['currentTime'];
$currentTime = DateTime::createFromFormat('n/j/Y, g:i:s A', $currentTime);
$currentTime = $currentTime->format('Y-m-d H:i:s');
$currentUser = $_POST['userId'];

// Custom sorting function to compare datetime values
function compareDatetime($a, $b) {
    $datetimeA = strtotime($a['nextPrayerDate'] . ' ' . $a['nextPrayerTime']);
    $datetimeB = strtotime($b['nextPrayerDate'] . ' ' . $b['nextPrayerTime']);
    return $datetimeA - $datetimeB;
}

$subscribedBoxesQuery = "SELECT box.boxId, box.boxPrayerZone
                         FROM box
                         INNER JOIN subsBox ON box.boxId = subsBox.boxId
                         WHERE subsBox.subsId = :subsId
                         ORDER BY subsBox.subsBoxId ASC";

$subscribedBoxesStmt = $db->prepare($subscribedBoxesQuery);
$subscribedBoxesStmt->bindParam(':subsId', $currentUser);
$subscribedBoxesStmt->execute();
$subscribedBoxes = $subscribedBoxesStmt->fetchAll(PDO::FETCH_ASSOC);

if ($subscribedBoxes) {
    // Loop through each subscribed box to find the next prayer time
    $nextPrayerTimes = [];
    foreach ($subscribedBoxes as $box) {
        // Fetch the next prayer time for the subscribed prayer zone
        $nextPrayerQuery = "SELECT *
                            FROM prayer
                            WHERE PrayerZone = :prayerZone
                                AND CONCAT(prayerDate, ' ', prayerTime) > :currentTime
                            ORDER BY prayerDate, prayerTime
                            LIMIT 1";

        $nextPrayerStmt = $db->prepare($nextPrayerQuery);
        $nextPrayerStmt->bindParam(':prayerZone', $box['boxPrayerZone']);
        $nextPrayerStmt->bindParam(':currentTime', $currentTime);
        $nextPrayerStmt->execute();
        $nextPrayer = $nextPrayerStmt->fetch(PDO::FETCH_ASSOC);
        
        if ($nextPrayer) {
            // Store the next prayer time for this zone
            $nextPrayerTimes[] = [
                'prayerZone' => $box['boxPrayerZone'],
                'nextPrayerDate' => $nextPrayer['prayerDate'],
                'nextPrayerTime' => $nextPrayer['prayerTime'],
                'nextPrayerType' => $nextPrayer['prayerType']
            ];
        }
    }
    usort($nextPrayerTimes, 'compareDatetime');
    header('Content-type: application/json');
    echo json_encode($nextPrayerTimes[0]);
} else {
    echo "You haven't subscribed to any prayer zones.";
}

?>