<template>
<v-app id="inspire">
	<multi-tap-form
		v-bind:url="url"
		v-bind:id="0"
		v-bind:breadcrumb-title="breadcrumbTitle"
		v-bind:breadcrumbs="breadcrumbs"
		v-bind:form-tabs="tabs"
		v-bind:form-rules="rules"
		v-bind:form-datas="data"
		v-bind:select-items="select"
		v-bind:back-url="backUrl"
	></multi-tap-form>
</v-app>
</template>
<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import multiTapForm from '../commons/form/multiTapForm.vue'
	
	export default{
		components: {
			multiTapForm
		},
		data(){
			return{
				url:'/admin/api/products/',
				backUrl:'/admin/products/list',
				e1:true,
				valid: true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
				select:{
					status:[
						{	Value:1,	text:'Enable'},
						{	Value:0,	text:'Disable'}
					],
					weight_class:[
						{	Value:1,	text:'Enable'},
						{	Value:0,	text:'Disable'}
					],
					length_class:[
						{	Value:1,	text:'Enable'},
						{	Value:0,	text:'Disable'}
					],
					subtract_stock:[
						{	Value:1,	text:'Enable'},
						{	Value:0,	text:'Disable'}
					],
					stock_status:[
						{	Value:1,	text:'Enable'},
						{	Value:0,	text:'Disable'}
					],
					tax_class:[
						{	Value:1,	text:'Enable'},
						{	Value:0,	text:'Disable'}
					],
					manufacturer:[
						{	Value:1,	text:'Enable'},
						{	Value:0,	text:'Disable'}
					],
				},
				rules:{

				},
				tabs:[
						{
							name:'General', 
							group:[
								{	class:'xs12 sm6 md6',	 key:'language_id',	text:'language_id',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'description',	text:'description',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'tag',	text:'tag',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'meta_title',	text:'meta_title',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'meta_description',	text:'meta_description',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'meta_keyword',	text:'meta_keyword',	type:'text',	 Value:''	},
								{	class:'xs12 sm6 md6',	 key:'name',	text:'name',	type:'text',	 Value:''},
							]
						},
						{
							name:'Data', 
							group:[
								{	class:'xs12 sm6 md6',	 key:'model',	text:'model',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'manufacturer_id',	text:'manufacturer_id',	type:'select',	 Value:''	,items:'manufacturer'},
								{	class:'xs12 sm6 md6',	 key:'sku',	text:'sku',	type:'text',	 Value:''},
								
								{	class:'xs12 sm6 md6',	 key:'location',	text:'location',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'quantity',	text:'quantity',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'stock_status_id',	text:'stock_status_id',	type:'select',	 Value:'',	items:'stock_status'},
								{	class:'xs12 sm6 md6',	 key:'price',	text:'price',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'minimum',	text:'minimum',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'subtract',	text:'subtract',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'shipping',	text:'shipping',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'points',	text:'points',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'tax_class_id',	text:'tax_class_id',	type:'select',	 Value:'',	items:'tax_class'},
								{	class:'xs12 sm6 md6',	 key:'date_available',	text:'date_available',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'weight',	text:'weight',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'weight_class_id',	text:'weight_class_id',	type:'select',	 Value:'',	items:'weight_class'},
								{	class:'xs4 sm2',	 key:'length',	text:'length',	type:'text',	 Value:''},
								{	class:'xs4 sm2',	 key:'width',	text:'width',	type:'text',	 Value:''},
								{	class:'xs4 sm2',	 key:'height',	text:'height',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'length_class_id',	text:'length_class_id',	type:'select',	 Value:'',	items:'length_class'},
								{	class:'xs12 sm6 md6',	 key:'sort_order',	text:'sort_order',	type:'text',	 Value:''},
								{	class:'xs12 sm6 md6',	 key:'status',	text:'status',	type:'select',	Value:'',	items:'status'	},
							]
						},
						
						{
							name:'Image', 
							group:[
								{	class:'xs12 sm6 md6',	 key:'image',	text:'image',	type:'image',	 Value:''},
							]
						},
						
					],
					data:{

					},
				breadcrumbTitle:'Products',
			    breadcrumbs: [
			        {
			          text: 'Dashboard',
			          disabled: false
			        },
			        {
			          text: 'Products',
			          disabled: false
			        },
			        {
			          text: 'Form',
			          disabled: true
			        }
		      	],
				flash:Flash.state
			}
		},

		created(){
			this.getCategories()
		},
		methods:{
			getCategories(){
				axios.get('admin/api/categories/list').then((res)=>{
					this.items=res.data
				})
			},
			submit (opt) {
		      if (this.$refs.form.validate()) {
		        // Native form submission is not yet supported
		        axios.post('/api/setting/save', {
		          store: this.select,
		          code: this.code,
		          key: this.key,
		          value: this.value
		        }).then((res)=>{
		        	if(res.data.success==true){
		        		Flash.setSuccess(res.data.message)
		        		if(opt==1){
		        			this.$refs.form.reset()
		        		}
		        		else if(opt==2){
		        			this.$router.push('/admin/settings/list')
		        		}
		        	}
		        })
		      }
		    }
		}
	}
</script>