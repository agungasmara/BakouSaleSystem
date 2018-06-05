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
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../../commons/form/normalForm.vue'
	export default{
		props:['id'],
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/admin/api/tax_rule/',
				e1:true,
				valid: true,
				group:[
			    	{	class:'xs12 sm6 md6',	 key:'tax_class_id',	type:'select',	 text:'Tax Class',items:'tax_class',	},
			    	{	class:'xs12 sm6 md6',	 key:'tax_rate_id',	type:'select',	 text:'Tax Rate',items:'tax_rate',	},
					{	class:'xs12 sm6 md6',	 key:'based',	type:'text',	 text:'Based'	},
					{	class:'xs12 sm6 md6',	 key:'priority',	type:'text',	 text:'Priority'	},
				],
				rules:{
					based: [
				      (v) => !!v || 'Name is required'
				    ],
				    priority: [
				      (v) => !!v || 'Priority is required'
				    ],
				    tax_class_id: [v => !!v || 'Item is required'],
				    tax_rate_id: [v => !!v || 'Item is required']
				},
				data:{
					based:'',
					priority:1,
					tax_class_id:'',
					tax_rate_id:0
				},
				select:{
					tax_class:[],
					tax_rate:[]
				},
				breadcrumbTitle:'Tax Rule',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Tax Rule',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/tax_rule/list',
			}
		},
		created(){
			this.dataID=this.id
			this.fetchData(this.id)
			this.getTaxItem()
		},
		methods:{
			fetchData(id){
				axios.get('/admin/api/tax_rule/'+id+'/edit').then(res=>{
					this.data=res.data
					console.log(res.data)
				});
			},
			getTaxItem(){
				axios.get('/admin/api/getTaxClass').then((res)=>{
					this.select.tax_class=res.data
				})
				axios.get('/admin/api/getTaxRate').then((res)=>{
					this.select.tax_rate=res.data
				})
			}
		}
	}
</script>