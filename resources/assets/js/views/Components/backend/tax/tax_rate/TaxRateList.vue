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
		    	v-bind:data-value="taxRate"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData">
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
				url:'/api/tax_rate/',
				btnNewUrl:'/admin/tax_rate/add',
				listTitle:'Tax Rate List',
				headers: [
			        { text: 'Tax Rate ID',align: 'left',class:'text-xs-left',value: 'tax_rate_id'},
			        { text: 'Name',align:'left',class:'text-xs-left', value: 'name' },
			        { text: 'Geo Zone',align:'left',class:'text-xs-left', value: 'geo_zone' },
			        { text: 'Rate',align:'left',class:'text-xs-left', value: 'rate' },
			        { text: 'Type',align:'left',class:'text-xs-left', value: 'type' },
			        { text: 'Date Added',align:'left',class:'text-xs-left', value: 'date_added' },
			        { text: 'Date Modified',align:'left',class:'text-xs-left', value: 'date_modified' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'tax_rate_id',sortable: false}
			    ],
				taxRate:[],
				breadcrumbTitle:'Tax Rate List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Tax Rate',
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
			document.title = 'Tax Rate List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.taxRate=response.data;
				});
			}
		}
	}
</script>