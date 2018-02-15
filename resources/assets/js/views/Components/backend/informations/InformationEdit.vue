<template id="{{ $route.params.id }}">
	<v-app id="inspire">
		<normal-form
			v-bind:url="url"
			v-bind:id="id"
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
		props:['id'],
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/api/informations/',
				e1:true,
				valid: true,
			    group:[
			    	{	class:'xs12 sm3 md3',	 key:'language_id',	type:'select',	 text:'Language',items:'languageItems'	},
					{	class:'xs12 sm9 md9',	 key:'title',	type:'text',	 text:'Information Title'	},
					{	class:'xs12 sm12 md12',	 key:'description',	type:'editor',text:'Description'	},
					{	class:'xs12 sm12 md12',	 key:'meta_title',	type:'text',	 text:'Meta Tag Title'	},
					{	class:'xs12 sm12 md12',	 key:'meta_description',	type:'textarea',text:'Meta Tag Description'	},
					{	class:'xs12 sm12 md12',	 key:'meta_keyword',	type:'textarea',text:'Meta Tag Keyword'	},
					{	class:'xs12 sm12 md12',	 key:'store_id',	type:'checkbox',	 text:'Dfault Store'	},
					{	class:'xs12 sm12 md12',	 key:'bottom',	type:'checkbox',	 text:'Bottom'	},
					{	class:'xs12 sm6 md6',	 key:'status',	type:'select',	 text:'Status',items:'statusItem'	},
					{	class:'xs12 sm6 md6',	 key:'sort_order',	type:'text',	 text:'Sort Order'	},
					{	class:'xs12 sm12 md12',	 key:'keyword',	type:'text',	 text:'Keyword'	},
					{	class:'xs12 sm12 md12',	 key:'layout_id',	type:'select',	 text:'Layout',items:'layoutItem'	},
				],
				rules:{
					title: [
				      (v) => !!v || 'Title is required'
				    ],
				    description: [
				      (v) => !!v || 'Description is required'
				    ],
				    meta_title: [
				      (v) => !!v || 'Meta Tag Title is required'
				    ],
				    meta_description: [
				      (v) => !!v || 'Meta Description Title is required'
				    ],
				    meta_keyword: [
				      (v) => !!v || 'Meta Keyword Title is required'
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
			this.dataID=this.id
			this.fetchData(this.id)
			this.getLanguage()
			this.getLayout()
		},
		methods:{
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
					console.log(res.data)
				});
			},
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