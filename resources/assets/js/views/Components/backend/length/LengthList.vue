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
		    	v-bind:data-value="lengths"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
		    	v-bind:del="true">
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
				url:'/admin/api/lengths/',
				btnNewUrl:'/admin/lengths/add',
				listTitle:'Lengths List',
				headers: [
			        { text: 'Lengths ID',align: 'left',class:'text-xs-left',value: 'length_class_id'},
			        { text: 'Value',align:'left',class:'text-xs-left', value: 'value' },
			        { text: 'Description',align:'left',class:'text-xs-left', value: 'title' },
			        { text: 'Language',align:'left',class:'text-xs-left', value: 'language' },
			        { text: 'Unit',align:'left',class:'text-xs-left', value: 'unit' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'length_class_id',sortable: false}
			    ],
				lengths:[],
				breadcrumbTitle:'Lengths List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Lengths',
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
			document.title = 'Lengths List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.lengths=response.data;
				});
			}
		}
	}
</script>