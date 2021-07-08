<template>
<div class="sidebar shadow-sm">
    <router-link to="/dashboard/home">
        <div class="sidebar-item"><a href="#">
                <div class="item-content">
                    <div class="icon"><i class="fas fa-home"></i></div>
                    <div class="sm-none">Home</div>
                </div>
            </a>
        </div>
    </router-link>
    <router-link to="/dashboard/expenses">
        <div class="sidebar-item"><a href="#">
                <div class="item-content">
                    <div class="icon"><i class="fas fa-money-check"></i></div>
                    <div class="sm-none">Expenses</div>
                </div>
            </a></div>
    </router-link>
    <router-link to="/dashboard/charts">
        <div class="sidebar-item"><a href="#">
                <div class="item-content">
                    <div class="icon"><i class="fas fa-chart-bar"></i></div>
                    <div class="sm-none">Charts</div>
                </div>
            </a></div>
    </router-link>
    <router-link to="/dashboard/Tasks">
        <div class="sidebar-item"><a href="#">
                <div class="item-content">
                    <div class="icon"><i class="fas fa-list-ul"></i></div>
                    <div class="sm-none">Tasks</div>
                </div>
            </a></div>
    </router-link>
    <router-link to="/dashboard/calendar">
        <div class="sidebar-item"><a href="#">
                <div class="item-content">
                    <div class="icon"><i class="far fa-calendar-alt"></i></div>
                    <div class="sm-none">Calendar</div>
                </div>
            </a></div>
    </router-link>

    <router-link to="/dashboard/downloads">
        <div class="sidebar-item"> <a href="#">
                <div class="item-content">
                    <div class="icon"><i class="fas fa-cloud-download-alt"></i></div>
                    <div class="sm-none">Downloads</div>
                </div>
            </a>
        </div>
    </router-link>
    <router-link to="/dashboard/members">
        <div class="sidebar-item"> <a href="#">
                <div class="item-content">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <div class="sm-none">Members</div>
                </div>
            </a></div>
    </router-link>
    <router-link to="/dashboard/advanced">
        <div class="sidebar-item"> <a href="#">
                <div class="item-content">
                    <div class="icon"><i class="fas fa-sliders-h"></i></div>
                    <div class="sm-none">Advanced</div>
                </div>
            </a></div>
    </router-link>
</div>
</template>

<style scoped>
.sidebar {
    height: 90vh;
    width: 230px;
    padding: 0px;
    background-color: white;
}

@media (max-width:1000px) {
    .sidebar {
        width: fit-content !important;
    }

    .sm-none {
        display: none !important;
    }
}

.router-link-active .sidebar-item {
    background-color: #2C76DC;
}

.router-link-active a {
    color: white !important;
}

.router-link-active .sidebar-item:hover {
    background-color: #2C76DC !important;
    color: white !important;
}

.sidebar-item {
    color: black;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    width: 100%;
    font-family: 'poppins', sans-serif;
    font-size: 16px;
}

.sidebar-item a {
    color: black;
}

.item-content {
    width: fit-content;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: fit-content;
}

.icon {
    font-size: 16px;
    margin-right: 20px;
}

a:hover {
    text-decoration: none;
}

.sidebar-item:hover {
    background-color: #efefef;

}
</style>

<script>
export default {
    name: 'sidebar',
    methods: {},
    mounted: () => {}
}
</script>
