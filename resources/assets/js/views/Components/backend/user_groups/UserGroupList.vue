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
		    	v-bind:del="false">
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
				listTitle:'User Group List',
				url:'/api/user_groups/',
				btnNewUrl:'/admin/users_group/add',
				headers: [
					{ text: 'Group ID',align: 'left',class:'text-xs-left',value: 'user_group_id'},
			        { text: 'Group Name',align:'left',class:'text-xs-left', value: 'name' },
			        { text: 'Group Type',align:'left',class:'text-xs-left', value: 'group_type' },
			        { text: 'Action',align:'center',value:'user_group_id',class:'text-xs-center', sortable:false }
			    ],
				groups:[],
				breadcrumbTitle:'User Group List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'User Group',
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
					this.groups=response.data;
					console.log(response.data)
				});
			}
		}
	}
</script>