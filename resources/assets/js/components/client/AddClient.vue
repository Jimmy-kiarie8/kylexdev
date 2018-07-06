<template>
  <v-layout row justify-center>
    <v-dialog v-model="openAddRequest" persistent max-width="900px">
      <v-card>
        <v-card-title fixed>
          <span class="headline">Add Client</span>
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
                        slot="extension"
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
                                      <v-flex xs12 sm6>
                                        <v-text-field
                                        v-model="form.name"
                                        :rules="rules.name"
                                        color="blue darken-2"
                                        label="Full name"
                                        required
                                        ></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                     </v-flex>
                                     <v-flex xs12 sm6>
                                        <v-text-field
                                        v-model="form.client_no"
                                        color="blue darken-2"
                                        label="Client Number"
                                        required
                                        ></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                     </v-flex>
                                     <v-flex xs12 sm6>
                                        <v-text-field
                                        v-model="form.email"
                                        :rules="emailRules"
                                        color="blue darken-2"
                                        label="Email"
                                        required
                                        ></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small> -->
                                     </v-flex>
                                     <v-flex xs12 sm6>
                                        <v-text-field
                                        v-model="form.id_no"
                                        color="blue darken-2"
                                        label="Id Number"
                                        required
                                        ></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.id_no">{{ errors.id_no[0] }}</small> -->
                                     </v-flex>
                                     <v-flex xs12 sm6>
                                        <v-text-field
                                        v-model="form.address"
                                        :rules="rules.name"
                                        color="blue darken-2"
                                        label="Address"
                                        required
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
                                    <div v-for="beneficiary in form.beneficiaries" class="col-md-12">
                                  <v-layout wrap>
                                    <v-flex xs12 sm6>
                                       <v-text-field
                                       v-model="beneficiary.name"
                                       :rules="rules.name"
                                       color="blue darken-2"
                                       label="Name"
                                       required
                                       ></v-text-field>
                                       <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                       <v-text-field
                                       v-model="beneficiary.phone"
                                       color="blue darken-2"
                                       label="Phone Number"
                                       required
                                       ></v-text-field>
                                       <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                       <v-text-field
                                       v-model="beneficiary.address"
                                       color="blue darken-2"
                                       label="Address"
                                       required
                                       ></v-text-field>
                                       <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                       <v-text-field
                                       v-model="beneficiary.id_no"
                                       color="blue darken-2"
                                       label="Id Number"
                                       required
                                       ></v-text-field>
                                       <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                    </v-flex>
                                  </v-layout>
                                  <v-divider></v-divider>
                                  <v-divider></v-divider>
                                  </div>
                                    <v-btn flat color="primary" @click="addLine">Add New</v-btn>
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
  props: ['openAddRequest', 'Showrole'],
  components: {
  },
  data() {
   const defaultForm = Object.freeze({
     name: '',
     password: '',
     email: '',
     phone: null,
     client_no: '',
     id_no: '',
     beneficiaries: [{
           name: '',
           id_no: '',
           phone: '',
           address: '',
     }],
     })
   return{
    tab: null,
    items: [
      'Details', 'Next Of Kin'
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
   axios.post('/clients', this.$data.form).
   then((response) => {
     this.loading=false
     console.log(response);
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
   axios.post(`/saveNok/${this.currentClient.id}`, this.$data.form).
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
  this.form.beneficiaries.push({name: '', phone: '', address: '', id_no: ''});
},
remove: function(product) {
  const index = this.form.beneficiaries.indexOf(product)
  this.form.beneficiaries.splice(index, 1);
  // this.form.beneficiaries.$remove(product);
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
