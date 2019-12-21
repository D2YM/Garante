jQuery(document).ready(function() {
    jQuery("#upload-img-garantia").click(function() {
        //var imagePiece = document.getElementById("inputFileImgPiece");
        //imagePiece = imagePiece.files[0];
        var featureType = document.getElementById('exampleFormControlSelect1').value;
        var imagePiece = $('#inputFileImggarantia')[0].files[0];
        var fd = new FormData();
        
        fd.append('imagePiece',imagePiece);
        fd.append('featureType',featureType);
        jQuery.ajax({
            type: "POST",
            url: mp_ajax_upload_image_garante,
            data: fd,
            contentType: false,
            processData: false,
            cache: false,

            success: function(entry) {
                if(entry){
                    var key; 
                    var acum='';
                    for(key in entry){
                        acum += '<div class="col box-image-garante-gallery"><img class="img-gg" src="'+entry[key]+'"></div>';
                        console.log(entry[key]);
                    }
                    jQuery('#img-gallery').html(acum);
                    jQuery('#img-gallery').load();
                    ty = document.querySelectorAll('#img-gallery .img-gg');
                    for(var i = 0; i<ty.length; i++){
                    	var src = ty.item(i).src;
                    	var pos = src.indexOf('?');
                           if (pos >= 0) {
                              src = src.substr(0, pos);
                           }
                           var date = new Date();
                           ty.item(i).src = src + '?v=' + date.getTime();
                    	console.log(ty.item(i).src);
                    }
                    alert('Imagen actualizada correctamente!');
                }
                else{
                    preview.style.display = 'none';
                }
            }
        });
        
    });
    jQuery.ajax({
        type: "POST",
        url: mp_ajax_upload_image_garante,
        data: { init: 'go'},
        cache: false,
        success: function(entry) {
            var preview = document.querySelector('#img-gallery');
            if(entry){
                var key; 
                var acum='';
                for(key in entry){
                    acum += '<div class="col box-image-garante-gallery"><img class="img-gg" src="'+entry[key]+'"></div>';
                    console.log(entry[key]);
                }
                jQuery('#img-gallery').html(acum);
            }
            else{
                preview.style.display = 'none';
            }
            console.log(entry);
        }
    });
});

function previewFile() {
      var preview = document.querySelector('#image-garantia-main');
      var file    = document.querySelector('#inputFileImggarantia').files[0];
      var reader  = new FileReader();
    
      reader.onloadend = function () {
        preview.src = reader.result;
      }
    
      if (file) {
        preview.style.display = 'block';
        reader.readAsDataURL(file);
      } else {
        preview.src = "";
      }
}