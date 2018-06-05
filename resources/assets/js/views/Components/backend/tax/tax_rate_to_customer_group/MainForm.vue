<template>
	<v-app id="inspire">
		<normal-form
			v-bind:url="url"
			v-bind:id="0"
			v-bind:breadcrumb-title="breadcrumbTitle"
			v-bind:breadcrumbs="breadcrumbs"
			v-bind:form-items="group"
			v-bind:form-rules="rules"
			v-bind:form-datas="data"
			v-bind:select-items="select"
			v-bind:back-url="backUrl"
		></normal-form>
	</v-app>
</template>
<script>
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../../commons/form/normalForm.vue'
	export default{
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/admin/api/tax_rate_to_customer_group/',
				e1:true,
				valid: true,
			    group:[
			    	{	class:'xs12 sm6 md6',	 key:'customer_group_id',	type:'select',	 text:'Customer Group',items:'customer_group',	},
			    	{	class:'xs12 sm6 md6',	 key:'tax_rate_id',	type:'select',	 text:'Tax Rate',items:'tax_rate',	}
				],
				rules:{
				    customer_group_id: [v => !!v || 'Item is required'],
				    tax_rate_id: [v => !!v || 'Item is required']
				},
				data:{
					tax_rate_id:0,
					customer_group_id:0
				},
				select:{
					customer_group:[],
					tax_rate:[]
				},
				breadcrumbTitle:'Tax Rate',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Tax Rate',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/tax_rate_customer_group/list',
			}
		},
		created(){
			this.getTaxItem()
		},
		methods:{
			getTaxItem(){
				axios.get('/admin/api/getTaxRate').then((res)=>{
					this.select.tax_rate=res.data
				})
				axios.get('/admin/api/getCustomerGroup').then((res)=>{
					this.select.customer_group=res.data
				})
			}
		}
	}
</script>