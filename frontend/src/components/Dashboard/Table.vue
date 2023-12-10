<template>
  <div v-if="histories.length != 0" class="w-full flex flex-col gap-5">
    <table class="min-w-full divide-y divide-gray-200 mb-20">
      <thead class="bg-gray-200">
        <tr>
          <Th class="w-[200px]">Tipe</Th>
          <Th>Deskripsi</Th>
        </tr>
      </thead> 
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(item , i) in histories" :key="i" class="bg-white rounded-t-lg">
          <TdList :data="item"></TdList>
        </tr>
      </tbody>
    </table>  
  </div>
</template>
<script>
import Th from '../Dashboard/Table/Th.vue';
import TdList from '../Dashboard/Table/TdList.vue';

export default {
  data(){
    return {
      search: ""
    }
  },
  components: {
    Th,
    TdList
  },
  props : ["histories"]
}

</script>