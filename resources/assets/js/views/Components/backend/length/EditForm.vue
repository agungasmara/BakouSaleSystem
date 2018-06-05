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
				url:'/admin/api/lengths/',
				e1:true,
				valid: true,
			    group:[
					{	class:'xs12 sm6 md6',	 key:'value',	type:'number',	 text:'value'	},
					{	class:'xs12 sm6 md6',	 key:'unit',	type:'text',text:'Unit'	},
					{	class:'xs12 sm6 md6',	 key:'language_id',	type:'select',	 text:'Language',items:'languageItems'	},
					{	class:'xs12 sm6 md6',	 key:'title',	type:'text',	 text:'Description'	}
				],
				rules:{
					title: [
				      (v) => !!v || 'Title is required'
				    ],
				    value: [
				      (v) => !!v || 'Value is required'
				    ],
				    unit: [
				      (v) => !!v || 'Unit is required'
				    ],
				    language_id:[
				      (v) => !!v || 'Language Requied is required'
				    ]
				},
				data:{
					title:' ',
					language_id:'',
					unit: '',
					value:'',
				},
				select:{
					languageItems:[]
				},
				breadcrumbTitle:'Lengths',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Lengths',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/lengths/list',
			}
		},
		created(){
			this.dataID=this.id
			this.fetchData(this.id)
			this.getLanguage()
		},
		methods:{
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
					console.log(res.data)
				});
			},
			getLanguage(){
				axios.get('/admin/api/getLanguage').then((res)=>{
					this.select.languageItems=res.data
				})
			}
		}
	}
</script>