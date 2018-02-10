<template>

		<v-app id="inspire">

			<!--breadcrumbs start-->
			<breadcrumb1btn 
				v-bind:breadcrumb-item="breadcrumbs"
				v-bind:btn-new-url="btnNewUrl"
				v-bind:breadcrumb-title="breadcrumbTitle"
			></breadcrumb1btn>

			<!--Data table component-->

		    <data-table 
		    	v-bind:list-title="listTitle"
		    	v-bind:data-header="headers" 
		    	v-bind:data-value="filtergroups"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
		    	v-bind:del="false"
		    	v-bind:eye="false">
		    </data-table>

		    <!--End of data table-->

		</v-app>

</template>

<script>
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	import dataTable from '../../commons/tables/dataTable.vue'
	import breadcrumb1btn from '../../commons/breadcrumb/breadcrumb1btn.vue'
	export default{
		props:[
			'id'//this use to pass id of record to data table component
		],
		data(){
			return{
				url:'/api/filters_group/',
				btnNewUrl:'/admin/filters_group/add',
				listTitle:'Attributes List',
				headers: [
			        { text: 'Group ID',align: 'left',class:'text-xs-left',value: 'filter_group_id'},
			        { text: 'Group',align:'left',class:'text-xs-left', value: 'group' },
			        { text: 'Language',align:'left',class:'text-xs-left', value: 'language' },
			        { text: 'Sort Order',align:'left',class:'text-xs-left', value: 'sort_order' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'filter_group_id',status:'status',sortable: false}
			    ],
				filtergroups:[],
				breadcrumbTitle:'Filter Group List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Filter Group',
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
			document.title = 'Filter Group List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.filtergroups=response.data;
				});
			}
		}
	}
</script>