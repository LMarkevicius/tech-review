<template lang="html">
  <nav>
    <ul class="pagination">
      <li v-if="pagination.current_page > 1">
        <a href="#" aria-label="Previous"
          @click.prevent="changePage(pagination.current_page - 1)">
          <span aria-hidden="true">Previous</span>
        </a>
      </li>

      <li v-for="page in pagesNumber"
        v-bind:class="[ page == isActivated ? 'active' : '']">
        <a href="#"
          @click.prevent="changePage(page)">{{ page }}</a>
      </li>

      <li v-if="pagination.current_page < pagination.last_page">
        <a href="#" aria-label="Next"
          @click.prevent="changePage(pagination.current_page + 1)">
          <span aria-hidden="true">Next</span>
        </a>
      </li>
    </ul>
  </nav>
</template>

<script>
  export default {
    props: {
      pagination: {
          type: Object,
          required: true
      },
      offset: {
          type: Number,
          default: 4
      }
    },

    computed: {
      isActivated: function () {
        return this.pagination.current_page;
      },
      pagesNumber: function () {
        if (!this.pagination.to) {
          return [];
        }
        var from = this.pagination.current_page - this.offset;
        if (from < 1) {
          from = 1;
        }
        var to = from + (this.offset * 2);
        if (to >= this.pagination.last_page) {
          to = this.pagination.last_page;
        }
        var pagesArray = [];
        while (from <= to) {
          pagesArray.push(from);
          from++;
        }
        return pagesArray;
      }
    },
    created() {
      this.getProducts(this.pagination.current_page)
    },
    methods: {
      getProducts(page) {
        axios.get('/vue/api?page='+page).then(response => {
          this.products = response.data.data.data;
          this.pagination = response.data.pagination;
        });
      },
      changePage(page) {
        this.pagination.current_page = page;
        this.getProducts(page);
      }
    }
  }
</script>

<style lang="css">
</style>
