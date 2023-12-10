<template>
  <input v-model="input" :type="type" :placeholder="placeholder" class="w-full p-1 rounded-sm outline-none bg-slate-50 border-b focus:bg-white" required />
</template>
<script>
export default {
  data(){
    return {
      input : this.value,
    }
  },
  watch: {
    input(){
      return this.$emit('input',this.input)
    }
  },
  props: ["type","placeholder","value"],
  emits: ["input"]
}
</script>