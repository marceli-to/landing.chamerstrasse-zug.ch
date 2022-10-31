<template>
  <div>
    <page-header />
    <apartement-form type="create"></apartement-form>
  </div>
</template>
<script>
import PageHeader from '@/layout/PageHeader.vue';
import ApartementForm from '@/components/apartement/form.vue';
  export default {
    components: {
      PageHeader: PageHeader,
      ApartementForm: ApartementForm
    }
  }
</script>