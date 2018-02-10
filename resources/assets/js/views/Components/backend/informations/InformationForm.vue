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
				url:'/api/weights/',
				e1:true,
				valid: true,
			    group:[
			    	{	class:'xs12 sm6 md6',	 key:'language_id',	type:'select',	 text:'Language',count:0,items:'languageItems'	},
					{	class:'xs12 sm6 md6',	 key:'title',	type:'text',	 text:'Information Title',count:100	},
					{	class:'xs12 sm12 md12',	 key:'description',	type:'textarea',text:'Description',count:1000	},
					{	class:'xs12 sm12 md12',	 key:'meta_title',	type:'text',	 text:'Meta Tag Title',count:100	},
					{	class:'xs12 sm12 md12',	 key:'meta_description',	type:'textarea',text:'Meta Tag Description'	},
					{	class:'xs12 sm12 md12',	 key:'meta_keyword',	type:'textarea',text:'Meta Tag Keyword'	},
					{	class:'xs12 sm6 md6',	 key:'store_id',	type:'checkbox',	 text:'Store',count:0	}
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
				    ],
				    store_id:[(v) => !!v || 'Language Requied is required']
				},
				data:{
					title:' ',
					language_id:'',
					unit: '',
					value:0.0000,
				},
				select:{
					languageItems:[]
				},
				breadcrumbTitle:'Weights',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Weights',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/weights/list',
			}
		},
		created(){
			this.getLanguage()
		},
		methods:{
			getLanguage(){
				axios.get('/api/getLanguage').then((res)=>{
					this.select.languageItems=res.data
				})
			}
		}
	}
</script>