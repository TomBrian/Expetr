<template>
<div class="home shadow-sm">

    <div class="header">
        <div>
            <button v-on:click="getPdf()" class="btn btn-secondary"><i class="fa fa-download" aria-hidden="true"></i> <span class="sm-none">get a copy</span> </button>
        </div>
        <div>{{organisation.name}}</div>
        <!-- Button trigger modal -->
        <div class="add shadow-sm" data-toggle="modal" data-target="#modelId">
            <i class="fas fa-plus"></i>
        </div>
    </div>
    <div class="alert wait alert-info">
        Please wait while the file is being processed.This could take a while.
    </div>
    <div class="stop-wait alert alert-danger">
        Failed to process file.Please try again later
    </div>
    <div class="total p-2" style="position:relative;">
        <div class="contributors text-primary">contributors: &nbsp; {{contributors}}</div>
         <div class="search my-2 flex">
                <input type="text" placeholder="search for expense..." v-model="searchQuery" v-on:keyup="searchEx()" class="form-control"><button class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
        <div class="number text-primary">total: &nbsp; {{expenseTotal}}</div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Expense</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="makeExp()" method="post">
                        <div class="block">
                            <div><label for="title">Title:</label>
                                <input type="text" v-model="fields.title" name="title" class="form-control" required />
                            </div>
                            <div><label for="description">Description:</label>
                                <textarea name="description" v-model="fields.description" class="form-control" required></textarea></div>
                            <div>
                                <label for="amount">Amount:</label>
                                <input type="number" name="amount" v-model="fields.amount" class="form-control" />
                            </div>
                        </div>
                        <h6 class="my-5">Category</h6>
                        <div class="flex">
                            <div class="catSug">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="category" v-model="fields.category" value="rental cost">
                                        Rental cost
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="category" v-model="fields.category" value="salaries & wages">
                                        Salaries & wages
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="category" v-model="fields.category" value="medical">
                                        Medical expenses
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="category" v-model="fields.category" value="marketing & advertising">
                                        marketing & advertising
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="category" v-model="fields.category" value="utilities">
                                        utilities
                                    </label>
                                </div>
 
<div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="category" v-model="fields.category" value="food">
                                        food
                                    </label>
                                </div>


                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="category" v-model="fields.category" value="insurance">
                                        Insurance
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="category" v-model="fields.category" value="Delivery & freight">
                                        Delivery and freight
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="category" v-model="fields.category" value="gifts & entertainment">
                                        gifts & entertainent
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="category" v-model="fields.category" value="other">
                                        other
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="alert alert-danger"></div>
                        <div class="alert alert-success"></div>
                        <div class=" my-5">
                            <div class="loading my-2"><small>creating...</small> </div>
                            <div class="form-submit">
                                <button class="btn btn-primary" type="submit">

                                    add expense
                                </button>
                                <button class="btn btn-outline-primary" type="reset">

                                    clear fields
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

    <div class="table-wrap px-3">
      
        <div class="summary my-6">
            <table class="table">
                <tr>
                    <th>Categories</th>
                    <td>Rental cost</td>
                    <td>wages and salaries</td>
                    <td>Medical cost</td>
                    <td>Utilities</td>
                    <td>Food</td>
                    <td>marketing</td>
                    <td>Insurance</td>
                    <td>Delivery and freight</td>
                    <td>Gifts & entertainment</td>
                    <td>Other</td>
                </tr>
                <tr>
                    <th scope="row">Total</th>
                    <td>{{this.categoryTotals.rental}}</td>
                    <td>{{this.categoryTotals.salaries}}</td>
                    <td>{{this.categoryTotals.medical}}</td>
                    <td>{{this.categoryTotals.utilities}}</td>
                    <td>{{this.categoryTotals.food}}</td>
                    <td>{{this.categoryTotals.marketing}}</td>
                    <td>{{this.categoryTotals.insurance}}</td>
                    <td>{{this.categoryTotals.delivery}}</td>
                    <td>{{this.categoryTotals.gifts}}</td>
                    <td>{{this.categoryTotals.other}}</td>
                </tr>
            </table>
        </div>
        <div class="loader shadow-sm">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <table class="table table-striped table-inverse table-hover table-bodered">
            <thead class="thead thead-inverse">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>description</th>
                    <th>author</th>
                    <th>amount</th>
                    <th>date</th>
                    <th>category</th>
                    <th>status</th>
                    <th>actions</th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="expense in expenses" :key="expense.id">
                    <th scope="row">{{expense.id}}</th>
                    <td>{{expense.title}}</td>
                    <td>{{expense.description}}</td>
                    <td>{{expense.author}}</td>
                    <td>{{expense.amount}}</td>
                    <td>{{expense.created_at | moment("dddd, MMMM Do YYYY")}}</td>
                    <td>{{expense.category}}</td>
                    <td>
                        <div class="form-group">
                            <select class="form-control" v-on:change="setStatus(expense.id,expense.status)" v-model="expense.status" name="status" id="status">
                                <option value="progress">in progress</option>
                                <option value="rejected">rejected</option>
                                <option value="approved">approved</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <form @submit.prevent="deletes(expense.id)" method="post">
                           
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
</template>

