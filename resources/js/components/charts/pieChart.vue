<script>
import {
    Doughnut,
    mixins
} from "vue-chartjs";
export default {
    extends: Doughnut,
    name: 'pieChart',
    props: ["data", "options"],
    mounted() {
        this.renderChart(this.data, this.options);

    },
};
</script>
