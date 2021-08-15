<template>
<div :class="(downloads.length == 0)?'home flex align-items-center':'home'">
    <div class="loader shadow-sm">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="jumbotron flex align-items-center" v-if="downloads.length == 0" style="flex-direction:column;">
        <h5>You have no downloads yet</h5>
        <p class="text-muted">
            Pdf downloads are generated at the end of every month.
        </p>
    </div>
    <div class="flex" v-if="downloads.length > 0">
       <div v-for="download in downloads" :key="download.id" class="download-card my-3 mx-3 grid-item shadow-sm p-4">
        <div class="header">
            <div class="title">{{download.name}}</div>
            <div><small class="text-muted">{{download.created_at.split('T')[0]}}</small></div>
        </div>
        <div class="body">
            <img :src="'/images/pdf.svg'" class="pdf-icon" alt="">
        </div>
        <div class="footer">
            <div title="download">
                <div class="mx-2">
                    <a :href="download.file_url" :download="download.name">
                        <img :src="'/images/download.svg'" class="footer-icon" alt="">
                    </a>
                </div>
                <div>
                    <small class="font-weight-bolder">download</small>
                </div>
            </div>
            <div title="view">
                <div class="mx-2">
                    <a :href="download.file_url">
                        <img :src="'/images/view.svg'" class="footer-icon" alt="">
                    </a>
                </div>
                <div>
                    <small class="font-weight-bolder">view</small>
                </div>
            </div>
        </div>
       </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'downloads',
    data() {
        return {
            downloads: []
        }
    },
    mounted() {
        axios.get(location.origin + '/api/get-organisation-downloads').then((res) => {
            this.downloads = res.data;
            $('.loader').hide();
        }).catch((err) => {
            console.log(err)
        })
        this.countUnreadNotifications();
    }
}
</script>

<style scoped>
.home {
    width: 98% !important;
    min-height: 100% !important;
    background-color: transparent !important;
}

.download-card {
    background-color: white;
    width: 350px;
    height: 360px;
    border-radius: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.download-card .header {
    display: flex;
    padding: 10px;
    align-items: center;
    width: 100%;
    justify-content: space-between;
}

.header .title {
    font-weight: bold;
    font-family: poppins;
}

.download-card .body {
    min-height: 70%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pdf-icon {
    width: 130px;
}

.footer {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 90%;
    margin: auto;
}

.footer div {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #696767;
}

.loader {
    background-color: #F1F5F7;
}
.flex{
    flex-wrap: wrap;
    width:100%;
}
</style>
