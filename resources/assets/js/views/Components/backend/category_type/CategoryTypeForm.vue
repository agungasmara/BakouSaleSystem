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
				url:'/api/category_type',
				e1:true,
				valid: true,
			    group:[
					{	class:'xs12 sm6 md6',	 key:'name',	type:'text',	 text:'CategoryType Name'	},
					{	class:'xs12 sm6 md6',	 key:'language_id',	type:'select',	 text:'Language',items:'languages'	},
					{	class:'xs12',	 key:'description',	type:'textarea',	 text:'description',count:50	},
				],
				rules:{
					name: [
				      (v) => !!v || 'CategoryType Name is required'
				    ],
				    language_id:[
				      (v) => !!v || 'Language Requied is required'
				    ]
				},
				data:{
					name:'',
					language_id:'',
					sort_order:0,
					description:''
				},
				select:{
					filterGroups:[],
					languages:[]
				},
				breadcrumbTitle:'CategoryType',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'CategoryType',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/category_type/list',
			}
		},
		created(){
			this.getFilterGroup()
			this.getLanguage()
		},
		methods:{
			getFilterGroup(){
				axios.get('/api/category_type').then((res)=>{
					debugger;
					this.select.filterGroups=res.data
				})
			},
			getLanguage(){
				axios.get('/api/getLanguage').then((res)=>{
					this.select.languages=res.data
				})
			}
		}
	}
</script>