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
		    	v-bind:data-value="groups"
	    		v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
					v-bind:detail="true"
		    	v-bind:del="true">
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
				listTitle:'User Role List',
				url:'/admin/api/user_role/',
				btnNewUrl:'/admin/user_role/add',
				headers: [
					{ text: 'ID',align: 'left',class:'text-xs-left',value: 'id'},
			        { text: 'Role Name',align:'left',class:'text-xs-left', value: 'name' },
			        { text: 'User Group',align:'left',class:'text-xs-left', value: 'user_group' },
							{ text: 'Remark',align:'left',class:'text-xs-left', value: 'remark' },
			        { text: 'Action',align:'center',value:'role_id',class:'text-xs-center', sortable:false }
			    ],
				groups:[],
				breadcrumbTitle:'User Role List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'User Role',
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
			document.title = 'Group List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.groups=response.data['data'];
				});
			}
		}
	}
</script>