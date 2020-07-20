<template>
    <div id="app">
        <h1 class="font-weigh-bold">News</h1>
        <div v-for="news in news" v-bind:key="news.id" class="col">
            <div class="card text-left mb-2">
                <div class="card-body">
                    <img class="card-img-top" :src="'http://localhost:8000/storage/'+news.image_name" alt="">
                    <h4 class="card-title">
                        {{ news.title }}
                    </h4>
                    <small class="text-muted">
                        {{ news.created_at }}
                    </small>
                    <p class="card-text text-justify text-truncate">
                        {{ news.content }}
                    </p>
                    <router-link class="btn btn-info" :to="'/news/show/'+news.id">View Detail</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data: function () {
            return {
                news: []
            }
        },

        mounted() {
            this.loadData();
        },

        methods: {
            loadData() {
                axios.get("http://localhost:8000/api/news").then(response => {
                    this.news = response.data;
                });
            },
        }
    }
</script>