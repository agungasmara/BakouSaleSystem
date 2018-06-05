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
		    	v-bind:data-value="taxClass"
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
				url:'/admin/api/tax_class/',
				btnNewUrl:'/admin/tax_class/add',
				listTitle:'Tax Class List',
				headers: [
			        { text: 'Tax Class ID',align: 'left',class:'text-xs-left',value: 'tax_class_id'},
			        { text: 'Title',align:'left',class:'text-xs-left', value: 'title' },
			        { text: 'Description',align:'left',class:'text-xs-left', value: 'description' },
			        { text: 'Date Added',align:'left',class:'text-xs-left', value: 'date_added' },
			        { text: 'Date Modified',align:'left',class:'text-xs-left', value: 'date_modified' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'tax_class_id',sortable: false}
			    ],
				taxClass:[],
				breadcrumbTitle:'Tax Class List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Tax Class',
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
			document.title = 'Tax Class List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.taxClass=response.data;
				});
			}
		}
	}
</script>