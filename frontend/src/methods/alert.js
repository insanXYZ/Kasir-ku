
function confirm(instance,icon,message){
  const swalWithBootstrapButtons = instance.$swal.mixin({
    customClass: {
      confirmButton: "border-none outline-none mx-1 py-1 px-2 text-white rounded-md bg-blue-500 text-xl",
      cancelButton: "mx-1 py-1 px-2 text-white bg-red-300 rounded-md text-xl"
    },
    buttonsStyling: false
  });
  return new swalWithBootstrapButtons({
    title: message,
    // iconHtml : `<img class="w-20 animate-pulse" src='${icon}'>`,
    showCancelButton: true,
    confirmButtonText: "Konfirmasi",
    cancelButtonText: "Tidak",
  })
}

export {confirm}