<script>
  // Zurück-nach-oben-Button einblenden, wenn nach unten gescrollt wird
$(window).scroll(function() {
  if ($(this).scrollTop() > 100) {
    $('#back-to-top').fadeIn();
  } else {
    $('#back-to-top').fadeOut();
  }
});

// Bei Klick auf den Zurück-nach-oben-Button zur obersten Seite scrollen
$('#back-to-top').click(function() {
  $('html, body').animate({scrollTop : 0},800);
  return false;
});


</script>

<script>
function copyToClipboard(text) {
  navigator.clipboard.writeText(text)
    .then(() => {
      console.log(`Copied "${text}" to clipboard`);
    })
    .catch(err => {
      console.error(`Error copying "${text}" to clipboard: ${err}`);
    });
}
</script>


<script>
    // Referenz zum Button und zum Div
const klappenButton = document.querySelector('.klappenButtonPaginator');
const listHashtagDiv = document.querySelector('.show_paginator');

// Event-Handler für den Klick auf den Button
klappenButton.addEventListener('click', () => {
    // Überprüfen, ob das Div sichtbar ist
    if (listHashtagDiv.style.display === 'none') {
        // Wenn es ausgeblendet ist, dann einblenden
        listHashtagDiv.style.display = 'block';
        // ändert text in schliessen
        klappenButton.textContent = "Close Paginator"
    } else {
        // Wenn es sichtbar ist, dann ausblenden
        listHashtagDiv.style.display = 'none';
        klappenButton.textContent = "Open Paginator"
    }
});

</script>