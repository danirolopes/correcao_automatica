$(document).ready(function () {
    buildImageCropper();
    buildFormSubmit();

    $('.cancel').on('click', function(e){
        e.preventDefault();
        window.location.href = "home";
    });

    
    $('#profile-picture-change-form').each(function(){
        $(this).data('serialized', $(this).serialize());
    }).on('change input', function(){
        $(this).find('button[name=submit]').prop('disabled', $(this).serialize() === $(this).data('serialized'));
    }).find('input[name=submit], button[name=submit]').prop('disabled', true);

});

function buildFormSubmit(){
}

function buildImageCropper(){
    var $image = $(".image-crop > img");
    $($image).cropper({
        preview: ".img-preview",
        zoomable: false,
        done: function(data) {
            $('input[name=xCanvas]').val(data['x']);
            $('input[name=yCanvas]').val(data['y']);
            $('input[name=widthCanvas]').val(data['width']);
            $('input[name=heightCanvas]').val(data['height']);

        }
    });

    var $inputImage = $("#inputImage");
    if (window.FileReader) {
        $inputImage.change(function() {
            var fileReader = new FileReader(),
                    files = this.files,
                    file;

            if (!files.length) {
                return;
            }

            file = files[0];

            if (/^image\/\w+$/.test(file.type)) {
                fileReader.onload = function () {
                    $image.cropper("reset", true).cropper("replace", this.result);
                };
                fileReader.readAsDataURL(file);
            } else {
                showMessage("Por favor, escolha um arquivo de imagem.");
            }
        });
    } else {
        $inputImage.addClass("hide");
    }
}