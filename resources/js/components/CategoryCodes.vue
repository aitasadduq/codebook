<template>
    <div>
        <hr>
        <div class="text-center"><h1>Latest {{ name }} Codes</h1></div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">Subcategories</h3>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item"
                            v-for="sub in subcategories">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="sub.checked">
                                <label class="form-check-label">{{ sub.value['title'] }}</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <my-code
                    :my-code="mycode"
                    :selected-filters="selectedFilters"
                    v-for="mycode in codes"
                ></my-code>
            </div>
        </div>

    </div>
</template>

<script>
    import Category from '../models/Category.js';
    import MyCode from './MyCode.vue';

    export default {
        props: {
            id: {},
        },
        data() {
            return {
                codes: [],
                subcategories: [],
                name: '',
            };
        },
        computed: {
            selectedFilters: function() {
                let filters = [];
                let checkedFilters = this.subcategories.filter(obj => obj.checked);
                checkedFilters.forEach(element => {
                    filters.push(element.value['id']);
                });
                return filters;
            }
        },
        methods: {
            loadData() {
                Category.codes(this.id, categorycodes => (this.codes = categorycodes));
                Category.subcategories(this.id, categorysubs => (this.subcategories = categorysubs));
                Category.title(this.id, categoryname => (this.name = categoryname));
            }
        },
        created() {
            this.loadData();
        },
        watch: {
            '$route' (to, from) {
                this.loadData();
            }
        },
        components: { MyCode },
    };
</script>
