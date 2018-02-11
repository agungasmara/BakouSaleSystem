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
				url:'/api/informations/',
				e1:true,
				valid: true,
			    group:[
			    	{	class:'xs12 sm3 md3',	 key:'language_id',	type:'select',	 text:'Language',count:0,items:'languageItems'	},
					{	class:'xs12 sm9 md9',	 key:'title',	type:'text',	 text:'Information Title',count:100	},
					{	class:'xs12 sm12 md12',	 key:'description',	type:'textarea',text:'Description',count:1000	},
					{	class:'xs12 sm12 md12',	 key:'meta_title',	type:'text',	 text:'Meta Tag Title',count:100	},
					{	class:'xs12 sm12 md12',	 key:'meta_description',	type:'textarea',text:'Meta Tag Description'	},
					{	class:'xs12 sm12 md12',	 key:'meta_keyword',	type:'textarea',text:'Meta Tag Keyword'	},
					{	class:'xs12 sm12 md12',	 key:'store_id',	type:'checkbox',	 text:'Dfault Store',count:0	},
					{	class:'xs12 sm12 md12',	 key:'bottom',	type:'checkbox',	 text:'Bottom',count:0	},
					{	class:'xs12 sm6 md6',	 key:'status',	type:'select',	 text:'Status',count:0,items:'statusItem'	},
					{	class:'xs12 sm6 md6',	 key:'sort_order',	type:'text',	 text:'Sort Order',count:100	},
					{	class:'xs12 sm12 md12',	 key:'keyword',	type:'text',	 text:'Keyword',count:100	},
					{	class:'xs12 sm12 md12',	 key:'layout_id',	type:'select',	 text:'Layout',count:0,items:'layoutItem'	},
				],
				rules:{
					title: [
				      (v) => !!v || 'Title is required',
				      (v) => v && v.length <= 100 || 'Title must be less than 100 characters'
				    ],
				    description: [
				      (v) => !!v || 'Description is required',
				      (v) => v && v.length <= 1000 || 'Description must be less than 10 characters'
				    ],
				    meta_title: [
				      (v) => !!v || 'Meta Tag Title is required',
				      (v) => v && v.length <= 5 || 'Meta Tag Title must be less than 5 characters'
				    ],
				    language_id:[
				      (v) => !!v || 'Language Requied is required'
				    ]
				},
				data:{
					store_id:0,
					status:1,
					title:'test',
					language_id:1,
					description:'test',
					meta_description:'desc',
					meta_keyword:'key',
					meta_title:'test',
					bottom:1
				},
				select:{
					languageItems:[],
					layoutItem:[],
					statusItem:[
						{value:0,text:'Inactive'},
						{value:1,text:'Active'}
					]

				},
				breadcrumbTitle:'Information',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Information',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/informations/list',
			}
		},
		created(){
			this.getLanguage()
			this.getLayout()
		},
		methods:{
			getLanguage(){
				axios.get('/api/getLanguage').then((res)=>{
					this.select.languageItems=res.data
				})
			},
			getLayout(){
				axios.get('/api/getLayout').then((res)=>{
					this.select.layoutItem=res.data
				})
			}
		}
	}
</script>