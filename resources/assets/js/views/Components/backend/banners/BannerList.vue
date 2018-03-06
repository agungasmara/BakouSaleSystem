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
		    	v-bind:data-value="banner"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
		    	v-bind:del="false"
		    	v-bind:eye="true">
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
				url:'/api/banners/',
				btnNewUrl:'/admin/banners/add',
				listTitle:'Attributes List',
				headers: [
			        { text: 'Banner ID',align: 'left',class:'text-xs-left',value: 'banner_id'},
			        { text: 'Banner Name',align:'left',class:'text-xs-left', value: 'name' },
			        { text: 'status',align:'left',class:'text-xs-left', value: 'status' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'banner_id',status:'status',sortable: false}
			    ],
				banner:[],
				breadcrumbTitle:'Attributes List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Attributes',
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
			document.title = 'Attributes List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.banner=response.data;
				});
			}
		}
	}
</script>