<script>
export default {
    name: 'expenses',
    data() {
        return {
            user: '',
            allUsers: [],
            organisation: '',
            fields: {
                title: '',
                description: '',
                amount: '',
                category: ''
            },
            expenses: [],
            expenseTotal: '',
            contributors: '',
            categoryTotals: {
                rental: '',
                salaries: '',
                medical: '',
                utilities: '',
                food: '',
                marketing: '',
                insurance: '',
                delivery: '',
                gifts: '',
                other: ''
            },
            actions: {
                targetId: '',
                status: ''
            },
            searchQuery:''
        }
    },

    methods: {   
        searchEx: function () {
            $('.summary').hide();
            var results = [];
            const all = this.expenses;
            if (this.searchQuery == '') {
               this.getExp(); 
               $('.summary').show();
            }
            if (all.length > 0) {
                const allConvs = this.expenses;
                for (let i = 0; i < allConvs.length; i++) {
                    const conv = allConvs[i];
                    if (conv.title.toUpperCase().indexOf(this.searchQuery.toUpperCase()) > -1) {
                        results.push(conv);
                    }
                }
            } else {
                alert("you have no expenses")
            }

            this.searchResults = results;
            if (this.searchResults.length > 0) {
                this.expenses = results;
            }
            console.log(this.searchResults);
        },
        getPdf: function () {
            $('.wait').show();
            axios.get(location.origin + '/api/downloads/download-expenses-pdf', {
                responseType: 'blob'
            }).then((res) => {
                const url = window.URL.createObjectURL(new Blob([res.data]));
                const link = document.createElement('a');
                link.href = url;
                const rand = Math.random().toString();
                const longInt = rand.split('.')[1];
                link.setAttribute('download', `expenses_${this.organisation.name}_${longInt}.pdf`);
                document.body.appendChild(link);
                link.click();
                $('.wait').hide();
                $('.stop-wait').hide();
            }).catch((error) => {
                console.log(error);
                $('.wait').hide();
                $('.stop-wait').show();
            });
        },
        makeExp: function () {
            $('.loading').show()
            axios.post(location.origin + '/api/make-expense', {
                    title: this.fields.title,
                    description: this.fields.description,
                    amount: this.fields.amount,
                    category: this.fields.category
                }, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(() => {
                    $('.loading').hide()
                    $('.alert-success').show()
                    $('.alert-danger').hide()
                    this.getExp()
                    this.getCatTotals()

                    $('.alert-success').html('expense created')
                })
                .catch(() => {
                    $('.loading').hide()
                    $('.alert-danger').show()
                    $('.alert-success').hide()
                    $('.alert-danger').html('failed to create expense.Check all fields <strong>OR</strong> try again later')
                });

        },
        deletes: function (id) {
            if (confirm("YOU ARE ABOUT TO DELETE AN EXPENSE!")) {
                axios.post(location.origin + `/api/delete-expense/${id}`).then(() => {
                    this.getExp();
                }).catch((err) => {
                    console.log(err);
                })
            }
        },
        setStatus: function (id, status) {
            if (confirm(`set status to ${status}?`)) {
                axios.post(location.origin + `/api/set-status/${id}/${status}`).then(() => {
                    this.getExp();
                }).catch((err) => {
                    console.log(err);
                })
            }
        }
    },
    mounted() {
        var failed = $('.alert-danger');
        failed.hide();
        var success = $('.alert-success');
        success.hide();
        $('.loading').hide()
        $('.wait').hide()
        $('.stop-wait').hide()
        /**Global methods */

        // get existing expenses
        this.getExp()
        //get logged in user details
        this.getUser()
        //get All users
        this.getAllUsers()
        //get organisation
        this.getOrg()

    }

}
</script>

<style scoped>
.home {
    width: 95%;
}
.total{
    width: 80%;
    margin:auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
@media (max-width:900px){
    .home{
        width:100%;
    }
    .total{
        width:100%;
    }
    .total .number{
        font-size: 12px !important;
    }
    .total .contributors{
        font-size: 12px !important;
        text-align: center;
    }
    .search .form-control{
        height:35px;
    }
    .search .btn{
        height:35px;
    }
}
.search .form-control {
    border-right: none;
    border-radius: 37px 0px 0px 37px;
}

.form-control:focus {
    box-shadow: 23px 23px 23px transparent;
}

.search .btn {
    border: solid 1px rgba(141, 141, 141, 0.466);
    border-left: none;
    border-radius: 0px 37px 37px 0px;
}
.total .number {
    font-weight: bold;
    font-family: 'poppins', sans-serif;
   
}

.total .contributors {
    font-weight: bold;
    font-family: 'poppins', sans-serif;
  
}

.table-wrap {
    width: 100%;
    min-height: 630px;
    margin: auto;
    position: relative;
    overflow: scroll !important;
    border-bottom: solid 1px #DEE2E6;
    background-color: white;
    padding-bottom: 30px;
}

.table-wrap::-webkit-scrollbar-thumb {
    background: #2c75dc6b;
}

.table-wrap::-webkit-scrollbar-thumb:hover {
    background: #2C76DC;
}

.table-wrap::-webkit-scrollbar {
    width: 3px;
}

.modal-dialog {
    border-radius: 0% !important;
    z-index: 3000;
}

.header {
    margin-top: 20px !important;
    margin-bottom: 20px !important;
    width: 90%;
    margin: auto;
    font-size: 18px;
    font-family: roboto;
    text-transform: uppercase;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
}

.header .add {
    font-weight: lighter;
    color: white;
    background-color: #2C76DC;
    height: 40px;
    width: 40px;
    border-radius: 50%;
    position: relative;
    cursor: pointer;
}

.add i {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.table td {
    min-width: 150px;
    width: fit-content;
    max-width: 250px;
    border-right: solid 1px #DEE2E6;
}

.table th {
    border-right: solid 1px #DEE2E6;
}

.table tr {
    width: fit-content;
}

.table {
    height: fit-content;
}

.btn:focus {
    border: none !important;
    outline: none !important;
}

.form-control {
    width: 90%;
}

.form-control:focus {
    outline: none !important;
}

.block div {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.block {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 100%;
    justify-content: space-between;
    align-items: center;
}

form .catSug {
    display: flex;
    flex-direction: row !important;
    width: 90%;
    margin: auto;
    flex-wrap: wrap;
}

.catSug div {
    margin: 10px;
}

.form-submit {
    width: 90%;
    margin: auto;
    display: flex;
    justify-content: space-between;
}

.wait {
    width: 70%;
    margin: auto;
    border-radius: 0%;
    border-bottom: 2px solid #2C76DC !important;
    border: none;
}

@media (max-width:1000px) {
    .home {
        width: 100% !important;
        flex: 1 !important;
    }
}

.stop-wait {
    width: 70%;
    margin: auto;
    border-radius: 0%;
    border-bottom: 2px solid rgb(133, 0, 0) !important;
    border: none;
}

@media (max-width:1000px) {
    .sm-none {
        display: none !important;
    }
}

@media (min-width:1000px) {
    .lg-none {
        display: none !important;
    }
}

/* loader */
/* */
</style>
