<template>
  <v-layout row justify-center>
    <v-dialog v-model="openAddRequest" persistent max-width="700px">
      <v-card>
        <v-card-title fixed>
          <span class="headline">Add Receipt</span>
       </v-card-title>
       <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
               <v-card-text>
                <v-form ref="form" @submit.prevent>
                  <v-container grid-list-xl fluid>
                    <v-layout wrap>
                      <v-flex xs12 sm6>
                        <v-text-field
                        v-model="form.receipt_no"
                        :rules="rules.name"
                        color="blue darken-2"
                        label="Receipt Number"
                        required
                        ></v-text-field>
                        <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                     </v-flex>
                     <v-flex xs12 sm6>
                        <v-text-field
                        v-model="form.receipt_date"
                        color="blue darken-2"
                        label="Receipt Date"
                        type="date"
                        required
                        ></v-text-field>
                        <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                     </v-flex>
                     <v-flex xs12 sm6>
                        <v-text-field
                        v-model="form.amount"
                        color="blue darken-2"
                        label="Amount"
                        required
                        ></v-text-field>
                        <!-- <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small> -->
                     </v-flex>
                     <v-flex xs12 sm6>
                        <v-text-field
                        v-model="form.period"
                        color="blue darken-2"
                        label="Period"
                        required
                        ></v-text-field>
                        <!-- <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small> -->
                     </v-flex>
                     <v-flex xs12>
                         <v-textarea
                           v-model="form.remarks"
                           color="blue"
                         >
                           <div slot="label">
                             Remark
                           </div>
                         </v-textarea>
                      </v-flex>
                     
                     <div class="form-group col-md-6">
                       <label for="password" class="col-md-8 col-form-label text-md-right">Member Name</label>
                       <div class="col-md-12">
                           <select class="custom-select" v-model="form.client_id">
                             <option v-for="client in clients" data-subtext="" :value="client.client_id">{{client.name}}</option>
                           </select>
                       </div>
                     </div>
                     <div class="form-group col-md-6">
                       <label for="password" class="col-md-8 col-form-label text-md-right">Account</label>
                       <div class="col-md-12">
                           <select class="custom-select" v-model="form.account">
                             <option data-subtext="" value="Savings">Savings</option>
                             <option data-subtext="" value="mpesa">mpesa</option>
                           </select>
                       </div>
                     </div>
                     <div class="form-group col-md-6">
                       <label for="password" class="col-md-8 col-form-label text-md-right">Payment Mode</label>
                       <div class="col-md-12">
                           <select class="custom-select" v-model="form.payment_mode">
                             <option data-subtext="" value="Cash">Cash</option>
                             <option data-subtext="" value="Check">Check</option>
                             <option data-subtext="" value="Mpesa">Mpesa</option>
                             <option data-subtext="" value="EFT">EFT</option>
                           </select>
                       </div>
                     </div><div class="form-group col-md-6">
                       <label for="password" class="col-md-8 col-form-label text-md-right">Payment Type</label>
                       <div class="col-md-12">
                           <select class="custom-select" v-model="form.payment_type">
                             <option data-subtext="" value="Principal">Principal</option>
                             <option data-subtext="" value="interest">interest</option>
                             <option data-subtext="" value="Savings">Savings</option>
                             <option data-subtext="" value="Charges">Charges</option>
                             <option data-subtext="" value="Insurance">Insurance</option>
                           </select>
                       </div>
                     </div>
                  </v-layout>
               </v-container>
               <v-card-actions>
                <v-btn flat @click="resetForm">reset</v-btn>
                <v-btn flat @click="close">Close</v-btn>
                <v-spacer></v-spacer>
                <v-btn
                :disabled="loading"
                :loading="loading"
                flat
                color="primary"
                @click="save"
                >Submit</v-btn>
             </v-card-actions>
          </v-form>
       </v-card-text>
 </v-layout>
</v-container>
</v-card-text>
</v-card>
</v-dialog>
</v-layout>
</template>

<script>
export default {
  props: ['openAddRequest', 'clients'],
  components: {
  },
  data() {
   const defaultForm = Object.freeze({
     name: '',
     remarks: '',
     payment_type: '',
     payment_mode: '',
     account: '',
     receipt_date: '',
     amount: '',
     client_id: '',
     period: '',
     })
   return{
      errors: {},
      defaultForm,
      loading: false,
      active: null,
      form: Object.assign({}, defaultForm),
      emailRules: [
      v => {
       return !!v || 'E-mail is required'
    },
    v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
    ],
    rules: {
     age: [
     val => val < 10 || `I don't believe you!`
     ],
     name: [val => (val || '').length > 0 || 'This field is required']
  },
}
},
methods: {
   next () {
     const active = parseInt(this.active)
     this.active = (active < 2 ? active + 1 : 0)
  },
  save() {
   this.loading=true
   axios.post('/receipts', this.$data.form).
   then((response) => {
     this.loading=false
     console.log(response);
        // this.close;
        // this.resetForm();
        // this.$emit('closeRequest');
        this.$emit('alertRequest');
        this.$parent.AllRecepts.push(response.data) 

     })
   .catch((error) => {
     this.loading=false
     this.errors = error.response.data.errors
  })
},
resetForm () {
  this.form = Object.assign({}, this.defaultForm)
  this.$refs.form.reset()
},
close() {
   this.$emit('closeRequest')
},
},
mounted() {
},
computed: {
   formIsValid () {
     return (
       this.form.name &&
       this.form.phone 
       )
  },
},
}
</script>
