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
		    	v-bind:data-value="manufacturers"
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
				url:'/admin/api/manufacturers/',
				btnNewUrl:'/admin/manufacturers/add',
				listTitle:'Weights List',
				headers: [
			        { text: 'Manufacturer ID',align: 'left',class:'text-xs-left',value: 'manufacturer_id'},
			        { text: 'Name',align:'left',class:'text-xs-left', value: 'name' },
			        { text: 'Image',align:'left',class:'text-xs-left', value: 'image' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'manufacturer_id',sortable: false}
			    ],
				manufacturers:[],
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
					this.manufacturers=response.data;
				});
			}
		}
	}
</script>