<template>
	<div>
		<v-app id="inspire">
			<v-breadcrumbs>
		        <v-icon slot="divider">chevron_right</v-icon>

	        	<v-breadcrumbs-item v-for="item in items" :key="item.text" :disabled="item.disabled">

	          		{{ item.text }}

	        	</v-breadcrumbs-item>
		    </v-breadcrumbs>

			<data-table 
		    	v-bind:data-header="headers" 
		    	v-bind:data-value="users"
		    	v-bind:get-api="getApiUrl"
		    	v-bind:delete-api="deleteApiUrl"
		    	v-bind:edit-url="urlEdit"
		    	v-on:change="fetchData">
		    </data-table>

		</v-app>
	</div>
</template>

<script> 
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import dataTable from '../commons/tables/dataTable.vue'
	export default{
		props:[
			'id',
			'dataHeader',
			'dataValue',
			'getApi',
			'deleteApi',
			'editUrl'
			],
		data(){
			return{
				getApiUrl:'/api/user/list/',
				deleteApiUrl:'/api/user/delete/',
				urlEdit:'/admin/user/edit/',
				headers: [
			        { text: 'ID',align: 'left',value: 'id'},
			        { text: 'Username',align:'center', value: 'username' },
			        { text: 'Group',align:'center', value: 'group' },
			        { text: 'First Name',align:'center', value: 'firstname' },
			        { text: 'Last Name',align:'center', value: 'lastname' },
			        { text: 'Email',align:'center', value: 'email' },
			        { text: 'Code',align:'center', value: 'code' },
			        { text: 'Image',align:'center', value: 'image' },
			        { text: 'Status',align:'center', value: 'status' },
			        { text: 'Date',align:'center', value: 'date_added' },
			        { text: 'Action', value: 'action',align:'center',sortable:false }
			    ],
				users:[],
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
			this.fetchData()
			document.title = 'User List';
		},
		methods:{
			fetchData(){
				axios.get(this.getApiUrl).then(response=>{
					this.users=response.data;
				});
			}
		}
	}
</script>