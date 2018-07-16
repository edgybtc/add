<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['username']!=session_id()){
      echo 'Restricted Acess';
die();
	  }


$db_host = 'localhost'; // Server Name
$db_user = 'root'; // Username
$db_pass = "7.}B-ysJXMnnB@'C"; // Password
$db_name = 'bitlendobot'; // Database Name

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

$sql = 'SELECT * 
		FROM plan';
		
$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


    <title>Bitlendobot</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard.php">Bitlendobot</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
      <a class="nav-link" href="index.php">
		  Log Out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                  <span data-feather="home"></span>
                  Dashboard 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="deposit.php">
                  <span data-feather="file"></span>
                  Deposits<span class="sr-only">(current)</span>

                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="withdrawals.php">
                  <span data-feather="file"></span>
                  Withdrawals
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="active.php">
                  <span data-feather="file"></span>
                  Active Plans
                </a>
              </li>
 <li class="nav-item">
                <a class="nav-link" href="balance.php">
                  <span data-feather="file"></span>
                  User Balance Sheet
                </a>
              </li>
<li class="nav-item">
                <a class="nav-link" href="plan.php">
                  <span data-feather="file"></span>
                  Change Plan
                </a>
              </li>

  <li class="nav-item">
                <a class="nav-link" href="referral.php">
                  <span data-feather="file"></span>
                  Referral Details
                </a>
              </li>
  <li class="nav-item">
                <a class="nav-link" href="wsetting.php">
                  <span data-feather="file"></span>
                  Change withdrawal setting
                </a>
              </li>
  <li class="nav-item">
                <a class="nav-link" href="sendall.php">
                  <span data-feather="file"></span>
                  Broadcast Message
                </a>
              </li>
<li class="nav-item">
                <a class="nav-link" href="senduser.php">
                  <span data-feather="file"></span>
                  Direct Message
                </a>
              </li>
<li class="nav-item">
                <a class="nav-link" href="banwith.php">
                  <span data-feather="file"></span>
                  Ban User Withdrawal
                </a>
              </li>
           
            </ul>

           
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
          
          </div>

         

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

          <h2>Active Plans</h2>
          <div class="table-responsive">
            <table id="example" class="display">

              <thead>
                <tr>
                  <th>#</th>
                  <th>Chat ID</th>
                  <th>Amount</th>
                  <th>Currency</th>
                <th>Rate</th>
                 <th>Days Left</th>
                </tr>
              </thead>
              <tbody>
              <?php
		$no 	= 1;

		while ($row = mysqli_fetch_array($query))
		{
			if($row['active']=='y'){
				$k=floatval($row['amount']);
				$k=$k/100000000;
$ndays=intval($row['days']);
//$nrate=intval($row['rate']);
$time=$row['time'];
$date1 = date('Y-m-d H:i:s');
        $date2=new DATETIME($time);
        $date11=new DATETIME($date1);
        $interval = date_diff($date11,$date2);
        $days_passed=intval($interval->format('%a'));
 $days=$ndays-$days_passed;

			echo '<tr>
					<td>'.$no.'</td>
					<td>'.$row['chat_id'].'</td>
					<td>'.$k.'</td>
					<td>'. $row['currency'] . '</td>
					<td>'.$row['rate'] .'</td>
                                          <td>'.$days.'</td>
 
				</tr>';
			
			$no++;}
		}?>  
              
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
//<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
//<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
/*    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            data: [1,0,0,0,0,0,0],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script> */
  </body>
</html>
