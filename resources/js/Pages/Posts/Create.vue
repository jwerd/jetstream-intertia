<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Post</h2>
        </template>
        
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <create-post-form class="mt-10 sm:mt-0" />

                <jet-section-border />
            </div>
        </div>
    </app-layout>
</template>
<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from './../../Jetstream/Welcome'
    import CreatePostForm from './CreatePostForm'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    export default {
        components: {
            AppLayout,
            Welcome,
            CreatePostForm,
            JetSectionBorder
        },
        props: ['data', 'errors'],
        data() {
            return {
            }
        },
        methods: {
        }
    }
</script>