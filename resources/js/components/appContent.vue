<template>
<div class="window">
    <router-view name="d"></router-view>
</div>
</template>

<script>
export default {
    name: 'appContent'
}
</script>

<style>
.window {
    flex-grow: 1;
    display: flex;
    max-width: 83%;
    max-height: 90vh;
}

@media (max-width:1000px) {
    .home {
        width: 100% !important;
        flex: 1 !important;

    }

    .window {
        max-width: 93% !important;
    }
}

.loader {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: white;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 2;
}

.loader-wrapper {
    position: relative;
    width: 90%;
    background-color: white;
    margin: auto;
    height: 100%;
    min-height: 80vh;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.home {
    position: relative;
    background-color: white;
    margin: auto;
    height: 100%;
    width: 90% !important;
    min-height: 80vh;
    overflow-y: scroll;
    display: flex;
    flex-direction: column;

}

.home::-webkit-scrollbar {
    width: 3px;
}

.home::-webkit-scrollbar-thumb {
    background: #2c75dc6b;
}

.home::-webkit-scrollbar-thumb:hover {
    background: #2C76DC;
}

/* loader */
.lds-ellipsis {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
}

.lds-ellipsis div {
    position: absolute;
    top: 33px;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: #2C76DC;
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
}

.lds-ellipsis div:nth-child(1) {
    left: 8px;
    animation: lds-ellipsis1 0.6s infinite;
}

.lds-ellipsis div:nth-child(2) {
    left: 8px;
    animation: lds-ellipsis2 0.6s infinite;
}

.lds-ellipsis div:nth-child(3) {
    left: 32px;
    animation: lds-ellipsis2 0.6s infinite;
}

.lds-ellipsis div:nth-child(4) {
    left: 56px;
    animation: lds-ellipsis3 0.6s infinite;
}

@keyframes lds-ellipsis1 {
    0% {
        transform: scale(0);
    }

    100% {
        transform: scale(1);
    }
}

@keyframes lds-ellipsis3 {
    0% {
        transform: scale(1);
    }

    100% {
        transform: scale(0);
    }
}

@keyframes lds-ellipsis2 {
    0% {
        transform: translate(0, 0);
    }

    100% {
        transform: translate(24px, 0);
    }
}
</style>
