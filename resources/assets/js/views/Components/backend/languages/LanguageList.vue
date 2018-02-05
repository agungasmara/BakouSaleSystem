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
		    	v-bind:data-value="languages"
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
				url:'/api/languages/',
				btnNewUrl:'/admin/languages/add',
				listTitle:'Languages List',
				headers: [
			        { text: 'Languages ID',align: 'left',class:'text-xs-left',value: 'language_id'},
			        { text: 'Name',align:'left',class:'text-xs-left', value: 'name' },
			        { text: 'Image',align:'left',class:'text-xs-left', value: 'image' },
			        { text: 'code',align:'left',class:'text-xs-left', value: 'code' },
			        { text: 'Locale',align:'left',class:'text-xs-left', value: 'locale' },
			        { text: 'Directory',align:'left',class:'text-xs-left', value: 'directory' },
			        { text: 'Status',align:'left',class:'text-xs-left', value: 'status' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'language_id',status:'status',sortable: false}
			    ],
				languages:[],
				breadcrumbTitle:'Languages List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Languages',
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
			document.title = 'Languages List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.languages=response.data;
				});
			}
		}
	}
</script>