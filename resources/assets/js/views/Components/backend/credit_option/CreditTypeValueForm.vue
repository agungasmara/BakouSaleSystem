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
				url:'/api/credit_type_value/',
				e1:true,
				valid: true,
			    group:[
					{	class:'xs12 sm4 md4',	 key:'credit_type_id',	type:'select',	 text:'Credit Type',count:100,items:'creditType',	},
					{	class:'xs12 sm4 md4',	 key:'name',	type:'text',text:'Name',count:100	},
					{	class:'xs12 sm4 md4',	 key:'value',	type:'text',text:'Value',count:100	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Name is required',
				      (v) => v && v.length <= 100 || 'Name must be less than 100 characters'
				    ],
				    value: [
				      (v) => !!v || 'Value is required',
				      (v) => v && v.length <= 100 || 'Value must be less than 100 characters'
				    ],
				    credit_type_id:[v => !!v || 'Item is required']
				},
				data:{
					name:'',
					credit_type_id: null,
					value:''
				},
				select:{
					creditType:[]
				},
				breadcrumbTitle:'Credit Type Value',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Credit Type',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/credit_type_value/list',
			}
		},
		created(){
			this.getCreditType()
		},
		methods:{
			getCreditType(){
				axios.get('/api/getCreditType').then((res)=>{
					this.select.creditType=res.data
				})
			}
		}
	}
</script>