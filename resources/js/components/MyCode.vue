<template>
    <div v-show="isRelevant">
        <div class="card">
            <div class="card-body">
                <h3><a :href="link(myCode['id'])">{{ myCode['title'] }}</a></h3>
                <p class="card-text">{{ myCode['details'] }}</p>
                <div class="text-right">
                    <span
                        class="badge badge-primary badge-pill"
                        v-for="sub in subcategories">
                        {{ sub['title'] }}
                    </span>
                </div>
            </div>
        </div>
        <br>
    </div>
</template>

<script>
    import Category from '../models/Category.js';

    export default {
        props: {
            myCode: { required: true },
            selectedFilters: { required: true },
        },
        methods: {
            link(id) {
                return '/codes/' + id;
            }
        },
        data() {
            return {
                subcategories: [],
            };
        },
        computed: {
            isRelevant() {
                let truth = false;
                if (this.selectedFilters.length > 0) {
                    this.selectedFilters.forEach(selFil => {
                        this.subcategories.forEach(sub => {
                            if (selFil['id'] == sub['id']) {
                                truth = true;
                            }
                        });
                    });
                } else {
                    truth = true;
                }
                return truth;
            }
        },
        created() {
            Category.code_subcategories(this.myCode['id'], subs => (this.subcategories = subs));
        },
        watch: {
            myCode (to, from) {
                Category.code_subcategories(this.myCode['id'], subs => (this.subcategories = subs));
            }
        },
    }
</script>
