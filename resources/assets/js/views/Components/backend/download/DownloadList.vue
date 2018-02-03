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
		    	v-bind:data-value="downloads"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData">
		    </data-table>

		    <!--End of data table-->

		</v-app>

</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import dataTable from '../commons/tables/dataTable.vue'
	import breadcrumb1btn from '../commons/breadcrumb/breadcrumb1btn.vue'
	export default{
		props:[
			'id'//this use to pass id of record to data table component
		],
		data(){
			return{
				url:'/api/downloads/',
				btnNewUrl:'/admin/downloads/add',
				listTitle:'Weights List',
				headers: [
			        { text: 'Download ID',align: 'left',class:'text-xs-left',value: 'download_id'},
			        { text: 'Filename',align:'left',class:'text-xs-left', value: 'filename' },
			        { text: 'Mask',align:'left',class:'text-xs-left', value: 'mask' },
			        { text: 'Language',align:'left',class:'text-xs-left', value: 'language' },
			        { text: 'Description',align:'left',class:'text-xs-left', value: 'description' },
			        { text: 'Date Added',align:'left',class:'text-xs-left', value: 'date_added' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'download_id',sortable: false}
			    ],
				downloads:[],
				breadcrumbTitle:'Manufacturer List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Manufacturer',
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
			document.title = 'Manufacturer List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.downloads=response.data;
				});
			}
		}
	}
</script>