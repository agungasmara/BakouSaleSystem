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
		props:['id'],
		data(){
			return {
				url:'/admin/api/categories/',
				e1:true,
				valid: true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
			    group:[
					{	class:'xs12 sm6 md6',	 key:'category_type_id',	type:'select',	text:'Choose Category Type',	items:'categoryType',	count:100,	},
					{	class:'xs12 sm6 md6',	 key:'parent_id',	type:'select',	items:'categoryParent',	text:'Choose Parent Category',count:100	},
					{	class:'xs12 sm6 md6',	 key:'sort_order',	type:'text',	 text:'Sort Order',count:100	},
					{	class:'xs12 sm6 md6',	 key:'status',	type:'select',items:'statusItems',	 text:'Status',count:100	},
					{	class:'xs12 sm6 md6',	 key:'column',	type:'text',	 text:'Column',count:50	},
					{	class:'xs12 sm6 md6',	 key:'top',	type:'text',	 text:'Top',count:100	},
					{	class:'xs12 sm6 md6',	 key:'language_id',	type:'select',	 text:'Choose Language12',items:'language',count:100	},
					{	class:'xs12 sm6 md6',	 key:'name',	type:'text',	 text:'Name',count:50	},
					{	class:'xs12',	 key:'description',	type:'textarea',	 text:'description',count:50	},
					{	class:'xs12 sm6',	 key:'meta_title',	type:'text',	 text:'Meta Title',count:50	},
					{	class:'xs12 sm6',	 key:'meta_keyword',	type:'text',	 text:'Meta Keyword',count:25	},
					{	class:'xs12',	 key:'meta_description',	type:'textarea',	 text:'Meta Description',count:100	},
					{	class:'xs12 sm12 md12',	 key:'image',	type:'image',	 Value:'',count:0	}
					
				],
				rules:{
					// username: [
				 //      (v) => !!v || 'Username is required',
				 //      (v) => v && v.length <= 16 || 'Username must be less than 16 characters'
				 //    ],
					// firstname: [
				 //      (v) => !!v || 'First Name is required',
				 //      (v) => v && v.length <= 10 || 'First Name must be less than 10 characters'
				 //    ],
				 //    lastname: [
				 //      (v) => !!v || 'Last Name is required',
				 //      (v) => v && v.length <= 10 || 'Last Name must be less than 10 characters'
				 //    ],
				 //    email: [
				 //      (v) => !!v || 'E-mail is required',
				 //      (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
				 //    ],
				 //    password: [
				 //      (v) => !!v || 'Password is required',
				 //      (v) => v && v.length <= 32 || 'Password must be less than 32 characters'
				 //    ],
				 //    confirmPassword: [
				 //      (v) => !!v || 'Confirm Password is required',
				 //      (v) => v && v.length <= 32 || 'Confirm Password must be less than 32 characters'
				 //    ],
				 //    code: [
				 //      (v) => !!v || 'Code is required',
				 //      (v) => v && v.length <= 8 || 'Code must be less than 8 characters'
				 //    ]
				},
				data:{
					// category_type_id:'',
					// image:'',
					// parent_id:'',
					// top:'',
					// column:'',
					// sort_order:'',
					// status:'',
					// language_id:'',
					// name:'',
					// description:'',
					// meta_title:'',
					// meta_description:'',
					// meta_keyword:'',
				},
				select:{
					statusItems:[
						{text:'Acitve',value:1},
						{text:'Inactive',value:0}
					],
					categoryType:[],
					categoryParent:[],
					language:[],
				},
				flash:Flash.state,
				breadcrumbTitle:'Categories',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Categories',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/categories/list',
			}
		},
		created(){
			this.id ? this.fetchData(this.id) : ''
			this.categoryType()
			this.categoryParent()
			this.language()
		},
		methods:{
			
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
				});
			},
			categoryType(){
				axios.get('/admin/api/getCategories_type').then((res)=>{
					this.select.categoryType=res.data
				})
			},
			categoryParent(){
				axios.get('/admin/api/getCategories_parent').then((res)=>{
					this.select.categoryParent=res.data
				})
			},
			language(){
				debugger;
				axios.get('/admin/api/getLanguages').then((res)=>{
					this.select.language=res.data
				})
			}
		}
	}
</script>