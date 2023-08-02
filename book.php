<?php
include 'db.php';
  ob_start();
  header("Content-Type: text/html");
  session_start();

//$con = mysqli_connect("localhost", "root", "", "airlines");

if ($con->connect_error) {
    die('connection failed: ' . $con->connect_error);
}

$header = "Content-Type: application/json";
header($header);
$date = date("M d, Y");

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $store = mysqli_query($con, $sql);
    echo $username;
    unset($_SESSION['username']);
} else {
    echo json_encode("Please log in first to book tickets.");
    exit();
}

    $fid =120802;
    $sql = "SELECT * FROM find WHERE f_id='$fid'";
    $enter = mysqli_query($con, $sql);

    if (mysqli_num_rows($enter) == 1) {
        echo '<html>
        <body>
        <style>
            table {
              border-collapse: collapse;
              width: 100%;
              text-align: center;
            }
            td {
              padding: 10px;
            }
          </style>
          ';

        echo '<table>';
        while ($row = mysqli_fetch_array($enter)) {
            echo '
            <tr>
                <th>From : ' . $row['from_place'] . '</th>
                <th>Travel Time : </th>
                <th>To : ' . $row['to_place'] . '</th>
                <th>Amount : </th>
                <th></th>
            </tr>        
            <tr>
                <td>' . $row['departure'] . '</td>
                <td>' . $row['time'] . '</td>
                <td>' . $row['arrival'] . '</td>
                <td>' . $row['amount'] . ' </td>
                <td></td>
            </tr>
            ';
        }
        echo '</table>
            <button style="position: absolute; right: 30px; top: 40px;">Button</button>
          </body>
        </html>';
    }
/*else {
    echo '<html>
        <head> </head>
        <body>
        <script type="text/javascript">
            alert("fid not available");
        </script>
        </body>
        </html>';
}*/

    mysqli_close($con);
    ob_end_flush();
?>