let cropper;
const image = document.getElementById('preview');
const uploadInput = document.getElementById('upload');
const resultCanvas = document.getElementById('result');

uploadInput.addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) {
        alert("Error: No file selected. Please upload an image.");
        return;
    }

    if (!file.type.startsWith("image/")) {
        alert("Error: Invalid file type. Please upload an image file.");
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        image.src = e.target.result;
        image.style.display = 'block';
        if (cropper) cropper.destroy();
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
        });
        alert("Success: Image uploaded successfully. You can now crop it.");
    };
    reader.readAsDataURL(file);
});

function cropImage() {
    if (!cropper) {
        alert("Error: No image to crop. Please upload an image first.");
        return;
    }

    const canvas = cropper.getCroppedCanvas({
        width: 200,
        height: 200,
    });

    if (!canvas) {
        alert("Error: Unable to crop the image. Please try again.");
        return;
    }

    resultCanvas.style.display = 'block';
    const context = resultCanvas.getContext('2d');
    context.clearRect(0, 0, resultCanvas.width, resultCanvas.height);
    resultCanvas.width = canvas.width;
    resultCanvas.height = canvas.height;
    context.drawImage(canvas, 0, 0);

    alert("Success: Avatar cropped and ready to upload (simulation).");
}