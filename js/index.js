const box = document.querySelectorAll('.box');

box.forEach((box) => {
    box.addEventListener('click', () => {
        document.location.href = 'character.php?id=' + box.id + '';
    });
});

