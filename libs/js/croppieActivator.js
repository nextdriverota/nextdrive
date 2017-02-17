/**
 * Created by Prasanna on 2/9/2017.
 */
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 250,
        height: 250,
        type: 'square'
    },
    boundary: {
        width: 300,
        height: 300
    }
});

$('#upload').on('change', function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function(){
            console.log('jQuery bind complete');
        });

    }
    reader.readAsDataURL(this.files[0]);
});

