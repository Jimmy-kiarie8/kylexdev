<template>
  <v-layout row justify-center>
    <v-dialog v-model="openAddRequest" persistent max-width="1200px">
      <v-card>
        <v-card-title fixed>
          <span class="headline">Add Next Of Beneficiaries</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-form ref="form" @submit.prevent>
                <v-container grid-list-xl fluid>
                  <v-layout wrap>
                    <div v-for="beneficiary in beneficiaries" class="col-md-12">
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
                  </div>
                  </v-layout>
                    <v-btn flat color="primary" @click="addLine">Add Line</v-btn>
                    <!-- <table class="table table-bordered table-form">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Id Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in form.beneficiaries">
                                <td class="table-name">
                                    <textarea class="table-control" v-model="product.name"></textarea>
                                </td>
                                <td class="table-price">
                                    <input type="text" class="table-control"  v-model="product.price">
                                </td>
                                <td class="table-qty">
                                    <input type="text" class="table-control" v-model="product.qty">
                                </td>
                                <td class="table-total">
                                    <span class="table-text">@{{product.qty * product.price}}</span>
                                </td>
                                <td class="table-remove">
                                    <span @click="remove(product)" class="table-remove-btn">&times;</span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="table-empty" colspan="2">
                                    <span @click="addLine" class="table-add_line">Add Line</span>
                                </td>
                                <td class="table-label">Sub Total</td>
                                <td class="table-amount">{{form.currency}} {{subTotal}}</td>
                            </tr>
                            <tr>
                                <td class="table-empty" colspan="2"></td>
                                <td class="table-label">Discount</td>
                                <td class="table-discount">
                                    <input type="text" class="table-discount_input" v-model="form.discount">
                                </td>
                            </tr>
                            <tr>
                                <td class="table-empty" colspan="2"></td>
                                <td class="table-label">Grand Total</td>
                                <td class="table-amount">{{form.currency}} {{grandTotal}}</td>
                                <td class="table-amount">VAT: {{vat}}</td>
                            </tr>
                        </tfoot>
                    </table> -->
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
          </v-layout>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>
</v-layout>
</template>

<script>
export default {
  props: ['openAddRequest', 'buyers'],
  components: {
  },
  data() {
    const defaultForm = Object.freeze({
      beneficiaries: [{
            name: '',
            price: 0,
            qty: 1
      }],
    })
    return{
      errors: {},
      defaultForm,
      randomNumber: '',
      loading: false,
      form: Object.assign({}, defaultForm),
      rules: {
        name: [val => (val || '').length > 0 || 'This field is required']
      },
    }
  },
  methods: {
    save() {
      this.loading=true
      axios.post('/invoice', this.$data.form).
      then((response) => {
        this.loading=false
        console.log(response);
        // this.close;
        // this.resetForm();
        // this.$emit('closeRequest');
        this.$emit('alertRequest');
        this.$parent.invoices.push(response.data) 

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
  computed: {
   formIsValid () {
     return (
        this.form.invoice_no &&
        this.form.invoice_date &&
        this.form.client &&
        this.form.due_date
      )
   },

   subTotal: function() {
     return this.form.beneficiaries.reduce(function(carry, product) {
       return carry + (parseFloat(product.qty) * parseFloat(product.price));
     }, 0);
   },
   vat: function() {
     return this.grandTotal * parseFloat(0.16);
     // (this.subTotal - parseFloat(this.form.discount)) * parseFloat(0.16);
   },
   grandTotal: function() {
     return this.subTotal - parseFloat(this.form.discount);
   },
   // random() {
  /*  random : {
        get : function() {
          // var num = Math.random()*1000;
          return 'INV_'+numArr;
           // return this.firstName+" "+this.lastName;
        },
        set : function(name) {
          var num = Math.random()*1000;
          var numSplit = name.split(".");
          var numArr = numSplit[0];
           // var fname = name.split(" ");
           // this.firstName = fname[0];
           // this.lastName = fname[1]
          this.form.invoice_no = 'INV_'+numArr;
        }
     }*/
      // var num = Math.random()*1000;
      // var numSplit = num.split(".");
      // var numArr = numSplit[0];
   // }
 },
 mounted() {
 }
}
</script>
