
  <link rel="stylesheet" href="dist/cropper.css">
  <style>
    .container {
      margin: 20px auto;
      max-width: 640px;
    }

    img {
      max-width: 100%;
    }
  </style>
  <div class="container">
    <div>
      <img id="image" alt="Picture">
    </div>
  </div>
  <script src="dist/cropper.js"></script>
  <script>
    window.addEventListener('DOMContentLoaded', function () {
      var image = document.querySelector('#image');
      image.src = localStorage.getItem("hms_doc_img_temp");
      var minAspectRatio = 1;
      var maxAspectRatio = 1;
      var cropper = new Cropper(image, {
        ready: function () {
          var cropper = this.cropper;
          var containerData = cropper.getContainerData();
          var cropBoxData = cropper.getCropBoxData();
          var aspectRatio = cropBoxData.width / cropBoxData.height;
          var newCropBoxWidth;

          if (aspectRatio < minAspectRatio || aspectRatio > maxAspectRatio) {
            newCropBoxWidth = cropBoxData.height * ((minAspectRatio + maxAspectRatio) / 2);

            cropper.setCropBoxData({
              left: (containerData.width - newCropBoxWidth) / 2,
              width: newCropBoxWidth
            });
          }
        },

        cropmove: function () {
          var cropper = this.cropper;
          var cropBoxData = cropper.getCropBoxData();
          var aspectRatio = cropBoxData.width / cropBoxData.height;

          if (aspectRatio < minAspectRatio) {
            cropper.setCropBoxData({
              width: cropBoxData.height * minAspectRatio
            });
          } else if (aspectRatio > maxAspectRatio) {
            cropper.setCropBoxData({
              width: cropBoxData.height * maxAspectRatio
            });
          }
        },
      });
    });
  </script>
