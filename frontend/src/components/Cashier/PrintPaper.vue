<template>
  <div v-if="product.length != 0" class="w-[220px] overflow-hidden px-1 flex flex-col gap-4 items-center bg-blue-500">
    <div class=" w-full flex flex-col items-center py-1">
      <div class="text-[16px]">
        PT. Tara Hudang
      </div>
      <span class="text-[16px]">
        No Transaksi {{ code }}
      </span>
    </div>
    <span>===============================================</span>
    <table class="w-full table-auto">
      <thead>
        <tr>
          <td class="text-left text-sm w-1/2">Nama</td>
          <td class="text-left text-sm">Harga</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item , i) in product" :key="i">
          <td class="text-sm pr-1 w-1/2">{{ item.name }}(x{{ item.amount }})</td>
          <td class="text-sm">{{ toRupiah(item.price) }}</td>
        </tr>
      </tbody>
    </table>
    <span>===============================================</span>
    <table class="w-full px-1 table-auto">
      <tbody>
        <tr>
          <td class="text-sm w-1/2">Diskon</td>
          <td class="text-sm">{{ toRupiah(discount) }}</td>
        </tr>
        <tr>
          <td class="text-sm">Uang</td>
          <td class="text-sm">{{ toRupiah(money) }}</td>
        </tr>
        <tr>
          <td class="text-sm">Kembalian</td>
          <td class="text-sm">{{ toRupiah(money - (price-discount)) }}</td>
        </tr>
        <tr>
          <td class="text-sm">Total</td>
          <td class="text-sm">{{ toRupiah(price-discount) }}</td>
        </tr>
      </tbody>
    </table>
    <div class="w-full text-center">
      Terima kasih telah berbelanja
    </div>
  </div>
</template>
<script>
import { toRupiah } from '../../methods/helpers';
export default {
  props: ["product","code","money","price","discount"],
  methods: {
    toRupiah
  }
}
</script>