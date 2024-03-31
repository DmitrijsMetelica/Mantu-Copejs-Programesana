document.getElementById('status').addEventListener('change', function() {
  var options = this.options;
  for (var i = 0; i < options.length; i++) {
      var option = options[i];
      if (option.classList.contains('izvelne_nozopets')) {
          option.style.color = option.selected ? '#73FE44' : ''; /* Ja izvēlēts '-Nocopēts', teksts kļūst zaļš */
      } else if (option.classList.contains('izvelne_pazaudets')) {
          option.style.color = option.selected ? '#C30000' : ''; /* Ja izvēlēts '-Pazaudēts', teksts kļūst sarkans */
      }
  }
});


document.getElementById('fileInput').addEventListener('change', function() {
  var file = this.files[0];
  var imageType = /image.*/;

  if (file.type.match(imageType)) {
      var reader = new FileReader();

      reader.onload = function() {
          var img = new Image();
          img.src = reader.result;

          img.onload = function() {
              var maxWidth = 300;
              var maxHeight = 300;
              var width = img.width;
              var height = img.height;

              if (width > height) {
                  if (width > maxWidth) {
                      height *= maxWidth / width;
                      width = maxWidth;
                  }
              } else {
                  if (height > maxHeight) {
                      width *= maxHeight / height;
                      height = maxHeight;
                  }
              }

              var canvas = document.createElement('canvas');
              canvas.width = width;
              canvas.height = height;
              var ctx = canvas.getContext('2d');
              ctx.drawImage(img, 0, 0, width, height);

              var uploadedImage = document.getElementById('uploadedImage');
              uploadedImage.src = canvas.toDataURL('image/jpeg');
              uploadedImage.style.display = 'block';
          };
      };

      reader.readAsDataURL(file);
  }
});
