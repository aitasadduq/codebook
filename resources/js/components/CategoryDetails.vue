<template>
    <div class="col-md-4 col-sm-6 mb-4">
        <div
            class="card"
            v-on:mouseover="open"
            v-on:mouseleave="close">
            <div class="card-body">
                <h4 v-text="title" class="card-title text-center"></h4>
                <div v-show="isOpen">
                    <p v-text="description" class="card-text"></p>
                    <div class="text-center">
                        <form method="GET" :action="link">
                            <input type="hidden" name="is_filter" value="0">
                            <input class="btn btn-primary" type="submit" name="submit" :value="primaryButtonText">
                        </form>
                        <br>
                        <router-link tag="div" :to="to">
                            <a class="btn btn-primary">{{ secondaryButtonText }}</a>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            id: { required: true },
            title: { required: true },
            description: { required: true },
            primaryButtonText: { required: true },
            primaryButtonLink: { type: String },
            secondaryButtonText: { required: true },
            secondaryButtonLink: { type: String },
        },
        computed: {
            link() {
                if(!this.primaryButtonLink) return '/categories/' + this.id + '/codes';
                return this.primaryButtonLink;
            },
            to() {
                if(!this.secondaryButtonLink) return '/categorycodes/' + this.id;
                return this.secondaryButtonLink;
            }
        },
        data() {
            return {
                isOpen: false
            };
        },
        methods: {
            open() {
                this.isOpen = true;
            },
            close() {
                this.isOpen = false;
            }
        },
    }
</script>
