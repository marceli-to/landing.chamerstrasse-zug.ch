export default {

  methods: {

    // Show the validation errors
    validationError() {
      this.$notify({
        type: 'error',
        text: 'Please check marked fields!'
      });
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    },

    // Remove error classes
    removeError(field) {
      this.errors[field] = false;
    },
  }
};
