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

document.addEventListener('DOMContentLoaded', function () {
  const imageSelectors = document.querySelectorAll('.global-selector');

  imageSelectors.forEach((selector) => {
      selector.addEventListener('mouseenter', function () {
          const box = this.closest('.box');
          const characterImage = box.querySelector('.character-image');
          const imageOptions = box.querySelector('.image-options');

          if (characterImage) {
              const imageIndex = characterImage.getAttribute('data-character-index');
              const isVisible = imageOptions.classList.contains('show');

              if (imageIndex !== null && !isVisible) {
                  imageOptions.classList.add('show');
              }
          }
      });

      selector.addEventListener('mouseleave', function () {
          const box = this.closest('.box');
          const imageOptions = box.querySelector('.image-options');
          imageOptions.classList.remove('show');
      });
  });
});

// Ajoutez ce bloc de code pour masquer le menu déroulant lorsqu'on quitte la boîte
const boxes = document.querySelectorAll('.box');

boxes.forEach((box) => {
  box.addEventListener('mouseleave', function () {
      const imageOptions = this.querySelector('.image-options');
      if (imageOptions) {
          imageOptions.classList.remove('show');
      }
  });
});

