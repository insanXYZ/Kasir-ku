<template>
  <Bar
    :options="chartOptions"
    :data="chartData"
  />
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
  components: { Bar },
  data() {
    return {
      chartData: null,
      chartOptions: {
        maintainAspectRatio : false,
        responsive: true,
        plugins: {
          legend: {
            display: false
          }
        }
      }
    }
  },
  props: ["label" , "value"],
  watch: {
    label: {
      handler() {
        this.updateChartData();
      },
      immediate: true
    },
    value: {
      handler() {
        this.updateChartData();
      },
      immediate: true
    }
  },
  methods: {
    updateChartData() {
      this.chartData = {
        labels: this.label,
        datasets: [
          {
            data: this.value,
            backgroundColor: [ 'blue','green','yellow' ]
          }
        ]
      };
    }
  }
}
</script>