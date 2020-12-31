<template>
    <div>
      <div class="mb-6 flex justify-between items-center">
        <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
          <label class="block text-gray-700">Trashed:</label>
          <select v-model="form.trashed" class="mt-1 w-full form-select">
            <option :value="null" />
            <option value="with">With Trashed</option>
            <option value="only">Only Trashed</option>
          </select>
        </search-filter>
        <inertia-link class="btn-indigo" :href="route('posts.create')">
          <span>Create</span>
          <span class="hidden md:inline">Post</span>
        </inertia-link>
      </div>
          <div class="bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">#</th>
          <th class="px-6 pt-6 pb-4">Title</th>
          <th class="px-6 pt-6 pb-4">Body</th>
        </tr>
        <tr v-for="row in data.data" :key="row.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <img src="https://place-hold.it/100x100" />
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('posts.edit', row.id)">
              {{ row.title }}
              <icon v-if="row.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
            </inertia-link>
          </td>
          <td class="border-t">
            <inertia-link class="px-6 py-4 flex items-center" :href="route('posts.edit', row.id)" tabindex="-1">
              {{ row.body }}
            </inertia-link>
          </td>
          <td class="border-t w-px">
            <inertia-link class="px-4 flex items-center" :href="route('posts.edit', row.id)" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </inertia-link>
          </td>
        </tr>
        <tr v-if="data.length === 0">
          <td class="border-t px-6 py-4" colspan="4">No posts found.</td>
        </tr>
      </table>
    </div>
    <pagination :links="data.links" />
    </div>
</template>
<script>
    import Pagination from '../../Shared/Pagination'
    import Icon from '../../Shared/Icon'
    import SearchFilter from '../../Shared/SearchFilter'
    import throttle from 'lodash/throttle'
    import pickBy from 'lodash/pickBy'
    import mapValues from 'lodash/mapValues'

    export default {
        components: {
            Pagination,
            Icon,
            SearchFilter
        },
        props: ['data', 'errors', 'filters'],
        data() {
            return {
                form: {
                  search: '',
                  trashed: ''
                },
                order: {
                  orderColumn: 'id',
                  orderDirection: 'desc'
                },
                columns: ["photo", "title"],
                editMode: false,
                isOpen: false
            }
        },
        watch: {
          form: {
            handler: throttle(function() {
              let query = pickBy(this.form)
              this.$inertia.replace(this.route('posts.index', Object.keys(query).length ? query : { remember: 'forget' }))
            }, 150),
            deep: true,
          },
        },
        methods: {
            reset() {
              this.form = mapValues(this.form, () => null)
            },
            show(post) {
                this.$inertia.get('/posts/' + post.id + '/edit');
            }
        }
    }
</script>