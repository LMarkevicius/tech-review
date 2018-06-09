<template lang="html">
  <tr>
    <td></td>
    <td>{{ product.name }}</td>
    <td>{{ product.description.replace(/<(?:.|\n)*?>/gm, '').substr(0,50) }}{{ product.description.replace(/<(?:.|\n)*?>/gm, '').length > 50 ? "..." : '' }}</td>
    <td>{{ product.created_at }}</td>
    <td></td>
  </tr>
</template>

<script>
  export default {
    props: ['product']
  }
</script>

<style lang="css">
</style>
