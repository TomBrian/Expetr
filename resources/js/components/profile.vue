<template>
<div class="home">
    {{user.name}}

</div>
</template>

<script>
export default {
    name: 'profile',
    data() {
        return {
            user: []
        }
    },
    mounted() {
        fetch(location.origin + '/api/user')
            .then(res => res.json())
            .then((data) => {
                this.user = data;
                this.createAvatar()
            })
            .catch(err => console.log(err))
    },
    methods: {
        createAvatar: function () {
            const fullName = this.user.name;
            const nameArr = fullName.split(' ');
            const firstName = nameArr[0];
            const secondName = nameArr[1];
            const initials = firstName.charAt(0) + secondName.charAt(0);

            console.log('you are logged in as ' + initials);
        }

    }
}
</script>
