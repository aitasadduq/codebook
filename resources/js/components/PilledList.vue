<template>
    <ul class="list-group">
        <pilled-list-item
            v-for="category in categories"
            :text="category[title]"
            :link="link"
            :pill-text="pillText"
            :pill-link="pillLink"
        ></pilled-list-item>
    </ul>
</template>

<script>
    import PilledListItem from './PilledListItem.vue';

    export default {
        props: {
            categories: { default: {} },
            link: { required: true },
            pillText: { required: true },
            pillLink: { required: true }
        },
        components: { PilledListItem },
    };
</script>
