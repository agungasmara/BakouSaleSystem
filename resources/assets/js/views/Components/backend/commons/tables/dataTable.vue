<template>
<v-card>
			  
  <v-card-title>
    <v-spacer>
    	<div>
            <router-link to="/admin/settings/add" replace><v-btn color="primary">Create New</v-btn></router-link>
        </div>
    </v-spacer>
    <v-text-field append-icon="search" label="Search" single-line hide-details v-model="search"></v-text-field>
  </v-card-title>
	<v-data-table v-bind:headers="dataHeader" :items="dataValue" v-bind:search="search" class="elevation-1" :rows-per-page-items="[25,50,100, { text: 'All', value: -1 }]">
		<template slot="items" slot-scope="props">
			<td v-for="(value,index) in props.item">
				{{ value }}
				<img v-if="index=='image'" :src="props.item.image" width="50" height="50">
			</td>
			<td>
				<span style="cursor:pointer;color:blue;" @click="editData(props.item.id)"">
					<i class="material-icons">edit</i>
				</span>&nbsp;<span style="cursor:pointer;color:red;" v-on:click="confirmDel(props.item.id,props.item.name)"><i class="material-icons">delete_forever</i></span>
			</td>
		</template>
		<template slot="pageText" slot-scope="{ pageStart, pageStop }">
          From {{ pageStart }} to {{ pageStop }}
        </template>
    </v-data-table>
    
</v-card>
</template>

<script>
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	export default{
		props:[
			'dataHeader',
			'dataValue',
			'getApi',
			'deleteApi',
			'editUrl'
		],
		data(){
			return{
				refreshTable:[],
				deleteMessage:'',
				dataName:'',
				dataID:'',
				dialog:false,
				max25chars: (v) => v.length <= 25 || 'Input too long!',
				tmp: '',
				search: '',
				pagination: {},
			}
		},
		methods:{
			fetchData(){
				axios.get(this.getApi).then(response=>{

					//refresh data table when data have changed

					this.$emit('change', response.data)//'change' is the event pass from parent component

					//this.dataValue=response.data

					//this.$emit('change',newData) this use to tell the parent component when chile component have changed

					//vue props not allow to update child props without tell parent
				});
			},
			confirmDel(id,name){

				this.$dialog.confirm('Are you sure you want to delete the item with ID: '+id+'?',{
				loader: true
				}).then((dialog)=>{
					setTimeout(() => {
			            this.deleteItem(id)
			            dialog.close();
			        }, 2500);
				})
			},
			deleteItem(id,opt){
			
					axios.delete(this.deleteApi+id).then((res)=>{
						
						if(res.data.deleted==true){

							this.fetchData()

						}
						
					})
				
			},
			editData(id){
				//this.components.push(id)
				this.$router.push(this.editUrl+id)
			}
		}
	}
</script>