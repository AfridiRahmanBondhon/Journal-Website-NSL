<template>
  <create-form @onSubmit='submit'>
    <div class='row align-items-center'>
        <Input v-model='data.name' field='data.name' title='Name' :req='true' />
				<Input v-model='data.organization_name' field='data.organization_name' title='Organization_name' :req='false' />
				<Input v-model='data.email' field='data.email' title='Email' :req='true' />
				<Input v-model='data.phone' field='data.phone' title='Phone' :req='true' />
				<Input v-model='data.designation' field='data.designation' title='Designation' :req='false' />
				<Input v-model='data.messege' field='data.messege' title='Messege' :req='false' />
<Switch
                v-model='data.status'
                field='data.status'
                title='status'
                on-label='Active'
                off-label='Deactive'
                :req='true'
            ></Switch>

    </div>
    <Button title='Submit' class='mt-5 btn btn2 shadow-none btn-primary aus-btn' process='' />
  </create-form>
</template>

<script>


const model = 'order';

export default {
  
  data() {
    return {
      model: model,
      data: {},
      
    };
  },

  provide() {
    return {
      validate: this.validation,
      
    };
  },
  methods: {
    submit: function (e) {
      this.$validate().then((res) => {
        const error = this.validation.countErrors();

        if (error > 0) {
          console.log(this.validation.allErrors());
          this.$toast(
            'You need to fill ' + error + ' more empty mandatory fields',
            'warning'
          );
          return false;
        }

        if (res) {
          
          
          if (this.data.id) {
            this.update(this.model, this.data, this.data.id,true);
          } else {
            this.store(this.model, this.data);
          }
        }
      });
    },
  },
  created() {
    if (this.$route.params.id) {
      this.setBreadcrumbs(this.model, 'edit');
      this.get_data(`${this.model}/${this.$route.params.id}`);
    } else {
      this.setBreadcrumbs(this.model, 'create');
    }
  },

  validators: {
    'data.name': function (value = null) { return Validator.value(value).required('Name is required');},
		'data.organization_name': function (value = null) { return Validator.value(value).minLength(3).maxLength(50);},
		'data.email': function (value = null) { return Validator.value(value).required('Email is required');},
		'data.phone': function (value = null) { return Validator.value(value).required('Phone is required');},
				
  },
}

</script>