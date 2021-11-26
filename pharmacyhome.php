<?php
require("methods.php");
$login = false;
if(islogin()){
   global $login;
   $login = true;
   if(isset($_SESSION["hms_pharmacy"]) && $_SESSION["hms_pharmacy"]){}else{
    header("location: ./pharmacylogin.php");
   }
   if(!$_SESSION["hms_admin"]){
       header("location: ./");
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Admin HOSPITAL MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="pt-4">
    <nav class="navbar navbar-expand-lg p-3 fixed-top navbar-light bg-white shadow-sm" >
        <a class="navbar-brand h5" href="#">HOSPITAL MANAGEMENT SYSTEM</b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav ml-auto mr-0 mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="home.php">HOME</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="about.php">ABOUT</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="alldoctors.php">ALL_DOCTORS</a></li>
            <?php
               if($login):
               ?>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="dashboard.php">DASHBOARD</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="logout.php">LOGOUT</a></li>
            <?php else: ?>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="register.php">REGISTER</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="login.php">LOGIN</a></li>
            <?php endif ?>
          </ul>
          
        </div>
      </nav>
      <br>
    <main class="container p-2 pt-4 mt-4">
        <div class="h3 text-primary m-4">Add Medicine:</div>
        <table class="table table-bordered">
            <thead>
              <tr>
                <th>Medicine Name</th>
                <th>Description</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Save</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" value=""></td>
                    <td><input type="text" value=""></td>
                    <td><input type="number" value=""></td>
                    <td><input type="number" value=""></td>
                    <td>
                        <button class="btn btn-outline-success" id="savebtn">Add</button>
                    </td>
                  </tr>
            </tbody>
          </table>
          <div class="h3 text-primary m-4">Update Medicine Data:</div>
        <input class="form-control my-2" id="myInput" type="text" placeholder="Search Medicines..">
  <br>
 
  <table class="table table-bordered table-striped" id="updatetable">
    <thead>
      <tr>
        <th>Medicine Name</th>
        <th>Description</th>
        <th>Unit</th>
        <th>Price</th>
        <th>Medicine ID</th>
        <th>Edit/Delete</th>
      </tr>
    </thead>
    <tbody>
        <?php
        require("conn.php");
        $q = "SELECT*FROM pharmacy ORDER BY name ASC LIMIT 30";
        $q = $con->query($q);
        if(0==mysqli_num_rows($q)){
          echo "Nothing found Here!";
        }
        while($row=mysqli_fetch_array($q)){
                echo "<tr>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["description"]."</td>";
                echo "<td>".$row["unit"]."</td>";
                echo "<td>".$row["price"]."</td>";
                echo "<td data-id='".$row["medicineid"]."'>".substr($row["medicineid"],0,20)."...</td>";
                echo "<td>";
                    echo '<button class="btn btn-outline-primary">Edit</button>';
                    echo '<button class="btn btn-outline-danger">Delete</button>';
                    echo '<button class="btn btn-outline-success d-none">Save</button>';
                echo "</td>";
                echo "</tr>";
            }
            ?>
    </tbody>
  </table>
  
        <div class="row py-3 my-4">
        <a href="myaccount.php" class="btn btn-primary p-3 m-2 col-md-4">Change Password</a>
        </div>
    </main>
    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>© 2017-2018 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
      </footer>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script>
          $("#updatetable tbody tr td button").click(function(){
              
            if($(this).text()=="Edit"){
                $(this).parent().find("button").toggleClass("d-none");

                $(this).parent().parent().find("td:lt(4)").each(function(td){
                    $(this).html("<input type='text' value='"+$(this).text()+"'>");
                })
                }
            if($(this).text()=="Save"){
                let id = $(this).parent().parent().find("td:nth-child(5)").attr("data-id");
                let data = [];
                let $this = $(this);
                $(this).parent().parent().find("td:lt(4)").each(function(td){
                    let val = $(this).find("input").val();
                    data.push(val);
                });
                data = {"data":data.toString(),"medicineid":id};

                $.ajax({
                    type:'post',
                    url:'medicines.php',
                    data: {"data":JSON.stringify(data)},
                    success:function(d){
                        if(d=="true"){
                            alert("Medicine Updated Successfully!")
                            $this.parent().parent().find("td:lt(4)").each(function(td){
                                    let val = $(this).find("input").val();
                                    $(this).html(val);
                                });
                            $this.parent().find("button").toggleClass("d-none");
                        }
                    },
                    error:function(){
                        alert("Something went wrong, Please try again Later!")
                    }
                })
                
                }
            if($(this).text()=="Delete"){

                }
          });
          $("#savebtn").click(function(){
                  let data = [];
                  let $this = $(this);
                  let stopflag = false;
                  $(this).parent().parent().find("input[type='text']").each(function(){
                      if($(this).val().length<5){
                          stopflag = true;
                      }
                  })
                  $(this).parent().parent().find("input[type='number']").each(function(){
                      if($(this).val()=="" || $(this).val()=="0"){
                          stopflag = true;
                      }
                  })
                  if(stopflag){
                      alert("Please Fill Values");
                      return;
                  }
                  $(this).parent().parent().find("td:lt(4)").each(function(td){
                      let val = $(this).find("input").val();
                      data.push(val);
                  });
                  data = {"data":data.toString()};
                  $.ajax({
                      type:'post',
                      url:'medicines.php',
                      data: {"data":JSON.stringify(data),"insertdata":true},
                      success:function(d){
                        alert(d)
                          if(d=="true"){
                            
                              alert("Medicine Added");
                              $this.parent().parent().find("td:lt(4)").each(function(td){
                                    $(this).find("input").val("");
                                  });
                              
                          }
                      },
                      error:function(){
                          alert("Something went wrong, Please try again Later!")
                      }
                  })
                  
            })
      </script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
</body>
</html>