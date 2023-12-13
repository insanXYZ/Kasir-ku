<template>
  <div class="w-[240px] h-full flex flex-col gap-6 bg-white ">
    <Logo></Logo>
    <div class="w-full flex flex-col gap-2 items-end overflow-y-auto">
      <Menu :pathNow="path" path="/" img="dashboard.svg">Dashboard</Menu>
      <Menu :pathNow="path" path="/product" img="product.svg">Produk</Menu>
      <Menu :pathNow="path" path="/cashier" img="cashier.svg">Kasir</Menu>
    </div>
  </div>
</template>
<script>
import Logo from "./sidebar/Logo.vue"
import Menu from "./sidebar/Menu.vue"
export default {
  components: {
    Logo,
    Menu
  },
  props: ["path"]
}
</script>