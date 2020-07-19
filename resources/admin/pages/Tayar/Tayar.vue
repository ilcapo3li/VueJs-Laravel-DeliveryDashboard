<template>
  <card>
   <div>
    <b-row :style="{'text-align':isRTL?'right':'left'}">
      <b-col  md="6" class="my-1">

        <div v-if="user.role =='super'">
          <b-button class="btn btn-primary" size="sm" @click="addAdmins()">{{$t('add')}}</b-button>
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
      <b-button class="btn btn-warning" size="sm" :disabled="!filter" @click="filter = ''">{{$t('clear')}}</b-button>

    </b-col>
  </b-row>

  <b-row>
    <b-col md="12" class="my-1">
      <b-table
      id="admins"
      show-empty
      stacked="md"
      fixed
      :class="isRTL?'text-right':'text-left'"
      :sort-direction="sortDirection"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :items="admins"
      head-variant="light"
      :fields="fields"
      :filter="filter"
      :filterIncludedFields="filterOn"
      @filtered="onFiltered">

       <template  v-slot:cell(photo)="data">
          <div  class="img-row">
            <b-img-lazy :src="data.item.photo ? data.item.photo.path : 'default/default.png' " alt="Admin image"/>
          </div>
        </template>

      <template v-slot:cell(actions)="row">
        <b-button size="sm" class="mr-1 btn btn-success" @click="editAdmins(row.item)">{{$t('edit')}}</b-button>
        <b-button size="sm" class="mr-1 btn btn-danger" @click="removeAdmins(row.item)">{{$t('delete')}}</b-button>
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
    aria-controls="server_types"
    >
  </b-pagination>
</b-col>
</b-row>
</div>
</card>
</template>
<script>
  import apiUrls from '../../helpers/apiUrls';
  export default{
    name:'Admins',
    mounted(){
       this.getAdmins();
    },
    data(){
      return{
        admins:[],
        sortDirection:'asc',
        sortBy: null,
        sortDesc: false,
        perPage:null,
        total:null,
        fields:[
           {
            label:'#',
            key:'id',
            sortable:true
         },
          {
            label:this.$t('image'),
            key:'photo',
            sortable:true
         },
        {
          label:this.$t('admins'),
          key:'name',
          sortable:true
        },

        {
          label:this.$t('actions'),
          key:'actions',
          sortable:false
        }
        ],
        totalRows: 1,
        currentPage: 1,
        filterOn:null,
        filter: null,
      }
    },
    methods:{

     getAdmins(){
        axios.get(apiUrls.admins(),{params:{'page':this.currentPage}})
        .then((response)=>{
        this.admins=response.data.data
        this.perPage=response.data.per_page;
        this.total=response.data.total;
      });
     },
     editAdmins(admin){
      localStorage.setItem('admin',JSON.stringify(admin));
      this.$router.push({
        name:'admins-edit',
        params:{admin}
      })
    },
    onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      },
      removeAdmins(admin){
        swal({
          title: this.$t('Are_you_sure'),
          text: this.$t('once_record_deleted_cannot_restord'),
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if(willDelete){
            axios.delete(apiUrls.deleteAdmin(admin))
            .then((response)=>{
              const index=this.admins.indexOf(admin);
              this.admins.splice(index,1);
              toastr.success(response.data)
            })
            .catch(error=>{
              toastr.error(error.response.data.error);
            });
          }
          else{
            swal(this.$t('record_not_deleted'));
          }
        })

      },
      addAdmins(){
        this.$router.push({name:'admins-add'});
      }
    },
    watch:{
     currentPage(){
       this.getAdmins();
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
    }
  }
</script>
