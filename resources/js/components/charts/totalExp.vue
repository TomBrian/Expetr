<script>
import {
        Line,
        mixins
    } from 'vue-chartjs'
    
    export default {
         name:'totalExp',
        extends: Line,
        mixins: [mixins.reactiveProp],
        props: ['chartData'],
        data() {
            return {
                options: { 
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: true
                            }
                        }]
                    },
                    legend: {
                        display: true
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            }
        },
        mounted() {
            this.renderChart(this.chartData, this.options)
        }
        
    }
</script>
