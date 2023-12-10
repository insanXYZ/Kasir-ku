<template>
  <div class="flex flex-col gap-3 w-full">
    <label :for="For" class="font-semibold "><slot></slot></label>
    <input v-model="input" :type="Type" :id="For" class="p-1 border rounded-sm bg-white" required>
</div>
</template>
<script>
export default{
  data(){
    return{
      input: ""
    }
  },
  props : ["Type" , "For"],
  emits : ["input"],
  watch: {
    input(){
      this.$emit('input',this.input)
    }
  }
}
</script>