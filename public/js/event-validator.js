const form = document.querySelector(".event-creator");
const titleInput = form.querySelector('input[name="title"]');
const maxParticipantsInput = form.querySelector('input[name="maxParticipants"]');
const dateInput = form.querySelector('input[name="date"]');
const submitBtn = document.querySelector("button[type='submit']");
submitBtn.disabled = true;

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

function validateTitle() {
    markValidation(titleInput, titleInput.value !== "");
    checkFormValidity();
}

function validateMaxParticipants() {
    markValidation(maxParticipantsInput, Number(maxParticipantsInput.value) >= 2);
    checkFormValidity();
}

function validateDateInput() {
    const currentDate = new Date();
    const inputDate = new Date(dateInput.value);
    markValidation(dateInput, inputDate > currentDate);
    checkFormValidity();
}

function checkFormValidity() {
    submitBtn.disabled = !(titleInput.value !== "" && Number(maxParticipantsInput.value) >= 2 && dateInput.valueAsDate > new Date());
}

titleInput.addEventListener('keyup', validateTitle);
maxParticipantsInput.addEventListener('keyup', validateMaxParticipants);
maxParticipantsInput.addEventListener('change', validateMaxParticipants);
dateInput.addEventListener('keyup', validateDateInput);
dateInput.addEventListener('change', validateDateInput);