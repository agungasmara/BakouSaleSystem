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
				url:'/api/credit_type/',
				e1:true,
				valid: true,
			    group:[
			    {	class:'xs12 sm6 md6',	 key:'name',	type:'text',text:'Name',count:100	},
			    {	class:'xs12 sm6 md6',	 key:'type',	type:'text',text:'type',count:100	},
			    {	class:'xs12 sm6 md6',	 key:'value',	type:'text',text:'value',count:100	},
					{	class:'xs12 sm6 md6',	 key:'language_id',	type:'select',	 text:'Language',count:100,items:'languages',	},
					
				],
				rules:{
					name: [
				      (v) => !!v || 'Name is required',
				      (v) => v && v.length <= 100 || 'Name must be less than 100 characters'
				    ],
				    type: [
				      (v) => !!v || 'Type is required',
				      (v) => v && v.length <= 100 || 'Type must be less than 100 characters'
				    ],
				    value: [
				      (v) => !!v || 'Value is required',
				      (v) => v && v.length <= 100 || 'Value must be less than 100 characters'
				    ],
				    language_id:[v => !!v || 'Item is required']
				},
				data:{
					name:'test',
					type:'tt',
					value:'uu',
					language_id: 1
				},
				select:{
					languages:[]
				},
				breadcrumbTitle:'Credit Type',
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
			    backUrl:'/admin/credit_type/list',
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