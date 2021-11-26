<?php
   require("conn.php");
   $fname="";
   $lname="";
   $email="";
   $fees="";
   $phone="";
   $filename="";
   $spec="";
   $pass="";
   $address="";
   $qual="";
   $formsubmit="add";
   $err = "";
   
   if(isset($_POST["formsubmit"])||isset($_POST["fname"])){
      $fname = secure($_POST["fname"]);
      $lname = secure($_POST["lname"]);
      $email = secure($_POST["email"]);
      $fees = secure($_POST["fees"]);
      $phone = secure($_POST["phone"]);
      $spec = secure($_POST["spec"]);
      $qual = secure($_POST["qual"]);
      $address = secure($_POST["address"]);
      $pass = secure($_POST["pass"]);
      $bool = true;
      foreach($_POST as $key=>$val){
     
         if($val==""){
            $bool = false;
            echo "Empty value Detected!";
            return;
         }
      }
      if($bool){
         $fees = (float) $fees;
         $phone = (int) $phone;
   
         $target_dir = "uploads/";
         $target_file = $target_dir . basename(getRandomHex(10).$_FILES["filename"]["name"].'.jpg');
         $uploadOk = 1;
         $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
         // Check if file already exists
         if (file_exists($target_file)) {
         echo "Sorry, file already exists.";
         $uploadOk = 0;
         return;
         }
   
         // Check file size
         if ($_FILES["filename"]["size"] > 500000) {
         echo "Sorry, your file is too large.";
         $uploadOk = 0;
         return;
         }
   
         // Check if $uploadOk is set to 0 by an error
         if ($uploadOk == 0) {
         echo "Sorry, your file was not uploaded.";
         return;
         // if everything is ok, try to upload file
         } else {
         if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
            $docid = getRandomHex(30);
            $q = "INSERT INTO doctors VALUES ('','$docid','$fname','$lname','$address','$qual',$fees,$phone,'$email','$target_file','$spec',0)";
            $con->query($q);
            $q = "INSERT INTO users VALUES('','$fname','$lname','$email','$pass','$phone','','DOCTOR','$docid')";
            $con->query($q);
            echo "success";
            exit();
            //header("location: adminhome.php?docadded");
            //echo "The file ". htmlspecialchars( basename( $_FILES["filename"]["name"])). " has been uploaded.";
         } else {
            echo "Sorry, there was an error uploading your file.";
            return;
         }
         die("0");
         return;
         }
      }else{
         echo "Please fill all the details!";
         return;
      }
      return;
   }
   
   function getRandomHex($num_bytes=4) {
      return bin2hex(openssl_random_pseudo_bytes($num_bytes));
    }
    function secure($str){
      global $con;
      $str = mysqli_real_escape_string($con,$str);
      return $str;
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Add Doctor HOSPITAL MANAGEMENT SYSTEM</title>
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
               <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="dashboard.php">DASHBOARD</a></li>
               <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="logout.php">LOGOUT</a></li>
            </ul>
         </div>
      </nav>
      <br>
<button type="button" class="d-none btn btn-primary" data-toggle="modal" id="btnmodal" data-target="#exampleModal">
    launch
  </button>
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crop image</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body">
           
  <link rel="stylesheet" href="dist/cropper.css">
  <style>
    #imgcon {
      margin: 20px auto;
      max-width: 640px;
    }

    #image {
      max-width: 100%;
    }
  </style>
  <div class="container" id="imgcon">
    <div>
      <img id="image" alt="Picture">
    </div>
  </div>
  <script src="dist/cropper.js"></script>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-success" id="btncrop" data-dismiss="modal">Crop</button>
        </div>
      </div>
    </div>
  </div>
      <main class="container p-2 pt-4 mt-4">
         <div class="h3 text-primary">Add Doctor:</div>
         <form method="post" enctype="multipart/form-data">
            <link  href="./dist/cropper.css" rel="stylesheet">
            <script src="./dist/cropper.js"></script>
            <div class="p-4">
               <div class="form-row">
                  <div class="col-md-4 mb-3">
                     <label for="validationDefault01">First name</label>
                     <input type="text" value="<?= $fname ?>" name="fname" class="form-control" id="validationDefault01" placeholder="First name" required="">
                  </div>
                  <div class="col-md-4 mb-3">
                     <label for="validationDefault02">Last name</label>
                     <input type="text" value="<?= $lname ?>" name="lname" class="form-control" id="validationDefault02" placeholder="Last name" required="">
                  </div>
                  
               </div>
               <div class="form-row">
               <div class="col-md-4 mb-3">
                  <label for="validationDefaultUsername">Email Address</label>
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend2">Email</span>
                     </div>
                     <input type="text" value="<?= $email ?>" name="email" class="form-control" id="validationDefaultUsername" placeholder="email@example.com" aria-describedby="inputGroupPrepend2" required="">
                  </div>
               </div>
               <div class="col-md-4 mb-3">
                <label for="validationDefaultn">Password to login: </label>
                <input type="text" name="pass" class="form-control" id="validationDefaultn" placeholder="Password" value="<?= '' ?>" required="">
             </div>
               </div>
               <div class="form-row">
                  <div class="col-md-4 mb-3">
                     <label for="validationDefault01">Fees</label>
                     <input type="text" name="fees" class="form-control" id="validationDefault01" placeholder="eg. $100" value="<?= $fees ?>" required="">
                  </div>
                  <div class="col-md-4 mb-3">
                     <label for="validationDefault02">Contact No.</label>
                     <input type="text" name="phone" class="form-control" id="validationDefault02" placeholder="0123456789" value="<?= $phone ?>" required="">
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-4 mb-3">
                     <label>Upload image</label>
                     <div class="custom-file">
                        <input type="file" name="filename" accept="image/*" class="custom-file-input" id="inputGroupFile04" required>
                        <label class="custom-file-label" for="inputGroupFile04">Choose Image</label>
                     </div>
                  </div>
                  <div class="col-md-4 mb-3"><img src="" width="w-100" id="imgdoc"></div>
               </div>
               <div class="form-row">
                  <div class="col-md-4 mb-3">
                     <label for="validationDefault01">Qualification </label>
                     <input type="text" name="qual" class="form-control" id="validationDefault01" placeholder="MD" value="<?= $qual ?>" required="">
                  </div>
                  <div class="col-md-4 mb-3">
                     <label for="validationDefault01">Doctor Specialization </label>
                     <input type="text" name="spec" class="form-control" id="validationDefault01" placeholder="Eye" value="<?= $spec ?>" required="">
                  </div>
               </div>
                 
               
               <div class="form-row">
                  <div class="col-md-8 mb-3">
                     <label for="validationDefault01">Full Address: </label>
                     <textarea name="address" class="form-control" id="validationDefault01" required=""><?= $address ?></textarea>
                  </div>
               </div>
               <div id="errdata"></div>
               <?= $err != '' ? '<div class="p-1 m-2 rounded w-50 bg-danger text-white mx-auto background-p">'.$err.'</div>':''?>
                <input class="btn btn-primary p-3 mx-auto" name="formsubmit" value="Add Doctor" type="submit">
            </div>
         </form>
      </main>
      <footer class="container">
         <p class="float-right"><a href="#">Back to top</a></p>
         <p>© 2017-2018 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
      </footer>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      
      <script>
        let imgInp = document.querySelector("#inputGroupFile04");
        let cbox = document.querySelector("#cropperbox");
        let boxbtn = document.querySelector("#btnmodal");
        imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
        let url = URL.createObjectURL(file);
        //localStorage.setItem("hms_doc_img_temp",url);
        cp(url);
        boxbtn.click();
        //cbox.setAttribute("data","imgcrop.php");

        //document.querySelector("#imgdoc").src = URL.createObjectURL(file)
        }
        }
        document.querySelector("#btncrop").addEventListener("click",cropimg);
        var c = 0;
        function cp(url) {
      var image = document.querySelector('#image');
      image.src = url;
      var cropper = new Cropper(image, {
        dragMode: 'move',
        aspectRatio: 1,
        autoCropArea: 1,
        restore: false,
        guides: false,
        center: false,
        highlight: false,
        cropBoxMovable: false,
        cropBoxResizable: false,
        toggleDragModeOnDblclick: false,
      });
      c = cropper;
    }
    var imgblob = 0;
        function cropimg(){
            var imgurl =  c.getCroppedCanvas().toDataURL();
            var img = document.querySelector("#imgdoc");
            img.src = imgurl;
            
            c.getCroppedCanvas().toBlob(function (blob) {
                      imgblob = blob;
                      // Use `jQuery.ajax` method
                      
                });
        }
        $("form").submit(function(e){
           e.preventDefault();
            let fd = new FormData($(this)[0]);
            fd.delete("filename");
            fd.append("filename",(imgblob));
            $.ajax({
                        url: "adddoctor.php",
                        type: "POST",
                        data: fd,
                        processData: false,
                        contentType: false,
                        success: function (d) {
                           if(d=="success"){
                              $("form").find("input").val("");
                              window.location.href="adminhome.php?docadded";
                           }else{
                              $("#errdata").php("<div class='alert alert-danger'>"+d+"</div>")
                           }
                        },
                        error: function () {
                          console.log('Upload error');
                        }
                      });
            
        });
        function blobToFile(theBlob, fileName){
    theBlob.lastModifiedDate = new Date();
    theBlob.name = fileName;
    return theBlob;
}
     </script>
        <style>
            img {
        display: block;
      
        /* This rule is very important, please don't ignore this */
        max-width: 100%;
      }
         </style>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
   </body>
</html>