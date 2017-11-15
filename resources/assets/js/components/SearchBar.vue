<template>
    <!--<div>-->
        <!--<input type="text" class="form-control" placeholder="Search..." v-model="keyword">-->
        <!--<div style="position: absolute;top: 100%;left: 0;z-index: 1000;">-->
            <!--{{hits}}-->
        <!--</div>-->
    <!--</div>-->
    <div class="btn-group" style="width:100%;">
        <input class="dropdown-toggle form-control"
               v-model="keyword"
               placeholder="Search..."
               data-toggle="dropdown" type="text"/>
        <ul v-if="hits.length > 0" class="dropdown-menu list-group" style="width:100%">
            <li v-for="hit in hits">
                <a v-bind:href="'/topics/' + hit._source.id">
                    <span>{{hit._source.title}}</span>
                    <span class="pull-right">
                        {{hit._source.created_at}} · {{hit._source.num_comments}} comments
                    </span>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        watch: {
            keyword: function(val, oldVal) {
                if(val)
                    this.$http.get('http://' + window.location.host + ':9200/blog/topics/_search?'
                        + 'q=+title:' + val + '+body:' + val).then(res => {
                        this.hits = res.body.hits.hits;
                        console.log(this.hits.length);
                    });
                else {
                    this.hits = [];
                }
            }
        },
        data() {
            return {
                keyword: '',
                hits: []
            };
        }
    }
</script>
