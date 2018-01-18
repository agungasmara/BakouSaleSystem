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
				v-bind:list-title="listTitle"
		    	v-bind:data-header="headers" 
		    	v-bind:data-value="users"
	    		v-bind:url="url"
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
				listTitle:'User List',
				url:'/api/users/',
				btnNewUrl:'/admin/users/add',
				headers: [
			        { text: 'ID',align: 'center',class:'text-xs-center',value: 'id'},
			        { text: 'Username',align:'center',class:'text-xs-left', value: 'username' },
			        { text: 'Group',align:'center',class:'text-xs-left', value: 'group' },
			        { text: 'First Name',align:'center',class:'text-xs-left', value: 'firstname' },
			        { text: 'Last Name',align:'center',class:'text-xs-left', value: 'lastname' },
			        { text: 'Email',align:'center',class:'text-xs-left', value: 'email' },
			        { text: 'Code',align:'center',class:'text-xs-center', value: 'code' },
			        { text: 'Image',align:'center',class:'text-xs-center', value: 'image' },
			        { text: 'Status',align:'center',class:'text-xs-center', value: 'status' },
			        { text: 'Date',align:'center',class:'text-xs-center', value: 'date_added' },
			        { text: 'Action', value: 'id',class:'text-xs-center',align:'center',sortable:false }
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
				axios.get(this.url).then(response=>{
					this.users=response.data;
				});
			}
		}
	}
</script>