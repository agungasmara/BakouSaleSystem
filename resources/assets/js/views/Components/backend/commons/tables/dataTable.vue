<template>
	<v-card>

	<v-card-title>
		<v-text-field append-icon="search" label="Search" single-line hide-details v-model="search"></v-text-field>
	</v-card-title>
	<v-data-table v-bind:headers="dataHeader" :items="dataValue" v-bind:search="search" class="elevation-1" :rows-per-page-items="[25,50,100, { text: 'All', value: -1 }]" :loading="tbloading" sort-desc="true">
		<template slot="items" slot-scope="props">
			<td v-for="(value,index) in props.item" :class="index=='id' ? 'text-xs-center':''">

				<img v-if="index=='image'" :src="props.item.image" width="50" height="50">

				<span v-else>{{ value }}</span>

			</td>
			<td class="text-xs-center">

				<span style="cursor:pointer;color:blue;" @click="editData(props.item.id)"">
					<i class="material-icons">edit</i>
				</span>
				&nbsp;
				<span style="cursor:pointer;color:red;" v-on:click="confirmDel(props.item.id,props.item.name)">
					<i class="material-icons">delete_forever</i>
				</span>

			</td>
		</template>
		<template slot="pageText" slot-scope="{ pageStart, pageStop }">
			From {{ pageStart }} to {{ pageStop }}
		</template>
	</v-data-table>
		<v-layout row justify-center>
			<v-dialog v-model="dialog" persistent max-width="500px">
				<v-card>
					<v-card-title class="headline">
						<v-icon medium color="primary" dark>
							info
						</v-icon> Message
					</v-card-title>
				<v-card-text>
					{{ deleteMessage }}
				</v-card-text>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="red" dark @click="dialog=false">
						Cancle
						<v-icon dark right>
							block
						</v-icon>
					</v-btn>
					<v-btn color="primary" dark @click="deleteItem(dataID)">
						Agree
						<v-icon dark right>
							check_circle
						</v-icon>
					</v-btn>
				</v-card-actions>
				</v-card>
			</v-dialog>
		</v-layout>
	</v-card>
</template>

<script>
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	export default{
		props:[
			'dataHeader',//data table header(column name)
			'dataValue',//fetch record and pass to data table component
			'getApi',//provide get api url
			'deleteApi',//provide delete api url
			'editUrl',//provide edit api url
			'btnNewUrl'//url for button
		],
		data(){
			return{
				tbloading:true,
				refreshTable:[],
				Message:'Are you sure you want to delete item with ID=',
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
		mounted(){
			this.tbloading=false
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
				this.deleteMessage=this.Message+id
				this.dataID=id
				this.dialog=true
			},
			deleteItem(id){
				this.deleteMessage="Deleting..."
				axios.delete(this.deleteApi+id).then((res)=>{
					
					if(res.data.deleted==true){

						this.fetchData()
					}
					this.dialog=false
					this.deleteMessage='Item have successfully deleted.'
				})
				
			},
			editData(id){
				//this.components.push(id)
				this.$router.push(this.editUrl+id)
			}
		}
	}
</script>