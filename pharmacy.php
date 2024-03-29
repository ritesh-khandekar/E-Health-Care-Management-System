<?php
require("methods.php");

$login = false;
if (islogin()) {
  global $login;
  $login = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pharmacy HOSPITAL MANAGEMENT SYSTEM</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/theme.css">
</head>

<body class="pt-4">
  
  <nav class="navbar navbar-expand-lg p-2 px-4 fixed-top navbar-light bg-white shadow-sm">
    <a class="navbar-brand" href="#"><img src="./images/logo.png" height="50px" alt="Logo of Hospital Management System"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav ml-auto mr-0 mt-2 mt-lg-0">
        <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="alldoctors.php">All Doctors</a></li>
        <li class="nav-item"><a class="nav-link m-1 active btn bg-secondary text-white mr-5" style="color: #000;text-decoration:none" href="pharmacy.php">Pharmacy</a></li>
        <?php
        if ($login) :
        ?>
          <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="dashboard.php">DASHBOARD</a></li>
          <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="logout.php">LOGOUT</a></li>
        <?php else : ?>
          <li class="nav-item"><a class="nav-link m-1 btn text-white btn-login shadow-sm" style="color: #000;text-decoration:none" href="register.php">REGISTER</a></li>
          <li class="nav-item"><a class="nav-link m-1 btn text-white btn-register shadow-sm" style="color: #000;text-decoration:none" href="login.php">LOGIN</a></li>
        <?php endif ?>
      </ul>

    </div>
  </nav>
  <br>
  <main class="container p-3 pt-4 mt-5 shadow rounded ">
    <div class="d-none">
      <div class="h3 text-primary m-4">Selected Medicines:</div>
      <table class="table table-bordered table-striped" id="updatetable">
        <thead>
          <tr>
            <th>Medicine Name</th>
            <th>Description</th>
            <th>Remaining</th>
            <th>Price</th>
            <th>Medicine ID</th>
            <th>Quantity</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
    <div class="h3 text-white m-4">Available Medicines:</div>
    <input class="form-control my-2" id="myInput" type="text" placeholder="Search Medicines..">
    <br>

    <table class="table bg-white rounded shadow table-striped" id="updatetable">
      <thead>
        <tr class="shadow-sm">
          <th>Medicine Name</th>
          <th>Description</th>
          <th>Remaining</th>
          <th>Price</th>
          <th>Medicine ID</th>
          <th>Quantity</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require("conn.php");
        $q = "SELECT*FROM pharmacy ORDER BY name ASC LIMIT 30";
        $q = $con->query($q);
        if (0 == mysqli_num_rows($q)) {
          echo "Nothing found Here!";
        }
        while ($row = mysqli_fetch_array($q)) {
          echo "<tr class='shadow-sm'>";
          echo "<td>" . $row["name"] . "</td>";
          echo "<td>" . $row["description"] . "</td>";
          echo "<td>" . $row["unit"] . "</td>";
          echo "<td>" . $row["price"] . "</td>";
          echo "<td data-id='" . $row["medicineid"] . "'>" . substr($row["medicineid"], 0, 20) . "...</td>";
          echo "<td>";
          echo '<button class="btn btn-outline-success" data-action="add"><b>+</b></button>';
          echo '<input type="number" class="m-1" style="width: 80px;" value="0">';
          echo '<button class="btn btn-outline-danger" data-action="remove"><b>-</b></button>';
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
    <div class="w-100">
      <button class="btn btn-lg shadow btn-primary" id="addtocartbtn">Add to cart</button>
      <button class="btn btn-warning btn-lg shadow mx-3" id="clearbtn">Clear</button>
      <button class="btn btn-success btn-lg shadow float-right" id="gotocart">Go to Cart</button>
    </div>
  </main>
  <footer class="container text-white my-4 pt-4 bg-blur p-3 rounded shadow">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>© 2017-2018 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $("table tbody tr td input").keyup(function() {
      $("#addtocartbtn").removeClass("btn-outline-success");
      $("#addtocartbtn").addClass("btn-primary");
      $("#addtocartbtn").text("Add to cart");
      if ($(this).val() == "") {
        let $t = $(this)
        setTimeout(function() {
          if ($t.val() == "")
            $t.val("0")
        }, 1000);
      } else {
        if (parseInt($(this).val()) < 0)
          $(this).val("0");
      }
    });
    $("table tbody tr td button").click(function() {
      if ($(this).attr("data-action") == "add") {
        let $ip = $(this).parent().find("input");
        $ip.val(parseInt($ip.val()) + 1);
      } else if ($(this).attr("data-action") == "remove") {
        let $ip = $(this).parent().find("input");
        $ip.val(parseInt($ip.val()) - 1);
        if (($ip.val() == "") || parseInt($ip.val()) < 0) {
          $ip.val("0");
        }
      }
    });
    let flag = false;
    $("#gotocart").click(function() {
      if (flag) {
        window.location.href = 'cart.php';
      } else {
        alert("add items to cart");
      }
    })
    $("#addtocartbtn").click(function() {
      let medicines = [];
      flag = false;
      $btn = $(this);
      $("table tbody tr td input").each(function() {
        if (parseInt($(this).val()) > 0) {
          let medjson = {
            dataid: $(this).parent().prev().attr("data-id"),
            quantity: parseInt($(this).val())
          };
          medicines.push(medjson);
        }
      });
      if (medicines.length == 0) {
        alert("select medicines");
        return;
      }
      $.ajax({
        type: "POST",
        url: "addtocart.php",
        data: {
          "medjson": medicines
        },
        success: function(d) {
          if (d == "!login") {
            window.location.href = "login.php";
          } else if (d == "true") {
            $btn.addClass("btn-outline-success");
            $btn.removeClass("btn-primary");
            $btn.text("Added to cart");
            flag = true;
          }
        }
      })
    })
    $("#clearbtn").click(function() {
      $("table tbody tr td input").val("0");
    })
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>