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
        responsive: true,
        plugins: {
          legend: {
            display: false
          }
        }
      }
    }
  },
  props: ["now" , "yesterday"],
  watch: {
    now: {
      handler() {
        this.updateChartData();
      },
      immediate: true
    },
    yesterday: {
      handler() {
        this.updateChartData();
      },
      immediate: true
    }
  },
  methods: {
    updateChartData() {
      this.chartData = {
        labels: ['Kemarin', 'Sekarang'],
        datasets: [
          {
            data: [this.yesterday, this.now],
            backgroundColor: [ 'blue' ]
          }
        ]
      };
    }
  }
}
</script>