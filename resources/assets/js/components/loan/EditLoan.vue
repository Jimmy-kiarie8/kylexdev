<template>
  <v-layout row justify-center>
    <v-dialog v-model="openEditRequest" persistent max-width="900px">
      <v-card>
        <v-card-title fixed>
          <span class="headline">Edit {{editedItemCon.name}}</span>
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
                                        v-model="editedItemCon.name"
                                        :rules="rules.name"
                                        color="blue darken-2"
                                        label="Full name"
                                        required
                                        ></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                     </v-flex>
                                     <v-flex xs12 sm6>
                                        <v-text-field
                                        v-model="editedItemCon.client_no"
                                        color="blue darken-2"
                                        label="Client Number"
                                        required
                                        ></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                     </v-flex>
                                     <v-flex xs12 sm6>
                                        <v-text-field
                                        v-model="editedItemCon.email"
                                        :rules="emailRules"
                                        color="blue darken-2"
                                        label="Email"
                                        required
                                        ></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small> -->
                                     </v-flex>
                                     <v-flex xs12 sm6>
                                        <v-text-field
                                        v-model="editedItemCon.id_no"
                                        color="blue darken-2"
                                        label="Id Number"
                                        required
                                        ></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.id_no">{{ errors.id_no[0] }}</small> -->
                                     </v-flex>
                                     <v-flex xs12 sm6>
                                        <v-text-field
                                        v-model="editedItemCon.address"
                                        :rules="rules.name"
                                        color="blue darken-2"
                                        label="Address"
                                        required
                                        ></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.address">{{ errors.address[0] }}</small> -->
                                     </v-flex>
                                     <v-flex xs12 sm6>
                                        <v-text-field
                                        v-model="editedItemCon.pin"
                                        color="blue darken-2"
                                        label="Pin"
                                        required
                                        ></v-text-field>
                                        <!-- <small class="has-text-danger" v-if="errors.city">{{ errors.city[0] }}</small> -->
                                     </v-flex>
                                     <v-flex xs12 sm6>
                                        <v-text-field
                                        v-model="editedItemCon.phone"
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
                                <!-- <v-btn flat @click="resetForm">reset</v-btn> -->
                                <v-btn flat @click="close">Close</v-btn>
                                <v-spacer></v-spacer>
                                <v-btn
                                :disabled="loading"
                                :loading="loading"
                                flat
                                color="primary"
                                @click="update"
                                >Submit</v-btn>
                             </v-card-actions>
                          </v-form>
                        </v-card>
                      </v-tab-item>

                      <v-tab-item>
                        <v-card flat>
                              <v-form ref="form" @submit.prevent>
                                <v-container grid-list-xl fluid>
                                    <div v-for="beneficiary in editedItemCon.noks" class="col-md-12">
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
                                <!-- <v-btn flat @click="resetForm">reset</v-btn> -->
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
  props: ['editedItemCon', 'openEditRequest'],
  data() {
    return{
      loader: false,
      loading:false,
      list: {},
      tab: null,
      items: [
        'Details', 'Next Of Kin'
      ],
      emailRules: [
        v => {
          return !!v || 'E-mail is required'
        },
        v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
      ],
      rules: {
        name: [val => (val || '').length > 0 || 'This field is required']
      },
    }
  },
  methods: {
    update() {
      this.loading=true
      axios.patch(`/clients/${this.editedItemCon.id}`, this.editedItemCon)
      .then((response) => {
            this.loading=false
            this.close;
            this.$emit('alertRequest');
            this.$emit('closeRequest');
            Object.assign(this.$parent.AllClient[this.$parent.editedIndex], this.$parent.editedItem)

      })
      .catch((error) => {
      this.errors = error.response.data.errors
      this.loading=false
    })
    },
     addNext() {
     this.loading=true
     axios.post(`/updateNok/${this.currentClient.id}`, this.$data.form).
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
    close() {
      this.$emit('closeRequest')
    },

addLine: function() {
  this.editedItemCon.noks.push({name: '', phone: '', address: '', id_no: ''});
},
remove: function(product) {
  const index = this.form.beneficiaries.indexOf(product)
  this.editedItemCon.noks.splice(index, 1);
  // this.form.beneficiaries.$remove(product);
},
  },
  mounted() {

  }
}
</script>
