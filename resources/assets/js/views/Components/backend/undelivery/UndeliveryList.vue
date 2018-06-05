
<template>
	<section>
		<v-app id="inspire">
			<!--breadcrumbs start-->
			<breadcrumbnobtn 
				v-bind:breadcrumb-item="breadcrumbs"
				v-bind:btn-new-url="btnNewUrl"
				v-bind:breadcrumb-title="breadcrumbTitle"
			></breadcrumbnobtn>

			

			<v-form v-model="valid" ref="formFilter" lazy-validation>
		    	<v-container grid-list-md>
          			<v-layout wrap>
				    	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Tracking Number" v-model="filter.tracking_number"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Order No" v-model="filter.order_no"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Couriers" v-model="filter.shipping_courier_name"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Recipient" v-model="filter.recipient"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Order Status" v-model="filter.order_status"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="To Pay" v-model="filter.currency_code"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-menu
					          lazy
					          :close-on-content-click="false"
					          v-model="menu"
					          transition="scale-transition"
					          offset-y
					          full-width
					          :nudge-right="40"
					          max-width="290px"
					          min-width="290px"
					        >
					          <v-text-field
					            slot="activator"
					            label="Delivery Date"
					            v-model="filter.date_added"
					            prepend-icon="event"
					            readonly
					          ></v-text-field>
					          <v-date-picker v-model="filter.date_added" no-title scrollable actions>
					            <template slot-scope="{ save, cancel }">
					              <v-card-actions>
					                <v-spacer></v-spacer>
					                <v-btn flat color="primary" @click="cancel">Cancel</v-btn>
					                <v-btn flat color="primary" @click="save">OK</v-btn>
					              </v-card-actions>
					            </template>
					          </v-date-picker>
					        </v-menu>
				      	</v-flex>

				      	<!-- <v-flex xs12 sm3 md3>
				      		<v-text-field label="Payment" v-model="filter.payment_status"></v-text-field>
				      	</v-flex> -->

				      	<v-flex xs12 sm12 md12 class="text-lg-right">
				      		<v-btn @click="filterCustomer" :disabled="!valid">Filter</v-btn>
						<v-btn @click="clear">clear</v-btn>
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
	import breadcrumbnobtn from '../commons/breadcrumb/breadcrumbnobtn.vue'
	export default{
		props:[
			'id'
		],
		data(){
			return{
				listTitle:'Undelivery List',
				url:'/admin/api/undelivery',
				menu:null,
				btnNewUrl:'/admin/shipment/add',
				valid:false,
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
			        { text: 'Action',flag:'1', value: 'order_shipment_id',status:'status',class:'text-xs-center',align:'center',sortable:false }
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
			    filter:{},
				shipments:[],
				breadcrumbTitle:'Undelivery List',
				breadcrumbs: [
			        {
			          text: 'Home',
			          disabled: false
			        },
			        {
			          text: 'Undelivery',
			          disabled: false
			        },
			        {
			          text: 'Lists',
			          disabled: true
			        }
			    ]
			}
		},
		components:{'dataTable':dataTable,'breadcrumbnobtn':breadcrumbnobtn},
		created(){
			this.fetchData()
			document.title = 'User List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.shipments=response.data;
				});
			},
			filterCustomer()
			{
				axios.post('/admin/api/filterShippment',this.filter).then(res=>{
					if(res.data.result==true){
						this.shipments=res.data.data
						//console.log(res.data.data)
					}
				})
			},
			clear(){
				this.$refs.formFilter.reset()
				this.fetchData()
			}
		}
	}
</script>