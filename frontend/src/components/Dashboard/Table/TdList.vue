<template>
  <Td>{{ data.type }}</Td>
  <Td>{{ data.description }}</Td>
</template>
<script>
import Td from './Td.vue';
export default {
  components: {
    Td
  },
  props: ["data"]
}
</script>