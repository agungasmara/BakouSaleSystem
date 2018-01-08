<template>
	<div>
		<v-app id="inspire">
			<breadcrumb v-bind:breadcrumb-item="items"></breadcrumb>
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
	import breadcrumb from '../commons/breadcrumb/breadcrumb.vue'
	export default{
		props:[
			'id',
			'dataHeader',
			'dataValue',
			'getApi',
			'deleteApi',
			'editUrl',
			'breadcrumbItem'
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
			          text: 'Lists',
			          disabled: true
			        }
			    ]
			}
		},
		components:{'dataTable':dataTable,'breadcrumb':breadcrumb},
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