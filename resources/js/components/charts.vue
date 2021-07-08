<template>
<div class="home">
    <div class="loader shadow-sm">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="expenses my-4 p-3 shadow-sm" v-if="pieChartData != null">
        <expenses-chart :chartData="expensesdatacollection"></expenses-chart>
    </div>
    <div class="flex">
        <div class="chart-card mx-1 shadow-sm" v-if="pieChartData != null">
            <pie-chart :data="pieChartData.chartData" :options="pieChartData.chartOptions"></pie-chart>
        </div>
        <div class="chart-card big shadow-sm" v-if="pieChartData != null">
            <total-exp :chartData="expData"></total-exp>
        </div>
    </div>
</div>
</template>

<script>
import expensesChart from './charts/expensesChart.vue'
import pieChart from './charts/pieChart.vue'
import totalExp from './charts/totalExp.vue'
export default {
    components: {
        expensesChart,
        pieChart,
        totalExp
    },
    name: 'charts',
    data() {
        return {
            historyData: null,
            expenseHistory: null,
            currMonth: null,
            categoryTotals: {
                rental: [],
                salaries: [],
                medical: [],
                utilities: [],
                food: [],
                marketing: [],
                insurance: [],
                delivery: [],
                gifts: [],
                other: [],
                expenses: []
            },
            expensesdatacollection: null,
            pieChartData: null,
            expData: null,
        }
    },
    mounted() {
        $('.loader').show();
        this.mapCategoryTotals();

    },
    methods: {
        mapCategoryTotals: function () {
            axios.get(location.origin + '/api/get-history').then((res) => {
                this.historyData = res.data;
                const months = this.historyData
                this.expensesdatacollection = {
                    labels: [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December"
                    ],
                    datasets: [{
                            label: "Rental cost",
                            backgroundColor: "blue",
                            data: this.categoryTotals.rental
                        },
                        {
                            label: "wages and salaries",
                            backgroundColor: "red",
                            data: this.categoryTotals.salaries
                        },
                        {
                            label: "Medical cost",
                            backgroundColor: "green",
                            data: this.categoryTotals.medical
                        },
                        {
                            label: "Utilities",
                            backgroundColor: "violet",
                            data: this.categoryTotals.utilities
                        },
                         {
                            label: "food",
                            backgroundColor: "purple",
                            data: this.categoryTotals.food
                        },
                        {
                            label: "marketing",
                            backgroundColor: "grey",
                            data: this.categoryTotals.marketing
                        },
                        {
                            label: "insurance",
                            backgroundColor: "aqua",
                            data: this.categoryTotals.insurance
                        },
                        {
                            label: "Delivery and freight",
                            backgroundColor: "orange",
                            data: this.categoryTotals.delivery
                        },
                        {
                            label: "gifts and entertainment",
                            backgroundColor: "brown",
                            data: this.categoryTotals.gifts
                        },
                    ]
                }
                for (let i = 0; i < months.length; i++) {
                    const oneMonth = months[i];

                    const pos = this.expensesdatacollection.labels.indexOf(oneMonth.month);

                    // set values by coresponding month index
                    this.categoryTotals.rental[pos] = oneMonth.total_rental;

                    this.categoryTotals.salaries[pos] = oneMonth.total_salaries
                    this.categoryTotals.medical[pos] = oneMonth.total_medical
                    this.categoryTotals.utilities[pos] = oneMonth.total_utilities
                    this.categoryTotals.food[pos] = oneMonth.total_food
                    this.categoryTotals.marketing[pos] = oneMonth.total_marketing
                    this.categoryTotals.insurance[pos] = oneMonth.total_insurance
                    this.categoryTotals.delivery[pos] = oneMonth.total_delivery
                    this.categoryTotals.gifts[pos] = oneMonth.total_gifts
                    this.fillTotalData();
                }
            }).catch(() => {
                console.log('request to get categories for history failed')
                $('.loader').hide();
            });

        },
        fillTotalData: function () {
            axios.get(location.origin + '/api/get-history').then((res) => {
                this.expenseHistory = res.data;
                const months = this.expenseHistory;

                this.expData = {
                    labels: [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December"
                    ],
                    datasets: [{
                        label: "Total expenses",
                        backgroundColor: "white",
                        borderColor: "blue",
                        data: this.categoryTotals.expenses
                    }]
                }
                for (let i = 0; i < months.length; i++) {
                    const month = months[i];

                    const pos = this.expData.labels.indexOf(month.month);

                    this.categoryTotals.expenses[pos] = month.total_expenses;

                }
            }).then(() => {
                this.fillPieData()
            }).catch((err) => {
                $('.loader').hide();
                console.log(err)
            });
        },
        fillPieData: function () {
            axios.get(location.origin + '/api/get-history').then((res) => {
                this.currMonth = res.data;
            }).then(() => {
                $('.loader').hide();
                for (let i = 0; i < this.currMonth.length; i++) {
                    const monthData = this.currMonth[i];
                    this.pieChartData = {
                        chartOptions: {
                            hoverBorderWidth: 20
                        },
                        chartData: {
                            options: {
                                responsive: true,
                                legend: {
                                    display: true,
                                    position: 'right',
                                }
                            },
                            hoverBackgroundColor: "red",
                            hoverBorderWidth: 10,
                            labels: ["Rental cost", "wages and salaries", "Medical cost", "Utilities","food", "marketing", "insurance", "Delivery and freight", "gifts and entertainment"],
                            datasets: [{
                                backgroundColor: ["blue", "red", "green","violet", "purple", "grey", "aqua", "orange", "brown"],
                                data: [monthData.total_rental,
                                    monthData.total_salaries,
                                    monthData.total_medical,
                                    monthData.total_utilities,
                                    monthData.total_food,
                                    monthData.total_marketing,
                                    monthData.total_insurance,
                                    monthData.total_delivery,
                                    monthData.total_gifts
                                ]
                            }]
                        }
                    }
                }

            }).catch(() => {
                $('.loader').hide();
            })
        },
    }
}
</script>

<style scoped>
.expenses {
    width: 100%;
    background-color: white;
    margin: auto;
}

.flex {
    width: 100%;
    margin: auto;
    justify-content: space-between;
}

.home {
    width: 98% !important;
    background-color: transparent !important;
    display: block !important;
}

.chart-card {
    margin: 5px;
    background-color: white;
    width: fit-content;
    height: fit-content;
    padding: 30px;
}

.loader {
    background-color: #F1F5F7;
}

@media (max-width:1200px) {
    .flex {
        flex-wrap: wrap;
    }
}

.big {
    flex: 1;

}
</style>
