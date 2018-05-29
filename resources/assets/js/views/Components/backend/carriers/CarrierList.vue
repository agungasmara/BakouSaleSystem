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
		    	v-on:change="fetchData"
		    	v-on:data-actions="actions"
		    	v-bind:del="true"
		    	v-bind:eye="false">
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
				listTitle:'Resellers List',
				url:'/api/carriers',
				btnNewUrl:'/admin/carrier/add',
				headers: [
			        { text: 'ID',align: 'left',class:'text-xs-left',value: 'carrier_id'},
			        { text: 'Name',align:'left',class:'text-xs-left', value: 'name' },
			        { text: 'Url',align:'left',class:'text-xs-left', value: 'url' },
			        { text: 'Action', value: 'carrier_id',status:'status',class:'text-xs-center',align:'center',sortable:false }
			    ],
			    actions:[
			    	{
			    		text: 'eye',
			    		value: 'hello'
			    	},
			    	{
			    		text: 'eye1',
			    		value: 'hello'
			    	},
			    	{
			    		text: 'eye2',
			    		value: 'hello'
			    	},
			    	{
			    		text: 'eye3',
			    		value: 'hello'
			    	}
			    ],
				users:[],
				breadcrumbTitle:'Users List',
				breadcrumbs: [
			        {
			          text: 'Home',
			          disabled: false
			        },
			        {
			          text: 'Resellers',
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