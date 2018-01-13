<template>
	<div>
		<v-app id="inspire">
			<!--breadcrumbs start-->
			<breadcrumb1btn 
				v-bind:breadcrumb-item="breadcrumbs"
				v-bind:btn-new-url="btnNewUrl"
				v-bind:breadcrumb-title="breadcrumbTitle"
			></breadcrumb1btn>
			<data-table 
		    	v-bind:data-header="headers" 
		    	v-bind:data-value="users"
		    	v-bind:get-api="getApiUrl"
		    	v-bind:delete-api="deleteApiUrl"
	    		v-bind:edit-url="urlEdit"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData">
		    </data-table>

		</v-app>
	</div>
</template>

<script> 
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import dataTable from '../commons/tables/dataTable.vue'
	import breadcrumb1btn from '../commons/breadcrumb/breadcrumb1btn.vue'
	export default{
		props:[
			'id'
		],
		data(){
			return{
				getApiUrl:'/api/users/list/',
				deleteApiUrl:'/api/users/delete/',
				urlEdit:'/admin/users/edit/',
				btnNewUrl:'/admin/users/add',
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
				breadcrumbTitle:'Users List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Users',
			          disabled: false
			        },
			        {
			          text: 'Lists',
			          disabled: true
			        }
			    ]
			}
		},
		components:{'dataTable':dataTable,'breadcrumb1btn':breadcrumb1btn},
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