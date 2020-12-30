<template>
    <jet-form-section @submitted="updatePost">
        <template #title>
            Post
        </template>

        <template #description>
            Update your post
        </template>

        <template #form>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="title" value="Title" />
                <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" autocomplete="title" />
                <jet-input-error :message="form.error('title')" class="mt-2" />
            </div>

            <!-- Body -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="body" value="Body" />
                <jet-input id="body" type="body" class="mt-1 block w-full" v-model="form.body" />
                <jet-input-error :message="form.error('body')" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['post'],

        data() {
            return {
                form: this.$inertia.form({
                    '_method': 'PUT',
                    id: this.post.id,
                    title: this.post.title,
                    body: this.post.body,
                }, {
                    bag: 'updatePost',
                    resetOnSuccess: false,
                })
            }
        },

        methods: {
            updatePost() {
                this.form.post(`/posts/${this.post.id}`, {
                    preserveScroll: true
                });
            }
        },
    }
</script>
