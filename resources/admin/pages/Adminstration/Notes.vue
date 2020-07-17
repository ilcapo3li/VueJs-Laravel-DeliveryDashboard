<template>
  <b-container fluid>
    <card>
      <div >
        <b-row :style="{'text-align':isRTL?'right':'left'}">
          <b-col  md="6" class="my-1">

            <div v-if="user.role =='super'">
              <b-button class="btn btn-primary" size="sm" @click="addCommentator()">{{$t('add')}}</b-button>
            </div>
            <div v-for="(permission,index) in user.permissions" v-bind:key="index">
              <div v-if="permission.name=='Add Commentator'">
               <b-button class="btn btn-primary" size="sm" @click="addCommentator()">{{$t('add')}}</b-button>
             </div>
           </div> 
         </b-col>
         <b-col  md="4" class="my-1">

          <base-input
          v-model="filter"
          type="search"
          id="filterInput"
          placeholder="Type to Search"
          >
        </base-input>
      </b-col>
      <b-col  md="2" class="my-1">
        <b-button class="btn btn-warning" size="sm" :disabled="!filter" @click="filter = ''">Clear</b-button>

      </b-col>
    </b-row>    
    <b-row>




      <b-col md="12" class="my-1"> 
        <b-table    
        id="commentators"
        show-empty
        stacked="md"
        :class="isRTL?'text-right':'text-left'"
        :sort-direction="sortDirection"
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
        :items="commentators"
        head-variant="light"
        :fields="fields"
        :current-page="currentPage"
        :per-page="perPage"
        :filter="filter"
        :filterIncludedFields="filterOn"      
        @filtered="onFiltered">

        <!-- <template  v-slot:cell(photo)="data">
          <div  class="img-row">
            <b-img :src="im" alt="commentator image" />
          </div>

        </template> -->
        <template  v-slot:cell(actions)="row">


          <div v-if=" user.role=='super'">

            <b-button size="sm" class="mr-1 btn btn-success" @click="editCommentator(row.item)">{{$t('edit')}}</b-button>
            <b-button size="sm" class="mr-1 btn btn-danger" @click="removeCommentator(row.item)">{{$t('delete')}}</b-button>
          </div>  
          <div v-for="(permission,index) in user.permissions" v-bind:key="index">
            <div v-if="permission.name=='Edit Commentator'">
              <b-button size="sm" class="mr-1 btn btn-success" @click="editCommentator(row.item)">{{$t('edit')}}</b-button>
            </div>
          </div>
          <div v-for="(permission,index) in user.permissions" v-bind:key="index">
            <div v-if="permission.name=='Remove Commentator' ">
              <b-button size="sm" class="mr-1 btn btn-danger" @click="removeCommentator(row.item)">{{$t('delete')}}</b-button>
            </div>
          </div> 

        </template>
      </b-table>
    </b-col>
  </b-row>

  <b-row>
    <b-col  md="6" class="my-1">
      <b-pagination
      v-model="currentPage"
      :total-rows="total"
      :per-page="perPage"
      aria-controls="commentators"
      class="my-0"
      >
    </b-pagination>
  </b-col>
</b-row>

</div>
</card>
</b-container>
</template>





<script>
  import apiUrls from '../../helpers/apiUrls';

  export default{
    name:'Commentators',
    mounted(){
      this.getCommentators();
    },
    methods:{
     
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      },
      getCommentators(){
        axios.get(apiUrls.commentators(),{params:{'page':this.currentPage}})
        .then((response)=>{
          this.commentators=response.data.data;
          this.perPage=response.data.per_page
          this.total=response.data.total
        });
      },
      editCommentator(commentator){
       localStorage.setItem('commentator',JSON.stringify(commentator));
       this.$router.push({name:'edit-commentator',params:{commentator}});
     },
     addCommentator(){
      this.$router.push({name:'add-commentator'});
    },
    removeCommentator(commentator){
      swal({
        title: this.$t('Are_you_sure'),
        text: this.$t('once_record_deleted_cannot_restord'),
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete){
          axios.delete(apiUrls.deleteCommentator(commentator.id))
          .then(()=>{
            const index=this.commentators.indexOf(commentator)
            this.commentators.splice(index,1);
            swal(this.$t('record_deleted'), {
             icon: "success",
           });
          })
          .catch(error=>{
            toastr.error(error.response.data.error);
          });                    
        }
        else{
          swal(this.$t('record_not_deleted'));
        }
      });


    }

  },
  data(){
    return{
      // im:'default/default.png',
      sortDirection:'asc',
      sortBy: null,
      sortDesc: false, 
      commentators:[],
      currentPage:1,
      perPage:null,
      total:null,
      fields:[
      {
        key:'name',
        label:this.$t('commentators'),
        sortable:true
      },
      // {
      //   key:'image',
      //   label:this.$t('image'),
      //   sortable:true
      // },
      {
        key:'actions',
        label:this.$t('actions'),
        sortable:false
      }
      ],
      totalRows: 1,
      currentPage: 1,
      sortBy: '',
      filterOn:null,
      sortDesc: false,
      sortDirection: 'asc',
      filter: null,
     
     
    }

  },
  computed:{
   user(){
     return this.$store.getters.user;
   },
   sortOptions() {
        // Create an options list from our fields
        return this.fields
        .filter(f => f.sortable)
        .map(f => {
          return { text: f.label, value: f.key }
        })
      },
      isRTL() {
       return this.$rtl.isRTL;
     },
   },
   watch:{
     currentPage(){
       this.getCommentators();      
     }
   }
 }
</script>
<style>
