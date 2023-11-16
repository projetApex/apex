const box = document.querySelectorAll('.box');

box.forEach((box) => {
    box.addEventListener('click', () => {
        document.location.href = 'character.php?id=' + box.id + '';
    });
});

document.addEventListener("DOMContentLoaded", function () {
  const imageRadios = document.querySelectorAll("input[type=radio]");

  imageRadios.forEach((radio) => {
    radio.addEventListener("change", function () {
      const selectedImage = this.value;
      const imageIndex = this.name.split("_")[1];
      const characterImage = document.querySelector(
        '.character-image[data-character-index="' + imageIndex + '"]'
      );

      characterImage.src =
        "chemin_vers_" +
        selectedImage.toLowerCase().replace(/\s/g, "_") +
        ".jpg";
    });
  });
});
