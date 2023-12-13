<template>
  <div class="flex items-center gap-6">
      <ButtonMenu @click="$emit('filterToggle')" class="relative">
        <img src="svg/filter.svg" class="w-5">
        <div class="whitespace-nowrap">Filter</div>
      </ButtonMenu>
      <ButtonMenu>
        <span>{{ title }}</span>
      </ButtonMenu>
    </div>
</template>
<script>
import ButtonMenu from '../Product/ButtonMenu.vue';

export default {
  components : {
    ButtonMenu,
  },
  emits: ["filterToggle"],
  props : ["title"]
}
</script>