<template lang="html">
  <div class="">
    <div class="form-group">
      <input type="text" v-model="searchString" placeholder="Search for Products" class="form-control">
    </div>

    <button class="btn btn-success">Search</button>

    <button class="btn btn-primary" @click="getAll(1, 'name')">Sort By Name</button>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th><a href="#" @click="orderBy">Name</a></th>
          <th><a href="#" @click="orderBy">Description</a></th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        <one-product v-for="product in filteredProducts" :product="product"></one-product>
      </tbody>
    </table>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        // product: [],
        searchString: '',
        pagination: {
          total: 0,
          per_page: 2,
          from: 1,
          to: 0,
          current_page: 1
        },
        offset: 4,
        // sortKey: ''
      }
    },
    props: ['products'],
    computed: {
      filteredProducts: function() {
        var products_array = this.products,
            searchString   = this.searchString;

        if (!searchString) {
          return products_array;
        }

        searchString = searchString.trim().toLowerCase();

        products_array = products_array.filter(function(item) {
          if (item.name.toLowerCase().indexOf(searchString) !== -1) {
            return item;
          } else if (item.description.toLowerCase().indexOf(searchString) !== -1) {
            return item;
          }
        })

        return products_array;
      }
    },
    methods: {
      orderBy: function() {
        return this.products.reverse()
      },
      getAll(page, sort) {
        if(sort == 'name') {
          axios({
            method: 'get',
            url: '/vue/api',
            data: {
              sortBy: 'Name'
            }
          }).then(response => {
            axios.get('/vue/api?page='+page).then(response => {
              this.products = response.data.data.data;
              this.pagination = response.data.pagination;
            });
          });
        }
      }
    }
  }
</script>

<style lang="css">
</style>
