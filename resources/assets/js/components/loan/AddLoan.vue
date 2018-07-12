<template>
  <v-layout row justify-center>
    <v-dialog v-model="openAddRequest" persistent max-width="1000px">
      <v-card>
        <v-card-title fixed>
          <span class="headline">Add Loan</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
             <v-card flat>
               <v-card-text>

                <!-- Tabs -->
                <div>
                  <v-toolbar color="indigo" dark tabs>
                    <v-tabs
                    v-model="tab"
                    color="indigo"
                    align-with-title
                    >
                    <v-tabs-slider color="yellow"></v-tabs-slider>

                    <v-tab v-for="item in items" :key="item">
                      {{ item }}
                    </v-tab>
                  </v-tabs>
                </v-toolbar>

                <v-tabs-items v-model="tab">
                  <v-tab-item>
                    <v-card flat>
                      <v-form ref="form" @submit.prevent>
                        <v-container grid-list-xl fluid>
                          <v-layout wrap>
                            <div class="form-group col-md-6">
                              <label for="password" class="col-md-8 col-form-label text-md-right">Member</label>
                              <div class="col-md-12">
                                  <select class="custom-select" v-model="form.id">
                                    <option v-for="client in clientsDetails" data-subtext="" :value="client.id">{{client.name}}</option>
                                  </select>
                              </div>
                            </div>

                            <div class="form-group col-md-6">
                              <label for="password" class="col-md-8 col-form-label text-md-right">Purpose</label>
                              <div class="col-md-12">
                                  <select class="custom-select" v-model="form.loan_type">
                                     <option data-subtext="" value="Holiday">Holiday</option>
                                     <option data-subtext="" value="Emergency">Emergency</option>
                                     <option data-subtext="" value="School Fees">School Fees</option>
                                   </select>
                              </div>
                            </div>
                            <v-flex xs12 sm6>
                              <v-text-field
                              v-model="form.loan_id"
                              color="blue darken-2"
                              label="Loan Id"
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
                              <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                            </v-flex>
                            <v-flex xs12 sm6>
                              <v-text-field
                              v-model="form.interest_rate"
                              color="blue darken-2"
                              label="Interest Rate"
                              required
                              ></v-text-field>
                              <!-- <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small> -->
                            </v-flex>
                            <v-flex xs12 sm6>
                              <v-text-field
                              v-model="form.repayment_period"
                              color="blue darken-2"
                              label="Repayment Period"
                              required
                              ></v-text-field>
                              <!-- <small class="has-text-danger" v-if="errors.id_no">{{ errors.id_no[0] }}</small> -->
                            </v-flex>
                            <v-flex xs12 sm6>
                              <v-text-field
                              v-model="form.application_date"
                              color="blue darken-2"
                              label="Application Date"
                              type="date"
                              ></v-text-field>
                              <!-- <small class="has-text-danger" v-if="errors.address">{{ errors.address[0] }}</small> -->
                            </v-flex>
                            <v-flex xs12 sm6>
                              <v-text-field
                              v-model="form.pin"
                              color="blue darken-2"
                              label="Pin"
                              required
                              ></v-text-field>
                              <!-- <small class="has-text-danger" v-if="errors.city">{{ errors.city[0] }}</small> -->
                            </v-flex>
                            <v-flex xs12 sm6>
                              <v-text-field
                              v-model="form.phone"
                              :rules="rules.name"
                              color="blue darken-2"
                              label="Phone"
                              required
                              ></v-text-field>
                              <!-- <small class="has-text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small> -->
                            </v-flex>
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
                    </v-card>
                  </v-tab-item>

                  <v-tab-item>
                    <v-card flat>
                      <v-form ref="form" @submit.prevent>
                        <v-container grid-list-xl fluid>
                            <div class="form-group col-md-6">
                              <label for="password" class="col-md-8 col-form-label text-md-right">Member</label>
                              <div class="col-md-12">
                                  <select class="custom-select" v-model="form.id">
                                    <option v-for="client in clientsDetails" data-subtext="" :value="client.id">{{client.name}}</option>
                                  </select>
                              </div>
                            </div>
                            <div v-for="client in clientsDetails" v-if="client.id === form.id">
                          <v-layout wrap>
                            <v-flex xs12 sm6>
                              <v-text-field
                              v-model="client.amount"
                              :rules="rules.name"
                              color="blue darken-2"
                              label="Amount"
                              required
                              ></v-text-field>
                              <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                            </v-flex>

                            <v-flex xs12 sm6>
                              <v-text-field
                              v-model="client.loan_id"
                              :rules="rules.name"
                              color="blue darken-2"
                              label="Loan Id"
                              required
                              ></v-text-field>
                              <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                            </v-flex>
                            <v-flex xs12 sm6>
                              <v-text-field
                              v-model="client.name"
                              :rules="rules.name"
                              color="blue darken-2"
                              label="Full name"
                              disabled
                              required
                              ></v-text-field>
                              <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                            </v-flex>
                          </v-layout>
                          <v-layout>
                            <div v-for="referee in referees">
                              <div class="form-group col-md-6">
                                <label for="password" class="col-md-8 col-form-label text-md-right">Member</label>
                                <div class="col-md-12">
                                    <select class="custom-select" v-model="form.id">
                                      <option v-for="client in clientsDetails" data-subtext="" :value="client.id">{{client.name}}</option>
                                    </select>
                                </div>
                              </div>       
                              <div v-for="client in clientsDetails" v-if="client.id === form.id">
                                <v-flex xs12 sm6>
                                  <v-text-field
                                  v-model="client.name"
                                  :rules="rules.name"
                                  color="blue darken-2"
                                  label="Full name"
                                  disabled
                                  required
                                  ></v-text-field>
                                  <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                </v-flex>  
                              </div>  
                            </div>                 
                          </v-layout>
                          <v-divider></v-divider>
                          <v-btn @click="addLine" flat color="orange">Add New</v-btn>
                            </div>
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
                          @click="addNext"
                          >Submit</v-btn>
                        </v-card-actions>
                      </v-form>
                    </v-card>
                  </v-tab-item>
                </v-tabs-items>
              </div>
              <!-- Tabs -->
            </v-card-text>
          </v-card>
        </v-layout>
      </v-container>
    </v-card-text>
  </v-card>
