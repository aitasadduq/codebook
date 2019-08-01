<template>
    <div>
        <form method="POST" :action="formAction">
            <input type="hidden" :value="csrfToken" name="_token"/>
            <input type="hidden" name="code_id" value="0">
            <div class="row">
                <div class="col-md-3">
                    <h3>Select Section</h3>
                    <div class="dropdown">
                        <select v-model="category_id" style="width: 100%;" class="btn btn-primary dropdown-toggle">
                            <option v-for="cat in categories" :value="cat['id']">{{ cat['title'] }}</option>
                        </select>
                    </div>
                    <div><br></div>
                    <h3>Select Categories</h3>
                    <ul class="list-group text-left">
                        <li
                        v-for="sub in subcategories"
                        class="list-group-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" :name="sub.value['id']" :id="sub.value['id']">
                                <label class="form-check-label" :for="sub.value['id']">{{ sub.value['title'] }}</label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 box">
                    <div class="form-group text-left">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title">
                    </div>
                    <div class="form-group text-left">
                        <label for="details">Details</label>
                        <textarea class="form-control" name="details"></textarea>
                    </div>
                    <div class="form-group text-left">
                        <label for="code">Code</label>
                        <textarea style="height: 300px" data-editor="php" class="form-control" name="code"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit" value="Add Code">
            </div>
        </form>
    </div>
</template>

<script>
    import Category from '../models/Category.js';

    export default {
        props: {
            categories: { required: true },
            defaultCategory: { required: true },
        },
        data() {
            return {
                category_id: '',
                subcategories: [],
                csrfToken: null,
            };
        },
        computed: {
            formAction() {
                return '/categories/' + this.category_id + '/codes';
            },
        },
        created() {
            this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            this.category_id = this.defaultCategory;
            Category.subcategories(this.defaultCategory, subs => (this.subcategories = subs));
        },
        watch: {
            category_id (to, from) {
                Category.subcategories(this.category_id, subs => (this.subcategories = subs));
            },
        },
    };
</script>
