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
		    	v-bind:data-value="informations"
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
				url:'/admin/api/informations/',
				btnNewUrl:'/admin/informations/add',
				listTitle:'Informations List',
				headers: [
			        { text: 'Information ID',align: 'left',class:'text-xs-left',value: 'information_id'},
			        { text: 'Information Title',align:'left',class:'text-xs-left', value: 'title' },
			        { text: 'Sort Order',align:'left',class:'text-xs-left', value: 'sort_order' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'information_id',sortable: false}
			    ],
				informations:[],
				breadcrumbTitle:'Informations List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Informations',
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
			document.title = 'Informations List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.informations=response.data;
				});
			}
		}
	}
</script>