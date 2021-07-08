<template>
<div class="home">
    <article style="width:80%; margin:auto;">
        <h5 class="my-3 text-center">1. Expenses</h5>
    <p>
        All expenses are grouped into basic categories i.e Rental cost , wages and salaries, Medical cost, Utilities, marketing	Insurance, Delivery and freight, Gifts & entertainment and	Other.
    </p>
    <p class="my-4">Here is a table with examples of expenses for each categories.</p>
    <table class="table" style="width:80%; margin:auto;">
        <tbody>
            <tr>
                <th scope="row">rental cost</th>
                <td>rent payed for the facility or construction and repair cost</td>   
            </tr>
            <tr>
                <th scope="row">Wages and salaries</th>
                <td>Any form of payment for a service to both staff and non staff workers</td>
            </tr>
             <tr>
                <th scope="row">Medical expenses</th>
                <td>Cash payed for any health related expense</td>
            </tr>
             <tr>
                <th scope="row">Utilities</th>
                <td>Electricity,water,heating,waste disposal,sewage,cost of gas,cost of internet</td>
            </tr>
             <tr>
                <th scope="row">Food</th>
                <td>Groceries,Restaurants,food</td>
            </tr>
             <tr>
                <th scope="row">Marketing</th>
                <td>Cost of any form of advertisement</td>
            </tr>
            <tr>
                <th scope="row">Insurance</th>
                <td>insurance</td>
            </tr>
            <tr>
                <th scope="row">Delivery and freight</th>
                <td>cash payed for goods delivered to and from the organisation</td>
            </tr>
              <tr>
                <th scope="row">Gifts & entertainment</th>
                <td>cash payed for gifts,trips and any other form of entertainment</td>
            </tr>
            <tr>
                <th scope="row">other</th>
                <td>any other expense that cant be classified in any of the above categories</td>
            </tr>
        </tbody>
    </table>
    </article>
</div>
</template>

<script>
export default {
    name: 'help'
}
</script>
<style scoped>
.home{
    width: 98% !important;
    background: white !important;
}
</style>
