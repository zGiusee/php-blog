// MODALE PER L'ELIMINAZIONE DEI RECORD
const deleteButtons = document.querySelectorAll(".delete-button");

deleteButtons.forEach((button) => {
  button.addEventListener("click", function () {
    // Recupero lo slug/id dai data
    let title = button.getAttribute("data-title");

    // Recupero il nome del progetto
    let id = button.getAttribute("data-postid");

    // Recupero lo spazio riservato al nome dell appartamento dentro il modal
    const input_id = document.getElementById("post_id");

    input_id.setAttribute("value", id);

    // Recupero lo spazio riservato al titolo del progetto dentro il modal
    const modal_title = document.getElementById("modal_title");

    modal_title.textContent = `Sei sicuro di voler eliminare il post "${title}" ?`;
  });
});
