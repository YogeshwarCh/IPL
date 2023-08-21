<?php

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'ipl');

$match = $_POST['M_name'];
$team1 = "SELECT Team_1 FROM match_ WHERE M_ID='$match'";
$team2 = "SELECT Team_2 FROM match_ WHERE M_ID='$match'";
$team1_run = mysqli_query($connection, $team1);
$team2_run = mysqli_query($connection, $team2);

$rows = mysqli_fetch_assoc($team1_run);
$team1 = $rows['Team_1'];
$rows = mysqli_fetch_assoc($team2_run);
$team2 = $rows['Team_2'];

$bat1 = "SELECT DISTINCT players.P_name, individual_stats.Runs, individual_stats.Boundaries, individual_stats.Sixes, individual_stats.Strike_rate 
from 
players INNER JOIN individual_stats ON players.P_Id=individual_stats.P_Id 
INNER JOIN team ON players.Team_Id=team.Team_Id 
WHERE individual_stats.M_Id='$match' AND team.Team_Name='$team1'";

$bat2 = "SELECT DISTINCT players.P_name, individual_stats.Runs, individual_stats.Boundaries, individual_stats.Sixes, individual_stats.Strike_rate 
from 
players INNER JOIN individual_stats ON players.P_Id=individual_stats.P_Id 
INNER JOIN team ON players.Team_Id=team.Team_Id 
WHERE individual_stats.M_Id='$match' AND team.Team_Name='$team2'";


$sql1 = "SELECT t.Team_1, t.Team_2, t.Winner, t.Man_of_match, t.M_date, v.V_name 
            from
            (match_ as t INNER JOIN venue as v ON t.V_Id = v.V_Id) WHERE M_Id='$match'";

$sql1_run = mysqli_query($connection, $sql1);
$bat1_run = mysqli_query($connection, $bat1);
$bat2_run = mysqli_query($connection, $bat2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?php echo $match ?></title>
  <style>
    body{
      background-color: lightskyblue;
    }

    ul {
      font-size: 20px;
    }

    table {
      margin-left: 570px;
      margin-top: 30px;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 15px 15px;
      text-align: center;
      border-collapse: collapse;
      border: solid black 2px;
      font-size: 20px;
    }

    th {
      font-size: 25px;
    }

    strong {
      font-size: 40px;
    }

    .logo1 {
      margin-right: 50px;
    }

    .logo2 {
      margin-left: 50px;
    }
  </style>
</head>

<body>

  <?php
  while ($rows = mysqli_fetch_assoc($sql1_run)) {
    $team1 = $rows['Team_1'];
    $team2 = $rows['Team_2'];
    $winner = $rows['Winner'];
    $mom = $rows['Man_of_match'];
    $date = $rows['M_date'];
    $venue = $rows['V_name'];
  }
  ?>

  <center><img class="logo1" src="<?php echo "images/" . $team1 ?>.png" alt="<?php echo $team1 ?>"><img class="logo2" src="<?php echo "images/" . $team2 ?>.png" alt="<?php echo $team2 ?>">
    <h1><?php echo $team1 . " v/s " . $team2 ?></h1>

  </center>

  <!-- <strong>Match Details</strong> -->
  <table>
    <tbody>
      <tr>
        <th>Match ID</th>
        <th><?php echo $match ?></th>
      </tr>
      <tr>
        <td>Team 1</td>
        <td><?php echo $team1 ?></td>
      </tr>
      <tr>
        <td>Team 2</td>
        <td><?php echo $team2 ?></td>
      </tr>
      <tr>
        <td>Winner</td>
        <td><?php echo $winner ?></td>
      </tr>
      <tr>
        <td>Man of the match</td>
        <td><?php echo $mom ?></td>
      </tr>
      <tr>
        <td>Date</td>
        <td><?php echo $date ?></td>
      </tr>
      <tr>
        <td>Venue</td>
        <td><?php echo $venue ?></td>
      </tr>
    </tbody>
  </table>


  <center><h1><?php echo $team1 ?> Scorecard</h1></center>
  <table>
    <tr>
      <th>Player Name</th>
      <th>Runs</th>
      <th>Boundaries</th>
      <th>Sixes</th>
      <th>Strike Rate</th>
    </tr>
  <?php
  while ($rows = mysqli_fetch_assoc($bat1_run)) {
    $name = $rows['P_name'];
    $runs = $rows['Runs'];
    $four = $rows['Boundaries'];
    $six = $rows['Sixes'];
    $sr = $rows['Strike_rate'];
    ?>
    <tr>
        <td><?php echo $name ?></td>
        <td><?php echo $runs ?></td>
        <td><?php echo $four ?></td>
        <td><?php echo $six ?></td>
        <td><?php echo $sr ?></td>
      </tr>
    <?php
  }
  ?>
  </table>
  <?php
  echo "<br>"."<br>"."<br>"."<br>"."<br>";
  ?> 
  
  <center><h1><?php echo $team2 ?> Scorecard</h1></center>
  <table> 
    <tr>
      <th>Player Name</th>
      <th>Runs</th>
      <th>Boundaries</th>
      <th>Sixes</th>
      <th>Strike Rate</th>
    </tr>
    <?php
  while ($rows = mysqli_fetch_assoc($bat2_run)) {
    $name = $rows['P_name'];
    $runs = $rows['Runs'];
    $four = $rows['Boundaries'];
    $six = $rows['Sixes'];
    $sr = $rows['Strike_rate'];

    ?>
    <tr>
        <td><?php echo $name ?></td>
        <td><?php echo $runs ?></td>
        <td><?php echo $four ?></td>
        <td><?php echo $six ?></td>
        <td><?php echo $sr ?></td>
      </tr>
    <?php
  }
  ?>
     </table>
</body>

</html>