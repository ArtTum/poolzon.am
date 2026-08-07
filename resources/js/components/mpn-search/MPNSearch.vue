<template>
    <section>
        <div class="kt-subheader  kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Mpn Search</h3>
                    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                </div>

            </div>
        </div>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-xl-8">
                    <!--begin:: Widgets/Sale Reports-->
                    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                         viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                            <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2"
                                                  rx="1"/>
                                        </g>
                                    </svg>
                                    Speed Lister

                                </h3>
                            </div>

                        </div>
                        <div class="kt-portlet__body">
                            <form class="kt-form">
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <label for="mpn-search" class="col-xl-2 col-lg-2 col-form-label">Base
                                            MPN</label>
                                        <div class="col-lg-10 col-xl-10">
                                            <input id="mpn-search" class="form-control" type="text" v-model="searchMpn"
                                                   placeholder="Enter MPN" @blur="MPNSearch" :disabled="mpn_length">
                                            <span id="brand-name" class="form-text text-muted" ref="brandName">{{ allReturnSearchMpn.brand}} {{ allReturnSearchMpn.desc}}</span>
                                            <span id="qtys" class="form-text text-muted">{{ allQtyRequired.success ? 'Recommended Quantities' : ''}} {{ allQtyRequired.qtys}}</span>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__head-label">
                                        <h4 class="kt-portlet__head-title">
                                            Versions
                                        </h4>
                                        <hr>
                                    </div>

                                    <div class="form-row mpn-version">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="versions"># of Versions</label>
                                                <input  :disabled="!mpn_length" class="form-control" type="number" v-model="versions" id="versions">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="quantity">Quantity</label>
                                                <input :disabled="!mpn_length" class="form-control" type="number" v-model="quantity" id="quantity">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input :disabled="!mpn_length" class="form-control" type="number" v-model="price" id="price">
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="form-group">
                                                <button :disabled="!versions_length" type="button" @click="addVersions"
                                                        class="btn btn-secondary btn-square add-versions">+ Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <ul v-for="(list, index) in versions_list">
                                        <li>
                                            {{ list.versions}} versions of {{ list.quantity}} pieces at ${{ list.price}}
                                            <a @click="removeVersion(versions_list, index)"  href='javascript:void(0)' title='Delete'>
                                                <i class='la la-trash-o'></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="kt-portlet__foot">
                                    <div class="kt-form__actions kt-align-right">
                                        <button :disabled="!versions_list.length" id="versions-submit" type="button" @click="generateVersions"   class="btn btn-primary "><i
                                            class="la la-save"></i>Submit
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <mpn-search-results v-if="generate_versions" :titleVersions="allGenerateVersions"></mpn-search-results>
    </section>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "MPNSearch",
        components: {
        },
        data() {
            return {
                searchMpn: '',
                versions: '',
                quantity: '',
                price: '',
                mpn_length: false,
                versions_length: false,
                versions_list: [],
                generate_versions: false,

            }
        },
        mounted() {
           // this.$store.dispatch('returnSearchMpn');
        },
        updated(){
          if((this.allReturnSearchMpn.desc) || (this.allReturnSearchMpn.brand) ){
              this.mpn_length = true;
          }

          if((this.versions > 0) && (this.quantity > 0) && (this.price > 0) ){
              this.versions_length = true;
          }

        },
        computed: mapGetters([
            "allReturnSearchMpn",
            "allQtyRequired",
            "allGenerateVersions"
        ]),
        methods: {

            MPNSearch() {
                if (this.searchMpn){
                    this.$store.commit('changeSearch', this.searchMpn);
                    this.$store.dispatch('returnSearchMpn');

                    this.$store.commit('changeQty', this.searchMpn);
                    this.$store.dispatch('returnQtyRequired');
                }
            },

            addVersions(){

                this.versions_list.push( {'versions': this.versions, 'quantity': this.quantity, 'price': this.price});

                this.versions = '';
                this.quantity = '';
                this.price = '';
                this.versions_length = false;

            },
            removeVersion(versions_list, index){
                this.versions_list.splice(index, 1);
            },
            generateVersions(){
                this.$store.commit('changeGenerateVersions', this.versions_list);
                this.$store.dispatch('generateVersions');

                this.generate_versions = true;
                document.getElementById("versions-submit").disabled = true;
                document.getElementById("versions").disabled = true;
                document.getElementById("quantity").disabled = true;
                document.getElementById("price").disabled = true;
            }
        },
    }


</script>

<style scoped>

</style>
