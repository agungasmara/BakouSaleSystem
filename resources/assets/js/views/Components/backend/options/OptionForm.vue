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
			normalForm
		},
		data(){
			return{
				url:'/admin/api/options/',
				e1:true,
				valid: true,
			    group:[
			    	{	class:'xs12 sm12 md12',	 key:'language_id',	type:'select',	 text:'Language',items:'languages'	},
					{	class:'xs12 sm12 md12',	 key:'name',	type:'text',  text:'Option Name'	},
					{	class:'xs12 sm12 md12',	 key:'option_id',	type:'select',text:'Type',items:'attributeGroups'	},
					{	class:'xs12 sm12 md12',	 key:'sort_order',	type:'number',	 text:'Sort Order'	},
					{	class:'xs12 sm12 md12',	 key:'optionValues',	type:'optionImage',	 text:'Sort Order'	}
					
				],
				rules:{
					name: [
				      (v) => !!v || 'Option Name is required',
				    ],
				    option_id:[
				      (v) => !!v || 'Group is required'
				    ],
				    language_id:[
				      (v) => !!v || 'Language is required'
				    ]
				},
				data:{
					name:'',
					option_id:'',
					language_id:'',
					sort_order:0,
					optionValues:[]
				},
				select:{
					attributeGroups:[],
					languages:[]
				},
				breadcrumbTitle:'Options',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Options',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/options/list',
			}
		},
		created(){
			this.getOptions()
			this.getLanguage()
		},
		methods:{
			getOptions(){
				axios.get('/admin/api/getOptions').then((res)=>{
					this.select.attributeGroups=res.data
				})
			},
			getLanguage(){
				axios.get('/admin/api/getLanguage').then((res)=>{
					this.select.languages=res.data
				})
			}
		}
	}
</script>