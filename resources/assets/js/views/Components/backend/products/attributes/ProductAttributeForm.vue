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
				url:'/api/product_attribute/',
				e1:true,
				valid: true,
			    group:[
			    	{	class:'xs12 sm3 md6',	 key:'name',	type:'text',text:'Name',count:100	},
			    	{	class:'xs12 sm6 md6',	 key:'description',	type:'text',text:'Description',count:100	},
			    	{	class:'xs12 sm6 md6',	 key:'language_id',	type:'select',	 text:'Language',count:100,items:'languages',	},
					{	class:'xs12 sm6 md6',	 key:'attribute_group_id',	type:'select',	 text:'Attribute Group',count:100,items:'attributeGroup',	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Name is required',
				      (v) => v && v.length <= 100 || 'Name must be less than 100 characters'
				    ],
				    language_id:[v => !!v || 'Item is required'],
				    attribute_group_id:[v => !!v || 'Item is required']
				},
				data:{
					name:'',
					language_id: null,
					attribute_group_id:null
				},
				select:{
					languages:[],
					attributeGroup:[]
				},
				breadcrumbTitle:'Order Status',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Order Status',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/product_attributes/list',
			}
		},
		created(){
			this.getLanguage()
			this.getAttributeGroup()
		},
		methods:{
			getLanguage(){
				axios.get('/api/getLanguage').then((res)=>{
					this.select.languages=res.data
				})
			},
			getAttributeGroup(){
				axios.get('/api/getAttributeGroup').then((res)=>{
					this.select.attributeGroup=res.data
				})
			}
		}
	}
</script>