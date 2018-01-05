<template>
	<div>
		<v-app id="inspire">
			<v-breadcrumbs>
		        <v-icon slot="divider">chevron_right</v-icon>

	        	<v-breadcrumbs-item v-for="item in items" :key="item.text" :disabled="item.disabled">

	          		{{ item.text }}

	        	</v-breadcrumbs-item>
		    </v-breadcrumbs>

			    <data-table v-bind:data-header="headers" v-bind:data-value="settings"></data-table>

		    <v-layout row justify-center>
		      <v-dialog v-model="dialog" persistent max-width="290">
		        <v-card>
		          <v-card-title class="headline">Message</v-card-title>
		          	<v-card-text>
		          		{{ deleteMessage }} {{ settingID }}?
		          	</v-card-text>
		          <v-card-actions>
		            <v-spacer></v-spacer>
		            <v-btn color="green darken-1" flat @click="deleteItem(settingID,0)">Cancle</v-btn>
		            <v-btn color="green darken-1" flat @click="deleteItem(settingID,1)">Agree</v-btn>
		          </v-card-actions>
		        </v-card>
		      </v-dialog>
		    </v-layout>
		</v-app>
	</div>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import dataTable from '../commons/dataTable.vue'
	export default{
		props:['settingid','dataHeader','dataValue'],
		data(){
			return{
				deleteMessage:'',
				settingName:'',
				settingID:'',
				dialog:false,
				headers: [
			        { text: 'Setting ID',align: 'center',value: 'setting_id'},
			        { text: 'Store Name',align:'center', value: 'name' },
			        { text: 'code',align:'center', value: 'code' },
			        { text: 'Key',align:'center', value: 'key' },
			        { text: 'Value',align:'center', value: 'value' },
			        { text: 'Serialized',align:'center', value: 'serialized' }
			    ],
				settings:[],
				items: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Users',
			          disabled: false
			        },
			        {
			          text: 'List',
			          disabled: true
			        }
			    ]
			}
		},
		components:{'dataTable':dataTable},
		created(){
			this.fetchSettings()
			document.title = 'Setting List';
		},
		methods:{
			fetchSettings(){
				axios.get('/api/setting/list').then(response=>{
					this.settings=response.data;
				});
			},
			confirmDel(id,name){
				this.deleteMessage='Are you sure you want to delete setting with ID:'
				this.dialog=true;
				this.settingName=name
				this.settingID=id
			},
			deleteItem(id,opt){
				if(opt==1){
					this.deleteMessage='Deleting...'
					axios.delete('/api/setting/delete/'+id).then((res)=>{
						
						if(res.data.deleted==true){
							this.deleteMessage='Delete Successfully'
							this.dialog=false
							this.fetchSettings()
						}
						
					})
				}else{
					this.dialog=false
				}
			},
			editSetting(id){
				//this.components.push(id)
				this.$router.push('/admin/settings/edit/'+id)
			}
		}
	}
</script>