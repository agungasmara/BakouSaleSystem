<template>
	<div>
		<v-app id="inspire">
			<breadcrumb v-bind:breadcrumb-item="items"></breadcrumb>
			<data-table 
		    	v-bind:data-header="headers" 
		    	v-bind:data-value="groups"
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
	import breadcrumb from '../commons/breadcrumb/breadcrumb.vue'
	export default{
		props:[
			'id'//this use to pass id of record to data table component
		],
		data(){
			return{
				getApiUrl:'/api/user_group/list/',
				deleteApiUrl:'/api/user_group/delete/',
				urlEdit:'/admin/user_group/edit/',
				btnNewUrl:'/admin/user_group/add',
				headers: [
			        { text: 'Group ID',align: 'center',value: 'id'},
			        { text: 'Group Name',align:'center', value: 'name' },
			        { text: 'Group Type',align:'center', value: 'group_type' },
			        { text: 'Permission',align:'center', value: 'psermission' }
			    ],
				groups:[],
				items: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Groups',
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
			document.title = 'Group List';
		},
		methods:{
			fetchData(){
				axios.get(this.getApiUrl).then(response=>{
					this.groups=response.data;
				});
			}
		}
	}
</script>