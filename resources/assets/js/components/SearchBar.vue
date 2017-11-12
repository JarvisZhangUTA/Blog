<template>
    <div>
        <input type="text" class="form-control" placeholder="Search..."
               v-model="keyword">

        <div v-for="topic in topics" class="media">
            <div class="media-body">
                <div class="media-heading">
                    <h2>
                        <a v-bind:href="'/topics/' + topic.id">
                            {{topic.title}}
                        </a>
                    </h2>
                    <p>
                        <small v-html="topic.brief">
                        </small>
                    </p>
                </div>
                <div class="media-bottom text-right">
                    By {{topic.user.name}} at {{topic.created_at}}
                    · {{topic.num_comments}} comments
                </div>

                <br>
                <hr>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            this.$http.post('/api/topics/search',).then(res => {
                this.topics = res.data;
            });
        },
        watch: {
            keyword: function(val, oldVal) {
                this.$http.post('/api/topics/search',{
                    keyword: this.keyword
                }).then(res => {
                    this.topics = res.data;
                });
            }
        },
        data() {
            return {
                keyword: '',
                topics: []
            };
        }
    }
</script>
