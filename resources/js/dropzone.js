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
                accepted: true,
            };

            this.emit("addedfile", photo);
            this.emit("thumbnail", photo, photoUrl);
            this.emit("complete", photo);
            this.files.push(photo);

            photo.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

myDropzone.on("addedfile", function (file) {
    for (var i = myDropzone.files.length - myDropzone.maxFiles - 1; i >= 0; i--) {
        var f = myDropzone.files[i];
        if (f.upload.uuid !== file.upload.uuid) myDropzone.removeFile(f);
    }
});

myDropzone.on("success", function (file, response) {
    let input = document.querySelector('input[name="photo"]');
    input.value = response.photo_url;
    console.log(response);
});

myDropzone.on("removedfile", function () {
    let input = document.querySelector('input[name="photo"]');
    input.value = "";
});

myDropzone.on("maxfilesexceeded", function (file) {
    this.removeAllFiles();
    this.addFile(file);
});
