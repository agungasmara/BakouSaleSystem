<template>
	<section>
		<v-app id="inspire">
			<!--breadcrumbs start-->
			<!-- <breadcrumb1btn 
				v-bind:breadcrumb-item="breadcrumbs"
				v-bind:btn-new-url="btnNewUrl"
				v-bind:breadcrumb-title="breadcrumbTitle"
			></breadcrumb1btn> -->
			<div id="breadcrumbs-wrapper">
				<!-- Search for small screen -->
				<div class="header-search-wrapper grey lighten-2 hide-on-large-only">
				  <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
				</div>
				<div class="container">
				  <div class="row">
				    <div class="col s10 m6 l6">
				      <h5 class="breadcrumbs-title">Shipments</h5>
				      	<v-breadcrumbs>
				        	<v-icon slot="divider">/</v-icon>
			        		<v-breadcrumbs-item  v-for="item in breadcrumbs" :key="item.text" :disabled="item.disabled">
			          			{{ item.text }}
			        		</v-breadcrumbs-item>
			      		</v-breadcrumbs>
				    </div>
				    <!-- <div class="col s2 m6 l6">
				    	<router-link to="/admin/Products/list" replace><v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right">Cancel</v-btn></router-link>

				     	<router-link to="/admin/attributes/list" replace><v-btn @click="submit(1)" class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" color="success">Save</v-btn></router-link>
				    </div> -->
				  </div>
				</div>
			</div>
			<!--breadcrumbs end-->

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
		    	v-bind:del="true">
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
			        { text: 'ID',align: 'left',class:'text-xs-left',value: 'id'},
			        { text: 'Tracking No',align:'left',class:'text-xs-left', value: 'tracking_number' },
			        { text: 'Order No',align:'left',class:'text-xs-left', value: 'order_no' },
			        { text: 'Couriers',align:'left',class:'text-xs-left', value: 'courier' },
			        { text: 'Recipients',align:'left',class:'text-xs-left', value: 'recipient' },
			        { text: 'Sender',align:'left',class:'text-xs-left', value: 'sender' },
			        { text: 'Payment',align:'left',class:'text-xs-left', value: 'payment' },
			        { text: 'To Pay',align:'left',class:'text-xs-left', value: 'to_pay' },
			        { text: 'Order Status',align:'left',class:'text-xs-left', value: 'delivery_status' },
			        { text: 'Delivery Date',align:'left',class:'text-xs-left', value: 'delivery_date' },
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