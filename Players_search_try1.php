<?php

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'ipl');

$player = $_POST['P_name'];
$match = $_POST['M_Id'];
$sql2 = "SELECT Players.P_Id,Players.P_name,Team.Team_Name,Players.Age,Players.P_Role,Players.Country,
            Individual_stats.M_Id, Individual_stats.Runs, Individual_stats.Strike_rate, Individual_stats.Boundaries,
            Individual_stats.Sixes, Individual_stats.Wickets, Individual_stats.Catches, Individual_stats.Runouts, Individual_stats.Economy 
            from
            ((Players INNER JOIN Team ON Players.Team_Id = Team.Team_Id)
            INNER JOIN  Individual_stats ON Players.P_Id = Individual_stats.P_Id) where P_name= '$player' and M_Id = '$match' ";

$sql2_run = mysqli_query($connection, $sql2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?php echo $player ?></title>
  <style>
    .column {
      float: left;
      width: 50%;
      padding: 10px;
      height: 300px;
      /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    * {
      box-sizing: border-box;
    }

    ul {
      font-size: 20px;
    }
    table{
      border-collapse: collapse;
    }
    th,
    td {
      padding: 15px 10px;
      border: solid skyblue 2px;
      font-size: 30px;
    }

    strong {
      font-size: 40px;
    }
  </style>
</head>

<body>
  <?php
  while ($rows = mysqli_fetch_assoc($sql2_run)) {
    $id = $rows['P_Id'];
    $p_name = $rows['P_name'];
    $t_name = $rows['Team_Name'];
    $age = $rows['Age'];
    $role = $rows['P_Role'];
    $country = $rows['Country'];
    $runs = $rows['Runs'];
    $s_r = $rows['Strike_rate'];
    $fours = $rows['Boundaries'];
    $sixes = $rows['Sixes'];
    $wickets = $rows['Wickets'];
    $catches = $rows['Catches'];
    $runouts = $rows['Runouts'];
    $economy = $rows['Economy'];
  }
  ?>
  <center><img src="<?php echo "images/" . $p_name ?>.png">
    <h1><?php echo $p_name ?></h1>
  </center>
  <div class="row">
    <div class="column">
      <strong style="margin-left: 200px;">Details</strong>
      <table>
        <tbody>
          <tr>
            <th>Player ID</th>
            <td><?php echo $id ?></td>
          </tr>
          <tr>
            <th>Name</th>
            <td><?php echo $p_name ?></td>
          </tr>
          <tr>
            <th>Team</th>
            <td><?php echo $t_name ?></td>
          </tr>
          <tr>
            <th>Age</th>
            <td><?php echo $age ?></td>
          </tr>
          <tr>
            <th>Role</th>
            <td><?php echo $role ?></td>
          </tr>
          <tr>
            <th>Country</th>
            <td><?php echo $country ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="column">
      <strong>Performance 🏏🏏</strong>
      <table>
        <!-- <thead>
          <th></th>
          <th><?php echo $match ?></th>
        </thead> -->
        <tbody>
          <tr>
            <th>Runs</th>
            <td><?php echo $runs ?></td>
          </tr>
          <tr>
            <th>S/R</th>
            <td><?php echo $s_r ?></td>
          </tr>
          <tr>
            <th>Boundaries</th>
            <td><?php echo $fours ?></td>
          </tr>
          <tr>
            <th>Sixes</th>
            <td><?php echo $sixes ?></td>
          </tr>
          <tr>
            <th>Wickets</th>
            <td><?php echo $wickets ?></td>
          </tr>
          <tr>
            <th>Catches</th>
            <td><?php echo $catches ?></td>
          </tr>
          <tr>
            <th>Runouts</th>
            <td><?php echo $runouts ?></td>
          </tr>
          <tr>
            <th>Economy</th>
            <td><?php echo $economy ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</body>

</html>