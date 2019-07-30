<template>
    <div>
        <hr>
        <div class="text-center"><h1>{{ name }} Codes</h1></div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <form v-on:submit="getFilteredData">
                    <div class="form-row">
                        <input type="text" class="form-control" placeholder="Search..."
                            v-model="search" v-on:keyup="getFilteredData">
                    </div>
                </form>
                <br>
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
                    v-for="mycode in filteredCodes"
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
                filteredCodes: [],
                subcategories: [],
                name: '',
                search: '',
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
                Category.codes(this.id, categorycodes => (this.filteredCodes = categorycodes));
                Category.subcategories(this.id, categorysubs => (this.subcategories = categorysubs));
                Category.title(this.id, categoryname => (this.name = categoryname));
            },
            getFilteredData() {
                this.filteredCodes = this.codes;
                if (this.search.trim() !== '') {
                    let res = this.search.trim().split(' ');
                    this.filteredCodes = this.filteredCodes.filter(filCode => {
                        let found = false;
                        res.forEach(obj => {
                           found = found || filCode['title'].toLowerCase().indexOf(obj.toLowerCase()) >= 0 || filCode['details'].toLowerCase().indexOf(obj.toLowerCase()) >= 0;
                        });
                        return found;
                    });
                }
            },
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
