import Dropzone from "dropzone";

Dropzone.autoDiscover = false;
const myDropzone = new Dropzone("#dropzone", {
    url: "/cats/photo-upload",
    paramName: "photo",
    maxFiles: 1,
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    dictDefaultMessage: "Drag cat photo here or click to upload",
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="_token"]').content,
    },

    init: function () {
        const photoUrl = document.querySelector('input[name="photo"]').value.trim();

        if (photoUrl) {
            const photo = {
                size: 1000,
                name: photoUrl,
            };

            this.options.addedfile.call(this, photo);
            this.options.thumbnail.call(this, photo, photoUrl);

            photo.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

myDropzone.on("success", function (file, response) {
    let input = document.querySelector('input[name="photo"]');
    input.value = response.photo_url;
    console.log(response);
});
