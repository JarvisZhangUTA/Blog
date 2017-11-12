<template>

    <div>
        <div v-for="topic in topics" class="media">
            <div class="media-body">
                <div class="media-heading">
                    <a v-bind:href="'/topics/' + topic.id">
                        {{topic.title}}
                    </a>
                </div>
                <div class="media-bottom">
                    By {{topic.user.name}} at {{topic.created_at}}
                    · {{topic.num_comments}} comments
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: [
            'owner_id',
            'follower_id',
            'keyword'
        ],
        methods: {
        },
        mounted() {
            this.$http.post('/api/topics/search',{
                'owner_id': this.owner_id,
                'follower_id':this.follower_id,
                'keyword':this.keyword
            }).then(res => {
                this.topics = res.data;
            });
        },
        data() {
            return {
                topics: []
            };
        }
    }
</script>
