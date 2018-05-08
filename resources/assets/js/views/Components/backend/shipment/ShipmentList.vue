
<template>
	<section>
		<v-app id="inspire">
			<!--breadcrumbs start-->
			<breadcrumb1btn 
				v-bind:breadcrumb-item="breadcrumbs"
				v-bind:btn-new-url="btnNewUrl"
				v-bind:breadcrumb-title="breadcrumbTitle"
			></breadcrumb1btn>

			

			<v-form ref="form" lazy-validation>
		    	<v-container grid-list-md>
          			<v-layout wrap>
				    	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Tracking Number"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Order No"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Couriers"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Recipient"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Order Status"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="To Pay"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Delivery Date"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Payment"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm12 md12 p-right>
				      		<v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right">Filter</v-btn>
				      	</v-flex>
				      	
				    </v-layout>
				</v-container>
			</v-form>

			<data-table 
				v-bind:list-title="listTitle"
		    	v-bind:data-header="headers" 
		    	v-bind:data-value="shipments"
	    		v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
		    	v-on:data-actions="actions"
		    	>
		    </data-table>


		</v-app>
	</section>
</template>

<style type="text/css">
	.p-right{float: right;}
</style>
<script> 
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import dataTable from '../commons/tables/dataTable.vue'
	import breadcrumb1btn from '../commons/breadcrumb/breadcrumb1btn.vue'
	export default{
		props:[
			'id'
		],
		data(){
			return{
				listTitle:'Shipment List',
				url:'/api/getShipment',
				btnNewUrl:'/admin/shipment/add',
				
				headers: [
			        { text: 'ID',align: 'left',class:'text-xs-left',value: 'order_shipment_id'},
			        { text: 'Tracking No',align:'left',class:'text-xs-left', value: 'tracking_number' },
			        { text: 'Order No',align:'left',class:'text-xs-left', value: 'order_id' },
			        { text: 'Couriers',align:'left',class:'text-xs-left', value: 'shipping_courier_name' },
			        { text: 'Recipients',align:'left',class:'text-xs-left', value: 'recipient' },
			        { text: 'Sender',align:'left',class:'text-xs-left', value: 'shipping_courier_name' },
			        { text: 'Payment',align:'left',class:'text-xs-left', value: 'order_status' },
			        { text: 'To Pay',align:'left',class:'text-xs-left', value: 'currency_code' },
			        { text: 'Order Status',align:'left',class:'text-xs-left', value: 'order_status' },
			        { text: 'Delivery Date',align:'left',class:'text-xs-left', value: 'date_added' },
			        // { text: 'Action', value: 'id',status:'status',class:'text-xs-center',align:'center',sortable:false },
			        { text: 'Action',flag:'1', value: 'id',status:'status',class:'text-xs-center',align:'center',sortable:false }
			    ],
			    actions:[
			    	{
			    		text: 'eye',
			    		value: 'hello'
			    	},
			    	{
			    		text: 'eye1',
			    		value: 'hello'
			    	},
			    	{
			    		text: 'eye2',
			    		value: 'hello'
			    	},
			    	{
			    		text: 'eye3',
			    		value: 'hello'
			    	}
			    ],
				shipments:[],
				breadcrumbTitle:'Shipment List',
				breadcrumbs: [
			        {
			          text: 'Home',
			          disabled: false
			        },
			        {
			          text: 'Shipment',
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
			document.title = 'User List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.shipments=response.data;
				});
			}
		}
	}
</script>