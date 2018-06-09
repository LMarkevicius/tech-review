require('./bootstrap');

import Vue from 'vue'

Vue.component('products', require('./components/Products.vue'));
Vue.component('one-product', require('./components/OneProduct.vue'));
Vue.component('pagination', require('./components/Pagination.vue'));

var app = new Vue({
  el: '#app',

  data: {
    products: [],
    pagination: {
      total: 0,
      per_page: 2,
      from: 1,
      to: 0,
      current_page: 1
    },
    offset: 4,
    // sortKey: ''
  },
  created() {
    // this.getProducts(this.pagination.current_page)
    this.getAll(this.pagination.current_page, '')
  },
  methods: {
    getProducts(page) {
      axios.get('/vue/api?page='+page).then(response => {
        this.products = response.data.data.data;
        this.pagination = response.data.pagination;
      });
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
    // changePage(page) {
    //   this.pagination.current_page = page;
    //   this.getProducts(page);
    // }
  }
})
