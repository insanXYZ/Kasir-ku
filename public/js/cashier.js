document.addEventListener("DOMContentLoaded", function () {
  const buttonBuy = document.querySelector(".buttonBuy");
  const modal = document.querySelector(".modal");
  const closeModal = document.querySelector('.closeModal');
  const buttonPrint = document.querySelector('.buttonPrint');

  buttonPrint.addEventListener('click', function(){
    window.print();
    Livewire.emit('storeInput');
  })

  closeModal.addEventListener('click', function(){
    modal.classList.add('hidden');
    Livewire.emit('resetValue');
  })

  buttonBuy.addEventListener("click", function () {
    const namaProduk = document.querySelectorAll(".nama");
    const qtyProduk = document.querySelectorAll(".qty");
    const hargaProduk = document.querySelectorAll(".harga");

    let products = [];

    if (namaProduk.length > 0) {
      for (let i = 0; i < namaProduk.length; i++) {
        let product = {
          nama: namaProduk[i].innerHTML,
          qty: qtyProduk[i].value,
          harga: hargaProduk[i].innerHTML,
        };
        products.push(product);
      }
      Livewire.emit("setValue", products);
      setTimeout(() => {
        modal.classList.remove('hidden');
      }, 1000);
    }
  });
});