</v-dialog>
</v-layout>
</template>

<script>
export default {
  props: ['openAddRequest', 'clients', 'clientsDetails'],
  components: {
  },
  data() {
   const defaultForm = Object.freeze({
     repayment_period: '',
     application_date: '',
     loan_type: '',
     loan_id: null,
     interest_rate: '',
   })
   return{
    referees: [{
      name: '',
      id_no: '',
      amount: '',

    }],
    tab: null,
    items: [
    'Details', 'Referees'
    ],
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
     name: [val => (val || '').length > 0 || 'This field is required'],
   },
   currentClient: {},
 }
},
methods: {
 next () {
   const active = parseInt(this.active)
   this.active = (active < 2 ? active + 1 : 0)
 },
 save() {
   this.loading=true
   axios.post(`/loans/${this.form.id}`, this.$data.form).
   then((response) => {
      this.tab = this.tab+1
      this.client.loan_id = this.form.loan_id
      this.loading=false
      // console.log(response);
      // this.close;
      // this.resetForm();
      // this.$emit('closeRequest');
      this.currentClient = response.data
      this.$emit('alertRequest');
      this.$parent.AllClient.push(response.data) 

      })
   .catch((error) => {
     this.loading=false
     this.errors = error.response.data.errors
   })
 },
 addNext() {
   this.loading=true
   axios.post(`/referee/${this.form.id}`, this.$data.client).
   then((response) => {
     this.loading=false
     console.log(response);
        // this.close;
        // this.resetForm();
        // this.$emit('closeRequest');
        this.$emit('alertRequest');
        this.$parent.AllClient.push(response.data) 

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

addLine: function() {
  this.referees.push({name: '', id_no: '', amount: ''});
},
remove: function(product) {
  const index = this.referees.indexOf(product)
  this.referees.splice(index, 1);
  // this.form.referee.$remove(product);
},
},
mounted() {
},
computed: {
 formIsValid () {
   return (
     this.form.repayment_period &&
     this.form.application_date &&
     this.form.loan_type &&
     this.form.interest_rate &&
     this.form.loan_id
     )
 },
},
}
</script>
