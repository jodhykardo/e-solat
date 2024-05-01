<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
include 'controllers/conn.php';
require 'controllers/constant.php';
require 'controllers/functions.php';

session_start();

$username = "";
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

// Pass the next prayer time timestamp to JavaScript
// echo "<script>var nextPrayerTimestamp = " . strtotime($nextPrayerTime) . " * 1000;var nextPrayerTime = '" . $nextPrayerTime . "'; var nextPrayerType = '" . $nextPrayerType . "'</script>";
?>

<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title>Dimension by HTML5 UP</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header">
            <div class="content">
                <div class="inner">
                    <?php
                    if ($username) {
                    ?>
                        <p id="nextPray"></p>
                    <?php } ?>
                    <h1>E-Solat</h1>
                    <p>by Jodi Kardo for USEA Recruit test process</p>
                    <?php
                    if ($username) {
                    ?>
                        <p>Welcome <?php echo $username; ?>!</p>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <nav>
                <ul>
                    <?php
                    if ($username) {
                    ?>
                        <li><a href="controllers/logout.php">Log out</a></li>
                    <?php
                    } else {
                    ?>
                        <li><a href="#login">login</a></li>
                    <?php
                    }
                    ?>
                    <li><a href="#solat" id="solat-menu">Solat</a></li>
                    <li><a href="#zone">Zone</a></li>
                    <?php
                    if ($username === "") {
                    ?>
                        <li><a href="#register">Register</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
            <?php
            if ($username) {
            ?>
                <p id="countdown"></p>
            <?php } ?>
        </header>

        <!-- Main -->
        <div id="main">

            <!-- login -->
            <article id="login">
                <h2 class="major">login</h2>
                <form action="controllers/login.php" method="POST">
                    <div class="fields">
                        <div class="field">
                            <label for="email">Email</label>
                            <input type="text" name="email" required>
                        </div>
                        <div class="field">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="field">
                            <button name="submit" class="btn">Login</button>
                        </div>
                    </div>
                </form>
            </article>

            <!-- Solat -->
            <article id="solat">
                <h2 class="major">Solat Time</h2>
                <div class="field">
                    <label for="demo-category">Zone</label>
                    <select name="demo-category" id="boxPrayerZoneSelect">
                        <option value="">Select Zone</option>
                        <?php
                        $stmt = $db->prepare("SELECT boxPrayerZone FROM box left join subsBox on box.boxId = subsBox.boxId WHERE subsBox.SubsId=:user_id");
                        $stmt->bindParam(':user_id', $_SESSION['user_id']);
                        $stmt->execute();
                        $box = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($box as $boxx) {
                        ?>
                            <option value="<?php echo $boxx['boxPrayerZone'] ?>"><?php echo $boxx['boxPrayerZone'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <br />
                <div class="table-wrapper">
                    <table id="prayerTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Imsak</th>
                                <th>Subuh</th>
                                <th>Syuruk</th>
                                <th>Zohor</th>
                                <th>Asar</th>
                                <th>Maghrib</th>
                                <th>Isyak</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </article>

            <!-- Zone -->
            <article id="zone">
                <h2 class="major">Zone</h2>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Zone Code</th>
                                <th style="text-align:center;"><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // grab prayer zone from box table
                            $stmt = $db->prepare("SELECT box.boxId, box.boxName, box.boxPrayerZone, subsBox.subsId FROM box left join subsBox on box.boxId = subsBox.boxId");
                            $stmt->execute();
                            $box = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($box as $boxx) {
                            ?>
                                <tr>
                                    <td><?php echo $boxx['boxName']; ?></td>
                                    <td><?php echo $boxx['boxPrayerZone']; ?></td>
                                    <td style="text-align:center;">
                                        <?php
                                        // Check if the logged-in account ID is not in subsBox table for the selected box
                                        $stmt = $db->prepare("SELECT COUNT(*) FROM subsBox WHERE subsId = :user_id AND boxId = :box_id");
                                        $stmt->bindParam(':user_id', $_SESSION['user_id']);
                                        $stmt->bindParam(':box_id', $boxx['boxId']);
                                        $stmt->execute();
                                        $rowCount = $stmt->fetchColumn();

                                        // If the count is 0, meaning the user is not subscribed to this box, show the subscribe button
                                        if ($rowCount == 0) {
                                            echo '<button onclick="subscribe(' . $boxx['boxId'] . ')">Subscribe</button>';
                                        } else {
                                            echo '<button onclick="unsubscribe(' . $boxx['boxId'] . ')">Unsubscribe</button>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </article>

            <!-- Register -->
            <article id="register">
                <h2 class="major">Registration</h2>
                <form action="controllers/register.php" method="post">
                    <div class="fields">
                        <div class="field">
                            <label for="email">Email:</label>
                            <input type="text" id="email" name="email" required>
                        </div>
                        <div class="field">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="field">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="field">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="field">
                            <input type="submit" value="Register">
                        </div>
                    </div>
                </form>
            </article>
        </div>
        <button onclick="getsong()">Play manually</button>
        <button onclick="stopPlay()">Stop</button>

        <!-- Footer -->
        <footer id="footer">
            <p class="copyright">&copy; E-Solat. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
        </footer>

    </div>

    <!-- BG -->
    <div id="bg"></div>

    <!-- SONG -->
    <audio id="song" controls autoplay>
    </audio>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        var loggedInUserId = <?php if ($_SESSION['user_id']) {
                                    echo $_SESSION['user_id'];
                                } else {
                                    echo "0";
                                } ?>;
        var currentTime = new Date().toLocaleString();
        var nextPrayTime;
        var nextPrayZone;
        var boxId;
        // user subscribe a box
        function subscribe(boxId) {

            $.ajax({
                url: 'controllers/ajax_subscribe.php',
                type: 'POST',
                data: {
                    userId: loggedInUserId,
                    boxId: boxId
                },
                success: function(response) {
                    alert(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(xhr.responseText);
                }
            });
        }

        // user unsubscribe a box
        function unsubscribe(boxId) {
            $.ajax({
                url: 'controllers/ajax_subscribe.php/?user_id=' + loggedInUserId + "&box_id=" + boxId,
                type: 'DELETE',
                success: function(response) {
                    alert(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(xhr.responseText);
                }
            });
        }

        // get prayer time data
        $(document).ready(function() {
            $('#boxPrayerZoneSelect').on('change', function() {
                var selectedValue = $(this).val(); // Retrieve the selected value

                // Send the selected value to the server using AJAX
                $.ajax({
                    url: 'controllers/ajax_prayer_data.php?zone=' + selectedValue,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Update the table with the received data
                        updatePrayerTable(data);
                    },
                    error: function(xhr, status, error) {
                        // Error handling
                        console.error('Error:', xhr.responseText);
                    }
                });
            });
        });

        // show the data to #solat menu
        function updatePrayerTable(data) {
            var prayerTable = $('#prayerTable');
            var tableBody = prayerTable.find('tbody');

            sorted_data = []
            for (x = 0; x < data.length; x++) {
                var currentItem = data[x];

                // Check if there's an existing object for the current date
                var existingDateIndex = sorted_data.findIndex(function(item) {
                    return item.date === currentItem.prayerDate;
                });

                // If no object exists for the current date, create a new one
                if (existingDateIndex === -1) {
                    var newDateObject = {
                        date: currentItem.prayerDate,
                        day: currentItem.dayName,
                        imsak: [],
                        fajr: [],
                        syuruk: [],
                        dhuhr: [],
                        asr: [],
                        maghrib: [],
                        isyak: []
                    };
                    // Push the new object to the sorted_data array
                    sorted_data.push(newDateObject);
                    // Set existingDateIndex to the index of the newly pushed object
                    existingDateIndex = sorted_data.length - 1;
                }

                // Push the prayer time to the corresponding array in the existing object
                switch (currentItem.prayerType) {
                    case 'imsak':
                        sorted_data[existingDateIndex].imsak.push(currentItem.prayerTime);
                        break;
                    case 'fajr':
                        sorted_data[existingDateIndex].fajr.push(currentItem.prayerTime);
                        break;
                    case 'syuruk':
                        sorted_data[existingDateIndex].syuruk.push(currentItem.prayerTime);
                        break;
                    case 'dhuhr':
                        sorted_data[existingDateIndex].dhuhr.push(currentItem.prayerTime);
                        break;
                    case 'asr':
                        sorted_data[existingDateIndex].asr.push(currentItem.prayerTime);
                        break;
                    case 'maghrib':
                        sorted_data[existingDateIndex].maghrib.push(currentItem.prayerTime);
                        break;
                    case 'isha':
                        sorted_data[existingDateIndex].isyak.push(currentItem.prayerTime);
                        break;
                    default:
                        break;
                }
            }

            // Clear existing table rows
            tableBody.empty();

            // Populate the table with new data
            $.each(sorted_data, function(index, prayer) {
                var row = $('<tr>');
                row.html(`
            <td>${prayer.date}</td>
            <td>${prayer.day}</td>
            <td>${prayer.imsak}</td>
            <td>${prayer.fajr}</td>
            <td>${prayer.syuruk}</td>
            <td>${prayer.dhuhr}</td>
            <td>${prayer.asr}</td>
            <td>${prayer.maghrib}</td>
            <td>${prayer.isyak}</td>
        `);
                tableBody.append('</tr>');
                tableBody.append(row);
            });
        }

        function getNextPrayTime() {
            if (loggedInUserId !== 0) {
                $.ajax({
                    url: 'controllers/ajax_prayer_time.php',
                    type: 'POST',
                    data: {
                        userId: loggedInUserId,
                        currentTime: currentTime
                    },
                    success: function(response) {
                        nextPrayTime = response.nextPrayerDate + " " + response.nextPrayerTime;
                        nextPrayZone = response.prayerZone;
                        if(nextPrayZone){
                            var solatText = "Your next solat at zone " + response.prayerZone + " is " + response.nextPrayerType + " at " + response.nextPrayerDate + " " + response.nextPrayerTime;
                            document.getElementById("nextPray").innerHTML = solatText;
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.error(xhr.responseText);
                    }
                });
            }
        }

        function ampmtoTimestamp(dateString) {
            // Split the date string into its components
            var parts = dateString.split(/[\s,/:]+/);

            // Extract the date components
            var month = parseInt(parts[0]) - 1; // Months are zero-based in JavaScript
            var day = parseInt(parts[1]);
            var year = parseInt(parts[2]);

            // Extract the time components
            var hours = parseInt(parts[3]);
            var minutes = parseInt(parts[4]);
            var seconds = parseInt(parts[5]);

            // Adjust hours for PM if necessary
            if (parts[6].toLowerCase() === "pm" && hours !== 12) {
                hours += 12;
            } else if (parts[6].toLowerCase() === "am" && hours === 12) {
                hours = 0;
            }

            // Create a new Date object with the parsed components
            var dateObject = new Date(year, month, day, hours, minutes, seconds);

            // Adjust hours for PM if necessary
            if (parts[4].toLowerCase() === "pm" && hours !== 12) {
                hours += 12;
            }

            // Create a new Date object with the parsed components
            var dateObject = new Date(year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds);

            // Get the timestamp in milliseconds using the getTime() method
            var timestamp = dateObject.getTime();

            return timestamp;
        }
        // solat time countdown
        function updateCountdown() {
            if (loggedInUserId !== 0) {
                var nextPrayerTimestamp = new Date(nextPrayTime);
                nextPrayerTimestamp = nextPrayerTimestamp.getTime();
                currentTime = new Date().toLocaleString();
                var formattedCurrentTime = ampmtoTimestamp(currentTime);
                var remainingTime = nextPrayerTimestamp - formattedCurrentTime;

                // Convert remaining time to hours and minutes
                var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
                // Display the remaining time in the element with id="countdown"
                if (hours === 0 && minutes === 0 && seconds === 0) {
                    getsong();
                    getNextPrayTime();
                } else if(hours){
                    document.getElementById("countdown").innerHTML = "Time remaining until next solat: " + hours + ":" + minutes + ":" + seconds;
                }
            }
        }

        function getsong() {
            if (loggedInUserId !== 0) {
                $.ajax({
                    url: 'controllers/ajax_get_song.php',
                    type: 'POST',
                    data: {
                        zone: nextPrayZone,
                    },
                    success: function(response) {
                        playSong("songs/" + response.songUrl)
                    },
                    error: function(xhr, status, error) {
                        sendEmail("phu@expressinmusic.com","Error get song","Error getting song for BoxID:" +boxId+" , prayer time zone: "+ nextPrayZone + " because: "+ xhr.responseText)
                        console.error(xhr.responseText);
                    }
                });
            }
        }

        function sendEmail(to, subject, message) {
            $.ajax({
                url: 'controllers/ajax_send_email.php',
                type: 'POST',
                data: {
                    to: to,
                    subject: subject,
                    message: message
                },
                success: function(response) {
                    console.log("Mail sent!")
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function playSong(songUrl) {
            var audio = document.getElementById("song");
            audio.src = songUrl;
            audio.play();
        }

        function stopPlay() {
            var audio = document.getElementById("song");
            audio.pause()
        }

        // Call the updateCountdown function every second to update the timer
        setInterval(updateCountdown, 1000);

        window.onload = function() {
            getNextPrayTime();
        }
    </script>

</body>

</html>