<template>
    <div>
        <div class="text-center"><h1>Latest {{ name }} Codes</h1></div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <a style="width: 100%" class="btn btn-primary" href="/codes/create">Add New Code</a>
                <div><br></div>
                <h5>Select Section</h5>
                <div class="dropdown">
                    <select v-model="category_id" style="width: 100%;" class="btn btn-primary dropdown-toggle">
                        <option value="-1">All Sections</option>
                        <option v-for="cat in categories" :value="cat['id']">{{ cat['title'] }}</option>
                    </select>
                </div>
                <br>
                <form v-on:submit="getFilteredData">
                    <div class="form-row">
                        <input type="text" class="form-control" placeholder="Search..."
                            v-model="search" v-on:keyup="getFilteredData">
                    </div>
                </form>
                <br>
                <!-- <div v-show="category_id != '-1'" class="card"> -->
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">Categories</h3>
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
                <div v-show="selectedFilters.length > 0">
                    <div style="display: inline;" v-for="fil in selectedFilters">
                        <h6 style="display: inline;"><span class="btn btn-primary btn-lg badge badge-pill"><button style="color: yellow;" class="btn btn-primary btn-sm" @click="removeItem(fil['id'])"><i class="fa fa-close"></i></button> {{ fil['title'] }}</span></h6>
                        <p style="display: inline;">  </p>
                    </div>
                    <h1></h1>
                </div>
                <div>
                    <my-code
                        :my-code="mycode"
                        :selected-filters="selectedFilters"
                        v-for="mycode in filteredCodes"
                    ></my-code>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Category from '../models/Category.js';
    import MyCode from './MyCode.vue';

    export default {
        props: {
            categories: { required: true },
        },
        data() {
            return {
                category_id: '-1',
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
                    filters.push(element.value);
                });
                return filters;
            }
        },
        methods: {
            loadData(item_id) {
                if (item_id == '-1') {
                    Category.allCodes(categorycodes => (this.codes = categorycodes));
                    Category.allCodes(categorycodes => (this.filteredCodes = categorycodes));
                    Category.allSubcategories(subs => (this.subcategories = subs));
                    this.name = '';
                } else {
                    Category.codes(item_id, categorycodes => (this.codes = categorycodes));
                    Category.codes(item_id, categorycodes => (this.filteredCodes = categorycodes));
                    Category.subcategories(item_id, categorysubs => (this.subcategories = categorysubs));
                    Category.title(item_id, categoryname => (this.name = categoryname));
                }
            },
            getFilteredData() {
                this.filteredCodes = this.codes;
                if (this.search.trim() !== '') {
                    let res = this.search.trim().split(' ');
                    this.filteredCodes = this.filteredCodes.filter(filCode => {
                        let found = false;
                        res.forEach(obj => {
                           found = found || filCode['title'].toLowerCase().indexOf(obj.toLowerCase()) >= 0 || filCode['details'].toLowerCase().indexOf(obj.toLowerCase()) >= 0 || filCode['code'].toLowerCase().indexOf(obj.toLowerCase()) >= 0;
                        });
                        return found;
                    });
                }
            },
            removeItem(item) {
                this.subcategories.forEach(sub => {
                    if (sub.value['id'] == item) sub.checked = false;
                });
            },
        },
        created() {
            this.loadData('-1');
        },
        watch: {
            category_id (to, from) {
                this.loadData(this.category_id);
                this.search = '';
            }
        },
        components: { MyCode },
    };
</script>
