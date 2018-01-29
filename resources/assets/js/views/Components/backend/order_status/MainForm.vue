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
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../commons/form/normalForm.vue'
	export default{
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/api/order_status/',
				e1:true,
				valid: true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
			    group:[
					{	class:'xs12 sm6 md6',	 key:'language_id',	type:'select',	 text:'Language',count:100,items:'languages',	},
					{	class:'xs12 sm6 md6',	 key:'name',	type:'text',text:'Status Name',count:100	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Status Name is required',
				      (v) => v && v.length <= 100 || 'Status Name must be less than 100 characters'
				    ],
				    language_id:[v => !!v || 'Item is required']
				},
				data:{
					name:'',
					language_id: null
				},
				select:{
					languages:[]
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
			    backUrl:'/admin/order_status/list',
			}
		},
		created(){
			this.getLanguage()
		},
		methods:{
			getLanguage(){
				axios.get('/api/getLanguage').then((res)=>{
					this.select.languages=res.data
				})
			}
		}
	}
</script>