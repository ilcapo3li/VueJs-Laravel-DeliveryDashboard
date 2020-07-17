<template>
<div>
    <b-row>
      <b-col md="12" class="my-1"> 
                  <b-table    
                  id="packages"
                  show-empty
                  stacked="md"
                  :sort-direction="sortDirection"
                  :sort-by.sync="sortBy"
                  :sort-desc.sync="sortDesc"
                  :items="packages"
                  :fields="fields">
                  <template slot="actions"  slot-scope="row">
                        <b-button size="sm" class="mr-1" @click="showPackages(row.item)">Edit</b-button>
                  </template>
                </b-table>
      </b-col>
    </b-row>
        <b-row>
      <b-pagination
        v-model="currentPage"
        :total-rows="total"
        :per-page="perPage"
        aria-controls="packages"
      >
      </b-pagination>
    </b-row>
</div>
</template>
<script>
import apiUrls from '../helpers/apiUrls';

    export default{
        name:'Packages',
        mounted(){
          this.getPackages();
        },
        methods:{
          getPackages(){
            axios.get(apiUrls.packages(),{params:{'page':this.currentPage}}).then((response)=>{
              console.log(response.data)
              this.packages=response.data.data;
              this.perPage=response.data.per_page
              this.total=response.data.total

            });
          },
          showPackages(channelPackage){
           localStorage.setItem('country_id',channelPackage.id);
           this.$router.push({name:'leagues',params:{'country_id':channelPackage.id}});
          }
           
        },
        data(){
            return{
             sortDirection:'asc',
             sortBy: null,
             sortDesc: false, 
             packages:[],
             countryFilter:null,
             currentPage:1,
             perPage:null,
             total:null,
             fields:[
                {
                  key:'category_name',
                  sortable:true
                },
                {
                  key:'discription',
                  sortable:true
                },
                {
                  key:'actions',
                  sortable:false
                }
             ]
            }

        },
        watch:{
           currentPage(){
           this.getPackages();      
          },
          countryFilter(){
             this.getCountries(); 
          }
        }
    }
</script>
<style>
