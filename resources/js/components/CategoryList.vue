<template>
    <div class="row">
        <category-details
            v-for="category in categories"
            :id="category['id']"
            :title="category['title']"
            :description="category['description']"
            :primary-button-text="primaryButtonText"
        ></category-details>
    </div>
</template>

<script>
    import CategoryDetails from './CategoryDetails.vue';

    export default {
        props: {
            categories: { default: {} },
            primaryButtonText: { required: true },
        },
        components: { CategoryDetails },
    }
</script>
