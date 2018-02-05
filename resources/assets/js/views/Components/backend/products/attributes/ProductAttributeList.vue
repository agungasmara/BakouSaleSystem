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
		    	v-bind:data-value="product_attribute"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
		    	v-bind:del="true"
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
				url:'/api/product_attribute/',
				btnNewUrl:'/admin/product_attributes/add',
				listTitle:'Weights List',
				headers: [
			        { text: 'Attribute ID',align: 'left',class:'text-xs-left',value: 'attribute_id'},
			        { text: 'Description',align:'left',class:'text-xs-left', value: 'description' },
			        { text: 'Group',align:'left',class:'text-xs-left', value: 'group' },
			        { text: 'Language',align:'left',class:'text-xs-left', value: 'language' },
			        {text: 'Action',align:'center',class:'text-xs-center',status:'',value:'attribute_id',sortable: false}
			    ],
				product_attribute:[],
				breadcrumbTitle:'Product Attribute List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Product Attribute',
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
			document.title = 'Product Attribute List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.product_attribute=response.data;
				});
			}
		}
	}
</script>