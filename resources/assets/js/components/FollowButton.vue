<template>

    <button style="margin: 0; padding: 0;" class="btn btn-link" v-text="text" v-on:click="follow">

    </button>

</template>

<script>
    export default {
        props: [
            'topic_id',
            'user_id'
        ],
        computed: {
            text() {
                return this.isFollowed? 'Unfollow' : 'Follow';
            }
        },
        methods: {
            follow() {
                this.$http.put('/api/topics/' + this.topic_id + '/followers',
                    {'user_id': this.user_id})
                    .then(res => {
                        this.isFollowed = res.data.isFollowed;
                    });
            }
        },
        mounted() {
            this.$http.get('/api/topics/' + this.topic_id + '/followers')
                .then(res => {
                    const followers = res.data.followers;
                    this.isFollowed = false;
                    for(let i = 0; i < followers.length; i++) {
                        if(followers[i].user_id === +this.user_id) {
                            this.isFollowed = true;
                        }
                    }
                });
        },
        data() {
            return {
                isFollowed: false
            };
        }
    }
</script>
