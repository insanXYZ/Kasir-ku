document.addEventListener("DOMContentLoaded", function () {
  const buttonModal = document.querySelector(".buttonModal");
  const closeModal = document.querySelector(".closeModal");
  const buttonInput = document.querySelector(".buttonInput");
  const modal = document.querySelector(".modal");
  const remove = document.querySelectorAll(".remove");
  const modalUpdate = document.querySelector(".modalUpdate");
  const closeUpdate = document.querySelector(".closeUpdate");
  const buttonUpdate = document.querySelector(".buttonUpdate");
  const update = document.querySelectorAll(".update");
  const generateBarqode = document.querySelector(".generateBarqode");

  buttonModal.addEventListener("click", function () {
    modal.classList.remove("hidden");
  });

  closeModal.addEventListener("click", function () {
    modal.classList.add("hidden");
  });

  closeUpdate.addEventListener("click", function () {
    modalUpdate.classList.add("hidden");
  });

  generateBarqode.addEventListener("click", function () {
    Livewire.emit("generateJson");
  });

  buttonInput.addEventListener("click", function () {
    setTimeout(() => {
      modal.classList.add("hidden");
    }, 1000);
  });

  update.forEach((element) => {
    element.addEventListener("click", function () {
      modalUpdate.classList.remove("hidden");
      Livewire.emit("setInput", element.dataset.produk);
    });
  });

  buttonUpdate.addEventListener("click", function () {
    setTimeout(() => {
      modalUpdate.classList.add("hidden");
    }, 1000);
  });

  remove.forEach((element) => {
    element.addEventListener("click", function () {
      let bool = confirm("yakin dek?");

      if (bool) {
        Livewire.emit("destroy", element.dataset.barqode);
      }
    });
  });
});
